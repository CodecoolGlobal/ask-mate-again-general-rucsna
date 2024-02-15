<?php session_start(); ?>

@if(isset($_SESSION['user_id']))
    @include('base')
    <form method="post" action="/save-tag">
        <label for="name">New tag name: </label>
            <input type="text" id="name" name="name"><br/>

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