@extends('layout')

@section('title', 'index')

@section('content')
<div class="container">
    @if (session('success_update'))
    <div class="alert alert-success alert-dismissable show" role="alert">
        {{ session('success_update') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <div class="thumbnail">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="{{ $book->image_path }}" class="pt-10 pb-10 pl-10" width="250px">
                        <div class="text-center">
                            <a href="#" class="btn btn-default mt-10 mb-10" role="button">Borrow</a>
                            <a href="#" class="btn btn-default" role="button">Buy</a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-8">
                        <h2><b>{{ $book->title }}</b></h2>
                        <p><small>by</small> <a href="#" class="h-link">{{ $book->author->author_name }}</a></p>
                        <div class="pt-20">
                            <p>Publisher <a href="#" class="h-link">{{ $book->publisher }}</a></p>
                            <p>Category <a href="#" class="h-link">{{ $book->category }}</a></p>
                            <p>Pages <b>{{ $book->pages }}</b></p>
                            <p>Language <a href="#" class="h-link">{{ $book->language }}</a></p>
                            <p>Publish Date <a href="#" class="h-link">{{ $book->publish_date }}</a></p>
                            <p>Subjects <a href="#" class="h-link">{{ $book->subjects }}</a></p>
                            <p id="synopsis">{{ $book->desc }}</p>
                            <p class="h-link" id="read-btn" onclick="showCompleteText()">Read more</p>
                            <p>ISBN <b>{{ $book->isbn }}</b></p>
                        </div>
                    </div>

                    @auth
                    @if ($book->user_id === auth()->user()->id)
                    <div class="col-sm-6">
                        <div class="text-right">
                            <a href="{{ route('books.edit', ['isbn' => $book->isbn]) }}" class="btn btn-warning" role="button">Edit Book</a>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-right">
                            <form action="{{ route('books.destroy', ['isbn' => $book->isbn]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" role="button">Delete Book</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="col-sm-6">
                        <div class="text-right">
                            <button class="btn btn-warning" disabled>Edit</button>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="text-right">
                            <button class="btn btn-danger" disabled>Delete Book</button>
                        </div>
                    </div>
                    @endif
                    @endauth
                    @guest
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection