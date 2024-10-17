<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- Include SweetAlert -->

    <style>
      /* Table styles for better aesthetics */
      table {
          width: 100%;
          border-collapse: collapse;
          margin: 20px 0;
          font-size: 18px;
          text-align: left;
      }

      th, td {
          padding: 12px;
          border-bottom: 1px solid #ddd;
      }

      th {
          background-color: #f4f4f4;
          font-weight: bold;
      }

      tr:hover { background-color: #f5f5f5; }

      .img_book, .img_author {
          width: 50px;
          height: 50px;
          object-fit: cover;
      }

      /* Responsive table styling */
      @media (max-width: 768px) {
          table, thead, tbody, th, td, tr {
              display: block;
              width: 100%;
          }

          tr {
              margin-bottom: 15px;
          }

          th {
              text-align: left;
              font-size: 16px;
              background-color: transparent;
          }

          td {
              font-size: 16px;
              border: none;
              padding-left: 50%;
              position: relative;
          }

          td:before {
              position: absolute;
              top: 0;
              left: 0;
              width: 45%;
              padding-left: 10px;
              font-weight: bold;
              text-align: left;
              background-color: #f9f9f9;
          }

          td:nth-of-type(1):before { content: "Book Title"; }
          td:nth-of-type(2):before { content: "Author Name"; }
          td:nth-of-type(3):before { content: "Price"; }
          td:nth-of-type(4):before { content: "Description"; }
          td:nth-of-type(5):before { content: "Quantity"; }
          td:nth-of-type(6):before { content: "Category"; }
          td:nth-of-type(7):before { content: "Book Image"; }
          td:nth-of-type(8):before { content: "Author Image"; }
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

            <!-- Session message check -->
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">×</button>
            </div>
            @endif

            <h1>List of Books</h1>
            <table>
              <thead>
                <tr>
                  <th>Book Title</th>
                  <th>Author Name</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Category</th>
                  <th>Book Image</th>
                  <th>Author Image</th>
                  <th>Delete</th>
                  <th>Update</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($book as $item)
                  <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->author_name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ Str::limit($item->description, 50) }}</td> <!-- Limits long text -->
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->category ? $item->category->cat_title : 'No Category' }}</td> <!-- Check if category exists -->
                    <td>
                      <img class="img_book" src="/book/{{ $item->book_img }}" alt="Book Image">
                    </td>
                    <td>
                      <img class="img_author" src="/author/{{ $item->author_img }}" alt="Author Image">
                    </td>
                    <td>
                        <a onclick="confirmation(event)"
                         href="{{ url('book_delete', $item->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                    <td>
                        <a href="{{ url('edit_book', $item->id) }}" class="btn btn-warning">Update</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      @include('admin.footer')
    </div>

    <!-- Confirmation script -->
    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect); // For debugging

            swal({
                title: "Are you sure you want to delete this?",
                text: "You will not be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
  </body>
</html>
