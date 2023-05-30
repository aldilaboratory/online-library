@extends('layout')

@section('title', 'Deleted Books')

@section('content')
<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ISBN</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trashedBooks as $book)
                    <tr>
                        <th scope="row">{{ $book->isbn }}</th>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            @if ($book->trashed())
                            <form action="{{ route('books.restore', $book->isbn) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Restore</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection

    <!-- @section('pagination')
<div class="text-center">

    <nav aria-label="Page navigation">
        <ul class="pagination">
            {!! $books->links() !!}
        </ul>
    </nav>
</div>
@endsection -->