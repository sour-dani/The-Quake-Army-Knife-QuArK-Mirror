<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_main_paths.php');
require_once('_MailSend.php');

# Load language file
LoadLanguageFile('usermaps_submit.php');

class cSubmitMap
{
	var $Name;           # Submitted map name
	var $DownloadLink;   # Download URL
	var $ScreenshotLink; # Screenshot URL
	var $WebsiteLink;    # Website URL
	var $Email;          # Email address of author
	var $Author;         # Name of author
	var $Size;           # File size in bytes
	var $Type;           # Map type
	var $Game;           # Map game
	var $Mod;            # Map mod
	var $Description;    # Map description
	var $Comments;       # Comments for webmaster

	function __construct($aName, $aDownloadLink='', $aScreenshotLink='', $aWebsiteLink='', $aEmail='', $aAuthor='', $aSize=0, $aType='', $aGame='', $aMod='', $aDescription='', $aComments='')
	{
		if (strlen($aName) == 0)
		{
			$this->Name = NULL;
		}
		else
		{
			$this->Name = $aName;
		}
		if ((strlen($aDownloadLink) == 0) or ($aDownloadLink === 'ftp://'))
		{
			$this->DownloadLink = NULL;
		}
		else
		{
			$this->DownloadLink = $aDownloadLink;
		}
		if ((strlen($aScreenshotLink) == 0) or ($aScreenshotLink === 'http://'))
		{
			$this->ScreenshotLink = NULL;
		}
		else
		{
			$this->ScreenshotLink = $aScreenshotLink;
		}
		if ((strlen($aWebsiteLink) == 0) or ($aWebsiteLink === 'http://'))
		{
			$this->WebsiteLink = NULL;
		}
		else
		{
			$this->WebsiteLink = $aWebsiteLink;
		}
		if (strlen($aEmail) == 0)
		{
			$this->Email = NULL;
		}
		else
		{
			$this->Email = $aEmail;
		}
		if (strlen($aAuthor) == 0)
		{
			$this->Author = NULL;
		}
		else
		{
			$this->Author = $aAuthor;
		}
		if (strlen($aSize) == 0)
		{
			$this->Size = NULL;
		}
		else
		{
			$this->Size = intval($aSize);
			if ($this->Size == 0)
				$this->Size = NULL;
		}
		if ((strlen($aType) == 0) or ($aType === '--Please select one--'))
		{
			$this->Type = NULL;
		}
		else
		{
			$this->Type = $aType;
		}
		if ((strlen($aGame) == 0) or ($aGame === '--Please select one--'))
		{
			$this->Game = NULL;
		}
		else
		{
			$this->Game = $aGame;
		}
		if ((strlen($aMod) == 0) or ($aMod === '--Please select one--'))
		{
			$this->Mod = NULL;
		}
		else
		{
			$this->Mod = $aMod;
		}
		if (strlen($aDescription) == 0)
		{
			$this->Description = NULL;
		}
		else
		{
			$this->Description = $aDescription;
		}
		if (strlen($aComments) == 0)
		{
			$this->Comments = NULL;
		}
		else
		{
			$this->Comments = $aComments;
		}
	}

	function Submit()
	{
		global $webmasteremail;
		$Text  =          $this->Name;           # Submitted map name
		$Text .= "\r\n" . $this->DownloadLink;   # Download URL
		$Text .= "\r\n" . $this->ScreenshotLink; # Screenshot URL
		$Text .= "\r\n" . $this->WebsiteLink;    # Website URL
		$Text .= "\r\n" . $this->Email;          # Email address of author
		$Text .= "\r\n" . $this->Author;         # Name of author
		$Text .= "\r\n" . $this->Size;           # File size in bytes
		$Text .= "\r\n" . $this->Type;           # Map type
		$Text .= "\r\n" . $this->Game;           # Map game
		$Text .= "\r\n" . $this->Mod;            # Map mod
		$Text .= "\r\n" . $this->Description;    # Map description
		$Text .= "\r\n" . $this->Comments;       # Comments for webmaster
		$Text .= "\r\n";
		$result = SendMail($webmasteremail, 'New map submission', $Text);
		if ($result !== TRUE)
		{
			#Something went wrong!
			die($result);
		}
		pageDisplay('Submit Usermap', 'pageLocalDone');
		exit;
	}
}

function pageLocalDone()
{
	pageName('Submit Usermap');

	$bodytext = "<p>Your new map has been submitted successfully!</p>\n";
	$bodytext .= "<p>It might take a few days for the webmaster to process your request. Please be patient.</p>\n";
	pagePanel('community', 'New map submission completed!', '', $bodytext);
}

