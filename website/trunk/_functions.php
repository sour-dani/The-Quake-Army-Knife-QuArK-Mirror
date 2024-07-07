<?php
require_once('_main_paths.php');
require_once('_image_functions.php');
require_once('_settings_functions.php');
require_once('_settings-database.php');
require_once('_theme_functions.php');
require_once('_theme-database.php');

function DisplayEncodedEmail($address, $subject=NULL, $body=NULL)
{
	$email = $address;
	$argument = false;
	if (!is_null($subject))
	{
		if (!$argument)
		{
			$email .= '?';
			$argument = true;
		}
		else
			$email .= '&';
		$email .= 'subject=' . $subject;
	}
	if (!is_null($body))
	{
		if (!$argument)
		{
			$email .= '?';
			$argument = true;
		}
		else
			$email .= '&';
		$email .= 'body=' . $body;
	}
	return "\"javascript:mail_decode('" . str_rot13($email) . "');\"";
}

function DisplayDateTime($rawdatetime)
{
	global $Settings;
	global $SiteDateFormat, $SiteTimeFormat;

	$datetimeformat = $Settings[$SiteDateFormat]->GetCurrentValue() . ' - ' . $Settings[$SiteTimeFormat]->GetCurrentValue();

	//FIXME: Switch to strftime for localized version?
	if (is_null($rawdatetime))
	{
		$bodytext = date($datetimeformat);
	}
	else
	{
		$bodytext = date($datetimeformat, $rawdatetime);
	}
	return $bodytext;
}

function DisplayDate($rawdate)
{
	global $Settings;
	global $SiteDateFormat;

	//FIXME: Switch to strftime for localized version?
	if (is_null($rawdate))
	{
		$bodytext = date($Settings[$SiteDateFormat]->GetCurrentValue());
	}
	else
	{
		$bodytext = date($Settings[$SiteDateFormat]->GetCurrentValue(), $rawdate);
	}
	return $bodytext;
}

function DisplayTime($rawtime)
{
	global $Settings;
	global $SiteDateFormat;

	if (is_null($rawtime))
	{
		$bodytext = date($Settings[$SiteDateFormat]->GetCurrentValue());
	}
	else
	{
		$bodytext = date($Settings[$SiteDateFormat]->GetCurrentValue(), $rawtime);
	}
	return $bodytext;
}

function DisplayTimeAgo($date)
{
	$daysago = intval((time() - $date) / 86400);
	if ($daysago > 30)
	{
		$weeksago = intval($daysago / 7);
		$daysago = $daysago - (7 * $weeksago);
	} else {
		$weeksago = 0;
	}
	if ($daysago > 1)
		if ($weeksago > 1)
			$timeago = $weeksago . ' weeks and ' . $daysago . ' days ago';
		elseif ($weeksago === 1)
			$timeago = $weeksago . ' week and ' . $daysago . ' days ago';
		else
			$timeago = $daysago . ' days ago';
	elseif ($daysago === 1)
		if ($weeksago > 1)
			$timeago = $weeksago . ' weeks and ' . $daysago . ' day ago';
		elseif ($weekago === 1)
			$timeago = $weeksago . ' week and ' . $daysago . ' day ago';
		else
			$timeago = $daysago . ' day ago';
	elseif ($daysago === 0)
		if ($weeksago > 1)
			$timeago = $weeksago . ' weeks ago';
		elseif ($weekago === 1)
			$timeago = $weeksago . ' week ago';
		else
			$timeago = 'today';
	else
		$timeago = 'future';
	return $timeago;
}

