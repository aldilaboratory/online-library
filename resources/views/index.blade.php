@extends('layout')

@section('title', 'index')

@section('content')
<div class="container">
    @if (session('success_add'))
    <div class="alert alert-success alert-dismissable show" role="alert">
        {{ session('success_add') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('success_delete'))
    <div class="alert alert-success alert-dismissable show" role="alert">
        {{ session('success_delete') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        @foreach ($books as $book)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <div class="thumbnail" style="height: 400px">
                    <img src="{{ $book->image_path }}" width="250px" alt="{{ $book->title }}">
                </div>
                <div class="caption">
                    <h4>{{ $book->title }}</h4>
                    <?php
                    if (strlen($book->desc) > 100) {
                        $book->desc = substr($book->desc, 0, 200) . "...";
                    }
                    ?>
                    <p>{{ $book->desc }}</p>
                    <div class="text-center">
                        <a href="{{ route('books.detail', ['isbn' => $book->isbn]) }}" class="btn btn-default" role="button">Show Detail</a>
                        @auth
                        @if ($book->user_id === auth()->user()->id)
                        <a href="{{ route('books.edit', ['isbn' => $book->isbn]) }}" class="btn btn-warning" role="button">Edit Book</a>
                        <form action="{{ route('books.destroy', ['isbn' => $book->isbn]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" role="button">Delete Book</button>
                        </form>
                        @else
                        <button class="btn btn-warning" disabled>Edit Book</button>
                        <button class="btn btn-danger" disabled>Delete Book</button>
                        @endif
                        @endauth
                        @guest
                        @endguest
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('pagination')
<div class="text-center">

    <nav aria-label="Page navigation">
        <ul class="pagination">
            {!! $books->links() !!}
        </ul>
    </nav>
</div>
@endsection