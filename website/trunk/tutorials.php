<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_image_functions.php');
require_once('_tutorial-database.php');

# Load language file
LoadLanguageFile('tutorials.php');

function tutorialListPanel($TutorialList)
{
	$bodytext = '';
	if (!is_null($TutorialList->Description))
	{
		$bodytext .= '<p>'.$TutorialList->Description.'</p>';
	}

	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	for ($Tutorial = 0; $Tutorial < count($TutorialList->Tutorials); $Tutorial++)
	{
		$CurrentTutorial = &$TutorialList->Tutorials[$Tutorial];
		if ($Tutorial > 0)
		{
			$bodytext .= '<tr><td colspan=3>&nbsp;</td></tr>';
		}
		$bodytext .= '<tr><td width="25%" valign=top class="text1"><b>'.$CurrentTutorial->Name.'</b></td>';
		$bodytext .= '<td width="25%" valign=top class="text1"><a rel="noopener" target="_blank" href="'.$CurrentTutorial->Link.'">'.DisplayImage('browse').'&nbsp;View with Web-browser</a></td>';
		$bodytext .= '<td width="50%" valign=top class="text1">'.$CurrentTutorial->Description;
		if (!is_null($CurrentTutorial->Author))
		{
			$bodytext .= '<br>Author: '.$CurrentTutorial->Author; #FIXME: Make a person link!
		}
		$bodytext .= '</td></tr>';
	}
	$bodytext .= '</table>';

	return $bodytext;
}

function pageLocalDisplay()
{
	global $TutorialQuArK, $TutorialOther; # See '_tutorial-database.php'

	pageName('Tutorials');

	$bodytext = "If you seek tutorials about for a specific game, try visiting that game's website/forum/community for them, or ask around there.";
	pagePanel('community', 'Tutorials', '', $bodytext);

	echo '<a name="QuArK"></a>';
	pagePanel('community', 'QuArK Tutorials', '', tutorialListPanel($TutorialQuArK));

	echo '<a name="other"></a>';
	pagePanel('community', 'Other Tutorials', '', tutorialListPanel($TutorialOther));
}

pageDisplay('Tutorials', 'pageLocalDisplay');

?>
