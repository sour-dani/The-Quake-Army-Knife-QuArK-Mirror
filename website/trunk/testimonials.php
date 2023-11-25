<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_testimonials-database.php');
require_once('_people-database.php');

# Load language file
LoadLanguageFile('testimonials.php');

function pageLocalDisplay()
{
	global $Testimonials;

	global $mainroot;
	global $webmasteremail;

	pageName('Testimonials');

	$bodytext = "<p>Here's a collection of testimonials of users about QuArK.</p>";

	$bodytext .= "<p>Don't neglect to check out the comments left by our donators <a href=\"".$mainroot."donate.php\">here</a>, or the reviews on the SourceForge website <a rel=\"noopener\" target=\"_blank\" href=\"https://sourceforge.net/projects/quark/reviews/\">here</a>!</p>";

	$bodytext .= '<p>If you have a testimonial you want to send in, please <a href='.DisplayEncodedEmail($webmasteremail, 'QuArK testimonial').'>send it here</a>.</p>';

	$bodytext .= '<hr class="smallbreak">';

	for ($Testimonial = 0; $Testimonial < count($Testimonials); $Testimonial++)
	{
		$CurrentTestimonial = &$Testimonials[$Testimonial];

		if ($Testimonial != 0)
		{
			$bodytext .= '<hr class="smallbreak">';
		}
		if (is_null($CurrentTestimonial->Author))
		{
			$bodytext .= '<b>'.$CurrentTestimonial->Name.'</b> on '.DisplayDate($CurrentTestimonial->Date).' said:';
		}
		else
		{
			$bodytext .= '<b><a class="personlink" target="_blank" href="'.$mainroot.'person.php?PersonID='.($CurrentTestimonial->Author+1).'">'.$CurrentTestimonial->Name.'</a></b> on '.DisplayDate($CurrentTestimonial->Date).' said:';
		}
		$bodytext .= '<div align=center><div class="paneltestimonial">';
		$bodytext .= '<p>'.$CurrentTestimonial->Text.'</p>';
		$bodytext .= '<p align=right>Source: '.$CurrentTestimonial->Source.'</p>';
		$bodytext .= '</div>';
		$bodytext .= '</div>';
	}

	pagePanel('community', 'What people say about QuArK...', '', $bodytext);
}

pageDisplay('Testimonials', 'pageLocalDisplay');

?>
