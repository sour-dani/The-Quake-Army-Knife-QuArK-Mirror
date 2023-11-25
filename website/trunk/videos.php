<?php
require_once('_base_code.php');
require_once('_image_functions.php');
require_once('_language_functions.php');
require_once('_video-database.php');
require_once('_settings-database.php');

# Load language file
LoadLanguageFile('videos.php');

$checkboxon = array(NULL => ''
                   ,'on' => 'checked '
                   ,'1'  => 'checked ');

$T1 = isset($_GET['T1']) ? $_GET['T1'] : NULL;
$T2 = isset($_GET['T2']) ? $_GET['T2'] : NULL;
$T3 = isset($_GET['T3']) ? $_GET['T3'] : NULL;
$TZ = isset($_GET['TZ']) ? $_GET['TZ'] : NULL;
$TA = isset($_GET['TA']) ? $_GET['TA'] : NULL;

$videosform = '<div class="centered">
<form action="videos.php" method="get">
<table cellspacing=0 cellpadding=0 align=center>
  <tr><td colspan=2 class="filterhead"><b>Types:</b></td></tr>
  <tr><td class="filterbody" valign=top align=left style="padding-left: 8px; padding-right: 8px;">
    <label><input '.$checkboxon[$T1].'type="checkbox" value="1" name="T1">Tutorials</label><br>
    <label><input '.$checkboxon[$T2].'type="checkbox" value="1" name="T2">Demonstrations</label><br>
    <label><input '.$checkboxon[$T3].'type="checkbox" value="1" name="T3">Previews</label>
  </td>
  <td class="filterbody" valign=top align=left style="padding-left: 8px; padding-right: 8px;">
    <label><input '.$checkboxon[$TZ].'type="checkbox" value="1" name="TZ">Unknown</label>
  </td></tr>
  <tr><td colspan=2 class="filterbody" align=center>
    <label><input '.$checkboxon[$TA].'type="checkbox" value="1" name="TA">Just show me for all types!</label>
  </td></tr>
  <tr><td colspan=2 align=center>
  <input type="submit" value="Show me">
  </td></tr>
</table>
</form>
Select at least one video type checkbox.
</div>
<p>Note: Some videos might be in compressed files (.zip, .rar, ...) or need special plugins or codecs to play properly.</p>';

# Create a regular-search-exp for type-ids
$videotypes = array();
if ($T1 || $TA) $videotypes[] = 'T1';
if ($T2 || $TA) $videotypes[] = 'T2';
if ($T3 || $TA) $videotypes[] = 'T3';
if ($TZ || $TA) $videotypes[] = '-';

