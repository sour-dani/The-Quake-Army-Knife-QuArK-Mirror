<?php
require_once('_image_functions.php');

class cAward
{
	var $Name; # Name of the award
	var $Org;  # Organisation that gave out the award
	var $Pic;  # Picture of the award (if any)
	var $Date; # When was the award won?
	var $URL;  # An URL (if any) to the award

	function __construct($aName, $aOrg, $aPic=NULL, $aDate=0, $aURL=NULL)
	{
		global $picsroot;

		$this->Name = $aName;
		$this->Org = $aOrg;
		$this->Pic = $aPic;
		$this->Date = $aDate;
		$this->URL = $aURL;
	}
}

class cAchievement
{
	var $Description; # What was achieved?
	var $Author;      # How made the achievement?
	var $Date;        # When was it achieved?
	var $URL;         # An URL (if any)

	function __construct($aDescription, $aAuthor, $aDate=0, $aURL=NULL)
	{
		$this->Description = $aDescription;
		$this->Author = $aAuthor;
		$this->Date = $aDate;
		$this->URL = $aURL;
	}
}

global $Awards;
$Awards = array();

$Awards[] = new cAward('Users Love Us', 'SourceForge', new cImage('https://sourceforge.net/cdn/syndication/badge_img/1181/oss-users-love-us-white', 'Users Love Us', '200', '200'), mktime(0, 5, 0, 3, 2, 2022));
#$Awards[] = new cAward('Rising Star', 'SourceForge', new cImage('https://sourceforge.net/cdn/syndication/badge_img/1181/oss-rising-star', 'Rising Star', '200', '200'), 0);
$Awards[] = new cAward('Community Choice', 'SourceForge', new cImage('https://sourceforge.net/cdn/syndication/badge_img/1181/oss-community-choice-white', 'Community Choice', '200', '200'), mktime(0, 5, 0, 3, 2, 2022));
$Awards[] = new cAward('SourceForge Favorite', 'SourceForge', new cImage('https://sourceforge.net/cdn/syndication/badge_img/1181/oss-sf-favorite-white', 'SourceForge Favorite', '200', '200'), mktime(0, 5, 0, 3, 2, 2022));
$Awards[] = new cAward('Community Leader', 'SourceForge', new cImage('https://sourceforge.net/cdn/syndication/badge_img/1181/oss-community-leader-white', 'Community Leader', '200', '200'), mktime(0, 5, 0, 3, 2, 2022));
$Awards[] = new cAward('Open Source Excellence', 'SourceForge', new cImage('https://sourceforge.net/cdn/syndication/badge_img/1181/oss-open-source-excellence-white', 'Open Source Excellence', '200', '200'), mktime(0, 5, 0, 3, 2, 2022));
$Awards[] = new cAward('100% FREE', 'Softpedia', new cImage($picsroot.'sp100free.png', 'Softpedia 100% FREE award', '155', '140'), mktime(0, 0, 0, 5, 3, 2011), 'https://www.softpedia.com/progClean/QuArK-Clean-69506.html'); //softpedia_free_award_f.gif 170x116
$Awards[] = new cAward('Virus Free', 'Software Informer', new cImage($picsroot.'si-award-clean.png', 'Software Informer Virus Free award', '170', '170'), 0, 'https://quark2.software.informer.com/');
$Awards[] = new cAward('3 Stars - Limited Functionality', 'CodeWeavers', NULL, 0, 'https://www.codeweavers.com/compatibility/crossover/quark-quake-army-knife');
$Awards[] = new cAward('Silver Rating', 'Wine', NULL, mktime(0, 0, 0, 3, 16, 2019), 'https://appdb.winehq.org/objectManager.php?sClass=application&iId=1532');

