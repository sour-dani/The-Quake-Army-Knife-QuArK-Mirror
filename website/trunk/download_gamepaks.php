<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_download_gamepaks-database.php');
require_once('_game-database.php');

# Load language file
LoadLanguageFile('download_gamepaks.php');

$IntroText = '<p>This matrix lists the currently available Game support packages for QuArK version 6.5.0 Beta1 and newer that can be downloaded from here. These packages are not part of the <a href="download.php#quark">QuArK-download releases</a> but are necessary for complete and proper support of those games.</p>';

function pageLocalDisplay()
{
	pageName('Game Paks');

	global $IntroText;

	global $Games, $GamesQRKGamepaks;

	$Table2Rows = array('table2rowA', 'table2rowB');
	$CurrentRow = 0;

	$bodytext = $IntroText;

	# Build Table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>Game Support Paks</b></td></tr>';

	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];
		$GameID = &$CurrentGame->GameID;
		if (is_null($CurrentGame->FromVersion) and (!array_key_exists($GameID, $GamesQRKGamepaks)))
		{
			# No support for this game and no tools: don't display!
			continue;
		}

		$bodytext .= '<tr>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=center>'.DisplayGameIcon($Game).'</td>';

		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">'.$CurrentGame->GameTitle.'</td>';

		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';

		# Loop though tools for this game
		if (array_key_exists($GameID, $GamesQRKGamepaks))
		{
			$bodytext .= '<ul class="nowhitespace">';
			for ($Gamepak = 0; $Gamepak < count($GamesQRKGamepaks[$GameID]); $Gamepak++)
			{
				$CurrentGamepak = &$GamesQRKGamepaks[$GameID][$Gamepak];
				$bodytext .= '<li>';
				if (!is_null($CurrentGamepak->URL))
				{
					$bodytext .= '<a href="'.$CurrentGamepak->URL.'">'.$CurrentGamepak->Title.'</a>';
				}
				else
				{
					$bodytext .= $CurrentGamepak->Title;
				}
				if (!is_null($CurrentGamepak->Description))
					$bodytext .= ': '.$CurrentGamepak->Description;
				$bodytext .= '</li>';
			}
			$bodytext .= '</ul>';
		}
		else
		{
			$bodytext .= '&nbsp;';
		}
		$bodytext .= '</td></tr>'; $CurrentRow++;
		$bodytext .= "\n";
	}

	$bodytext .= '</table>';

	pagePanel('download', 'Game Paks', '', $bodytext);
}

pageDisplay('Game Paks Download', 'pageLocalDisplay');

?>
