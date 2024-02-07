<?php
require_once('_functions.php');
require_once('_news-database.php');
require_once('_people-database.php');
require_once('_main_paths.php');

class cNews
{
	var $Author; # PersonID of the author of the news article
	var $Date;   # Date of the news article
	var $Source; # Source of the news article
	var $File;   # Filename of the file containing the text of the news article

	function __construct($aAuthor, $aDate, $aSource, $aFile)
	{
		$this->Author        = $aAuthor;
		$this->Date          = $aDate;
		$this->Source        = $aSource;
		$this->File          = $aFile;
	}
}

function displayNews($maxarticles)   # Note: Iteration of the news-article is in reversed chronological order!
{
	global $News;

	$countarticles = 0;
	for ($CurNews = count($News)-1; $CurNews >= 0; $CurNews--)
	{
		$countarticles++;
		displayNewsArticle($CurNews);

		if (($maxarticles > 0) && ($countarticles >= $maxarticles))
			break;
	}
	return $countarticles;
}

function countArchiveNews($fromdate=0, $todate=0)
{
	global $News;

	# See: http://www.php.net/manual/en/function.getdate.php
	if ($fromdate === 0)
		$tmpdate = getdate();
	else
		$tmpdate = getdate($fromdate);
	$year = $tmpdate['year'];
	$month = $tmpdate['mon'];
	$day = $tmpdate['mday'];
	if ($todate === 0)
		$todate = time();
	if ($todate < $fromdate)
	{
		# Swap them
		$tmpdate = $fromdate;
		$fromdate = $todate;
		$todate = $tmpdate;
	}

	$countarticles = 0;
	for ($CurNews = 0; $CurNews < count($News); $CurNews++)
	{
		$CurrentNewsArticle = &$News[$CurNews];
		if (($CurrentNewsArticle->Date >= $fromdate) && ($CurrentNewsArticle->Date <= $todate))
		{
			$countarticles++;
		}
	}
	return $countarticles;
}

function displayArchiveNews($fromdate=0, $todate=0)
{
	global $News;

	# See: http://www.php.net/manual/en/function.getdate.php
	if ($fromdate === 0)
		$tmpdate = getdate();
	else
		$tmpdate = getdate($fromdate);
	$year = $tmpdate['year'];
	$month = $tmpdate['mon'];
	$day = $tmpdate['mday'];
	if ($todate === 0)
		$todate = time();
	if ($todate < $fromdate)
	{
		# Swap them
		$tmpdate = $fromdate;
		$fromdate = $todate;
		$todate = $tmpdate;
	}

	$countarticles = 0;
	for ($CurNews = 0; $CurNews < count($News); $CurNews++)
	{
		$CurrentNewsArticle = &$News[$CurNews];
		if (($CurrentNewsArticle->Date >= $fromdate) && ($CurrentNewsArticle->Date <= $todate))
		{
			$countarticles++;
			displayNewsArticle($CurNews);
		}
	}
	return $countarticles;
}

function displayNewsArticle($ArticleID)
{
	global $News;
	global $mainroot;

	if (($ArticleID < 0) or ($ArticleID >= count($News)))
	{
		$bodytext = '<p>ERROR! ArticleID out of range!</p>';
		PagePanel('news', 'News Article', '', $bodytext);
		return;
	}

	$CurrentNewsArticle = &$News[$ArticleID];

	# Read the news from the file
	global $newsroot;
	if (file_exists($newsroot.$CurrentNewsArticle->File))
	{
		$thefile = file($newsroot.$CurrentNewsArticle->File);

		# Figure out if there is a '<author>xxxx</author>' in the first line.
		$author = current($thefile);
		$start = stripos($author, '<author>');
		$stop = stripos($author, '</author>');
		if (($start !== FALSE) and ($stop !== FALSE))
		{
			$start += strlen('<author>');
			$newsauthor = substr($author, $start, $stop - $start);
			next($thefile);
		}
		else
		{
			# No author tag
			$newsauthor = NULL;
		}

		if ($CurrentNewsArticle->Author !== -1)
		{
			if (is_null($newsauthor))
			{
				global $personsdatabase;
				$newsauthor = $personsdatabase[$CurrentNewsArticle->Author]->getDisplayName();
			}
			$newsauthor = '<a class="personlink" href="'.$mainroot.'person.php?PersonID='.($CurrentNewsArticle->Author+1).'">'.$newsauthor.'</a>';
		}
		else
		{
			if (is_null($newsauthor))
			{
				$newsauthor = '(unknown author)';
			}
		}

		if (!is_null($CurrentNewsArticle->Source))
		{
			$newssource = ' - (' . $CurrentNewsArticle->Source . ')';
		}
		else
		{
			$newssource = '';
		}

		if (!is_null($CurrentNewsArticle->Date))
		{
			$headtxt = DisplayDate($CurrentNewsArticle->Date);

			$headtxt .= '&nbsp;&nbsp;&nbsp;<span class="newsago">('.DisplayTimeAgo($CurrentNewsArticle->Date).')</span>';
		}
		else
		{
			$headtxt = '';
		}
		$bodytxt = '';
		while (!is_null(key($thefile))) //Can't use foreach here, because that ignored the current array pointer.
		{
			$line = current($thefile);
			$line = str_ireplace('<headline>', '<p class="newsheadline">', $line);
			$line = str_ireplace('</headline>', '</p>', $line);

			$line = str_ireplace('<blockquote>', '<div class="newsquote">', $line);
			$line = str_ireplace('</blockquote>', '</div>', $line);

			$start = strpos($line, '<pic ');
			if ($start !== FALSE)
			{
				$start += strlen('<pic ');
				$stop = strpos($line, '>', $start);
				if ($stop !== FALSE)
				{
					$stop += strlen('>');
					$img = DisplayImage(substr($line, $start, $stop - $start - 1));
					$line = substr($line, 0, $start - strlen('<pic ')) . $img . substr($line, $stop, strlen($line) - $stop);
				}
			}

			$bodytxt .= $line;
			next($thefile);
		}

		pagePanel('news', $headtxt, $newsauthor . $newssource, $bodytxt);
	}
}

?>
