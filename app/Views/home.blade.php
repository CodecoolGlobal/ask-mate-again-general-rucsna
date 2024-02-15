<?php session_start(); ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
@include('base')

<form method="post" action="/search">
    <input type="text" name="query" placeholder="Enter your search query">
    <button type="submit">Search</button>
</form>

<div>
    <h1>Questions</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Message</th>
            <th>Vote number</th>
            <th>Image</th>
        </tr>
        @foreach($questions as $question)
            <tr>
                <td>{{$question['title']}}</td>
                <td>{{$question['message']}}</td>
                <td>{{$question['vote_number']}}</td>
                <td>
                        <?php
                        $imagePath = $question['directory'] . '/' . $question['file_name'];
                        ?>
                    <img src="<?php echo $imagePath; ?>" alt="Question Image" style="max-width: 100px;">
                </td>
                @if(isset($_SESSION['user_id']))
                    <td>
                        <form action="/vote" method="post">
                            <input type="hidden" name="id" value="{{$question['id']}}">
                            <button type="submit" name="vote" value="up">Upvote</button>
                            <button type="submit" name="vote" value="down">Downvote</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="/answer">
                            <input type="hidden" name="id" value="{{$question['id']}}">
                            <input type="submit" name="update" value="Show">
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
