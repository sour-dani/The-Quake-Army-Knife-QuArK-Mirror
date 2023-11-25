<?php
require_once('_functions.php');
require_once('_link-database.php');

global $mainroot, $keepinframe;

global $LinksGeneric;

$CurrentLinkGroup = &$LinksGeneric[array_rand($LinksGeneric, 1)];
$linkstxt = '<b>' . $CurrentLinkGroup->Name . '</b><br>';

$linkstxt .= '<ul class="nowhitespace">';
for ($Link = 0; $Link < count($CurrentLinkGroup->Links); $Link++)
{
	$CurrentLink = &$CurrentLinkGroup->Links[$Link];
	$linkstxt .= '<li><a rel="noopener" target="_blank" href="' . $CurrentLink->getURL() . '">' . $CurrentLink->Title . '</a></li>';
}
$linkstxt .= '</ul>';

$linkstxt .= '<hr class="smallbreak">
<div class="centered">For more links, check out the <a ' . $keepinframe . 'href="'.$mainroot.'links.php">Links page</a>.</div>';

pageSidePanel('', 'Useful Links...', $linkstxt);

?>
