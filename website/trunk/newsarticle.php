<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_news_functions.php');

# Load language file
LoadLanguageFile('newsarticle.php');

global $ArticleID;
$ArticleID = intval($_GET['ArticleID'])-1;

function pageLocalDisplay()
{
	global $News;

	pageName('News Article');

	global $ArticleID;

	displayNewsArticle($ArticleID);

	# If needed, display the top paging panel
	if ($ArticleID > 0)
	{
		$prevbutton = '<form action="newsarticle.php" method="get"><input type="hidden" name="ArticleID" value="' . ($ArticleID + 1 - 1) . '"><input type="submit" value="&lt;--- Prev article"></form>';
	}
	else
	{
		$prevbutton = '';
	}
	if ($ArticleID < count($News) - 1)
	{
		$nextbutton = '<form action="newsarticle.php" method="get"><input type="hidden" name="ArticleID" value="' . ($ArticleID + 1 + 1) . '"><input type="submit" value="Next article ---&gt;"></form>';
	}
	else
	{
		$nextbutton = '';
	}

	$pagepaneltext = '<table cellspacing=8 cellpadding=0 width="100%"><tr><td align=left>'.$prevbutton.'</td><td align=right>'.$nextbutton.'</td></tr></table>';

	pagePanel('', '', '', $pagepaneltext);
}

pageDisplay('News Article', 'pageLocalDisplay');

?>
