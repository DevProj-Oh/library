<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;

class BooksController extends Controller
{
    public function store(BookRequest $request)
    {
        Book::create($request->input());
    }

    public function update(Book $book, BookRequest $request)
    {
        $book->update($request->validated());
    }
}
