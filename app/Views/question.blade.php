<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Question Display Page</title>
    </head>
    <body>
        <br>
        <h2>{{$question->title}}</h2>
        <p>{{$question->message}}</p>

        <ul>
            @foreach($tags as $tag)
                <li>{{$tag->name}}</li>
            @endforeach
        </ul>
    </body>
</html>