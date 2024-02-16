<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
</head>
<body>
@include('base')

<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

@if(isset($_SESSION['user_id']))
    <h1>Hello, {{ $_SESSION['email'] }} !</h1>
    <h2>Ask a question</h2>
    <form method="post" action="/saveQuestion-action" enctype="multipart/form-data">
        <input type="text" id="question_title" name="title" placeholder="Title"><br/>
        <input type="text" id="question_message" name="message" placeholder="Write a question"><br/>
        <input type="file" id="question_image" name="image"><br/>
        <button type="submit" name="submit">Save</button>
    </form>
    <label for="question_list"><b>Your questions</b></label><br/><br/>
    <table id="question_list">
        @foreach($questions as $question)
            <tr>
                <td>{{$question['title']}}</td>
                <td>
                    <form method="post" action="/deleteQuestion-action">
                        <input type="hidden" name="question_id" value="{{$question['id']}}">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </td>
                <td>
                    <form method="post" action="/questionPage">
                        <input type="hidden" name="question_id" value="{{$question['id']}}">
                        <input type="submit" name="update" value="Show">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@else
    <p>Please log in to view this content.</p>
    <a href="/login">Login</a>
@endif

</body>
</html>