function pageLocalDisplay()
{
	global $videosform, $videotypes;
	global $videotypeslist, $mediatypeslist;

	global $videosdatabase;

	global $mainroot;

	global $Settings;
	global $VideoPlayer;

	pageName('Videos');

	pagePanel('movies', 'Filter...', '', $videosform);

	if ($Settings[$VideoPlayer]->Value === 0)
	{
		echo '<a name="chooseplayer"></a>';
		$bodytext = '<p>To select the type of video player to use, please <a href="'.$mainroot.'choosevideoplayer.php">select your preference here</a>.</p>';
		pagePanel("movies", 'Choose video player', '', $bodytext);
	}

	if ($videotypes)
	{
		# First, find all the maps that match the filter options
		$SelectedVideos = array();

		for ($videono = 0; $videono < count($videosdatabase); $videono++)
		{
			$CurrentVideo = &$videosdatabase[$videono];
			if (count(array_intersect(explode(' ', $CurrentVideo->Type), $videotypes)) !== 0)
			{
				$SelectedVideos[] = $videono;
			}
		}

		$SelectedVideosCount = count($SelectedVideos);
		if ($SelectedVideosCount === 0)
		{
			$bodytext = '<p>No videos matching your filter options were found.</p>';
			pagePanel('community', 'Nothing to display', '', $bodytext);
		}
		else
		{
			# Display the videos
			for ($SelectedVideo = 0; $SelectedVideo < $SelectedVideosCount; $SelectedVideo++)
			{
				$CurrentVideo = &$videosdatabase[$SelectedVideos[$SelectedVideo]];

				$bodytext = '';

				if (!is_null($CurrentVideo->Screenshot))
				{
					$bodytext .= '<div style="float: right;">';

					if (!is_null($CurrentVideo->Link))
						$bodytext .= '<a href="showvideo.php?VideoID='.($SelectedVideos[$SelectedVideo]+1).'">';
					$bodytext .= DisplayRawImage($CurrentVideo->Screenshot);
					if (!is_null($CurrentVideo->Link))
						$bodytext .= '</a>';

					$bodytext .= '</div>';
				}

				$bodytext1 = '';
				if (!is_null($CurrentVideo->Length))
					$bodytext1 .= '<b>Video length</b>: ' . $CurrentVideo->Length . '<br>';
				else
					$bodytext1 .= '<b>Video length</b>: unknown<br>';
				$bodytext1 .= '<b>Movie format</b>: ' . $mediatypeslist[$CurrentVideo->Mediatype] . '<br>';
				if (!is_null($CurrentVideo->Codecs))
					$bodytext1 .= '<b>Used codec(s)</b>: ' . $CurrentVideo->Codecs . '<br>';
				if ($CurrentVideo->FileSize !== 0)
					$bodytext1 .= '<b>File size</b>: ' . DisplayByteSize($CurrentVideo->FileSize) . '<br>';

				if ($bodytext1 !== '')
				{
					$bodytext .= $bodytext1 . '<br>';
				}

				$bodytext1 = '';
				if ($CurrentVideo->DatePublished !== 0)
					$bodytext1 .= '<b>Published</b>: ' . DisplayDate($CurrentVideo->DatePublished) . '<br>';
				if (!is_null($CurrentVideo->Author))
				{
					if (!is_null($CurrentVideo->EmailAuthor))
					{
						$bodytext1 .= '<b>Author</b>: <a href=' . DisplayEncodedEmail($CurrentVideo->EmailAuthor) . '>' . $CurrentVideo->Author . '</a><br>';
					}
					else
					{
						$bodytext1 .= '<b>Author</b>: '.$CurrentVideo->Author.'<br>';
					}
				}
				if (!is_null($CurrentVideo->Website))
					$bodytext1 .= '<b>Website</b>: <a href="' . $CurrentVideo->Website . '">'.$CurrentVideo->Website.'</a><br>';

				if ($bodytext1 !== '')
				{
					$bodytext .= $bodytext1 . '<br>';
				}

				if (!is_null($CurrentVideo->Description))
					$bodytext .= '<p><b>Description</b>:<br>' . $CurrentVideo->Description . '</p>';

				$found_a_link = false;
				if (!is_null($CurrentVideo->Link))
				{
					if (!$found_a_link)
					{
						$found_a_link = true;
						$bodytext .= '<br>';
					}
					$bodytext .= '<a href="showvideo.php?VideoID='.($SelectedVideos[$SelectedVideo]+1).'">Play this movie!</a><br>';
				}
				if (!is_null($CurrentVideo->DownloadLink))
				{
					if (!$found_a_link)
					{
						$found_a_link = true;
						$bodytext .= '<br>';
					}
					$bodytext .= '<a href="' . $CurrentVideo->DownloadLink . '">Download this movie!</a><br>';
				}
				if (!$found_a_link)
				{
					$bodytext .= '<br>';
					$bodytext .= 'No play/download link<br>';
				}

				pagePanel('community', $CurrentVideo->Name, $videotypeslist[$CurrentVideo->Type], $bodytext);
			}
		}
	}
	else
	{
		$bodytext = '<p>Please select at least one video type!</p>';
		pagePanel('alert', 'Nothing to display', '', $bodytext);
	}
}

pageDisplay('Videos', 'pageLocalDisplay');

?>
