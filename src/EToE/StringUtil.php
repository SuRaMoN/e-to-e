<?php

namespace EToE;


class StringUtil
{
	public static function endsWith($subject, $suffix)
	{
	    return substr($subject, -strlen($suffix)) == $suffix;
	}

	public static function startsWith($subject, $prefix)
	{
	    return substr($subject, 0, strlen($prefix)) == $prefix;
	}
}
 
