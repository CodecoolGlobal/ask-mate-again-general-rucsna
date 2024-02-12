<?php session_start(); ?>

@if(isset($_SESSION['user_id']))
    <h1>Hello, {{ $_SESSION['email'] }} !</h1>
@else
    <p>Please log in to view this content.</p>
    <a href="/login">Login</a>
@endif

<nav>
    <ul>
        <li><a href="/logout">Logout</a></li>
    </ul>
</nav>