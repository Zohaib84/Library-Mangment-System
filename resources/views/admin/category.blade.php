<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <!-- SweetAlert2 Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }

        .form-container, .table-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .form-container h1 {
            margin-bottom: 30px;
            font-size: 26px;
            font-weight: 600;
            color: #333;
        }

        .form-container label {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }

        .form-container input[type="text"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .form-container input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f7f7f7;
            font-weight: 600;
            color: #333;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-danger {
            padding: 8px 15px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .form-container input[type="submit"], .btn-danger {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')

        <div class="page-content p-4">
            <div class="container-fluid">
                <div class="form-container">
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
                        </div>
                    @endif

                    <h1>Add New Category</h1>
                    <form action="{{ url('add_category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category">Category Name</label>
                            <input type="text" id="category" name="category" class="form-control" required>
                        </div>
                        <input type="submit" value="Add Category" class="btn btn-success">
                    </form>
                </div>

                <!-- Table Container -->
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->cat_title }}</td>

                                <td>
                                    <a class="btn btn-info" href="{{url('cat_edit', $data->id)}}">Update</a>
                                </td>
                                <td>
                                    <a onclick="confirmation(event)" class="btn btn-danger" href="{{url('cat_delete', $data->id)}}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')

    <script type="text/javascript">
    function confirmation(ev) { 
        ev.preventDefault(); 
        var urlToRedirect = ev.currentTarget.getAttribute('href'); 
        console.log(urlToRedirect); 
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
