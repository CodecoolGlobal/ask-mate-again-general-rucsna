<?php session_start(); ?>

@if(isset($_SESSION['user_id']))
    <h1>Hello, {{ $_SESSION['email'] }} !</h1>
    <h2>Ask a question</h2>
    <form method="post" action="/saveQuestion-action">
        <label for="question_title">Title</label>
        <input type="text" id="question_title" name="title" value="Title"><br/>
        <label for="question_message">Message</label>
        <input type="text" id="question_message" name="message" value="Write a question"><br/>
        <input type="hidden" name="image_id" value="1">

        <br><label for="name">Choose a Tag:</label><br/>
        <select name="name" id="name">
            @foreach($tags as $tag)
                <option>{{$tag}}</option>
            @endforeach
        </select>

        <a href="/tag-form">Create a new Tag</a><br/>
        <br/>

        <button type="submit" name="submit">Save</button>
    </form>
    <nav>
        <ul>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </nav>
@else
    <p>Please log in to view this content.</p>
    <a href="/login">Login</a>
@endif