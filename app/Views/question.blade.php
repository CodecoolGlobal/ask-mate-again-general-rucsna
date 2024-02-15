<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Display Page</title>
</head>
<body>
@include('base')
<h3>You can edit your question</h3>
<form method="post" action="/updateQuestion-action">
    <label for="question_title">Title</label>
    <input type="text" id="question_title" name="title" value="{{$question->title}}"><br/>
    <label for="question_message">Message</label>
    <input type="text" id="question_message" name="message" value="{{$question->message}}"><br/>
    <label for="question_vote_nr">Vote number</label>
    <input type="number" id="question_vote_nr" value="{{$question->vote_number}}" readonly><br/>
    <label for="question_submission">Submission time</label>
    <input type="datetime-local" id="question_submission" value="{{$question->submission_time}}" readonly><br/>

    <br><label for="name">Add Tag:</label><br/>
    <select name="name" id="name">
        @foreach($tags as $tag)
            <option>{{$tag->name}}</option>
        @endforeach
    </select>
    <a href="/tag-form">Create a new Tag</a><br/>
    <br/><br/>

    <label>Tags</label> *<br/>

    <ul>
        @foreach($questionTags as $tag)
            <p>{{$tag->name}}</p>
        @endforeach
    </ul>

    <input type="hidden" name="question_id" value="{{$question->id}}">
    <button type="submit" name="submit">Update</button>
</form>
</body>
</html>