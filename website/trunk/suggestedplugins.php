<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_suggestedplugins_functions.php');
require_once('_suggestedplugins-database.php');
require_once('_main_paths.php');

# Load language file
LoadLanguageFile('suggestedplugins.php');

global $mainroot;
global $infobaseroot;
global $webmasteremail;

$SuggestedPluginsHead = '<p>The contents on this page have been gathered from the <a href="'.$mainroot.'communication.php">forums</a>, when people from the QuArK community wrote, that such and such a plug-in could be really handy if it were made. Also look at the \'plans\' section of the QuArK <a href="'.$infobaseroot.'plans.html">infobase</a>.<br>
<br>
Most of the people that get the ideas for those plug-ins, don\'t know how to code them themselves, so to help them - and that is what the QuArK community is all about - this page will list the suggested plug-ins, if other people are interested and if they are under development or not.<br>
<br>
If <u>you</u> want to help develop one or more of the suggested plug-ins, please mail the <a href='.DisplayEncodedEmail($webmasteremail, "Suggested plug-ins", "-- NOTICE: HTML e-mails will be bounced, so send only in plain-text!").'>webmaster</a>, notifying him about your participation. If you have an idea for a plug-in, which would be possible to implement and useful during map-building, you can either write about it in the <a href="'.$mainroot.'communication.php">forums</a> or mail the <a href='.DisplayEncodedEmail($webmasteremail, "Suggested plug-ins", "-- NOTICE: HTML e-mails will be bounced, so send only in plain-text!").'>webmaster</a> using the <i>problem / suggestion</i> structure as shown below in the already suggested plug-ins.</p>';

function pageLocalDisplay()
{
	global $SuggestedPlugins;

	pageName('Suggested plug-ins');

	global $SuggestedPluginsHead;

	$bodytext = $SuggestedPluginsHead;

	if (count($SuggestedPlugins) > 0)
	{
		$bodytext .= '<b>Index</b><br>'."\n";
		$bodytext .= '<ul class="nowhitespace">'."\n";
		for ($SuggestedPlugin = count($SuggestedPlugins) - 1; $SuggestedPlugin >= 0; $SuggestedPlugin--)
		{
			$CurrentSuggestedPlugin = &$SuggestedPlugins[$SuggestedPlugin];
			$bodytext .= '	<li><a href="#' . $CurrentSuggestedPlugin->Tag . '">' . $CurrentSuggestedPlugin->Name . '</a>';
			if ($CurrentSuggestedPlugin->Done !== 0)
			{
				$bodytext .= ' **&nbsp;Implemented!&nbsp;**';
			}
			$bodytext .= "\n";
		}
		$bodytext .= '</ul>'."\n";
	}

	pagePanel('community', 'Intro', '', $bodytext);

	//Reverse order so newest is on top
	for ($SuggestedPlugin = count($SuggestedPlugins) - 1; $SuggestedPlugin >= 0; $SuggestedPlugin--)
	{
		$CurrentSuggestedPlugin = &$SuggestedPlugins[$SuggestedPlugin];
		pagePanel('community', $CurrentSuggestedPlugin->Name, '', suggestedpluginsPanel($CurrentSuggestedPlugin));
	}
}

pageDisplay('Suggested plug-ins', 'pageLocalDisplay');
?>
