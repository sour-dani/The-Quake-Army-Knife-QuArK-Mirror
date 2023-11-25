<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_download_gamepatches-database.php');
require_once('_game-database.php');

# Load language file
LoadLanguageFile('download_gamepatches.php');

$IntroMessage = '<p>This matrix lists all the known official and unofficial game patches (that still matter) for games supported by QuArK. If you find a broken link or know of a missing patch, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK Gamepatches page correction').'>tell us</a>, and we will try to correct it.</p>';

function pageLocalDisplay()
{
	pageName('Game Patches');

	global $IntroMessage;

	global $Games, $GamesQRKGamePatches;

	$Table2Rows = array('table2rowA', 'table2rowB');
	$CurrentRow = 0;

	$bodytext = $IntroMessage;

	# Build Table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>Game Patches</b></td></tr>';

	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];
		$GameID = &$CurrentGame->GameID;
		if (is_null($CurrentGame->FromVersion) and (!array_key_exists($GameID, $GamesQRKGamePatches)))
		{
			# No support for this game and no game patches: don't display!
			continue;
		}

		$bodytext .= '<tr>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=center><a name="'.$CurrentGame->GameID.'"></a>'.DisplayGameIcon($Game).'</td>';

		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">'.$CurrentGame->GameTitle.'</td>';

		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';

		$GamePatchesFound = false;

		# Loop though tools for this game
		if (array_key_exists($GameID, $GamesQRKGamePatches))
		{
			$bodytext .= '<ul class="nowhitespace">';
			for ($GamePatch = 0; $GamePatch < count($GamesQRKGamePatches[$GameID]); $GamePatch++)
			{
				$CurrentGamePatch = &$GamesQRKGamePatches[$GameID][$GamePatch];
				$bodytext .= '<li>';
				if (!is_null($CurrentGamePatch->URL))
					$bodytext .= '<a href="'.$CurrentGamePatch->URL.'">'.$CurrentGamePatch->Title.'</a>';
				else
					$bodytext .= $CurrentGamePatch->Title;
				if (!is_null($CurrentGamePatch->Description))
					$bodytext .= ': '.$CurrentGamePatch->Description;
				$bodytext .= '</li>';
			}
			$bodytext .= '</ul>';

			$GamePatchesFound = true;
		}

		if (!$GamePatchesFound)
		{
			$bodytext .= '&nbsp;';
		}
		$bodytext .= '</td></tr>'; $CurrentRow++;
		$bodytext .= "\n";
	}

	$bodytext .= '</table>';

	pagePanel('download', 'Game Patches', '', $bodytext);
}

pageDisplay('Download Game Patches', 'pageLocalDisplay');

?>
