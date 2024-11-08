@extends('layouts.admin')

@section('content')
    <h1 class="h2 pt-3">Add a Book</h1>

    <form action="{{route('admin.books.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                   required value="{{old('title')}}">

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
                           required value="{{old('author')}}">

                    @error('author')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="genre">Genre</label>
                    <input id="genre" name="genre" type="text" class="form-control @error('genre') is-invalid @enderror"
                           required value="{{old('genre')}}">

                    @error('genre')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="isbn">ISBN</label>
                    <input id="isbn" name="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror"
                           required value="{{old('isbn')}}" minlength="13" maxlength="13">

                    @error('isbn')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="image">Image</label>
                    <input id="image" name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                           required accept="image/*">

                    @error('image')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="published">Published</label>
                    <input id="published" name="published" type="date"
                           class="form-control @error('published') is-invalid @enderror"
                           required value="{{old('published')}}">

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
                           required value="{{old('publisher')}}">

                    @error('publisher')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="price">Price</label>
                    <input id="price" name="price" type="number" placeholder="100.00"
                           class="form-control @error('price') is-invalid @enderror"
                           required value="{{old('price')}}">

                    @error('price')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label" for="sale_price">Sale Price</label>
                    <input id="sale_price" name="sale_price" type="number" placeholder="90.00"
                           class="form-control @error('sale_price') is-invalid @enderror"
                           required value="{{old('sale_price')}}">

                    @error('sale_price')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="desc">Description</label>
            <textarea id="desc" name="desc" type="date" class="form-control @error('desc') is-invalid @enderror"
                      required>{{old('desc')}}</textarea>

            @error('desc')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
