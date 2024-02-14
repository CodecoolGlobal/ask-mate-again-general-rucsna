<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Tag categories:</h2>
    <ul>
        @foreach($tags as $tag)
            <li>{{$tag->name}}</li>
        @endforeach
    </ul>

    <h2>Tag quantity per category:</h2>
    <ul>
        @foreach($quantities as $quantity)
            <li>{{$quantity->name}} -> Quantity: {{$quantity->quantity}}</li>
        @endforeach
    </ul>
</body>
</html>