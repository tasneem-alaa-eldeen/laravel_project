<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Courses</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px; background-color: #f9fafb;">
   <h2 style="color: #1f2937;">Courses List</h2>
         <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 70%; background-color: white;">
            <thead>
                <tr style="background-color: #e5e7eb; color: #111827;">
                    <th># ID</th>
                    <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course['id'] }}</td>
                        <td>{{ $course['title'] }}</td>
                        <td>{{ $course['code'] }}</td>
                        <td>
                            <a href="/courses/{{ $course['id'] }}">
                                <button style="background-color: #059669; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer;">View Details</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>