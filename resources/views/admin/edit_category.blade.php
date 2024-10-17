<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style>
        /* General Page Styling */
        body {
            background-color: #f4f7f6;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header h1,
        .page-header h2 {
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }

        /* Form Container Styling */
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .form-container h2 {
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
            color: #333;
        }

        .form-container input[type="text"] {
            padding: 12px 15px;
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .form-container input[type="submit"] {
            padding: 12px 30px;
            background-color: #17a2b8;
            border: none;
            color: white;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: #138496;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            th, td {
                padding: 10px;
                font-size: 14px;
            }

            .form-container input[type="submit"] {
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
                <!-- Update Category Form -->
                <div class="form-container">
                    <h2>Update Category</h2>
                    <form action="{{ url('update_category', $data->id) }}" method="POST">
                        @csrf
                        <label for="cat_name">Category Name</label>
                        <input type="text" id="cat_name" name="cat_name" value="{{ $data->cat_title }}" required>
                        <input type="submit" class="btn btn-info" value="Update Category">
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
