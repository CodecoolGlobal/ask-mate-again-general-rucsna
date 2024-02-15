<?php
if(!isset($_SESSION)) {
    session_start();
}
?>
<link type="text/css" rel="stylesheet" href="../../public/css/style.css">


<nav>
    <ul>
        @if(isset($_SESSION['user_id']))
            <li><a href="/">Home</a></li>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/user-list">User List</a></li>
            <li><a href="/tag-list">Tag List</a></li>
            <li><a href="/logout">Logout</a></li>
        @else
            <li><a href="/">Home</a></li>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/user-list">User List</a></li>
            <li><a href="/tag-list">Tag List</a></li>
            <li><a href="/registration-form">Register</a></li>
            <li><a href="/login">Login</a></li>
        @endif

    </ul>
</nav>
