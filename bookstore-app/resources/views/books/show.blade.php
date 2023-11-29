@extends('layouts.site')

@section('content')
    <div class="container py-3" style="max-width: 720px;">
        <div class="mb-3">
            <a href="{{route('home')}}">&larr; Back to home</a>
        </div>

        <div class="card mb-2">
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

        <h2 class="h4">Description</h2>
        <div>{{$book->desc}}</div>
    </div>
@endsection