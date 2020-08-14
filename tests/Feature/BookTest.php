<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    protected $response_structure = [

        'status_code',
        'status',
        'data' => [
            'id',
            'name',
            'isbn',
            'authors',
            'country',
            'number_of_pages',
            'publisher',
            'release_date',
        ],
    ];
    protected $response_structure2 = [

        'status_code',
        'status',
        'data' => [
            [
                'name',
                'isbn',
                'authors',
                'country',
                'number_of_pages',
                'publisher',
                'release_date',
            ]
        ],
    ];
    /**
     * A basic feature test .
     *
     * @return void
     * @test
     */
    public function testGetRoute()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/v1/book');

        $response->assertStatus(200);
    }


    /**
     *  POST /api/v1/books
     *  without payload
     *
     * @return void
     * @test
     */
    public function without_any_payload()
    {
        //  Should return 400
        $this->json('POST', 'api/v1/book')
            ->assertStatus(400);
    }


    /**
     *  POST /api/v1/books
     *  with any payload
     *
     * @return void
     * @test
     */
    public function with_valid_payload()
    {
        //  Should Return status 201 and created data
        $payload = array(
            "name" => "seventh",
            "isbn" => "7",
            "authors" => ["dsgdg", "dafs"],
            "country" => "Nigeria",
            "number_of_pages" => 345,
            "publisher" => "Adedayojs",
            "release_date" => "2009-03-05"
        );

        $this->json('POST', 'api/v1/book', $payload)
            ->assertStatus(201)->assertJsonStructure($this->response_structure);
    }


    /**
     *  POST /api/v1/books
     *  with invalid payload
     *
     * @return void
     * @test
     */
    public function with_invalid_payload()
    {
        //  Should Return status 201 and created data
        $payload = array(
            "name" => "seventh",
            "isbn" => "7",
            "authors" => ["dsgdg", "dafs"],
            "country" => "Nigeria",
            "number_of_pages" => 345,
            "publisher" => "Adedayojs",
        );
        $this->postJson('api/v1/book', $payload)
            ->assertStatus(400);
    }


    /**
     *  GET /api/external-books
     *
     *
     * @return void
     * @test
     */
    public function should_return_external_books()
    {
        //  Should Return status 200
        $this->get('api/external-books')
            ->assertStatus(200)->assertJsonStructure($this->response_structure2);
    }

    /**
     *  DELETE /api/books/:id
     *
     *
     * @return void
     * @test
     */
    public function should_delete_books()
    {
        $book = factory(Book::class)->create();

        //  Should Return status 200
        $this->json('DELETE', '/api/v1/book/' . $book->id)
            ->assertStatus(204);
    }



    /**
     *  PATCH /api/books/:id
     *
     *
     * @return void
     * @test
     */
    public function should_update_books()
    {
        $book = factory(Book::class)->create()->toArray();
        //  Edit same model
        $book['isbn'] = 'edited';

        //  Should Return status 200
        $this->json('PATCH', '/api/v1/book/' . $book['id'], $book)
            ->assertStatus(200)->assertJsonStructure($this->response_structure);
    }
}
