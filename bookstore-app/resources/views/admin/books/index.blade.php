@extends('layouts.admin')

@section('content')

    <div class="pt-3 mb-3 d-flex align-items-center justify-content-between">
        <h1 class="h2">Books</h1>
        <form>
            <input type="search" name="q" class="form-control" placeholder="Search" aria-label="Search"
                   value="{{request()->query('q')}}">
        </form>
    </div>

    <div class="mb-3">{{ $books->links() }}</div>

    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Published</th>
                <th scope="col">Genre</th>
            </tr>
            </thead>
            <tbody>

            @foreach($books as $book)
                <tr>
                    <td>{{$book->isbn}}</td>
                    <td><a href="{{route('admin.books.show', $book->id)}}">{{$book->title}}</a></td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->published->format('d-m-Y')}}</td>
                    <td>{{$book->genre}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $books->links() }}</div>

@endsection
