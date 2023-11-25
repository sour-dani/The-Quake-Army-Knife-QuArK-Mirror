<?php
require_once('_functions.php');
require_once('_language_functions.php');

$webservertime = '<div class="centered">' . DisplayDateTime(NULL) . '</div>';

pageSidePanel('', GetLanguageString('WebserverTime'), $webservertime);

?>
