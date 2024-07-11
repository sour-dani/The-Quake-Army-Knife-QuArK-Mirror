<?php
require_once('_main_paths.php');

class cQRKOther
{
	var $Title;       # Name of the thing
	var $URL;         # URL of the thing
	var $Description; # Description of the thing

	function __construct($aTitle, $aURL, $aDescription=NULL)
	{
		$this->Title       = $aTitle;
		$this->URL         = $aURL;
		$this->Description = $aDescription;
	}
}

global $downloadroot;

##
## -- Things --
##
global $GamesQRKOther;
$GamesQRKOther = array();

#                    Thing (file)name
#                    |        Download URL
#                    |        |         Description
#                    |        |         |

# Quake
$GamesQRKOther['Q1'   ] = array();
$GamesQRKOther['Q1'   ][] = new cQRKOther('q1source.txt','http://www.gamers.org/pub/idgames/idstuff/source/q1source.txt'); #ftp://ftp.idsoftware.com/
$GamesQRKOther['Q1'   ][] = new cQRKOther('q1source.zip','http://www.gamers.org/pub/idgames/idstuff/source/q1source.zip'); #ftp://ftp.idsoftware.com/
$GamesQRKOther['Q1'   ][] = new cQRKOther('qcc.tar.gz','http://www.gamers.org/pub/idgames/idstuff/source/qcc.tar.gz'); #ftp://ftp.idsoftware.com/
$GamesQRKOther['Q1'   ][] = new cQRKOther('qcc.txt','http://www.gamers.org/pub/idgames/idstuff/source/qcc.txt'); #ftp://ftp.idsoftware.com/
#$GamesQRKOther['Q1'   ][] = new cQRKOther('qutils.txt','http://www.gamers.org/pub/idgames/idstuff/source/qutils.txt'); #ftp://ftp.idsoftware.com/
#$GamesQRKOther['Q1'   ][] = new cQRKOther('qutils.zip','http://www.gamers.org/pub/idgames/idstuff/source/qutils.zip'); #ftp://ftp.idsoftware.com/
#$GamesQRKOther['Q1'   ][] = new cQRKOther('q1tools_gpl.tgz','http://www.gamers.org/pub/idgames/idstuff/source/q1tools_gpl.tgz'); #ftp://ftp.idsoftware.com/
#$GamesQRKOther['Q1'   ][] = new cQRKOther('QuakeEd.tar.gz','http://www.gamers.org/pub/idgames/idstuff/source/QuakeEd.tar.gz'); #ftp://ftp.idsoftware.com/
#$GamesQRKOther['Q1'   ][] = new cQRKOther('QuakeEd.txt','http://www.gamers.org/pub/idgames/idstuff/source/QuakeEd.txt'); #ftp://ftp.idsoftware.com/
#$GamesQRKOther['Q1'   ][] = new cQRKOther('QuakeWorld QC files','http://www.gamers.org/pub/idgames/idstuff/source/qw-qc.tar.gz'); #ftp://ftp.idsoftware.com/
$GamesQRKOther['Q1'   ][] = new cQRKOther('quake_map_source.zip','https://rome.ro/s/quake_map_source.zip','All of Quake\'s original map sources');
$GamesQRKOther['Q1'   ][] = new cQRKOther('dopa.rar','https://cdn.bethsoft.com/quake/dopa.rar','Happy 20th to Quake! As a gift to the fans, Machine Games created a new episode of the game.'); #https://twitter.com/machinegames/status/746363189768650752

# X-Men: The Ravages of Apocalypse
$GamesQRKOther['XMEN' ] = array();
$GamesQRKOther['XMEN' ][] = new cQRKOther('X-MenROA_SourceCode.zip',$downloadroot.'X-MenROA/X-MenROA_SourceCode.zip');
$GamesQRKOther['XMEN' ][] = new cQRKOther('X-MenROA_Quake1TC.zip',$downloadroot.'X-MenROA/X-MenROA_Quake1TC.zip');

# Quake 2
$GamesQRKOther['Q2'   ] = array();
#$GamesQRKOther['Q2'   ][] = new cQRKOther('q2src320.exe','http://www.gamers.org/pub/idgames/idstuff/quake2/source/q2src320.exe'); #ftp://ftp.idsoftware.com/
$GamesQRKOther['Q2'   ][] = new cQRKOther('q2source-3.21.zip','http://www.gamers.org/pub/idgames/idstuff/source/q2source-3.21.zip'); #ftp://ftp.idsoftware.com/
$GamesQRKOther['Q2'   ][] = new cQRKOther('Quake-2-Tools ','https://github.com/id-Software/Quake-2-Tools');

# Quake 2: The Reckoning
$GamesQRKOther['Q2TR' ] = array();
$GamesQRKOther['Q2TR' ][] = new cQRKOther('xatrixsrc320.exe','http://www.gamers.org/pub/idgames/idstuff/quake2/source/xatrixsrc320.exe'); #ftp://ftp.idsoftware.com/

