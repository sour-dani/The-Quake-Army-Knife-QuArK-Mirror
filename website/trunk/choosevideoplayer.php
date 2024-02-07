<?php
require_once('_base_code.php');
//require_once('_video-database.php');
require_once('_language_functions.php');
require_once('_settings-database.php');

# Load language file
LoadLanguageFile('choosevideoplayer.php');

//FIXME: Allow choice PER MEDIA TYPE!

global $Settings;
global $VideoPlayer;

if (isset($_POST['videoplayer']))
{
	switch ($_POST['videoplayer'])
	{
		case 'WMP':
			$Settings[$VideoPlayer]->Value = 1;
			$Settings[$VideoPlayer]->SaveSetting();
			break;
		case 'WMP7':
			$Settings[$VideoPlayer]->Value = 2;
			$Settings[$VideoPlayer]->SaveSetting();
			break;
		case 'QuickTime':
			$Settings[$VideoPlayer]->Value = 3;
			$Settings[$VideoPlayer]->SaveSetting();
			break;
		case 'HTML5':
			$Settings[$VideoPlayer]->Value = 4;
			$Settings[$VideoPlayer]->SaveSetting();
			break;
		default:
			echo 'Invalid video player!';
			die();
	}
}

function pageLocalDisplay()
{
	pageName('Video player selection'); //GetLanguageString('Welcome')

	global $Settings;
	global $VideoPlayer;

	$SelectedVideoPlayer = $Settings[$VideoPlayer]->Value;

	global $videosroot;

	$text = "<p>Choose below the video player that works the best for you:</p>";

	$text .= "<form action=\"choosevideoplayer.php\" method=\"post\">"; //!
	$text .= "<table style=\"width: 100%; text-align: center;\">";
	$text .= "<tr><td style=\"width: 50%;\"><object style=\"margin: 0px; padding: 0px; width: 95%;\"";
	$text .= " classid=\"CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95\""; //Media player 6.4 and earlier
	$text .= " codebase=\"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab\"";
	$text .= " standby=\"Loading Microsoft Windows Media Player Components...\"";
	$text .= " type=\"application/x-oleobject\">";
	$text .= "\n<param name=\"FileName\" VALUE=\"".$videosroot."QuakeLogo.avi\">";
	$text .= "\n<param name=\"AutoStart\" value=\"false\">";
	$text .= "\n<param name=\"Loop\" value=\"true\">";
	$text .= "\n<embed type=\"application/x-mplayer2\"";
	$text .= " SRC=\"".$videosroot."QuakeLogo.avi\"";
	$text .= " WIDTH=\"100%\"";
	$text .= " HEIGHT=\"100%\"";
	$text .= " AUTOSTART=\"0\"";
	$text .= " LOOP=\"1\">";
	$text .= "\n</object>";
	$text .= "</td><td style=\"width: 50%;\">";
	$text .= "<object style=\"margin: 0px; padding: 0px; width: 95%;\"";
	$text .= " classid=\"CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6\""; //Media player 7 and later
	$text .= " codebase=\"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab\"";
	$text .= " standby=\"Loading Microsoft Windows Media Player Components...\"";
	$text .= " type=\"application/x-oleobject\">";
	$text .= "\n<param name=\"FileName\" VALUE=\"".$videosroot."QuakeLogo.avi\">";
	$text .= "\n<param name=\"AutoStart\" value=\"false\">";
	$text .= "\n<param name=\"Loop\" value=\"true\">";
	$text .= "\n<embed type=\"application/x-mplayer2\"";
	$text .= " SRC=\"".$videosroot."QuakeLogo.avi\"";
	$text .= " WIDTH=\"100%\"";
	$text .= " HEIGHT=\"100%\"";
	$text .= " AUTOSTART=\"0\"";
	$text .= " LOOP=\"1\">";
	$text .= "\n</object>";
	$text .= "</td></tr>";
	$text .= "<tr><td><label><input type=radio name=\"videoplayer\" value=\"WMP\"".($SelectedVideoPlayer == 1 ? " checked=\"checked\"" : "").">Windows Media Player up to 6</label></td>";
	$text .= "    <td><label><input type=radio name=\"videoplayer\" value=\"WMP7\"".($SelectedVideoPlayer == 2 ? " checked=\"checked\"" : "").">Windows Media Player 7 or higher</label></td></tr>";
	$text .= "<tr><td style=\"width: 50%;\"><object style=\"margin: 0px; padding: 0px; width: 95%;\"";
	$text .= " classid=\"CLSID:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\""; //Quicktime player
	$text .= " codebase=\"http://www.apple.com/qtactivex/qtplugin.cab\"";
	$text .= " standby=\"Loading Quicktime Player Components...\"";
	$text .= " type=\"video/quicktime\">";
	$text .= "\n<param name=\"FileName\" VALUE=\"".$videosroot."QuakeLogo.avi\">";
	$text .= "\n<param name=\"AutoStart\" value=\"false\">";
	$text .= "\n<param name=\"Loop\" value=\"true\">";
	$text .= "\n<embed type=\"video/quicktime\"";
	$text .= " SRC=\"".$videosroot."QuakeLogo.avi\"";
	$text .= " WIDTH=\"100%\"";
	$text .= " HEIGHT=\"100%\"";
	$text .= " AUTOSTART=\"0\"";
	$text .= " LOOP=\"1\">";
	$text .= "\n</object>";
	$text .= "</td><td style=\"width: 50%;\">";
	$text .= "<video src=\"".$videosroot."QuakeLogo.mp4\" controls loop style=\"width: 95%;\">Your browser doesn't support the HTML 5 video tag.</video>";
	$text .= "</td></tr>";
	$text .= "<tr><td><label><input type=radio name=\"videoplayer\" value=\"QuickTime\"".($SelectedVideoPlayer == 3 ? " checked=\"checked\"" : "").">QuickTime Player</label></td>";
	$text .= "    <td><label><input type=radio name=\"videoplayer\" value=\"HTML5\"".($SelectedVideoPlayer == 4 ? " checked=\"checked\"" : "").">HTML5 video</label></td></tr>";
	$text .= "<tr><td colspan=2><input type=submit value=\"Use selected video player\"></td></tr>";
	$text .= "</table>";
	$text .= "</form>";

	pagePanel('movies', 'Video player selection', '', $text);

	$text = 'Graphics: Quake III Arena and QuArK<br>Audio: Summon the Rawk by Kevin MacLeod (incompetech.com)<br>Licensed under Creative Commons: By Attribution 3.0 License.';
	pagePanel('movies', 'Sample video license', '', $text);
}

pageDisplay('Video player selection', 'pageLocalDisplay');

?>
