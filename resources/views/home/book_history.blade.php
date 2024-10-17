<!DOCTYPE html>
<html lang="en">
  <head>
    @include('home.css')

    <style>
      /* General page styling */
      body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        color: #333;
      }

      /* Table styling */
      table {
        width: 80%; /* Make the table width smaller */
        margin: 0 auto; /* Center the table horizontally */
        border-collapse: collapse;
        font-size: 1.2em;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
      }

      th, td {
        padding: 12px 15px;
        text-align: left;
      }

      th {
        background-color: #6c63ff;
        color: white;
      }

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      tr:hover {
        background-color: #ddd;
      }

      td img {
        width: 100px;
        height: auto;
        border-radius: 5px;
      }

      /* Center the table within the container */
      .table-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 0;
      }

      /* Success message styling */
      .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        border-radius: 5px;
        padding: 15px;
        margin: 20px auto; /* Auto margin to center */
        font-size: 1.1em;
        text-align: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        width: 80%; /* Match the table width */
      }

      /* Close button styling */
      .alert-success .close {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #155724;
        cursor: pointer;
      }

      /* Button hover effect */
      .alert-success .close:hover {
        color: #0b2e13;
      }

      /* Responsive styling */
      @media (max-width: 768px) {
        table {
          font-size: 1em;
        }

        th, td {
          padding: 8px 10px;
        }
      }

    </style>
  </head>

  <body>
    <!-- ***** Header Area Start ***** -->
    @include('home.header')
    <!-- ***** Header Area End ***** -->

    <!-- Success message displayed below the menu -->
    <div class="currently-market">
      @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session()->get('message') }}
          <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endif
    </div>

    <div class="currently-market">
      <div class="table-container">
    
        <table>
            <tr>
                <th>Book Name</th>
                <th>Book Author</th>
                <th>Book Status</th>
                <th>Image</th>
                <th>Cancel Request</th>
            </tr>
        
            @foreach ($data as $borrow)
              <tr>
                <td>{{ $borrow->book->title ?? 'No Title Available' }}</td>
                <td>{{ $borrow->book->author_name ?? 'Unknown Author' }}</td>
                <td>{{ $borrow->status }}</td>
                <td>
                  @if ($borrow->book && $borrow->book->book_img)
                    <img src="{{ asset('book/' . $borrow->book->book_img) }}" alt="Book Image">
                  @else
                    <p>No Image Available</p>
                  @endif
                </td>
                <td>
                    @if ($borrow->status == 'Applied')
                        
                    
                    <a href="{{url('cancel_req', $borrow->id)}}" class="btn btn-warning">Cancel</a>
                    @else  
                    <p style="color: black; font-weight: bold;">Not Allowed</p>
                    @endif
                </td>
              </tr>
            @endforeach
        </table>
        
      </div>
    </div>

    @include('home.footer')
  </body>
</html>
