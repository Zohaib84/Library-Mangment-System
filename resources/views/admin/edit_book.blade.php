<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="file"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group img {
            max-width: 150px;
            margin-top: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">

                  @if(session('message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session()->get('message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                  </div>
              @endif
                    <div class="form-container">
                        <h1>Update Book</h1>
                        <form action="{{ url('update_book', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Book Title</label>
                                <input type="text" name="title" value="{{$book->title}}" required>
                            </div>

                            <div class="form-group">
                                <label>Author Name</label>
                                <input type="text" name="author_name" value="{{$book->author_name}}" required>
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" value="{{$book->price}}" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="4" required>{{$book->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" value="{{$book->quantity}}" required>
                            </div>

                            <div>
                              <label>Category</label>
                              <select name="category">
                                <option value="{{ $book->category_id }}">{{ $book->category->cat_title }}</option>
                                @foreach ($category as $category)
                                  <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                                @endforeach
                              </select>
                            </div>
                            

                            <div class="form-group">
                                <label>Author Image</label>
                                <img src="/author/{{$book->author_img}}" alt="Author Image">
                            </div>

                            <div class="form-group">
                                <label>Change Author Image</label>
                                <input type="file" name="author_img">
                            </div>

                            <div class="form-group">
                                <label>Book Image</label>
                                <img src="/book/{{$book->book_img}}" alt="Book Image">
                            </div>

                            <div class="form-group">
                                <label>Change Book Image</label>
                                <input type="file" name="book_img">
                            </div>

                            <input type="submit" class="btn btn-success" value="Update Book">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
