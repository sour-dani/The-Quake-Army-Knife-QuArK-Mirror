<?php
require_once('_functions.php');
require_once('_language_functions.php');
require_once('_image_functions.php');

$bodytext = '<div class="centered">';

$bodytext .= '<div class="mouseover">';
$bodytext .= '<a rel="nofollow noopener" target="_blank" href="https://www.php.net/">'.DisplayImage('php').'</a>';
$bodytext .= '<div class="popup">'.GetLanguageString('Powered by').': PHP</div>';
$bodytext .= '</div>';
$bodytext .= '<br>';

$bodytext .= '<br>';

$bodytext .= '<div class="mouseover">';
$bodytext .= '<a rel="nofollow noopener" target="_blank" href="https://www.mysql.com/">'.DisplayImage('mysql').'</a>';
$bodytext .= '<div class="popup">'.GetLanguageString('Powered by').': MySQL</div>';
$bodytext .= '</div>';
$bodytext .= '<br>';

$bodytext .= '</div>';

pageSidePanel('', GetLanguageString('PoweredBy'), $bodytext);

?>
