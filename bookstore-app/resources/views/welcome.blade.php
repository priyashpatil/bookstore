@extends('layouts.site')

@section('content')
    <div class="container py-3" style="max-width: 720px;">
        <h1>Welcome to BookStore</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam aperiam dolores id, illum
            laudantium molestias obcaecati reprehenderit sed voluptatum? Deserunt dolore dolorum ducimus eius
            exercitationem fuga, nulla omnis vel?</p>

        <hr>

        @if(count($books))
            <div class="mb-3">
                {{ $books->links() }}
            </div>
            @foreach($books as $book)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid" src="{{ $book->image }}" alt="{{ $book->title }}">
                            </div>
                            <div class="col-md-9">
                                <h3><a href="{{route('books.show', $book->id)}}">{{ $book->title }}</a></h3>
                                <div><b>Author:</b> {{ $book->author }}</div>
                                <div><b>Genre:</b> {{ $book->genre }}</div>
                                <div><b>Published:</b> {{$book->published->format('d-m-Y')}}</div>
                                <div><b>Publisher:</b> {{$book->publisher}}</div>
                                <div><b>ISBN:</b> {{$book->isbn}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                {{ $books->links() }}
            </div>
        @else
            <div class="text-center">
                <div class="fs-3">We seems to run out of titles</div>
                <div>Try searching for another keyword.</div>
            </div>
        @endif
    </div>
@endsection
