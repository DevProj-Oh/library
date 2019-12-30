<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;

class BooksController extends Controller
{
    public function store(BookRequest $request)
    {
        $book = Book::create($request->validated());

        return redirect(route('books.show', $book));
    }

    public function update(Book $book, BookRequest $request)
    {
        $book->update($request->validated());

        return redirect(route('books.show', $book));
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect(route('books.index'));
    }
}
