<?php

Route::resource('books', 'BooksController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