function DisplayByteSize($numberofbytes)
{
	global $Settings;
	global $SiteNumberSeparators, $SiteByteFormat;

	$NumberSeparators = $Settings[$SiteNumberSeparators]->GetCurrentValue();

	switch ($Settings[$SiteByteFormat]->GetCurrentValue())
	{
	case 0:
		if ($numberofbytes >= 1000)
		{
			$numberofbytes = floatval($numberofbytes) / 1024.0;
			if ($numberofbytes >= 1000.0)
			{
				$numberofbytes /= 1024.0;
				if ($numberofbytes >= 1000.0)
				{
					$numberofbytes /= 1024.0;
					if ($numberofbytes >= 1000.0)
					{
						$numberofbytes /= 1024.0;
						$unit = 'TB';
					}
					else
					{
						$unit = 'GB';
					}
				}
				else
				{
					$unit = 'MB';
				}
			}
			else
			{
				$unit = 'KB';
			}
			$bodytext = number_format($numberofbytes, 1, $NumberSeparators[0], $NumberSeparators[1]) . ' ' . $unit;
		}
		else
		{
			$unit = 'B';
			$bodytext = number_format($numberofbytes, 0, $NumberSeparators[0], $NumberSeparators[1]) . ' ' . $unit;
		}
		break;
	case 1:
		$bodytext = number_format($numberofbytes, 0, $NumberSeparators[0], $NumberSeparators[1]) . ' B';
		break;
	case 2:
		$bodytext = number_format(floatval($numberofbytes)/1024.0, 1, $NumberSeparators[0], $NumberSeparators[1]) . ' KB';
		break;
	case 3:
		$bodytext = number_format(floatval($numberofbytes)/1024.0/1024.0, 1, $NumberSeparators[0], $NumberSeparators[1]) . ' MB';
		break;
	case 4:
		$bodytext = number_format(floatval($numberofbytes)/1024.0/1024.0/1024.0, 1, $NumberSeparators[0], $NumberSeparators[1]) . ' GB';
		break;
	case 5:
		$bodytext = number_format(floatval($numberofbytes)/1024.0/1024.0/1024.0/1024.0, 1, $NumberSeparators[0], $NumberSeparators[1]) . ' TB';
		break;
	default:
		trigger_error('ByteFormat value out of range!', E_USER_NOTICE);
		$bodytext = number_format($numberofbytes, 0, $NumberSeparators[0], $NumberSeparators[1]) . ' B';
	}
	return $bodytext;
}

function RefreshCookies()
{
	global $Themes;
	global $CurrentTheme;
	$Themes[$CurrentTheme]->SaveSettings();

	require_once('_panels-database.php');
	global $Panels;
	foreach ($Panels as /*$PanelName =>*/ $Panel)
	{
		$Panel->SaveSetting();
	}

	global $Settings;
	foreach ($Settings as /*$SettingName =>*/ $Setting)
	{
		$Setting->SaveSetting();
	}
}

function pageBegin($title=NULL)
{
	global $mainroot;
	global $Themes;
	global $CurrentTheme;

	require_once('_language_functions.php');

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">'."\n";
	echo '<html lang="'.GetLanguageObj()->Tag.'">';
	if (!is_null($title))
		$title = ' - ' . $title;
	echo '<head><title>The Official QuArK website' . $title . '</title>'."\n";
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'."\n";
	echo "<meta name=\"description\" content=\"QuArK is a powerful editor for video games based on or similar to id Software's series of Quake games. Currently it supports 41 distinct games, 5 generic game engines, and a countless number of expansions packs, addons, and mods. It integrates a map editor, model editor, archive editors, texture management, and much more.\">\n";
	echo '<meta name="keywords" content="QuArK, Quake Army Knife, map editor, model editor, Quake, Half-Life, Source engine, Torque game engine">'."\n";
	echo '<meta name="author" content="QuArK Development Team">'."\n";
	echo '<meta name="copyright" content="&copy; 1999 QuArK Development Team">'."\n";
	#echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">'."\n";
	echo '<link rel="shortcut icon" href="'.$mainroot.'favicon.ico" type="image/x-icon">'."\n";

	echo '<link rel="stylesheet" href="'.$mainroot.'themes/basestyle.css" type="text/css">'."\n";
	echo '<link rel="stylesheet" href="'.$mainroot.$Themes[$CurrentTheme]->CSSFilename.'" type="text/css">'."\n";

	#Snow 2021
	#echo '<script type="text/javascript" src="confetti.browser.js"></script>'."\n";

	# -- Javascript to decode ROT13 mailto:-addresses. A way to reduce spam (hopefully) --
	# -- Use like this in HTML: <a href="javascript:mail_decode('<a ROT13 mail-address>');">write me</a>
	echo "<script type=\"text/javascript\">function mail_decode(codedmailadr){decodedmailadr='to'+':';for(i=0;i<codedmailadr.length;i++){chr=codedmailadr.substr(i,1);idx='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.indexOf(chr);if(idx>-1){chr='nopqrstuvwxyzabcdefghijklmNOPQRSTUVWXYZABCDEFGHIJKLM'.substr(idx,1);}decodedmailadr=decodedmailadr+chr;}window.open('mail'+decodedmailadr,'email_protection_decoder','resizable=1,width=100,height=100');}</script>";

	#FIXME: We're not using frames anyway...
	#echo '<base url="'.$mainroot.'" target="_top">'."\n";
	echo '</head>'."\n";
	echo '<body>'."\n";

	# -- begin: visible page header. QuArK "logo"-image and required PlanetQuake AdBanner code --
	echo '<div class="header">'."\n";
	echo '<div class="headerlogo">';
	echo '<a href="'.$mainroot.'" title="The official QuArK website">'.DisplayImage('quarklogo').'</a>'."\n";
	echo '</div>';
	#echo '<div class="headerads">';
	###include('planetquake_adbanner_code.html');
	##include('cdunde_ad.html');
	#echo '<a href="/25years/">Quake and QuArK are 25 years old!</a>';
	#echo '</div>';
	echo '<div style="clear: both;"></div>';
	echo '</div>'."\n";
	# -- end: visible page header --
}

