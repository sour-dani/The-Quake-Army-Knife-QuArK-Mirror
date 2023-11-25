<?php
require_once('_main_paths.php');

class cApplication
{
	var $ApplTitle;    # Title (gets linked)
	var $VersionID;    # Version-ID

	var $Color;        #
	var $IsFinal;      # A final version of some branch/edition
	var $IsSuperseded; # Is this release still relevant?
	var $AlwaysHidden; # Are people allowed to see (and thus download) this application?

	var $LicenseText;  # License
	var $ReleaseDate;  # Release date of this app version
	var $ReleaseNotes; # Release notes of this app version

	var $DownloadURL;  # Array of download links

	var $Comments;     # Array with additional comments

	function __construct($aApplTitle, $aVersionID,
	                     $aColor, $aIsFinal, $aIsSuperseded, $aAlwaysHidden,
	                     $aLicenseText, $aReleaseDate, $aReleaseNotes,
	                     $aDownloadURL=NULL,
	                     $aComments=NULL
)
	{
		$this->ApplTitle    = $aApplTitle;
		$this->VersionID    = $aVersionID;

		$this->Color        = $aColor;
		$this->IsFinal      = $aIsFinal;
		$this->IsSuperseded = $aIsSuperseded;
		$this->AlwaysHidden = $aAlwaysHidden;

		$this->LicenseText  = $aLicenseText;
		$this->ReleaseDate  = $aReleaseDate;
		$this->ReleaseNotes = $aReleaseNotes;

		$this->DownloadURL  = $aDownloadURL;

		$this->Comments     = $aComments;
	}
}

#Some strings that we're going to use multiple times
global $mainroot;
$DependencyDevILVC2005 = 'Includes the DevIL image library, and that needs the Microsoft Visual C++ 2005 runtime files. If needed, please use the <a href="'.$mainroot.'download.php#dependencies">QuArK dependencies installer</a>, or download and install it from here: <a rel="noopener" target="_blank" href="https://www.microsoft.com/en-us/download/details.aspx?id=26347">Microsoft Visual C++ 2005 Service Pack 1 Redistributable Package</a>, or switch to another image handling library in QuArK.';
$DependencyDirectX = 'DirectX (Direct3D) renderer requires an up-to-date DirectX9.0c install. If needed, please use the <a href="'.$mainroot.'download.php#dependencies">QuArK dependencies installer</a>, or download and install it from here: <a rel="noopener" target="_blank" href="https://www.microsoft.com/en-us/download/details.aspx?id=35">DirectX End-User Runtime Web Installer</a>';
$DependencyHLLibVC2010 = 'Includes the HLLib library, and that needs the Microsoft Visual C++ 2010 runtime files. If needed, please use the <a href="'.$mainroot.'download.php#dependencies">QuArK dependencies installer</a>, or download and install it from here: <a rel="noopener" target="_blank" href="https://www.microsoft.com/en-us/download/details.aspx?id=26999">Microsoft Visual C++ 2010 Service Pack 1 Redistributable Package</a>';
$DependencyPython15 = 'Requires Python 1.5.x: see <a href="#python">here</a>';
$PatchAvailable = 'Patch available: <a href="#patches">here</a>';
$OnlyPartialMOHAA = 'Medal of Honor: Allied Assault (MOHAA) map-editing does not support features like advanced Level-Of-Detail terrain-facility, and loading/saving of maps using these features might not work properly.';

global $downloadroot;

global $RecommendedApplication;
$RecommendedApplication = '660';

##
## -- Applications --
##
global $Applications;
$Applications = array();

$Applications[] = new cApplication('QuakeMap 1.0', '10', '#308030', False, True, False,
                                   'Freeware', 0, NULL
                                  );
$Applications[] = new cApplication('QuakeMap 1.1', '11', '#308030', True, True, False,
                                   'Freeware', 0, NULL
                                  );
#One of the QuakeMap 1.x releases: 1996-08-16 or 1996-08-15
#FIXME: Were there other 1.x releases?

