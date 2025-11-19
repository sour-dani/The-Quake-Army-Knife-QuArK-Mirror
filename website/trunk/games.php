<?php
require_once('_base_code.php');
require_once('_company-database.php');
require_once('_engine-database.php');
require_once('_language_functions.php');
require_once('_download_applications-database.php');
require_once('_game-database.php');
require_once('_link-database.php');
require_once('_download_gamepatches-database.php');

# Load language file
LoadLanguageFile('games.php');

if (isset($_GET['showxp']))
{
	$ShowXP = ($_GET['showxp'] != 0);
}
else
{
	$ShowXP = false;
}

if (isset($_GET['showunsupported']))
{
	$ShowUnsupported = ($_GET['showunsupported'] != 0);
}
else
{
	$ShowUnsupported = false;
}

function DoesGameHaveLinks($Tag)
{
	#FIXME: This is a bad function... We need a better way!
	global $LinksGame;

	for ($LinkGroup = 0; $LinkGroup < count($LinksGame); $LinkGroup++)
	{
		$CurrentLinkGroup = &$LinksGame[$LinkGroup];
		if ($CurrentLinkGroup->Tag === $Tag)
		{
			return true;
		}
	}
	return false;
}

function DoesGameHavePatches($Tag)
{
	#FIXME: This is a bad function... We need a better way!
	global $GamesQRKGamePatches;

	return array_key_exists($Tag, $GamesQRKGamePatches);
}