# Quake 2: Ground Zero
$GamesQRKOther['Q2GZ' ] = array();
$GamesQRKOther['Q2GZ' ][] = new cQRKOther('roguesrc320.exe','http://www.gamers.org/pub/idgames/idstuff/quake2/source/roguesrc320.exe'); #ftp://ftp.idsoftware.com/

# Heretic 2
$GamesQRKOther['Hr2'  ] = array();
$GamesQRKOther['Hr2'  ][] = new cQRKOther('H2_Toolkit_maps.exe','https://www.quaddicted.com/files/idgames2/planetquake/hereticii/files/Ht2Toolkit_v1.06.exe'); #http://www.filefront.com/7931/Heretic-II-Enhancement-Pack-Map-Sources/

# Hexen 2
$GamesQRKOther['Hx2'  ] = array();
$GamesQRKOther['Hx2'  ][] = new cQRKOther('Hexen2Source.ZIP','http://www.fileplanet.com/51987/50000/fileinfo/Hexen-2-Source-Code');

# Half-life
$GamesQRKOther['HL'   ] = array();
#$GamesQRKOther['HL'   ][] = new cQRKOther('HL_Standard_SDK_2_2_Source.zip','http://www.fileplanet.com/81537/80000/fileinfo/Standard-Half-Life-SDK-2.2-(source-only)');
$GamesQRKOther['HL'   ][] = new cQRKOther('hl_sdk_v23_source.exe','http://www.fileplanet.com/81538/80000/fileinfo/Full-Half-Life-SDK-2.3-(source-only)');

# SiN
$GamesQRKOther['SIN'  ] = array();
#$GamesQRKOther['SIN'  ][] = new cQRKOther('sinsrc101.exe',$downloadroot.'sinsrc101.exe');
#$GamesQRKOther['SIN'  ][] = new cQRKOther('sinsrc103.exe',$downloadroot.'sinsrc103.exe');
$GamesQRKOther['SIN'  ][] = new cQRKOther('sin110source.exe',$downloadroot.'sin110source.exe');

# SiN: Wages of Sin
$GamesQRKOther['SINXP'] = array();
$GamesQRKOther['SINXP'][] = new cQRKOther('WOSsrc104.exe',$downloadroot.'WOSsrc104.exe');

# Soldier of Fortune
$GamesQRKOther['SOF'  ] = array();
$GamesQRKOther['SOF'  ][] = new cQRKOther('sofmapfiles.zip','http://www.fileplanet.com/113511/110000/fileinfo/Soldier-of-Fortune-.Map-Source');

# Quake 3: Arena
$GamesQRKOther['Q3A'  ] = array();
$GamesQRKOther['Q3A'  ][] = new cQRKOther('quake3-1.32b-source.zip','http://www.gamers.org/pub/idgames/idstuff/source/quake3-1.32b-source.zip'); #ftp://ftp.idsoftware.com/
$GamesQRKOther['Q3A'  ][] = new cQRKOther('Q3A_ToolSource.exe','http://www.gamers.org/pub/idgames/idstuff/quake3/source/Q3A_ToolSource.exe'); #ftp://ftp.idsoftware.com/

# Quake 3: Team Arena
$GamesQRKOther['Q3TA' ][] = new cQRKOther('Q3A_TA_GameSource_132.exe','http://www.gamers.org/pub/idgames/idstuff/quake3/source/Q3A_TA_GameSource_132.exe'); #ftp://ftp.idsoftware.com/

# Heavy Metal:F.A.K.K.2
$GamesQRKOther['FAKK' ] = array();
$GamesQRKOther['FAKK' ][] = new cQRKOther('fakk2mapsource.zip',$downloadroot.'fakk2mapsource.zip');

# Medal of Honor: Allied Assault
$GamesQRKOther['MOHAA'] = array();
$GamesQRKOther['MOHAA'][] = new cQRKOther('MoH:AA Source Maps','http://medalofhonor.filefront.com/file/MoHAA_Source_Maps;38867');

# Return to Castle Wolfenstein
$GamesQRKOther['RTCW'] = array();
$GamesQRKOther['RTCW'][] = new cQRKOther('RTCW Mod Source Code 1.41 (Windows)','http://returntocastlewolfenstein.filefront.com/file/RTCW_Mod_Source_Code_141;8507');
$GamesQRKOther['RTCW'][] = new cQRKOther('RTCW Single Player Source Code','http://www.gamers.org/pub/idgames/idstuff/source/RTCW-SP-GPL.zip'); #ftp://ftp.idsoftware.com/idstuff/source/RTCW-SP-GPL.zip
$GamesQRKOther['RTCW'][] = new cQRKOther('RTCW Multi Player Source Code','http://www.gamers.org/pub/idgames/idstuff/source/RTCW-MP-GPL.zip'); #ftp://ftp.idsoftware.com/idstuff/source/RTCW-MP-GPL.zip

