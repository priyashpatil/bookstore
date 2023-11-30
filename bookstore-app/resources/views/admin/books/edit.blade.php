@extends('layouts.admin')

@section('content')

    <div class="pt-3">
        <a href="{{route('admin.books.show', $book->id)}}">&larr; Back to Book</a>
        <h1 class="h2">Edit Book</h1>
    </div>

    <form action="{{route('admin.books.update', $book->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                   required value="{{old('title', $book->title)}}">

            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="author">Author</label>
                    <input id="author" name="author" type="text"
                           class="form-control @error('author') is-invalid @enderror"
                           required value="{{old('author', $book->author)}}">

                    @error('author')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="genre">Genre</label>
                    <input id="genre" name="genre" type="text" class="form-control @error('genre') is-invalid @enderror"
                           required value="{{old('genre', $book->genre)}}">

                    @error('genre')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="isbn">ISBN</label>
                    <input id="isbn" name="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror"
                           required value="{{old('isbn', $book->isbn)}}" minlength="13" maxlength="13">

                    @error('isbn')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="image">Image</label>
                    <input id="image" name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                           accept="image/*">

                    @error('image')
                    <div class="text-danger">{{$message}}</div>
                    @enderror

                    <img src="{{$book->image}}" alt="book image" width="100px">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="published">Published</label>
                    <input id="published" name="published" type="date"
                           class="form-control @error('published') is-invalid @enderror"
                           required value="{{old('published', $book->published->format('Y-m-d'))}}">

                    @error('published')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="publisher">Publisher</label>
                    <input id="publisher" name="publisher" type="text"
                           class="form-control @error('publisher') is-invalid @enderror"
                           required value="{{old('publisher', $book->publisher)}}">

                    @error('publisher')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="desc">Description</label>
            <textarea id="desc" name="desc" type="date" class="form-control @error('desc') is-invalid @enderror"
                      required rows="10">{{old('desc', $book->desc)}}</textarea>

            @error('desc')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
