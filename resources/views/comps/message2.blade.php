    <div class="direct-chat-msg {{$message->myMessage()?"":"right"}}">
        <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-{{$message->myMessage()?"left":"right"}}">{{$message->myMessage()? "You": $message->owner->name}}</span>
            <span class="direct-chat-timestamp pull-{{$message->myMessage()?"right":"left"}}"><time datetime="{{$message->created_at}}">{{$message->created_at->diffForHumans()}}</time></span>
        </div>
        <!-- /.direct-chat-info -->
        <img class="direct-chat-img" src="{{ asset('img/avatar.png') }}" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text {{$message->myMessage()?"mine":""}}">
			{{$slot}}
        </div>
        <!-- /.direct-chat-text -->
    </div>
    <!-- /.direct-chat-msg -->