<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_main_paths.php');

global $webmasteremail;

global $Strings;
$Strings['ThanksTo'] = 'Thanks goes out to...';
$Strings['Header'] = 'An inevitably incomplete list of <b><i>Thank You\'s</i></b> listed in no particular order, and compiled from a few different sources. If you think your name should be added, contact the <a href='.DisplayEncodedEmail($webmasteremail, NULL, '-- NOTICE: HTML e-mails will be bounced, so send only in plain-text! --').'>webmaster</a>.';

?>
