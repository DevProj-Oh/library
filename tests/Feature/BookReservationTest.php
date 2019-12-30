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
        $response = $this->post(route('books.store'), [
            'title' => 'Cool Book Title',
            'author' => 'hui-ho',
        ]);

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect(route('books.show', $book));
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
        $book = factory(Book::class)->create();

        $response = $this->patch(route('books.update', $book), [
            'title' => 'New Title',
            'author' => 'New Author',
        ]);

        $book->refresh();
        $this->assertEquals('New Title', $book->title);
        $this->assertEquals('New Author', $book->author);
        $response->assertRedirect(route('books.show', $book));
    }

    /**
     * @test
     */
    public function a_book_can_be_deleted_test()
    {
        $book = factory(Book::class)->create();
        $this->assertCount(1, Book::all());

        $response = $this->delete(route('books.destroy', $book));

        $this->assertCount(0, Book::all());
        $response->assertRedirect(route('books.index'));
    }
}
