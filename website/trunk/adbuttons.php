<?php
require_once('_base_code.php');
require_once('_language_functions.php');

# Load language file
LoadLanguageFile('adbuttons.php');

function pageLocalDisplay()
{
	pageName('Ad Buttons');
	pagePanelFile('community', 'Ad-buttons by the community', '', 'adbuttons_list.html');
}

pageDisplay('Ad Buttons', 'pageLocalDisplay');

?>
