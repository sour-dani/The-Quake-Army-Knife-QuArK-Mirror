<?php
require_once('_main_paths.php');

class cGame
{
	var $FromVersion;      # From which version did QuArK support this game
	var $GameID;           # ID used for the game
	var $GameTitle;        # Full game title
	var $Acronym;          # Acronym used for the game
	var $Icon;             # Icon of the game
	var $URL;              # Official website of the game
	var $WikipediaURL;     # Link to the (English) Wikipedia article of this game (if any)
	var $Engine;           # The 3D engine the game uses
	var $EngineModified;   # Whether it uses a modified version of said engine
	var $Description;      # One-liner describing the game
	var $Developer;        #
	var $Publisher;        #
	var $Distributor;      #
	var $NeedsGame;        # This game uses this as a base (for example, this is an expansion pack)

	function __construct($aFromVersion, $aGameID, $aGameTitle, $aAcronym, $aIcon, $aUrl, $aWikipediaURL, $aEngine, $aEngineModified, $aDescription, $aDeveloper, $aPublisher, $aDistributor, $aNeedsGame=NULL)
	{
		global $picsroot;

		$this->FromVersion      = $aFromVersion;
		$this->GameID           = $aGameID;
		$this->GameTitle        = $aGameTitle;
		$this->Acronym          = $aAcronym;
		if (is_null($aIcon))
		{
			$this->Icon = NULL;
		}
		else
		{
			$this->Icon         = $picsroot.'game/'.$aIcon;
		}
		$this->URL              = $aUrl;
		$this->WikipediaURL     = $aWikipediaURL;
		$this->Engine           = $aEngine;
		$this->EngineModified   = $aEngineModified;
		$this->Description      = $aDescription;
		$this->Developer        = $aDeveloper;
		$this->Publisher        = $aPublisher;
		$this->Distributor      = $aDistributor;
		$this->NeedsGame        = $aNeedsGame;
	}
}

global $Games;
$Games = array();