function pageEnd()
{
	#Snow 2021
	/*echo '<script type="text/javascript">
var skew = 1.0;

function randomInRange(min, max) {
  return Math.random() * (max - min) + min;
}

(function frame() {
  var ticks = 200;
  skew = Math.max(0.8, skew - 0.001);

  confetti({
    particleCount: 1,
    startVelocity: 0,
    ticks: ticks,
    origin: {
      x: Math.random(),
      // since particles fall down, skew start toward the top
      y: (Math.random() * skew) - 0.2
    },
    colors: [\'#ffffff\'],
    shapes: [\'circle\'],
    gravity: randomInRange(0.4, 0.6),
    scalar: randomInRange(0.4, 0.8),
    drift: randomInRange(-0.4, 0.4)
  });

  requestAnimationFrame(frame);
}());
</script>'."\n";*/

	# WEBRING HTML
	#FIXME: Technically, from Derrick McKay's qmap website...
	/*echo '<table cellspacing="7" style="background-color: black; border-color: gray; border-style: inset; border-width: 7px; color: white; margin-left: auto; margin-right: auto;">'."\n";
	echo '<tr>'."\n";
	echo '<td align="middle" style="border-style: inset; border-width: 1px;">'."\n";
	echo '<a href="http://orbit.simplenet.com/brush/ring/" target="_blank">'."\n";
	echo '<img width="160" height="160" src="http://orbit.simplenet.com/brush/ring/images/qewr.jpg" align="left" alt="The Quake Editing Web Ring" border="0"></a>'."\n";
	echo '</td>'."\n";
	echo '<td align="middle" style="border-style: inset; border-width: 1px;">'."\n";
	echo '<div class="centered">'."\n";
	echo '<p>This'."\n";
	echo '<a href="http://orbit.simplenet.com/brush/ring/" target="_blank">Quake Editing Ring</a> site is owned by'."\n";
	echo '<a href="mailto:dmckay@yknet.yk.ca">Derrick McKay</a>.'."\n";
	echo '</p><p>'."\n";
	echo '[ <a href="http://www.webring.org/cgi-bin/webring?ring=quakeedit&amp;id=17&amp;prev">Prev</a>'."\n";
	echo '| <a href="http://www.webring.org/cgi-bin/webring?ring=quakeedit&amp;id=17&amp;skip">Skip It</a>'."\n";
	echo '| <a href="http://www.webring.org/cgi-bin/webring?ring=quakeedit&amp;id=17&amp;next5">Next 5</a>'."\n";
	echo '| <a href="http://www.webring.org/cgi-bin/webring?ring=quakeedit&amp;id=17&amp;random">Random</a>'."\n";
	echo '| <a href="http://www.webring.org/cgi-bin/webring?ring=quakeedit&amp;id=17&amp;next">Next</a> ]'."\n";
	echo '</p>'."\n";
	echo '<p>Want to join the ring?  Get the <a href="http://orbit.simplenet.com/brush/ring/" target="_blank">info</a>.</p>'."\n";
	echo '</div>'."\n";
	echo '</td>'."\n";
	echo '</tr>'."\n";
	echo '</table>'."\n";*/

	# Slipgate search
	/*echo '<div class="pagepanel"><div class="pagepanelbody"><div class="centered">';
	echo '<p>Wanna find something Quake related ??</p>';
	echo '<form action="http://www.slipgatecentral.com/search.cgi" method="GET">
Search the <a href="http://www.slipgatecentral.com/">Slipgate Central</a> Quake web site directory:
<input name="term" size="16">
<input type="submit" value="Go!">
</form>';
	echo '</div></div></div>'."\n";*/

	# -- visible page footer --
	echo '</body>'."\n";
	echo '</html>'."\n";
}

