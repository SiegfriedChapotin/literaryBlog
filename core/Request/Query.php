<?php

namespace LiteraryCore\Request;

use LiteraryCore\Util\ArrayUtil;

abstract class Query
{
	static public function exist(string $key): bool
	{
		return ArrayUtil::exist($_GET, $key);
	}

	static public function get(string $key, string $default = null): ?string
	{
		return ArrayUtil::get($_GET, $key, $default);
	}
}