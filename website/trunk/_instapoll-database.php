<?php
require_once('_main_paths.php');

class cInstapoll
{
	var $Question;   # Text question of this poll
	var $StartDate;  # Date this instapoll opened
	var $EndDate;    # Date this instapoll closed
	var $Picture;    # Picture that goes with the question (if any)
	var $Options;    # Array of instapoll options/choices
	var $TotalVotes; # Total number of votes (calculated)

	function __construct($aQuestion, $aStartDate, $aEndDate=0, $aPicture=NULL, $aOptions=NULL)
	{
		$this->Question  = $aQuestion;
		$this->StartDate = $aStartDate;
		$this->EndDate   = $aEndDate;
		$this->Picture   = $aPicture;
		$this->Options   = $aOptions;

		# Calculate total number of votes:
		$this->TotalVotes = 0;
		if (is_array($this->Options))
		{
			for ($Option = 0; $Option < count($this->Options); $Option++)
			{
				$CurrentOption = &$this->Options[$Option];
				$this->TotalVotes += $CurrentOption->Votes;
			}
		}
	}
}

class cInstapollOption
{
	var $Text;    # Text description of the option
	var $Picture; # Picture that goes with this option (if any)
	var $Votes;   # Number of votes for this option

	function __construct($aText, $aPicture=NULL, $aVotes=0)
	{
		$this->Text    = $aText;
		$this->Picture = $aPicture;
		$this->Votes   = $aVotes;
	}
}

global $mainroot;
global $picsroot;

