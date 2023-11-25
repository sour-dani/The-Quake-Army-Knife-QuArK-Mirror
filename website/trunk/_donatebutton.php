<?php
require_once('_functions.php');
require_once('_language_functions.php');
require_once('_image_functions.php');

global $mainroot;
global $keepinframe;

$donatebutton = '<div class="centered"><a ' . $keepinframe . 'href="'.$mainroot.'donate.php">';
$donatebutton .= DisplayImage('supportus');
$donatebutton .= '</a></div>';

pageSidePanel('', GetLanguageString('Donate'), $donatebutton);

?>
