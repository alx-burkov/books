<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Книги</title>

        <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('js/books.js')}}"></script>

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: Helvetica, sans-serif;
                margin: 10px;
                font-size: 14px;
            }

            div.button {
                float: left;
                margin-left: 20px;
                border: 1px solid ;
                background-color: #6eb9ff;
                color: #000d33;
                padding: 3px;
                border-radius: 3px;
                cursor: pointer;
                margin-bottom: 20px;
            }

            table.books {
                width: 100%;
                margin: 5px auto;
                clear: both;
                border-collapse: separate;
                border-spacing: 0;
            }

            table.books thead, tr {
                border-top: 1px solid #333;
                border-bottom: 1px solid #333;
            }

            table.books thead tr td {
                padding: 5px;
                font-weight: bold;
                color: #2e3436;
                border-top: 1px solid #888a85;
            }

            table.books tr td {
                border-bottom: 1px solid #888a85;
            }

            table.books thead {
                background-color: #bdff85;
            }

            td.field-id {
                width: 50px;
            }

            table.books tbody tr {
                cursor: pointer;
            }

            table.books tbody tr.book-selected {
                background-color: #fffe91;
            }

            table.books tbody tr.book-hover {
                border: 1px solid #009926;
            }

            div.form {
                border: 1px solid #888a85;
                border-radius: 5px;
                background-color: #d3d7cf;
                position: absolute;
                top: 50%;
                left: 50%;
                padding: 20px;
                z-index: 10001;
            }

            div#form {
                height: 340px;
                width: 500px;
                margin-top: -170px;
                margin-left: -250px;
            }

            div#delete-confirm {
                height: 70px;
                width: 300px;
                margin-top: -35px;
                margin-left: -150px;
            }

            div#form .field {
                margin-bottom: 10px;
            }

            div#form .field span {
                font-weight: bold;
                margin-right: 5px;
                width: 150px;
                float: left;
            }

            div#form .field input {
                width: 340px;
            }

            div#form .field textarea {
                width: 337px;
                height: 200px;
            }

            div.form .button-set {
                float: right;
            }

            div#form #form-info {
                color: #cc0000;
                height: 20px;
                width: 100%;
                margin-bottom: 10px;
            }

            div#delete-confirm .caption {
                font-weight: bold;
                font-size: 18px;
                text-align: center;
                margin-bottom: 20px;
            }

            #curtain {
                position: fixed;
                padding: 0;
                margin: 0;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(125,125,125,0.5);
                z-index: 10000;
            }

            .hidden {
                display: none;
            }

            div#message {
                height: 20px;
                text-align: left;
                margin-top: 10px;
            }

            div#message.error {
                color: #cc0000
            }

            div#message.info {
                color: #005802
            }
        </style>
    </head>
    <body>
        <div id="refresh" class="button">Обновить</div>
        <div id="add" class="button">Добавить</div>
        <div id="edit" class="button">Редактировать</div>
        <div id="delete" class="button">Удалить</div>
        <div id="books"></div>
        <div id="form" class="form hidden">
            <div class="field"><span>Автор</span><input type="text" name="author" value="" /></div>
            <div class="field"><span>Название</span><input type="text" name="title" value="" /></div>
            <div class="field"><span>Краткое описание</span><textarea type="text" name="short_descr"></textarea></div>
            <input type="hidden" name="id" value="" />
            <div id="form-info"></div>
            <div class="button-set">
                <div id="save" class="button">Сохранить</div>
                <div id="cancel" class="button but-cancel">Отмена</div>
            </div>
        </div>
        <div id="delete-confirm" class="form hidden">
            <div class="caption">Удалить запись?</div>
            <div class="button-set">
                <div id="confirm-del" class="button">Удалить</div>
                <div id="cancel" class="button but-cancel">Отмена</div>
            </div>
        </div>
        <div id="message"></div>
        <div id="curtain" class="hidden"></div>
    </body>
</html>
