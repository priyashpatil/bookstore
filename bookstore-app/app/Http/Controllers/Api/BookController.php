<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::search($request->query('q'))->paginate();

        return BookResource::collection($books);
    }

    public function show(Request $request, Book $book)
    {
        return new BookResource($book);
    }
}
