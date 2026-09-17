<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px; background-color: #f9fafb;">

    @if($user)
        <h2 style="color: #2563eb;">User Details: {{ $user['name'] }}</h2>
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; background-color: white;">
            <tr><td><strong>User ID:</strong></td><td>{{ $user['id'] }}</td></tr>
            <tr><td><strong>Full Name:</strong></td><td>{{ $user['name'] }}</td></tr>
            <tr><td><strong>Email:</strong></td><td>{{ $user['email'] }}</td></tr>
            <tr><td><strong>System Role:</strong></td><td>{{ $user['role'] }}</td></tr>
            <tr><td><strong>Joined Date:</strong></td><td>{{ $user['joined'] }}</td></tr>
        </table>
    @else
        <h2 style="color: red;">User Not Found!</h2>
    @endif

    <br><br>
    <a href="/users?show=true">
        <button style="background-color: #6b7280; color: white; border: none; padding: 8px 14px; border-radius: 4px; cursor: pointer;">
            &larr; Back to Users List
        </button>
    </a>

</body>
</html>