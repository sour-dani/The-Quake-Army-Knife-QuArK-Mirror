<?php
require_once('_functions.php');
require_once('_interest-database.php');

global $Interest;

$sitestxt = '<div class="centered">';

for ($Site = 0; $Site < count($Interest); $Site++)
{
	$CurrentSite = &$Interest[$Site];
	if ($Site !== 0)
		$sitestxt .= '<br>';
	$sitestxt .= '<a rel="noopener" href="' . $CurrentSite->Link . '" target="_blank"><img alt="' . $CurrentSite->Name . '" src="' . $CurrentSite->Image . '" width=' . $CurrentSite->Width . ' height=' . $CurrentSite->Height . '></a><br>';
}

$sitestxt .= '</div>';

pageSidePanel('', 'Sites of Interest...', $sitestxt);

?>
