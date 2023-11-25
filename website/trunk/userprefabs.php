<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_userprefabs-database.php');
require_once('_game-database.php');
require_once('_people-database.php');

# Load language file
LoadLanguageFile('userprefabs.php');

global $prefabs_imageroot;

$itemsPerRow = 3; //FIXME: Make configurable!

function pageLocalDisplay()
{
	pageName('User Prefabs');

	global $itemsPerRow;

	global $webmastermail;
	global $Games;

	global $prefabs_imageroot;
	global $prefabs_database;

	global $personsdatabase;

	global $added_arraycol;
	global $updated_arraycol;
	global $image_arraycol;
	global $file_arraycol;
	global $author_arraycol;

	$Table2Rows = array('table2rowA', 'table2rowB');

	#$PrefabsNotice = '<p><u>THE</u> place to submit user created prefabs, would be <a rel="nofollow noopener" target="_blank" href="http://prefabs.gamedesign.net/">prefabs.gamedesign.net</a>.</p>';
	#pagePanel('community', 'Notice!', '', $PrefabsNotice);

	$bodytext = '';

	$CurrentRow = 0;

	# Quick link table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan='.$itemsPerRow.' align=right><b>User prefabs list</b></td></tr>';
	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];
		if (!array_key_exists($CurrentGame->GameID, $prefabs_database))
		{
			# Nothing to display...
			continue;
		}
		$bodytext .= '<tr>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=center>'.DisplayGameIcon($Game, '#'.$CurrentGame->GameID).'</td>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';
		$bodytext .= '<a href="#'.$CurrentGame->GameID.'">'.$CurrentGame->GameTitle.'</a>';
		$bodytext .= '</td>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=left>';
		if (is_array($prefabs_database[$CurrentGame->GameID]))
		{
			if (count($prefabs_database[$CurrentGame->GameID]) === 1)
			{
				$bodytext .= '1 file';
			}
			else
			{
				$bodytext .= count($prefabs_database[$CurrentGame->GameID]) . ' files';
			}
		}
		else
		{
			$bodytext .= 'No files';
		}
		$bodytext .= '</td>';
		$bodytext .= '</tr>'; $CurrentRow++;
		$bodytext .= "\n";
	}
	$bodytext .= '</table>';

	$bodytext .= '<hr class="smallbreak">';

	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];
		if (!array_key_exists($CurrentGame->GameID, $prefabs_database))
		{
			# Nothing to display...
			continue;
		}

		$bodytext .= '<a name="'.$CurrentGame->GameID.'"></a>';

		$bodytext .= '<table cellpadding=2 cellspacing=1 width="95%" align="center" style="table-layout: fixed;">';
		$bodytext .= '<tr><td class="tablehead" colspan='.$itemsPerRow.'>';
		$bodytext .= '<b>'.$CurrentGame->GameTitle.'</b>';
		$bodytext .= '</td></tr>';

		$bodytext .= '<tr><td class="tablesubhead" colspan='.$itemsPerRow.'>';

		$bodytext .= '<table cellpadding=6><tr><td class="tablesubhead">';
		$bodytext .= DisplayGameIcon($Game, null, '32', '32');
		$bodytext .= '</td><td class="tablesubhead">';
		$bodytext .= 'Click <a href='.DisplayEncodedEmail($webmastermail, 'QuArK User Prefab '.$CurrentGame->Acronym).'>here to submit</a> a user prefab. <span class="sml">(E-mail, including image of 160x120 pixels, max 200KB zipped.)</span>';
		$bodytext .= '</td></tr></table>';

		$bodytext .= '</td></tr>';

		$column = 0;
		for ($Prefab = 0; $Prefab < count($prefabs_database[$CurrentGame->GameID]); $Prefab++)
		{
			$CurrentPrefab = &$prefabs_database[$CurrentGame->GameID][$Prefab];
			if ($column % $itemsPerRow === 0)
			{
				$bodytext .= '<tr>';
			}
			$column++;

			$bodytext .= '<td class="tablecell" valign=top align=center>';
			$bodytext .= '<a rel="noopener" target="_blank" href="'.$CurrentPrefab[$file_arraycol].'">';
			$bodytext .= '<img src="'.$prefabs_imageroot.$CurrentPrefab[$image_arraycol].'" width=160 height=120 alt="'.$CurrentPrefab[$file_arraycol].'">';
			$bodytext .= '</a>';

			if ($CurrentPrefab[$author_arraycol] !== -1)
			{
				$CurrentPerson = &$personsdatabase[$CurrentPrefab[$author_arraycol]];
				if (($CurrentPerson->AllowEmail) and ($CurrentPerson->Email !== ''))
				{
					$bodytext .= '<br>By: <a href='.DisplayEncodedEmail($CurrentPerson->Email).'>'.$CurrentPerson->getDisplayName().'</a>';
				}
				else
				{
					$bodytext .= '<br>By: '.$CurrentPerson->getDisplayName();
				}
			}
			else
			{
				$bodytext .= '<br>By: *UNKNOWN*';
			}
			if ($CurrentPrefab[$updated_arraycol] !== 0)
			{
				$bodytext .= '<br>Updated: '.DisplayDate($CurrentPrefab[$updated_arraycol]);
			}
			$bodytext .= '<br>Added: '.DisplayDate($CurrentPrefab[$added_arraycol]);
			$bodytext .= '<br>Download: <a rel="noopener" target="_blank" href="'.$CurrentPrefab[$file_arraycol].'">Click here</a>';
			$bodytext .= '</td>';

			if ($column % $itemsPerRow === 0)
			{
				$bodytext .= '</tr>';
			}
		}
		if ($column > 0 && ($column % $itemsPerRow !== 0))
		{
			while ($column % $itemsPerRow !== 0)
			{
				$bodytext .= '<td class="tablecell" valign=top>&nbsp;</td>';
				$column++;
			}
			$bodytext .= '</tr>';
		}

		$bodytext .= '</table><br>';
	}

	pagePanel('community', 'User Prefabs', '', $bodytext);
}

pageDisplay('User Prefabs', 'pageLocalDisplay');

?>