global $Achievements;
$Achievements = array();
$Achievements[] = new cAchievement('QuArK is installed by default on Windows computer at Stony Brook University.', 'Department of Computer Science, Stony Brook University', mktime(0, 0, 0, 12, 1, 2014), 'https://www.cs.stonybrook.edu/about-us/csintranet/faqs/software_install'); #Date is the oldest available in the Internet Archive
$Achievements[] = new cAchievement('QuArK was used in scientific research into hippocampal place cells in mice, as published in "Intracellular dynamics of hippocampal place cells during virtual navigation".', 'Christopher D. Harvey, Forrest Collman, Daniel A. Dombeck, and David W. Tank', mktime(0, 0, 0, 10, 15, 2009), 'https://www.ncbi.nlm.nih.gov/pmc/articles/PMC2771429');
$Achievements[] = new cAchievement('QuArK is used in combination with the Torque Game Engine to teach students 3D video game editing in the ICT62 course at the Fontys school in the Netherlands.', 'Rudi Vereijken, Rob van Cooten', mktime(0, 0, 0, 6, 20, 2008)); #https://web.archive.org/web/2009*/http://ehv-srvhost-fe.fontys.nl/imd/files/ICT62/diversen/learninggames_01_02.pdf
$Achievements[] = new cAchievement('QuArK is the most popular tool to access WAD files, as is published in the book titled "Video Game Design Revealed".', 'Guy W. Lecky-Thompson', mktime(0, 0, 0, 1 /*Unknown month*/, 1 /*Unknown day*/, 2008));
$Achievements[] = new cAchievement('QuArK was used in scientific research into computational cognitive models, as published in "Learning Plan Networks in Conversational Video Games".', 'Jeffrey David Orkin', mktime(0, 0, 0, 8, 13, 2007), 'https://www.media.mit.edu/cogmac/publications/orkin_mastersthesis_2007.pdf');
$Achievements[] = new cAchievement('QuArK is mentioned as one of the two most popular editors for Quake II, in a published paper titled "Generating 3D Multiplayer Game Maps from 2D Architectural Plans".', 'Ewan Summers, Kristoffer Getchell, Alan Miller, Colin Allison', mktime(0, 0, 0, 1 /*Unknown month*/, 1 /*Unknown day*/, 2007), 'https://www.researchgate.net/profile/Alan-Miller-7/publication/253569354_Generating_3D_Multiplayer_Game_Maps_from_2D_Architectural_Plans/links/00b7d52ff7f2e831a1000000/Generating-3D-Multiplayer-Game-Maps-from-2D-Architectural-Plans.pdf'); #https://www.researchgate.net/profile/Alan_Miller5/publication/253569354_Generating_3D_Multiplayer_Game_Maps_from_2D_Architectural_Plans/links/00b7d52ff7f2e831a1000000/Generating-3D-Multiplayer-Game-Maps-from-2D-Architectural-Plans.pdf
$Achievements[] = new cAchievement('QuArK is stated to probably be the second most popular tool for level editing for Half-Life, in a paper called "Modding Scenes - Introduction to user-created content in computer gaming".', 'Tero Laukkanen', mktime(0, 0, 0, 10, 1 /*Unknown day*/, 2005), 'https://trepo.tuni.fi/bitstream/handle/10024/65431/951-44-6448-6.pdf');
$Achievements[] = new cAchievement('QuArK is mentioned as a much used editor for Quake II, as published in the paper called "Quake II as a Robotic and Multi-Agent Platform".', 'Chris Brown, Peter Barnum, Dave Costello, George Ferguson, Bo Hu, Mike Van Wie.', mktime(0, 0, 0, 11, 1 /*Unknown day*/, 2004), 'https://www.cs.rochester.edu/u/ferguson/papers/brown-et-al-quagents-tr853.pdf');
$Achievements[] = new cAchievement('QuArK is used to teach game programming enthousiasts the basics of map editing, as can be seen in the book titled "3D Game Programming All in One".', 'Kenneth C. Finney', mktime(0, 0, 0, 4, 19, 2004));
$Achievements[] = new cAchievement('QuArK is called one of the three most notable level editors for Quake, in "Game Developer Magazine"\'s Front Line Awards.', 'Simon Westlake, Mark Deloura', mktime(0, 0, 0, 1, 1 /*Unknown day*/, 2001), 'https://archive.org/details/GDM_January_2001/');

#Find more?: https://scholar.google.com/scholar?hl=en&as_sdt=0%2C5&q=%22QuArK%22+gamespy&btnG=

?>