$Applications[] = new cApplication('QuakeMap 2.0 BETA first release', '20b1', '#308030', False, True, False,
                                   'Freeware', mktime(0, 0, 0, 9, 20, 1996), NULL
                                  );
$Applications[] = new cApplication('QuakeMap 2.0 BETA second release', '20b2', '#308030', False, True, False,
                                   'Freeware', mktime(0, 0, 0, 9, 25, 1996), NULL
                                  );
$Applications[] = new cApplication('QuakeMap 2.0 BETA third release', '20b3', '#308030', False, True, False,
                                   'Freeware', mktime(0, 0, 0, 10, 1, 1996), NULL
                                  );
$Applications[] = new cApplication('QuakeMap 2.0 BETA forth release', '20b4', '#308030', False, True, False,
                                   'Freeware', mktime(0, 0, 0, 10, 7, 1996), NULL,
                                   array($downloadroot.'oldies/qmap20b4.zip')
                                  );
$Applications[] = new cApplication('QuakeMap 2.0', '20', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 10, 19, 1996), NULL,
                                   array($downloadroot.'oldies/qmap20.zip')
                                  );
$Applications[] = new cApplication('QuakeMap 2.1', '21', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 10, 28, 1996), NULL,
                                   array($downloadroot.'oldies/qmap21.zip')
                                  );
$Applications[] = new cApplication('QuakeMap 2.2', '22', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 11, 4, 1996), NULL
                                  );
$Applications[] = new cApplication('QuakeMap 2.3', '23', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 11, 11, 1996), NULL,
                                   array($downloadroot.'oldies/qmap23.zip')
                                  );
$Applications[] = new cApplication('QuakeMap 2.4', '24', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 11, 20, 1996), NULL
                                  );
$Applications[] = new cApplication('QuakeMap 2.5', '25', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 12, 3, 1996), NULL
                                  );
$Applications[] = new cApplication('QuakeMap 2.51', '251', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 12, 9, 1996), NULL
                                  );
$Applications[] = new cApplication('QuakeMap 2.6', '26', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 12, 19, 1996), NULL,
                                   array($downloadroot.'oldies/qmap26.zip')
                                  );
$Applications[] = new cApplication('QuakeMap 2.7', '27', '#308030', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 1, 7, 1997), NULL,
                                   array($downloadroot.'oldies/qmap27.zip')
                                  );
$Applications[] = new cApplication('QuakeMap 2.8', '28', '#308030', True, True, False,
                                   'Shareware', mktime(0, 0, 0, 1, 29, 1997), NULL,
                                   array($downloadroot.'oldies/qmap28.zip')
                                  );

#Are there more QuakeMap 2.x?

#QuakeMap 3.0b : 21-2-1997 http://muri.tri6.net/quake/199702.html

//*** Version 3.beta ***
//Release : 13.3.97.

//*** Version 3.beta 2 ***

//*** Version 3.beta 3 ***

//QuakeMap 3.beta4
//QuakeMap 2.0 - QuArK is based on QuakeMap 3.beta4 -

$Applications[] = new cApplication('QuArK 3.0', '30', '#40A040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 4, 1, 1997), NULL,
                                   array($downloadroot.'oldies/quark30.zip')
                                  );

//April 25, 1997 bluesnews.com
//New QuArK Beta with Open GL Texture View
//Armin Rigo has released version 3.1b of QuArK (formerly QuakeMap). 3.1b. It includes a true 3D textured view done with the OpenGL graphics library. Details can be found at the Official QuArK Homepage.


//QuArK 3.1: before May 13th 1997...


//QuArK 3.61 - July 17   1997    Newest Version 3.61p - July 18th / 97 (<-- patch included!)
//QuArK 3.7 released on July 22   1997 (https://web.archive.org/web/20000305204425/http://planetquake.com/quark/armin/news.htm)
$Applications[] = new cApplication('QuArK 3.2', '32', '#40A040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 6, 2, 1997), NULL,
                                   array($downloadroot.'oldies/quark32.zip')
                                  );
