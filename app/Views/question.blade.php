<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Display Page</title>
</head>
<body>
<h3>You can edit your question</h3>
<h5>You can only change the fields marked with *</h5>

<label>Tags</label> *<br/>
<ul>
    @foreach($questionTags as $tag)
        <li>
            <form method="post" action="/removeTag">
                <input type="hidden" name="delete_question_id" value="{{$question->id}}">
                <input type="hidden" name="tag_id" value="{{$tag->id}}">
                {{$tag->name}} <button type="submit">X</button>
            </form>
        </li>
    @endforeach
</ul>

<form method="post" action="/updateQuestion-action">
    <label for="question_title">Title</label>
    <input type="text" id="question_title" name="title" value="{{$question->title}}"> *<br/>
    <label for="question_message">Message</label>
    <input type="text" id="question_message" name="message" value="{{$question->message}}" disabled><br/>
    <label for="question_vote_nr">Vote number</label>
    <input type="number" id="question_vote_nr" value="{{$question->vote_number}}" disabled><br/>
    <label for="question_submission">Submission time</label>
    <input type="datetime-local" id="question_submission" value="{{$question->submission_time}}" disabled><br/>

    <br><label for="tag_id">Add Tag:</label><br/>
    <select name="tag_id" id="tag_id">
        <option disabled selected value style="display:none"> -- select an option -- </option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
    <a href="/tag-form">Create a new Tag</a><br/>
    <br/><br/>

    <input type="hidden" name="question_id" value="{{$question->id}}">
    <button type="submit" name="submit">Update</button>
</form>

<a href="/dashboard">Back</a>
</body>
</html>