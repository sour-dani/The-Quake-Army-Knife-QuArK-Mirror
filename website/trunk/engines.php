<?php
require_once('_base_code.php');
require_once('_engine-database.php');
require_once('_language_functions.php');
require_once('_game-database.php');

# Load language file
LoadLanguageFile('engines.php');

function pageLocalDisplay()
{
	pageName('Game engines');

	global $webmasteremail;
	global $Engines;
	global $Games;

	$Table2Rows = array('table2rowA', 'table2rowB');

	$CurrentRow = 0;

	$bodytext = "<p>QuArK supports loading and editing the resources of many different game engines. Here's a list of engines, and in which games they are used.</p>";

	$bodytext .= '<p>If you find an error, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK engine data error').'>tell us</a>.</p>';

	# Build Table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>Engine list</b></td></tr>';
	foreach ($Engines as $Engine => $CurrentEngine)
	{
		$bodytext .= '<tr>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=center>'.DisplayEngineIcon($Engine).'</td>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';
		$bodytext .= '<a href="#'.$CurrentEngine->ID.'">'.$CurrentEngine->Name.'</a>';
		$bodytext .= '</td>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=left>';
		/*if (is_null($CurrentGame->Description))
		{
			$bodytext .= '&nbsp;';
		}
		else
		{
			$bodytext .= $CurrentGame->Description;
		}*/
		$bodytext .= '</td>';
		$bodytext .= '</tr>'; $CurrentRow++;
		$bodytext .= "\n";
	}
	$bodytext .= '</table><br>';

	$bodytext .= '<hr class="smallbreak">';

	foreach ($Engines as $Engine => $CurrentEngine)
	{
		$bodytext .= '<a name="'.$CurrentEngine->ID.'"></a>';
		$bodytext .= '<table cellpadding=2 cellspacing=0 width="95%" align=center>';

		$bodytext .= '<tr><td class="tablehead">';
		$bodytext .= '<b>'.$CurrentEngine->Name.'</b>';
		$bodytext .= '</td></tr>';

		$bodytext .= '<tr><td class="tablesubhead">';

		$bodytext .= '<table cellpadding=6><tr><td class="tablesubhead">';
		if (!is_null($CurrentEngine->URL))
		{
			$bodytext .= DisplayEngineIcon($Engine, $CurrentEngine->URL, '32', '32');
		}
		else
		{
			$bodytext .= DisplayEngineIcon($Engine, null, '32', '32');
		}
		$bodytext .= '</td><td class="tablesubhead">';
		/*if (!is_null($CurrentEngine->Description))
		{
			$bodytext .= $CurrentEngine->Description;
		}
		else
		{
			$bodytext .= '<span class="replacementgamename">[' . $CurrentEngine->Name . ']</span>';
		}*/
		$bodytext .= '</td></tr></table></td></tr>';

		$bodytext .= '<tr><td class="tablecell">';

		$bodytext .= '<table cellpadding=0 cellspacing=0 width="100%">';

		# License-line
		if (!is_null($CurrentEngine->License))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'License type:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= $CurrentEngine->License;
			$bodytext .= '</td></tr>';
		}

		# Website-line
		if (!is_null($CurrentEngine->URL))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Official website:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= '<a href="'.$CurrentEngine->URL.'" title="Official '.$CurrentEngine->Name.' website" target="_blank" rel="nofollow noopener">'.$CurrentEngine->URL.'</a>';
			$bodytext .= '</td></tr>';
		}

		# Wikipedia-line
		if (!is_null($CurrentEngine->WikipediaURL))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Wikipedia article:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= '<a href="'.$CurrentEngine->WikipediaURL.'" title="'.$CurrentEngine->Name.' Wikipedia article" target="_blank" rel="nofollow noopener">'.$CurrentEngine->WikipediaURL.'</a>';
			$bodytext .= '</td></tr>';
		}

		# Based on-line
		if (!is_null($CurrentEngine->BasedOn))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Based on:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= '<a href="engines.php#'.$CurrentEngine->BasedOn.'">'.$Engines[$CurrentEngine->BasedOn]->Name.'</a>';
			$bodytext .= '</td></tr>';
		}

		#Gather game information
		$tmpGames = '';
		for ($Game = 0; $Game < count($Games); $Game++)
		{
			$CurrentGame = &$Games[$Game];
			if ($CurrentGame->Engine === $Engine)
			{
				if ($tmpGames != '')
					$tmpGames .= '<br>';
				$tmpGames .= '<a href="games.php'.getGamesQuery($CurrentGame->GameID).'#'.$CurrentGame->GameID.'">'.$CurrentGame->GameTitle.'</a>';
				if ($CurrentGame->EngineModified)
				{
					$tmpGames .= ' (modified)';
				}
			}
		}

		# Games using this engine
		if ($tmpGames != '')
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Games using this engine:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= $tmpGames;
			$bodytext .= '</td></tr>';
		}

		$bodytext .= '</table>';

		$bodytext .= '</td></tr>';
		$bodytext .= "</table><br>\n";
	}

	pagePanel('cd', 'Game engines', '', $bodytext);
}

pageDisplay('Engines', 'pageLocalDisplay');

?>
