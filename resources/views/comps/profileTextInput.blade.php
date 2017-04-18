<div class="form-group">
	<label class="col-sm-2 control-label" for="{{$name}}">{{$label}}</label>
	<div class="col-sm-10">
		<input type="text" {{$disabled or ''}} {{isset($readonly) ? 'readonly=""':""}} id="$name" name="{{$name}}" class="form-control" value="{{$value}}">
	</div>
</div>