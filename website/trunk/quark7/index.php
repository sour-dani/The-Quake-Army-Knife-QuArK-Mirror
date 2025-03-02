<?php
require_once('..'.DIRECTORY_SEPARATOR.'_base_code.php');
require_once('..'.DIRECTORY_SEPARATOR.'_functions.php');
require_once('..'.DIRECTORY_SEPARATOR.'_language_functions.php');
require_once('..'.DIRECTORY_SEPARATOR.'_people-database.php');
require_once('.'.DIRECTORY_SEPARATOR.'_news_database.php');

# Load language file
LoadLanguageFile('quark7.php');
global $Strings;

function GetFile($filename)
{
	global $webmasteremail;

	$filedata = file_get_contents($filename);
	if ($filedata === FALSE)
	{
		//FIXME: Ohoh! File doesn't exist...!
		return '';
	}
	return str_replace('<%webmaster%>', DisplayEncodedEmail($webmasteremail), $filedata);
}

function pageLocalDisplay()
{
	global $mainroot, $picsroot, $forumsroot;

	pageName('QuArK 7');

	$bodytext = '<h1>QuArK 7 - Project Phoenix</h1>';
	$bodytext .= '<br>';
	$bodytext .= '<div class="centered">';
	//$bodytext .= '<img src="'.$picsroot.'quark7/Q7-ProjectPhoenix.jpg" width=128 height=128 alt="QuArK 7 - Project Phoenix logo">';
	$bodytext .= '<img src="'.$picsroot.'quark7/quark_logo_small.png" width=128 height=128 alt="QuArK 7 - Project Phoenix logo (Made by Mooztik)">';
	$bodytext .= '<img src="'.$picsroot.'quark7/10z1e1w.png" width=128 height=128 alt="QuArK 7 - Project Phoenix logo (Made by NightRage)">';
	$bodytext .= '<img src="'.$picsroot.'quark7/logoquark.png" width=128 height=128 alt="QuArK 7 - Project Phoenix logo (Made by triget)">';
	$bodytext .= '</div>';
	$bodytext .= '<br>';
	$bodytext .= '<p>QuArK 6 is getting a bit dated. It\'s lacking many features, its performance isn\'t stellar, and it could use a new lick of paint. QuArK 7 (working title: Project Phoenix) is planned to be the resurrection of QuArK. Its main new features will be: cross-platform compatibility, much better speed with large maps, and even wider game support!</p>';
	$bodytext .= '<p>This part of the QuArK website documents the plans for QuArK 7. Here are the main sections:</p>';
	$bodytext .= '<ul><li><a href="'.$mainroot.'quark7/design_doc/">Design document</a></li>';
	$bodytext .= '<li><a href="'.$forumsroot.'index.php#3">Forum section</a></li></ul>';
	$bodytext .= '<p>Below are the main informational posts about QuArK 7 (in a blog-style format).</p>';

	pagePanel('quark', 'QuArK 7 - Project Phoenix', '', $bodytext);

	global $news_database;
	for($i = 0; $i < count($news_database); $i++)
	{
		$news = &$news_database[$i];

		global $personsdatabase;
		$newsauthor = '<a class="personlink" href="../person.php?PersonID='.($news[2]+1).'">'.$personsdatabase[$news[2]]->getDisplayName().'</a>';

		$bodytext = GetFile($news[0]);
		pagePanel('quark', $news[1].' - '.DisplayDate($news[3]).'<span class="newsago"> ('.DisplayTimeAgo($news[3]).')</span>', $newsauthor, $bodytext);
	}
}

pageDisplay('QuArK 7', 'pageLocalDisplay');
?>
