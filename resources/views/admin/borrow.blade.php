<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style>
      body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
      }
      .page-header {
        margin-bottom: 20px;
      }
      .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
      }
      h2 {
        font-size: 28px;
        font-weight: bold;
        color: #333;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
      }
      table th, table td {
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
        text-align: left;
      }
      table th {
        background-color: #007bff;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
      }
      table tr:hover {
        background-color: #f1f1f1;
      }
      table tr:last-child td {
        border-bottom: none;
      }
      .book-image img {
        max-width: 80px;
        border-radius: 8px;
      }
      .btn {
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 4px;
        text-decoration: none;
        color: #fff;
      }
      .btn-success {
        background-color: #28a745;
        border: none;
      }
      .btn-danger {
        background-color: #dc3545;
        border: none;
      }
      .btn-info {
        background-color: #17a2b8;
        border: none;
      }
      .btn:hover {
        opacity: 0.8;
      }
      @media (max-width: 768px) {
        table, table tr, table td, table th {
          display: block;
          width: 100%;
        }
        table th {
          position: absolute;
          top: -9999px;
          left: -9999px;
        }
        table td {
          border: none;
          position: relative;
          padding-left: 50%;
          text-align: right;
        }
        table td:before {
          content: attr(data-label);
          position: absolute;
          left: 15px;
          font-weight: bold;
          text-transform: uppercase;
        }

        
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
            <h2 class="mb-4">Borrowed Book Details</h2>
            <table>
              <thead>
                <tr>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Book Title</th>
                  <th>Quantity</th>
                  <th>Status</th>
                  <th>Book Image</th>
                  <th>Change Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($borrow as $borrow)
                <tr>
                  <td data-label="User Name">{{ $borrow->user->name }}</td>
                  <td data-label="Email">{{ $borrow->user->email }}</td>
                  <td data-label="Phone">{{ $borrow->user->phone }}</td>
                  <td data-label="Book Title">{{ $borrow->book->title }}</td>
                  <td data-label="Quantity">{{ $borrow->quantity }}</td>
                  <td data-label="Status">{{ $borrow->status }}</td>
                  <td data-label="Book Image" class="book-image">
                    <img src="book/{{ $borrow->book->book_img }}" alt="{{ $borrow->book->title }}">
                  </td>
                  <td data-label="Change Status">
                    <a href="{{url('approve_book',$borrow->id)}}" class="btn btn-success">Approved</a>
                    <a href="{{url('reject_book',$borrow->id)}}" class="btn btn-danger">Rejected</a>
                    <a href="{{url('return_book',$borrow->id)}}" class="btn btn-info">Returned</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    @include('admin.footer')
  </body>
</html>
