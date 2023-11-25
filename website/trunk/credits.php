<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_image_functions.php');
require_once('_credits-database.php');

# Load language file
LoadLanguageFile('credits.php');

function pageLocalDisplay()
{
	global $Credits;

	pageName('Credits');

	$bodytext = '<p>'.GetLanguageString('Header').'</p><hr class="smallbreak"><div class="centered">';

	for ($Credit = 0; $Credit < count($Credits); $Credit++)
	{
		$CurrentCredit = &$Credits[$Credit];
		if ($CurrentCredit->PersonID != -1)
		{
			$bodytext .= '<big><b><a class="personlink" target="_blank" href="person.php?PersonID='.($CurrentCredit->PersonID+1).'">' . $CurrentCredit->Name . '</a></b></big><br>';
		}
		else
		{
			$bodytext .= '<big><b>' . $CurrentCredit->Name . '</b></big><br>';
		}
		if (!is_null($CurrentCredit->Description))
		{
			$bodytext .= $CurrentCredit->Description . '<br><br>';
		}
	}

	$bodytext .= 'And of course to...<br>
<div><a rel="noopener" target="_blank" href="https://www.idsoftware.com/">'.DisplayImage('idlogo', null, null, 'style="vertical-align: middle;"').'</a><big><b>id Software</b></big></div>...for <b>Quake</b> and starting this whole descent into madness!!!</div>';

	#pagePanelFile('community', GetLanguageString('ThanksTo'), '', 'credits_list.html');
	pagePanel('community', GetLanguageString('ThanksTo'), '', $bodytext);
}

pageDisplay('Credits', 'pageLocalDisplay');

?>
