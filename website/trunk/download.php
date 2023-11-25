<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_download_applications-database.php');
require_once('_download_patches-database.php');
require_once('_game-database.php');
require_once('_image_functions.php');
require_once('_panels_functions.php');
require_once('_panels-database.php');

# Load language file
LoadLanguageFile('download.php');

global $DownloadPanel;
hidePanel($DownloadPanel);

global $mainroot;
global $infobaseroot;
global $downloadroot;

if (isset($_GET['showsuperseded']))
{
	$ShowSuperseded = ($_GET['showsuperseded'] != 0);
}
else
{
	$ShowSuperseded = FALSE;
}

if (isset($_GET['shownonfinal']))
{
	$ShowNonFinal = ($_GET['shownonfinal'] != 0);
}
else
{
	$ShowNonFinal = FALSE;
}

$IntroMessage = "<p>This matrix lists the main QuArK downloads, including a list of what games are supported by each release. Click on a game's icon for more information about that game.</p>
<p>The needed build-tools for the specific games are not listed here, as they are not part of the QuArK-download; they can be downloaded separately <a href=\"".$mainroot."download_tools.php\">here</a>. Some games might require a gamepak for correct mapping, which can be downloaded <a href=\"".$mainroot."download_gamepaks.php\">here</a>.</p>
<p>Look <a href=\"".$mainroot."features.php#sysreqs\">here</a> for a list of system requirements.</p>";

$HelpMessage = '<div class="centered">
The latest file that contains all the online documentation found on the <a href="'.$infobaseroot.'">InfoBase</a> pages can be downloaded from here:<br>
<br>
<a href="https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.6.0%20Beta%207/quark-help-6.6.0Beta7.zip/download">quark-help-6.6.0Beta7.zip</a>
</div>';

$PatchIntro = '<p>Some releases contain annoying and/or major bugs. Often, a patch is released to fix those problems. The fix is of course integrated into later releases, so these patches are for one specific release only. They are listed below here:</p>';

$DependenciesInstaller = '<p>QuArK requires some other software packages and patches to be installed. These are all bundled together into one installer: <a href="https://sourceforge.net/projects/quark/files/QuArK%20dependencies/quark-dependencies.exe/download">QuArK dependencies installer</a>.</p>';

$PythonMessage = '<p>Download and install Mini-Python prior to installing <b>QuArK 5.10</b> or <b>QuArK 6.3.0</b>!<br>
<br>
Mini-Python package: <a href="'.$downloadroot.'minipy15b.exe">minipy15b.exe</a>.<br>
<br>
You can also get Python with SDK from <a rel="nofollow noopener" target="_blank" href="https://www.python.org/">www.python.org</a>. BEWARE though, as only Python v1.5.1 and v1.5.2 work with QuArK 5.10 or QuArK 6.3.0.<br>
Note: Newer versions of QuArK include their own Python: no need to install Mini-Python or the Python SDK.</p>';
#http://dl.fileplanet.com/dl/dl.asp?quark/minipy15b.exe

$OldiesMessage = '<p>' . DisplayImage('alert') . '&nbsp;<b>WARNING</b>&nbsp;' . DisplayImage('alert') . '<br>This stuff is ANCIENT!</p>

<p>Only for the archaeology-computer-nerds: <a href="'.$mainroot.'download_oldies.php">Click here</a>.</p>';

