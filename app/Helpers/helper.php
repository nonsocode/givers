<?php 

if (!function_exists('is_number')) {
	function is_number($v)
	{
		return is_int($v) || is_float($v);
	}
}
