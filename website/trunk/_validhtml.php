<?php
require_once('_functions.php');
require_once('_language_functions.php');
require_once('_image_functions.php');

#Valided by tools located on: http://www.w3.org/QA/Tools/

$bodytext = '<div class="centered">';

$bodytext .= '<div class="mouseover">';
$bodytext .= '<a rel="nofollow noopener" target="_blank" href="http://validator.w3.org/check?uri=referer">'.DisplayImage('validhtml').'</a>';
$bodytext .= '<div class="popup">'.GetLanguageString('ValidHTML').'</div>';
$bodytext .= '</div>';
$bodytext .= '<br>';

$bodytext .= '<br>';

$bodytext .= '<div class="mouseover">';
$bodytext .= '<a rel="nofollow noopener" target="_blank" href="http://jigsaw.w3.org/css-validator/check/referer">'.DisplayImage('validcss').'</a>';
$bodytext .= '<div class="popup">'.GetLanguageString('ValidCSS').'</div>';
$bodytext .= '</div>';
$bodytext .= '<br>';

$bodytext .= '</div>';

pageSidePanel('', GetLanguageString('Valid'), $bodytext);

?>
