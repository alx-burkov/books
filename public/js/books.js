$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/books/data',
        success: function(data) {
            $('#books').html(data);
        }
    });

    $('#refresh').click(function(){
        $('div#message').className = '';
        $('div#message').html('');
        refreshData();
    });

    $('#add').click(function(){
        $('input[type=text][name=author]').val('');
        $('input[type=text][name=title]').val('');
        $('textarea[name=short_descr]').val('');
        $('div#form input[type=hidden][name=id]').val('');
        $('div#form #form-info').html('');
        $('div#form').removeClass('hidden');
        $('div#curtain').removeClass('hidden');
    });

    $('#edit').click(function(){
        var id = $('tr.book-selected').children(':first').html();
        if (!id){
            $('div#message').className = '';
            $('div#message').addClass('info').html('Выберите запись на редактирование');
            return;
        }
        $('div#form #form-info').html('');
        $('input[type=text][name=author]').val($('tr.book-selected').children('td').eq(1).html());
        $('input[type=text][name=title]').val($('tr.book-selected').children('td').eq(2).html());
        $('textarea[name=short_descr]').val($('tr.book-selected').children('td').eq(3).html());
        $('div#form input[type=hidden][name=id]').val(id);
        $('div#form').removeClass('hidden');
        $('div#curtain').removeClass('hidden');
    });

    $('#save').click(function(){
        var author = $('input[type=text][name=author]').val();
        var title = $('input[type=text][name=title]').val();
        var short_descr = $('textarea[name=short_descr]').val();

        if (!author){
            $('div#form #form-info').html('Поле &laquo;Автор&raquo; должно быть заполнено');
            $('input[type=text][name=author]').focus();
            return;
        }
        else if (author.length > 200){
            $('div#form #form-info').html('Длина поля &laquo;Автор&raquo; не должна превышаить 200 символов');
            $('input[type=text][name=author]').focus();
            return;
        }

        if (!title){
            $('div#form #form-info').html('Поле &laquo;Название&raquo; должно быть заполнено');
            $('input[type=text][name=title]').focus();
            return;
        }
        else if (title.length > 50){
            $('div#form #form-info').html('Длина поля &laquo;Название&raquo; не должна превышаить 50 символов');
            $('input[type=text][name=author]').focus();
            return;
        }

        if (!short_descr){
            $('div#form #form-info').html('Поле &laquo;Краткое описание&raquo; должно быть заполнено');
            $('textarea[name=short_descr]').focus();
            return;
        }
        else if (title.length > 50){
            $('div#form #form-info').html('Длина поля &laquo;Краткое описание&raquo; не должна превышаить 500 символов');
            $('textarea[name=short_descr]').focus();
            return;
        }

        var method = 'POST',
            url = '/books/data',
            id = $('div#form input[type=hidden][name=id]').val();
        if (id){
            method = 'PUT';
            url += '/' + id;
        }

        $.ajax({
            url: url,
            method: method,
            data: {
                author: author,
                title: title,
                short_descr: short_descr
            },
            success: function(data) {
                $('div#message').className = '';
                $('div#message').addClass('info').html(data);
                refreshData();
            },
            error: function(jqXhr, textStatus, errorThrown){
                $('div#message').className = '';
                $('div#message').addClass('error').html(jqXhr.status + ' - ' + jqXhr.statusText + ': ' + jqXhr.responseJSON.message);
            }
        });

        $('div#form').addClass('hidden');
        $('div#curtain').addClass('hidden');
    });

    $('#delete').click(function(){
        var id = $('tr.book-selected').children(':first').html();
        if (!id){
            $('div#message').className = '';
            $('div#message').addClass('info').html('Выберите запись на удаление');
            return;
        }
        $('div#delete-confirm').removeClass('hidden');
        $('div#curtain').removeClass('hidden');
    });

    $('#confirm-del').click(function(){
        var id = $('tr.book-selected').children(':first').html();
        $.ajax({
            url: '/books/data/' + id,
            method: 'DELETE',
            success: function(data) {
                $('div#message').className = '';
                $('div#message').addClass('info').html(data);
                refreshData();
            },
            error: function(jqXhr, textStatus, errorThrown){
                $('div#message').className = '';
                $('div#message').addClass('error').html(jqXhr.status + ' - ' + jqXhr.statusText + ': ' + jqXhr.responseJSON.message);
            }
        });
        $('div#delete-confirm').addClass('hidden');
        $('div#curtain').addClass('hidden');
    });

    $('div.but-cancel').click(function(){
        $('div#' + $(this).parent().parent().attr('id')).addClass('hidden');
        $('div#curtain').addClass('hidden');
    });

    $(document).on('click', 'div#books table tbody tr', function() {
        $('div#books table tbody tr').removeClass('book-selected');
        $(this).addClass('book-selected');
    });

    $(document).on('over', 'div#books table tbody tr', function() {
        $(this).toggleClass('book-hover');
    });
});

function refreshData(){
    $('#books').html('');
    $.ajax({
        url: '/books/data',
        success: function(data) {
            $('#books').html(data);
        }
    });
}
