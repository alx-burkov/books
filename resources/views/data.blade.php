<table class="books">
    <thead>
        <tr>
            <td class="field-id">ID</td>
            <td>Автор</td>
            <td>Название</td>
            <td>Краткое описание</td>
        </tr>
    </thead>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->short_descr }}</td>
        </tr>
    @endforeach
</table>
