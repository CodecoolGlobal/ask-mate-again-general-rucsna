@include('base')
<h1>User list</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Registration Date</th>
        <th>Count of questions</th>
        <th>Count of answers</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['registration_time']}}</td>
            <td>{{$user['question_count']}}</td>
            <td>{{$user['answer_count']}}</td>
        </tr>
    @endforeach
</table>