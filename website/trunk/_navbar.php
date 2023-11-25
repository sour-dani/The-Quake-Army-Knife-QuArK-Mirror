<?php
require_once('_functions.php');
require_once('_language_functions.php');
require_once('_navbar_functions.php');
require_once('_navbar-database.php');

global $navbar;

pageSidePanel('', GetLanguageString('Site Navigation'), stringNavbar($navbar));

?>
