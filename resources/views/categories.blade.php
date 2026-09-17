<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1 class="text-danger mb-4">All Categories</h1>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>Description</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
    <a href="/categories/{{ $category->id }}" class="btn btn-sm btn-info text-white">View</a>
    <a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
    <form action="/categories/{{ $category->id }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
</td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>