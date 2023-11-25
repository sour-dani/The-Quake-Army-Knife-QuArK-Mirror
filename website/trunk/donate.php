<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_image_functions.php');
require_once('_donate_functions.php');
require_once('_donate-database.php');

# Load language file
LoadLanguageFile('donate.php');

global $mainroot;

//<p>Click <a rel="noopener" target="_blank" href="https://sourceforge.net/project/project_donations.php?group_id=1181">here</a> or on the progress bar below to go to the donate page!</p>
//<a rel="noopener" target="_blank" href="https://sourceforge.net/project/project_donations.php?group_id=1181"></a>
//<p class="xsml">Note: SourceForge and PayPal have a small donation fee (around $1.00 for small donations) that\'ll be deducted from the amount you donate.</p>

$donatetext = '<p>If you like QuArK, why not support us? Even though the website is hosted at no charge by SourceForge (thanks!), QuArK is <b>NOT</b> a commercial project, so everybody on the project is spending their own time on it. With the donations we can buy new games and hardware to run and test QuArK with these new games so we can build support for those into QuArK. And we will <b>ONLY</b> use the donations for these purposes!</p>

<p>Please contact the <a href="'.$mainroot.'communication.php#webmaster">webmaster</a> for details on how to donate.</p>';

/*
<hr class="smallbreak">

<p><b>Current target</b><br>
Goal: '.$DonateReason.'<br>
Target: $'.$DonateTarget.'<br>
Progress: $'.$DonateProgress.'</p>

<table width="100%" cellspacing=0 cellpadding=0>
<tr><td valign=middle>$0.00</td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td valign=middle>'.imgsProgressBar($DonateProgress / $DonateTarget).'</td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td valign=middle>$'.$DonateTarget.'</td></tr></table>';
*/

function pageLocalDisplay()
{
	pageName('Donate');

	global $donatetext;

	pagePanel('community', 'Donate to support QuArK', '', $donatetext);

	global $Donators;
	if (!is_array($Donators))
	{
		#Nothing to display...
		return;
	}

	$Table2Rows = array('table2rowA', 'table2rowB');
	$CurrentRow = 0;

	$bodytext = '<p>Here\'s a list of all the supporting people that have donated to QuArK:</p>';

	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head"><b>Donator name</b></td>';
	$bodytext .= '<td class="text1, table2head"><b>Date donation</b></td>';
	#$bodytext .= '<td class="text1, table2head"><b>Amount donated (after deductions)</b></td>';
	$bodytext .= '<td class="text1, table2head"><b>Comment by donator</b></td></tr>';
	for ($Donator = 0; $Donator < count($Donators); $Donator++)
	{
		$CurrentDonator = &$Donators[$Donator];
		$bodytext .= '<tr><td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';
		if (is_null($CurrentDonator->Name))
		{
			$bodytext .= '-anonymous-';
		}
		else
		{
			$bodytext .= $CurrentDonator->Name;
		}
		$bodytext .= '</td><td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';
		if ($CurrentDonator->Date === 0)
		{
			$bodytext .= '-unknown-';
		}
		else
		{
			$bodytext .= DisplayDate($CurrentDonator->Date);
		}
		#$bodytext .= '</td><td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';
		#if (is_null($CurrentDonator->Amount]))
		#{
		#  $bodytext .= '-unknown-';
		#}
		#else
		#{
		#  $bodytext .= $CurrentDonator->Amount;
		#}
		$bodytext .= '</td><td class="text1, '.$Table2Rows[$CurrentRow & 1].'">';
		if (is_null($CurrentDonator->Comment))
		{
			$bodytext .= '-';
		}
		else
		{
			$bodytext .= $CurrentDonator->Comment;
		}
		$bodytext .= '</td></tr>'; $CurrentRow++;
	}
	$bodytext .= '</table>';

	pagePanel('community', 'People that have donated', '', $bodytext);
}

pageDisplay('Donate', 'pageLocalDisplay');

?>
