<?php
function StringLeft(&$string, $length)
{
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

function in_cidrv4($needle, $haystack_first, $haystack_last)
{
	return (ip2long($haystack_first) <= ip2long($needle)) and (ip2long($needle) <= ip2long($haystack_last));
}

//This function is missing, even in PHP 8.4
//Based on: https://www.php.net/manual/en/function.parse-url.php#106731
function unparse_url($parsed_url) //Note: PHP doesn't allow this to be passed by reference?
{
	$scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
	$host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
	$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
	$user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
	$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
	$pass     = ($user || $pass) ? "$pass@" : '';
	$path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
	$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
	$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
	return "$scheme$user$pass$host$port$path$query$fragment";
}

//PHP (still) doesn't have a function to parse Accept-headers, so we have to do it ourselves.
function parseAcceptHeader($header)
{
	$result = array();
	while (strlen($header) !== 0)
	{
		$index = strpos($header, ';q=');
		if ($index === false)
		{
			$foundItem = $header;
			$foundWeight = 1.0;
			$header = '';
		}
		else
		{
			$foundItem = StringLeft($header, $index);
			$header = substr($header, $index + strlen(';q='));
			$index = strpos($header, ',');
			if ($index === false)
			{
				$foundWeight = floatval(trim($header));
				$header = '';
			}
			else
			{
				$foundWeight = floatval(trim(StringLeft($header, $index)));
				$header = substr($header, $index + strlen(','));
			}
		}
		foreach (explode(',', $foundItem) as $foundItemX)
		{
			$result[trim($foundItemX)] = $foundWeight;
		}
	}
	return $result;
}
?>