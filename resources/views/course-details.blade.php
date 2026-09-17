<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Details</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px; background-color: #f9fafb;">

    @if($course)
        <h2 style="color: #059669;">Course Details: {{ $course['title'] }}</h2>
        <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; background-color: white;">
            <tr><td><strong>Course ID:</strong></td><td>{{ $course['id'] }}</td></tr>
            <tr><td><strong>Title:</strong></td><td>{{ $course['title'] }}</td></tr>
            <tr><td><strong>Course Code:</strong></td><td>{{ $course['code'] }}</td></tr>
            <tr><td><strong>Description:</strong></td><td>{{ $course['description'] }}</td></tr>
        </table>
    @else
        <h2 style="color: red;">Course Not Found!</h2>
    @endif

    <br><br>
    <a href="/courses?show=true">
        <button style="background-color: #6b7280; color: white; border: none; padding: 8px 14px; border-radius: 4px; cursor: pointer;">
            &larr; Back to Courses List
        </button>
    </a>

</body>
</html>