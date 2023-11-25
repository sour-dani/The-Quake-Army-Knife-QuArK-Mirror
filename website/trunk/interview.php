<?php
require_once('_base_code.php');
require_once('_language_functions.php');

# Load language file
LoadLanguageFile('interview.php');

function pageLocalDisplay()
{
	pageName('Interview');
	pagePanelFile('community', 'Interview with Armin Rigo - Feb. 12th 1997', '', 'interview.html');
}

pageDisplay('Interview', 'pageLocalDisplay');

?>
