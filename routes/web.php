<?php

Route::resource('books', 'BooksController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

Route::post('authors', 'AuthorsController@store')->name('authors.store');
