<div class="message-container">
<div class="message {{$message->myMessage()?"my":"their"}}Message">
	<div class="message-meta">
		<div class="profile-photo">
			<img src="{{ asset('img/avatar.png') }}" alt="" class="img-responsive img-thumbnail img-circle">
		</div>
		<div class="user-meta">
			<span class="username">{{$message->owner->name}}</span><br>
			<span class="userrole">
				Administrator
			</span>
		</div>
		<div class="date pull-right">
			<time datetime="{{$message->created_at}}">{{$message->created_at->diffForHumans()}}</time>
		</div>
	</div>
	<div class="message-body">
		<div class="message-content">
			{{$slot}}
		</div>
	</div>
</div>
</div>
