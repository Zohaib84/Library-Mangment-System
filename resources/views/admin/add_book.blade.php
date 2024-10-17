<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Books</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    @include('admin.css')
    <style>
      .form-container {
        max-width: 700px;
        margin: 50px auto;
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .form-container h1 {
        margin-bottom: 20px;
        text-align: center;
        color: #333;
      }
      .form-group label {
        font-weight: bold;
      }
      .form-group input[type="file"], 
      .form-group textarea {
        padding: 6px;
      }
      .btn-primary {
        width: 100%;
        margin-top: 15px;
      }
    </style>
  </head>
  <body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
      @include('admin.sidebar')

      <div class="page-content">
        <div class="container-fluid">
          <div class="form-container">
            <h1>Add Books</h1>

            <form action="{{url('store_book')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label for="book_name">Book Title</label>
                <input type="text" id="book_name" name="book_name" class="form-control" placeholder="Enter book title" required />
              </div>

              <div class="form-group">
                <label for="author_name">Author Name</label>
                <input type="text" id="author_name" name="author_name" class="form-control" placeholder="Enter author name" required />
              </div>

              <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" class="form-control" placeholder="Enter price" required />
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" placeholder="Enter book description" rows="4" required></textarea>
              </div>

              <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control" required>
                  <option value="">Select a category</option>
                  @foreach ($data as $data)
                    <option value="{{$data->id}}">{{$data->cat_title}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Enter quantity" required />
              </div>

              <div class="form-group">
                <label for="book_img">Book Image</label>
                <input type="file" id="book_img" name="book_img" class="form-control-file" />
              </div>

              <div class="form-group">
                <label for="author_img">Author Image</label>
                <input type="file" id="author_img" name="author_img" class="form-control-file" />
              </div>

              <button type="submit" class="btn btn-primary">Add Book</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @include('admin.footer')

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
