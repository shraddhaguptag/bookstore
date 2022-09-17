<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Elasticsearch;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allBooks()
    {
        $books = Books::orderBy('id', 'desc')
            ->paginate(10);

        return Inertia::render(
            'Customers/Books',
            [
                'books' => $books
            ]
        );
    }

    /**
     * Search Book with the help of elastic search
     * 
     * @return filter listing on basis of search
     */
    public function searchBooks(Request $request)
    {
        $q = $request->get('q');
        if ($q) {
            $response = Elasticsearch::search([
                'index' => 'books',
                'body'  => [
                    'query' => [
                        'multi_match' => [
                            'query' => $q,
                            'fields' => [
                                'title',
                                'genre',
                                'isbn',
                                'author',
                                'publication_date',
                            ]
                        ]
                    ]
                ]
            ]);

            $bookIds = array_column($response['hits']['hits'], '_id');
            $books = Books::query()->findMany($bookIds)->paginate(10);
        } else {
            $books = Books::orderBy('id', 'desc')->paginate(10);
        }

        return Inertia::render(
            'Customers/Books',
            [
                'books' => $books
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::orderBy('id', 'desc')
            ->paginate(10);


        return Inertia::render(
            'Bookstore/Index',
            [
                'books' => $books
            ]
        );
    }


    /** Create Book through Admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Bookstore/Create');
    }

    /**
     * Store a newly created book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'isbn' => 'required',
            'author' => 'required',
            'image_path' => 'required',
            'genre' => 'required',
        ]);
        Books::create([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'image_path' => $request->image_path,
            'author' => $request->author,
            'genre' => $request->genre
        ]);
        sleep(1);

        return redirect()->route('books.index')->with('message', 'Book Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $books)
    {
        return Inertia::render(
            'Bookstore/Edit',
            [
                'books' => $books
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $books)
    {
        $request->validate([
            'title' => 'required',
            'isbn' => 'required',
            'author' => 'required',
            'image_path' => 'required',
            'genre' => 'required',
        ]);

        $books->title = $request->title;
        $books->author = $request->author;
        $books->isbn = $request->isbn;
        $books->genre = $request->genre;
        $books->image_path = $request->image_path;
        $books->save();
        sleep(1);

        return redirect()->route('books.index')->with('message', 'Books Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $books)
    {
        $books->delete();
        sleep(1);

        return redirect()->route('books.index')->with('message', 'Book Delete Successfully');
    }
}
