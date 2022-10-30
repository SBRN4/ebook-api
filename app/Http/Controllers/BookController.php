<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = book::all();
        // return $data;
        return response()->json([
            "message" => "Load data success",
            "data" => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = book::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'publisher' => $request->publisher
        ]);

        return response()->json([
            'data' => $book
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(book $book)
    {
        return response()->json([
            'data' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book $book)
    {
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->save();

        return response()->json([
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'book delete'
        ], 204);
    }
}
