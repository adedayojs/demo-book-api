<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
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
        $response_structure = [

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
        $this->json('POST', 'api/v1/book', $payload)
            ->assertStatus(201)->assertJsonStructure($response_structure);
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
        $this->postJson('api/v1/', $payload)
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
        $this->postJson('api/external-books')
            ->assertStatus(200);
    }
}