$submit_map_error_email = NULL;
$submit_map_error_size = NULL;
$submit_map = NULL;
if (array_key_exists('map_name', $_POST))
{
	$submit_map = new cSubmitMap($_POST['map_name'], $_POST['map_download'], $_POST['map_screenshot'], $_POST['map_website'], $_POST['map_email'], $_POST['map_author'], $_POST['map_filesize'], $_POST['map_type'], $_POST['map_game'], $_POST['map_mod'], $_POST['map_description'], $_POST['map_comment']);
	# Simple email validation (not catch-it-all proof!)
	if (!is_null($submit_map->Email))
	{
		if (strpos($submit_map->Email, '@') === FALSE)
		{
			$submit_map->Email = NULL;
			$submit_map_error_email = 'Please enter a valid email address!';
		}
	}
	# File size validation
	if (!is_null($submit_map->Size))
	{
		if ($submit_map->Size <= 0)
		{
			$submit_map->Size = NULL;
			$submit_map_error_size = 'Please enter a valid (non-zero) filesize!';
		}
	}
	if (array_key_exists('map_verified', $_POST) and ($_POST['map_verified'] === '1'))
	{
		# Submit it!
		$submit_map->Submit();
	}
}

function CreateSubmitForm($submit_map)
{
	global $submit_map_error_email, $submit_map_error_size;
	$Verified = true;

	$submitform = '<form method="POST" action="usermaps_submit.php"><table cellpadding=0 cellspacing=1 align=center>';

	# Map name
	$submitform .= '<tr><td class="text1">Map name:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->Name))
	{
		$submitform .= '<input name="map_name" size=50>';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_name" value="'.$submit_map->Name.'">';
		$submitform .= $submit_map->Name;
	}
	$submitform .= '</td></tr>';

	# Download URL
	$submitform .= '<tr><td class="text1">Download URL:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->DownloadLink))
	{
		$submitform .= '<input name="map_download" size=50 value="ftp://">';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_download" value="'.$submit_map->DownloadLink.'">';
		$submitform .= '<a rel="noopener" target="_blank" href="'.$submit_map->DownloadLink.'">'.$submit_map->DownloadLink.'</a>';
	}
	$submitform .= '</td></tr>';

	# Screenshot URL
	$submitform .= '<tr><td class="text1">Screenshot URL:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->ScreenshotLink))
	{
		$submitform .= '<input name="map_screenshot" size=50 value="http://">';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_screenshot" value="'.$submit_map->ScreenshotLink.'">';
		$submitform .= '<a rel="noopener" target="_blank" href="'.$submit_map->ScreenshotLink.'">'.$submit_map->ScreenshotLink.'</a>';
	}
	$submitform .= '</td></tr>';

	# Website URL
	$submitform .= '<tr><td class="text1">Website URL:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->WebsiteLink))
	{
		$submitform .= '<input name="map_website" size=50 value="http://">';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_website" value="'.$submit_map->WebsiteLink.'">';
		$submitform .= '<a rel="noopener" target="_blank" href="'.$submit_map->WebsiteLink.'">'.$submit_map->WebsiteLink.'</a>';
	}
	$submitform .= '</td></tr>';

	# Email
	$submitform .= '<tr><td class="text1">E-mail:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->Email))
	{
		$submitform .= '<input name="map_email" size=50>';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_email" value="'.$submit_map->Email.'">';
		$submitform .= $submit_map->Email;
	}
	if (!is_null($submit_map_error_email))
	{
		$submitform .= '&nbsp;<span class="validationerror">'.$submit_map_error_email.'</span>';
	}
	$submitform .= '</td></tr>';

	# Author
	$submitform .= '<tr><td class="text1">Map Author:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->Author))
	{
		$submitform .= '<input name="map_author" size=50>';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_author" value="'.$submit_map->Author.'">';
		$submitform .= $submit_map->Author;
	}
	$submitform .= '</td></tr>';

	# File size
	$submitform .= '<tr><td class="text1">Filesize:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->Size))
	{
		$submitform .= '<input name="map_filesize" size=10 value="0"> Bytes';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_filesize" value="'.$submit_map->Size.'">';
		$submitform .= $submit_map->Size . ' Bytes';
	}
	if (!is_null($submit_map_error_size))
	{
		$submitform .= '&nbsp;<span class="validationerror">'.$submit_map_error_size.'</span>';
	}
	$submitform .= '</td></tr>';

	# Map type
	$submitform .= '<tr><td class="text1">Map type:</td><td>';
	//$submitform .= '<select name="map_type">';
	if (is_null($submit_map) or is_null($submit_map->Type))
	{
		$submitform .= '<select name="map_type">'; //#
		$submitform .= '<option selected>--Please select one--';
		$submitform .= '<option>Single player'; //#
		$submitform .= '<option>Cooperative'; //#
		$submitform .= '<option>Deathmatch'; //#
		$submitform .= '<option>Team Deathmatch'; //#
		$submitform .= '<option>Team Play'; //#
		$submitform .= '<option>Tourney'; //#
		$submitform .= '<option>Capture The Flag'; //#
		$submitform .= '<option>(other)'; //#
		$submitform .= '</select>';
		$Verified = false;
	}
	else
	{
		//$submitform .= '<option>--Please select one--';
		$submitform .= '<input type=hidden name="map_type" value="'.$submit_map->Type.'">'; //#
		$submitform .= $submit_map->Type; //#
	}

	# Map game
	$submitform .= '<tr><td class="text1">FPS Game:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->Game))
	{
		$submitform .= "<select name=\"map_game\">
<option selected>--Please select one--
<option>Quake 1</option>
<option>Quake 2</option>
<option>Quake 3: Arena</option>
<option>Quake 4</option>
<option>Doom 3</option>
<option>Counterstrike</option>
<option>Hexen 2</option>
<option>Heretic 2</option>
<option>Half-Life</option>
<option>Half-Life 2</option>
<option>KingPin</option>
<option>Sin</option>
<option>Soldier of Fortune</option>
<option>Star Trek Voyager: Elite Force</option>
<option>Star Trek: Elite Force 2</option>
<option>(other)
</select></td></tr>";
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_game" value="'.$submit_map->Game.'">';
		$submitform .= $submit_map->Game;
	}

	# Map mod
	$submitform .= '<tr><td class="text1">Map mod:</td><td>';
	//$submitform .= '<select name="map_mod">';
	if (is_null($submit_map) or is_null($submit_map->Mod))
	{
		$submitform .= '<select name="map_mod">';
		$submitform .= '<option selected>--Please select one--';
		$submitform .= '<option>Rocket Arena';
		$submitform .= '<option>Team Fortress (Classic)';
		$submitform .= '<option>Action (Q2/HL)';
		$submitform .= '<option>AirQuake (Q1/Q2)';
		$submitform .= '<option>GLOOM';
		$submitform .= '<option>(other)';
		$submitform .= '</select>';
		$Verified = false;
	}
	else
	{
		//$submitform .= '<option>--Please select one--';
		$submitform .= '<input type=hidden name="map_mod" value="'.$submit_map->Mod.'">'; //#
		$submitform .= $submit_map->Mod; //#
	}

	# Description
	$submitform .= '<tr><td class="text1">Description:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->Description))
	{
		$submitform .= '<textarea name="map_description" rows=10 cols=48></textarea>';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_description" value="'.$submit_map->Description.'">';
		$submitform .= nl2br($submit_map->Description);
	}
	$submitform .= '</td></tr>';

	# Comments
	$submitform .= '<tr><td class="text1">Comment to webmaster:</td><td>';
	if (is_null($submit_map) or is_null($submit_map->Comments))
	{
		$submitform .= '<textarea name="map_comment" rows=2 cols=48></textarea>';
		$Verified = false;
	}
	else
	{
		$submitform .= '<input type=hidden name="map_comment" value="'.$submit_map->Comments.'">';
		$submitform .= nl2br($submit_map->Comments);
	}
	$submitform .= '</td></tr>';

	$submitform .= "</table>
<p class=\"sml\">Make sure your email address is correct: this address will also be used if there are any problems with your submission! If you want you email to be hidden when the map is posted, please mention this in the comments.</p>";

	if ($Verified)
		$submitform .= '<input type=hidden value="1" name="map_verified">';

	$submitform .= '<div class="centered"><input type=SUBMIT value="Submit"></div></form>';

	#FIXME: Bad way...
	$submitform .= '<form method="POST" action="usermaps_submit.php"><div class="centered"><input type=SUBMIT value="Reset"></div></form>';
	return $submitform;
}

