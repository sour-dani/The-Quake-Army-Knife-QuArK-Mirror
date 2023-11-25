<?php
require_once('_functions.php');
require_once('_image_functions.php');

global $picsroot;

$pathogen = '<div class="centered"><a href="https://itunes.apple.com/us/app/pathogen-story-pack-1/id620272615?ls=1&amp;mt=8">';
$pathogen .= '<img alt="Pathogen logo" width=140 height=140 src="'.$picsroot.'Pathogen.jpg">'; #DisplayImage('pathogen');
$pathogen .= '<br>Check it out!</a><br>Game made with QuArK!</div>';

pageSidePanel('', '', $pathogen);

?>
