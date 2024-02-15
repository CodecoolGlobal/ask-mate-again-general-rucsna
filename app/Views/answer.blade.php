<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Display Page</title>
</head>
<body>

    <label for="question_title">Title</label>
    <input type="text" id="question_title" name="title" value="{{$question->title}}"><br/>
    <label for="question_message">Message</label>
    <input type="text" id="question_message" name="message" value="{{$question->message}}"><br/>
    <label for="question_vote_nr">Vote number</label>
    <input type="number" id="question_vote_nr" value="{{$question->vote_number}}" readonly><br/>
    <label for="question_submission">Submission time</label>
    <input type="datetime-local" id="question_submission" value="{{$question->submission_time}}" readonly><br/>

    <label>Tags</label> *<br/>

    <ul>
        @foreach($questionTags as $tag)
            <li>{{$tag->name}}</li>
        @endforeach
    </ul>

    <h2>Answers:</h2>

        @foreach($answers as $answer)
            <li>{{$answer->message}} {{$answer->vote_number}}</li>
            <form action="/answerAction" method="post">
                <input type="hidden" name="answer_id" value="{{$answer->id}}">
                <button type="submit" name="answer" value="delete">Delete</button>
                <input type="text" id="message" name="message"><br><br>
                <button type="submit" name="answer" value="edit">Edit</button>
            </form>
            <form action="/vote" method="post">
                <input type="hidden" name="id" value="{{$answer->id}}">
                <button type="submit" name="vote" value="upAnswer">Upvote</button>
                <button type="submit" name="vote" value="downAnswer">Downvote</button>
            </form><br>
        @endforeach

<h2>Answer</h2>
<form action="/saveAnswer" method="POST">
    <input type="hidden" name="question_id" value="{{$question->id}}">
    <label for="message">Message:</label><br>
    <input type="text" id="message" name="message" required><br><br>
    <button type="submit">Submit</button>
</form>

<a href="/">Back</a>
</body>

</html>