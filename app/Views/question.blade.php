<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Display Page</title>
</head>
<body>
<h2>Edit question</h2>
<form method="post" action="">
    <label for="question_title">Title</label>
    <input type="text" id="question_title" name="title" value="{{$question->title}}"><br/>
    <label for="question_message">Message</label>
    <input type="text" id="question_message" name="message" value="{{$question->message}}"><br/>
    <button type="submit" name="submit">Update</button>
</form>
<a href="/dashboard">Back</a>
</body>
</html>