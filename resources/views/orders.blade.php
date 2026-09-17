<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <h2 class="mb-4 text-primary">Orders List</h2>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
<tr>
    <td>#{{ $order->id }}</td>
    <td>{{ $order->user->name ?? $order->customer_name ?? 'John Doe' }}</td>
    <td>{{ $order->total }} EGP</td>
    <td><span class="badge bg-secondary">{{ $order->status ?? 'Pending' }}</span></td>
    <td><a href="/orders/{{ $order->id }}" class="btn btn-sm btn-info text-white">View Details</a></td>
</tr>
@endforeach
            </tbody>
        </table>
    </div>
</body>
</html>