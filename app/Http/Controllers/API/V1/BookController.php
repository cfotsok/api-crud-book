<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\V1\BookRequest;
use App\Http\Resources\API\V1\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        return response()->json([
            'books' => $user->books()->paginate(20)
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $datas = $request->validate();
        $user = User::find(Auth::id());
        $book = new Book($datas);
        $user->books()->save($book);

        return response()->json([
            'message' => 'Book created successfully.'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book = Book::findOrFail($book);
        return response()->json([
            'book' => BookResource::make($book)
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        $book = Book::findOrFail($book);
        $book->update($request->validate());
        return response()->json([
            'message' => 'Book updated successfully.'
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book = Book::findOrFail($book);
        $book->delete();
        return response()->json([
            'message' => 'Book deleted successfully.'
        ], Response::HTTP_NO_CONTENT);
    }
}
