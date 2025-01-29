<?php
// Set cookies for about a third of a year
global $CookieTime;
$CookieTime = 3600 * 24 * 120;

// This will be needed anyway, so let's include it here
require_once('_functions.php');

// Set-up the language settings, and resolve the automatic language (if set)
require_once('_language_functions.php');
InitializeLanguage();

require_once('_theme-database.php');
global $Themes;
global $DefaultTheme;

global $CurrentTheme;
$CurrentTheme = NULL;

if (isset($_POST['theme']))
{
	$ThemeToUse = &$_POST['theme'];
}
else if (isset($_COOKIE['theme']))
{
	$ThemeToUse = &$_COOKIE['theme'];
}
else
{
	$ThemeToUse = NULL;
}
if (!is_null($ThemeToUse))
{
	foreach ($Themes as $ThemeName => $Theme)
	{
		if ($Theme->CookieName === $ThemeToUse)
		{
			$CurrentTheme = $ThemeName;
			break;
		}
	}

	//If we haven't found this theme, set the default theme.
	if (is_null($CurrentTheme))
	{
		$CurrentTheme = $DefaultTheme;
	}
}
else
{
	$CurrentTheme = $DefaultTheme;
}
unset($ThemeToUse);

require_once('_panels-database.php');
global $Panels;
foreach ($Panels as /*$PanelName =>*/ $Panel)
{
	if (isset($_COOKIE[$Panel->CookieName]))
	{
		$Panel->State = $_COOKIE[$Panel->CookieName];
	}

	switch ($Panel->State)
	{
	case 'show':
	case 'hidden':
		break;
	default:
		$Panel->State = 'show';
	}
}

?>
