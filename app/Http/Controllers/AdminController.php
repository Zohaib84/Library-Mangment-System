<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the main admin or user dashboard depending on the user type.
     */
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::id()) {
            // Get the user type of the authenticated user (either 'admin' or 'user')
            $usertype = Auth()->user()->user_type;

            // If the user is an admin, load the admin dashboard view
            if ($usertype === 'admin') {
                $user = User::all()->count();
                $book = Book::all()->count();
                $borrow = Borrow::where('status','approved')->count();
                $returned = Borrow::where('status','returned')->count();
                return view('admin.index', compact('user', 'book','borrow','returned'));
            } 
            // If the user is a regular user, load the user home page
            elseif ($usertype === 'user') {
                $data = Book::all();
                return view('home.index', compact('data'));
            }
        }

        // If the user is not authenticated or the user type is unknown, redirect back
        return redirect()->back();
    }

    /**
     * Display the category management page for the admin.
     */
    public function category_page()
    {
        // Retrieve all categories from the database
        $data = Category::all();

        // Return the category view and pass the retrieved data to it
        return view('admin.category', compact('data'));
    }

    /**
     * Add a new category to the database.
     */
    public function add_category(Request $request)
    {
        // Validate the request to ensure the category field is required, unique, and has a max length of 255 characters
        $request->validate([
            'category' => 'required|string|max:255|unique:categories,cat_title',
        ]);

        // Create a new instance of the Category model and save the data
        $data = new Category;
        $data->cat_title = $request->category;
        $data->save(); // Save the new category to the database

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('message', 'Category added successfully');
    }

    /**
     * Delete an existing category by its ID.
     */
    public function cat_delete($id)
    {
        // Find the category by its ID
        $data = Category::find($id);

        // Delete the category from the database
        $data->delete();

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    /**
     * Show the form for editing an existing category by its ID.
     */
    public function cat_edit($id)
    {
        // Find the category by its ID
        $data = Category::find($id);

        // Return the edit category view and pass the retrieved category data to it
        return view('admin.edit_category', compact('data'));
    }

    /**
     * Update an existing category in the database.
     */
    public function update_category(Request $request, $id)
    {
        // Find the category by its ID
        $data = Category::find($id);

        // Update the category title with the new value from the request
        $data->cat_title = $request->cat_name;

        // Save the updated category to the database
        $data->save();

        // Redirect to the category page with a success message
        return redirect('/category_page')->with('message', 'Category Updated Successfully');
    }

    // Add books in the database
    public function add_book()
    {
        $data = Category::all();
        return view('admin.add_book', compact('data'));
    }

    public function store_book(Request $request)
    {
        // Create a new Book object to save the data
        $data = new Book;
    
        // Assign form data to respective fields in the database
        $data->title = $request->book_name;
        $data->author_name = $request->author_name;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $data->category_id = $request->category;
    
        // Handle book image upload if it exists
        if ($request->hasFile('book_img')) {
            // Get the uploaded book image
            $book_image = $request->file('book_img');
    
            // Generate a unique file name using the current timestamp and original file extension
            $book_image_name = time() . '.' . $book_image->getClientOriginalExtension();
    
            // Move the uploaded image to the 'book' directory inside the public folder
            $book_image->move(public_path('book'), $book_image_name);
    
            // Save the book image path to the database
            $data->book_img = $book_image_name;
        }

        if ($request->hasFile('author_img')) {
            // Get the uploaded Author image
            $author_image = $request->file('author_img');
    
            // Generate a unique file name using the current timestamp and original file extension
            $author_image_name = time() . '.' . $author_image->getClientOriginalExtension();
    
            // Move the uploaded author to the 'author' directory inside the public folder
            $author_image->move(public_path('author'), $author_image_name);
    
            // Save the book author path to the database
            $data->author_img = $author_image_name;
        }
    
        // Save the book data into the database
        $data->save();
    
        // Redirect the user back to the previous page with a success message
        return redirect()->back()->with('message', 'Book added successfully!');
    }

    public function show_books()
    {
        $book = Book::all(); 
        return view('admin.show_books', compact('book'));
    }

    public function book_delete($id)
    {
        $data = Book::find($id);
        $data->delete();
        return redirect()->back()->with('message','Book deleted successfully');
    }

    public function edit_book($id)
    {
        // Find the book by its ID
        $book = Book::find($id);
        $category = Category::all();
    
        // Check if the book exists
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found');
        }
    
        // Return the edit view with the book data
        return view('admin.edit_book', compact('book','category'));
    }

    public function update_book(Request $request, $id)
{
    // Find the book by ID
    $data = Book::find($id);

    // Update basic fields
    $data->title = $request->title;
    $data->author_name = $request->author_name;
    $data->price = $request->price;
    $data->description = $request->description;
    $data->quantity = $request->quantity;
    $data->category_id = $request->category;

    // Handle the book image upload
    if ($request->hasFile('book_img')) {
        $book_image = $request->file('book_img');
        $book_image_name = time() . '_book.' . $book_image->getClientOriginalExtension();
        $book_image->move(public_path('book'), $book_image_name);
        $data->book_img = $book_image_name;
    }

    // Handle the author image upload
    if ($request->hasFile('author_img')) {
        $author_image = $request->file('author_img');
        $author_image_name = time() . '_author.' . $author_image->getClientOriginalExtension();
        $author_image->move(public_path('author'), $author_image_name);
        $data->author_img = $author_image_name;
    }

    // Save the updated data
    $data->save();

    // Redirect back to the books listing with success message
    return redirect('/show_books')->with('success', 'Book updated successfully');
}



    // Fetch all borrow requests
    public function borrow_request()
    {
        $borrow = Borrow::all();
        return view('admin.borrow', compact('borrow'));
    }

    // Approve the borrow request
    public function approve_book($id)
    {
        // Fetch the borrow request by ID
        $borrow = Borrow::find($id);
        
        if (!$borrow) {
            return redirect()->back()->withErrors(['Borrow record not found.']);
        }

        // Check if already approved
        if ($borrow->status == 'approved') {
            return redirect()->back()->with('message', 'The book is already approved.');
        }

        // Update status and decrease book quantity
        $this->updateBorrowStatus($borrow, 'approved');
        $this->updateBookQuantity($borrow->book_id, -1);

        return redirect()->back()->with('message', 'Book approved successfully.');
    }

    // Return the borrowed book
    public function return_book($id)
    {
        // Fetch the borrow request by ID
        $borrow = Borrow::find($id);
        
        if (!$borrow) {
            return redirect()->back()->withErrors(['Borrow record not found.']);
        }

        // Check if already returned
        if ($borrow->status == 'returned') {
            return redirect()->back()->with('message', 'The book is already returned.');
        }

        // Update status and increase book quantity
        $this->updateBorrowStatus($borrow, 'returned');
        $this->updateBookQuantity($borrow->book_id, 1);

        return redirect()->back()->with('message', 'Book returned successfully.');
    }

    // Reject the borrow request
    public function reject_book($id)
    {
        // Fetch the borrow request by ID
        $borrow = Borrow::find($id);
        
        if (!$borrow) {
            return redirect()->back()->withErrors(['Borrow record not found.']);
        }

        // Update status to rejected
        $this->updateBorrowStatus($borrow, 'rejected');

        return redirect()->back()->with('message', 'Borrow request rejected.');
    }

    // Helper method to update the borrow status
    private function updateBorrowStatus($borrow, $status)
    {
        $borrow->status = $status;
        $borrow->save();
    }

    // Helper method to update the book quantity
    private function updateBookQuantity($bookId, $change)
    {
        $book = Book::find($bookId);

        if (!$book) {
            throw new \Exception('Book record not found.');
        }

        $newQuantity = $book->quantity + $change;

        // Ensure book quantity doesn't go negative
        if ($newQuantity < 0) {
            throw new \Exception('Not enough books in stock.');
        }

        $book->quantity = $newQuantity;
        $book->save();
    }
}

