<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::all();
        if(is_null($books)){
            return response()->json(['message'=>"Data not found",'status_code'=>404],404);
        }
        return response()->json($books);
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
        $validation=Validator::make($request->all(),[
            'title'=>'required|string|max:100|unique',
            'author'=>'required|string|max:100',
            'isbn'=>'required|string|max:20',
            'is_available'=>'required|boolean'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $book=Book::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'isbn'=>$request->isbn,
            'is_available'=>$request->is_available
        ]);
        return response()->json($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validation=Validator::make($request->all(),[
            'title'=>'required|string|max:100|unique',
            'author'=>'required|string|max:100',
            'isbn'=>'required|string|max:20',
            'is_available'=>'required|boolean'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $book->title=$request->title;
        $book->author=$request->author;
        $book->isbn=$request->isbn;
        $book->is_available=$request->is_available;
        $book->save();
        return response()->json('Book is updated successfully.',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json('Book is successfully deleted.');
    }
}
