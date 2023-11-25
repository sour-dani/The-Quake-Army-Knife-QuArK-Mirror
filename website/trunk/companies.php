<?php
require_once('_base_code.php');
require_once('_company-database.php');
require_once('_language_functions.php');
require_once('_game-database.php');

# Load language file
LoadLanguageFile('companies.php');

function pageLocalDisplay()
{
	pageName('Game companies');

	global $webmasteremail;
	global $Companies;
	global $Games;

	$Table2Rows = array('table2rowA', 'table2rowB');

	$CurrentRow = 0;

	$bodytext = "<p>There are many companies behind the games that QuArK supports. Some are developers, some are publishers, and some are distributors. Here's a big list of them all!</p>";

	$bodytext .= '<p>If you find an error, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK company data error').'>tell us</a>.</p>';

	# Build Table
	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>Company list</b></td></tr>';
	foreach ($Companies as $Company => $CurrentCompany)
	{
		$bodytext .= '<tr>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" align=center>'.DisplayCompanyIcon($Company).'</td>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';
		$bodytext .= '<a href="#'.$CurrentCompany->ID.'">'.$CurrentCompany->Name.'</a>';
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

	foreach ($Companies as $Company => $CurrentCompany)
	{
		$bodytext .= '<a name="'.$CurrentCompany->ID.'"></a>';
		$bodytext .= '<table cellpadding=2 cellspacing=0 width="95%" align=center>';

		$bodytext .= '<tr><td class="tablehead">';
		$bodytext .= '<b>'.$CurrentCompany->Name.'</b>';
		$bodytext .= '</td></tr>';

		$bodytext .= '<tr><td class="tablesubhead">';

		$bodytext .= '<table cellpadding=6><tr><td class="tablesubhead">';
		if (!is_null($CurrentCompany->URL))
		{
			$bodytext .= DisplayCompanyIcon($Company, $CurrentCompany->URL, '32', '32');
		}
		else
		{
			$bodytext .= DisplayCompanyIcon($Company, null, '32', '32');
		}
		$bodytext .= '</td><td class="tablesubhead">';
		/*if (!is_null($CurrentCompany->Description))
		{
			$bodytext .= $CurrentCompany->Description;
		}
		else
		{
			$bodytext .= '<span class="replacementgamename">[' . $CurrentCompany->Name . ']</span>';
		}*/
		$bodytext .= '</td></tr></table></td></tr>';

		$bodytext .= '<tr><td class="tablecell">';

		$bodytext .= '<table cellpadding=0 cellspacing=0 width="100%">';

		# Website-line
		$bodytext .= '<tr><td class="tablecell" width=200>';
		$bodytext .= 'Official website:';
		$bodytext .= '</td><td class="tablecell">';
		if (!is_null($CurrentCompany->URL))
		{
			$bodytext .= '<a href="'.$CurrentCompany->URL.'" title="Official '.$CurrentCompany->Name.' website" target="_blank" rel="nofollow noopener">'.$CurrentCompany->URL.'</a>';
		}
		else
		{
			$bodytext .= '?';
		}
		$bodytext .= '</td></tr>';

		# Wikipedia-line
		if (!is_null($CurrentCompany->WikipediaURL))
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Wikipedia article:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= '<a href="'.$CurrentCompany->WikipediaURL.'" title="'.$CurrentCompany->Name.' Wikipedia article" target="_blank" rel="nofollow noopener">'.$CurrentCompany->WikipediaURL.'</a>';
			$bodytext .= '</td></tr>';
		}

		#Gather game information
		$tmpDeveloper = '';
		$tmpPublisher = '';
		$tmpDistributor = '';
		for ($Game = 0; $Game < count($Games); $Game++)
		{
			$CurrentGame = &$Games[$Game];
			if (is_array($CurrentGame->Developer))
			{
				for ($Developer = 0; $Developer < count($CurrentGame->Developer); $Developer++)
				{
					if ($CurrentGame->Developer[$Developer] === $Company)
					{
						if ($tmpDeveloper != '')
							$tmpDeveloper .= '<br>';
						$tmpDeveloper .= '<a href="games.php'.getGamesQuery($CurrentGame->GameID).'#'.$CurrentGame->GameID.'">'.$CurrentGame->GameTitle.'</a>';
					}
				}
			}
			if (is_array($CurrentGame->Publisher))
			{
				for ($Publisher = 0; $Publisher < count($CurrentGame->Publisher); $Publisher++)
				{
					if ($CurrentGame->Publisher[$Publisher] === $Company)
					{
						if ($tmpPublisher != '')
							$tmpPublisher .= '<br>';
						$tmpPublisher .= '<a href="games.php'.getGamesQuery($CurrentGame->GameID).'#'.$CurrentGame->GameID.'">'.$CurrentGame->GameTitle.'</a>';
					}
				}
			}
			if (is_array($CurrentGame->Distributor))
			{
				for ($Distributor = 0; $Distributor < count($CurrentGame->Distributor); $Distributor++)
				{
					if ($CurrentGame->Distributor[$Distributor] === $Company)
					{
						if ($tmpDistributor != '')
							$tmpDistributor .= '<br>';
						$tmpDistributor .= '<a href="games.php'.getGamesQuery($CurrentGame->GameID).'#'.$CurrentGame->GameID.'">'.$CurrentGame->GameTitle.'</a>';
					}
				}
			}
		}

		# Games developed
		if ($tmpDeveloper != '')
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Games developed:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= $tmpDeveloper;
			$bodytext .= '</td></tr>';
		}

		# Games published
		if ($tmpPublisher != '')
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Games published:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= $tmpPublisher;
			$bodytext .= '</td></tr>';
		}

		# Games distributed
		if ($tmpDistributor != '')
		{
			$bodytext .= '<tr><td class="tablecell" width=200>';
			$bodytext .= 'Games distributed:';
			$bodytext .= '</td><td class="tablecell">';
			$bodytext .= $tmpDistributor;
			$bodytext .= '</td></tr>';
		}

		$bodytext .= '</table>';

		$bodytext .= '</td></tr>';
		$bodytext .= "</table><br>\n";
	}

	pagePanel('cd', 'Game companies', '', $bodytext);
}

pageDisplay('Companies', 'pageLocalDisplay');

?>
