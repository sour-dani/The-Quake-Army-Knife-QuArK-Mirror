<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_panels_functions.php');
require_once('_panels-database.php');
require_once('_settings_functions.php');
require_once('_settings-database.php');
require_once('_theme_functions.php');
require_once('_theme-database.php');

# Load language file
LoadLanguageFile('layout.php');

global $ThemePanel;
hidePanel($ThemePanel);

global $Panels;
global $Settings;

foreach ($Panels as /*$PanelName =>*/ $Panel)
{
	if (isset($_POST[$Panel->CookieName]))
	{
		$Panel->State = $_POST[$Panel->CookieName];
	}

	switch ($Panel->State)
	{
		case 'show':
		case 'hidden':
			break;
		default:
			$Panel->State = 'show';
	}

	//$Panel->SaveSetting(); //Note: PageDisplay will refresh the cookies
}

foreach ($Settings as $SettingName => $Setting)
{
	if (isset($_POST[$Setting->CookieName]))
	{
		$Setting->Value = intval($_POST[$Setting->CookieName]);
	}

	//$Setting->SaveSetting(); //Note: PageDisplay will refresh the cookies
}

// This may have changed; reload!
InitializeLanguage();

function MakeItemList($SettingObject)
{
	$bodytext = '<select name="' . $SettingObject->CookieName . '">';
	for ($Item = 0; $Item < count($SettingObject->Range); $Item++)
	{
		if ($SettingObject->Range[$Item] == $SettingObject->Value)
		{
			$bodytext .= '<option value="' . $SettingObject->Range[$Item] . '" selected>' . $SettingObject->Texts[$Item];
		}
		else
		{
			$bodytext .= '<option value="' . $SettingObject->Range[$Item] . '">' . $SettingObject->Texts[$Item];
		}
	}
	$bodytext .= '</select>';
	return $bodytext;
}

function themeCode($ThemeName)
{
	global $Themes;
	global $CurrentTheme;

	if (!array_key_exists($ThemeName, $Themes))
	{
		trigger_error('Unable to find theme in array!', E_USER_WARNING);
		return '';
	}
	$themeobj = &$Themes[$ThemeName];

	$bodytext = '<div class="themeselector">';
	if (!is_null($themeobj->Description))
	{
		$bodytext .= '<div class="mouseover">';
	}
	$bodytext .= $themeobj->DisplayName.':<br>';
	$bodytext .= '<img width=300 height=200 src="'.$themeobj->PreviewFilename.'" alt="'.$Themes[$ThemeName]->DisplayName.' preview"><br>';
	if ($ThemeName === $CurrentTheme)
	{
		$bodytext .= '<input type="radio" name="theme" value="'.$themeobj->CookieName.'" checked>Use this theme';
	}
	else
	{
		$bodytext .= '<input type="radio" name="theme" value="'.$themeobj->CookieName.'">Use this theme';
	}
	if (!is_null($themeobj->Description))
	{
		$bodytext .= '<div class="popup">'.$themeobj->Description.'</div>';
		$bodytext .= '</div>';
	}
	$bodytext .= '</div>';
	return $bodytext;
}

function panelCode($PanelObject)
{
	$bodytext = '<div class="panelselector">'.$PanelObject->DisplayName.':<br>';
	if ($PanelObject->State === 'show')
	{
		$bodytext .= '<input type="radio" name="'.$PanelObject->CookieName.'" value="show" checked>Show<br>';
		$bodytext .= '<input type="radio" name="'.$PanelObject->CookieName.'" value="hidden">Hidden<br>';
	}
	else
	{
		$bodytext .= '<input type="radio" name="'.$PanelObject->CookieName.'" value="show">Show<br>';
		$bodytext .= '<input type="radio" name="'.$PanelObject->CookieName.'" value="hidden" checked>Hidden<br>';
	}
	$bodytext .= '</div>';
	return $bodytext;
}

function settingCode($SettingObject)
{
	$bodytext = '<div class="valueselector">';
	$bodytext .= $SettingObject->DisplayText;
	$bodytext .= '<br>';
	$bodytext .= MakeItemList($SettingObject);
	$bodytext .= "<br>\n</div>";
	return $bodytext;
}

function pageLocalDisplay()
{
	global $Themes;
	global $Panels;
	global $Settings;

	pageName(GetLanguageString('LayoutTitle'));

	pagePanel('alert', GetLanguageString('Cache'), '', GetLanguageString('CacheText'));

	$bodytext = "<div align=center>\n<form action=\"layout.php\" method=\"post\">";

	foreach ($Themes as $ThemeName => $Theme)
	{
		if (!$Theme->Selectable)
			continue;
		$bodytext .= themeCode($ThemeName);
	}

	$bodytext .= "<input type=\"submit\"><input type=\"reset\">\n</form>\n</div>";

	pagePanel('config', GetLanguageString('ThemeSelector'), '', $bodytext);

	$bodytext = "<div align=center>\n<form action=\"layout.php\" method=\"post\">";
	foreach ($Panels as /*$PanelName =>*/ $Panel)
	{
		$bodytext .= panelCode($Panel);
	}
	$bodytext .= "<input type=\"submit\"><input type=\"reset\">\n</form>\n</div>";

	pagePanel('config', GetLanguageString('PanelSelector'), '', $bodytext);

	$bodytext = "<div align=center>\n<form action=\"layout.php\" method=\"post\">";
	foreach ($Settings as /*$SettingName =>*/ $Setting)
	{
		$bodytext .= settingCode($Setting);
	}
	$bodytext .= "<input type=\"submit\"><input type=\"reset\">\n</form>\n</div>";

	pagePanel('config', GetLanguageString('ValueSelector'), '', $bodytext);
}

pageDisplay(GetLanguageString('LayoutTitle'), 'pageLocalDisplay');

?>
