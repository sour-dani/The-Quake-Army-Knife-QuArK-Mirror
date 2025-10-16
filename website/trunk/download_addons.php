<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_download_addons-database.php');
require_once('_game-database.php');
require_once('_main_paths.php');

global $mainroot;
global $webmasteremail;

# Load language file
LoadLanguageFile('download_addons.php');

$IntroText = '<p>This page tries to list all the known addons for QuArK, and their download links. If you ever find an error or some outdated addon, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK Addons page correction').'>tell us</a>, and we will try to correct it.</p>

<p>Also, if you have made an addon, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK Addons page addition').'>tell us about it</a>, and we will create a link to your addon from this page. If you need help on creating an addon, please post your question(s) to the <a href="'.$mainroot.'communication.php#forums">QuArK forum</a>.</p>

<p>' . DisplayImage('alert') . '&nbsp;<b>Notice</b>&nbsp;' . DisplayImage('alert') . ' Some of these addons come directly from our Code Repository (they are marked), and are already bundled with the QuArK installer.</p>';

function pageLocalDisplay()
{
	pageName('QuArK Addons');

	global $IntroText;

	global $Games, $GamesQRKAddons;

	global $webmasteremail;

	$bodytext = $IntroText;

	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];
		if (is_null($CurrentGame->FromVersion) and (!array_key_exists($CurrentGame->GameID, $GamesQRKAddons)))
		{
			# No support for this game and no addons: don't display!
			continue;
		}

		# Setup table header'n'stuff
		$bodytext .= '<a name="'.$CurrentGame->GameID.'"></a>';
		$bodytext .= '<table cellpadding=2 cellspacing=1 width="95%" align=center>';

		$bodytext .= '<tr><td class="tablehead" colspan=2><b>'.$CurrentGame->GameTitle.'</b></td></tr>';

		$bodytext .= '<tr><td class="tablesubhead" colspan=2><table cellpadding=6><tr><td class="tablesubhead">'.DisplayGameIcon($Game, null, '32', '32').'</td>';
		$bodytext .= '<td class="tablesubhead">If you find an error or an addon which is outdated, please <a href='.DisplayEncodedEmail($webmasteremail, 'Addon error/outdated').'>tell us</a>.</td></tr>';
		$bodytext .= '</table></td></tr>';

		$AddonsFound = false;

		# Loop though addons for this game
		$GameID = &$CurrentGame->GameID;
		if (array_key_exists($GameID, $GamesQRKAddons))
		{
			if (is_array($GamesQRKAddons[$GameID])) # Make sure there's an array below the entry...
			{
				for ($Addon = 0; $Addon < count($GamesQRKAddons[$GameID]); $Addon++)
				{
					$CurrentAddon = &$GamesQRKAddons[$GameID][$Addon];
					$bodytext .= '<tr><td class="tablecell" width="35%">';
					if ($CurrentAddon->TitleURL != '')
					{
						$bodytext .= '<a href="'.$CurrentAddon->TitleURL.'">'.$CurrentAddon->Title.'</a>';
					}
					else
					{
						$bodytext .= $CurrentAddon->Title;
					}
					if ($CurrentAddon->TitleComment != '')
					{
						$bodytext .= '<br> - <span class="sml">'.$CurrentAddon->TitleComment.'</span>';
					}
					$bodytext .= '</td>';

					$bodytext .= '<td class="tablecell" width="65%">';
					$bodytext .= '<a href="'.$CurrentAddon->FileDownloadURL.'">'.$CurrentAddon->Filename.'</a>';
					if ($CurrentAddon->FileComment != '')
					{
						$bodytext .= ' <span class="sml">'.$CurrentAddon->FileComment.'</span>';
					}
					$bodytext .= '</td></tr>';

					$AddonsFound = true;
				}
			}
		}

		if (!$AddonsFound)
		{
			$bodytext .= '<tr><td class="tablecell" colspan=2 align=center><span class="sml">No add-on(s) registered yet.</span></td></tr>';
		}

		# End the table
		$bodytext .= '</table><br><br>';
	}

	pagePanel('download', 'QuArK Addons', '', $bodytext);
}

pageDisplay('QuArK Addons', 'pageLocalDisplay');

?>
