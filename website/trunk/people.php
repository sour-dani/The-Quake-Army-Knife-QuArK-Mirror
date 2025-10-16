<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_people-database.php');

# Load language file
LoadLanguageFile('people.php');

if (isset($_GET['page']))
{
	$page = intval($_GET['page']) - 1;
	if ($page < 0)
		$page = 0;
}
else
{
	$page = 0;
}

$SearchName = isset($_GET['name']) ? $_GET['name'] : NULL;

$peopleform = '<div class="centered">
<form action="people.php" method="get">
<table cellspacing=4 cellpadding=0 align=center>
  <tr><td>Name:</td>
      <td>&nbsp;</td>
      <td><input type="text" name="name" value="'.$SearchName.'"></td></tr>
  <tr><td colspan=3 align=center>
  <input type="submit" value="Search">
  </td></tr>
</table>
</form>
</div>';

#Do actual search:
global $personsdatabase;
global $DidSearch;
global $SearchResult;
$DidSearch = false;
$SearchResult = NULL;
if (isset($SearchName) and ($SearchName != ''))
{
	$DidSearch = true;
	$SearchResult = array();

	$noperson = count($personsdatabase);
	for ($person = 0; $person < $noperson; $person++)
	{
		$CurrentPerson = &$personsdatabase[$person];
		if (strpos($CurrentPerson->getDisplayName(), $SearchName) !== FALSE)
		{
			$SearchResult[] = $person;
		}
	}
}
else
{
	$SearchResult = array();

	$TmpList = array();
	$noperson = count($personsdatabase);
	for ($person = 0; $person < $noperson; $person++)
	{
		$CurrentPerson = &$personsdatabase[$person];
		$TmpList[$CurrentPerson->getDisplayName()] = $person;
	}

	if (ksort($TmpList) === FALSE)
	{
		#FIXME: Dunno, what should we do with this?
	}

	foreach ($TmpList as $PersonNick => $PersonID)
	{
		$SearchResult[] = $PersonID;
	}
}

function pageLocalDisplay()
{
	global $personsdatabase;

	global $mainroot;

	global $webmasteremail;

	pageName("People");

	global $peopleform;

	global $DidSearch;
	global $SearchResult;

	global $Settings;
	global $PeoplePageSize;

	global $page;

	$bodytext = '<p>This is a list of all the people that are connected in some manner to QuArK. People may be missing from this list. If you know of somebody that belongs on this list, please contact the webmaster <a href='.DisplayEncodedEmail($webmasteremail).'>here</a>.</p>';
	$bodytext .= '<hr class="smallbreak">';

	pagePanel('community', 'Search...', '', $bodytext.$peopleform);

	$SelectedPeopleCount = count($SearchResult);

	$peopleperpage = $Settings[$PeoplePageSize]->GetCurrentValue();

	$max_page = (floor(($SelectedPeopleCount + $peopleperpage - 1) / $peopleperpage)) - 1;

	if (($page * $peopleperpage) > $SelectedPeopleCount)
	{
		$page = 0;
	}

	#FIXME: Allow to disable paging!
	if ($SelectedPeopleCount > $peopleperpage)
	{
		# If needed, display the top paging panel
		if ($page > 0)
		{
			$prevbutton = '<form action="people.php" method="get"><input type="hidden" name="page" value="' . ($page + 1 - 1) . '"><input type="submit" value="&lt;--- Prev page"></form>';
			#FIXME: Add search keywords!!!
		}
		else
		{
			$prevbutton = '';
		}
		if ($page < $max_page)
		{
			$nextbutton = '<form action="people.php" method="get"><input type="hidden" name="page" value="' . ($page + 1 + 1) . '"><input type="submit" value="Next page ---&gt;"></form>';
			#FIXME: Add search keywords!!!
		}
		else
		{
			$nextbutton = '';
		}
		$filterpanel = '';
		#FIXME: TEMP:
		$filterpanel = 'Page: ' . ($page + 1) . ' / ' . ($max_page + 1);

		$pagepaneltext = '<table cellspacing=8 cellpadding=0 width="100%"><tr><td align=left>'.$prevbutton.'</td><td align=center>'.$filterpanel.'</td><td align=right>'.$nextbutton.'</td></tr></table>';
		pagePanel('', 'Select...', '', $pagepaneltext);
	}

	# Display the people
	if ($DidSearch)
	{
		$bodytext = "Here's the result of your search:";
	}
	else
	{
		$bodytext = "Here's the full list of people:";
	}
	$bodytext .= '<ul>';
	if ($SelectedPeopleCount === 0)
	{
		$bodytext .= '<li>*nobody*';
	}
	else
	{
		for ($SelectedPerson = $page * $peopleperpage; $SelectedPerson < (($page + 1) * $peopleperpage); $SelectedPerson++)
		{
			if ($SelectedPerson === $SelectedPeopleCount)
				# Done all the people that need to be done (this page is not full)
				break;
			$PersonIndex = $SearchResult[$SelectedPerson];
			$CurrentPerson = &$personsdatabase[$PersonIndex];
			$bodytext .= '<li>';
			$bodytext .= '<a href="person.php?PersonID='.($PersonIndex+1).'">'.$CurrentPerson->getDisplayName().'</a>'; #FIXME: Remove filename from links...?
		}
	}

	$bodytext .= '</ul>';
	if ($DidSearch)
	{
		$bodytext .= '<hr class="smallbreak">';
		$bodytext .= '<p>Click <a href="'.$mainroot.'people.php">here</a> to reset your search.</p>';
	}

	if ($DidSearch)
	{
		PagePanel('community', 'Searched people', '', $bodytext);
	}
	else
	{
		PagePanel('community', 'All people', '', $bodytext);
	}

	if ($SelectedPeopleCount > $peopleperpage)
	{
		# Display bottom paging panel
		$pagepaneltext = '<table cellspacing=8 cellpadding=0 width="100%"><tr><td align=left>'.$prevbutton.'</td><td align=right>'.$nextbutton.'</td></tr></table>';
		pagePanel('', '', '', $pagepaneltext);
	}
}

pageDisplay('People', 'pageLocalDisplay');

?>
