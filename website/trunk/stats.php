<?php
require_once('_base_code.php');
require_once('_language_functions.php');

# Load language file
LoadLanguageFile('stats.php');

function pageLocalDisplay()
{
	global $mainroot;
	global $forumsroot;

	pageName('Stats');

	$bodytext = '<p>SourceForge is collecting stats, including a download counter. <a rel="noopener" target="_blank" href="https://sourceforge.net/projects/quark/files/stats/">See here</a>.</p>';
	#Old: http://sourceforge.net/project/stats/?group_id=1181&amp;ugn=quark

	$bodytext .= '<hr class="smallbreak">';

	/*$bodytext = "<p>We're collecting some statistics about the visitors that come to our webpages (as does just about any site). The stats gathered are send by any browser when coming to the website, so we're in no way \"probing\" your computer for anything!</p>";

	$bodytext .= '<p>To see these stats, <a target="_blank" href="'.$mainroot.'phptrafficA/">click here</a>.</p>';

	$bodytext .= '<hr class="smallbreak">';*/

	$bodytext .= "<p>Another set of stats are compiled by our forum. You'll need to log-in in order to see them: <a target=\"_blank\" href=\"".$forumsroot."index.php?action=stats\">click here</a>.</p>";

	pagePanel('stats', 'Current Stats', '', $bodytext);
}

pageDisplay('Stats', 'pageLocalDisplay');

?>