$Games[] = new cGame('630' ,'6DX' ,'6DX engine' ,'6DX' ,'6dx.gif'
                    ,'https://sourceforge.net/projects/aztica/' ,NULL ,'6DX', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'ALICE3' ,'Alice: Asylum' ,'ALICE3' ,NULL
                    ,NULL ,NULL ,'???', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/ //Not yet confirmed
/*$Games[] = new cGame(NULL ,'Alice: Madness Returns' ,'Alice: Asylum' ,'ALICE2' ,NULL
                    ,'https://www.ea.com/games/alice' ,'https://en.wikipedia.org/wiki/Alice:_Madness_Returns' ,'Unreal3', FALSE
                    ,'Return to Victorian London in Alice: Madness Returns as Alice once again seeks refuge in Wonderland only to find it more dangerous than ever.'
                    ,array('Spicy Horse')
                    ,array('Electronic Arts')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'ALIEN' ,'Alien Arena' ,'AA' ,'aa.png' #CodeRED: Alien Arena
                    ,'http://red.planetarena.org/' ,'https://en.wikipedia.org/wiki/Alien_Arena_(video_game)' ,'CRX', FALSE #http://icculus.org/alienarena/rpa/ #https://en.wikipedia.org/wiki/CodeRED:_Alien_Arena
                    ,'A fast paced, fun FREE FPS!'
                    ,array('COR')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'AS' ,'Alien Swarm' ,'AS' ,'alienswarm.png'
                    ,'http://www.alienswarm.com/' ,'https://en.wikipedia.org/wiki/Alien_Swarm' ,'Source', FALSE
                    ,'Alien Swarm is a game and Source SDK release from a group of talented designers at Valve who were hired from the Mod community.'
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );
$Games[] = new cGame('660b4' ,'ALICE' ,'American McGee\'s Alice' ,'Alice' ,'alice.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/American_McGee\'s_Alice' ,'Quake 3', FALSE
                    ,'Into a dark dream you drop...'
                    ,array('Rogue')
                    ,array('EA')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'AD' ,'Amsterdoom' ,'AD' ,'amsterdoom.png'
                    ,NULL ,NULL ,'G3D', FALSE //https://nl.wikipedia.org/wiki/Amsterdoom
                    ,'In dit nieuwe millennium is er eindelijk gebeurd waar mensen al decennia voor vrezen...'
                    ,array('Davilex')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'AN' ,'Anachronox' ,'AN' ,'anachronox.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Anachronox' ,'Quake 2', TRUE
                    ,'Explore worlds. Fight battles. Solve mysteries.'
                    ,array('Ion Storm')
                    ,array('Eidos' ,'Eidos GmbH' ,'Infogrames')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'AT' ,'Aperture Tag: The Paint Gun Testing Initiative' ,'AT' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Aperture_Tag' ,'Source', FALSE
                    ,NULL
                    ,array('Aperture Tag Team')
                    ,array('Aperture Tag Team')
                    ,NULL
                    );*/ //Mod for Portal 2
$Games[] = new cGame(NULL ,'AL' ,'Apex Legends' ,'AL' ,'al.png'
                    ,'https://www.ea.com/games/apex-legends' ,'https://en.wikipedia.org/wiki/Apex_Legends' ,'Source', TRUE
                    ,NULL
                    ,array('Respawn Entertainment')
                    ,array('EA')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'BGG:GG' ,'Barbie Generation Girl: Gotta Groove' ,'BGG:GG' ,'bgg.png'
                    ,NULL ,NULL ,'G3D', FALSE
                    ,"Where dancing, cool music and friendship are where it's at!"
                    ,array('Stunt Puppy Entertainment')
                    ,array('Vivendi')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'BM' ,'Black Mesa' ,'BM' ,NULL
                    ,'https://www.crowbarcollective.com/games/black-mesa' ,'https://en.wikipedia.org/wiki/Black_Mesa_(video_game)' ,'Source', FALSE
                    ,'Relive Half-Life, Valve Software\'s revolutionary debut, in this highly acclaimed, fan-made recreation.'
                    ,array('Crowbar Collective')
                    ,array('Crowbar Collective')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'BS' ,'Blade Symphony' ,'BS' ,'bs.png'
                    ,'https://www.blade-symphony.com/' ,'https://en.wikipedia.org/wiki/Blade_Symphony' ,'Source', FALSE
                    ,"Prove you are the world's greatest swordsman in Blade Symphony: a slash-em-up featuring a highly detailed and in-depth sword fighting system."
                    ,array('Puny Human')
                    ,array('Puny Human')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'BL' ,'Blockland' ,'BL' ,'blockland.png'
                    ,'http://www.blockland.us/' ,'https://en.wikipedia.org/wiki/Blockland_(video_game)' ,'TGE', FALSE
                    ,'Blockland is an online multiplayer game where you build things with bricks. It\'s like playing with legos on the internet.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'BW' ,'Blood West' ,'BW' ,NULL
                    ,'https://hyperstrange.com/our-games/blood-west/' ,NULL ,'Unity', FALSE
                    ,'Become the Undead Gunslinger, doomed to roam the barren lands until he manages to purge their curse, freeing his soul.'
                    ,array('Hyperstrange')
                    ,array('Hyperstrange')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'BGT' ,'Bloody Good Time' ,'BGT' ,'bgt.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Bloody_Good_Time' ,'Source', FALSE #https://bloody-good-time.ubi.com/
                    ,'Welcome to Hollywood! The home of fame and fortune!'
                    ,array('Outerlight')
                    ,array('Ubisoft')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'BB2' ,'Boards and Blades 2' ,'BB2' ,NULL
                    ,NULL ,NULL ,'G3D', FALSE
                    ,NULL
                    ,array('Silverfish Studios')
                    ,array('Activision Value')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'BRINK' ,'Brink' ,'B' ,'brink.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Brink_(video_game)' ,'Doom 3', TRUE #http://www.brinkthegame.com/
                    ,'The Ark, once an oceanic paradise, has been torn apart by civil war. Now you must join the Resistance or Security faction.'
                    ,array('Splash Damage')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CEA' ,'Chaos Esque Anthology', 'CEA' ,NULL
                    ,'https://sourceforge.net/projects/chaosesqueanthology/' ,NULL ,'DarkPlaces', FALSE #Xonotic-fork
                    ,'A free 3d game for PC that does not limit the player. Fight, Build, Gain.'
                    ,array('Chaos Esque Team')
                    ,NULL
                    ,NULL
                    );
#https://sourceforge.net/projects/chaosesqueanthologyvolume2/
#https://sourceforge.net/projects/chaosesqueanthologyvolume3/
#https://sourceforge.net/projects/chaoseesquesupplemental/
$Games[] = new cGame('641a1' ,'CoD' ,'Call of Duty' ,'CoD' ,'cod1.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty_(video_game)' ,'Quake 3', FALSE #http://www.callofduty.com/
                    ,'Experience the cinematic intensity of World War II\'s epic battles.'
                    ,array('Infinity Ward')
                    ,array('Activision')
                    ,NULL
                    );
//FIXME: https://en.wikipedia.org/wiki/Call_of_Duty:_Finest_Hour
//FIXME: https://en.wikipedia.org/wiki/Call_of_Duty_2:_Big_Red_One
//FIXME: https://en.wikipedia.org/wiki/Call_of_Duty:_Roads_to_Victory
//FIXME: https://en.wikipedia.org/wiki/Call_of_Duty:_Modern_Warfare:_Mobilized
//FIXME: https://en.wikipedia.org/wiki/Call_of_Duty:_World_at_War_%E2%80%93_Final_Fronts
//FIXME: https://en.wikipedia.org/wiki/Call_of_Duty:_Zombies
//FIXME: https://en.wikipedia.org/wiki/Call_of_Duty:_Black_Ops_%E2%80%93_Zombies
//FIXME: https://en.wikipedia.org/wiki/Call_of_Duty:_Black_Ops:_Declassified
$Games[] = new cGame('660b7' ,'CoDuo' ,'Call of Duty: United Offensive' ,'CoD:UO' ,'cod1uo.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty:_United_Offensive' ,'Quake 3', FALSE #http://www.callofduty.com/unitedoffensive/main.html
                    ,'The War That Changed the World rages on.'
                    ,array('Gray Matter')
                    ,array('Activision' ,'Aspyr')
                    ,NULL
                    ,'CoD');
$Games[] = new cGame('660b7' ,'CoD2' ,'Call of Duty 2' ,'CoD2' ,'cod2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty_2' ,'IW2', FALSE #http://www.callofduty.com/
                    ,'More cinematic intensity and chaos than ever before, in World War II\'s most climactic battles.'
                    ,array('Infinity Ward')
                    ,array('Activision' ,'Konami')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'CoD3' ,'Call of Duty 3' ,'CoD3' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty_3' ,'NGL', FALSE #http://www.callofduty.com/
                    ,NULL
                    ,array('Treyarch')
                    ,array('Activision')
                    ,NULL
                    );*/ //Incompatible platform
$Games[] = new cGame(NULL ,'CoD4' ,'Call of Duty 4: Modern Warfare' ,'CoD4' ,'cod4.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty_4:_Modern_Warfare' ,'IW3', FALSE #http://www.callofduty.com/
                    ,'Fight as a member of U.S. forces and British spec ops in global hotspots to eliminate a well-armed, ruthless force of international separatists.'
                    ,array('Infinity Ward')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD5' ,'Call of Duty: World at War' ,'CoD5' ,'cod5.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty:_World_at_War' ,'IW3', FALSE #http://www.callofduty.com/
                    ,'Confront new and ruthless enemies across the Pacific and European battlefields in the final days of WWII.'
                    ,array('Treyarch' ,'Certain Affinity')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD6' ,'Call of Duty: Modern Warfare 2' ,'CoD6' ,'cod6.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Modern_Warfare_2' ,'IW4', FALSE #http://www.modernwarfare2.com/
                    ,'The sequel to the best-selling first-person action game of all time.'
                    ,array('Infinity Ward')
                    ,array('Activision')
                    ,NULL
                    );
//FIXME: Call of Duty: Modern Warfare 2 Campaign Remastered?
$Games[] = new cGame(NULL ,'CoD7' ,'Call of Duty: Black Ops' ,'CoD7' ,NULL
                    ,'https://www.callofduty.com/blackops/' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Black_Ops' ,'IW3', FALSE
                    ,'The best-selling first-person action franchise of all time returns.'
                    ,array('Treyarch')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD8' ,'Call of Duty: Modern Warfare 3' ,'CoD8' ,'cod8.png'
                    ,'https://callofduty.com/mw3' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Modern_Warfare_3' ,'IW5', FALSE
                    ,'The best-selling first-person action franchise in history is back.'
                    ,array('Infinity Ward' ,'Sledgehammer')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoDO' ,'Call of Duty Online' ,'CoDO' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty_Online' ,'IW4', FALSE
                    ,NULL
                    ,array('Activision Shanghai', 'Raven Software')
                    ,array('Tencent Games')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD9' ,'Call of Duty: Black Ops II' ,'CoD9' ,NULL
                    ,'https://callofduty.com/blackops2' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Black_Ops_II' ,'CoD9', FALSE
                    ,'Campaign, multiplayer, zombies.'
                    ,array('Treyarch')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD10' ,'Call of Duty: Ghosts' ,'CoD10' ,NULL
                    ,'https://callofduty.com/ghosts' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Ghosts' ,'IW6', FALSE
                    ,'A changed world, redefined multiplayer, and all-new squards mode.'
                    ,array('Infinity Ward')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD11' ,'Call of Duty: Advanced Warfare' ,'CoD11' ,NULL
                    ,'https://www.callofduty.com/advancedwarfare' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Advanced_Warfare' ,NULL, FALSE //Unknown IW engine
                    ,'Power changes everything.'
                    ,array('Sledgehammer')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD12' ,'Call of Duty: Black Ops III' ,'CoD12' ,NULL
                    ,'https://www.callofduty.com/blackops3/' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Black_Ops_III' ,'CoD12', FALSE
                    ,'Delivering 3 expansive and distinct game experiences.'
                    ,array('Treyarch')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD13' ,'Call of Duty: Infinite Warfare' ,'CoD13' ,NULL
                    ,'https://www.callofduty.com/infinitewarfare' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Infinite_Warfare' ,'IW7', FALSE
                    ,NULL
                    ,array('Infinity Ward')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD14' ,'Call of Duty: WWII' ,'CoD14' ,NULL
                    ,'https://www.callofduty.com/wwii' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_WWII' ,NULL ,TRUE //Modified Advanced Warfare engine
                    ,NULL
                    ,array('Sledgehammer')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD15' ,'Call of Duty: Black Ops 4' ,'CoD15' ,NULL
                    ,'https://www.callofduty.com/blackops4' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Black_Ops_4' ,'CoD14', FALSE
                    ,NULL
                    ,array('Treyarch')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD16' ,'Call of Duty: Modern Warfare' ,'CoD16' ,NULL
                    ,'https://www.callofduty.com/modernwarfare' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Modern_Warfare_(2019_video_game)' ,'IW8', TRUE
                    ,NULL
                    ,array('Infinity Ward')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoDWZ' ,'Call of Duty: Warzone' ,'CoDWZ' ,NULL
                    ,'https://www.callofduty.com/modernwarfare/warzone' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Warzone' ,'IW8', FALSE
                    ,NULL
                    ,array('Infinity Ward', 'Treyarch', 'Raven')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD17' ,'Call of Duty: Black Ops Cold War' ,'CoD17' ,NULL
                    ,'https://www.callofduty.com/modernwarfare/warzone' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Black_Ops_Cold_War' ,'CoD12', TRUE
                    ,NULL
                    ,array('Treyarch', 'Raven')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD18' ,'Call of Duty: Vanguard' ,'CoD18' ,NULL
                    ,'https://www.callofduty.com/vanguard' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Vanguard' ,'IW8', FALSE
                    ,NULL
                    ,array('Sledgehammer')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD19' ,'Call of Duty: Modern Warfare II' ,'CoD19' ,NULL
                    ,'https://www.callofduty.com/modernwarfare2' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Modern_Warfare_II_(2022_video_game)' ,'IW9', FALSE
                    ,NULL
                    ,array('Infinity Ward')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoDWZ2' ,'Call of Duty: Warzone 2.0' ,'CoDWZ2' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Warzone_2.0' ,'IW9', FALSE
                    ,NULL
                    ,array('Infinity Ward', 'Raven')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CoD20' ,'Call of Duty: Modern Warfare III' ,'CoD20' ,NULL
                    ,'https://www.callofduty.com/modernwarfare3' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Modern_Warfare_III_(2023_video_game)' ,'IW9', FALSE
                    ,NULL
                    ,array('Sledgehammer')
                    ,array('Activision')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'CoD21' ,'Call of Duty: Black Ops 6' ,'CoD21' ,NULL
                    ,'https://www.callofduty.com/blackops6' ,'https://en.wikipedia.org/wiki/Call_of_Duty:_Black_Ops_6' ,'IW9', FALSE
                    ,NULL
                    ,array('Treyarch', 'Raven')
                    ,array('Activision')
                    ,NULL
                    );*/ //Not released yet
$Games[] = new cGame(NULL ,'C' ,'Catechumen' ,'C' ,'c.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Catechumen_(video_game)' ,'G3D', FALSE #http://www.catechumen.com
                    ,'Catechumen is a first person action/adventure Christian game where your goal is to defeat the forces of evil, descending deeper into the depths of the Earth and rescue your captured brethren.'
                    ,array('N\'Lightning Software Development')
                    ,array('N\'Lightning Software Development')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CD' , 'Cocaine Diesel' ,'CD' ,'cd.png'
                    ,'https://cocainediesel.fun/' ,NULL ,'Qfusion', FALSE #Note: Website blocks certain browsers, such as IE and Edge.
                    ,'Cocaine Diesel is a social first person shooter with an emphasis on drug promotion and criminal lifestyles.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'CG' , 'Codename Gordon' ,'CG' ,NULL #Note: the game itself gives the trademark as without the colon, but even their own website was inconsistent at the time!
                    ,NULL ,'https://en.wikipedia.org/wiki/Codename_Gordon' ,'Flash', FALSE #FIXME: Add engine to website!
                    ,NULL
                    ,array('Nuclearvision')
                    ,array('Valve')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'CIA' ,'CIA Operative: Solo Missions' ,'CIA' ,'cia.png'
                    ,NULL ,NULL ,'GLQuake', FALSE
                    ,'Eliminate the Enemies of the State.'
                    ,array('Trainwreck')
                    ,array('ValuSoft')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CONS' ,'Consortium' ,'CONS' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Consortium_(video_game)' ,'Source', FALSE
                    ,NULL
                    ,array('Interdimensional Games')
                    ,array('Interdimensional Games')
                    ,NULL
                    );
//https://en.wikipedia.org/wiki/Consortium:_The_Tower is Unreal 4
$Games[] = new cGame(NULL ,'CONT' ,'Contagion' ,'CONT' ,'cont.png'
                    ,'http://www.contagion-game.com/' ,'https://en.wikipedia.org/wiki/Contagion_(video_game)' ,'Source', FALSE
                    ,'Eugene, Marcus, and other Survivors return in the spiritual successor of the popular Half-Life 2 Modification Zombie Panic: Source!'
                    ,array('Monochrome')
                    ,array('Monochrome')
                    ,NULL
                    );
$Games[] = new cGame('510' ,'CS' ,'Counter-Strike' ,'CS' ,'cs.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Counter-Strike_(video_game)' ,'GoldSrc', TRUE
                    ,'The number one online action game, Counter-Strike features strategic teamplay set in terrorist vs. counter-terrorist scenarios.'
                    ,array('Valve')
                    ,array('Vivendi')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CSCZ' ,'Counter-Strike: Condition Zero' ,'CSCZ' ,'cscz.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Counter-Strike:_Condition_Zero' ,'GoldSrc', TRUE
                    ,'From the makers of the critically-acclaimed Half-Life and Counter-Strike, Condition Zero is Valve\'s official follow-up to the world\'s #1 online action experience.'
                    ,array('Ritual', 'Turtle Rock Studios', 'Valve')
                    ,array('Sierra Entertainment')
                    ,NULL
                    );
$Games[] = new cGame('641a1' ,'CSS' ,'Counter-Strike: Source' ,'CSS' ,'css.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Counter-Strike:_Source' ,'Source', FALSE
                    ,'Counter-Strike: Source introduces new graphics and maps to the world\'s #1 online action game.'
                    ,array('Valve')
                    ,array('Valve')
                    ,array('EA')
                    );
$Games[] = new cGame(NULL ,'CSGO' ,'Counter-Strike: Global Offensive' ,'CSGO' ,'csgo.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Counter-Strike:_Global_Offensive' ,'Source', FALSE
                    ,'Counter-Strike: Global Offensive (CS: GO) expands upon the team-based action gameplay that it pioneered when it was launched 19 years ago.'
                    ,array('Valve', 'Hidden Path Entertainment')
                    ,array('Valve')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'CS2' ,'Counter-Strike 2' ,'CS2' ,'cs2.png'
                    ,'https://www.counter-strike.net/cs2' ,'https://en.wikipedia.org/wiki/Counter-Strike_2' ,'Source2', FALSE
                    ,'The next era of Counter-Strike is here!'
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    ); /* Technically a big update of Counter-Strike: Global Offensive */
$Games[] = new cGame('660b8' ,'CoF' ,'Cry of Fear' ,'CoF' ,'cof.png'
                    ,'https://www.cry-of-fear.com/' ,'https://en.wikipedia.org/wiki/Cry_of_Fear' ,'GoldSrc', FALSE
                    ,'Cry of Fear is a single-player, horror modification for Half-Life 1 that brings you all the horrors you have always been afraid of.'
                    ,array('Team Psykskallar')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame('620a' ,'CrSp' ,'Crystal Space' ,'Crystal' ,'crystalspace.gif'
                    ,'http://www.crystalspace3d.org/' ,'https://en.wikipedia.org/wiki/Crystal_Space' ,'CrSp', FALSE #https://crystal.sourceforge.net/
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame('660b8' ,'DK' ,'Daikatana' ,'DK' ,'daikatana.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Daikatana' ,'Quake 2', TRUE #http://www.daikatana.com/
                    ,'Time is not on your side.'
                    ,array('Ion Storm')
                    ,array('Eidos')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DARK' ,'Dark Messiah of Might and Magic' ,'DM' ,'dark.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Dark_Messiah_of_Might_and_Magic' ,'Source', FALSE #http://www.darkmessiahgame.com/
                    ,'Choose your way to kill.'
                    ,array('Arkane', 'Floodgate', 'Kuju')
                    ,array('Ubisoft')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DS' ,'Dark Salvation' ,'DS' ,'dark_salvation.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Dark_Salvation' ,'Quake 3', FALSE #http://www.darksalvation.com/
                    ,'Dark Salvation is an FPS horror shooter built with id Tech 3 and is for mature audiences only.'
                    ,array('Mangled Eye')
                    ,array('Mangled Eye')
                    ,NULL
                    );
$Games[] = new cGame('620a' ,'DAY' ,'Day of Defeat' ,'DoD' ,'dod.gif' //FIXME: 620a is a guess!
                    ,NULL ,'https://en.wikipedia.org/wiki/Day_of_Defeat' ,'GoldSrc', TRUE #http://www.dayofdefeat.com/ #http://www.dayofdefeatmod.com
                    ,'Day of Defeat is the latest online action experience from Valve, makers of Half-Life and Counter-Strike.'
                    ,array('Valve')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('660b2' ,'DAYS' ,'Day of Defeat: Source' ,'DoDS' ,'dods.gif'
                    ,'https://www.dayofdefeat.com/' ,'https://en.wikipedia.org/wiki/Day_of_Defeat:_Source' ,'Source', FALSE
                    ,'The latest version of the WWII online action game from the creators of Half-Life 2 and Counter-Strike: Source.'
                    ,array('Valve')
                    ,array('Valve')
                    ,array('EA')
                    );
$Games[] = new cGame(NULL ,'DoI' ,'Day of Infamy' ,'DoI' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Day_of_Infamy_(video_game)' ,'Source', FALSE
                    ,NULL
                    ,array('New World Interactive')
                    ,array('New World Interactive')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DDAY' ,'D-Day: Normandy' ,'DDAY' ,'dday.png'
                    ,'http://www.ddaydev.com/' ,NULL ,'Quake 2', TRUE
                    ,'D-Day: Normandy is a completely free to play World War II game.' //'It\'s an old game but it\'s fun and completely free to play and should be playable on any Windows computer.'
                    ,array('Vipersoft')
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'DDL' ,'Deadlock' ,'DDL' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Deadlock_(video_game)' ,'Source 2', FALSE
                    ,NULL
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );*/ //Not released yet
$Games[] = new cGame(NULL ,'DE' ,'Dear Esther' ,'DE' ,'dearesther.png'
                    ,'http://dear-esther.com/' ,'https://en.wikipedia.org/wiki/Dear_Esther' ,'Source', FALSE
                    ,'A deserted island...a lost man...memories of a fatal crash...a book written by a dying explorer.'
                    ,array('thechineseroom')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DL', 'Deathloop', 'DL', NULL
                    ,'https://bethesda.net/en/game/deathloop', 'https://en.wikipedia.org/wiki/Deathloop', 'Void', FALSE
                    ,NULL
                    ,array('Arkane')
                    ,array('Bethesda')
                    ,NULL
                    );
//FIXME: Deathmatch Classic   https://en.wikipedia.org/w/index.php?title=Deathmatch_Classic&redirect=no
$Games[] = new cGame(NULL ,'Dish2' ,'Dishonored 2' ,'Dish2' ,NULL
                    ,'http://www.dishonored.com/' ,'https://en.wikipedia.org/wiki/Dishonored_2' ,'Void', FALSE
                    ,'Take back what\'s yours.'
                    ,array('Arkane')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'Dish2XP' ,'Dishonored: Death of the Outsider' ,'Dish2XP' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Dishonored:_Death_of_the_Outsider' ,'Void', FALSE
                    ,NULL
                    ,array('Arkane')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame('641a1' ,'DM3' ,'Doom 3' ,'DM3' ,'doom3.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Doom_3' ,'Doom 3', FALSE //http://www.doom3.com/
                    ,'Science has unlocked the gates to the unknown, and now only one man stands between hell and earth.'
                    ,array('id' ,'Splash Damage')
                    ,array('Activision')
                    ,array('Activision')
                    );
$Games[] = new cGame(NULL ,'DM3ROE' ,'Doom 3: Resurrection of Evil' ,'DM3RoE' ,'doom3roe.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Doom_3:_Resurrection_of_Evil' ,'Doom 3', FALSE //http://www.doom3.com/
                    ,'True evil never dies.'
                    ,array('Nerve' ,'id')
                    ,array('Activision')
                    ,NULL
                    ,'DM3');
/*$Games[] = new cGame(NULL ,'DM3TLM' ,'Doom 3: The Lost Mission' ,'DM3TLM' ,NULL
                    ,NULL ,NULL ,'Doom 3', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/
/*$Games[] = new cGame(NULL ,'DM3BFG' ,'Doom 3: BFG Edition' ,'DM3BFG' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Doom_3:_BFG_Edition' ,'Doom 3', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/
/*$Games[] = new cGame(NULL ,'DM4' ,'Doom 4' ,'DM4' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Doom_4' ,'Doom 4', FALSE
                    ,NULL
                    ,array('id')
                    ,array('Bethesda')
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame(NULL ,'DM4' ,'Doom (2016)' ,'DM4' ,'dm4.png'
                    ,'http://bethesda.net/game/doom-2016' ,'https://en.wikipedia.org/wiki/Doom_(2016_video_game)' ,'id Tech 6', FALSE #https://doom.com/
                    ,'Fight like hell.'
                    ,array('id')
                    ,array('Bethesda')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'DMVFR' ,'Doom VFR' ,'DMVFR' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Doom_VFR' ,'id Tech 6', FALSE #https://www.doom.com/
                    ,NULL
                    ,array('id')
                    ,array('Bethesda')
                    ,NULL
                    );*/
$Games[] = new cGame(NULL ,'DM5' ,'Doom Eternal' ,'DM5' ,'dm5.png'
                    ,'https://bethesda.net/game/doom' ,'https://en.wikipedia.org/wiki/Doom_Eternal' ,'id Tech 7', FALSE
                    ,'Raze hell.'
                    ,array('id')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DM6' ,'Doom: The Dark Ages' ,'DM6' ,NULL
                    ,'https://doom.bethesda.net/the-dark-ages' ,'https://en.wikipedia.org/wiki/Doom:_The_Dark_Ages' ,'id Tech 8', FALSE
                    ,NULL
                    ,array('id')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DB' ,'Doombringer' ,'DB' ,NULL
                    ,'https://www.doombringer.eu/' ,NULL ,'DarkPlaces', FALSE
                    ,'A high octane FPS cavalcade for the distinguished gamer.'
                    ,array('Anomic Games')
                    ,array('Anomic Games')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DOTA2' ,'Dota 2' ,'DOTA2' ,NULL
                    ,'https://www.dota2.com/' ,'https://en.wikipedia.org/wiki/Dota_2' ,'Source2', FALSE //Was: Source
                    ,'Every day, millions of players worldwide enter the battle as one of over a hundred Dota Heroes in a 5v5 team clash.'
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DOTAU' ,'Dota Underlords' ,'DOTAU' ,NULL
                    ,'https://www.underlords.com/' ,'https://en.wikipedia.org/wiki/Dota_Underlords' ,'Source2', FALSE
                    ,'Your heroes are ready for hire.'
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'DL3D' ,'Dragon\'s Lair 3D: Return to the Lair' ,'DL3D' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Dragon%27s_Lair_3D:_Return_to_the_Lair' ,'G3D', FALSE
                    ,'Dare to Enter the Lair!'
                    ,array('Dragonstone Software')
                    ,array('Ubisoft') #Ubi Soft Entertainment, Inc.
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'DYS' ,'Dystopia' ,'DYS' ,NULL
                    ,'https://dystopia-game.com/' ,'https://en.wikipedia.org/wiki/Dystopia_(video_game)' ,'Source', FALSE
                    ,'Dystopia is a cyberpunk themed total conversion of Half Life 2, created by an amateur development team and released to the public for free.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/ //Mod for Half-Life 2
$Games[] = new cGame(NULL ,'EWSOL' ,'Eternal War: Shadows of Light' ,'EWSOL' ,NULL
                    ,NULL ,NULL ,'Quake 1', TRUE
                    ,'Eternal War: Shadows of Light is a first person shooter released in 2002 for Windows PC by Two Guys Software.'
                    ,array('Two Guys Software')
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'EC' ,'Ethnic Cleansing' ,'EC' ,NULL
                    ,'http://www.resistance.com/ethniccleansing/' ,'https://en.wikipedia.org/wiki/Ethnic_Cleansing_(video_game)' ,'G3D', FALSE
                    ,NULL
                    ,array('National Alliance')
                    ,array('Resistance Records')
                    ,NULL
                    );*/ //No, we're not interested in supporting this one.
$Games[] = new cGame(NULL ,'EBB' ,'Extreme Boards & Blades' ,'EBB' ,NULL
                    ,NULL ,NULL ,'G3D', FALSE
                    ,NULL
                    ,array('Silverfish Studios')
                    ,array('Head Games')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'EP2' ,'Extreme PaintBrawl 2' ,'EP2' ,'ep2.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Extreme_Paintbrawl_2' ,'G3D', TRUE
                    ,NULL
                    ,array('Hoplite Research')
                    ,array('Head Games')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'EYE' ,'E.Y.E.: Divine Cybermancy' ,'EYE' ,NULL
                    ,'http://eye.streumon-studio.com/' ,'https://en.wikipedia.org/wiki/E.Y.E.:_Divine_Cybermancy' ,'Source', FALSE
                    ,'After an unending war with the metastreumonic Force, the powerful organization Secreta Secretorum you belong to is finally ready to undermine the head-strong federation, despite an intense struggle for power.'
                    ,array('Streum On Studio')
                    ,array('Streum On Studio')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'FDNY' ,'F.D.N.Y. Firefighter: American Hero' ,'FDNY' ,NULL
                    ,NULL ,NULL ,'G3D', FALSE
                    ,NULL
                    ,array('Mekada')
                    ,array('Activision Value')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'FOF' ,'Fistful of Frags' ,'FOF' ,'fof.png'
                    ,'https://fistful-of-frags.com/' ,'https://en.wikipedia.org/wiki/Fistful_of_Frags' ,'Source', FALSE
                    ,'Fistful of Frags is a classic death match FPS game with a wild west theme.'
                    ,array('Fistful of Frags Team')
                    ,array('Fistful of Frags Team')
                    ,NULL
                    ); //Was a HL2 mod, but now standalone.
$Games[] = new cGame(NULL ,'FL' ,'Force: Leashed' ,'FL' ,NULL
                    ,NULL ,NULL ,'DarkPlaces', FALSE #http://www.kepuli.com/force_leashed/
                    ,'Force: Leashed is a free first person gravity fiddler.'
                    ,array('Kepuli')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'GM' ,"Garry's Mod" ,'GM' ,'gm.png'
                    ,'https://gmod.facepunch.com/' ,'https://en.wikipedia.org/wiki/Garry%27s_Mod' ,'Source', FALSE
                    ,"Garry's Mod is a physics sandbox."
                    ,array('Facepunch')
                    ,array('Valve')
                    ,NULL
                    );
$Games[] = new cGame('640a1' ,'G3D' ,'Genesis 3D' ,'G' ,'genesis.gif'
                    ,'http://www.genesis3d.com/', 'https://en.wikipedia.org/wiki/Genesis3D', 'G3D', FALSE
                    ,'Genesis3D is a real-time 3D rendering environment for all of your real-time 3D needs.'
                    ,array('Eclipse')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'GB' ,'Gravity Bone' ,'GB' ,'gb.png'
                    ,NULL, 'https://en.wikipedia.org/wiki/Gravity_Bone', 'Quake 2', FALSE
                    ,'A first-person short story. Prequel to Thirty Flights of Loving.'
                    ,array('Blendo')
                    ,array('Blendo')
                    ,NULL
                    );
$Games[] = new cGame('630' ,'GC' ,'Gunman Chronicles' ,'GC' ,'gc.gif'
                    ,NULL, 'https://en.wikipedia.org/wiki/Gunman_Chronicles', 'GoldSrc', FALSE
                    ,'An Intensely Addictive Action Experience Powered by the Half-Life Engine!'
                    ,array('Rewolf Software')
                    ,array('Sierra Studios')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'GS' ,'G-sector' ,'GS' ,NULL
                    ,NULL, NULL, 'G3D', FALSE
                    ,NULL
                    ,array('Freeform Interactive')
                    ,array('Freeform Interactive')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'GSTR' ,'G String' ,'GSTR' ,NULL
                    ,'https://gstring.lunchhouse.software/', NULL, 'Source', FALSE
                    ,'Slip into the Standard Issue Biosuit as Myo Hyori, a gifted Korean teenage girl who must face the perils of the future.'
                    ,array('Eyaura')
                    ,array('LunchHouse')
                    ,NULL
                    );
$Games[] = new cGame('53' ,'HL' ,'Half-Life' ,'HL' ,'halflife.gif'
                    ,'https://www.half-life.com/halflife' ,'https://en.wikipedia.org/wiki/Half-Life_(video_game)' ,'GoldSrc', FALSE
                    ,'Run. Think. Shoot. Live.'
                    ,array('Valve')
                    ,array('Sierra Studios' ,'EA')
                    ,array('EA')
                    );
$Games[] = new cGame('600b1','HLOF' ,'Half-Life: Opposing Force' ,'HLOF' ,'halflifeof.gif' //FIXME: 600b1 is a guess!
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life:_Opposing_Force' ,'GoldSrc', FALSE #http://www.sierrastudios.com/games/opposingforce/
                    ,'Your mission: eliminate Gordon Freeman.'
                    ,array('Gearbox', 'Valve')
                    ,array('Sierra Studios')
                    ,NULL
                    ,'HL');
$Games[] = new cGame('630','HLBS' ,'Half-Life: Blue Shift' ,'HLBS' ,'halflifebs.gif' //FIXME: 630 is a guess!
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life:_Blue_Shift' ,'GoldSrc', FALSE
                    ,'Two new episodes for "the best PC game ever".'
                    ,array('Gearbox', 'Valve')
                    ,array('Sierra Entertainment') #Sierra On-Line
                    ,NULL
                    ,'HL');
/*$Games[] = new cGame(NULL ,'HLHT' ,'Half-Life: Hostile Takeover' ,'HLHT' ,NULL
                    ,NULL ,NULL ,'GoldSrc', FALSE    https://en.wikipedia.org/wiki/Unreleased_Half-Life_games#Half-Life:_Hostile_Takeover
                    ,NULL
                    ,array('2015')
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
/*$Games[] = new cGame(NULL ,'HLD' ,'Half-Life: Decay' ,'HLD' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life:_Decay' ,'GoldSrc', FALSE
                    ,NULL
                    ,array('Gearbox')
                    ,array('Sierra Entertainment') #Sierra On-Line
                    ,NULL
                    ,'HL');*/ //Incompatible platform
$Games[] = new cGame('660b8' ,'HLS' ,'Half-Life: Source' ,'HLS' ,'halflife2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life:_Source' ,'Source', FALSE
                    ,'Half-Life: Source is a digitally remastered version of the critically acclaimed and best selling PC game, enhanced via Source technology to include physics simulation, enhanced effects, and more.'
                    ,array('Valve')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'HLDMS' ,'Half-Life Deathmatch: Source' ,'HLDMS' ,'halflife2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life_Deathmatch:_Source' ,'Source', FALSE
                    ,NULL
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );
$Games[] = new cGame('641a1' ,'HL2' ,'Half-Life 2' ,'HL2' ,'halflife2.gif'
                    ,'https://www.half-life.com/halflife2' ,'https://en.wikipedia.org/wiki/Half-Life_2' ,'Source', FALSE //http://half-life2.com/
                    ,'Freeman is thrust into the unenviable role of rescuing the world from the wrong he unleashed back at Black Mesa.'
                    ,array('Valve')
                    ,array('Sierra Entertainment' ,'Valve')
                    ,array('EA')
                    );
$Games[] = new cGame('660b5' ,'HL2EP1' ,'Half-Life 2: Episode 1' ,'HL2EP1' ,'halflife2.gif'
                    ,'https://www.half-life.com/episode1' ,'https://en.wikipedia.org/wiki/Half-Life_2:_Episode_One' ,'Source', FALSE
                    ,'Stepping into the hazard suit of Dr. Gordon Freeman, you face the immediate repercussions of your actions in City 17 and the Citadel.'
                    ,array('Valve')
                    ,array('Valve')
                    ,array('EA')
                    );
$Games[] = new cGame('660b5' ,'HL2EP2' ,'Half-Life 2: Episode 2' ,'HL2EP2' ,'halflife2.gif'
                    ,'https://www.half-life.com/episode2' ,'https://en.wikipedia.org/wiki/Half-Life_2:_Episode_Two' ,'Source', FALSE
                    ,'You must battle and race against Combine forces as you traverse the White Forest to deliver a crucial information packet stolen from the Citadel to an enclave of fellow resistance scientists.'
                    ,array('Valve')
                    ,array('Valve')
                    ,array('EA')
                    );
/*$Games[] = new cGame(NULL ,'HL2EP3' ,'Half-Life 2: Episode 3' ,'HL2EP3' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life_(series)#Episode_Three' ,'Source', FALSE
                    ,NULL
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame('641a1' ,'HL2DM' ,'Half-Life 2: Deathmatch' ,'HL2DM' ,'halflife2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life_2:_Deathmatch' ,'Source', FALSE
                    ,'Fast multiplayer action set in the Half-Life 2 universe!'
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'HL2LC' ,'Half-Life 2: Lost Coast' ,'HL2LC' ,'halflife2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life_2:_Lost_Coast' ,'Source', FALSE
                    ,'Originally planned as a section of the Highway 17 chapter of Half-Life 2, Lost Coast is a playable technology showcase that introduces High Dynamic Range lighting to the Source engine.'
                    ,array('Valve')
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'HL3' ,'Half-Life 3' ,'HL3' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Half-Life_3' ,'Source Engine 2', FALSE
                    ,NULL
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );*/ //Cancelled
/*$Games[] = new cGame(NULL ,'HLB' ,'Borealis' ,'HLB' ,NULL
                    ,NULL ,NULL ,'Source Engine 2', FALSE   https://en.wikipedia.org/wiki/Unreleased_Half-Life_games#Borealis
                    ,NULL
                    ,array('Valve')
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame(NULL ,'HLVR' ,'Half-Life: Alyx' ,'HLVR' ,NULL
                    ,'https://www.half-life.com/alyx' ,'https://en.wikipedia.org/wiki/Half-Life:_Alyx' ,'Source2', FALSE
                    ,'A VR Return To Half-Life.'
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );
$Games[] = new cGame('660b1' ,'FAKK' ,'Heavy Metal: F.A.K.K. 2' ,'FAKK2' ,'fakk2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Heavy_Metal:_F.A.K.K._2' ,'Quake 3', FALSE #http://www.ritual.com/FAKK2
                    ,'Sacrifice the body, not the heart.' #'In this Universe full of would-be Gods, the machines of man alone cannot change the call of Destiny.'
                    ,array('Ritual')
                    ,array('Gathering of Developers')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'HM' ,'HenchMan I' ,'HM' ,NULL
                    ,NULL ,NULL ,'G3D', FALSE
                    ,NULL
                    ,array('STS')
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'Hr' ,'Heretic' ,'H' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Heretic_(video_game)' ,'Doom', FALSE
                    ,NULL
                    ,array('Raven')
                    ,array('id')
                    ,array('GT')
                    );*/
/*$Games[] = new cGame(NULL ,'HrXP' ,'Heretic: Shadow of the Serpent Riders' ,'HXP' ,NULL
                    ,NULL ,NULL ,'Doom', FALSE
                    ,NULL
                    ,array('Raven')
                    ,array('id')
                    ,NULL
                    );*/
$Games[] = new cGame('52' ,'Hr2' ,'Heretic 2' ,'H2' ,'heretic2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Heretic_II' ,'Quake 2', TRUE
                    ,'Prepare for the second coming.'
                    ,array('Raven')
                    ,array('Activision')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'Hx' ,'Hexen' ,'Hx' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Hexen' ,'Doom', FALSE
                    ,'While you were battling the evil forces of D'Sparil, the other Serpent Riders were busy sowing the seeds of destruction in other dimensions.'
                    ,array('Raven')
                    ,array('id')
                    ,array('GT')
                    );*/
/*$Games[] = new cGame(NULL ,'HxXP' ,'Hexen: Deathkings of the Dark Citadel' ,'HxXP' ,NULL
                    ,NULL ,NULL ,'Doom', FALSE
                    ,NULL
                    ,array('Raven')
                    ,array('id')
                    ,NULL
                    );*/
$Games[] = new cGame('40' ,'Hx2' ,'Hexen 2' ,'Hx2' ,'hexen2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Hexen_II' ,'Quake 1', TRUE
                    ,'As the Necromancer, the Assassin, the Crusader or the Paladin, you must defeat the dark generals and their Hell-spawned legions before you can face the Archfiend and attempt to end his ravenous onslaught.'
                    ,array('Raven')
                    ,array('id')
                    ,array('Activision')
                    );
$Games[] = new cGame('54' ,'Hx2XP' ,'Hexen 2: Portal of Praevus' ,'Hx2XP' ,'hexen2.gif' //FIXME: Really: 5.0.b5
                    ,NULL ,'https://en.wikipedia.org/wiki/Hexen_II#Portal_of_Praevus' ,'Quake 1', TRUE
                    ,'Eidolon has been defeated. Evil has not.'
                    ,array('Raven')
                    ,array('Activision')
                    ,NULL
                    ,'Hx2');
/*$Games[] = new cGame(NULL ,'HoH' ,'Hordes of Hunger' ,'HoH' ,NULL
                    ,NULL ,NULL ,NULL, FALSE
                    ,'Hordes of Hunger is a fast-paced arena slasher set in a dark medieval realm.'
                    ,array('Hyperstrange')
                    ,array('Kwalee')
                    ,NULL
                    );*/ //Unknown game engine
$Games[] = new cGame(NULL ,'HDTF' ,'Hunt Down The Freeman' ,'HDTF' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Hunt_Down_the_Freeman' ,'Source', FALSE
                    ,'Hunt Down The Freeman takes you into a journey like no one has before. Witness the pain of the villain firsthand with over 14 hour gameplay, over 40 levels, immersive gameplay, cinematic cutscenes and an over an hour long, heart touching OST.'
                    ,array('Royal Rudius Entertainment')
                    ,array('Royal Rudius Entertainment')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'HB' ,'Hybrid' ,'HB' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Hybrid_(video_game)' ,'Source', FALSE #http://www.whatishybrid.com/
                    ,NULL
                    ,array('5th Cell')
                    ,array('Microsoft Studios')
                    ,NULL
                    );*/ //Incompatible platform
$Games[] = new cGame(NULL ,'IJGC' ,'Indiana Jones and the Great Circle' ,'IJGC' ,NULL
                    ,'https://indianajones.bethesda.net/' ,'https://en.wikipedia.org/wiki/Indiana_Jones_and_the_Great_Circle' ,'id Tech 7', FALSE
                    ,NULL
                    ,array('MachineGames')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'INFRA' ,'INFRA' ,'INFRA' ,NULL
                    ,'https://infragame.net/' ,'https://en.wikipedia.org/wiki/Infra_(video_game)' ,'Source', FALSE
                    ,NULL
                    ,array('Loiste')
                    ,array('Loiste')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'INSUR1' ,'Insurgency: Modern Infantry Combat' ,'INSUR1' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Insurgency:_Modern_Infantry_Combat' ,'Source', FALSE
                    ,NULL
                    ,array('Insurgency Development Team')
                    ,array('New World Interactive')
                    ,NULL
                    );* //Mod for Half-Life 2
$Games[] = new cGame(NULL ,'INSUR2' ,'Insurgency' ,'INSUR2' ,'insur2.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Insurgency_(video_game)' ,'Source', FALSE //http://www.playinsurgency.com/
                    ,'New World\'s debut game Insurgency is leading a revival of the tactical shooter genre.'
                    ,array('New World Interactive')
                    ,array('New World Interactive')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'INSUR3' ,'Insurgency: Modern Infantry Combat' ,'INSUR3' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Insurgency:_Sandstorm' ,'Unreal4', FALSE
                    ,NULL
                    ,array('New World Interactive')
                    ,array('Focus Home Interactive')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'IGW' ,'Iron Grip: Warlord' ,'IGW' ,'igw.png'
                    ,'http://www.igwarlord.com/' ,'https://en.wikipedia.org/wiki/Iron_Grip:_Warlord' ,'Quake 3', FALSE
                    ,'Grab your weapons and head to the battlefield in the debut commercial game from Isotx, Iron Grip: Warlord!'
                    ,array('Isotx')
                    ,array('Isotx')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'IRR' ,'Irrlicht 3D' ,'I' ,'irrlicht.png'
                    ,'http://irrlicht.sourceforge.net/' ,'https://en.wikipedia.org/wiki/Irrlicht_Engine' ,'IRR', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'JBNF' ,'James Bond 007: Nightfire' ,'JBN' ,'nightfire.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/James_Bond_007:_Nightfire' ,'GoldSrc', TRUE
                    ,'Do you have what it takes to be Bond?'
                    ,NULL
                    ,array('EA' ,'MGM')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'QoF' ,'Quantum of Solace' ,'QOF' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/007:_Quantum_of_Solace' ,'IW3', FALSE #http://007thevideogame.com/
                    ,'Bond is back.'
                    ,array('Beenox')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('600b1' ,'KP' ,'Kingpin: Life of Crime' ,'KP' ,'kingpin.gif' //FIXME: Actually, 5.11qta
                    ,NULL ,'https://en.wikipedia.org/wiki/Kingpin:_Life_of_Crime' ,'Quake 2', FALSE
                    ,'Start your own gang and recruit right from the streets.'
                    ,array('Xatrix')
                    ,array('Interplay')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'KPR' ,'Kingpin: Reloaded' ,'KPR' ,NULL
                    ,'https://3drealms.com/games/kingpin-reloaded/' ,'https://en.wikipedia.org/wiki/Kingpin:_Reloaded' ,'Unity', FALSE
                    ,'In a stylized noir art deco gangland that never was, the Kingpin rules above all else with a bloody fist.'
                    ,array('Slipgate Ironworks')
                    ,array('3D Realms')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'KB' ,'Kingsborn' ,'KB' ,NULL
                    ,NULL ,NULL ,'G3D', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'KW' ,'Kuma\\War' ,'KW' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Kuma%5CWar' ,'Source', FALSE #http://www.kumawar.com/
                    ,NULL
                    ,array('Kuma Reality Games')
                    ,array('Kuma Reality Games')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'LASER' ,'Laser Arena' ,'LASER' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Laser_Arena' ,'Quake 1', FALSE
                    ,'The ultimate lasertag experience.'
                    ,array('Trainwreck')
                    ,array('ValuSoft')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'L4D' ,'Left 4 Dead' ,'L4D' ,'l4d.png'
                    ,'https://www.l4d.com/' ,'https://en.wikipedia.org/wiki/Left_4_Dead' ,'Source', FALSE
                    ,'Can you survive the zombie apocalypse?'
                    ,array('Valve')
                    ,array('Valve')
                    ,array('EA')
                    );
$Games[] = new cGame(NULL ,'L4D2' ,'Left 4 Dead 2' ,'L4D2' ,'l4d2.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Left_4_Dead_2' ,'Source', FALSE
                    ,'New friends. More zombies. Better apocalypse.'
                    ,array('Valve')
                    ,array('Valve')
                    ,array('EA')
                    );
/*$Games[] = new cGame(NULL ,'L4D3' ,'Left 4 Dead 3' ,'L4D3' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Left_4_Dead_3' ,'Source Engine 2', FALSE
                    ,NULL
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame(NULL ,'MAL' ,'Malice' ,'MAL' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Malice_(1997_video_game)' ,'Quake 1', FALSE #http://www.qamalice.com
                    ,'23rd century ultraconversion for Quake.'
                    ,array('Ratloop')
                    ,array('QuantumAxcess')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'MB' ,'Marble Blast' ,'MB' ,'mb.png' #Was renamed to Marble Blast Gold later
                    ,NULL ,'https://en.wikipedia.org/wiki/Marble_Blast' ,'TGE', FALSE
                    ,'Fast-Paced Marble Rolling Action!' //Guessed from a low-res image
                    ,array('GarageGames')
                    ,array('Monster')
                    ,NULL
                    );
//https://en.wikipedia.org/wiki/Medal_of_Honor_(1999_video_game) //Incompatible platform
//https://en.wikipedia.org/wiki/Medal_of_Honor:_Underground //Incompatible platform
$Games[] = new cGame('630' ,'MOHAA' ,'Medal of Honor: Allied Assault' ,'MOHAA' ,'mohaa.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Medal_of_Honor:_Allied_Assault' ,'Quake 3', TRUE #with Ritual's custom SDK
                    ,'You don\'t play, you volunteer.'
                    ,array('2015')
                    ,array('EA')
                    ,NULL
                    );
$Games[] = new cGame('630' ,'MOHAAB' ,'Medal of Honor: Allied Assault: Breakthrough' ,'MOHAAB' ,'mohaab.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Medal_of_Honor:_Allied_Assault_Breakthrough' ,'Quake 3', TRUE #with Ritual's custom SDK
                    ,'You are here to fight.'
                    ,array('TKO')
                    ,array('EA')
                    ,NULL
                    ,'MOHAA');
$Games[] = new cGame('630' ,'MOHAAS' ,'Medal of Honor: Allied Assault: Spearhead' ,'MOHAAS' ,'mohaas.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Medal_of_Honor:_Allied_Assault_Spearhead' ,'Quake 3', TRUE #with Ritual's custom SDK
                    ,'You don\'t play, you volunteer.'
                    ,array('EALA')
                    ,array('EA')
                    ,NULL
                    ,'MOHAA');
//https://en.wikipedia.org/wiki/Medal_of_Honor:_Rising_Sun //Incompatible platform
//https://en.wikipedia.org/wiki/Medal_of_Honor:_Infiltrator //Incompatible platform
$Games[] = new cGame(NULL ,'MOHPA' ,'Medal of Honor: Pacific Assault' ,'MOHPA' ,'mohpa.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Medal_of_Honor:_Pacific_Assault' ,'Quake 3', TRUE #with Ritual's custom SDK
                    ,'Fight for Victory in the Pacific.'
                    ,array('2015' ,'TKO')
                    ,array('EA')
                    ,NULL
                    );
//https://en.wikipedia.org/wiki/Medal_of_Honor:_European_Assault //Incompatible platform
//https://en.wikipedia.org/wiki/Medal_of_Honor:_Heroes //Incompatible platform
//https://en.wikipedia.org/wiki/Medal_of_Honor:_Vanguard //Incompatible platform
/*$Games[] = new cGame(NULL ,'MOHA' ,'Medal of Honor: Airborne' ,'MOHA' ,'moha.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Medal_of_Honor:_Airborne' ,'Unreal Engine 3', FALSE
                    ,'Heroes jump. Enemies fall.'
                    ,array('EALA')
                    ,array('EA')
                    ,NULL
                    );*/
//https://en.wikipedia.org/wiki/Medal_of_Honor:_Heroes_2 //Incompatible platform
//https://en.wikipedia.org/wiki/Medal_of_Honor_(2010_video_game) //Unreal Engine 3 (Frostbite 1.5 for multiplayer)
//https://en.wikipedia.org/wiki/Medal_of_Honor:_Warfighter //Frostbite 2
//https://en.wikipedia.org/wiki/Medal_of_Honor%3A_Above_and_Beyond //Unreal Engine
$Games[] = new cGame(NULL ,'NZP' ,'Nazi Zombies: Portable' ,'NZP' ,'nzp.png'
                    ,'https://github.com/nzp-team/nzportable' ,NULL ,'Quake 1', TRUE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'NC' ,'Neocron' ,'NC' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Neocron' ,'G3D', FALSE
                    ,NULL
                    ,array('reakktor.com')
                    ,array('CDV Software Entertainment')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'NC2' ,'Neocron 2: Beyond Dome of York' ,'NC2' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Neocron_2:_Beyond_Dome_of_York' ,'G3D', FALSE
                    ,NULL
                    ,array('reakktor.com')
                    ,array('10tacle Studios')
                    ,NULL
                    );*/ //FIXME: Probably same engine as 1
//https://en.wikipedia.org/wiki/NeoTokyo_(video_game) HL2mod
$Games[] = new cGame(NULL ,'NB' ,'Neverball' ,'NB' ,'neverball.png'
                    ,'https://neverball.org/' ,'https://en.wikipedia.org/wiki/Neverball' ,NULL, FALSE
                    ,'Tilt the floor to roll a ball through an obstacle course before time runs out.'
                    ,array('Robert Kooima')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'NP' ,'Neverputt' ,'NP' ,'neverputt.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Neverputt' ,NULL, FALSE
                    ,'A hot-seat multiplayer miniature golf game, built on the physics and graphics engine of Neverball.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame('660b1' ,'NEX' ,'Nexuiz' ,'N' ,'nexuiz.gif'
                    ,'http://www.alientrap.org/games/nexuiz' ,'https://en.wikipedia.org/wiki/Nexuiz' ,'DarkPlaces', FALSE #http://www.nexuiz.com/
                    ,'Nexuiz is fast paced with extremely competitive game play.'
                    ,array('Alientrap')
                    ,array('Alientrap')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'NMRIH' ,'No More Room in Hell' ,'NMRIH' ,'nmrih.png'
                    ,'https://www.nomoreroominhell.com/' ,'https://en.wikipedia.org/wiki/No_More_Room_in_Hell' ,'Source', FALSE
                    ,'No More Room in Hell is the ultimate ruthless and unforgiving co-operative zombie survival experience on the Source Engine, delivering award winning survival horror gameplay with dozens of weapons and multiple game modes.'
                    ,array('No More Room in Hell Team')
                    ,array('Lever Games')
                    ,NULL
                    ); //Was a HL2 mod, but now standalone.
/*$Games[] = new cGame(NULL ,'NMRIH2' ,'No More Room In Hell 2' ,'NMRIH2' ,NULL
                    ,'https://www.nmrih2.com' ,'https://en.wikipedia.org/wiki/No_More_Room_in_Hell_2' ,'Unreal4', FALSE
                    ,'Survive together or die alone.'
                    ,array('Lever Games')
                    ,array('Lever Games')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'NOS' ,'Nosferatu' ,'NOS' ,'nos.png'
                    ,NULL ,NULL ,'Qfusion', FALSE #http://www.nosferatuthegame.com/ #https://web.archive.org/web/20190119160909/http://www.nosferatuthegame.com/ #https://www.moddb.com/games/nosferatu/ ?
                    ,'Nosferatu is a teambased multiplayer first person shooter.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'ND' ,'Nuclear Dawn' ,'ND' ,'nd.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Nuclear_Dawn' ,'Source', FALSE #http://www.nucleardawnthegame.com/
                    ,'Nuclear Dawn is the first game to offer a full FPS and RTS experience, within a single gameplay model, without crippling or diluting either side of the game.'
                    ,array('InterWave')
                    ,array('Iceberg')
                    ,NULL
                    ); //Was a HL2(?) mod, but now standalone.
$Games[] = new cGame(NULL ,'OH' ,'Ominous Horizons: A Paladin\'s Calling' ,'OH' ,'oh.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Ominous_Horizons:_A_Paladin%27s_Calling' ,'G3D', FALSE #http://www.catechumen.com/ominoushorizons.htm ???
                    ,'Ominous Horizons is a fast-paced action adventure Christian computer game that takes you on a fantastic journey across ancient landscapes in an effort to recover Gutenberg\'s first printed Bible.'
                    ,array('N\'Lightning Software Development')
                    ,array('N\'Lightning Software Development')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'OA' ,'Open Arena' ,'OA' ,'oa.gif'
                    ,'http://openarena.ws/' ,'https://en.wikipedia.org/wiki/OpenArena' ,'ioquake3', FALSE
                    ,'OpenArena is a violent, sexy, multiplayer first person shooter based on the ioquake3 fork of the id tech 3 engine.'
                    ,array('OpenArena')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'OSI' ,'Project::OSiRiON' ,'OSI' ,'osi.png'
                    ,'http://osirion.org/' ,NULL ,NULL, FALSE
                    ,'Project::OSiRiON is a free space trading and combat simulation under development.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'PBP' ,'Project Borealis: Prologue' ,'PBP' ,NULL
                    ,NULL ,NULL ,'Unreal5', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'OD' ,'OverDose' ,'OD' ,'od.png'
                    ,'https://overdose-game.com/' ,NULL ,'Quake 2', TRUE //Creator: "We essentially have a mixture of our own engine that has roots in id tech. I mean it IS id tech, but we have changed so much."
                    ,'The Fight For Survival Is On!'
                    ,array('Team Blur Games')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'PB2' ,'Paintball 2' ,'PB2' ,'pb2.png'
                    ,'http://www.digitalpaint.org/' ,NULL ,'Quake 2', FALSE #https://sourceforge.net/projects/paintball2/
                    ,'Paintball2 is a fast-paced first-person game with capture the flag, elimination, siege, and deathmatch (free-for-all) styles of gameplay.' #Or: 'With its high-value team objectives, limited range projectiles, and intense maneuvering, Paintball 2 offers a very unique experience that will appeal to both hardcore and novice players.'
                    ,array('Digital Paint')
                    ,NULL
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'PW' ,'Perilous Warp' ,'PW' ,NULL
                    ,'https://crystice.com/perilous-warp/' ,NULL ,'Volatile', FALSE
                    ,'Perilous Warp is a fast-paced indie retro-shooter inspired by the classic 3D-actions.'
                    ,array('Crystice')
                    ,array('Crystice')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame('660b4' ,'P' ,'Portal' ,'P' ,'portal.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Portal_(video_game)' ,'Source', FALSE
                    ,'The new single player game from Valve blends adventure, puzzle and action gaming.'
                    ,array('Valve')
                    ,array('Valve')
                    ,array('EA')
                    );
$Games[] = new cGame(NULL ,'P2' ,'Portal 2' ,'P2' ,'portal2.png'
                    ,'https://www.thinkwithportals.com/' ,'https://en.wikipedia.org/wiki/Portal_2' ,'Source', FALSE
                    ,'Start thinking with portals.'
                    ,array('Valve')
                    ,NULL
                    ,NULL
                    );
//https://en.wikipedia.org/wiki/Portal_Stories:_Mel Portal 2 mod
//FIXME: https://en.wikipedia.org/wiki/Postal_III
$Games[] = new cGame('660b1' ,'PREY' ,'Prey' ,'PREY' ,'prey.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Prey_(2006_video_game)' ,'Doom 3', TRUE //http://www.prey.com/
                    ,'We are next.'
                    ,array('Human Head')
                    ,array('2K', '3D Realms')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'PREY2' ,'Prey 2' ,'PREY2' ,NULL
                    ,'http://humanhead.com/games-prey2.html' ,'https://en.wikipedia.org/wiki/Prey_2' ,NULL, FALSE
                    ,NULL
                    ,array('Human Head')
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
/*$Games[] = new cGame(NULL ,'PREY2' ,'Prey' ,'PREY2' ,NULL
                    ,'https://prey.bethesda.net/' ,'https://en.wikipedia.org/wiki/Prey_(2017_video_game)' ,NULL, FALSE
                    ,NULL
                    ,array('Arkane')
                    ,array('Bethesda')
                    ,NULL
                    );*/ //CryEngine
$Games[] = new cGame(NULL ,'PP' ,'Prospekt' ,'PP' ,NULL
                    ,'http://prospektgame.com/' ,'https://en.wikipedia.org/wiki/Prospekt_(video_game)' ,'Source', FALSE
                    ,'Gordon Freeman is slowly being overrun by soldiers in the prison, however unknown to him, his Vortigaunt allies manage to find some help from a forgotten hero.'
                    ,array('SCT')
                    ,array('SCT')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'QCow' ,'Quadrilateral Cowboy' ,'QCow' ,NULL
                    ,'https://blendogames.com/qc/' ,'https://en.wikipedia.org/wiki/Quadrilateral_Cowboy' ,'Doom 3', FALSE
                    ,NULL
                    ,array('Blendo')
                    ,array('Blendo')
                    ,NULL
                    );
$Games[] = new cGame('10' ,'Q1' ,'Quake' ,'Q1' ,'quake1.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake_(video_game)' ,'Quake 1', FALSE
                    ,'From the creators of Doom and Doom II comes the most intense, technologically advanced 3-D experience ever captured on CD-ROM.'
                    ,array('id')
                    ,array('GT')
                    ,NULL
                    );
$Games[] = new cGame('660b5' ,'Q1XP1' ,'Quake Mission Pack 1: Scourge of Armagon' ,'Q1XP1' ,'q1xp1.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Scourge_of_Armagon' ,'Quake 1', FALSE
                    ,'Without any hesitation, and with more guns than common sense, you leap into a portal of unknown destination.'
                    ,array('Hipnotic')
                    ,array('id')
                    ,NULL
                    ,'Q1');
$Games[] = new cGame('641a1' ,'Q1XP2' ,'Quake Mission Pack 2: Dissolution of Eternity' ,'Q1XP2' ,'q1xp2.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Dissolution_of_Eternity' ,'Quake 1', FALSE
                    ,'Two new episodes. Sixteen new levels. One way out.'
                    ,array('Rogue')
                    ,array('id')
                    ,NULL
                    ,'Q1');
$Games[] = new cGame(NULL ,'Q1XP3' ,'Quake: Dimension of the Past' ,'Q1XP3' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake:_Dimension_of_the_Past' ,'Quake 1', FALSE
                    ,NULL
                    ,array('MachineGames')
                    ,NULL
                    ,NULL
                    ,'Q1');
$Games[] = new cGame(NULL ,'Q1XP4' ,'Quake: Dimension of the Machine' ,'Q1XP4' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake:_Dimension_of_the_Machine' ,'Quake 1', FALSE
                    ,NULL
                    ,array('MachineGames')
                    ,NULL
                    ,NULL
                    ,'Q1');
/*$Games[] = new cGame(NULL ,'Q1TO' ,'Quake: The Offering' ,'Q1TO' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake:_The_Offering' ,'Quake 1', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/ //Incompatible platform
$Games[] = new cGame(NULL ,'QEX' ,'Quake Enhanced' ,'QEX' ,NULL
                    ,NULL ,NULL ,'KEX', FALSE
                    ,NULL
                    ,array('id', 'Nightdive Studios', 'MachineGames')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame('406' ,'Q2' ,'Quake 2' ,'Q2' ,'quake2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake_II' ,'Quake 2', FALSE
                    ,'Shortly after landing on an alien surface you learn that hundreds of your men have been reduced to just a few.'
                    ,array('id')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('61c' ,'Q2TR' ,'Quake 2: The Reckoning' ,'Q2TR' ,'q2xp1.png' //FIXME: 61c is a guess!
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake_II:_The_Reckoning' ,'Quake 2', FALSE
                    ,'You are part of an elite commando force that must infiltrate a hostile alien city.'
                    ,array('Xatrix')
                    ,NULL
                    ,NULL
                    ,'Q2');
$Games[] = new cGame('61c' ,'Q2GZ' ,'Quake 2: Ground Zero' ,'Q2GZ' ,'q2xp2.png' //FIXME: 61c is a guess!
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake_II:_Ground_Zero' ,'Quake 2', FALSE
                    ,'Take out the Big Gun sounded simple enough, except the Strogg were waiting.'
                    ,array('Rogue')
                    ,NULL
                    ,NULL
                    ,'Q2');
$Games[] = new cGame(NULL ,'Q2NP1' ,'Quake 2: Netpack I: Extremities' ,'Q2NP1' ,NULL
                    ,NULL ,NULL ,'Quake 2', FALSE
                    ,'Handpicked Multiplayer MODs from around the Web.'
                    ,NULL
                    ,NULL
                    ,NULL
                    ,'Q2');
/*$Games[] = new cGame(NULL ,'Q2C' ,'Quake II: Colossus' ,'Q2C' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake_II:_Colossus' ,'Quake 2', FALSE
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/ //Incompatible platform
$Games[] = new cGame(NULL ,'Q2EX' ,'Quake II Enhanced' ,'Q2EX' ,NULL
                    ,NULL ,NULL ,'KEX', FALSE
                    ,NULL
                    ,array('id', 'Nightdive Studios', 'MachineGames')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame('600b1' ,'Q3A' ,'Quake 3: Arena' ,'Q3A' ,'quake3.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake_III_Arena' ,'Quake 3', FALSE //http://www.quake3arena.com/
                    ,'Your only company, a mantra: Fight or be finished.'
                    ,array('id')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('620a' ,'Q3TA' ,'Quake 3: Team Arena' ,'Q3TA' ,'quake3ta.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake_III:_Team_Arena' ,'Quake 3', FALSE
                    ,'Never before have the forces aligned.'
                    ,NULL
                    ,NULL
                    ,NULL
                    ,'Q3A');
$Games[] = new cGame('650a7' ,'Q4' ,'Quake 4' ,'Q4' ,'quake4.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Quake_4' ,'Doom 3', FALSE //http://www.quake4game.com/
                    ,'In a desperate war for Earth\'s survival, against an unrelenting alien enemy, the only way to defeat them is to become one of them.'
                    ,array('Raven', 'id')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'QC' ,'Quake Champions' ,'QC' ,'qc.png'
                    ,'https://quake.bethesda.net/', 'https://en.wikipedia.org/wiki/Quake_Champions' ,'id Tech 6', TRUE
                    ,'The fast, skill-based arena-style competition that turned the original Quake games into multiplayer legends is making a triumphant return with Quake Champions.'
                    ,array('id', 'Saber Interactive')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'QL' ,'Quake Live' ,'QL' ,'quakelive.gif'
                    ,'https://www.quakelive.com/', 'https://en.wikipedia.org/wiki/Quake_Live' ,'Quake 3', TRUE
                    ,'This is where you can connect and compete with your friends and other players from around the world in the hottest first person multiplayer game on the web.'
                    ,array('id')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'ETQW' ,'Enemy Territory: QUAKE Wars' ,'QW' ,'quakewars.gif'
                    ,'https://www.splashdamage.com/games/enemy-territory-quake-wars/', 'https://en.wikipedia.org/wiki/Enemy_Territory:_Quake_Wars' ,'Doom 3', TRUE #with MegaTexture technology #http://www.enemyterritory.com/
                    ,'Defend Earth or destroy it. You make the difference.'
                    ,array('Splash Damage' ,'id')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'QUE' ,'Quetoo' ,'QUE' ,'quetoo.png'
                    ,'http://quetoo.org/', NULL ,'Quake 2', TRUE //Engine was: Quake2World
                    ,'Pwning nubz one rail slug at a time.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'RAGE' ,'Rage' ,'R' ,'rage.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Rage_(video_game)' ,'id Tech 5', FALSE   #Was: http://www.rage-game.com/ #And then: http://www.rage.com/
                    ,'From the makers of Doom and Quake.'
                    ,array('id')
                    ,array('Bethesda')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'RAGE2' ,'Rage 2' ,'R2' ,NULL
                    ,'https://bethesda.net/game/rage2/' ,'https://en.wikipedia.org/wiki/Rage_2' ,'Apex', FALSE
                    ,NULL
                    ,array('Avalanche Studios', 'id')
                    ,array('Bethesda')
                    ,NULL
                    );*/ //Incompatible engine
/*$Games[] = new cGame(NULL ,'RTR' ,'Return to Ravenholm' ,'RTR' ,NULL
                    ,NULL ,NULL ,'Source', FALSE    https://en.wikipedia.org/wiki/Unreleased_Half-Life_games#Junction_Point_Studios_episode   https://en.wikipedia.org/wiki/Ravenholm#Cancelled_projects
                    ,NULL
                    ,array('Junction Point', 'Arkane')   Junction Point Studios
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame(NULL ,'REACT' ,'Reaction' ,'REACT' ,'react.png'
                    ,'https://www.rq3.com/' ,NULL ,'ioquake3', TRUE
                    ,'Reaction is a free online shooter and a remake of the legendary Quake 2 modification AQ2.'
                    ,array('Boomstick')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'RB' ,'RetroBlazer' ,'RB' ,NULL
                    ,NULL ,NULL ,'DarkPlaces', FALSE #http://www.retroblazer.com/
                    ,'In RetroBlazer you play as trainee warrior Jonas, former member of the ARK City protection unit, the GunBlazers.'
                    ,array('Hydra Game Works')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame('630' ,'RTCW' ,'Return to Castle Wolfenstein' ,'RTCW' ,'rtcw.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Return_to_Castle_Wolfenstein' ,'Quake 3', FALSE #castlewolfenstein.com #http://www.activision.com/games/wolfenstein #http://games.activision.com/games/wolfenstein/
                    ,'Wolfenstein, the legacy lives on!'
                    ,array('id', 'Gray Matter', 'Nerve')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('630' ,'RTCW-ET' ,'Wolfenstein: Enemy Territory' ,'RTCWET' ,'rtcw-et.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Wolfenstein:_Enemy_Territory' ,'Quake 3', FALSE #http://games.activision.com:80/games/wolfenstein/index.asp?section=et/
                    ,'Introducing a totally new gameplay style and a distinctive arsenal of features, Wolfenstein: Enemy Territory enlists solo players to command an elite allied squad in a series of single player campaigns; then take the frontlines online in epic Axis versus Allies multiplayer warfare.'
                    ,array('Splash Damage')
                    ,array('Activision')
                    ,NULL
                    );
//FIXME: Revelations 2012 (Dark Artz Entertainment)???
$Games[] = new cGame(NULL ,'REX' ,'Rexuiz' ,'REX' ,NULL
                    ,'https://rexuiz.com/' ,NULL ,'DarkPlaces', TRUE #https://rexuiz.top/
                    ,"Don't know how to spend your free time on the computer?"
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame('660b7' ,'RICO' ,'Ricochet' ,'RICO' ,'ricochet.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Ricochet_(2000_video_game)' ,'GoldSrc', FALSE
                    ,'A futuristic action game that challenges your agility as well as your aim, Ricochet features one-on-one and team matches played in a variety of futuristic battle arenas.'
                    ,array('Valve')
                    ,array('Valve')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'Sev' ,'Severity' ,'Sev' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Severity_(video_game)' ,'Quake 3', FALSE
                    ,NULL
                    ,array('Escalation')
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame(NULL ,'SHRAK' ,'SHRAK' ,'SHRAK' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Shrak' ,'Quake 1', FALSE #http://www.shrak.com/shrak.html
                    ,'the first TOTAL conversion of QUAKE'
                    ,array('QuantumAxcess')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'SW' ,'Silver Wings' ,'SW' ,NULL
                    ,NULL ,NULL ,'Quake 1', FALSE #http://www.bampusht.ro/sw //FIXME: "Silver Wings uses a heavily modified version of Telejano v7"
                    ,'"Silver Wings" is a classic arcade game in the style of Tyrian or Raptor.'
                    ,array('Bampusht')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame('53' ,'SIN' ,'SiN' ,'SIN' ,'sin.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/SiN' ,'Quake 2', TRUE
                    ,'When the CEO of SinTEK Industries begins injecting the streets with a DNA-altering drug, it\'s time to reassess the laws of morality.'
                    ,array('Ritual')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'SINXP' ,'SiN: Wages of Sin' ,'SINXP' ,'wos.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/SiN:_Wages_of_Sin' ,'Quake 2', TRUE
                    ,'Deadly new ways to SiN: seventeen new missions, twelve new enemies, seven new weapons.'
                    ,array('2015')
                    ,array('Activision')
                    ,NULL
                    ,'SIN');
$Games[] = new cGame(NULL ,'SINEM' ,'SiN: Emergence' ,'SINEM' ,'sinemergence.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/SiN_Episodes' ,'Source', FALSE
                    ,'For years you have waged a personal crusade against the wicked geneticist Elexis Sinclaire.'
                    ,array('Ritual')
                    ,array('Valve')
                    ,array('EA Distribution')
                    );
/*$Games[] = new cGame(NULL ,'SIN2' ,'SiN 2' ,'SIN2' ,NULL
                    ,NULL ,NULL ,NULL, FALSE
                    ,NULL
                    ,array('Ritual')
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
/*$Games[] = new cGame(NULL ,'SING' ,'SiN: Gold' ,'SING' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/SiN:_Gold' ,'Quake 2', TRUE
                    ,NULL
                    ,array('id', 'Nightdive Studios', 'MachineGames')
                    ,array('3D Realms')
                    ,NULL
                    );*/ //Just a re-release
/*$Games[] = new cGame(NULL ,'SINR' ,'SiN: Reloaded' ,'SINR' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/SiN:_Reloaded' ,'KEX', FALSE
                    ,NULL
                    ,array('Nightdive Studios')
                    ,NULL
                    ,NULL
                    );*/ //Cancelled?
$Games[] = new cGame('660b5' ,'SG' ,'Smokin\' Guns' ,'SM' ,'sg.png'
                    ,'https://www.smokin-guns.org/' ,'https://en.wikipedia.org/wiki/Smokin%27_Guns' ,'ioquake3', FALSE #http://www.smokin-guns.net/
                    ,'With cordite in the air, splintered steel, shell casings and powder burns, there\'s only one explanation...., Smokin\' Guns.'
                    ,array('Smokin\' Guns', 'Iron Claw')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame('61c' ,'SOF' ,'Soldier of Fortune' ,'SoF' ,'sof.gif' //FIXME: Actually, some snapshot after 6.00 beta-1
                    ,NULL ,'https://en.wikipedia.org/wiki/Soldier_of_Fortune_(video_game)' ,'Quake 2', TRUE #with Raven's custom SDK
                    ,'Use any means necessary to find and secure four stolen nuclear warheads.'
                    ,array('Raven')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('630' ,'SOF2' ,'Soldier of Fortune 2: Double Helix' ,'SoF2' ,'sof2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Soldier_of_Fortune_II:_Double_Helix' ,'Quake 3', TRUE #with Raven's custom SDK
                    ,'The stakes are even higher in this heart-pounding sequel to the FPS hit!'
                    ,array('Raven') #'Gratuitous' (Xbox)
                    ,array('Activision')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'SoFP' ,'Soldier of Fortune: Payback' ,'SoF3' ,'sofp.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Soldier_of_Fortune:_Payback' ,'CloakNT3', FALSE
                    ,'Payback is hell!'
                    ,array('Cauldron HQ')
                    ,array('Activision Value')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'ST' ,'Space Trader' ,'ST' ,'spacetrader.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Space_Trader' ,'Quake 3', TRUE //http://www.playspacetrader.com/
                    ,NULL
                    ,array('HermitWorks')
                    ,array('HermitWorks')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'SF' ,'Special Force' ,'SF' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Special_Force_(2003_video_game)' ,'G3D', FALSE
                    ,NULL
                    ,array('Hezbollah')
                    ,array('Hezbollah')
                    ,NULL
                    );*/ //No, we're not interested in supporting this one.
$Games[] = new cGame('61c' ,'STVEF' ,'Star Trek: Voyager - Elite Force' ,'STVEF' ,'stvef.gif' #snapshot 2000-09-25, AFTER REL6_1-pre-2
                    ,NULL ,'https://en.wikipedia.org/wiki/Star_Trek:_Voyager_%E2%80%93_Elite_Force' ,'Quake 3', FALSE //http://www.ravensoft.com/eliteforce/
                    ,'Set phasers to frag.'
                    ,array('Raven')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('620a' ,'STVEFXP' ,'Star Trek: Voyager - Elite Force Expansion Pack' ,'STVEFXP' ,'stvef.gif' #FIXME: Or Q6.1?
                    ,NULL ,'https://en.wikipedia.org/wiki/Star_Trek:_Voyager_%E2%80%93_Elite_Force#Expansion_Pack_for_PC' ,'Quake 3', FALSE
                    ,'Set phasers to frag with the all-new Expansion Pack!'
                    ,array('Raven')
                    ,array('Activision')
                    ,NULL
                    ,'STVEF');
$Games[] = new cGame(NULL ,'STVEFHM' ,'Star Trek: Voyager Elite Force: Holomatch' ,'STVEFHM' ,'stvef_tlo.png'
                    ,'https://holomat.ch/' ,'https://en.wikipedia.org/wiki/Star_Trek:_Voyager_%E2%80%93_Elite_Force#Freeware_release' ,'ioEF', TRUE
                    ,'Saddle up, lock and load.'
                    ,array('Raven', 'The Last Outpost')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('650b3' ,'EF2' ,'Star Trek: Elite Force 2' ,'STEF2' ,'ef2.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Star_Trek:_Elite_Force_II' ,'Quake 3', TRUE #with Ritual's UberTools //http://www.st-ef2.com/  OR  http://www.ritual.com/EF2/
                    ,'The alien invaders show no mercy, and neither should you.'
                    ,array('Ritual')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame('630' ,'JK2' ,'Star Wars Jedi Knight 2: Jedi Outcast' ,'JK2' ,'jk2.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Star_Wars_Jedi_Knight_II:_Jedi_Outcast' ,'Quake 3', TRUE #with Raven's custom SDK
                    ,'To know the light, you must see the dark.'
                    ,array('Raven')
                    ,array('LucasArts' ,'Activision')
                    ,NULL
                    );
$Games[] = new cGame('641a1' ,'JA' ,'Star Wars Jedi Knight: Jedi Academy' ,'JA' ,'ja.gif'
                    ,NULL ,'https://en.wikipedia.org/wiki/Star_Wars_Jedi_Knight:_Jedi_Academy' ,'Quake 3', TRUE #with Raven's custom SDK
                    ,'Forge your weapon and follow the path of the Jedi.'
                    ,array('Raven')
                    ,array('LucasArts', 'Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'SS' ,'Steel Storm: Burning Retribution' ,'SS' ,NULL
                    ,'https://www.steel-storm.com/' ,'https://en.wikipedia.org/wiki/Steel_Storm' ,'DarkPlaces', FALSE
                    ,'Steel Storm: Burning Retribution is a top down action shooter with old school spirit. It marks the return of top-down shooters with new twists.'
                    ,array('Kot-in-Action')
                    ,array('Kot-in-Action')
                    ,NULL
                    );
$Games[] = new cGame('61c' ,'SC' ,'Sven Co-op' ,'SC' ,'sc.png'
                    ,'https://www.svencoop.com/' ,'https://en.wikipedia.org/wiki/Sven_Co-op' ,'Svengine', FALSE #Was modified GoldSrc before 5.0
                    ,'Sven Co-op is a co-operative game originally based around Valve Software\'s Half-Life.'
                    ,array('Sven Co-op')
                    ,array('Sven Co-op')
                    ,NULL
                    ); //Went stand-alone with version 5.0 (2016)
$Games[] = new cGame('641a1' ,'S' ,'Sylphis engine' ,'S' ,'sylphis.gif'
                    ,'https://sourceforge.net/projects/sylphis3d/' ,NULL ,'S', FALSE #http://sylphis3d.com
                    ,NULL
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TI' ,'Tactical Intervention' ,'TI' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Tactical_Intervention' ,'Source', TRUE #http://www.tactical-intervention.com/
                    ,'Drive, bomb, rappel and shoot your way through eleven high octane levels.'
                    ,array('FIX Korea')
                    ,array('OGPlanet')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'TIR' ,'Tactical Intervention Reloaded' ,'TIR' ,NULL
                    ,NULL ,NULL ,'Source', TRUE #https://www.kickstarter.com/projects/1837299704/tactical-intervention-reloaded
                    ,'Car chases. K9-Dogs. Tactical Gameplay.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
/*$Games[] = new cGame(NULL ,'TIR2' ,'Tactical Intervention Revived' ,'TIR2' ,NULL
                    ,'https://github.com/vingard/Tactical-Intervention-Revived' ,NULL ,NULL, FALSE //FIXME: Unknown game engine
                    ,'Tactical Intervention Revived is a fan project to restore the abadonware game Tactical Intervention.' //Typo theirs/
                    ,NULL
                    ,NULL
                    ,NULL
                    );*/ //Might be copyright infringement?
/*$Games[] = new cGame(NULL ,'TF2BOA' ,'Team Fortress 2: Brotherhood of Arms' ,'TF2BOA' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Team_Fortress_2:_Brotherhood_of_Arms' ,NULL, FALSE
                    ,NULL
                    ,array('Valve')
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame('510' ,'TFC' ,'Team Fortress Classic' ,'TFC' ,'tfc.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Team_Fortress_Classic' ,'GoldSrc', FALSE
                    ,'One of the most popular online action games of all time, Team Fortress Classic features over nine character classes -- from Medic to Spy to Demolition Man -- enlisted in a unique style of online team warfare.'
                    ,array('Valve')
                    ,array('Sierra Studios')
                    ,NULL
                    );
$Games[] = new cGame('660b1' ,'TF2' ,'Team Fortress 2' ,'TF2' ,'tf2.png'
                    ,'https://www.teamfortress.com/' ,'https://en.wikipedia.org/wiki/Team_Fortress_2' ,'Source', FALSE
                    ,'Team Fortress 2 is Valve\'s sequel to the game that put class-based, multiplayer team warfare on the map.'
                    ,array('Valve')
                    ,array('Valve')
                    ,array('EA')
                    );
$Games[] = new cGame(NULL ,'TBG' ,"The Beginner's Guide" ,'TBG' ,'tbg.png'
                    ,'https://thebeginnersgui.de/' ,'https://en.wikipedia.org/wiki/The_Beginner%27s_Guide' ,'Source', FALSE
                    ,"The Beginner's Guide is a narrative video game for Mac and PC."
                    ,array('Everything Unlimited')
                    ,array('Everything Unlimited')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'TC' ,'The Crossing' ,'TC' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/The_Crossing_(video_game)' ,'Source', FALSE
                    ,NULL
                    ,array('Arkane')
                    ,NULL
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame(NULL ,'TDH' ,'The DinoHunters' ,'TDH' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/The_DinoHunters' ,'Source', FALSE #http://www.thedinohunters.com/ #https://web.archive.org/web/20170930161349/http://www.thedinohunters.com/
                    ,'Dinosaurs, babes, guns and an RV.' //DinoHunters is a free game (all evidence to the contrary notwithstanding.)
                    ,array('Kuma Reality Games')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TDM' ,'The Dark Mod' ,'TDM' ,'tdm.png'
                    ,'https://thedarkmod.com/' ,'https://en.wikipedia.org/wiki/The_Dark_Mod' ,'Doom 3', FALSE
                    ,'Stealth Gaming in a Gothic Steampunk World.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TEW' ,'The Evil Within' ,'TEW' ,'tew.png'
                    ,'https://theevilwithin.bethesda.net/' ,'https://en.wikipedia.org/wiki/The_Evil_Within' ,'id Tech 5', TRUE #https://theevilwithin.com/
                    ,'Enter the mind of a madman.'
                    ,array('Tango')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TEW2' ,'The Evil Within 2' ,'TEW2' ,NULL
                    ,'https://theevilwithin2.bethesda.net/' ,'https://en.wikipedia.org/wiki/The_Evil_Within_2' ,'STEM', TRUE
                    ,'The only way out is in.'
                    ,array('Tango')
                    ,array('Bethesda')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'TG' ,'The Galaxian' ,'TG' ,NULL
                    ,NULL ,NULL ,'G3D', FALSE
                    ,NULL
                    ,NULL //Hass Tech Interactive Entertainment
                    ,NULL
                    ,NULL
                    );*/ //Cannot find proof this was ever released.
$Games[] = new cGame(NULL ,'TH' ,'The Hunted' ,'TH' ,NULL
                    ,'https://www.moddb.com/games/the-hunted' ,NULL ,'DarkPlaces', FALSE #http://thehunted.ru1337.com/ #http://the-hunted.com/
                    ,'The Hunted is a series of adventures experienced by a man fighting for his survival.'
                    ,NULL #Carni (Chris Page) rampaging@ru1337.com & Gunrunner
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TS' ,'The Ship' ,'TS' ,'ts.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/The_Ship_(video_game)' ,'Source', FALSE
                    ,'Bon voyage... forever!'
                    ,array('Outerlight')
                    ,array('Merscom', 'Mindscape')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'SP' ,'The Stanley Parable' ,'SP' ,'sp.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/The_Stanley_Parable' ,'Source', FALSE //Based on Portal 2 //Was: https://stanleyparable.com/
                    ,'You will play as Stanley, and you will not play as Stanley. You will follow a story, you will not follow a story. You will have a choice, you will have no choice.'
                    ,array('Galactic Cafe')
                    ,array('Galactic Cafe')
                    ,NULL
                    ); /*Not the 2011 mod version, but the 2013 standalone version.*/
/*$Games[] = new cGame(NULL ,'SPUD' ,'The Stanley Parable: Ultra Deluxe' ,'SPUD' ,NULL
                    ,'https://stanleyparable.com/' ,'https://en.wikipedia.org/wiki/The_Stanley_Parable:_Ultra_Deluxe' ,'Unity', FALSE
                    ,'When a simple-minded individual named Stanley discovers that the co-workers in his office have mysteriously vanished, he sets off to find answers.'
                    ,array('Crows Crows Crows')
                    ,array('Crows Crows Crows')
                    ,NULL
                    );*/ //Incompatible engine
$Games[] = new cGame(NULL ,'TW' ,'The Wastes' ,'TW' ,'tw.png'
                    ,'https://www.thewastes.net/' ,NULL ,'Quake 1', TRUE //Really: FTEQCC
                    ,'A Post-Apocalyptic First Person Shooter'
                    ,array('Vera Visions')
                    ,array('Vera Visions')
                    ,NULL
                    ); /*Not the 2000 mod version, but the 2018 standalone version.*/
$Games[] = new cGame(NULL ,'TFoL' ,'Thirty Flights of Loving' ,'TFoL' ,'tfol.png'
                    ,'https://blendogames.com/thirtyflightsofloving/' ,'https://en.wikipedia.org/wiki/Thirty_Flights_of_Loving' ,'Quake 2', FALSE
                    ,NULL
                    ,array('Blendo')
                    ,array('Idle Thumbs')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TFALL' ,'Titanfall' ,'TFALL' ,'tfall.png'
                    ,'https://www.ea.com/games/titanfall/titanfall' ,'https://en.wikipedia.org/wiki/Titanfall_(video_game)' ,'Source', TRUE
                    ,'Crafted by key developers behind the CALL OF DUTY franchise, Titanfall is the first next-gen shooter that combines adrenaline, wall-running, double-jumping action with powerful, fast-paced titan warfare to set the new bar for online multiplayer gameplay.'
                    ,array('Respawn Entertainment')
                    ,array('EA')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TFALL2' ,'Titanfall 2' ,'TFALL2' ,'tfall2.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Titanfall_2' ,'Source', TRUE
                    ,'Become one.'
                    ,array('Respawn Entertainment')
                    ,array('EA')
                    ,NULL
                    );
$Games[] = new cGame('630' ,'T' ,'Torque engine' ,'T' ,'torque.gif'
                    ,'http://www.garagegames.com/' ,'https://en.wikipedia.org/wiki/Torque_Game_Engine' ,'TGE', FALSE
                    ,NULL
                    ,array('GarageGames')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TRANS' ,'Transfusion' ,'TRANS' ,'trans.png'
                    ,'https://www.transfusion-game.com/' ,NULL ,'DarkPlaces', FALSE #http://blood.sourceforge.net/transfusion.php ? #https://en.wikipedia.org/wiki/Blood_(video_game)#Transfusion
                    ,'Time has come for Transfusion - let\'s get bloodier.'
                    ,array('The Transfusion Project')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'TREM' ,'Tremulous' ,'TREM' ,'trem.gif'
                    ,'https://tremulous.net/' ,'https://en.wikipedia.org/wiki/Tremulous' ,'ioquake3', FALSE
                    ,'Tremulous is a free, open source game that blends a team based FPS with elements of an RTS.'
                    ,array('Dark Legion Development')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'T2' ,'Tribes 2' ,'T2' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Tribes_2' ,'TGE', FALSE
                    ,'Stand alone and you shall die.'
                    ,array('Dynamix')
                    ,array('Sierra Entertainment')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'TRI' ,'Trinity: The Shatter Effect' ,'TRI' ,NULL
                    ,NULL ,NULL ,'Quake 3', FALSE
                    ,NULL
                    ,array('Gray Matter')
                    ,NULL //Activision?
                    ,NULL
                    );*/ //Cancelled
$Games[] = new cGame(NULL ,'TURTLE' ,'Turtle Arena' ,'TURTLE' ,'turtlearena.png'
                    ,'https://clover.moe/turtlearena/' ,NULL ,'Spearmint', FALSE #turtlearena.com
                    ,'Turtle Arena is multiplayer oriented with multiple game modes that can be played in splitscreen, over a network, and with bot players.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'UFO' ,'UFO: Alien Invasion' ,'UFO' ,'ufo.png'
                    ,'https://ufoai.org/' ,'https://en.wikipedia.org/wiki/UFO:_Alien_Invasion' ,'Quake 2', TRUE #http://ufoai.sourceforge.net/
                    ,'You control a secret organisation charged with defending Earth from a brutal alien enemy.'
                    ,array('UFO: Alien Invasion')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'UA' ,'Unreal Arena' ,'UA' ,'ua.png'
                    ,'https://www.unrealarena.net/' ,NULL ,'Daemon', FALSE
                    ,'Unreal Arena is a fast-paced first-person shooter that aims to merge the universes of Unreal Tournament and Quake III Arena.'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'UN' ,'Unvanquished' ,'UN' ,'un.png'
                    ,'https://unvanquished.net/' ,'https://en.wikipedia.org/wiki/Unvanquished_(video_game)' ,'Daemon', FALSE
                    ,'So you want to be a hero?'
                    ,NULL
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'UMERC' ,'Urban Mercenary' ,'UMERC' ,NULL
                    ,NULL ,NULL ,'GLQuake', TRUE
                    ,NULL
                    ,array('Moshpit')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame('641a1' ,'URT' ,'Urban Terror' ,'URT' ,'urt.png'
                    ,'https://www.urbanterror.info/' ,'https://en.wikipedia.org/wiki/Urban_Terror' ,'Quake 3', FALSE #http://www.urbanterror.net/
                    ,'Urban Terror can be described as a Hollywood tactical shooter; somewhat realism based, but the motto is \'fun over realism\'.'
                    ,array('FrozenSand')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'VAMP' ,'Vampire: The Masquerade - Bloodlines' ,'VAMP' ,'vampire.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Vampire:_The_Masquerade_%E2%80%93_Bloodlines' ,'Source', FALSE
                    ,'Seduced in a dark alley...'
                    ,array('Troika')
                    ,array('Activision')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'VEC' ,'Vecxis' ,'VEC' ,'vec.png'
                    ,NULL ,NULL ,'DarkPlaces', TRUE //http://vecxis.com/
                    ,NULL
                    ,NULL //Micah Talkiewicz
                    ,NULL
                    ,NULL
                    ); //Dead
$Games[] = new cGame(NULL ,'VIN' ,'Vindictus' ,'VIN' ,NULL
                    ,'https://vindictus.nexon.net/' ,'https://en.wikipedia.org/wiki/Vindictus' ,'Source', FALSE
                    ,'Enter a dark and sinister world where you must battle for survival.'
                    ,array('devCAT')
                    ,array('Nexon')
                    ,NULL
                    );
$Games[] = new cGame('660b8' ,'WAR' ,'Warfork' ,'WAR' ,'war.png'
                    ,'https://warfork.com/' ,'https://en.wikipedia.org/wiki/Warfork' ,'Qfusion', FALSE
                    ,'A demanding fast paced first person shooter with a focus on speed, aim, movement, and above all competitive play.'
                    ,array('Team Forbidden')
                    ,array('Team Forbidden')
                    ,NULL
                    );
$Games[] = new cGame('660b1' ,'W' ,'Warsow' ,'W' ,'warsow.gif'
                    ,'https://www.warsow.net/' ,'https://en.wikipedia.org/wiki/Warsow_(video_game)' ,'Qfusion', FALSE
                    ,'Set in a futuristic cartoon-like world where rocketlauncher-wielding pigs and lasergun-carrying cyberpunks roam the streets, Warsow is a completely free fast-paced first-person shooter (FPS) for Windows, Linux and Mac OS X.'
                    ,array('Warsow')
                    ,array('Chasseur de Bots')
                    ,NULL
                    );
$Games[] = new cGame('640a1' ,'WW' ,'WildWest' ,'WW', 'wildwest.gif'
                    ,'https://the-wildwest.co.uk/' ,NULL ,'Quake 3', FALSE
                    ,'An ex-Mexican army captain turned bandit, driven by a personal vendetta, has formed a mob of some of the most ruthless Mexican bandits to sweep a reign of terror through the land.'
                    ,array('Interactive Games')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'WOLF' ,'Wolfenstein' ,'WOLF' ,'wolf.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Wolfenstein_(2009_video_game)' ,'Doom 3', TRUE #http://www.wolfenstein.com/
                    ,'Unleash the Nazis\' own dark powers against them as you battle unimaginable evil and unexpected foes.'
                    ,array('id', 'Raven')
                    ,array('Activision')
                    ,array('Activision Blizzard')
                    );
$Games[] = new cGame(NULL ,'WOLFTNO' ,'Wolfenstein: The New Order' ,'WOLFTNO' ,'wtno.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Wolfenstein:_The_New_Order' ,'id Tech 5', FALSE #http://www.wolfenstein.com/
                    ,'The year is 1960 and the Nazis have won World War II.'
                    ,array('MachineGames')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'WOLFTOB' ,'Wolfenstein: The Old Blood' ,'WOLFTOB' ,'wtob.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Wolfenstein:_The_Old_Blood' ,'id Tech 5', FALSE #http://www.wolfenstein.com/
                    ,'Before The New Order, there was...'
                    ,array('MachineGames')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'WOLF2' ,'Wolfenstein II: The New Colossus' ,'WOLF2' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Wolfenstein_II:_The_New_Colossus' ,'id Tech 6', FALSE #http://www.wolfenstein.com/
                    ,'Amerika, 1961.'
                    ,array('MachineGames')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'WOLFCB' ,'Wolfenstein: Cyberpilot' ,'WOLFCB' ,NULL
                    ,'https://bethesda.net/game/wolfenstein-cyberpilot' ,'https://en.wikipedia.org/wiki/Wolfenstein:_Cyberpilot' ,'id Tech 6', FALSE
                    ,NULL
                    ,array('MachineGames', 'Arkane')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'WOLFYB' ,'Wolfenstein: Youngblood' ,'WOLFYB' ,NULL
                    ,'https://bethesda.net/game/wolfenstein-youngblood' ,'https://en.wikipedia.org/wiki/Wolfenstein:_Youngblood' ,'id Tech 6', FALSE
                    ,NULL
                    ,array('MachineGames', 'Arkane')
                    ,array('Bethesda')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'PAD' ,'World of Padman' ,'WoP' ,'wop.png'
                    ,'https://worldofpadman.net/' ,'https://en.wikipedia.org/wiki/World_of_Padman' ,'ioquake3', TRUE #http://www.worldofpadman.com/ #Was: Quake 3
                    ,'WoP is the domain of ENTE\'s comic strip super-hero bad-boy Padman and his motley crew, and their mission is to make your game with some seriously addictive fun, whatever your skill level, and whatever character role you jump into.'
                    ,array('Padworld')
                    ,NULL
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'WAOR' ,'Wrath: Aeon of Ruin' ,'WAOR' ,NULL
                    ,'http://www.wrath.game/' ,'https://en.wikipedia.org/wiki/Wrath:_Aeon_of_Ruin' ,'DarkPlaces', FALSE
                    ,'You must journey into the vast gloom to explore ancient ruins, discover forgotten secrets and battle the horrors that lurk within.'
                    ,array('KillPixel')
                    ,array('3D Realms', '1C')
                    ,NULL
                    );
$Games[] = new cGame(NULL ,'XMEN' ,'X-Men: The Ravages of Apocalypse' ,'XMEN' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/X-Men:_The_Ravages_of_Apocalypse' ,'Quake 1', FALSE
                    ,'A Quake total conversion.'
                    ,array('ZeroGravity')
                    ,array('WizardWorks')
                    ,NULL
                    ,'Q1');
$Games[] = new cGame(NULL ,'XON' ,'Xonotic' ,'XON' ,'xonotic.png'
                    ,'https://www.xonotic.org/' ,'https://en.wikipedia.org/wiki/Xonotic' ,'DarkPlaces', FALSE
                    ,'Xonotic is a fast paced free, open-source first person shooter licensed under the GNU General Public License.'
                    ,array('Team Xonotic')
                    ,array('Team Xonotic')
                    ,NULL
                    );
$Games[] = new cGame('660b5' ,'Z' ,'Zaero' ,'Z' ,'zaero.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Zaero' ,'Quake 2', FALSE
                    ,'As part of the elite fighter squadron Zaero, your mission here has been routine... Until now.'
                    ,array('Team Evolve')
                    ,array('Macmillan Digital Publishing')
                    ,NULL
                    ,'Q2');
$Games[] = new cGame(NULL ,'ZC' ,'Zeno Clash' ,'ZC' ,'zc.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Zeno_Clash' ,'Source', FALSE
                    ,'Zeno Clash is an action fighting game set in a punk fantasy world.'
                    ,array('ACE Team')
                    ,array('Iceberg', 'Tripwire')
                    ,NULL
                    );
/*$Games[] = new cGame(NULL ,'ZC 2' ,'Zeno Clash 2' ,'ZC2' ,'zc2.png'
                    ,NULL ,'https://en.wikipedia.org/wiki/Zeno_Clash_2' ,'Unreal3', FALSE
                    ,'Ghat\'s story is far from over: Zeno Clash 2 picks up where the deliciously brazen first game left off.'
                    ,array('ACE Team')
                    ,array('Atlus')
                    ,NULL
                    );*/ //Incompatible engine

/*$Games[] = new cGame(NULL ,'???' ,'Secret Service: In Harm's Way' ,'???' ,NULL
                    ,NULL ,'https://en.wikipedia.org/wiki/Secret_Service_(2001_video_game)' ,'???', FALSE
                    ,'Sometimes the nation\'s security comes down to one person!'
                    ,array('FunLabs')
                    ,array('Activision Value')
                    ,NULL
                    );*/ //Incompatible engine
/*$Games[] = new cGame(NULL ,'???' ,'Shadow Force: Razor Unit' ,'???' ,NULL #A.k.a. Delta Ops: Army Special Forces
                    ,NULL ,NULL ,'???', FALSE
                    ,'Rid the world of terrorism!'
                    ,array('FunLabs')
                    ,array('Activision Value')
                    ,NULL
                    );*/ //Incompatible engine
/*$Games[] = new cGame(NULL ,'???' ,'U.S. Most Wanted: Nowhere to Hide' ,'???' ,NULL
                    ,NULL ,NULL ,'???', FALSE
                    ,'They Can Run - But They Can\'t Hide'
                    ,array('FunLabs')
                    ,array('Activision Value')
                    ,NULL
                    );*/ //Incompatible engine
/*$Games[] = new cGame(NULL ,'???' ,'Revolution' ,'???' ,NULL
                    ,NULL ,NULL ,'???', FALSE
                    ,'Evolution has begun the next r3volution'
                    ,array('FunLabs')
                    ,array('Activision Value')
                    ,NULL
                    );*/ //Incompatible engine

//FIXME: https://en.wikipedia.org/wiki/Source_(game_engine)#Games_using_Source

//FIXME: https://www.mobygames.com/game-group/game-engine-torque/

//Darkplaces:
//Game: -battlemech runs the multiplayer topdown deathmatch game BattleMech
//Game: -contagiontheory runs the game Contagion Theory //https://www.moddb.com/games/contagion-theory
//Game: -darsana runs the game Darsana //https://www.moddb.com/games/darsana/
//Game: -did2 runs the game Defeat In Detail 2 //https://www.moddb.com/games/defeat-in-detail-2
//Game: -goodvsbad2 runs the psychadelic RTS FPS game Good Vs Bad 2
//Game: -nehahra runs The Seal of Nehahra movie and game
//Game: -neoteric runs the game Neoteric
//Game: -netherworld runs the game Netherworld: Dark Master
//Game: -prydon runs the topdown point and click action-RPG Prydon Gate //https://www.moddb.com/mods/prydon-gate
//Game: -setheral runs the multiplayer game Setheral
//Game: -som runs the multiplayer game Son Of Man
//Game: -teu runs The Evil Unleashed (this option is obsolete as they are not using darkplaces)
//Game: -zymotic runs the singleplayer game Zymotic

//FIXME: Refactor to change into direct dictionary lookup instead of a loop!
function findGame($GameID)
{
	global $Games;
	for ($Game = 0; $Game < count($Games); $Game++)
	{
		if ($GameID === $Games[$Game]->GameID)
		{
			return $Game;
		}
	}
	return FALSE;
}

//FIXME: Can we do this in a better way?
function getGamesQuery($GameID)
{
	global $Games;
	$Game = findGame($GameID);
	if ($Game === FALSE)
		return '';
	$QueryText = array();
	if (is_null($Games[$Game]->FromVersion))
		$QueryText[] = 'showunsupported=1';
	if (!is_null($Games[$Game]->NeedsGame))
		$QueryText[] = 'showxp=1';
	if (count($QueryText) === 0)
		return '';
	return '?'.join('&', $QueryText);
}
?>
