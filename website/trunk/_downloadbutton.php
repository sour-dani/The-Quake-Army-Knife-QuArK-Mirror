<?php
require_once('_functions.php');
require_once('_language_functions.php');
require_once('_image_functions.php');

global $mainroot;
global $keepinframe;

$downloadbutton = '<div class="centered"><a ' . $keepinframe . 'href="'.$mainroot.'download.php">'.DisplayImage('downloadnow').'<br>'.GetLanguageString('ClickHere').'</a></div>';

pageSidePanel('', GetLanguageString('Download'), $downloadbutton);

?>
