<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_features-database.php');
require_once('_screenshots-database.php');
require_once('_image_functions.php');
require_once('_main_paths.php');

# Load language file
LoadLanguageFile('features.php');

function displayFeatures(&$Features, $title)
{
	$bodytext = '<p style="margin-bottom: 0px;"><b>'.$title.'</b></p>';
	$bodytext .= '<ul class="nowhitespace">'."\n";
	for ($Feature = 0; $Feature < count($Features); $Feature++)
	{
		$CurrentFeature = &$Features[$Feature];
		$bodytext .= '<li>' . $CurrentFeature . '</li>'."\n";
	}
	$bodytext .= '</ul>'."\n";
	return $bodytext;
}

function pageLocalDisplay()
{
	pageName('Features & Screenshots');

	global $FeaturesMain, $FeaturesMap, $FeaturesModel, $FeaturesViewports, $FeaturesSupport, $FeaturesOthers;
	global $Screenshots;

	global $infobaseroot;

	$bodytext = displayFeatures($FeaturesMain, 'Main features');
	$bodytext .= displayFeatures($FeaturesMap, 'Map editor features');
	$bodytext .= displayFeatures($FeaturesModel, 'Model editor features');
	$bodytext .= displayFeatures($FeaturesViewports, 'Viewport features');
	$bodytext .= displayFeatures($FeaturesSupport, 'Supported file features');
	$bodytext .= displayFeatures($FeaturesOthers, 'Other features');
	$bodytext .= '<p>To get started quickly, here\'s a direct link the <a href="'.$infobaseroot.'maped.tutorial.html">map-tutorial</a> for a quick glance of how to work in the map editor.</p>';

	echo '<a name="features"></a>';
	pagePanel('features', 'Features of QuArK 6.x', '', $bodytext);

	#---

	global $screenshot_image_arraycol;
	global $screenshot_label_arraycol;
	global $screenshot_description_arraycol;

	$bodytext = '<div class="centered">'."\n";

	for ($Screenshot = 0; $Screenshot < count($Screenshots); $Screenshot++)
	{
		#FIXME: Clean this up! Also, add to other themes!
		$CurrentScreenshot = &$Screenshots[$Screenshot];
		if (!is_null($CurrentScreenshot[$screenshot_description_arraycol]))
		{
			$bodytext .= '<div class="mouseover" style="margin: 16px; display: inline-block;">' . DisplayRawImage($CurrentScreenshot[$screenshot_image_arraycol]) . '<br>'."\n" . $CurrentScreenshot[$screenshot_label_arraycol] . '<div class="popup">'.$CurrentScreenshot[$screenshot_description_arraycol].'</div></div>'."\n";
		}
		else
		{
			$bodytext .= '<div style="margin: 16px; display: inline-block;">' . DisplayRawImage($CurrentScreenshot[$screenshot_image_arraycol]) . '<br>'."\n" . $CurrentScreenshot[$screenshot_label_arraycol] . '</div>'."\n";
		}
	}
	$bodytext .= '</div>'."\n";

	echo '<a name="screenshots"></a>';
	pagePanel('features', 'Screenshots of QuArK 5.x', '', $bodytext);

	#---

	echo '<a name="sysreqs"></a>';
	pagePanelFile('features', 'System Requirements of QuArK 6.x', '', 'features_quark6_system_requirements.html');
}

pageDisplay('Features', 'pageLocalDisplay');

?>
