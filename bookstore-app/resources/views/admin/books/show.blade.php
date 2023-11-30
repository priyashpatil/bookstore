@extends('layouts.admin')

@section('content')
    <div class="container py-3" style="max-width: 720px;">

        <div class="mb-3 d-flex align-items-center justify-content-between">
            <a href="{{route('admin.books.index')}}">&larr; Back to books</a>
            <div>
                <a href="{{route('admin.books.edit', $book->id)}}" class="btn btn-primary">Edit Book</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete
                    Book
                </button>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" src="{{ $book->image }}" alt="{{ $book->title }}">
                    </div>
                    <div class="col-md-8">
                        <h1 class="h2">{{ $book->title }}</h1>
                        <div><b>Author:</b> {{ $book->author }}</div>
                        <div><b>Genre:</b> {{ $book->genre }}</div>
                        <div><b>Published:</b> {{$book->published->format('d-m-Y')}}</div>
                        <div><b>Publisher:</b> {{$book->publisher}}</div>
                        <div><b>ISBN:</b> {{$book->isbn}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h2 class="h4">Description</h2>
                <div>{{$book->desc}}</div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.books.destroy', $book->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Book</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Please confirm deleting the book. This action is irreversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
