<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Display Page</title>
</head>
<body>
@include('base')

    <h1>{{$question->title}}</h1>
    <h1>{{$question->message}}</h1><br/>
    <label for="question_vote_nr">Vote number</label><br>
    <input type="number" id="question_vote_nr" value="{{$question->vote_number}}" readonly><br/>
    <label for="question_submission">Submission time</label><br>
    <input type="datetime-local" id="question_submission" value="{{$question->submission_time}}" readonly><br/><br>

    <label>Tags</label><br/>

    <ul>
        @foreach($questionTags as $tag)
            <p>{{$tag->name}}</p>
        @endforeach
    </ul>

    <h2>Answers:</h2>

    @foreach($answers as $answer)
        <li>{{$answer->message}} <br><b>Votes:</b>{{$answer->vote_number}}</li><br>
        <form class="action-form" action="/answerAction" method="post">
            <input type="hidden" name="answer_id" value="{{$answer->id}}">
            <input type="text" id="message" name="message" placeholder="Edit message..."><br><br>
            <button type="submit" name="answer" value="edit">Edit</button>
            <button type="submit" name="answer" value="delete">Delete</button>
        </form>
        <form class="action-form" action="/vote" method="post">
            <input type="hidden" name="id" value="{{$answer->id}}">
            <button type="submit" name="vote" value="upAnswer">Upvote</button>
            <button type="submit" name="vote" value="downAnswer">Downvote</button>
        </form>
        <br>
    @endforeach

<h2>Answer</h2>
<form action="/saveAnswer" method="POST">
    <input type="hidden" name="question_id" value="{{$question->id}}">
    <label for="message">Message:</label><br>
    <input type="text" id="message" name="message" required><br><br>
    <button type="submit">Submit</button>
</form>

</body>

</html>