<?php

namespace LiteraryCore\Request;

use LiteraryCore\Request\Util\ArrayUtil;

abstract class Request
{
	static public function exist(string $key): bool
	{
		return ArrayUtil::exist($_POST, $key);
	}

	static public function get(string $key, string $default = null): ?string
	{
		return ArrayUtil::get($_POST, $key, $default);
	}
}