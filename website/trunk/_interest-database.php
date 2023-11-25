<?php
require_once('_main_paths.php');

class cInterest
{
	var $Name;    # Name of the website
	var $Link;    # Link to the website
	var $Image;   # Image to be displayed
	var $Width;   # Width of the image
	var $Height;  # Height of the image

	function __construct($aName, $aLink, $aImage, $aWidth, $aHeight)
	{
		$this->Name  = $aName;
		$this->Link  = $aLink;
		$this->Image = $aImage;
		$this->Width = $aWidth;
		$this->Height = $aHeight;
	}
}

global $picsroot;

global $Interest;
$Interest = array();
$Interest[] = new cInterest('Download The Quake Army Knife (QuArK)' ,'https://sourceforge.net/projects/quark/' ,'https://sourceforge.net/sflogo.php?type=13&amp;group_id=1181' ,'120' ,'30'); #$picsroot.'smlbanners/sourceforge.gif' #DanielPharos: Fixed SourceForge's mistake with the ampersand.
#$Interest[] = new cInterest('PlanetQuake' ,'http://planetquake.gamespy.com/' ,$picsroot.'smlbanners/planetquake.gif' ,'88' ,'31'); # http://www.planetquake.com/
#$Interest[] = new cInterest('Quake Files' ,'http://quake4.filefront.com/' ,$picsroot.'smlbanners/quakefiles.gif' ,'88' ,'31');
#$Interest[] = new cInterest('Quakesource.org' ,'http://www.quakesrc.org/' ,$picsroot.'smlbanners/quakesrc.gif' ,'88' ,'31'); #Quake Standards Group
#$Interest[] = new cInterest('Rust / Gamedesign.net' ,'http://www.gamedesign.net/' ,$picsroot.'smlbanners/rust.gif' ,'88' ,'31');
$Interest[] = new cInterest('id Software' ,'https://www.idsoftware.com/' ,$picsroot.'smlbanners/idsoftware.gif' ,'88' ,'31');
#$Interest[] = new cInterest('eGroups' ,'http://www.egroups.com/messages/quark' ,$picsroot.'smlbanners/egroups.gif' ,'88' ,'31');
#$Interest[] = new cInterest('Bluesnews' ,'http://www.bluesnews.com/' ,$picsroot.'smlbanners/bluesnews.gif' ,'88' ,'31');
#$Interest[] = new cInterest('Games Modding.com' ,'http://www.gamesmodding.com/' ,$picsroot.'smlbanners/GamesModdingLogo.gif' ,'88' ,'31');

?>
