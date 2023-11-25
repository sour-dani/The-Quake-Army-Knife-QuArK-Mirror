<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_download_tools-database.php');
require_once('_game-database.php');
require_once('_image_functions.php');

# Load language file
LoadLanguageFile('download_tools.php');

$IntroMessage = '<p>This matrix lists tools and compilers that can be used with QuArK, sorted per game. If you find a broken link or know of a missing compiler that QuArK is compatible with, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK Tools page correction').'>tell us</a>, and we will try to correct it.</p>';

function pageLocalDisplay()
{
	pageName('Game Tools');

	global $IntroMessage;

	global $Games, $GamesQRKTools, $GenericTools;

	$Table2Rows = array('table2rowA', 'table2rowB');
	$CurrentRow = 0;

	$bodytext = $IntroMessage;

	# Build Table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>QuArK Tools</b></td></tr>';

	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];
		if (is_null($CurrentGame->FromVersion) and (!array_key_exists($CurrentGame->GameID, $GamesQRKTools)))
		{
			# No support for this game and no tools: don't display!
			continue;
		}

		$bodytext .= "<tr>";
		$bodytext .= "<td class=\"text1, ".$Table2Rows[$CurrentRow & 1]."\" align=center>".DisplayGameIcon($Game)."</td>";

		$bodytext .= "<td class=\"text1, ".$Table2Rows[$CurrentRow & 1]."\">".$CurrentGame->GameTitle."</td>";

		$bodytext .= "<td class=\"text1, ".$Table2Rows[$CurrentRow & 1]."\">";

		# Loop though tools for this game
		$GameID = &$CurrentGame->GameID;
		if (array_key_exists($GameID, $GamesQRKTools))
		{
			$bodytext .= '<ul class="nowhitespace">';
			for ($Tool = 0; $Tool < count($GamesQRKTools[$GameID]); $Tool++)
			{
				$CurrentTool = &$GamesQRKTools[$GameID][$Tool];
				$bodytext .= '<li>';
				if ($CurrentTool->Recommended)
				{
					$bodytext .= DisplayImage('star');
				}
				if (!is_null($CurrentTool->URL))
				{
					$bodytext .= '<a href="'.$CurrentTool->URL.'">'.$CurrentTool->Title.'</a>';
				}
				else
				{
					$bodytext .= $CurrentTool->Title;
				}
				if (!is_null($CurrentTool->Description))
					$bodytext .= ': '.$CurrentTool->Description;
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

	pagePanel('download', 'Game Tools', '', $bodytext);
	unset($bodytext);

	if (count($GenericTools) !== 0)
	{
		$bodytext = '<p>Here is a list with tools that are useful when editing, but do not belong to a certain game:</p>';

		$Categories = array_keys($GenericTools);
		for ($Category = 0; $Category < count($Categories); $Category++)
		{
			$CurrentCategory = &$GenericTools[$Categories[$Category]];
			$bodytext .= '<table cellpadding=2 cellspacing=0 width="95%" align=center>';

			$bodytext .= '<tr><td class="tablehead"><b>'.$Categories[$Category].'</b></td></tr>';

			$bodytext .= '<tr><td class="tablecell">';
			$bodytext .= '<table cellpadding=0 cellspacing=0 width="100%">';

			for ($Tool = 0; $Tool < count($CurrentCategory); $Tool++)
			{
				$CurrentTool = &$CurrentCategory[$Tool];
				$bodytext .= '<tr><td class="tablecell" width=240>';
				$bodytext .= '- <a href="'.$CurrentTool[1].'" target="_blank" rel="noopener">'.$CurrentTool[0].'</a>';
				$bodytext .= '</td><td class="tablecell">';
				if (count($CurrentTool) >= 2)
				{
					$bodytext .= $CurrentTool[2];
				}
				else
				{
					$bodytext .= '&nbsp;';
				}
				$bodytext .= '</td></tr>';
			}
			$bodytext .= '</table>';

			$bodytext .= '</td></tr></table><br>';
		}

		pagePanel('download', 'Generic Tools', '', $bodytext);
		unset($bodytext);
	}
}

pageDisplay('Download Tools', 'pageLocalDisplay');

?>
