<?php
require_once('_base_code.php');
require_once('_video-database.php');
require_once('_language_functions.php');
require_once('_settings-database.php');

# Load language file
LoadLanguageFile('showvideo.php');

#COPIED FROM _base_code.php:
//Log the access
require_once('_AccessLogSend.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'_server_vars.php'); #FIXME: This should be a relative path, but it doesn't work, somehow? Bug in PHP, or in SourceForge config?
global $Request_URI, $Remote_addr, $HTTP_user_agent, $HTTP_referer;
SendAccessLog(0, $Request_URI, $Remote_addr, $HTTP_user_agent, $_SERVER['REQUEST_TIME_FLOAT'], $HTTP_referer); //FIXME: Check return code!

require_once('gatekeeper/_check_access.php');
global $no_stats;
if (!$no_stats)
{
	//FIXME: !!!
}

$VideoID = intval($_GET['VideoID'])-1;

function showVideoPage($VideoNR)
{
	global $mainroot;

	global $videosdatabase;

	$CurrentVideo = &$videosdatabase[$VideoNR];

	$fullscreen = false;
	if (is_array($CurrentVideo->PlayerSettings))
	{
		if (array_key_exists('fullscreen', $CurrentVideo->PlayerSettings))
		{
			if ($CurrentVideo->PlayerSettings['fullscreen'])
			{
				$fullscreen = true;
			}
		}
	}

	global $Settings;
	global $VideoPlayer;
	$SelectedVideoPlayer = $Settings[$VideoPlayer]->Value;

	if ($SelectedVideoPlayer === 0)
	{
		switch ($CurrentVideo->Mediatype)
		{
		case 'M1':
		case 'M4':
		case 'M5':
			$SelectedVideoPlayer = 1;
			break;
		case 'M2':
			$SelectedVideoPlayer = 3;
			break;
		case 'M6':
			$SelectedVideoPlayer = 0; //Recycle to mean: external link
			break;
		default:
			$SelectedVideoPlayer = 1; //Default to WMP 6 or lower
		}
	}

	if ($CurrentVideo->Mediatype === 'M6')
	{
		//Override for external links
		$SelectedVideoPlayer = 0; //Recycle to mean: external link
	}

	switch ($SelectedVideoPlayer)
	{
	case 1:
		//Windows Media Player 6.4 and earlier
		$PlayerCLSID = '22D6F312-B0F6-11D0-94AB-0080C74C7E95';
		$PlayerCodebase = 'http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab';
		$PlayerType = 'application/x-oleobject';
		$PlayerStandby = 'Loading Microsoft Windows Media Player Components...';
		$PlayerEmbedType = 'application/x-mplayer2';
		break;
	case 2:
		//Windows Media Player 7 and later
		$PlayerCLSID = '6BF52A52-394A-11D3-B153-00C04F79FAA6';
		$PlayerCodebase = 'http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab';
		$PlayerType = 'application/x-oleobject';
		$PlayerStandby = 'Loading Microsoft Windows Media Player Components...';
		$PlayerEmbedType = 'application/x-mplayer2';
		break;
	case 3:
		//Quicktime player
		$PlayerCLSID = '02BF25D5-8C17-4B23-BC80-D3488ABDDC6B';
		$PlayerType = 'video/quicktime';
		$PlayerCodebase = 'http://www.apple.com/qtactivex/qtplugin.cab';
		$PlayerStandby = 'Loading Quicktime Player Components...';
		$PlayerEmbedType = 'video/quicktime';
		break;
	default:
		$PlayerCLSID = '';
		$PlayerType = '';
		$PlayerCodebase = '';
		$PlayerStandby = '';
		$PlayerEmbedType = '';
		break;
	}

	if ($SelectedVideoPlayer === 0)
	{
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"  \"http://www.w3.org/TR/html4/loose.dtd\">";
		echo "\n<html lang=\"".GetLanguageObj()->Tag."\">";
		echo "\n<head><title>".$CurrentVideo->Name."</title>";
		echo "\n<meta name=\"author\" content=\"QuArK Development Team\">";
		echo "\n<meta name=\"copyright\" content=\"&copy; 19999 QuArK Development Team\">";
		echo "\n<meta http-equiv=\"content-language\" content=\"en\">";
		echo "\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\">";
		#echo "\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
		echo "\n<link rel=\"shortcut icon\" href=\"/favicon.ico\" type=\"image/x-icon\">";
		echo "\n<meta http-equiv=\"refresh\" content=\"0; URL=".$CurrentVideo->Link."\">";
		echo "</head>";
		echo "\n<body>";
		echo "<p>Please wait while you are redirected to the correct page. If this doesn't happen in a few seconds, click <a href=\"".$CurrentVideo->Link."\">here</a>.</p>";
		echo "</body></html>";
		exit;
	}

	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"  \"http://www.w3.org/TR/html4/loose.dtd\">";
	echo "\n<html lang=\"".GetLanguageObj()->Tag."\">";
	echo "\n<head><title>".$CurrentVideo->Name."</title>";
	echo "\n<meta name=\"author\" content=\"QuArK Development Team\">";
	echo "\n<meta name=\"copyright\" content=\"&copy; 1999 QuArK Development Team\">";
	echo "\n<meta http-equiv=\"content-language\" content=\"en\">";
	echo "\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\">";
	#echo "\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
	echo "\n<link rel=\"stylesheet\" href=\"".$mainroot."themes/videostyle.css\" type=\"text/css\">";
	echo "\n<link rel=\"shortcut icon\" href=\"/favicon.ico\" type=\"image/x-icon\">";
	if (is_array($CurrentVideo->PlayerParameters))
	{
		if (array_key_exists("refresh", $CurrentVideo->PlayerParameters))
		{
			echo "\n<meta http-equiv=\"refresh\" content=\"".$CurrentVideo->PlayerParameters["refresh"]."\">";
		}
	}
	echo "\n<meta name=\"ROBOTS\" content=\"noindex\">";
	if ($fullscreen)
	{
		echo "\n<meta toolbar=no scrollbars=no menubar=no>";
	}
	echo "</head>";

	echo "\n<body style=\"background-color: #000000;\">"; //background-color to make sure the screen doesn't flash white before the CSS is loaded.
	if ($PlayerCLSID === '')
	{
		echo "<video src=\"".$CurrentVideo->Link."\"";
		if (!$fullscreen)
		{
			echo " controls";
		}
		echo " autoplay style=\"width: 100%;\">Your browser doesn't support the HTML 5 video tag.</video>";
	}
	else
	{
		echo "\n<object style=\"margin: 0px; padding: 0px; width: 100%; height: 100%;\"";
		//echo " id=\"MediaPlayer\"";
		echo " classid=\"CLSID:".$PlayerCLSID."\"";
		echo " codebase=\"".$PlayerCodebase."\"";
		echo " standby=\"".$PlayerStandby."\"";
		echo " type=\"".$PlayerType."\">";
		echo "\n<param name=\"FileName\" VALUE=\"".$CurrentVideo->Link."\">";
		echo "\n<param name=\"AutoStart\" value=\"true\">";
		echo "\n<param name=\"PlayCount\" value=\"1\">";
		if ($fullscreen)
		{
			echo "\n<param name=\"ShowControls\" value=\"false\">";
			echo "\n<param name=\"ShowDisplay\" value=\"false\">";
		}
		echo "\n<embed type=\"".$PlayerEmbedType."\"";
		echo " SRC=\"".$CurrentVideo->Link."\"";
		echo " WIDTH=\"100%\"";
		echo " HEIGHT=\"100%\"";
		echo " AUTOSTART=\"1\"";
		if ($fullscreen)
		{
			echo " SHOWCONTROLS=\"0\"";
		}
		echo " LOOP=\"0\">";
		echo "\n</object>";
	}
	echo "</body>";
	echo "</html>";
}

global $videosdatabase;
if (($VideoID < 0) or ($VideoID >= count($videosdatabase)))
{
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"  \"http://www.w3.org/TR/html4/loose.dtd\">";
	echo "\n<html lang=\"".GetLanguageObj()->Tag."\">";
	echo "\n<head><title>Error!</title>";
	echo "\n<meta name=\"author\" content=\"QuArK Development Team\">";
	echo "\n<meta name=\"copyright\" content=\"&copy; 1999 QuArK Development Team\">";
	echo "\n<meta http-equiv=\"content-language\" content=\"en\">";
	echo "\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\">";
	#echo "\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
	echo "\n<link rel=\"shortcut icon\" href=\"/favicon.ico\" type=\"image/x-icon\">";
	echo "</head>";
	echo "\n<body>";
	echo "<p>ERROR! VideoID out of range!</p>";
	echo "</body></html>";
	exit;
}

showVideoPage($VideoID);
?>
