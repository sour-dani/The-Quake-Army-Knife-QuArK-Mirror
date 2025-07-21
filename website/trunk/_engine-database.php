<?php
require_once('_main_paths.php');

class cEngine
{
	var $ID;           # ID used for the engine
	var $Name;         # Full engine name
	var $Logo;         # Logo of the engine (if any)
	var $License;      # License type for the engine
	var $URL;          # Official website of the engine (if any)
	var $WikipediaURL; # Link to the (English) Wikipedia article of this engine (if any)
	var $BasedOn;      # This engine is based on what other engine?

	function __construct($aID, $aName, $aLogo, $aLicense, $aURL, $aWikipediaURL, $aBasedOn)
	{
		$this->ID           = $aID;
		$this->Name         = $aName;
		if (is_null($aLogo))
		{
			$this->Logo = NULL;
		}
		else
		{
			$this->Logo         = $picsroot.'engine/'.$aLogo;
		}
		$this->License      = $aLicense;
		$this->URL          = $aURL;
		$this->WikipediaURL = $aWikipediaURL;
		$this->BasedOn      = $aBasedOn;
	}
}
//FIXME: Add company that made the engine?

global $Engines;
$Engines = array();

$Engines['6DX'] = new cEngine('6DX', 'Aztica 6DX 3D Engine', NULL, 'Open source (MIT)', 'https://sourceforge.net/projects/aztica/', NULL, NULL);
//$Engines['Apex'] = new cEngine('Apex', 'Apex', NULL, 'Proprietary', NULL, NULL, NULL);
//$Engines['CloakNT3'] = new cEngine('CloakNT3', 'CloakNT3', NULL, 'Proprietary', NULL, NULL, NULL);
$Engines['CoD9'] = new cEngine('CoD9', 'Black Ops II', NULL, 'Proprietary', NULL, NULL, 'IW3');
$Engines['CoD12'] = new cEngine('CoD12', 'Black Ops III', NULL, 'Proprietary', NULL, NULL, 'CoD9');
$Engines['CoD14'] = new cEngine('CoD14', 'Black Ops 4', NULL, 'Proprietary', NULL, NULL, 'CoD12');
$Engines['CrSp'] = new cEngine('CrSp', 'Crystal Space engine', NULL, 'Open source (LGPL)', 'http://www.crystalspace3d.org/', 'https://en.wikipedia.org/wiki/Crystal_Space', NULL);
$Engines['CRX'] = new cEngine('CRX', 'CRX engine', NULL, 'Open source (GPL)', NULL, NULL, 'Quake 2');
//$Engines['CryEngine1'] = new cEngine('CryEngine1', 'CRYENGINE 1', NULL, 'Proprietary', 'https://www.cryengine.com/', NULL, NULL);
//$Engines['CryEngine2'] = new cEngine('CryEngine2', 'CRYENGINE 2', NULL, 'Proprietary', 'https://www.cryengine.com/', 'https://en.wikipedia.org/wiki/CryEngine_2', 'CryEngine1');
//$Engines['CryEngine3'] = new cEngine('CryEngine3', 'CRYENGINE 3', NULL, 'Proprietary', 'https://www.cryengine.com/', 'https://en.wikipedia.org/wiki/CryEngine_3', 'CryEngine2');
//$Engines['CryEngine4'] = new cEngine('CryEngine4', 'CRYENGINE 4', NULL, 'Proprietary', 'https://www.cryengine.com/', 'https://en.wikipedia.org/wiki/CryEngine_4', 'CryEngine3'); #Also known as: CRYENGINE 3.6
//$Engines['CryEngineV'] = new cEngine('CryEngine5', 'CRYENGINE V', NULL, 'Proprietary', 'https://www.cryengine.com/', 'https://en.wikipedia.org/wiki/CryEngine_V', 'CryEngine4');
$Engines['Daemon'] = new cEngine('Daemon', 'Dæmon', NULL, 'Open source', 'https://github.com/DaemonEngine/Daemon', NULL, 'OpenWolf');
$Engines['DarkPlaces'] = new cEngine('DarkPlaces', 'DarkPlaces', NULL, 'Open source (GPL)', 'https://icculus.org/twilight/darkplaces/', 'https://en.wikipedia.org/wiki/DarkPlaces_engine', 'Quake 1');
//$Engines['Discovery'] = new cEngine('Discovery', 'LithTech Discovery', NULL, 'Proprietary', NULL, NULL, NULL); #Based on: LithTech 2.2 + some LithTech 3.x features
$Engines['Doom 3'] = new cEngine('Doom 3', 'id Tech 4', NULL, 'Open source (GPL)', NULL, 'https://en.wikipedia.org/wiki/Id_Tech_4', 'Quake 3');
$Engines['ETXreaL'] = new cEngine('ETXreaL', 'ET:XreaL', NULL, 'Open source', NULL, NULL, 'XreaL'); //https://www.moddb.com/mods/etxreal
$Engines['G3D'] = new cEngine('G3D', 'Genesis 3D', NULL, 'Open source', 'http://www.genesis3d.com/', 'https://en.wikipedia.org/wiki/Genesis3D', NULL);
//$Engines['Firebird'] = new cEngine('Firebird', 'LithTech Firebird', NULL, 'Proprietary', NULL, NULL, NULL); #Jupiter Ex based?
$Engines['GoldSrc'] = new cEngine('GoldSrc', 'GoldSrc', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/GoldSrc', 'Quake 1'); #Contains QuakeWorld and Quake 2 code too.
$Engines['GLQuake'] = new cEngine('GLQuake', 'GLQuake', NULL, 'Open source (GPL)', NULL, 'https://en.wikipedia.org/wiki/GLQuake', 'Quake 1');
$Engines['id Tech 5'] = new cEngine('id Tech 5', 'id Tech 5', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Id_Tech_5', 'Doom 3');
$Engines['id Tech 6'] = new cEngine('id Tech 6', 'id Tech 6', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Id_Tech_6', 'id Tech 5');
$Engines['id Tech 7'] = new cEngine('id Tech 7', 'id Tech 7', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Id_Tech_7', 'id Tech 6');
$Engines['id Tech 8'] = new cEngine('id Tech 8', 'id Tech 8', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Id_Tech_8', 'id Tech 7');
$Engines['ioEF'] = new cEngine('ioEF', 'ioEF', NULL, 'Open source (GPL)', 'https://www.moddb.com/mods/ioef', NULL, 'ioquake3'); #http://thilo.kickchat.com/efport-progress
$Engines['ioquake3'] = new cEngine('ioquake3', 'ioquake3', NULL, 'Open source (GPL)', 'https://ioquake3.org/', 'https://en.wikipedia.org/wiki/Ioquake3', 'Quake 3');
$Engines['IRR'] = new cEngine('IRR', 'Irrlicht 3D', NULL, 'Open source', 'http://irrlicht.sourceforge.net/' ,'https://en.wikipedia.org/wiki/Irrlicht_Engine', NULL);
//$Engines['IW'] = new cEngine('IW', 'IW', NULL, 'Proprietary', NULL, NULL, 'Quake 3'); #IW=id Tech 3
$Engines['IW2'] = new cEngine('IW2', 'IW 2.0', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/IW_2.0', 'Quake 3');
$Engines['IW3'] = new cEngine('IW3', 'IW 3.0', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/IW_3.0', 'IW2');
$Engines['IW4'] = new cEngine('IW4', 'IW 4.0', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/IW_4.0', 'IW3');
$Engines['IW5'] = new cEngine('IW5', 'MW3', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/IW_5.0', 'IW4');
$Engines['IW6'] = new cEngine('IW6', 'IW 6.0 Next Gen', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/IW_6.0', 'IW5');
$Engines['IW7'] = new cEngine('IW7', 'IW 7.0 Next Gen', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/IW_7.0', 'IW6');
$Engines['IW8'] = new cEngine('IW8', 'IW 8.0', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/IW_8.0', 'IW7');
$Engines['IW9'] = new cEngine('IW9', 'IW 9.0', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/IW_9.0', 'IW8');
//$Engines['Jupiter'] = new cEngine('Jupiter', 'LithTech Jupiter', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/LithTech_Jupiter', NULL);
//$Engines['JupiterEX'] = new cEngine('JupiterEX', 'LithTech Jupiter EX', NULL, 'Proprietary', NULL, NULL, 'Jupiter');
$Engines['KEX'] = new cEngine('KEX', 'KEX Engine', NULL, 'Open source (GPL)', NULL, 'https://en.wikipedia.org/wiki/KEX_Engine', NULL); //Used in: Doom64 EX (https://sourceforge.net/projects/doom64ex/) //Short for: Kaiser EX
$Engines['KEX2'] = new cEngine('KEX 2', 'KEX 2 Engine', NULL, 'Open source (GPL)', NULL, NULL, 'KEX');
$Engines['KEX3'] = new cEngine('KEX 3', 'KEX 3 Engine', NULL, 'Proprietary', NULL, NULL, 'KEX2');
//$Engines['KEX4'] = new cEngine('KEX 4', 'KEX 4 Engine', NULL, 'Proprietary', NULL, NULL, 'KEX3');
//$Engines['LithTech1'] = new cEngine('LithTech1', 'LithTech 1.0', NULL, 'Proprietary', NULL, NULL, NULL);
//$Engines['LithTech2'] = new cEngine('LithTech2', 'LithTech 2.0', NULL, 'Proprietary', NULL, NULL, 'LithTech1');
//$Engines['LithTech3'] = new cEngine('LithTech3', 'LithTech 3.0', NULL, 'Proprietary', NULL, NULL, 'LithTech2');
//$Engines['NGL'] = new cEngine('NGL', 'Treyarch NGL', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Treyarch_NGL', NULL);
$Engines['OpenWolf'] = new cEngine('OpenWolf', 'OpenWolf', NULL, 'Open source', NULL, NULL, 'ETXreaL'); //https://github.com/TheDushan/OpenWolf-Engine
$Engines['Qfusion'] = new cEngine('Qfusion', 'Qfusion', NULL, 'Open source (GPL)', 'https://qfusion.github.io/qfusion/', 'https://en.wikipedia.org/wiki/Qfusion', 'Quake 2'); #http://hkitchen.net/qfusion/
//$Engines['qrazor'] = new cEngine('qrazor', 'qrazor-fx3', NULL, 'Open source (GPL)', NULL, NULL, 'Quake 2'); //https://sourceforge.net/projects/xreal/
$Engines['Quake 1'] = new cEngine('Quake 1', 'Quake 1', NULL, 'Open source (GPL)', NULL, 'https://en.wikipedia.org/wiki/Quake_engine', NULL);
$Engines['Quake 2'] = new cEngine('Quake 2', 'id Tech 2', NULL, 'Open source (GPL)', NULL, 'https://en.wikipedia.org/wiki/Quake_II_engine', 'Quake 1');
$Engines['Quake 3'] = new cEngine('Quake 3', 'id Tech 3', NULL, 'Open source (GPL)', NULL, 'https://en.wikipedia.org/wiki/Id_Tech_3', 'Quake 2');
//$Engines['Quake2World'] = new cEngine('Quake2World', 'Quake2World', NULL, 'Open source (GPL)', NULL, NULL, 'Quake 2'); //Merged into Quetoo
$Engines['S'] = new cEngine('S', 'Sylphis', NULL, 'Open source (BSD)', 'https://sourceforge.net/projects/sylphis3d/', NULL, NULL);
$Engines['Source'] = new cEngine('Source', 'Source Engine', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Source_(game_engine)', 'GoldSrc'); #FIXME: Logo!
$Engines['Source2'] = new cEngine('Source2', 'Source Engine 2', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Source_2', 'Source');
$Engines['Spearmint'] = new cEngine('Spearmint', 'Spearmint', NULL, 'Open source (GPL)', 'https://clover.moe/spearmint/', NULL, 'ioquake3');
$Engines['STEM'] = new cEngine('STEM', 'STEM', NULL, 'Proprietary', NULL, NULL, 'id Tech 5');
$Engines['Svengine'] = new cEngine('Svengine', 'Svengine', NULL, 'Proprietary', NULL, NULL, 'GoldSrc');
//$Engines['Talon'] = new cEngine('Talon', 'LithTech Talon', NULL, 'Proprietary', NULL, NULL, 'LithTech2'); #Based on: LithTech 2.2
$Engines['TGE'] = new cEngine('TGE', 'Torque Game Engine', NULL, 'Open source (MIT)', NULL, 'https://en.wikipedia.org/wiki/Torque_Game_Engine', NULL); #http://www.garagegames.com/products/1 #The V12 Engine is a modified version of the technology engine powering Tribes 2.
//$Engines['Unity'] = new cEngine('Unity', 'Unity', NULL, 'Proprietary', 'https://unity.com/', 'https://en.wikipedia.org/wiki/Unity_(game_engine)', NULL); //FIXME: Split into 1, 2, 3, 4, 5, 2017, 2018, 2019.3, 2019.4, etc.?
//$Engines['Triton'] = new cEngine('Triton', 'LithTech Triton', NULL, 'Proprietary', NULL, NULL, 'Jupiter');
//$Engines['Unreal1'] = new cEngine('Unreal1', 'Unreal Engine 1', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Unreal_Engine_1', NULL);
//$Engines['Unreal2'] = new cEngine('Unreal2', 'Unreal Engine 2', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Unreal_Engine_2', 'Unreal1');
//$Engines['Unreal3'] = new cEngine('Unreal3', 'Unreal Engine 3', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Unreal_Engine_3', 'Unreal2');
//$Engines['Unreal4'] = new cEngine('Unreal4', 'Unreal Engine 4', NULL, 'Proprietary', NULL, 'https://en.wikipedia.org/wiki/Unreal_Engine_4', 'Unreal3');
//$Engines['Unreal5'] = new cEngine('Unreal5', 'Unreal Engine 5', NULL, 'Proprietary', 'https://www.unrealengine.com/', 'https://en.wikipedia.org/wiki/Unreal_Engine_5', 'Unreal4');
//$Engines['Volatile'] = new cEngine('Volatile', 'Volatile Engine', NULL, 'Proprietary', NULL, NULL, NULL);
$Engines['Void'] = new cEngine('Void', 'Void', NULL, 'Proprietary', NULL, NULL, 'id Tech 6');
$Engines['XreaL'] = new cEngine('XreaL', 'XreaL', NULL, 'Open source (GPL)', NULL, NULL, 'Quake 3'); //https://sourceforge.net/projects/xreal/

//WinQuake, QuakeWorld, GLQuakeWorld: GPL   //Was: http://www.quakeworld.net/

?>
