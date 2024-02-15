<?php session_start(); ?>
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
        <li><a href="/tag-list">Tags</a></li>
    </ul>
</nav>

<div>
    <h1>Questions</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Message</th>
            <th>Vote number</th>
        </tr>
        @foreach($questions as $question)
            <tr>
                <td>{{$question['title']}}</td>
                <td>{{$question['message']}}</td>
                <td>{{$question['vote_number']}}</td>
                @if(isset($_SESSION['user_id']))
                <td>
                    <form action="/vote" method="post">
                        <input type="hidden" name="question_id" value="{{$question['id']}}">
                        <button type="submit" name="vote" value="up">Upvote</button>
                        <button type="submit" name="vote" value="down">Downvote</button>
                    </form>
                </td>
                @endif
            </tr>
    </table>
    @endforeach
</div>
</body>
</html>
