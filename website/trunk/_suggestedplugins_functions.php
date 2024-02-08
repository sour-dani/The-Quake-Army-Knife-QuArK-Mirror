<?php
require_once('_functions.php');
require_once('_main_paths.php');

function DisplayPersonList($PersonList, $Anonymous)
{
	global $date_arraycol;
	global $email_arraycol;
	global $person_arraycol;

	$bodytext = '';

	if (is_array($PersonList))
	{
		for ($Person = 0; $Person < count($PersonList); $Person++)
		{
			$CurrentPerson = &$PersonList[$Person];
			$bodytext .= "\n    <dd>" . DisplayDate($CurrentPerson[$date_arraycol]) . ' - ';
			if ($CurrentPerson[$email_arraycol] === '')
			{
				$bodytext .= $CurrentPerson[$person_arraycol] . '<br>';
			}
			else
			{
				$bodytext .= '<a href=' . DisplayEncodedEmail($CurrentPerson[$email_arraycol], 'QuArK: Suggested plug-ins') . '>' . $CurrentPerson[$person_arraycol] . '</a><br>';
			}
		}
	}
	else
	{
		$bodytext .= "\n    <dd>" . $Anonymous . '<br>';
	}

	return $bodytext;
}

function suggestedpluginsPanel($SuggestedPlugin)
{
	global $mainroot;
	global $webmasteremail;

	$bodytext = "\n<dl>";
	$bodytext .= "\n  <dt><a name=\"" . $SuggestedPlugin->Tag . "\"><b>Problem:</b></a>";
	$bodytext .= "\n    <dd>";
	$bodytext .= $SuggestedPlugin->Problem . '<br>';
	$bodytext .= "\n    <br>";
	$bodytext .= "\n  <dt><b>Suggestion for plug-in:</b>";
	$bodytext .= "\n    <dd>";
	$bodytext .= $SuggestedPlugin->Suggestion . '<br>';
	$bodytext .= "\n    For further elaboration please send a request to the <a href=\"".$mainroot."communication.php\">QuArK forum</a>.<br>";
	$bodytext .= "\n    <br>";
	$bodytext .= "\n  <dt><b>Suggested by:</b>";
	$bodytext .= DisplayPersonList($SuggestedPlugin->SuggestedBy, 'Unknown');
	$bodytext .= "\n    <br>";
	$bodytext .= "\n  <dt><b>Furthermore interested people:</b>";
	$bodytext .= DisplayPersonList($SuggestedPlugin->Interested, 'None');
	if ($SuggestedPlugin->Done === 0)
	{
		if (is_null($SuggestedPlugin->NameEncrypted))
		{
			$bodytext .= "\n    <a href=".DisplayEncodedEmail($webmasteremail, 'Suggested plug-ins Interest').">Notify the Webmaster if you are interested in seeing this plug-in</a><br>";
		}
		else
		{
			$bodytext .= "\n    <a href=".DisplayEncodedEmail($webmasteremail, 'Suggested plug-ins Interest:' . $SuggestedPlugin->NameEncrypted).">Notify the Webmaster if you are interested in seeing this plug-in</a><br>";
		}
	}
	$bodytext .= "\n    <br>";
	if ($SuggestedPlugin->Done === 0)
	{
		$bodytext .= "\n  <dt><b>Under development by:</b>";
	}
	else
	{
		$bodytext .= "\n  <dt><b>Implemented by:</b>";
		#FIXME: Display $SuggestedPlugin->Done if non-zero, as a Date Implemented!
	}
	$bodytext .= DisplayPersonList($SuggestedPlugin->DevelopedBy, 'Unknown');
	if ($SuggestedPlugin->Done === 0)
	{
		if (is_null($SuggestedPlugin->NameEncrypted))
		{
			$bodytext .= "\n      <a href=".DisplayEncodedEmail($webmasteremail, 'Suggested plug-ins Develop').">Notify the Webmaster if you want to develop this plug-in</a><br>";
		}
		else
		{
			$bodytext .= "\n      <a href=".DisplayEncodedEmail($webmasteremail, 'Suggested plug-ins Develop:' . $SuggestedPlugin->NameEncrypted).">Notify the Webmaster if you want to develop this plug-in</a><br>";
		}
	}
	$bodytext .= "\n</dl>";
	if ($SuggestedPlugin->Done !== 0)
	{
		if (!is_null($SuggestedPlugin->DoneComment))
		{
			$bodytext .= '<p>' . $SuggestedPlugin->DoneComment . '</p>';
		}
	}

	return $bodytext;
}

?>
