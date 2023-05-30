<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Http\Requests\BookPostRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $keyword = $request->search;
            $books = Book::where('isbn', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('publisher', 'LIKE', "%$keyword%")
                ->orWhere('category', 'LIKE', "%$keyword%")
                ->orWhere('subjects', 'LIKE', "%$keyword%")
                ->orWhere('desc', 'LIKE', "%$keyword%")
                ->orWhereHas('author', function ($query) use ($keyword) {
                    $query->where('author_name', 'LIKE', "%$keyword%");
                })
                ->with('author')
                ->paginate(12)
                ->appends(request()->except('page'));
        } else {
            $books = Book::with('author')->paginate(12);
        }

        $trashedBooks = Book::onlyTrashed()->get();

        return response()->json($books, $trashedBooks);
    }

    public function create(BookPostRequest $request)
    {
        $authors = Author::all();

        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validated();

        if (!$validated) {
            return redirect()
                ->back()
                ->withInput()
                ->with('failed_add', 'Data failed to be stored!');
        }

        $book = new Book($validated);
        $book->user_id = auth()->user()->id;
        $book->save();

        return response()->json(['success_add' => 'Data stored successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $isbn
     * @return \Illuminate\Http\Response
     */
    public function detail($isbn)
    {
        $book = Book::with('author')->find($isbn);

        if (!$book) {
            abort('404');
        }

        return
            response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $isbn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $isbn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $isbn
     * @return \Illuminate\Http\Response
     */
    public function destroy($isbn)
    {
        //
    }
}
