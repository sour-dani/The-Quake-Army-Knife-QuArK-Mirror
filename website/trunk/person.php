<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_people-database.php');

# Load language file
LoadLanguageFile('person.php');

global $PersonID;
$PersonID = intval($_GET['PersonID'])-1;

function pageLocalDisplay()
{
	global $mainroot, $forumsroot;

	global $personsdatabase;

	global $PersonID;

	pageName('People');

	if (($PersonID < 0) or ($PersonID >= count($personsdatabase)))
	{
		$bodytext = '<p>ERROR! PersonID out of range!</p>';
		PagePanel('community', 'People', '', $bodytext);
		return;
	}

	$CurrentPerson = &$personsdatabase[$PersonID];

	$bodytext = '';

	#FIXME!
	if (!is_null($CurrentPerson->Picture))
	{
		$bodytext .= '<img src="'.$CurrentPerson->Picture.'" align=right>'; #FIXME: Alt, width, height!
	}
	$bodytext .= '<p>';
	if ($CurrentPerson->Nick !== '')
	{
		$bodytext .= '<b>Nickname</b>: '.$CurrentPerson->Nick.'<br>';
	}
	if ($CurrentPerson->AllowRealName)
	{
		$bodytext .= '<b>Real name</b>: '.$CurrentPerson->Name.'<br>';
	}
	if (($CurrentPerson->AllowEmail) and ($CurrentPerson->Email !== ''))
	{
		$bodytext .= '<b>Email address</b>: <a href='.DisplayEncodedEmail($CurrentPerson->Email).'>E-mail me!</a><br>';
	}
	if (($CurrentPerson->AllowAddress) and ($CurrentPerson->Address !== ''))
	{
		$bodytext .= '<b>Address</b>: '.$CurrentPerson->Address.'<br>';
	}
	if ($CurrentPerson->Website !== '')
	{
		$bodytext .= '<b>Website</b>: <a rel="nofollow noopener" target="_blank" href="'.$CurrentPerson->Website.'">'.$CurrentPerson->Website.'</a><br>';
	}
	if ($CurrentPerson->ForumID !== 0)
	{
		$bodytext .= '<b>Forum profile</b>: <a target="_blank" href="'.$forumsroot.'index.php?action=profile;u='.$CurrentPerson->ForumID.'">Click here</a><br>';
	}
	if (is_array($CurrentPerson->CV))
	{
		$bodytext .= '<b>Curriculum Vitae</b>:<br>';
		$bodytext .= '</p>';
		$bodytext .= '<ul>';

		for ($CV = 0; $CV < count($CurrentPerson->CV); $CV++)
		{
			$bodytext .= '<li>'.$CurrentPerson->CV[$CV].'</li>';
		}
		$bodytext .= '</ul>';
		$bodytext .= '<p>';
	}
	if ($CurrentPerson->DateUpdated !== 0)
	{
		$bodytext .= '<b>Last updated</b>: '.DisplayDate($CurrentPerson->DateUpdated).'<br>';
	}
	else
	{
		if ($CurrentPerson->DateAdded !== 0)
		{
			$bodytext .= '<b>Last updated</b>: '.DisplayDate($CurrentPerson->DateAdded).'<br>';
		}
	}
	$bodytext .= '</p>';
	if (!is_null($CurrentPerson->Notes))
	{
		$bodytext .= '<p>';
		$bodytext .= '<b>Notes</b>:<br>';
		$bodytext .= $CurrentPerson->Notes;
		$bodytext .= '</p>';
	}

	$bodytext .= '<hr class="smallbreak">';
	$bodytext .= '<p><a href="'.$mainroot.'people.php">Back to index</a></p>';

	PagePanel('community', $CurrentPerson->getDisplayName(), '', $bodytext);
}

pageDisplay('Person', 'pageLocalDisplay');

?>
