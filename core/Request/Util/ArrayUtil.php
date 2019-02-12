<?php

namespace LiteraryCore\Request\Util;

abstract class ArrayUtil
{
	static public function exist(array $array, string $key): bool
	{
		return isset($array[$key]);
	}

	static public function get(array $array, string $key,  $default = null)
	{
		return $array[$key] ?? $default;
	}
}