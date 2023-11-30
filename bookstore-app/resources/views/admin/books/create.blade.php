@extends('layouts.admin')

@section('content')
    <h1 class="h2 pt-3">Add a Book</h1>

    <form action="{{route('admin.books.store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input id="title" name="title" type="text" class="form-control" required value="{{old('title')}}">
        </div>

        <div class="mb-3">
            <label class="form-label" for="author">Author</label>
            <input id="author" name="author" type="text" class="form-control" required value="{{old('author')}}">
        </div>

        <div class="mb-3">
            <label class="form-label" for="genre">Genre</label>
            <input id="genre" name="genre" type="text" class="form-control" required value="{{old('genre')}}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection
