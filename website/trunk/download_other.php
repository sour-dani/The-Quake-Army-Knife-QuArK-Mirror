<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_download_other-database.php');
require_once('_game-database.php');

# Load language file
LoadLanguageFile('download_other.php');

$IntroMessage = '<p>This table lists miscellaneous other stuff, like SDKs (Software Development Kits) and game source code. If you find a broken link or know of a missing interesting item, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK Game Other page correction').'>tell us</a>, and we will try to correct it.</p>';

function pageLocalDisplay()
{
	pageName('Game Other');

	global $IntroMessage;

	global $Games, $GamesQRKOther;

	$Table2Rows = array('table2rowA', 'table2rowB');
	$CurrentRow = 0;

	$bodytext = $IntroMessage;

	# Build Table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>Game Other</b></td></tr>';

	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];
		if (is_null($CurrentGame->FromVersion) and (!array_key_exists($CurrentGame->GameID, $GamesQRKOther)))
		{
			# No support for this game and no others: don't display!
			continue;
		}

		$bodytext .= '<tr>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=center>'.DisplayGameIcon($Game).'</td>';

		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">'.$CurrentGame->GameTitle.'</td>';

		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';

		$OtherFound = false;

		# Loop though other for this game
		$GameID = &$CurrentGame->GameID;
		if (array_key_exists($GameID, $GamesQRKOther))
		{
			$bodytext .= '<ul class="nowhitespace">';
			if (is_array($GamesQRKOther[$GameID])) # Make sure there's an array below the entry...
			{
				for ($Other = 0; $Other < count($GamesQRKOther[$GameID]); $Other++)
				{
					$CurrentOther = &$GamesQRKOther[$GameID][$Other];
					$bodytext .= '<li>';
					if (!is_null($CurrentOther->URL))
						$bodytext .= '<a href="'.$CurrentOther->URL.'">'.$CurrentOther->Title.'</a>';
					else
						$bodytext .= $CurrentOther->Title;
					if (!is_null($CurrentOther->Description))
						$bodytext .= ': '.$CurrentOther->Description;
					$bodytext .= '</li>';
				}

				$OtherFound = true;
			}
			$bodytext .= '</ul>';
		}

		if (!$OtherFound)
		{
			$bodytext .= '&nbsp;';
		}
		$bodytext .= '</td></tr>'; $CurrentRow++;
		$bodytext .= "\n";
	}

	$bodytext .= '</table>';

	pagePanel('download', 'Game Other', '', $bodytext);
}

pageDisplay('Download Other', 'pageLocalDisplay');

?>
