<?php
require_once('_main_paths.php');

global $infobaseroot;
global $forumsroot;

global $Strings;
$Strings['Disclaimer'] = 'Website disclaimer';
$Strings['DisclaimerText'] = "This website is build with HTML 4.01 and CSS. JavaScript is used for email-address encryption and cookies for layout-settings. This website is provided as-is without express or implied warranty. There's no guarantee all or any information stated is correct in any way. Copyright, the QuArK Development Team.";
$Strings['IntroText'] = "<p><b>QuArK</b> stands for Quake Army Knife and is a game editor for Quake and many other games using engines similar or compatible with id Software's engines used by Quake games. QuArK currently supports 41 distinct games, 5 generic game engines, and a countless number of expansions packs, addons, and mods. It can edit maps and models, import sounds and textures, run compilers, and is able to create and modify .pak and .pk3 files, as well as importing compiled .bsp files in order to add/change/delete entities from these files. No other game editing tool available has the ability to do all of these things.</p>

<p>For more information about what QuArK can do, please visit the <a href=\"/features.php\">features-page</a>.</p>

<p>If you want to download QuArK right now, go to the <a href=\"/download.php\">".DisplayImage('download_arrow', '16', '16')."&nbsp;download-page</a>.</p>

<p>For detailed information, visit our <a href=\"".$infobaseroot."\">Infobase</a>.</p>

<p>Or go straight to our <a href=\"".$forumsroot."\">forums</a>!</p>

<p class=\"xsml\">If you're looking for the desktop publishing software called Quark (notice the difference in capitalization), please go <a rel=\"nofollow noopener\" href=\"https://www.quark.com/\">here</a>.</p>";
$Strings['MoreNews'] = 'More news';
$Strings['MoreNewsText'] = 'For more news, go to the <a href="/news.php">news page</a> or the <a href="/archivednews.php">news-archive</a>.';
$Strings['Welcome'] = 'Welcome';
$Strings['WelcomeText'] = 'Welcome to the official QuArK website!';

?>
