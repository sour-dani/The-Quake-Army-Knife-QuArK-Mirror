<?php
require_once('_main_paths.php');

class cCompany
{
	var $ID;           # ID used for the company
	var $Name;         # Full company name
	var $Logo;         # Logo of the company
	var $URL;          # Official website of the company
	var $WikipediaURL; # Link to the (English) Wikipedia article of this company (if any)

	function __construct($aID, $aName, $aLogo, $aURL=NULL, $aWikipediaURL=NULL)
	{
		global $picsroot;

		$this->ID           = $aID;
		$this->Name         = $aName;
		if (is_null($aLogo))
		{
			$this->Logo = NULL;
		}
		else
		{
			$this->Logo = $picsroot.'company/'.$aLogo;
		}
		$this->URL          = $aURL;
		$this->WikipediaURL = $aWikipediaURL;
	}
}

global $mainroot;

global $Companies;
$Companies = array();

$Companies['10tacle Studios'] = new cCompany('10tacle Studios', '10tacle Studios AG', NULL);
$Companies['1C'] = new cCompany('1C', '1C Entertainment', NULL, 'https://1ce.games/', 'https://en.wikipedia.org/wiki/1C_Company');
$Companies['2015'] = new cCompany('2015', '2015, Inc.', NULL, 'http://2015games.net/', 'https://en.wikipedia.org/wiki/2015_Games,_LLC.'); #http://www.2015.com/ #https://en.wikipedia.org/wiki/2015,_Inc.
$Companies['2K'] = new cCompany('2K', '2K Games', NULL, 'https://2k.com/', 'https://en.wikipedia.org/wiki/2K_Games'); #http://www.2kgames.com/
$Companies['3D Realms'] = new cCompany('3D Realms', '3D Realms', NULL, 'https://3drealms.com/', 'https://en.wikipedia.org/wiki/3D_Realms');
$Companies['Activision'] = new cCompany('Activision', 'Activision', NULL, 'https://www.activision.com/', 'https://en.wikipedia.org/wiki/Activision');
$Companies['Activision Blizzard'] = new cCompany('Activision Blizzard', 'Activision Blizzard', NULL, 'https://www.activisionblizzard.com/', 'https://en.wikipedia.org/wiki/Activision_Blizzard');
$Companies['Activision Shanghai'] = new cCompany('Activision Shanghai', 'Activision Shanghai', NULL);
$Companies['Activision Value'] = new cCompany('Activision Value', 'Activision Value', NULL);
$Companies['Alientrap'] = new cCompany('Alientrap', 'Alientrap', NULL, 'http://www.alientrap.com/'); #IllFonic? #http://www.alientrap.org/
$Companies['Anomic Games'] = new cCompany('Anomic Games', 'Anomic Games', NULL);
//$Companies['Aperture Tag Team'] = new cCompany('Aperture Tag Team', 'Aperture Tag Team', NULL);
$Companies['Arkane'] = new cCompany('Arkane', 'Arkane Studios', NULL, 'https://www.arkane-studios.com/', 'https://en.wikipedia.org/wiki/Arkane_Studios');
$Companies['Aspyr'] = new cCompany('Aspyr', 'Aspyr', NULL, 'https://www.aspyr.com/', 'https://en.wikipedia.org/wiki/Aspyr');
//$Companies['Avalanche Studios'] = new cCompany('Avalanche Studios', 'Avalanche Studios Group', NULL, 'https://avalanchestudios.com/', 'https://en.wikipedia.org/wiki/Avalanche_Studios_Group');
$Companies['Bampusht'] = new cCompany('Bampusht', 'Bampusht!', NULL); #http://www.bampusht.ro/
$Companies['Beenox'] = new cCompany('Beenox', 'Beenox', NULL, 'https://www.beenox.com/', 'https://en.wikipedia.org/wiki/Beenox');
$Companies['Bethesda'] = new cCompany('Bethesda', 'Bethesda Softworks', NULL, 'https://bethesda.net/', 'https://en.wikipedia.org/wiki/Bethesda_Softworks'); #http://www.bethsoft.com/
$Companies['Blendo'] = new cCompany('Blendo', 'Blendo Games', NULL, 'https://www.blendogames.com/', 'https://en.wikipedia.org/wiki/Blendo_Games');
$Companies['Boomstick'] = new cCompany('Boomstick', 'Boomstick Studios', NULL);
//$Companies['Cauldron HQ'] = new cCompany('Cauldron HQ', 'Cauldron HQ', NULL, 'http://www.cauldron.sk/', 'https://en.wikipedia.org/wiki/Cauldron_(video_game_company)');
$Companies['CDV Software Entertainment'] = new cCompany('CDV Software Entertainment', 'CDV Software Entertainment AG', NULL, NULL, 'https://en.wikipedia.org/wiki/CDV_Software');
$Companies['Certain Affinity'] = new cCompany('Certain Affinity', 'Certain Affinity', NULL, 'https://www.certainaffinity.com/', 'https://en.wikipedia.org/wiki/Certain_Affinity');
$Companies['Chasseur de Bots'] = new cCompany('Chasseur de Bots', 'Chasseur de Bots', NULL);
$Companies['COR'] = new cCompany('COR', 'COR Entertainment', NULL);
$Companies['Crowbar Collective'] = new cCompany('Crowbar Collective', 'Crowbar Collective', NULL, 'https://www.crowbarcollective.com/');
//$Companies['Crows Crows Crows'] = new cCompany('Crows Crows Crows', 'Crows Crows Crows', NULL);
//$Companies['Crystice'] = new cCompany('Crystice', 'Crystice Softworks', NULL, 'https://crystice.com/');
$Companies['Dark Legion Development'] = new cCompany('Dark Legion Development', 'Dark Legion Development', NULL);
$Companies['Davilex'] = new cCompany('Davilex', 'Davilex Games', NULL, 'https://www.davilex.nl/'); //https://nl.wikipedia.org/wiki/Davilex
$Companies['devCAT'] = new cCompany('devCAT', 'devCAT', NULL);
$Companies['Digital Paint'] = new cCompany('Digital Paint', 'Digital Paint', NULL, 'http://www.digitalpaint.org/');
$Companies['Dragonstone Software'] = new cCompany('Dragonstone Software', 'Dragonstone Software', NULL, NULL, 'https://en.wikipedia.org/wiki/Dragonstone_Software');
$Companies['Dynamix'] = new cCompany('Dynamix', 'Dynamix, Inc.', NULL, NULL, 'https://en.wikipedia.org/wiki/Dynamix'); #http://www.dynamix.com/
$Companies['EA'] = new cCompany('EA', 'Electronic Arts', NULL, 'https://www.ea.com/', 'https://en.wikipedia.org/wiki/Electronic_Arts');
$Companies['EALA'] = new cCompany('EALA', 'EALA', NULL);
$Companies['EA Distribution'] = new cCompany('EA Distribution', 'EA Distribution', NULL);
$Companies['Eclipse'] = new cCompany('Eclipse', 'Eclipse Entertainment', NULL);
$Companies['Eidos'] = new cCompany('Eidos', 'Eidos Interactive', NULL, NULL, 'https://en.wikipedia.org/wiki/Eidos_Interactive'); #http://www.eidos.com/
$Companies['Eidos GmbH'] = new cCompany('Eidos GmbH', 'Eidos GmbH', NULL);
$Companies['Escalation'] = new cCompany('Escalation', 'Escalation Studios', NULL, NULL, 'https://en.wikipedia.org/wiki/Escalation_Studios'); #http://www.escalationstudios.com/
$Companies['Everything Unlimited'] = new cCompany('Everything Unlimited', 'Everything Unlimited Ltd.', NULL);
$Companies['Eyaura'] = new cCompany('Eyaura', 'Eyaura', NULL);
$Companies['Facepunch'] = new cCompany('Facepunch', 'Facepunch Studios', NULL, 'https://facepunch.com/', 'https://en.wikipedia.org/wiki/Facepunch_Studios');
$Companies['Fistful of Frags Team'] = new cCompany('Fistful of Frags Team', 'Fistful of Frags Team', NULL);
$Companies['Floodgate'] = new cCompany('Floodgate', 'Floodgate Entertainment', NULL, NULL, 'https://en.wikipedia.org/wiki/Floodgate_Entertainment'); #http://www.floodg.com/
$Companies['Focus Home Interactive'] = new cCompany('Focus Home Interactive', 'Focus Home Interactive', NULL, 'https://www.focus-home.com/', 'https://en.wikipedia.org/wiki/Focus_Home_Interactive');
$Companies['Freeform Interactive'] = new cCompany('Freeform Interactive', 'Freeform Interactive LLC', NULL);
$Companies['FrozenSand'] = new cCompany('FrozenSand', 'FrozenSand, LLC', NULL, 'https://frozensand.com/'); #formerly: Silicon Ice Development #http://www.planetquake.com/siliconice #http://www.frozensand.com/
//$Companies['FunLabs'] = new cCompany('FunLabs', 'FUN Labs', NULL, 'https://www.funlabs.com/', 'https://en.wikipedia.org/wiki/Fun_Labs');
$Companies['Galactic Cafe'] = new cCompany('Galactic Cafe', 'Galactic Cafe', NULL, 'https://galactic-cafe.com/');
$Companies['GarageGames'] = new cCompany('GarageGames', 'GarageGames', NULL, 'http://www.garagegames.com/', 'https://en.wikipedia.org/wiki/GarageGames');
$Companies['Gathering of Developers'] = new cCompany('Gathering of Developers', 'Gathering of Developers', NULL, NULL, 'https://en.wikipedia.org/wiki/Gathering_of_Developers');
$Companies['Gearbox'] = new cCompany('Gearbox Software', 'Gearbox Software', NULL, 'https://www.gearboxsoftware.com/', 'https://en.wikipedia.org/wiki/Gearbox_Software');
//$Companies['Gratuitous'] = new cCompany('Gratuitous', 'Gratuitous Games', NULL);
$Companies['Gray Matter'] = new cCompany('Gray Matter', 'Gray Matter Interactive', NULL, NULL, 'https://en.wikipedia.org/wiki/Gray_Matter_Interactive'); #http://www.gmistudios.com/
$Companies['GT'] = new cCompany('GT', 'GT Interactive', NULL, NULL, 'https://en.wikipedia.org/wiki/GT_Interactive');
$Companies['Head Games'] = new cCompany('Head Games', 'Head Games Publishing, Inc.', NULL, NULL, 'https://en.wikipedia.org/wiki/Head_Games_Publishing'); #http://www.headgames.net
$Companies['HermitWorks'] = new cCompany('HermitWorks', 'HermitWorks Entertainment', NULL, NULL, 'https://en.wikipedia.org/wiki/HermitWorks_Entertainment');
//$Companies['Hezbollah'] = new cCompany('Hezbollah', 'Hezbollah', NULL, 'http://www.moqawama.org/', 'https://en.wikipedia.org/wiki/Hezbollah');
$Companies['Hidden Path Entertainment'] = new cCompany('Hidden Path Entertainment', 'Hidden Path Entertainment', NULL, 'https://www.hiddenpath.com/', 'https://en.wikipedia.org/wiki/Hidden_Path_Entertainment');
$Companies['Hipnotic'] = new cCompany('Hipnotic', 'Hipnotic Software', NULL, NULL, 'https://en.wikipedia.org/wiki/Hipnotic_Software');
$Companies['Hoplite Research'] = new cCompany('Hoplite Research', 'Hoplite Research, LLC', NULL, 'http://hoplite-research.com/');
$Companies['Human Head'] = new cCompany('Human Head', 'Human Head Studios', NULL, 'https://www.humanhead.com/', 'https://en.wikipedia.org/wiki/Human_Head_Studios');
$Companies['Iceberg'] = new cCompany('Iceberg', 'Iceberg Interactive', NULL, 'https://www.iceberg-games.com/', 'https://en.wikipedia.org/wiki/Iceberg_Interactive');
$Companies['id'] = new cCompany('id', 'id Software', NULL, 'https://www.idsoftware.com/', 'https://en.wikipedia.org/wiki/Id_Software');
$Companies['Idle Thumbs'] = new cCompany('Idle Thumbs', 'Idle Thumbs', NULL, 'https://www.idlethumbs.net/', 'https://en.wikipedia.org/wiki/Idle_Thumbs');
$Companies['Infinity Ward'] = new cCompany('Infinity Ward', 'Infinity Ward, Inc.', NULL, 'https://www.infinityward.com/', 'https://en.wikipedia.org/wiki/Infinity_Ward');
$Companies['Infogrames'] = new cCompany('Infogrames', 'Infogrames', NULL, NULL, 'https://en.wikipedia.org/wiki/Infogrames'); #http://www.infogrames.com/
$Companies['Interactive Games'] = new cCompany('Interactive Games', 'Interactive Games', NULL);
$Companies['Interdimensional Games'] = new cCompany('Interdimensional Games', 'Interdimensional Games', NULL);
$Companies['Interplay'] = new cCompany('Interplay', 'Interplay Entertainment', NULL, 'https://www.interplay.com/', 'https://en.wikipedia.org/wiki/Interplay_Entertainment');
$Companies['InterWave'] = new cCompany('InterWave', 'InterWave Studios', NULL); #Became GameConnect, sorta.
$Companies['Ion Storm'] = new cCompany('Ion Storm', 'Ion Storm Inc.', NULL, NULL, 'https://en.wikipedia.org/wiki/Ion_Storm');
$Companies['Iron Claw'] = new cCompany('Iron Claw', 'Iron Claw Interactive', NULL);
$Companies['Isotx'] = new cCompany('Isotx', 'Isotx', NULL, NULL, 'https://en.wikipedia.org/wiki/ISOTX'); #http://www.isotx.com/
$Companies['KillPixel'] = new cCompany('KillPixel', 'KillPixel Games', NULL, 'https://www.killpixelgames.com/');
$Companies['Konami'] = new cCompany('Konami', 'Konami', NULL, 'https://www.konami.com/', 'https://en.wikipedia.org/wiki/Konami');
$Companies['Kuju'] = new cCompany('Kuju', 'Kuju Entertainment', NULL, 'https://www.kuju.com/', 'https://en.wikipedia.org/wiki/Kuju_Entertainment');
$Companies['Kuma Reality Games'] = new cCompany('Kuma Reality Games', 'Kuma Reality Games', NULL, NULL, 'https://en.wikipedia.org/wiki/Kuma_Reality_Games'); #https://kumacommunity.net/
$Companies['Lever Games'] = new cCompany('Lever Games', 'Lever Games', NULL, 'https://www.levergames.com/');
$Companies['LucasArts'] = new cCompany('LucasArts', 'LucasArts', NULL, NULL, 'https://en.wikipedia.org/wiki/LucasArts'); #http://www.lucasarts.com/
$Companies['LunchHouse'] = new cCompany('LunchHouse', 'LunchHouse Software', NULL, 'https://lunchhouse.software/');
$Companies['MachineGames'] = new cCompany('MachineGames', 'MachineGames', NULL, 'https://www.machinegames.com/', 'https://en.wikipedia.org/wiki/MachineGames');
$Companies['Macmillan Digital Publishing'] = new cCompany('Macmillan Digital Publishing', 'Macmillan Digital Publishing USA', NULL, NULL, 'https://en.wikipedia.org/wiki/Macmillan_Inc.');
$Companies['Mangled Eye'] = new cCompany('Mangled Eye', 'Mangled Eye Studios', NULL, 'http://www.mangledeye.com/');
$Companies['Mekada'] = new cCompany('Mekada', 'Mekada', NULL);
$Companies['Merscom'] = new cCompany('Merscom', 'Merscom', NULL);
$Companies['MGM'] = new cCompany('MGM', 'MGM Interactive', NULL, NULL, 'https://en.wikipedia.org/wiki/MGM_Interactive');
$Companies['Mindscape'] = new cCompany('Mindscape', 'Mindscape', NULL, NULL, 'https://en.wikipedia.org/wiki/Mindscape_(company)');
$Companies['Monochrome'] = new cCompany('Monochrome', 'Monochrome Corporation', NULL, 'https://www.monochrome-games.com/');
$Companies['Monster'] = new cCompany('Monster', 'Monster Studios, LLC', NULL);
$Companies['Moshpit'] = new cCompany('Moshpit', 'Moshpit Entertainment', NULL); #http://www.moshpitentertainment.com/
$Companies['N\'Lightning Software Development'] = new cCompany('N\'Lightning Software Development', 'N\'Lightning Software Development', NULL); #http://www.n-lightning.com
//$Companies['National Alliance'] = new cCompany('National Alliance', 'National Alliance', NULL, 'http://natall.com/', 'https://en.wikipedia.org/wiki/National_Alliance_(United_States)');
$Companies['Nerve'] = new cCompany('Nerve', 'Nerve Software', NULL, 'https://www.nervesoftware.com/', 'https://en.wikipedia.org/wiki/Nerve_Software');
$Companies['New World Interactive'] = new cCompany('New World Interactive', 'New World Interactive', NULL, 'https://newworldinteractive.com/', 'https://en.wikipedia.org/wiki/New_World_Interactive');
$Companies['Nexon'] = new cCompany('Nexon', 'Nexon', NULL, 'https://www.nexon.com/', 'https://en.wikipedia.org/wiki/Nexon');
//$Companies['Nightdive Studios'] = new cCompany('Nightdive Studios', 'Nightdive Studios', NULL, 'https://www.nightdivestudios.com/', 'https://en.wikipedia.org/wiki/Nightdive_Studios');
$Companies['No More Room in Hell Team'] = new cCompany('No More Room in Hell Team', 'No More Room in Hell Team', NULL);
$Companies['OpenArena'] = new cCompany('OpenArena', 'OpenArena team', NULL);
$Companies['Outerlight'] = new cCompany('Outerlight', 'Outerlight', NULL, NULL, 'https://en.wikipedia.org/wiki/Outerlight');
$Companies['Padworld'] = new cCompany('Padworld', 'Padworld Entertainment', NULL, NULL); #http://www.padworld-entertainment.com/
$Companies['Puny Human'] = new cCompany('Puny Human', 'Puny Human', NULL);
$Companies['QuantumAxcess'] = new cCompany('QuantumAxcess', 'Quantum Axcess', NULL, NULL, 'https://en.wikipedia.org/wiki/Quantum_Axcess'); #http://www.qa.com/
$Companies['QuArK Development'] = new cCompany('QuArK Development', 'QuArK Development Team', NULL, $mainroot); #https://quark.sourceforge.io/
$Companies['Ratloop'] = new cCompany('Ratloop', 'Ratloop', NULL, 'http://www.ratloop.com/', 'https://en.wikipedia.org/wiki/Ratloop');
$Companies['Raven'] = new cCompany('Raven', 'Raven Software', NULL, 'https://www.ravensoftware.com/', 'https://en.wikipedia.org/wiki/Raven_Software'); #http://www.ravensoft.com/
$Companies['reakktor.com'] = new cCompany('reakktor.com', 'Reakktor Media GmbH', NULL);
//$Companies['Resistance Records'] = new cCompany('Resistance Records', 'Resistance Records', NULL, 'http://www.resistance.com/', 'https://en.wikipedia.org/wiki/Resistance_Records');
$Companies['Respawn Entertainment'] = new cCompany('Respawn Entertainment', 'Respawn Entertainment', NULL, 'https://www.respawn.com/', 'https://en.wikipedia.org/wiki/Respawn_Entertainment');
$Companies['Rewolf Software'] = new cCompany('Rewolf Software', 'Rewolf Software', NULL, NULL, 'https://en.wikipedia.org/wiki/Rewolf_Software');
$Companies['Ritual'] = new cCompany('Ritual', 'Ritual Entertainment', NULL, NULL, 'https://en.wikipedia.org/wiki/Ritual_Entertainment'); #http://www.ritual.com/
$Companies['Robert Kooima'] = new cCompany('Robert Kooima', 'Robert Kooima', NULL);
$Companies['Rogue'] = new cCompany('Rogue', 'Rogue Entertainment', NULL, NULL, 'https://en.wikipedia.org/wiki/Rogue_Entertainment');
$Companies['Royal Rudius Entertainment'] = new cCompany('Royal Rudius Entertainment', 'Royal Rudius Entertainment', NULL, NULL); #http://www.royalrudiusentertainment.com/
$Companies['Saber Interactive'] = new cCompany('Saber Interactive', 'Saber Interactive Incorporated', NULL, 'https://saber3d.com/', 'https://en.wikipedia.org/wiki/Saber_Interactive');
$Companies['SCT'] = new cCompany('SCT', 'Seacorp Technologies', NULL, 'https://www.seacorptech.com/');
$Companies['Sierra Entertainment'] = new cCompany('Sierra Entertainment', 'Sierra Entertainment', NULL, NULL, 'https://en.wikipedia.org/wiki/Sierra_Entertainment'); #Was: Sierra On-Line, Inc.
$Companies['Sierra Studios'] = new cCompany('Sierra Studios', 'Sierra Studios', NULL, NULL, 'https://en.wikipedia.org/wiki/Sierra_Studios'); #http://www.sierra.com/
$Companies['Silverfish Studios'] = new cCompany('Silverfish Studios', 'Silverfish Studios, LLC', NULL);
$Companies['Sledgehammer'] = new cCompany('Sledgehammer', 'Sledgehammer Games', NULL, 'https://sledgehammergames.com/', 'https://en.wikipedia.org/wiki/Sledgehammer_Games');
$Companies['Slipgate Ironworks'] = new cCompany('Slipgate Ironworks', 'Slipgate Ironworks', NULL, 'http://slipgate-ironworks.com/', 'https://en.wikipedia.org/wiki/Slipgate_Ironworks');
$Companies['Smokin\' Guns'] = new cCompany('Smokin\' Guns', 'Smokin\' Guns Productions', NULL);
$Companies['Splash Damage'] = new cCompany('Splash Damage', 'Splash Damage', NULL, 'https://www.splashdamage.com/', 'https://en.wikipedia.org/wiki/Splash_Damage');
$Companies['Streum On Studio'] = new cCompany('Streum On Studio', 'Streum On Studio', NULL, 'http://www.streumon-studio.com/', 'https://en.wikipedia.org/wiki/Streum_On_Studio');
$Companies['Sven Co-op'] = new cCompany('Sven Co-op', 'Sven Co-op team', NULL);
$Companies['Tango'] = new cCompany('Tango', 'Tango Gameworks', NULL, 'https://www.tangogameworks.com/', 'https://en.wikipedia.org/wiki/Tango_Gameworks');
$Companies['Team Blur Games'] = new cCompany('Team Blur Games', 'Team Blur Games', NULL);
$Companies['Team Evolve'] = new cCompany('Team Evolve', 'Team Evolve', NULL); #http://www.team-evolve.com/
$Companies['Team Forbidden'] = new cCompany('Team Forbidden', 'Team Forbidden LLC.', NULL); #https://forbidden.gg/
$Companies['Team Psykskallar'] = new cCompany('Team Psykskallar', 'Team Psykskallar', NULL);
$Companies['Team Xonotic'] = new cCompany('Team Xonotic', 'Team Xonotic', NULL);
$Companies['Tencent Games'] = new cCompany('Tencent Games', 'Tencent Games', NULL, NULL, 'https://en.wikipedia.org/wiki/Tencent_Games');
$Companies['thechineseroom'] = new cCompany('thechineseroom', 'The Chinese Room', NULL, 'http://www.thechineseroom.co.uk/', 'https://en.wikipedia.org/wiki/The_Chinese_Room');
$Companies['The Transfusion Project'] = new cCompany('The Transfusion Project', 'The Transfusion Project', NULL);
$Companies['TKO'] = new cCompany('TKO', 'TKO Software', NULL, NULL, 'https://en.wikipedia.org/wiki/TKO_Software'); #http://www.tko-software.com/
$Companies['Trainwreck'] = new cCompany('Trainwreck', 'Trainwreck Studios', NULL, NULL, 'https://en.wikipedia.org/wiki/Trainwreck_Studios');
$Companies['Treyarch'] = new cCompany('Treyarch', 'Treyarch', NULL, 'https://www.treyarch.com/', 'https://en.wikipedia.org/wiki/Treyarch');
$Companies['Troika'] = new cCompany('Troika', 'Troika Games', NULL, NULL, 'https://en.wikipedia.org/wiki/Troika_Games'); #http://www.troikagames.com/
$Companies['Turtle Rock Studios'] = new cCompany('Turtle Rock Studios', 'Turtle Rock Studios', NULL, 'https://www.turtlerockstudios.com/', 'https://en.wikipedia.org/wiki/Turtle_Rock_Studios');
$Companies['Two Guys Software'] = new cCompany('Two Guys Software', 'Two Guys Software', NULL, 'http://twoguyssoftware.ca/');
$Companies['Ubisoft'] = new cCompany('Ubisoft', 'Ubisoft', NULL, 'https://www.ubisoft.com/', 'https://en.wikipedia.org/wiki/Ubisoft'); #http://www.ubi.com/
$Companies['UFO: Alien Invasion'] = new cCompany('UFO: Alien Invasion', 'UFO: Alien Invasion Team', NULL);
$Companies['ValuSoft'] = new cCompany('ValuSoft', 'ValuSoft', NULL, NULL, 'https://en.wikipedia.org/wiki/ValuSoft');
$Companies['Valve'] = new cCompany('Valve', 'Valve Corporation', NULL, 'https://valvesoftware.com/', 'https://en.wikipedia.org/wiki/Valve_Corporation'); #Was: Valve L.L.C.
$Companies['Vipersoft'] = new cCompany('Vipersoft', 'Vipersoft', NULL);
$Companies['Vivendi'] = new cCompany('Vivendi', 'Vivendi Universal', NULL, 'https://www.vivendi.com/', 'https://en.wikipedia.org/wiki/Vivendi');
$Companies['Warsow'] = new cCompany('Warsow', 'War§ow team', NULL);
$Companies['WizardWorks'] = new cCompany('WizardWorks', 'WizardWorks', NULL, NULL, 'https://en.wikipedia.org/wiki/WizardWorks'); #http://www.wizworks.com/
$Companies['Xatrix'] = new cCompany('Xatrix', 'Xatrix Entertainment', NULL, NULL, 'https://en.wikipedia.org/wiki/Xatrix_Entertainment');
$Companies['ZeroGravity'] = new cCompany('ZeroGravity', 'Zero Gravity Entertainment', NULL);

?>
