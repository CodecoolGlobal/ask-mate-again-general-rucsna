<?php session_start(); ?>

@if(isset($_SESSION['user_id']))
    <h1>Hello, {{ $_SESSION['email'] }} !</h1>
    <h2>Ask a question</h2>
    <form method="post" action="/saveQuestion-action">
        <label for="title">Title</label>
        <input type="text" name="title" value="Title"><br/>
        <label for="message">Message</label>
        <input type="text" name="message" value="Write a question"><br/>
        <input type="hidden" name="image_id" value="1">
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