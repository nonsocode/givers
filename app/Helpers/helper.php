<?php 

if (!function_exists('is_number')) {
	function is_number($v)
	{
		return is_int($v) || is_float($v);
	}
}

if (!function_exists('storage_asset')) {
	function storage_asset($uri)
	{
		return asset('storage/'.$uri);
	}
}
