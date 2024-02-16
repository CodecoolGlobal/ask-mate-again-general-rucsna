<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
@include('base')
<h2>Register</h2>
<form action="/register" method="POST">
    <label for="email">Email:</label><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button>
</form>

</body>
</html>