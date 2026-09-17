<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1 class="text-danger mb-4">All Products</h1>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category Name</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    @if($product->category)
                        <a href="{{ url('/categories/' . $product->category->id) }}" class="text-primary text-decoration-underline">
                            {{ $product->category->name }}
                        </a>
                    @else
                        N/A
                    @endif
                <td>
    <a href="/products/{{ $product->id }}" class="btn btn-sm btn-info text-white">View</a>
    <a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>