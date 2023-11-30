<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::search($request->query('q'))->paginate();

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|min:13|max:13|unique:books,isbn',
            'genre' => 'required|string|max:50',
            'published' => 'required|date',
            'publisher' => 'required|string|max:255',
            'image' => 'required|image|max:5000',
            'desc' => 'required|string|max:2000',
            'price' => 'required|decimal:2',
            'sale_price' => 'required|decimal:2',
        ]);

        $validated['image'] = Storage::disk('public')
            ->url($request->file('image')
                ->store('book-covers', ['disk' => 'public']));

        $book = Book::create($validated);

        return redirect()->route('admin.books.show', $book->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => ['required', 'string', 'min:13', 'max:13', Rule::unique('books', 'isbn')->ignore($book->id)],
            'genre' => 'required|string|max:50',
            'published' => 'required|date',
            'publisher' => 'required|string|max:255',
            'image' => 'nullable|image|max:5000',
            'desc' => 'required|string|max:2000',
            'price' => 'required|decimal:2',
            'sale_price' => 'required|decimal:2',
        ]);

        if ($request->has('image')) {
            $validated['image'] = Storage::disk('public')
                ->url($request->file('image')
                    ->store('book-covers', ['disk' => 'public']));
        }

        $book->update($validated);

        return redirect()->route('admin.books.edit', $book->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index');
    }
}
