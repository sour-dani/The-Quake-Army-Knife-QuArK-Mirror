<?php

#25 year anniversary
/*if ((!isset($_COOKIE['Anniversary'])) or ($_COOKIE['Anniversary'] !== '25'))
{
	require_once('_server_vars.php');
	global $HTTP_Secure;
	setcookie('Anniversary', '25', time() + 24*3600*30, '/', '', $HTTP_Secure, true);
	header('Cache-Control: no-store, max-age=0');
	header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
	header('Pragma: no-cache');
	header('Location: /25years/', true, 307);
	die();
}*/

require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_image_functions.php');
require_once('_news_functions.php');

# Load language file
LoadLanguageFile('index.php');

function pageLocalDisplay()
{
	$mainpanel = '<table cellpadding=0 cellspacing=0><tr>';
	$mainpanel .= '<td style="padding-right: 8px;">'.DisplayImage('quarkiconlarge').'</td>';
	$mainpanel .= '<td valign=middle><h1>'.GetLanguageString('WelcomeText').'</h1></td>';
	$mainpanel .= '<td style="padding-left: 8px;">'.DisplayImage('quarkiconlarge').'</td>';
	$mainpanel .= '</tr></table>';

	$mainpanel .= GetLanguageString('IntroText');

	global $Settings;
	global $NewsItemNumberIndex;

	pageName(GetLanguageString('Welcome'));

	pagePanel('quark', GetLanguageString('WelcomeText'), '', $mainpanel);

	displayNews($Settings[$NewsItemNumberIndex]->GetCurrentValue());

	pagePanel('news', GetLanguageString('MoreNews'), '', GetLanguageString('MoreNewsText'));

	pagePanel('quark', GetLanguageString('Disclaimer'), '', GetLanguageString('DisclaimerText'));
}

pageDisplay('Main Page', 'pageLocalDisplay');
?>
