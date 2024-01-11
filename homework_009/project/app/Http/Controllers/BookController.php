<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request): Book|string
    {
        try {
            $book = $request->getModelFromRequest();
            $book->save();
            return $book;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): Book
    {
        return $book;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): Book|string
    {
        try {
            return $request->updateModel($book);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): string
    {
        try {
            $book->delete();
            return 'Book deleted successfully';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
