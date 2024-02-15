<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
@include('base')
<h2>Login</h2>
<form action="/login-action" method="POST">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" placeholder="Email" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>
@if(isset($error) && $error)
    <p style="color: red;">Invalid email or password. Please try again.</p>
@endif
</body>
</html>
