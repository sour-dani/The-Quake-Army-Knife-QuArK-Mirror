<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_image_functions.php');
require_once('_instapoll-database.php');
require_once('_panels_functions.php');
require_once('_panels-database.php');

# Load language file
LoadLanguageFile('instapolls.php');

global $InstaPollPanel;
hidePanel($InstaPollPanel);

function pageLocalDisplay()
{
	pageName('InstaPolls');

	global $instapoll_database;

	$bodytext = '';

	for ($Instapoll = 0; $Instapoll < count($instapoll_database); $Instapoll++)
	{
		$CurrentInstapoll = &$instapoll_database[$Instapoll];

		if ($Instapoll !== 0)
		{
			$bodytext .= '<hr class="bigbreak">';
		}

		$bodytext .= '<p><b>';
		$bodytext .= $CurrentInstapoll->Question;
		$bodytext .= '</b><br>';
		if (!is_null($CurrentInstapoll->Picture))
		{
			$bodytext .= DisplayRawImage($CurrentInstapoll->Picture);
			$bodytext .= '<br>';
		}
		$bodytext .= 'Date of poll: ';
		$bodytext .= DisplayDate($CurrentInstapoll->StartDate);
		if ($CurrentInstapoll->EndDate !== 0)
		{
			$bodytext .= ' - ';
			$bodytext .= DisplayDate($CurrentInstapoll->EndDate);
		}
		$bodytext .= '<br>';
		$bodytext .= 'Total votes: ';
		$bodytext .= $CurrentInstapoll->TotalVotes;
		$bodytext .= '</p>';

		if (is_array($CurrentInstapoll->Options))
		{
			$bodytext .= '<table cellpadding=0 cellspacing=0 width="100%">';
			$bodytext .= '<tr><td><b>Answer</b></td><td align=right><b>Votes</b></td><td></td><td><b>Percentage</b></td></tr>';
			for ($Option = 0; $Option < count($CurrentInstapoll->Options); $Option++)
			{
				$CurrentOption = &$CurrentInstapoll->Options[$Option];
				$bodytext .= '<tr><td>';
				$bodytext .= $CurrentOption->Text;
				if (!is_null($CurrentOption->Picture))
				{
					$bodytext .= '<br>';
					$bodytext .= DisplayRawImage($CurrentOption->Picture);
				}
				$bodytext .= '</td><td><div align=right>';
				$bodytext .= $CurrentOption->Votes;
				$percentage = 100.0 * ($CurrentOption->Votes / $CurrentInstapoll->TotalVotes);
				// FIXME: Maybe do the *4.0 differently? --> Scale of the percentage-bars
				$bodytext .= '</div></td><td width=20>&nbsp;</td><td>'.DisplayImage('instapoll', sprintf('%.0f', $percentage*4.0), null, null, sprintf('%.1f', $percentage).'%').'&nbsp;'.sprintf('%.1f', $percentage).'%</td></tr>';
			}
			$bodytext .= '</table>';
		}
		else
		{
			$bodytext .= 'No options';
		}
	}

	PagePanel('community', 'Archived InstaPolls', '', $bodytext);
}

pageDisplay('InstaPolls', 'pageLocalDisplay');

?>
