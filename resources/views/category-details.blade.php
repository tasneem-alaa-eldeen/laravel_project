<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1 class="text-danger mb-4">All Categories</h1>

    <table class="table table-bordered align-middle mb-5">
        <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>Description</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ url('/categories') }}" class="btn btn-info btn-sm text-white">Back</a>
                    <a href="{{ url('/categories/' . $category->id . '/edit') }}" class="btn btn-info btn-sm text-white">Edit</a>
                    <form action="{{ url('/categories/' . $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

    <h2 class="fw-bold mb-3">All Category Products</h2>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Id</th>
                <th>Poduct name</th>
                <th>Product Description</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($category->products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    <a href="{{ url('/products/' . $product->id) }}" class="text-primary text-decoration-underline">
                        {{ $product->name }}
                    </a>
                </td>
                <td>{{ $product->description }}</td>
                <td>
                    <a href="{{ url('/categories') }}" class="btn btn-info btn-sm text-white">Back</a>
                    <a href="{{ url('/products/' . $product->id . '/edit') }}" class="btn btn-info btn-sm text-white">Edit</a>
                    <form action="{{ url('/products/' . $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No products found in this category.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>