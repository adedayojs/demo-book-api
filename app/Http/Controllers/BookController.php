<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    private function validator($data, $id = null)
    {
        // dd($id);
        return Validator::make($data, [
            'name' => ['required', 'max:255', Rule::unique('books')->ignore($id)],
            'isbn' => ['required', Rule::unique('books')->ignore($id)],
            'authors' => 'required',
            'country' => 'required',
            'number_of_pages' => 'required|integer',
            'publisher' => 'required',
            'release_date' => 'required|date_format:Y-m-d',
        ]);
    }
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


        //  Validate That the request incoming is posses Valid data
        $validate_object = $this->validator($request->all());

        //  If object is invalid return the errors
        if ($validate_object->fails()) {
            return response($validate_object->errors(), 400);
        }

        //  Proceed to save if object is valid
        $book = new Book($request->all());
        $book->save();

        //  Assemble new book data with other requirements
        $data = [
            "status_code" => 201,
            "status" => "success",
            "data" => $book
        ];

        return response($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $book = Book::find($id);

        //  Assemble book data if present with other requirements
        $data = [
            "status_code" => 200,
            "status" => "success",
            "data" => $book
        ];

        return $data;
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
        //  Validate That the request incoming is posses Valid data
        $validate_object = $this->validator($request->all(), $book->id);

        //  If object is invalid return the errors
        if ($validate_object->fails()) {
            return response($validate_object->errors(), 400);
        }


        // Update Our Book
        $book->update($request->all());

        //  Assemble our data with other requirements
        $data = [
            "status_code" => 200,
            "status" => "success",
            "message" => 'The Book ' . $book->name . ' was updated successfully',
            "data" => $book
        ];

        return $data;
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
        $book_name = $book->name;

        Book::destroy($book->id);

        return array(
            "status_code" => 204,
            "status" => "success",
            "message" => 'The Book ' . $book_name . ' was deleted successfully',
            "data" => []
        );
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
                "release_date" => Carbon::createFromDate($book["released"])->format('Y-m-d')
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