function pageName($name)
{
	echo '<div class="pagepanel">';
	echo '<div class="pagenamepanel">' . $name . '...</div>';
	echo '</div>'."\n";
}

function pagePanel($icon, $headline1, $headline2, $bodytext)
{
	echo '<div class="pagepanel">';

	if ((!is_null($icon)) or (!empty($headline1)) or (!empty($headline2)))
	{
		echo '<div class="pagepanelhead">';

		echo '<table cellpadding=0 cellspacing=0 width="100%"><tr valign=middle>';
		if (!is_null($icon))
		{
			echo '<td style="width: 16px;" class="panelheader">' . DisplayImage($icon) . '</td>';
		}
		if (!empty($headline1))
		{
			echo '<td align=left class="panelheader">' . $headline1 . '</td>';
		}
		if (!empty($headline2))
		{
			echo '<td align=right class="panelheader">' . $headline2 . '</td>';
		}
		echo '</tr></table>';

		echo '</div>';
	}

	echo '<div class="pagepanelbody">' . $bodytext . '</div>';

	echo '</div>'."\n";
}

function pageRawFile($filename)
{
	$thefile = file($filename);
	$bodytext = '';
	foreach ($thefile as $line)
	{
		$bodytext .= $line;
	}

	echo $bodytext;
}

function pagePanelFile($icon, $headline1, $headline2, $filename)
{
	$thefile = file($filename);
	$bodytext = '';
	foreach ($thefile as $line)
	{
		$bodytext .= $line;
	}

	pagePanel($icon, $headline1, $headline2, $bodytext);
}

function pageSidePanel($icon, $headline1, $bodytext)
{
	echo '<div class="sidepanel">';
	if ((!empty($icon)) or (!empty($headline1)))
	{
		echo '<div class="sidepanelhead">';

		if (!empty($icon))
			echo DisplayImage($icon);

		if (!empty($headline1))
		{
			if (!empty($icon))
				echo '&nbsp;';
			echo $headline1;
		}

		echo '</div>';
	}

	echo '<div class="sidepanelbody">' . $bodytext . '</div>';

	echo '</div>'."\n";
}

function pageDisplay($title, $pageFunction)
{
	require_once('_panels_functions.php');
	require_once('_panels-database.php');
	global $Panels;

	global $DonatePanel, $ThemePanel, $DownloadPanel, $PoweredByPanel, $TimePanel, $ValidHTMLPanel, $NoticePanel, $InstaPollPanel, $ForumStatsPanel, $UsefulPanel, $InterestPanel;

	//We can't do this earlier, or it will overwrite the new settings set in layout.php
	RefreshCookies();

	//---This is the point where we finalize the headers of the response by starting the response body.

	pageBegin($title);

	echo '<div class="pagebody">';

	echo '<div class="leftcolumn">';
	if (isPanelVisible($DownloadPanel)) {
		include($Panels[$DownloadPanel]->IncludeFile);
	}
	include('_navbar.php');
	if (isPanelVisible($DonatePanel)) {
		include($Panels[$DonatePanel]->IncludeFile);
	}
	if (isPanelVisible($ThemePanel)) {
		include($Panels[$ThemePanel]->IncludeFile);
	}
	if (isPanelVisible($PoweredByPanel)) {
		include($Panels[$PoweredByPanel]->IncludeFile);
	}
	if (isPanelVisible($TimePanel)) {
		include($Panels[$TimePanel]->IncludeFile);
	}
	if (isPanelVisible($ValidHTMLPanel)) {
		include($Panels[$ValidHTMLPanel]->IncludeFile);
	}
	echo '</div>'."\n";

	echo '<div class="centercolumn">';
	$pageFunction(); #This outputs through echo
	echo '</div>'."\n";

	echo '<div class="rightcolumn">';
	if (isPanelVisible($NoticePanel)) {
		include($Panels[$NoticePanel]->IncludeFile);
	}
	if (isPanelVisible($InstaPollPanel)) {
		include($Panels[$InstaPollPanel]->IncludeFile);
	}
	include('_forumpanel.php');
	//include('_pathogenpanel.php'); #No longer available in App Store
	if (isPanelVisible($ForumStatsPanel)) {
		include($Panels[$ForumStatsPanel]->IncludeFile);
	}
	if (isPanelVisible($UsefulPanel)) {
		include($Panels[$UsefulPanel]->IncludeFile);
	}
	if (isPanelVisible($InterestPanel)) {
		include($Panels[$InterestPanel]->IncludeFile);
	}
	echo '</div>';

	echo '</div>'."\n";

	pageEnd();
}

?>
