<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = array(
            "status_code" => 200,
            "status" => "success",
            "data" => Book::all()
        );
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }

    /*
    *   Handles Request to external resources
    *
    */
    public function external()
    {
        //  Check query string for present parameters

        //  Assign them to variables

        //  Make external request with query data
        $response = Http::get('https://www.anapioficeandfire.com/api/books');

        if ($response->failed()) {
            return $response->json(["message" => "An error occured. Please try again later"], 500);
        }

        //  Store fire and ice api response
        $unfiltered = $response->json();

        //  Filter the response to specification

        $filtered = collect($unfiltered)->map(function ($book) {
            return [
                "name" => $book['name'],
                "isbn" => $book['isbn'],
                "authors" => $book['authors'],
                "number_of_pages" => $book["numberOfPages"],
                "publisher" => $book["publisher"],
                "country" => $book["country"],
                "release_date" => $book["released"]
            ];
        });

        //  Assemble filterd data with other requirements
        $data = [
            "status_code" => 200,
            "status" => "success",
            "data" => $filtered
        ];

        // Send Filtered data
        return $data;
    }
}
