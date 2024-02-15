<?php
if(!isset($_SESSION))
{
    session_start();
}
?>

@if(isset($_SESSION['user_id']))
    <h1>Hello, {{ $_SESSION['email'] }} !</h1>
    <h2>Ask a question</h2>
    <form method="post" action="/saveQuestion-action">
        <label for="question_title">Title</label>
        <input type="text" id="question_title" name="title" value="Title"><br/>
        <label for="question_message">Message</label>
        <input type="text" id="question_message" name="message" value="Write a question"><br/>
        <input type="hidden" name="image_id" value="1">

        <a href="/tag-form">Create a new Tag</a><br/>
        <br/>

        <button type="submit" name="submit">Save</button>
    </form>
    <label for="question_list"><b>Your questions</b></label><br/><br/>
    <table id="question_list">
        @foreach($questions as $question)
            <tr>{{$question['title']}}</tr>
            <form method="post" action="/deleteQuestion-action">
                <input type="hidden" name="question_id" value="{{$question['id']}}">
                <input type="submit" name="delete" value="Delete">
            </form>
            <form method="post" action="/redirectForQuestionUpdate-action">
                <input type="hidden" name="question_id" value="{{$question['id']}}">
                <input type="submit" name="update" value="Update">
            </form>
            <br/>
        @endforeach
    </table>
    <nav>
        <ul>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </nav>
@else
    <p>Please log in to view this content.</p>
    <a href="/login">Login</a>
@endif