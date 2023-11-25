<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_news_functions.php');
require_once('_news-database.php');

# Load language file
LoadLanguageFile('archivednews.php');

function pageLocalDisplay()
{
	global $OldestNewsYear, $OldestNewsMonth;

	$newsperiod = isset($_GET['newsperiod']) ? $_GET['newsperiod'] : NULL;

	$newsyear = 0; //Using this to detect whether the news-period is found and is correct.
	if ((!is_null($newsperiod)) && (strlen($newsperiod) === 6))
	{
		$newsyear = intval(substr($newsperiod, 0, 4));
		$newsmonth = intval(substr($newsperiod, 4, 2));
		if (($newsyear < $OldestNewsYear) || ($newsmonth < 1) || ($newsmonth > 12) || ($newsyear === $OldestNewsYear && $newsmonth < $OldestNewsMonth))
		{
			$newsyear = 0;
		}
		else
		{
			$newsperiod = mktime(0,0,0,date('m'),1,date('Y'));
			if (($newsyear > intval(date('Y', $newsperiod))) || ($newsyear === intval(date('Y', $newsperiod)) && $newsmonth > intval(date('m', $newsperiod))))
			{
				$newsyear = 0;
			}
		}
	}
	if ($newsyear === 0)
	{
		$newsperiod = mktime(0,0,0,date('m'),1,date('Y'));
		$newsyear = intval(date('Y', $newsperiod));
		$newsmonth = intval(date('m', $newsperiod));
	}

	if ($newsyear && $newsmonth)
	{
		$month = date('F', mktime(0,0,0,$newsmonth,1,$newsyear));
		pageName('Archived News of ' . $month . ' ' . $newsyear);
	} else
		pageName('Archived News');

	$filterpanel = '<form action="archivednews.php" method="get">Select year and month of archived news: <select name="newsperiod">';

	$LastDate = mktime(0,0,0,$OldestNewsMonth,1,$OldestNewsYear);
	$CurTime = time();
	$year = intval(date('Y', $CurTime));
	$month = intval(date('m', $CurTime));
	do
	{
		$somedate = mktime(0,0,0,$month,1,$year);
		if (intval(date('Y', $somedate)) === $newsyear && intval(date('m', $somedate)) === $newsmonth)
			$selected = ' selected';
		else
			$selected = '';
		$NRArticles = countArchiveNews(mktime(0,0,0, $month+1, 0, $year), $somedate);
		$filterpanel .= '<option' . $selected . ' value="' . date('Ym', $somedate) . '">' . date('Y F', $somedate) . ' (' . $NRArticles . ')';
		$month--;
		if ($month === 0)
		{
			$month = 12;
			$year--;
		}
	}
	while ($somedate > $LastDate); #Note: Not including 'equal' case, because somedate is still pointing to the current iteration.

	$filterpanel .= '</select>&nbsp;&nbsp;<input type="submit" value="Show me"></form>';

	if (($newsyear > $OldestNewsYear) || ($newsyear === $OldestNewsYear && $newsmonth > $OldestNewsMonth))
	{
		$somedate = mktime(0,0,0,$newsmonth - 1,1,$newsyear);
		$prevbutton = '<form action="archivednews.php" method="get"><input type="hidden" name="newsperiod" value="' . date('Ym', $somedate) . '"><input type="submit" value="&lt;--- Prev month"></form>';
	} else
		$prevbutton = '';
	if (($newsyear < intval(date('Y'))) || ($newsyear === intval(date('Y')) && $newsmonth < intval(date('m'))))
	{
		$somedate = mktime(0,0,0,$newsmonth + 1,1,$newsyear);
		$nextbutton = '<form action="archivednews.php" method="get"><input type="hidden" name="newsperiod" value="' . date('Ym', $somedate) . '"><input type="submit" value="Next month ---&gt;"></form>';
	} else
		$nextbutton = '';
	$bottombuttons = '<table align=center cellspacing=0 cellpadding=0><tr><td>'.$prevbutton.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.$nextbutton.'</td></tr></table>';

	#if (true) {
		$topbuttons = '<table cellspacing=8 cellpadding=0 width="100%"><tr><td align=left>'.$prevbutton.'</td><td align=center>'.$filterpanel.'</td><td align=right>'.$nextbutton.'</td></tr></table>';
	#} else {
	#  $topbuttons = $filterpanel;
	#}

	pagePanel(NULL, 'Select...', '', $topbuttons);

	if ($newsyear && $newsmonth)
	{
		if (displayArchiveNews(mktime(0,0,0, $newsmonth+1, 0, $newsyear), mktime(0,0,0, $newsmonth, 1, $newsyear)) > 0)
			pagePanel(NULL, '', '', $bottombuttons);
	}
}

pageDisplay('Archived News', 'pageLocalDisplay');

?>
