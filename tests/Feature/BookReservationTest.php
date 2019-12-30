<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_book_can_be_added_to_the_library()
    {
        $response = $this->post('books', [
            'title' => 'Cool Book Title',
            'author' => 'hui-ho',
        ]);

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect('books/' . $book->id);
    }

    /**
     * @test
     */
    public function a_title_is_required()
    {
        $response = $this->post('books', [
            'title' => '',
            'author' => 'hui-ho',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function a_author_is_required()
    {
        $response = $this->post('books', [
            'title' => 'Cool Book Title',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    /**
     * @test
     */
    public function a_book_can_be_updated()
    {
        $this->post('books', [
            'title' => 'Cool Book Title',
            'author' => 'hui-ho',
        ]);

        $book = Book::first();

        $response = $this->patch('books/' . $book->id, [
            'title' => 'New Title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
        $response->assertRedirect('books/' . $book->id);
    }

    /**
     * @test
     */
    public function a_book_can_be_deleted()
    {
        $this->post('books', [
            'title' => 'Cool Book Title',
            'author' => 'hui-ho',
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response = $this->delete('books/' . $book->id);

        $this->assertCount(0, Book::all());
        $response->assertRedirect('books');
    }
}
