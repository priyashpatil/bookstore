<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container py-3" style="max-width: 720px;">
    <h1>Welcome to BookStore</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam aperiam dolores id, illum
        laudantium molestias obcaecati reprehenderit sed voluptatum? Deserunt dolore dolorum ducimus eius exercitationem
        fuga, nulla omnis vel?</p>

    <form method="GET" class="mb-3">
        <div class="mb-3">
            <label for="searchInput" class="form-label">Search</label>
            <input class="form-control" id="searchInput" name="q" type="search" required
                   placeholder="Search by title, author, isbn">
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
        @if(request()->query('q'))
            <button type="reset" class="btn btn-secondary">Reset</button>
        @endif
    </form>

    @if(count($books))
        <div class="mb-3">
            {{ $books->links() }}
        </div>
        @foreach($books as $book)
            <div class="row mb-2">
                <div class="col-md-4">
                    <img class="img-fluid" src="{{ $book->image }}" alt="{{ $book->title }}">
                </div>
                <div class="col-md-8">
                    <h3>{{ $book->title }}</h3>
                    <div><b>Author:</b> {{ $book->author }}</div>
                    <div><b>Genre:</b> {{ $book->genre }}</div>
                    <div><b>Published:</b> {{$book->published->format('d-m-Y')}}</div>
                    <div><b>Publisher:</b> {{$book->publisher}}</div>
                    <div><b>ISBN:</b> {{$book->isbn}}</div>
                </div>
            </div>
        @endforeach

        <div class="mt-3">
            {{ $books->links() }}
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