# Return to Castle Wolfenstein - Enemy Territory
$GamesQRKOther['RTCW-ET'] = array();
$GamesQRKOther['RTCW-ET'][] = new cQRKOther('RTCW-ET Source Code','http://www.gamers.org/pub/idgames/idstuff/source/ET-GPL.zip'); #ftp://ftp.idsoftware.com/idstuff/source/ET-GPL.zip

# Star Trek Voyager: Elite Force
$GamesQRKOther['STVEF'] = array();
$GamesQRKOther['STVEF'][] = new cQRKOther('stvoy_sp_mod_sdk.zip','http://eliteforce2.filefront.com/file/Elite_Force_Single_Player_Source_Code;8020');
#$GamesQRKOther['STVEF'][] = new cQRKOther('stef-gamesource110.zip','http://eliteforce2.filefront.com/file/Elite_Force_HM_Source_Code;805');
$GamesQRKOther['STVEF'][] = new cQRKOther('STEF-GameSource_120.zip','http://www.fileplanet.com/52916/50000/fileinfo/Elite-Force-Source-Code');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_borg_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Borg_map;1072');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_borg_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-borg-map');
#FIXME: Add these too!:
#$GamesQRKOther['STVEF'][] = new cQRKOther('EliteForce_Borg_maps.zip','http://www.fileplanet.com/64450/60000/fileinfo/Borg-Map-Source');
$GamesQRKOther['STVEF'][] = new cQRKOther('brig-map.zip','http://eliteforce2.filefront.com/file/Brig_map;829');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_ctf_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_CTF_map;1075');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_ctf_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-ctf-map');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_dreadnought_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Dreadnought_map;1080');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_dreadnought_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-dreadnought-map');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_forge_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Forge_map;1077');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_forge_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-forge-map');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_holodeck_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Holodeck_map;1076');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_holodeck_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-holodeck-map');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_holomatch_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Holomatch_map;1081');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_holomatch_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-holomatch-map');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_scav_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Scavenger_map;1073');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_scav_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-scavenger-map');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_stasis_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Stasis_map;1078');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_stasis_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-stasis-map');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_virtualvoyager_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Virtual_Voyager_map;1074');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_virtualvoyager_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-virtual-voyager-map');
#$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_voyager_maps.zip','http://eliteforce2.filefront.com/file/Elite_Force_Voyager_map;1079');
$GamesQRKOther['STVEF'][] = new cQRKOther('eliteforce_voyager_maps.zip','https://www.gamefront.com/games/elite-force/file/elite-force-voyager-map');
$GamesQRKOther['STVEF'][] = new cQRKOther('real_scripts.zip','http://eliteforce2.filefront.com/file/Ravens_Elite_Force_Scripts;658');
$GamesQRKOther['STVEF'][] = new cQRKOther('stvef_mappack.zip','https://www.fileplanet.com/archive/p-61997/Elite-Force-Bonus-Holomatch-Map-Pack');

# Star Trek: Elite Force 2
$GamesQRKOther['EF2'  ] = array();
#$GamesQRKOther['EF2'  ][] = new cQRKOther('ef2gamesource.zip','http://www.fileplanet.com/132750/130000/fileinfo/Star-Trek:-Elite-Force-II-Game-DLL-Source');
$GamesQRKOther['EF2'  ][] = new cQRKOther('ef2gamesource.zip','http://eliteforce2.filefront.com/file/Elite_Force_II_Game_Source;20191');

# Doom 3
$GamesQRKOther['DM3'  ] = array();
$GamesQRKOther['DM3'  ][] = new cQRKOther('idtech4-doom3-source-GPL.zip','http://www.gamers.org/pub/idgames/idstuff/source/idtech4-doom3-source-GPL.zip'); #ftp://ftp.idsoftware.com/
$GamesQRKOther['DM3'  ][] = new cQRKOther('DOOM-3-BFG','https://github.com/id-Software/DOOM-3-BFG');

#The Dark Mod
$GamesQRKOther['TDM'  ] = array();
#$GamesQRKOther['TDM'  ][] = new cQRKOther('thedarkmod.2.06.src.7z','https://www.thedarkmod.com/sources/thedarkmod.2.06.src.7z');
#$GamesQRKOther['TDM'  ][] = new cQRKOther('thedarkmod.2.08.src.7z','https://www.thedarkmod.com/sources/thedarkmod.2.08.src.7z');
$GamesQRKOther['TDM'  ][] = new cQRKOther('thedarkmod.2.09.src.7z','https://www.thedarkmod.com/sources/thedarkmod.2.09.src.7z');

#Zaero
$GamesQRKOther['Z'    ] = array();
$GamesQRKOther['Z'    ][] = new cQRKOther('zaero-src-1.1.zip',$downloadroot.'zaero/zaero-src-1.1.zip');

?>
