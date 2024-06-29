<?php
require_once('_functions.php');
require_once('_image_functions.php');

global $forumsroot;

$quarkforums = '<div class="centered"><a href="'.$forumsroot.'">'.DisplayImage('quarkforums').'<br>Visit our forums!</a></div>';

pageSidePanel('', '', $quarkforums);

?>
