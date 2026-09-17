<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px; background-color: #f9fafb;">
   <h2 style="color: #1f2937;">Users List</h2>
              <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 70%; background-color: white;">
            <thead>
                <tr style="background-color: #e5e7eb; color: #111827;">
                    <th># ID</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                            <a href="/users/{{ $user['id'] }}">
                                <button style="background-color: #4f46e5; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer;">View Details</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>