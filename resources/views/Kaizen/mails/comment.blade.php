<p>
    The status of the ticket is: <strong>{{$comment->status}}</strong>
</p>
<p>
    Comment added by: {{$comment->user->name}}
</p>
<p>
    <hr>
    {!! $comment->comment !!}
    <hr>
</p>