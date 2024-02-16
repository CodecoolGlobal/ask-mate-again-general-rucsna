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
@include('base')
    <h2>Tag categories:</h2>
    <ul>
        @foreach($tags as $tag)
            <p>{{$tag->name}}</p>
        @endforeach
    </ul>

    <table>
        <tr>
            <th>Category</th>
            <th>Quantity</th>
        </tr>

        @foreach($quantities as $quantity)
            <tr>
                <td>{{$quantity->name}}</td>
                <td>{{$quantity->quantity}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>