$Applications[] = new cApplication('QuArK 3.21', '321', '#40A040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 6, 5, 1997), NULL,
                                   NULL //ftp://ftp.cdrom.com/pub/idgames2/planetquake/quark/quark321.zip
                                  );
$Applications[] = new cApplication('QuArK 3.3', '33', '#40A040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 6, 9, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );
$Applications[] = new cApplication('QuArK 3.4', '34', '#40A040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 6, 17, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );
$Applications[] = new cApplication('QuArK 3.5', '35', '#40A040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 7, 1, 1997), NULL,
                                   array($downloadroot.'oldies/quark35.zip')
                                  );
$Applications[] = new cApplication('QuArK 3.6', '36', '#40A040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 7, 14, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );
$Applications[] = new cApplication('QuArK 3.61', '361', '#40A040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 7, 17, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );
$Applications[] = new cApplication('QuArK 3.7', '37', '#40A040', True, True, False,
                                   'Shareware', mktime(0, 0, 0, 7, 22, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );

//https://www.quaddicted.com/webarchive/www.planetfortress.com/coolguy/august.html
//Sunday, August 17, 1997
//QuArK 3.8 was released a few days ago. For you map makers out there you should give it a try


//https://www.quakewiki.net/archives/legacy/edit/main.shtml
//QuArK 3.91 Available	Update by:plucky
//QuArK (The Quake Army Knife) has a new version available
//Download 3.91 via cdrom.com
//Download 3.91 via http.
//?!? ?!? ?!?


//http://muri.tri6.net/quake/199709.html
//8/21 1997: v3.9
//1997/9/22
//The Official QuArK HomePage> - QuArk 3.91
//The Official QuArK HomePage - QuArK 3.21 6/9 1997 (SO not fully accurate!)

//Bluesnews: Thursday, September 25, 1997
//Version 3.92 of QuArK (666 KB-eeek!), the Quake editor also known as the Quake Army Knife (handy for when you forget your corkscrew), has been released on the QuArK page. New features include the ability to resize several polyhedrons at once, improved error logging, the ability to manually change the coordinates of a single vertex, and some bug fixes.


#---- What were new in QuArK 3.92 (September 25th) ----


$Applications[] = new cApplication('QuArK 4.0', '40', '#40B040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 10, 1, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );
//QuArK 4.01 was never officially released.
$Applications[] = new cApplication('QuArK 4.02', '402', '#40B040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 10, 13, 1997), NULL, //Bluesnews.com
                                   NULL //FIXME: Missing!
                                  );
$Applications[] = new cApplication('QuArK 4.03', '403', '#40B040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 10, 28, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );
$Applications[] = new cApplication('QuArK 4.04', '404', '#40B040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 11, 24, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );
$Applications[] = new cApplication('QuArK 4.05', '405', '#40B040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 12, 1, 1997), NULL,
                                   NULL #FIXME: http://www.cdrom.com/pub/idgames2/planetquake/quark/quark405.zip
                                  );
$Applications[] = new cApplication('QuArK 4.06', '406', '#40B040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 12, 15, 1997), NULL,
                                   NULL //FIXME: Missing!
                                  );
$Applications[] = new cApplication('QuArK 4.07', '407', '#40B040', True, True, False,
                                   'Shareware', mktime(0, 0, 0, 1, 5, 1998), NULL,
                                   array('http://cd.textfiles.com/pcgamesexe/pcge199804/QUAKE2/QUARK407.EXE', 'http://www.quaddicted.com/files/tools/quark407.zip') //'http://dl.fileplanet.com/dl/dl.asp?quark/releases/quark407.zip', 'http://www.atomicgamer.com/files/19445/quark407-zip'
                                  );


//Monday, March 16, 1998 
//Quark 5 is out and kicks ass! 
//Well This is semi-old news but Quark 5a1 is out now. It's incredibly cool.

//QuArK 5 5.0.a1 10 march 1998 (http://muri.tri6.net/quake/199803.html)
#Armin's Old Files: March 8th - QuArK 5.0.a1 released

//Thursday, March 19, 1998       muri: 3/20 1998
//Quark 5.02a is Out! 
//The newest version of my all-time favorite editor (now with tons of incredibly sleek and helpful additions), has been released. All of you must follow this link like lemmings and download it. 


//April 17th - QuArK 5.0.a3


#April 19th - First beta version !

#April 27th - Beta 2

#May 9th - Beta 3

#May 26th - Beta 4

#Jun 10th - Beta 5

#Jun 24th - Beta 6

#Jun 28th - Beta 7
#July 10th - Beta 8

#July 27th - Beta 9


//Tuesday, June 23, 1998         How to be Annoying: Insist on giving weather forecasts in public. Claim to be AMS certified. 
//Quark 5b6?[ 4:13 PM ] 
//Saw on Quark's homepage that Quark 5 beta 6 may be out today. As well Armin has released much faster version of Quake/Q2 compiling tools for use with Quark 5. Check Quark's homepage for details. 

//Wednesday, June 24, 1998
//Quark 5 b6 Released 
//Hobble on over to Quark's little 'ole page and get yerself a smokin hot copy! Don't sniff the ink though, that can be hazardous to your health. Check out these new features! 
//BSP editing ! You can even display the BSP in the 3D view and select and view the faces with their textures. You cannot edit the textures yet but it will be done soon (I hope) ! 
//Can load more of QuArK 4.07's .qme files. In particular, old maps with Duplicators, Diggers, and Hollow Makers can be loaded in version 5 now. 
//New TCs supported : Xatrix and TeamFortress. Thanks Akuma and Brian Wagener, respectively. Also, TC support in QuArK is now completely done. See the Games menu, Output Directories. 
//Other numerous minor and some major changes.... 
//I added a memory leak sniffer (it will be removed in the non-beta versions) so when you leave QuArK you might get a message telling you some memory has not been correctly freed. If so, please send me the file DATADUMP.TXT that //QuArK writes. 
//Tons of bugs fixes..... 

//Monday, June 29, 1998 - New QuArK  [2:34 PM EDT] - Beta 5.0.b7 of QuArK, the Quake Army Knife all-purposed editing tool is now available. Thanks Charles Benton. //Blue's News
//Friday, July 10, 1998 - New QuArK Beta  [9:10 PM EDT] - Beta 5.0.b8 of QuArK, the mult-purpose editing tool for Quake/Quake II/Hexen II is up on The Official Quake Army Knife Homepage. Thanks Fist.   Blue's News
//Monday, July 27, 1998 - New QuArK  [7:11 PM EDT] - The Official Quake Army Knife Homepage has posted version 5.0.b9 of QuArK. Thanks Prophet. //Blue's News              //muri: 7/30
//Friday, September 18, 1998 - New Quark  [9:38 PM EDT] - Version 5.0.c3 of the QuArK level editor for Quake, Quake II, etc., is up on The Official Quake Army Knife Homepage. Thanks Ian "smegHEAD" Marks of the Multi-Arena Headquarters. //Blue's News
//Saturday, October 10, 1998 - New QuArK  [9:52 AM EDT] - The Official Quake Army Knife Homepage has version 5.0.c4 of the QuArK all-purpose Quake-engine level editing program. The updated release offers many new features, including a plug-in system to create add-on modules for the program. //Blue's News

//Monday, November 16, 1998     https://www.quaddicted.com/webarchive/www.planetfortress.com/coolguy/oldnews.html Quark 5.1, the bestest map-editor available is out now. Get it at its homepage

//Monday, May 11, 1998 
//Quark 5.3b released 
//The newest, latest, greatest, multi-slicing, pasta-making, meat tenderizing version of Quark has been released. You must get this my followers! 

$Applications[] = new cApplication('QuArK 5.1', '51', '#40C040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 11, 16, 1998), NULL, //Date from QuArK news
                                   NULL, //FIXME: Missing!
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.1b', '51b', '#40C040', False, True, True,
                                   'Shareware', mktime(0, 0, 0, 11, 19, 1998), NULL, //Date from QuArK news
                                   NULL, //FIXME: Missing!
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.2', '52', '#40C040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 11, 27, 1998), NULL, //Date from QuArK news
                                   NULL, //FIXME: Missing!
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.2b', '52b', '#40C040', False, True, True,
                                   'Shareware', mktime(0, 0, 0, 12, 5, 1998), NULL, //Date from QuArK news
                                   NULL, #FIXME: https://web.archive.org/web/19990220132704/http://asp.planetquake.com/dl/dl.asp?quark/qk52b.ZIP
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.3', '53', '#40C040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 12, 28, 1998), NULL, //Date from QuArK news
                                   NULL, //FIXME: Missing!
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.3b', '53b', '#40C040', False, True, True,
                                   'Shareware', mktime(0, 0, 0, 12, 31, 1998), NULL, //Date from QuArK news
                                   NULL, #FIXME: https://web.archive.org/web/19990220132704/http://asp.planetquake.com/dl/dl.asp?quark/quark53b.zip   Dec 31th    (https://web.archive.org/web/19990204000307/http://planetquake.com:80/quark/)
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.4', '54', '#40C040', False, True, False,
                                   'Shareware', mktime(0, 0, 0, 1, 13, 1999), NULL, //Date from Yahoo groups posting
                                   array($downloadroot.'oldies/quark54.exe'),
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.5', '55', '#40C040', False, True, False,
                                   'GPL', mktime(0, 0, 0, 1, 31, 1999), NULL, //Date from Yahoo groups posting
                                   NULL, //FIXME: Missing!
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.6', '56', '#40C040', False, True, False,
                                   'GPL', mktime(0, 0, 0, 2, 11, 1999), NULL, //Date from Yahoo groups posting
                                   array($downloadroot.'oldies/quark56.exe'),
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.7', '57', '#40C040', False, True, False,
                                   'GPL', mktime(0, 0, 0, 2, 28, 1999), NULL, //Date from Yahoo groups posting
                                   NULL, //FIXME: Missing!
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 5.8', '58', '#40C040', False, True, False,
                                   'GPL', mktime(0, 0, 0, 3, 23, 1999), NULL, //Date from Yahoo groups posting
                                   array($downloadroot.'oldies/quark58.exe'),
                                   array($DependencyPython15, )
                                  );
//5.9 beta - http://asp.planetquake.com/dl/dl.asp?quark/beta/quark59b.zip https://groups.yahoo.com/neo/groups/quark-news/conversations/topics/50
$Applications[] = new cApplication('QuArK 5.9', '59', '#40C040', False, True, False,
                                   'GPL', mktime(0, 0, 0, 4, 12, 1999), NULL, //Date from Yahoo groups posting
                                   NULL, //FIXME: Missing!
                                   array($DependencyPython15, )
                                  );
//5.10 beta - http://www.planetquake.com/dl/dl.asp?quark/beta/quark510beta.zip - https://groups.yahoo.com/neo/groups/quark-news/conversations/topics/57
$Applications[] = new cApplication('QuArK 5.10', '510', '#40C040', True, True, False,
                                   'GPL', mktime(0, 0, 0, 7, 7, 1999), NULL,
                                   array('http://www.gamers.org/pub/idgames2/planetquake/quark/quark510.exe', 'https://www.quaddicted.com/files/tools/quark510.exe'), //'http://dl.fileplanet.com/dl/dl.asp?quark/releases/quark510.exe'
                                   array($DependencyPython15, $PatchAvailable)
                                  );
//5.11 beta - Aug 28, 1999 //Date from Yahoo groups posting

$Applications[] = new cApplication('QuArK 6.00 beta-1', '600b1', '#40D040', False, True, False,
                                   'GPL', mktime(0, 0, 0, 4, 24, 2000), NULL, //date from news article and news mailing list
                                   array($downloadroot.'oldies/quark600b1.zip'),
                                   array($DependencyPython15, )
                                  );

#FIXME: Version 6.1, 6.1a, 6.1b missing?

$Applications[] = new cApplication('QuArK 6.1c', '61c', '#40D040', True, True, False,
                                   'GPL', mktime(0, 0, 0, 1, 11, 2001), NULL, //date from news article
                                   NULL, #FIXME: http://dl.fileplanet.com/dl/dl.asp?quark/QuArK_v6.1c.zip
                                   array($DependencyPython15, $PatchAvailable)
                                  );
$Applications[] = new cApplication('QuArK 6.2', '620a', '#40E040', False, True, False,
                                   'GPL', mktime(0, 0, 0, 4, 21, 2001), NULL,
                                   array('https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.2/QuArK_v6.2.EXE/download'),
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 6.2b', '620b', '#40E040', False, True, False,
                                   'GPL', mktime(0, 0, 0, 4, 27, 2001), NULL,
                                   array('https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.2/QuArK_v6.2b.EXE/download'),
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 6.2c', '620c', '#40E040', True, True, False,
                                   'GPL', mktime(0, 0, 0, 5, 4, 2001), NULL,
                                   array('https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.2/QuArK_v6.2c.EXE/download'), //'http://dl.fileplanet.com/dl/dl.asp?quark/releases/quark_v6.2c.exe'
                                   array($DependencyPython15, )
                                  );
$Applications[] = new cApplication('QuArK 6.3.0', '630', '#40F040', True, False, False,
                                   'GPL', mktime(0, 0, 0, 1, 15, 2003), 'Final (stable) release', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/QuArK_v6.3.0.EXE', 'https://www.quaddicted.com/files/tools/QuArK_v6.3.0.EXE'), //'http://www.fileplanet.com/dl/dl.asp?/planetquake/quark/releases/quark_v6.3.0.EXE'
                                   array($DependencyPython15, $OnlyPartialMOHAA, $PatchAvailable)
                                  );
$Applications[] = new cApplication('QuArK 6.4.0 alpha 1', '640a1', '#9090FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 10, 5, 2003), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.4.0alpha1.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.4.0 alpha 2', '640a2', '#9090FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 12, 7, 2003), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.4.0alpha2.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.4.0 alpha 3', '640a3', '#9090FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 1, 17, 2004), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.4.0alpha3.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.4.0 beta 1', '640b1', '#9090FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 5, 1, 2004), 'Beta-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.4.0beta1.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.4.1 alpha 1', '641a1', '#9090FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 2, 27, 2005), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.4.1alpha1.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.4.1 alpha 2', '641a2', '#9090FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 3, 16, 2005), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.4.1alpha2.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.4.1 alpha 3', '641a3', '#9090FF', True, True, False,
                                   'GPL', mktime(0, 0, 0, 6, 9, 2005), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.4.1alpha3.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 alpha 1', '650a1', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 8, 18, 2005), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0alpha1.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 alpha 2', '650a2', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 9, 23, 2005), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0alpha2.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 alpha 3', '650a3', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 11, 1, 2005), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0alpha3.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 alpha 4', '650a4', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 1, 13, 2006), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0alpha4.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 alpha 5', '650a5', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 2, 13, 2006), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0alpha5.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 alpha 6', '650a6', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 3, 10, 2006), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0alpha6.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 alpha 7', '650a7', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 5, 1, 2006), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0alpha7.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 alpha 8', '650a8', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 7, 17, 2006), 'Alpha-release, with Python 2.2.3 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0alpha8.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 Beta 1', '650b1', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 12, 4, 2006), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0Beta1.exe'),
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 Beta 2.0', '650b2', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 4, 5, 2007), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0Beta2.0.exe'), //'http://www.fileplanet.com/179928/170000/fileinfo/QuArK-version-6.5.0-Beta2.0'
                                   array($OnlyPartialMOHAA, )
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 Beta 3.0', '650b3', '#0066FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 8, 31, 2007), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0Beta3.0.exe'),
                                   array($DependencyDevILVC2005, $OnlyPartialMOHAA)
                                  );
$Applications[] = new cApplication('QuArK 6.5.0 Beta 4', '650b4', '#0066FF', True, True, False,
                                   'GPL', mktime(0, 0, 0, 12, 26, 2007), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.5.0Beta4.exe'),
                                   array($DependencyDevILVC2005, $OnlyPartialMOHAA, $PatchAvailable)
                                  );
$Applications[] = new cApplication('QuArK 6.6.0 Beta 1', '660b1', '#0000FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 5, 6, 2008), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.6.0Beta1.exe'),
                                   array($DependencyDevILVC2005, $OnlyPartialMOHAA)
                                  );
$Applications[] = new cApplication('QuArK 6.6.0 Beta 2', '660b2', '#0000FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 1, 30, 2009), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.6.0Beta2.exe'),
                                   array($DependencyDevILVC2005, $OnlyPartialMOHAA, $PatchAvailable)
                                  );
