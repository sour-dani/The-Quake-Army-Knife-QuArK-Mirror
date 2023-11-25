<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_news_functions.php');

# Load language file
LoadLanguageFile('news.php');

function pageLocalDisplay()
{
	pageName('News');

	global $Settings;
	global $NewsItemNumber;

	displayNews($Settings[$NewsItemNumber]->GetCurrentValue());

	$ArchiveText = 'For more and older news items, go to the <a href="archivednews.php">News Archive</a>.';
	pagePanel('news', 'More in the News Archive', '', $ArchiveText);
}

pageDisplay('News', 'pageLocalDisplay');

?>
