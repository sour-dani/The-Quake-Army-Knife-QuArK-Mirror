<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_awards-database.php');

# Load language file
LoadLanguageFile('awards.php');

function pageLocalDisplay()
{
	global $Awards;
	global $Achievements;

	pageName('Awards');

	$bodytext = '<p>'.GetLanguageString('Header').'</p>';

	$bodytext .= '<div class="centered">'."\n";
	for ($Award = 0; $Award < count($Awards); $Award++)
	{
		$CurrentAward = &$Awards[$Award];

		$bodytext .= '<div style="margin: 16px; display: inline-block;"><b>'.$CurrentAward->Name.'</b> - '.$CurrentAward->Org.'<br>';
		if (!is_null($CurrentAward->Pic))
		{
			$bodytext .= DisplayRawImage($CurrentAward->Pic).'<br>';
		}
		if ($CurrentAward->Date !== 0)
		{
			$bodytext .= 'Awarded on: '.DisplayDate($CurrentAward->Date).'<br>';
		}
		if (!is_null($CurrentAward->URL))
		{
			$bodytext .= '<a rel="noopener" href="'.$CurrentAward->URL.'" target="_blank">Link</a>';
		}
		$bodytext .= '</div>';
	}
	$bodytext .= '</div>'."\n";

	pagePanel('award', GetLanguageString('AwardsWonBy'), '', $bodytext);

	#---

	$bodytext = '<p>'.GetLanguageString('HeaderOther').'</p>';

	$bodytext .= '<ul>'."\n";
	for ($Achievement = 0; $Achievement < count($Achievements); $Achievement++)
	{
		$CurrentAchievement = &$Achievements[$Achievement];

		$bodytext .= '<li>'.$CurrentAchievement->Description.'<br>';
		$bodytext .= 'By: '.$CurrentAchievement->Author.'<br>';
		if ($CurrentAchievement->Date !== 0)
		{
			$bodytext .= 'Achieved on: '.DisplayDate($CurrentAchievement->Date).'<br>';
		}
		if (!is_null($CurrentAchievement->URL))
		{
			$bodytext .= '<a rel="noopener" href="'.$CurrentAchievement->URL.'" target="_blank">Link</a>';
		}
		$bodytext .= '</li>';
	}
	$bodytext .= '</ul>'."\n";

	pagePanel('award', GetLanguageString('AchievementMadeWith'), '', $bodytext);
}

pageDisplay('Awards', 'pageLocalDisplay');

?>
