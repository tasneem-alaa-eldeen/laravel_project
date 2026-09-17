<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        @if($order)
            <div class="card p-4 shadow-sm">
    <h2>Order Details #{{ $order->id }}</h2>
    <hr>
    <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
    <p><strong>Order Date:</strong> {{ $order->created_at ? $order->created_at->format('Y-m-d H:i A') : 'N/A' }}</p>
    <p><strong>Status:</strong> <span class="badge bg-primary">{{ $order->status }}</span></p>
    <p><strong>Total Price:</strong> {{ $order->total }} EGP</p>
</div>
        @else
            <div class="alert alert-danger">Order Not Found!</div>
        @endif
    </div>
</body>
</html>