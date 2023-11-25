<?php
require_once("_main_paths.php");

class cTutorialList
{
	var $Description; # Description of the tutorials
	var $Tutorials;   # Array of the tutorial

	function __construct($aDescription, $aTutorials)
	{
		$this->Description = $aDescription;
		$this->Tutorials   = $aTutorials;
	}
}

class cTutorial
{
	var $Name;        # Name of the tutorial
	var $Link;        # Link to the tutorial
	var $Author;      # Author/creator of the tutorial
	var $Description; # Description of the tutorial

	function __construct($aName, $aLink, $aAuthor=NULL, $aDescription=NULL)
	{
		$this->Name        = $aName;
		$this->Link        = $aLink;
		$this->Author      = $aAuthor;
		$this->Description = $aDescription;
	}
}

global $infobaseroot, $mainroot, $forumsroot;

global $TutorialQuArK;
$TutorialQuArK = new cTutorialList("A list of tutorials about QuArK and its functions:" ,array());

#                                   Name of the tutorial-section
#                                   |        Link to the tutorial-section
#                                   |        |       Description of the tutorial-section
#                                   |        |       |
$TutorialQuArK->Tutorials[] = new cTutorial("Creating a map" ,$infobaseroot."maped.tutorial.html" ,"QuArK Development Team" ,"This tutorial will guide you through the way the QuArK map-editor works, and how you should use it.");
$TutorialQuArK->Tutorials[] = new cTutorial("Videos" ,$mainroot."videos.php?T1=1" ,NULL ,"Various video tutorials.");
$TutorialQuArK->Tutorials[] = new cTutorial("How to" ,$forumsroot."index.php?board=3.0" ,NULL ,"The <b>How to</b> section on our forums.");

#Non-official:
$TutorialQuArK->Tutorials[] = new cTutorial("Quake Army Knife editor tutorial for Quake 2" ,"https://www.moddb.com/tutorials/quark-army-knife-editor-tutorial-for-quake-2" ,NULL ,"How to use PakScape, configure the Quake Army Knife editor, saving your level and running/compiling it to a .bsp file, working with a .bsp file, opening the 3d window and navigating in 3d, editing the layout tab, WinBSP."); #By: Roarkes #Also: https://quake2-dawn-of-darkness.blogspot.com/2015/09/quark-editor-tutorial-for-quake-2.html
$TutorialQuArK->Tutorials[] = new cTutorial("Adding and editing your Quake 2 engine based game mod with the editor Quake Army Knife" ,"https://www.moddb.com/company/laika/tutorials/making-your-quake-2-engine-based-game-mod-with-the-editor-quark-army-knife", NULL, "This tutorial is made by my brother and me for those who want to understand better how to use the editor Quake Army Knife and modify her/his or an existing game mod."); #By: Roarkes
#FIXME: More?: https://www.moddb.com/company/laika/tutorials
#FIXME: https://quake2-dawn-of-darkness.blogspot.com/2018/06/lets-make-sky-skybox-with-skypaint-and.html ?
$TutorialQuArK->Tutorials[] = new cTutorial("Worldcraft to QuArK - Making the change" ,"https://web.archive.org/web/20050523114750/http://scind.8m.com/Edit/wc2quark.html", NULL); #Muffinator (mailto:muffinator@netzero.net)
$TutorialQuArK->Tutorials[] = new cTutorial("Become a level designer. Create your own map for True Combat." ,"https://www.tcmapping.com/", NULL, NULL); #By: friant (https://quark.sourceforge.io/forums/index.php?action=profile;u=1455)

global $TutorialOther;
$TutorialOther = new cTutorialList("A list of tutorials about mapping and modelling in general:" ,array());
#                                   Name of the tutorial-section
#                                   |        Link to the tutorial-section
#                                   |        |       Description of the tutorial-section
#                                   |        |       |
$TutorialOther->Tutorials[] = new cTutorial("PlanetDoom Tutorials" ,"https://web.archive.org/web/20140412061702/http://planetdoom.gamespy.com/View.php?view=Tutorials.List" ,NULL ,"\"Need some help with that map you're making? Not sure how to make that Cacodemon appear out of no where and scare the crap out of everyone? well this is the place to learn all the in's and out's of mapping.\""); #http://planetdoom.gamespy.com/View.php?view=Tutorials.List
$TutorialOther->Tutorials[] = new cTutorial("Frogbot Tutorials" ,"https://web.archive.org/web/20120213074253/http://botepidemic.no-origin.net/fmods/tutorials.htm" ,NULL ,"Various Quake 1 tutorials. (Original site down; this is a mirror site.)");
$TutorialOther->Tutorials[] = new cTutorial("Inside3D - QuakeC Tutorials" ,"https://web.archive.org/web/20140701225500/http://www.inside3d.com/tutorials.php" ,NULL ,NULL); #http://www.inside3d.com/tutorials.php
$TutorialOther->Tutorials[] = new cTutorial("quake2.com Tutorials" ,"http://www.quake2.com/dll/tutorials/index.html" ,NULL ,"Some Quake 2 DLL tutorials.");
$TutorialOther->Tutorials[] = new cTutorial("Tiporium Quake Mapping Tutorials" ,"https://www.quakewiki.net/archives/tiporium/tutorials.htm" ,NULL ,"Here you will find all kinds of tutorials, from making maps, to finding drivers, to diagnosing problems, and much more."); #http://tiporium.planetquake.gamespy.com/tutorials.htm
$TutorialOther->Tutorials[] = new cTutorial("HL2World Knowledge Base - Source Tutorials" ,"https://web.archive.org/web/20090718104730/http://www.hl2world.com/wiki/index.php/HL2World_Knowledge_Base" ,NULL ,"Here you will find a number of tutorials to help you create original content for Source Engine based games."); #http://www.hl2world.com/wiki/index.php/HL2World_Knowledge_Base#Source_Tutorials
$TutorialOther->Tutorials[] = new cTutorial("69th Vlatitude Tutorials" ,"https://web.archive.org/web/20090417185420/http://www.vlatitude.com:80/tutorials.php" ,NULL ,NULL); #http://www.vlatitude.com/tutorials.php
$TutorialOther->Tutorials[] = new cTutorial("D-Day Dev Central Tutorials" ,"https://web.archive.org/web/20160916070009/http://www.ddaydev.com/site/docs.php?go=tutorials" ,NULL ,NULL); #http://www.ddaydev.com/site/docs.php?go=tutorials
$TutorialOther->Tutorials[] = new cTutorial("How to make a Video Game" ,"http://stormthecastle.com/mainpages/videogametutorial/tutorial_videogame1.htm" ,NULL ,"This tutorial shows you how to make your own video game for absolutely free.");
$TutorialOther->Tutorials[] = new cTutorial("The Archive Tutorials" ,"https://web.archive.org/web/20130831115026/http://editingarchive.com/viewsection.php?section=Half-Life-Tutorials&topic=Mapping" ,NULL ,NULL); #http://editingarchive.com/viewsection.php?section=Half-Life-Tutorials&amp;topic=Mapping
$TutorialOther->Tutorials[] = new cTutorial("All Games Depot Tutorials" ,"https://web.archive.org/web/20011224081620/http://www.allgamesdepot.com/tutorials.asp" ,NULL ,NULL);

?>