$Applications[] = new cApplication('QuArK 6.6.0 Beta 3', '660b3', '#0000FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 11, 3, 2009), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.6.0Beta3.exe'),
                                   array($DependencyDevILVC2005, $PatchAvailable)
                                  );
$Applications[] = new cApplication('QuArK 6.6.0 Beta 4', '660b4', '#0000FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 5, 21, 2011), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.6.0Beta4.exe'),
                                   array($DependencyDevILVC2005, $DependencyHLLibVC2010)
                                  );
$Applications[] = new cApplication('QuArK 6.6.0 Beta 5', '660b5', '#0000FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 7, 18, 2012), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.6.0Beta5.exe'),
                                   array($DependencyDevILVC2005, $DependencyHLLibVC2010, $PatchAvailable)
                                  );
$Applications[] = new cApplication('QuArK 6.6.0 Beta 6', '660b6', '#0000FF', False, True, False,
                                   'GPL', mktime(0, 0, 0, 7, 10, 2013), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.6.0Beta6.exe'),
                                   array($DependencyDirectX, $DependencyDevILVC2005, $DependencyHLLibVC2010, $PatchAvailable, )
                                  );
$Applications[] = new cApplication('QuArK 6.6.0 Beta 7', '660b7', '#0000FF', False, False, False,
                                   'GPL', mktime(0, 0, 0, 5, 2, 2021), 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('http://downloads.sourceforge.net/quark/quark-win32-6.6.0Beta7.exe'),
                                   array($DependencyDirectX, $DependencyDevILVC2005, $DependencyHLLibVC2010)
                                  );

# "Latest" entry:
$Applications[] = new cApplication('QuArK 6.6 latest', '660', '#0000FF', True, False, False,
                                   'GPL', mktime(0, 0, 0, 5, 2, 2021), 'Version 6.6.0 Beta 7 release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   array('https://sourceforge.net/projects/quark/files/QuArK/'), #Old: http://sourceforge.net/project/showfiles.php?group_id=1181
                                   array($DependencyDirectX, $DependencyDevILVC2005, $DependencyHLLibVC2010)
                                  );

#Future release:
$Applications[] = new cApplication('QuArK 6.6.0 Beta 8', '660b8', '#0000FF', True, False, True,
                                   'GPL', 0, 'Beta-release, with Python 2.4.4 integrated', //FIXME: Wrong release notes!
                                   NULL,
                                   NULL
                                  );

//FIXME: Refactor to change into direct dictionary lookup instead of a loop!
function findAppl($VersionID)
{
	global $Applications;
	for ($Appl = 0; $Appl < count($Applications); $Appl++)
	{
		if ($VersionID === $Applications[$Appl]->VersionID)
		{
			return $Appl;
		}
	}
	return FALSE;
}
?>
