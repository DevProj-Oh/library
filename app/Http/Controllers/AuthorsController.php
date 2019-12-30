<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->validated());
    }
}
