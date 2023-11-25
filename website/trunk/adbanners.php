<?php
require_once('_base_code.php');
require_once('_main_paths.php');
require_once('_language_functions.php');

# Load language file
LoadLanguageFile('adbanners.php');

function pageLocalDisplay()
{
	pageName('Ad Banners');

	$bodytext = 'With the historic "upcoming Quake-3:Arena map-editing support in QuArK" event, I asked the community for any artist, who would be able to
create an <u>ad</u>vertise-<u>banner</u>, which had the following animation:<br>
<blockquote class="sml">
<ul>
<li>Blank ad-banner, the text "Q3A" becomes visible (either by zoom or fade-in) in the left side.
<li>Then the "Q3A" counts up to "Q4A", then "Q5A", and if Armin decides to have the QuArK version be 6, the banner should count to "Q6A".
<li>At this point the viewer must be puzzled, because there isn\'t any Quake-6:Arena out (he he), so the "Q6A" becomes "Qu6", then "QuA6", "QuAr6" and finally "QuArK6".
<li>Next up, some smaller text are added: "now supporting Q3A map-editing", and then the supported game-names pop-up; "Quake-2", "Quake-1", "Hexen-2", "Heretic-2", "Half-Life", "SiN", "KingPin". It could be supplied by the Q-style logos and the other games\' logos too.
<li>Then the whole thing loops...
</ul>
</blockquote>

<!--
Unfortunate for the artists, our host <a href="http://www.planetquake.com/">PlanetQuake</a> has some restrictions on ad-banners:
<ul class="sml">
	<li>Dimensions: 468 x 60 pixels
	<li>Format: GIF, can be animated
	<li>Filesize: No larger than 14K (14336 bytes)
</ul>
So far, the following artists from the QuArK community have produced these ad-banners:<br>
<br>
-->

This is what the artists of the QuArK community have produced of ad-banners. See also the <a href="'.$mainroot.'instapolls.php">instapolls archive</a>.';

	pagePanel('community', 'Ad-banners', '', $bodytext);

	pagePanelFile('community', 'Ad-banners by the community', '', 'adbanners_list.html');
}

pageDisplay('Ad Banners', 'pageLocalDisplay');

?>
