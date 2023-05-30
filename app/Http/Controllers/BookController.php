<?php

namespace App\Http\Controllers;

use App\Model;

use Illuminate\Http\Request;
use App\Http\Requests\BookPostRequest;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{

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

        return view('index', compact('books', 'trashedBooks'));
    }

    public function detail($isbn)
    {
        $book = Book::with('author')->find($isbn);

        if (!$book) {
            abort('404');
        }

        return view('detail', compact('book'));
    }

    public function create()
    {
        $authors = Author::all();

        return view('create', compact('authors'));
    }

    public function store(BookPostRequest $request)
    {
        $validated = $request->validated();

        if (!$validated) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['failed_add' => 'Data failed to be stored!']);
        }

        $book = new Book($validated);
        $book->user_id = auth()->user()->id;
        $book->save();

        return redirect()
            ->route('books.index')
            ->with('success_add', 'Data stored successfully!');
    }

    public function edit($isbn)
    {
        $authors = Author::all();
        $book = Book::with('author')->find($isbn);

        $this->authorize('edit-update-delete-book', $book);

        return view('edit', compact('book', 'authors'));
    }

    public function update(BookPostRequest $request)
    {
        $book = Book::where('isbn', $request->isbn)->first();

        $this->authorize('edit-update-delete-book', $book);

        $validated = $request->validated();

        if (!$validated) {
            return redirect()
                ->back()
                ->withInput()
                ->with('failed_update', 'Data failed to be updated!');
        }

        $book->update($validated);
        return redirect()
            ->route('books.detail', ['isbn' => $book['isbn']])
            ->with('success_update', 'Data updated successfully!');
    }

    public function destroy($isbn)
    {
        $book = Book::find($isbn);

        $this->authorize('edit-update-delete-book', $book);

        if (!$book) {
            abort('404');
        }

        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success_delete', 'Data deleted successfully!');
    }
}
