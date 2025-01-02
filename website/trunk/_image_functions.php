<?php
require_once('_main_paths.php');
require_once('_image-database.php');
//require_once('_company-database.php');
//require_once('_engine-database.php');
//require_once('_game-database.php');

class cImage
{
	var $FileName; # Filename of the image
	var $Alt;      # Alt text for the image
	var $Width;    # Width of the image
	var $Height;   # Height of the image
	var $Extra;    # Extra image args

	function __construct($aFileName, $aAlt, $aWidth, $aHeight, $aExtra=null)
	{
		$this->FileName = $aFileName;
		$this->Alt = $aAlt;
		$this->Width = $aWidth;
		$this->Height = $aHeight;
		$this->Extra = $aExtra;
	}
}

function DisplayRawImage($imgobj, $imgwidth=null, $imgheight=null, $imgextra=null, $imgalt=null)
{
	if (is_null($imgobj))
	{
		trigger_error('Trying to display a NULL image!', E_USER_WARNING);
		return '';
	}

	$bodytext = '<img src="'.$imgobj->FileName.'"';
	$bodytext .= ' width="'.(is_null($imgwidth) ? $imgobj->Width : $imgwidth).'"';
	$bodytext .= ' height="'.(is_null($imgheight) ? $imgobj->Height : $imgheight).'"';
	$bodytext .= ' alt="'.(is_null($imgalt) ? $imgobj->Alt : $imgalt).'"';
	$bodytext .= (is_null($imgextra) ? (is_null($imgobj->Extra) ? '' : ' '.$imgobj->Extra) : ' '.$imgextra);
	$bodytext .= '>';

	return $bodytext;
}

function DisplayImage($imgname, $imgwidth=null, $imgheight=null, $imgextra=null, $imgalt=null)
{
	require_once('_theme-database.php');
	global $imgs;
	global $CurrentTheme;
	global $Themes;

	if (array_key_exists($imgname, $Themes[$CurrentTheme]->ImageArray))
		$currentimage = &$Themes[$CurrentTheme]->ImageArray[$imgname];
	else
	{
		if (array_key_exists($imgname, $imgs))
			$currentimage = &$imgs[$imgname];
		else
		{
			trigger_error('Unable to find '.$imgname.' in imgs array!', E_USER_WARNING);
			return '';
		}
	}
	return DisplayRawImage($currentimage, $imgwidth, $imgheight, $imgextra, $imgalt);
}

function DisplayCompanyIcon($Company, $link=null, $imgwidth=null, $imgheight=null)
{
	global $Companies;
	global $picsroot;

	if (!array_key_exists($Company, $Companies))
	{
		trigger_error('Unable to find '.$Company.' in Companies array!', E_USER_WARNING);
		return '';
	}

	$CurrentCompany = &$Companies[$Company];
	if (is_null($link))
		$link = 'company.php#'.$CurrentCompany->ID;
	if (is_null($CurrentCompany->Logo))
		$Logo = $picsroot.'icons/unknown.gif';
	else
		$Logo = $CurrentCompany->Logo;
	if (is_null($link)) //Should never happen... See above.
	{
		$bodytext = '<img class="icon" src="'.$Logo.'" width="'.(is_null($imgwidth) ? '16' : $imgwidth).'" height="'.(is_null($imgheight) ? '16' : $imgheight).'" alt="'.$CurrentCompany->Name.'">';
	}
	else
	{
		$bodytext = '<a href="'.$link.'"><img class="icon" src="'.$Logo.'" width="'.(is_null($imgwidth) ? '16' : $imgwidth).'" height="'.(is_null($imgheight) ? '16' : $imgheight).'" alt="'.$CurrentCompany->Name.'"></a>';
	}
	return $bodytext;
}

function DisplayEngineIcon($Engine, $link=null, $imgwidth=null, $imgheight=null)
{
	global $Engines;
	global $picsroot;

	if (!array_key_exists($Engine, $Engines))
	{
		trigger_error('Unable to find '.$Engine.' in Engines array!', E_USER_WARNING);
		return '';
	}

	$CurrentEngine = &$Engines[$Engine];
	if (is_null($link))
		$link = 'engine.php#'.$CurrentEngine->ID;
	if (is_null($CurrentEngine->Logo))
		$Logo = $picsroot.'icons/unknown.gif';
	else
		$Logo = $CurrentEngine->Logo;
	if (is_null($link)) //Should never happen... See above.
	{
		$bodytext = '<img class="icon" src="'.$Logo.'" width="'.(is_null($imgwidth) ? '16' : $imgwidth).'" height="'.(is_null($imgheight) ? '16' : $imgheight).'" alt="'.$CurrentEngine->Name.'">';
	}
	else
	{
		$bodytext = '<a href="'.$link.'"><img class="icon" src="'.$Logo.'" width="'.(is_null($imgwidth) ? '16' : $imgwidth).'" height="'.(is_null($imgheight) ? '16' : $imgheight).'" alt="'.$CurrentEngine->Name.'"></a>';
	}
	return $bodytext;
}

function DisplayGameIcon($Game, $link=null, $imgwidth=null, $imgheight=null)
{
	global $Games;
	global $picsroot;

	if (!array_key_exists($Game, $Games))
	{
		trigger_error('Unable to find '.$Game.' in Games array!', E_USER_WARNING);
		return '';
	}

	$CurrentGame = &$Games[$Game];
	if (is_null($link))
		$link = 'games.php'.getGamesQuery($CurrentGame->GameID).'#'.$CurrentGame->GameID;
	if (is_null($CurrentGame->Icon))
		$Icon = $picsroot.'icons/unknown.gif';
	else
		$Icon = $CurrentGame->Icon;
	if (is_null($link)) //Should never happen... See above.
	{
		$bodytext = '<img class="icon" src="'.$Icon.'" width="'.(is_null($imgwidth) ? '16' : $imgwidth).'" height="'.(is_null($imgheight) ? '16' : $imgheight).'" alt="'.$CurrentGame->GameTitle.'">';
	}
	else
	{
		$bodytext = '<a href="'.$link.'"><img class="icon" src="'.$Icon.'" width="'.(is_null($imgwidth) ? '16' : $imgwidth).'" height="'.(is_null($imgheight) ? '16' : $imgheight).'" alt="'.$CurrentGame->GameTitle.'"></a>';
	}
	return $bodytext;
}

?>
