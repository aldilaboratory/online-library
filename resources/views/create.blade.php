@extends('layout')

@section('title', 'index')

@section('content')
<div class="container">
    @if ($errors->has('failed_add'))
    <div class="alert alert-danger alert-dismissable show" role="alert">
        {{ $errors->first('failed_add') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @auth
    <h3>Add New Book</h3>
    <form method="POST" action="{{ route('books.store') }}">
        @csrf
        <div class="form-group row">
            <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="isbn" placeholder="Input ISBN" name="isbn" value="{{ old('isbn') }}">
                @error('isbn')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" placeholder="Input Title" name="title" value="{{ old('title') }}">
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="author_id" class="col-sm-2 col-form-label">Author</label>
            <div class="col-sm-10">
                <select name="author_id" id="author_id" class="form-control">
                    @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                    @endforeach
                </select>
                @error('author_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="image_path" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image_path" name="image_path" value="{{ old('image_path') }}">
                @error('image_path')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="publisher" placeholder="Input Publisher" name="publisher" value="{{ old('publisher') }}">
                @error('publisher')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="category" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="category" placeholder="Input Category" name="category" value="{{ old('category') }}">
                @error('category')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="pages" class="col-sm-2 col-form-label">Pages</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="pages" placeholder="Input Pages" name="pages" value="{{ old('pages') }}">
                @error('pages')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="language" class="col-sm-2 col-form-label">Language</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="language" placeholder="Input Language" name="language" value="{{ old('language') }}">
                @error('language')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="publish_date" class="col-sm-2 col-form-label">Publish Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="publish_date" placeholder="Input Publish Date" name="publish_date" value="{{ old('publish_date') }}">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                @error('publish_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="subjects" class="col-sm-2 col-form-label">Subjects</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="subjects" placeholder="Input Subjects" name="subjects" value="{{ old('subjects') }}">
                @error('subjects')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="desc" class="col-sm-2 col-form-label">Desc</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="desc" placeholder="Input Desc" name="desc" value="{{ old('desc') }}">
                @error('desc')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="text-right">
                <button type="submit" class="btn btn-primary" name="submit">Add Book Data</button>
            </div>
        </div>
    </form>
    @endauth
</div>
@endsection