global $instapoll_database;
$instapoll_database = array(

new cInstapoll(
  'What do you think of QuArK\'s colorful captions:'
 ,mktime(0, 0, 0, 2, 26, 2001)
 ,mktime(0, 0, 0, 3, 25, 2001)
 ,new cImage($picsroot.'instapoll/instapoll20010226.jpg', 'Colorful captions', '74', '44')
  //Total votes: 364
 ,array(
    new cInstapollOption('I use them and would miss them if they disappeared.', NULL, 116)
   ,new cInstapollOption('I somewhat use them, but would not miss them if they disappeared.', NULL, 64)
   ,new cInstapollOption('I don\'t use them and don\'t care if they disappear.', NULL, 66)
   ,new cInstapollOption('What colorful captions?', NULL, 118)
  )
)

,new cInstapoll(
  'What suggested plugin would you most like to see developed for QuArK:'
 ,mktime(0, 0, 0, 10, 8, 2000)
 ,0 //,mktime(0, 0, 0, ??, 10, 2000)
 ,NULL
  //Total votes: 330
 ,array(
    new cInstapollOption('Import DXF Files', NULL, 55)
   ,new cInstapollOption('Torus Creator', NULL, 3)
   ,new cInstapollOption('Light Emitting Textures in Open-GL Views', NULL, 19)
   ,new cInstapollOption('Cave / Terrain Builder', NULL, 91)
   ,new cInstapollOption('Import/Export of games special file-formats', NULL, 10)
   ,new cInstapollOption('Extract used textures from selected .BSPs', NULL, 17)
   ,new cInstapollOption('Enlarge/Shrink a single face', NULL, 6)
   ,new cInstapollOption('Finishing the QuArK model-editor', NULL, 99)
   ,new cInstapollOption('Entity prefab \'editor\'', NULL, 13)
   ,new cInstapollOption('User-defined pivot point', NULL, 4)
   ,new cInstapollOption('Three-point cut plane', NULL, 6)
   ,new cInstapollOption('Other', NULL, 7)
  )
)

,new cInstapoll(
  'What game/engine are you currently making maps for, using QuArK?'
 ,mktime(0, 0, 0, 8, 20, 2000)
 ,mktime(0, 0, 0, 9, 6, 2000)
 ,NULL
  //Total votes: 638
 ,array(
    new cInstapollOption('Quake 1', NULL, 69)
   ,new cInstapollOption('Hexen 2', NULL, 5)
   ,new cInstapollOption('Quake 2', NULL, 130)
   ,new cInstapollOption('Heretic 2', NULL, 8)
   ,new cInstapollOption('Half-Life', NULL, 253)
   ,new cInstapollOption('Sin', NULL, 5)
   ,new cInstapollOption('Kingpin', NULL, 27)
   ,new cInstapollOption('Quake 3 Arena', NULL, 112)
   ,new cInstapollOption('Soldier of Fortune', NULL, 17)
   ,new cInstapollOption('CrystalSpace', NULL, 12)
  )
)

,new cInstapoll(
  'Do you use groups to keep your tree-view neat and tidy?'
 ,mktime(0, 0, 0, 7, 3, 2000)
 ,mktime(0, 0, 0, 8, 20, 2000)
 ,NULL
  //Total votes: 406
 ,array(
    new cInstapollOption('Hell no! Who needs them and all those duplicator functions.', new cImage($picsroot.'instapoll/Instapoll20000730_1.gif', 'No groups', '83', '90'), 58)
   ,new cInstapollOption('Sure I do! And the duplicator functions makes editing much easier.', new cImage($picsroot.'instapoll/Instapoll20000730_2.gif', 'With groups', '83', '90'), 308)
   ,new cInstapollOption('Eh? Guess I should read the documentation.', NULL, 40)
  )
)

,new cInstapoll(
  'Do you actually use the \'Useful Links\'?'
 ,mktime(0, 0, 0, 7, 11, 2000)
 ,mktime(0, 0, 0, 7, 23, 2000)
 ,NULL
  //Total votes: 140
 ,array(
    new cInstapollOption('Yes', NULL, 45)
   ,new cInstapollOption('No', NULL, 26)
   ,new cInstapollOption('They are not useful!', NULL, 9)
   ,new cInstapollOption('What links?', NULL, 60)
  )
)

,new cInstapoll(
  'What ad-banner do you want to see advertise for Q3A support in QuArK?'
 ,mktime(0, 0, 0, 4, 28, 2000)
 ,mktime(0, 0, 0, 5, 28, 2000)
 ,NULL
  //Total votes: 276
 ,array(
    new cInstapollOption('#17 RoosteR DucK', new cImage($picsroot.'adbanners/rdi_adbanner_quark6.gif', 'QuArK Banner #17', '117', '15'), 8)
   ,new cInstapollOption('#26 Bogdan', new cImage($picsroot.'adbanners/Bogdan6-quark101.gif', 'QuArK Banner #26', '117', '15'), 19)
   ,new cInstapollOption('#25 Buzzbomb', new cImage($picsroot.'adbanners/Buzzbomb_quarkad.gif', 'QuArK Banner #25', '117', '15'), 1)
   ,new cInstapollOption('#24 RoosteR Duck', new cImage($picsroot.'adbanners/rdi-quark-banner-2.gif', 'QuArK Banner #24', '117', '15'), 9)
   ,new cInstapollOption('#23 Dalek', new cImage($picsroot.'adbanners/Dalek-quark6.gif', 'QuArK Banner #23', '117', '15'), 15)
   ,new cInstapollOption('#22 Neo', new cImage($picsroot.'adbanners/neo-quark-banner.gif', 'QuArK Banner #22', '117', '15'), 3)
   ,new cInstapollOption('#21 Banyek', new cImage($picsroot.'adbanners/Banyek-banner.gif', 'QuArK Banner #21', '117', '15'), 64)
   ,new cInstapollOption('#20 Tomek Garbiak', new cImage($picsroot.'adbanners/TomekGarbiak2-adbanner.gif', 'QuArK Banner #20', '117', '15'), 10)
   ,new cInstapollOption('#18 Ruff', new cImage($picsroot.'adbanners/Ruff-opt1quark6.gif', 'QuArK Banner #18', '117', '15'), 26)
   ,new cInstapollOption('#16 Blazer', new cImage($picsroot.'adbanners/Blazer-Quark6.gif', 'QuArK Banner #16', '117', '15'), 1)
   ,new cInstapollOption('#15 Espi', new cImage($picsroot.'adbanners/Espi2-QuArKbanner.gif', 'QuArK Banner #15', '117', '15'), 5)
   ,new cInstapollOption('#14 Howling', new cImage($picsroot.'adbanners/Howling-quark6banner.gif', 'QuArK Banner #14', '117', '15'), 8)
   ,new cInstapollOption('#13 ReDrUm', new cImage($picsroot.'adbanners/ReDrUm-quark6-adbanner.gif', 'QuArK Banner #13', '117', '15'), 8)
   ,new cInstapollOption('#12 Stedden', new cImage($picsroot.'adbanners/stedden_quark6_banner.gif', 'QuArK Banner #12', '117', '15'), 19)
   ,new cInstapollOption('#11 RoGeR', new cImage($picsroot.'adbanners/RQad2_banner.gif', 'QuArK Banner #11', '117', '15'), 4)
   ,new cInstapollOption('#10 Bogdan', new cImage($picsroot.'adbanners/Bogdan5-quark3D.gif', 'QuArK Banner #10', '117', '15'), 3)
   ,new cInstapollOption('#09 Bogdan', new cImage($picsroot.'adbanners/Bogdan2-quarkbanner.gif', 'QuArK Banner #9', '117', '15'), 0)
   ,new cInstapollOption('#08 evil_lair', new cImage($picsroot.'adbanners/evil_quark_banner.gif', 'QuArK Banner #8', '117', '15'), 6)
   ,new cInstapollOption('#07 RoGeR', new cImage($picsroot.'adbanners/RQad3_banner_optimized.gif', 'QuArK Banner #7', '117', '15'), 3)
   ,new cInstapollOption('#06 Reptiel', new cImage($picsroot.'adbanners/Reptiel-ad-bannerquark6.gif', 'QuArK Banner #6', '117', '15'), 6)
   ,new cInstapollOption('#05 Bogdan', new cImage($picsroot.'adbanners/Bogdan-quarkbanner.gif', 'QuArK Banner #5', '117', '15'), 3)
   ,new cInstapollOption('#04 Decker', new cImage($picsroot.'adbanners/decker-QuArKBanner.gif', 'QuArK Banner #4', '117', '15'), 42)
   ,new cInstapollOption('#02 ~BARiUM', new cImage($picsroot.'adbanners/barium-quark6_1.gif', 'QuArK Banner #2', '117', '15'), 5)
   ,new cInstapollOption('#01 ¥TheBee¥', new cImage($picsroot.'adbanners/thebee-QuArKBanner.gif', 'QuArK Banner #1', '117', '15'), 8)
  )
)

,new cInstapoll(
  'QuArK-user; what is your age?'
 ,mktime(0, 0, 0, 1, 30, 2000)
 ,mktime(0, 0, 0, 2, 13, 2000)
 ,NULL
  //Total votes: 882
 ,array(
    new cInstapollOption('0-10 years', NULL, 9)
   ,new cInstapollOption('11-15 years', NULL, 183)
   ,new cInstapollOption('16-20 years', NULL, 402)
   ,new cInstapollOption('21-25 years', NULL, 119)
   ,new cInstapollOption('26-30 years', NULL, 81)
   ,new cInstapollOption('31-35 years', NULL, 34)
   ,new cInstapollOption('36-40 years', NULL, 25)
   ,new cInstapollOption('40-50 years', NULL, 15)
   ,new cInstapollOption('50+ years', NULL, 14)
  )
)

,new cInstapoll(
  'What type of toolbars do you use in QuArK?'
 ,mktime(0, 0, 0, 1, 9, 2000)
 ,mktime(0, 0, 0, 1, 30, 2000)
 ,NULL
  //Total votes: 201
 ,array(
    new cInstapollOption('Stationary toolbars', NULL, 183)
   ,new cInstapollOption('Floating toolbars', NULL, 8)
   ,new cInstapollOption('Eh? I do not understand.', NULL, 10)
  )
)

,new cInstapoll(
  'Do you vote multiple times, on these InstaPolls?'
 ,mktime(0, 0, 0, 10, 25, 1999)
 ,mktime(0, 0, 0, 11, 6, 1999)
 ,NULL
  //Total votes: 250
 ,array(
    new cInstapollOption('Yes', NULL, 65)
   ,new cInstapollOption('No', NULL, 185)
  )
)

,new cInstapoll(
  'What map-editor are you currently using?'
 ,mktime(0, 0, 0, 10, 4, 1999)
 ,mktime(0, 0, 0, 10, 25, 1999)
 ,NULL
  //Total votes: 553
 ,array(
    new cInstapollOption('QuArK', NULL, 391)
   ,new cInstapollOption('BSP', NULL, 6)
   ,new cInstapollOption('QED', NULL, 6)
   ,new cInstapollOption('Tread', NULL, 5)
   ,new cInstapollOption('WorldCraft', NULL, 77)
   ,new cInstapollOption('QERadiant', NULL, 19)
   ,new cInstapollOption('QOOLE', NULL, 45)
   ,new cInstapollOption('Other', NULL, 4)
  )
)

,new cInstapoll(
  'What map-editor were you using before moving to QuArK?'
 ,mktime(0, 0, 0, 10, 4, 1999)
 ,mktime(0, 0, 0, 10, 25, 1999)
 ,NULL
  //Total votes: 439
 ,array(
    new cInstapollOption('None', NULL, 162)
   ,new cInstapollOption('BSP', NULL, 13)
   ,new cInstapollOption('QED', NULL, 8)
   ,new cInstapollOption('Tread', NULL, 9)
   ,new cInstapollOption('WorldCraft', NULL, 98)
   ,new cInstapollOption('QERadiant', NULL, 19)
   ,new cInstapollOption('QOOLE', NULL, 78)
   ,new cInstapollOption('Other', NULL, 19)
   ,new cInstapollOption('I\'m not using QuArK33', NULL, 33)
  )
)

,new cInstapoll(
  'How long have you been using QuArK?'
 ,mktime(0, 0, 0, 9, 19, 1999)
 ,mktime(0, 0, 0, 9, 26, 1999)
 ,NULL
  //Total votes: 239
 ,array(
    new cInstapollOption('Never', NULL, 33)
   ,new cInstapollOption('Less than a week', NULL, 15)
   ,new cInstapollOption('Less than a month', NULL, 16)
   ,new cInstapollOption('1-3 months', NULL, 18)
   ,new cInstapollOption('3-6 months', NULL, 18)
   ,new cInstapollOption('6-12 months', NULL, 48)
   ,new cInstapollOption('1-2 years', NULL, 52)
   ,new cInstapollOption('2 or more years', NULL, 39)
  )
)

,new cInstapoll(
  'When making a hole in a wall for a door, what method do you use?'
 ,mktime(0, 0, 0, 8, 22, 1999)
 ,mktime(0, 0, 0, 9, 19, 1999)
 ,NULL
  //Total votes: 414
 ,array(
    new cInstapollOption('<i>Brick-by-brick.</i> Create 3 or 4 brushes for the wall, and using vertex/face movement to make space for the hole', NULL, 102)
   ,new cInstapollOption('<i>Carving.</i> Create 1 brush for the wall, and another brush which is used to instantly \'Brush subtract\' with', NULL, 191)
   ,new cInstapollOption('<i>Digger.</i> Create 1 brush for the wall, then creating a Digger from the \'Duplicators & misc\' folder', NULL, 19)
   ,new cInstapollOption('<i>Negative.</i> Create 1 brush for the wall, then another brush which is turned into a negative poly', NULL, 19)
   ,new cInstapollOption('Mostly brick-by-brick and carving', NULL, 40)
   ,new cInstapollOption('Mostly brick-by-brick and digger/negative', NULL, 15)
   ,new cInstapollOption('Mostly carving and digger/negative', NULL, 14)
   ,new cInstapollOption('Depends on how static my paper-design is', NULL, 14)
  )
)

,new cInstapoll(
  'Which one of the <a href=\''.$mainroot.'suggestedplugins.php\'>suggested plug-ins</a> are you most anticipated to see implemented in QuArK?'
 ,mktime(0, 0, 0, 8, 1, 1999)
 ,mktime(0, 0, 0, 8, 22, 1999)
 ,NULL
  //Total votes: 335
 ,array(
    new cInstapollOption('None, it doesn\'t matter to me', NULL, 9)
   ,new cInstapollOption('Import/Export of games special file-formats', NULL, 20)
   ,new cInstapollOption('Extract used textures from selected .BSPs', NULL, 27)
   ,new cInstapollOption('Merge brushes', NULL, 30)
   ,new cInstapollOption('Show width/height/depth of selected poly(s)', NULL, 25)
   ,new cInstapollOption('Enlarge/shrink a single face', NULL, 14)
   ,new cInstapollOption('Finishing the QuArK model-editor', NULL, 131)
   ,new cInstapollOption('Entity/Prefab \'editor\'', NULL, 47)
   ,new cInstapollOption('User-defined pivot point', NULL, 13)
   ,new cInstapollOption('Three point cut-plane', NULL, 11)
   ,new cInstapollOption('Other', NULL, 8)
  )
)

,new cInstapoll(
  'How would you rate QuArK comparing to other editors you use/have used?'
 ,mktime(0, 0, 0, 7, 18, 1999)
 ,mktime(0, 0, 0, 8, 1, 1999)
 ,NULL
  //Total votes: 343
 ,array(
    new cInstapollOption('What other editors? QuArK is THE ONE!', NULL, 175)
   ,new cInstapollOption('It is great, just missing a few features.', NULL, 81)
   ,new cInstapollOption('I changed to QuArK, when I knew of its existence.', NULL, 36)
   ,new cInstapollOption('Other map-editors are just as confusing.', NULL, 19)
   ,new cInstapollOption('I changed to another editor, with better features.', NULL, 10)
   ,new cInstapollOption('I only use it to find leaks in my maps.', NULL, 4)
   ,new cInstapollOption('Quark? Isn\'t that a desktop-publishing program?', NULL, 18)
  )
)

,new cInstapoll(
  'Which one of the following games, that presumedly uses the Quake-series graphics-engine, would you like to see supported by QuArK?'
 ,mktime(0, 0, 0, 7, 4, 1999)
 ,mktime(0, 0, 0, 7, 11, 1999)
 ,NULL
  //Total votes: 440
 ,array(
    new cInstapollOption('Daikatana', NULL, 11)
   ,new cInstapollOption('Kingpin', NULL, 61)
   ,new cInstapollOption('Quake 3 Arena', NULL, 221)
   ,new cInstapollOption('Soldier of Fortune', NULL, 6)
   ,new cInstapollOption('Star Trek Voyager: Elite Force', NULL, 23)
   ,new cInstapollOption('Team Fortress 2', NULL, 110)
   ,new cInstapollOption('Other', NULL, 8)
  )
)

,new cInstapoll(
  'What major type of maps do you create, using QuArK?'
 ,mktime(0, 0, 0, 6, 20, 1999)
 ,mktime(0, 0, 0, 7, 4, 1999)
 ,NULL
  //Total votes: 299
 ,array(
    new cInstapollOption('Single-level single player', NULL, 51)
   ,new cInstapollOption('Multi-level single player', NULL, 17)
   ,new cInstapollOption('Cooperative', NULL, 4)
   ,new cInstapollOption('Deathmatch', NULL, 121)
   ,new cInstapollOption('Teamplay DM, Rocket Arena, Jailbreak', NULL, 13)
   ,new cInstapollOption('Team Fortress, Weapons Factory', NULL, 30)
   ,new cInstapollOption('Capture the Flag', NULL, 18)
   ,new cInstapollOption('Action Q2, Terror', NULL, 25)
   ,new cInstapollOption('Other PC, TC, MOD', NULL, 20)
  )
)

,new cInstapoll(
  'What game are you currently making maps for, using QuArK?'
 ,mktime(0, 0, 0, 6, 13, 1999)
 ,mktime(0, 0, 0, 6, 29, 1999)
 ,NULL
  //Total votes: 356
 ,array(
    new cInstapollOption('Quake 1', NULL, 68)
   ,new cInstapollOption('Hexen 2', NULL, 6)
   ,new cInstapollOption('Quake 2', NULL, 162)
   ,new cInstapollOption('Heretic 2', NULL, 13)
   ,new cInstapollOption('Half-Life', NULL, 97)
   ,new cInstapollOption('Sin', NULL, 10)
  )
)

);

?>
