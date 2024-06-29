<?php
require_once('_functions.php');
require_once('_language_functions.php');
require_once('_image_functions.php');

global $mainroot;
global $keepinframe;

$donatebutton = '<div class="centered"><a ' . $keepinframe . 'href="'.$mainroot.'donate.php">'.DisplayImage('supportus').'</a></div>';

pageSidePanel('', GetLanguageString('Donate'), $donatebutton);

?>
