<?php
require_once('_functions.php');
require_once('_language_functions.php');
require_once('_theme-database.php');

$themeselector = '<div class="centered"><form action="' . htmlentities($_SERVER['REQUEST_URI']) . '" method="post">
	<fieldset><legend>'.GetLanguageString('SelectTheme').'</legend>
	<select name="theme">
';

global $Themes;
global $CurrentTheme;

foreach ($Themes as $ThemeName => $Theme)
{
	if ($Theme->Selectable === true)
	{
		if ($ThemeName === $CurrentTheme)
		{
			$themeselector .= '	<option value="' . $Theme->CookieName . '" selected>' . $Theme->DisplayName . "\n";
		}
		else
		{
			$themeselector .= '	<option value="' . $Theme->CookieName . '">' . $Theme->DisplayName . "\n";
		}
	}
}

$themeselector .= '	</select><br>
	<input type=submit>
';

foreach ($_GET as $key => $value)
{
	if ($key !== 'theme')
	{
		$themeselector .= '	<input type=hidden value="'.$value.'" name="'.$key.'">';
	}
}

$themeselector .= '	</fieldset></form>
</div>';

pageSidePanel('', GetLanguageString('Theme'), $themeselector);

?>
