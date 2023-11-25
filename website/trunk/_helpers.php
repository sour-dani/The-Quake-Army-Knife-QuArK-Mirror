<?php
function StringLeft(&$string, $length)
{
	if (is_null($string)) throw 1;
	return substr($string, 0, $length);
}

function StringRight(&$string, $length)
{
	return substr($string, strlen($string) - $length, $length);
}

function MultiExplode(&$string, $delimiters)
{
	//Based on: https://stackoverflow.com/a/27767665
	$tmp = str_replace($delimiters, $delimiters[0], $string);
	return explode($delimiters[0], $tmp);
}

//Based on: Symfony Polyfill
if (version_compare(phpversion(), '8.0.0', '<'))
{
	function str_contains($haystack, $needle)
	{
		return strpos($haystack, $needle) !== FALSE;
	}

	function str_starts_with($string, $needle)
	{
		return strncmp($string, $needle, strlen($needle)) === 0;
	}

	function str_ends_with($string, $needle)
	{
		return substr_compare($string, $needle, -strlen($needle)) === 0;
	}
}
?>
