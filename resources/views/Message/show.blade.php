@extends ('layouts.app')
@section('content')
<div class='lead'>
    On {{date("F j, Y g:iA", strtotime($message->created_at))}}, the following email was composed:
</div>
<div class='text-muted'>
    {{$message->public_message}}
</div>


@endsection
