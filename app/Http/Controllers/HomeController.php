<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Function to display all books
    public function index()
    {
        $data = Book::all(); // Use meaningful variable names
        return view('home.index', compact('data')); // Passing as 'books' to view
    }

    // Function to handle borrowing a book
    public function borrow_book($id)
    {
        $book = Book::find($id); // Using a meaningful variable name
        if (!$book) {
            return redirect()->back()->with('message', 'Book not found');
        }

        // Check if the book is available in stock
        if ($book->quantity >= 1) {
            if (Auth::check()) { // Better readability, checks if the user is logged in
                $borrow = new Borrow();
                $borrow->book_id = $id;
                $borrow->user_id = Auth::id(); // No need to store $user_id separately
                $borrow->save();

                return redirect()->back()->with('message', 'A request was sent to the admin to borrow the book');
            } else {
                return redirect('/login'); // Redirect to login if not authenticated
            }
        } else {
            return redirect()->back()->with('message', 'Book is not available');
        }
    }

    public function book_history()
    {
        if(Auth::id())
        {
            $userid = Auth::user()->id;
            // Eager load the related book data
            $data = Borrow::where('user_id', '=', $userid)
                            ->with('book') // This loads the related book for each borrow record
                            ->get();
    
            return view('home.book_history', compact('data'));
        }
    
        // Optionally, handle the case where the user is not authenticated
        return redirect()->route('login'); // Or whatever you prefer
    }
    

    public function cancel_req($id)
    {
        $borrow = Borrow::find($id);
    
        if ($borrow) {
            $borrow->delete();
            return redirect()->back()->with('message', 'Book Borrowed Request Canceled Successfully');
        }
    
        return redirect()->back()->with('error', 'Borrow request not found');
    }

    public function explore()
    {
        $category = Category::all();
        $data = Book::all();
        return view('home.explore', compact('data', 'category'));
    }

    public function search(Request $request)
    {   
        $category = Category::all();
        $search = $request->search;
        $data = Book::where('title', 'LIKE', '%'.$search. '%')->orWhere('author_name', 'LIKE', '%'.$search. '%')->get();
        return view('home.explore', compact('data', 'category'));
    }

    public function cat_search($id)
    {
        $category = Category::all();
        $data = Book::where('category_id', $id)->get();
        return view('home.explore', compact('data', 'category'));
    }
    
}
