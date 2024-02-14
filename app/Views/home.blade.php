<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="/registration-form">Register</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
</nav>

<div>
    <h1>Questions</h1>
    <table>
        <tr>
            <th>Title:</th>
            <th>Message</th>
            <th>Vote number</th>
        </tr>
        @foreach($questions as $question)
            <tr>
                <td>{{$question['title']}}</td>
                <td>{{$question['message']}}</td>
                <td>{{$question['vote_number']}}</td>
            </tr>
    </table>
    @endforeach
</div>
</body>
</html>
