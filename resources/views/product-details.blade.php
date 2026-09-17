<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        @if($product)
            <div class="card p-4 shadow-sm">
                <h2 class="text-success">{{ $product['name'] }}</h2>
                <p><strong>ID:</strong> {{ $product['id'] }}</p>
                <p><strong>Price:</strong> {{ $product['price'] }} EGP</p>
                <p><strong>Category:</strong> {{ $product['category'] }}</p>
                <p><strong>Description:</strong> {{ $product['desc'] }}</p>
                <a href="/products" class="btn btn-secondary mt-3">Back to Products</a>
            </div>
        @else
            <div class="alert alert-danger">Product Not Found!</div>
        @endif
    </div>
</body>
</html>