/*function mapCreateText($mapName, $mapDownload, $mapScreenshot, $mapWebsite, $mapEmail, $mapAuthor, $mapFilesize, $mapType, $mapGame, $mapDescription, $mapComment)
{
	$text = '';
	$text .= $mapName . '<br>';
	$text .= $mapDownload . '<br>';
	$text .= $mapScreenshot . '<br>';
	$text .= $mapWebsite . '<br>';
	$text .= $mapEmail . '<br>';
	$text .= $mapAuthor . '<br>';
	$text .= $mapFilesize . '<br>';
	$text .= $mapType . '<br>';
	$text .= $mapGame . '<br>';
	$text .= nl2br($mapDescription) . '<br>';
	$text .= nl2br($mapComment) . '<br>';

	return $text;
}*/

function pageLocalDisplay()
{
	pageName('Submit Usermap');

	$submitform = CreateSubmitForm(NULL);
	pagePanel('community', 'Got a new QuArK-made map?', '', $submitform);
}

function pageLocalVerify()
{
	global $submit_map;

	pageName('Please verify');

	$mappaneltext = CreateSubmitForm($submit_map);

	$map_name = $submit_map->Name;
	if ($map_name == NULL)
	{
		# No mapname yet...
		$map_name = 'Got a new QuArK-made map?';
	}

	pagePanel('community', $map_name, '', $mappaneltext);
}

if (is_null($submit_map))
{
	pageDisplay('Submit Usermap', 'pageLocalDisplay');
}
else
{
	pageDisplay('Submit Usermap', 'pageLocalVerify');
}

?>
