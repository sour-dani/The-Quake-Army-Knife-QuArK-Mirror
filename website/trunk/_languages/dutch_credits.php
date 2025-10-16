<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_main_paths.php');

global $webmasteremail;

global $Strings;
$Strings['ThanksTo'] = 'Dank gaat uit naar...';
$Strings['Header'] = 'Een onvermijdbaar incomplete lijst van <b><i>Dank je\'s</i></b> opgesomd in een willekeurige volgorde, en samengesteld vanuit verschillende bronnen. Als je vind dat jouw naam toegevoegd zou moeten worden, neem contact op met de <a href='.DisplayEncodedEmail($webmasteremail, NULL, '-- NOTICE: HTML e-mails will be bounced, so send only in plain-text! --').'>webmaster</a>.';

?>