function pageLocalDisplay()
{
	pageName('Supported games');

	global $webmasteremail;
	global $Applications, $Companies, $Engines, $Games;
	global $ShowUnsupported, $ShowXP;

	$Table2Rows = array('table2rowA', 'table2rowB');

	$CurrentRow = 0;

	$bodytext = "<p>Here's an (incomplete) list of all the games QuArK supports, partially supports, might support or maybe will support in the future. Click on the link of the game you want to jump to in the table below, or just start scrolling down.</p>";

	$bodytext .= '<form action="games.php" method="GET"><fieldset><legend>Filter the gameslist</legend>
	<label><input type="checkbox" name="showxp" value="1"'.($ShowXP ? ' checked' : '').'>Include expansions</label><br>
	<label><input type="checkbox" name="showunsupported" value="1"'.($ShowUnsupported ? ' checked' : '').'>Include partially supported and currently unsupported</label><br>
	<input type="submit">
	</fieldset></form>';

	$bodytext .= '<p>If you find an error, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK game data error').'>tell us</a>.</p>';

	# Build Table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>Games list</b></td></tr>';
	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];

		if ((!$ShowUnsupported) and is_null($CurrentGame->FromVersion))
		{
			continue;
		}
		if ((!$ShowXP) and (!is_null($CurrentGame->NeedsGame)))
		{
			continue;
		}

		$bodytext .= '<tr>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=center>'.DisplayGameIcon($Game).'</td>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';
		$bodytext .= '<a href="#'.$CurrentGame->GameID.'">'.$CurrentGame->GameTitle.'</a>';
		$bodytext .= '</td>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=left>';
		if (is_null($CurrentGame->Description))
		{
			$bodytext .= '&nbsp;';
		}
		else
		{
			$bodytext .= $CurrentGame->Description;
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

		if ((!$ShowUnsupported) and is_null($CurrentGame->FromVersion))
		{
			continue;
		}
		if ((!$ShowXP) and (!is_null($CurrentGame->NeedsGame)))
		{
			continue;
		}

		$bodytext .= '<a name="'.$CurrentGame->GameID.'"></a>';
		$bodytext .= '<table cellpadding=2 cellspacing=0 width="95%" align=center>';

		$bodytext .= '<tr><td class="tablehead">';
		$bodytext .= '<b>'.$CurrentGame->GameTitle.'</b>';
		$bodytext .= '</td></tr>';

		$bodytext .= '<tr><td class="tablesubhead">';

		$bodytext .= '<table cellpadding=6><tr><td class="tablesubhead">';
		if (!is_null($CurrentGame->URL))
		{
			$bodytext .= DisplayGameIcon($Game, $CurrentGame->URL, '32', '32');
		}
		else
		{
			$bodytext .= DisplayGameIcon($Game, null, '32', '32');
		}
		$bodytext .= '</td><td class="tablesubhead">';
		if (!is_null($CurrentGame->Description))
		{
			$bodytext .= $CurrentGame->Description;
		}
		else
		{
			$bodytext .= '<span class="replacementgamename">[' . $CurrentGame->GameTitle . ']</span>';
		}
		$bodytext .= '</td></tr></table></td></tr>';

		$bodytext .= '<tr><td class="tablecell">';

		$bodytext .= '<table cellpadding=0 cellspacing=0 width="100%">';

		# Website-line
		$bodytext .= '<tr><td class="tablecell" width=200>';
		$bodytext .= 'Official website:';
		$bodytext .= '</td><td class="tablecell">';
		if (!is_null($CurrentGame->URL))
		{
			$bodytext .= '<a href="'.$CurrentGame->URL.'" title="Official '.$CurrentGame->GameTitle.' website" target="_blank" rel="noopener">'.$CurrentGame->URL.'</a>';
		}
		else
		{
			$bodytext .= '?';
		}
		$bodytext .= '</td></tr>';

		# Wikipedia-line
		if (!is_null($CurrentGame->WikipediaURL))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Wikipedia article:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= '<a href="'.$CurrentGame->WikipediaURL.'" title="'.$CurrentGame->GameTitle.' Wikipedia article" target="_blank" rel="noopener">'.$CurrentGame->WikipediaURL.'</a>';
			$bodytext .= '</td></tr>';
		}

		# Engine-line
		if (!is_null($CurrentGame->Engine))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Game Engine:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= $Engines[$CurrentGame->Engine]->Name;
			if ($CurrentGame->EngineModified)
			{
				$bodytext .= ' (modified)';
			}
			$bodytext .= '</td></tr>';
		}

		# NeedsGame-line
		if (!is_null($CurrentGame->NeedsGame))
		{
			$GameNeeded = findGame($CurrentGame->NeedsGame);
			if ($GameNeeded === false)
			{
				# Shouldn't happen!
				trigger_error('Unable to find '.$CurrentGame->NeedsGame.' in Games array!', E_USER_WARNING);
			}
			else
			{
				$bodytext .= '<tr><td class="tablecell" width=200>';
				$bodytext .= 'Needs game:';
				$bodytext .= '</td><td class="tablecell">';
				$bodytext .= '<a href="games.php?showunsupported=1#'.$Games[$GameNeeded]->GameID.'">'.$Games[$GameNeeded]->GameTitle.'</a>';
				$bodytext .= '</td></tr>';
			}
		}

		# Developer-line
		if (is_array($CurrentGame->Developer))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Developer(s):';
			$bodytext .= '</td><td class="tablecell">';
			for ($Developer = 0; $Developer < count($CurrentGame->Developer); $Developer++)
			{
				$CurrentDeveloper = &$CurrentGame->Developer[$Developer];
				if ($Developer !== 0)
				{
					$bodytext .= ', ';
				}
				if (!array_key_exists($CurrentDeveloper, $Companies))
				{
					trigger_error('Unable to find '.$CurrentDeveloper.' in Companies array!', E_USER_WARNING);
					$bodytext .= $CurrentDeveloper;
					continue;
				}
				if (is_null($Companies[$CurrentDeveloper]->URL))
				{
					$bodytext .= $Companies[$CurrentDeveloper]->Name;
				}
				else
				{
					$bodytext .= '<a href="'.$Companies[$CurrentDeveloper]->URL.'" target="_blank" rel="nofollow noopener">'.$Companies[$CurrentDeveloper]->Name.'</a>';
				}
			}
			$bodytext .= '</td></tr>';
		}

		# Publisher-line
		if (is_array($CurrentGame->Publisher))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Publisher(s):';
			$bodytext .= '</td><td class="tablecell">';
			for ($Publisher = 0; $Publisher < count($CurrentGame->Publisher); $Publisher++)
			{
				$CurrentPublisher = &$CurrentGame->Publisher[$Publisher];
				if ($Publisher !== 0)
				{
					$bodytext .= ', ';
				}
				if (!array_key_exists($CurrentPublisher, $Companies))
				{
					trigger_error('Unable to find '.$CurrentPublisher.' in Companies array!', E_USER_WARNING);
					$bodytext .= $CurrentPublisher;
					continue;
				}
				if (is_null($Companies[$CurrentPublisher]->URL))
				{
					$bodytext .= $Companies[$CurrentPublisher]->Name;
				}
				else
				{
					$bodytext .= '<a href="'.$Companies[$CurrentPublisher]->URL.'" target="_blank" rel="nofollow noopener">'.$Companies[$CurrentPublisher]->Name.'</a>';
				}
			}
			$bodytext .= '</td></tr>';
		}

		# Distributor-line
		if (is_array($CurrentGame->Distributor))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Distributor(s):';
			$bodytext .= '</td><td class="tablecell">';
			for ($Distributor = 0; $Distributor < count($CurrentGame->Distributor); $Distributor++)
			{
				$CurrentDistributor = &$CurrentGame->Distributor[$Distributor];
				if ($Distributor !== 0)
				{
					$bodytext .= ', ';
				}
				if (!array_key_exists($CurrentDistributor, $Companies))
				{
					trigger_error('Unable to find '.$CurrentDistributor.' in Companies array!', E_USER_WARNING);
					$bodytext .= $CurrentDistributor;
					continue;
				}
				if (is_null($Companies[$CurrentDistributor]->URL))
				{
					$bodytext .= $Companies[$CurrentDistributor]->Name;
				}
				else
				{
					$bodytext .= '<a href="'.$Companies[$CurrentDistributor]->URL.'" target="_blank" rel="nofollow noopener">'.$Companies[$CurrentDistributor]->Name.'</a>';
				}
			}
			$bodytext .= '</td></tr>';
		}

		# Supported since-line
		$bodytext .= '<tr><td class="tablecell" width=200>';
		$bodytext .= 'Supported since:';
		$bodytext .= '</td><td class="tablecell">';
		if (is_null($CurrentGame->FromVersion))
		{
			$bodytext .= 'Not supported (yet?)';
		}
		else
		{
			$ApplFound = findAppl($CurrentGame->FromVersion);
			if ($ApplFound === false)
			{
				$bodytext .= 'Not supported (yet?)';
			}
			else
			{
				$bodytext .= $Applications[$ApplFound]->ApplTitle;
			}
		}
		$bodytext .= '</td></tr>';

		# Link to Gamepatches-page line
		if (DoesGameHavePatches($CurrentGame->GameID))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Patches:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= '<a href="download_gamepatches.php#'.$CurrentGame->GameID.'">Click here</a>';
			$bodytext .= '</td></tr>';
		}

		# Link to Links-page line
		if (DoesGameHaveLinks($CurrentGame->GameID)) #FIXME: Needs showarchived=1 if only archived links!
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Links:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= '<a href="links.php#'.$CurrentGame->GameID.'">Click here</a>';
			$bodytext .= '</td></tr>';
		}

		$bodytext .= '</table>';

		$bodytext .= '</td></tr>';
		$bodytext .= '</table><br>'."\n";
	}

	pagePanel('cd', 'Games supported by QuArK', '', $bodytext);
}

pageDisplay('Games', 'pageLocalDisplay');

?>