function pageLocalDisplay()
{
	pageName('Download');

	global $IntroMessage, $HelpMessage, $DependenciesInstaller, $PythonMessage, $OldiesMessage;
	global $PatchIntro;

	global $ShowSuperseded, $ShowNonFinal;

	echo '<a name="quark"></a>';
	$bodytext = $IntroMessage;

	$bodytext .= '<form action="download.php" method="GET"><fieldset><legend>Filter the downloadslist</legend>
	<label><input type="checkbox" name="showsuperseded" value="1"'.($ShowSuperseded ? ' checked' : '').'>Include superseded versions</label><br>
	<!--label><input type="checkbox" name="shownonfinal" value="1"'.($ShowNonFinal ? ' checked' : '').'>Include non-final versions</label><br-->
	<input type="submit">
	</fieldset></form>';

	global $Applications, $Games;
	global $Patches;

	global $RecommendedApplication;

	# Build Table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, downloadtabletitle" colspan=3 align=right><b>QuArK Downloads</b></td></tr>';

	# Here we create an array with an entry for each game, with the app for which this game should appear as supported.
	$GameAppSupported = array();
	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];

		$GameAppSupported[$Game] = -1;

		if (is_null($CurrentGame->FromVersion))
			# Game is not supported by any app version
			continue;

		$SupportApplication = findAppl($CurrentGame->FromVersion);
		if ($SupportApplication === FALSE)
			# Game is not supported by any KNOWN app version
			continue;

		while ($Applications[$SupportApplication]->AlwaysHidden or (!$Applications[$SupportApplication]->IsFinal and !$ShowNonFinal) or ($Applications[$SupportApplication]->IsSuperseded and !$ShowSuperseded))
		{
			$SupportApplication++;
			if ($SupportApplication == count($Applications))
			{
				# Game is not supported by any DOWNLOADABLE app version
				$SupportApplication = -1;
				break;
			}
		}

		$GameAppSupported[$Game] = $SupportApplication;
	}

	for ($Application = count($Applications) - 1; $Application >= 0; $Application--)
	{
		$CurrentApplication = &$Applications[$Application];
		if ($CurrentApplication->AlwaysHidden or (!$CurrentApplication->IsFinal and !$ShowNonFinal) or ($CurrentApplication->IsSuperseded and !$ShowSuperseded))
		{
			// Not allowed to download: skip it
			continue;
		}

		//The application name
		$bodytext .= '<tr><td class="text1, downloadtablehead" style="white-space: nowrap;"><b>'.$CurrentApplication->ApplTitle.'</b></td>';

		//Skip first row
		$bodytext .= '<td class="text1, downloadtableempty" colspan=2>&nbsp;</td>';

		//Skip first column
		$bodytext .= '<tr><td class="text1, downloadtableempty">&nbsp;</td>';

		//Application games
		$bodytext .= '<td class="text1, downloadtabledata" style="white-space: nowrap;">New game support:</td>';
		$bodytext .= '<td class="text1" style="background-color: '.$CurrentApplication->Color.';" align=center>';
		$GameFound = false;
		for ($Game = 0; $Game < count($Games); $Game++)
		{
			if ($GameAppSupported[$Game] === $Application)
			{
				if (!$GameFound)
				{
					$bodytext .= '<table cellpadding=2 cellspacing=0><tr>';
					$GameFound = true;
				}
				$bodytext .= '<td class="text1" style="background-color: '.$CurrentApplication->Color.';">'.DisplayGameIcon($Game).'</td>';
			}
		}
		if (!$GameFound)
		{
			$bodytext .= '*None*';
		}
		else
		{
			$bodytext .= '</tr></table>';
		}
		$bodytext .= '</td></tr>';

		for ($OlderApp = $Application-1; $OlderApp >= 0; $OlderApp--)
		{
			//Skip first column
			$bodytext2 = '<tr><td class="text1, downloadtableempty"></td>';

			//Application games (from older versions)
			$bodytext2 .= '<td class="text1, downloadtabledata"></td>';
			$bodytext2 .= '<td class="text1" style="background-color: '.$Applications[$OlderApp]->Color.';" align=center>';
			$GameFound = false;
			for ($Game = 0; $Game < count($Games); $Game++)
			{
				if ($GameAppSupported[$Game] == $OlderApp)
				{
					if (!$GameFound)
					{
						$bodytext2 .= '<table cellpadding=2 cellspacing=0><tr>';
						$GameFound = true;
					}
					$bodytext2 .= '<td class="text1" style="background-color: '.$Applications[$OlderApp]->Color.';">'.DisplayGameIcon($Game).'</td>';
				}
			}
			if (!$GameFound)
			{
				$bodytext2 .= '*None*';
			}
			else
			{
				$bodytext2 .= '</tr></table>';
			}
			$bodytext2 .= '</td></tr>';

			if ($GameFound)
			{
				// Only add this code if there actually is something to add!
				$bodytext .= $bodytext2;
			}
		}

		//Skip first column
		$bodytext .= '<tr><td class="text1, downloadtableempty"></td>';

		//Application release date
		$bodytext .= '<td class="text1, downloadtabledata" style="white-space: nowrap;">Release date:</td>';
		$bodytext .= '<td class="text1, downloadtabledata">';
		if ($CurrentApplication->ReleaseDate !== 0)
		{
			$bodytext .= DisplayDate($CurrentApplication->ReleaseDate);
		}
		else
		{
			$bodytext .= 'Unknown';
		}
		if ($CurrentApplication->VersionID === $RecommendedApplication)
		{
			$bodytext .= '<br><b>Latest, recommended release.</b>';
		}
		$bodytext .= '</td></tr>';

		//Skip first column
		$bodytext .= '<tr><td class="text1, downloadtableempty"></td>';

		//The application license
		$bodytext .= '<td class="text1, downloadtabledata" style="white-space: nowrap;">License:</td>';
		$bodytext .= '<td class="text1, downloadtabledata">'.$CurrentApplication->LicenseText.'</td></tr>';

		//Skip first column
		$bodytext .= '<tr><td class="text1, downloadtableempty"></td>';

		//Application download links
		$bodytext .= '<td class="text1, downloadtabledata" style="white-space: nowrap;">Download:</td>';
		$bodytext .= '<td class="text1, downloadtabledata">';
		if (is_array($CurrentApplication->DownloadURL))
		{
			$CntDownloadURL = count($CurrentApplication->DownloadURL);
			for ($DownloadURL = 0; $DownloadURL < $CntDownloadURL; $DownloadURL++)
			{
				if ($DownloadURL !== 0)
				{
					$bodytext .= '<br>';
				}
				if ($CntDownloadURL !== 1)
				{
					$bodytext .= '<a href="'.$CurrentApplication->DownloadURL[$DownloadURL].'">'.DisplayImage('download_arrow', '32', '32').'&nbsp;Click here to download (mirror '.($DownloadURL+1).')</a>';
				}
				else
				{
					$bodytext .= '<a href="'.$CurrentApplication->DownloadURL[$DownloadURL].'">'.DisplayImage('download_arrow').'&nbsp;Click here to download</a>';
				}
			}
		}
		else
		{
			$bodytext .= '*no link*';
		}
		$bodytext .= '</td></tr>';

		if (!is_null($CurrentApplication->Comments))
		{
			//Skip first column
			$bodytext .= '<tr><td class="text1, downloadtableempty"></td>';

			//The application comments
			$bodytext .= '<td class="text1, downloadtabledata" style="white-space: nowrap;">Comments:</td>';
			$bodytext .= '<td class="text1, downloadtabledata"><ul class="nowhitespace">';
			for ($Comment = 0; $Comment < count($CurrentApplication->Comments); $Comment++)
			{
				$CurrentComment = &$CurrentApplication->Comments[$Comment];
				$bodytext .= '<li>'.$CurrentComment.'</li>';
			}
			$bodytext .= '</ul></td></tr>';
		}
	}

	$bodytext .= '</table>';

	pagePanel('download', 'QuArK', '', $bodytext);
	unset($bodytext);

	echo '<a name="help"></a>';
	pagePanel('download', 'Online-Help', '', $HelpMessage);

	echo '<a name="dependencies"></a>';
	pagePanel('download', 'Dependencies installer', '', $DependenciesInstaller);

	if (count($Patches) !== 0) #FIXME: Might still display without a patch visible...!
	{
		echo '<a name="patches"></a>';
		$bodytext = $PatchIntro;
		$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
		$bodytext .= '<tr><td class="text1, downloadtabletitle" colspan=2 align=right><b>QuArK Patches</b></td></tr>';

		$OldVersionID = NULL;
		for ($Patch = count($Patches) - 1; $Patch >= 0; $Patch--)
		{
			$CurrentPatch = &$Patches[$Patch];
			if ($CurrentPatch->AlwaysHidden)
			{
				#Move along, nothing to see here...
				continue;
			}

			if ($CurrentPatch->VersionID !== $OldVersionID)
			{
				$PatchApplication = findAppl($CurrentPatch->VersionID);
				if ($PatchApplication === FALSE)
				{
					# Patch for unknown application version; let's skip it...
					continue;
				}
				if ($Applications[$PatchApplication]->AlwaysHidden or (!$Applications[$PatchApplication]->IsFinal and !$ShowNonFinal) or ($Applications[$PatchApplication]->IsSuperseded and !$ShowSuperseded))
				{
					# Patch for non-showing application; let's skipt it...
					continue;
				}
				$bodytext .= '<tr><td class="text1, downloadtablehead"><b>'.$Applications[$PatchApplication]->ApplTitle.'</b></td>';
				$bodytext .= '<td class="text1, downloadtableempty">&nbsp;</td></tr>';

				$OldVersionID = $CurrentPatch->VersionID;
			}
			else
			{
				$bodytext .= '<tr><td class="text1, downloadtableempty" colspan=2>&nbsp;</td></tr>';
			}

			$bodytext .= '<tr><td class="text1, downloadtableempty">&nbsp;</td>';
			$bodytext .= '<td class="text1, downloadtabledata">';
			if (!is_null($CurrentPatch->Description))
			{
				$bodytext .= $CurrentPatch->Description;
			}
			else
			{
				$bodytext .= '&nbsp;';
			}
			$bodytext .= '<br>&nbsp;<br>Download: <a href="'.$CurrentPatch->DownloadURL[0].'">Click here!</a>'; #FIXME: Allow for multiple links!
			$bodytext .= '</td></tr>';
		}

		$bodytext .= '</table>';
		pagePanel('download', 'Patches', '', $bodytext);
		unset($bodytext);
	}

	echo '<a name="python"></a>';
	pagePanel('download', 'Python', '', $PythonMessage);

	echo '<a name="oldies"></a>';
	pagePanel('download', 'Oldies', '', $OldiesMessage);
}

pageDisplay('Download', 'pageLocalDisplay');

?>
