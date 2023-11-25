<?php
require_once('_functions.php');
require_once('_image_functions.php');

class cNavbarLine
{
	var $Indent; # The indentation level of this line
	var $Title;  # The text to display for this line
	var $Icon;   # The icon of this line (if any)
	var $URL;    # The link for this line (if any)

	function __construct($aIndent, $aTitle, $aIcon=NULL, $aURL=NULL)
	{
		$this->Indent = $aIndent;
		$this->Title  = $aTitle;
		$this->Icon   = $aIcon;
		$this->URL    = $aURL;
	}
}

function stringNavbar($navbararray)
{
	global $keepinframe;

	# Find the maximum indent level
	$maxidentlevels = 0;
	for ($navbarline = 0; $navbarline < count($navbararray); $navbarline++)
	{
		$CurrentNavbarline = &$navbararray[$navbarline];
		if ($CurrentNavbarline->Indent > $maxidentlevels)
			$maxidentlevels = $CurrentNavbarline->Indent;
	}

	$navbarindenticons = array_fill(0, $maxidentlevels - 1, 'none');

	$navbartext = '<table cellpadding=0 cellspacing=0 width="100%">'."\n";
	for ($navbarline = 0; $navbarline < count($navbararray); $navbarline++)
	{
		$CurrentNavbarline = &$navbararray[$navbarline];
		$navbartext .= '	<tr>';

		if ($CurrentNavbarline->Indent > 0)
		{
			# Figure out which indent-icons to use
			for ($indent = 0; $indent < $CurrentNavbarline->Indent - 1; $indent++)
			{
				$navbartext .= '<td>' . DisplayImage($navbarindenticons[$indent]) . '</td>';
			}

			$indenticon = 'right';
			$nextindenticon = 'none';
			$tmpline = $navbarline + 1;
			while ($tmpline < count($navbararray))
			{
				if ($navbararray[$tmpline]->Indent == $CurrentNavbarline->Indent)
				{
					$indenticon = 'downright';
					$nextindenticon = 'down';
					break;
				}
				if ($navbararray[$tmpline]->Indent < $CurrentNavbarline->Indent)
					break;
				$tmpline++;
			}
			$navbartext .= '<td>' . DisplayImage($indenticon) . '</td>';

			$navbarindenticons[$CurrentNavbarline->Indent - 1] = $nextindenticon;
		}

		$colspan = $maxidentlevels - $CurrentNavbarline->Indent + 1;
		$navbartext .= '<td colspan=' . $colspan . '>';

		if (!is_null($CurrentNavbarline->Icon))
		{
			$prefix = DisplayImage($CurrentNavbarline->Icon) . '&nbsp;';
			$postfix = '';
		}
		else
		{
			$prefix = '';
			$postfix = '';
		}
		if (!is_null($CurrentNavbarline->URL))
		{
			$prefix = $prefix . '<a ' . $keepinframe . 'href="' . $CurrentNavbarline->URL . '">';
			$postfix = '</a>' . $postfix;
		}
		if ($CurrentNavbarline->Indent < 2)
		{
			$prefix = $prefix . '<b>';
			$postfix = '</b>' . $postfix;
		}
		$navbartext .= $prefix . $CurrentNavbarline->Title . $postfix;

		$navbartext .= '</td></tr>'."\n";
	}
	$navbartext .= '</table>';
	return $navbartext;
}

?>
