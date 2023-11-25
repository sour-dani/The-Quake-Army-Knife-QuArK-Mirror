<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_game-database.php');
require_once('_link-database.php');
require_once('_panels_functions.php');
require_once('_panels-database.php');

# Load language file
LoadLanguageFile('links.php');

global $UsefulPanel;
hidePanel($UsefulPanel);

if (isset($_GET['showarchived']))
{
	$ShowArchived = ($_GET['showarchived'] != 0);
}
else
{
	$ShowArchived = FALSE;
}

function IsWhichGame($Tag)
{
	if (is_null($Tag))
		return -1;

	#FIXME: This is a bad function... We need a better way to store games! A keyed $Games array?
	global $Games;

	for ($Game = 0; $Game < count($Games); $Game++)
	{
		$CurrentGame = &$Games[$Game];
		if ($CurrentGame->GameID === $Tag)
			return $Game;
	}
	return -1;
}

function linksLinkGroupPanel($LinkDatabase)
{
	global $webmasteremail;

	global $Games;

	global $ShowArchived;

	$bodytext = '';

	for ($LinkGroup = 0; $LinkGroup < count($LinkDatabase); $LinkGroup++)
	{
		$CurrentLinkGroup = &$LinkDatabase[$LinkGroup];

		if (!$ShowArchived)
		{
			$OnlyArchivedLinks = True;
			for ($Link = 0; $Link < count($CurrentLinkGroup->Links); $Link++)
			{
				$CurrentLink = &$CurrentLinkGroup->Links[$Link];
				if (is_null($CurrentLink->ArchiveURL))
				{
					$OnlyArchivedLinks = False;
					break;
				}
			}
			if ($OnlyArchivedLinks)
				continue;
		}

		if ($LinkGroup !== 0)
			$bodytext .= '<br>';

		if (!is_null($CurrentLinkGroup->Tag))
		{
			$bodytext .= '<a name="'.$CurrentLinkGroup->Tag.'"></a>';
		}

		$bodytext .= '<table cellpadding=2 cellspacing=0 width="95%" align=center>';

		$bodytext .= '<tr><td class="tablehead">';
		$bodytext .= '<b>'.$CurrentLinkGroup->Name.'</b>';
		$bodytext .= '</td></tr>';

		$bodytext .= '<tr><td class="tablesubhead">';
		$bodytext .= '<table cellpadding=6><tr><td class="tablesubhead">';
		$WhichGame = IsWhichGame($CurrentLinkGroup->Tag);
		if ($WhichGame != -1)
		{
			$bodytext .= DisplayGameIcon($WhichGame, null, '32', '32');
		}
		$bodytext .= '</td><td class="tablesubhead">';
		$bodytext .= 'If you have a good link that is not listed here, or a link is dead, please <a href='.DisplayEncodedEmail($webmasteremail, NULL, '-- NOTICE: HTML e-mails will be bounced, so send only in plain-text! --').'>tell us</a>.';
		$bodytext .= '</td></tr></table></td></tr>';

		$bodytext .= '<tr><td class="tablecell">';
		$bodytext .= '<table cellpadding=0 cellspacing=0 width="100%">';

		if ($WhichGame != -1)
		{
			if (!is_null($Games[$WhichGame]->URL))
			{
				$bodytext .= '<tr><td class="tablecell" width=240>';
				$bodytext .= '- <a href="'.$Games[$WhichGame]->URL.'" target="_blank" rel="noopener">';
				$bodytext .= 'Official website'; #FIXME: Change this to something nicer!
				$bodytext .= '</a>';
				$bodytext .= '</td><td class="tablecell">';
				$bodytext .= 'Official website for '.$Games[$WhichGame]->GameTitle;
				$bodytext .= '</td></tr>';
			}
		}

		for ($Link = 0; $Link < count($CurrentLinkGroup->Links); $Link++)
		{
			$CurrentLink = &$CurrentLinkGroup->Links[$Link];
			if (!$ShowArchived)
			{
				if (!is_null($CurrentLink->ArchiveURL))
					continue;
			}
			$bodytext .= '<tr><td class="tablecell" width=240>';
			$bodytext .= '- <a href="'.$CurrentLink->GetURL().'" target="_blank" rel="noopener">';
			$bodytext .= $CurrentLink->Title;
			$bodytext .= '</a>';
			$bodytext .= '</td><td class="tablecell">';
			if (!is_null($CurrentLink->Description))
			{
				$bodytext .= $CurrentLink->Description;
			}
			else
			{
				$bodytext .= '&nbsp;';
			}
			$bodytext .= '</td></tr>';
		}
		$bodytext .= '</table>';

		$bodytext .= '</td></tr>';
		$bodytext .= '</table>';
	}
	return $bodytext;
}

function pageLocalDisplay()
{
	pageName('Links');

	global $LinksGeneric;
	global $LinksGame;

	global $ShowArchived;

	$bodytext = '<p>Here is a collection of links related to map-design, and other very useful information, categorized into several groups.</p>';

	$bodytext .= '<form action="links.php" method="GET"><fieldset><legend>Filter the links</legend>
	<label><input type="checkbox" name="showarchived" value="1"'.($ShowArchived ? ' checked' : '').'>Include archived webpages</label><br>
	<input type="submit">
	</fieldset></form>';

	pagePanel('community', 'Links', '', $bodytext);

	pagePanel('community', 'Generic links', '', linksLinkGroupPanel($LinksGeneric));
	pagePanel('community', 'Game links', '', linksLinkGroupPanel($LinksGame));
}

pageDisplay('Links', 'pageLocalDisplay');

?>
