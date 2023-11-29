<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $books = Book::when($request->has('q'), function ($q) use ($request) {
            $query = $request->query('q');
            $q->where('title', 'like', "%$query%");
        })->latest()->paginate();

        return view('welcome', compact('books'));
    }
}
