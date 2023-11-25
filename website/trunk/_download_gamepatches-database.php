<?php
require_once('_main_paths.php');

class cQRKGamePatch
{
	var $Title;       # Name of the game patch
	var $URL;         # URL of the game patch
	var $Description; # Description of the game patch

	function __construct($aTitle, $aURL, $aDescription=NULL)
	{
		$this->Title       = $aTitle;
		$this->URL         = $aURL;
		$this->Description = $aDescription;
	}
}

global $downloadroot;

##
## -- Game Patches --
##
global $GamesQRKGamePatches;
$GamesQRKGamePatches = array();

#American McGee's Alice
$GamesQRKGamePatches['ALICE'] = array();
$GamesQRKGamePatches['ALICE'][] = new cQRKGamePatch('matrox_patch.zip','http://www.gamefront.com/files/1182056/Matrox_Patch');
$GamesQRKGamePatches['ALICE'][] = new cQRKGamePatch('alice_dutch.zip','http://www.gamefront.com/files/1182045/Dutch_subtitle_patch');
$GamesQRKGamePatches['ALICE'][] = new cQRKGamePatch('AMA_Madly_Enhanced_v1.7_Patch.zip','http://www.moddb.com/mods/american-mcgees-alice-madly-enhanced/downloads/american-mcgees-alice-madly-enhanced-v17-patch','American McGee\'s Alice - Madly Enhanced v1.7 Patch');
$GamesQRKGamePatches['ALICE'][] = new cQRKGamePatch('AMA-Win10Fix.exe','https://www.play-old-pc-games.com/2014/02/09/american-mcgees-alice/','American McGee\'s Alice Windows 10 fixer.');
#$GamesQRKGamePatches['ALICE'][] = new cQRKGamePatch('Peixoto.5.zip','http://www.moddb.com/downloads/peixotos-patch-for-american-mcgees-alice'); #New location, kinda: https://www.vogons.org/viewtopic.php?p=572718#p572718
#Add?: http://www.moddb.com/games/american-mcgees-alice/downloads/american-mcgees-alice-overkill-mod

# Anachronox
$GamesQRKGamePatches['AN'   ] = array();
$GamesQRKGamePatches['AN'   ][] = new cQRKGamePatch('AnoxPatch1_01.exe','https://www.moddb.com/games/anachronox/downloads/anachronox-patch-101'); #ftp://ftp.bluesnews.com/anachronox/patches/AnoxPatch1_01.exe
$GamesQRKGamePatches['AN'   ][] = new cQRKGamePatch('anox_build44_patch.exe','https://www.moddb.com/games/anachronox/downloads/anachronox-patch-102-build-44','This patch is <b>not supported by Eidos</b>.');
$GamesQRKGamePatches['AN'   ][] = new cQRKGamePatch('anox_build45_bin.exe','https://www.moddb.com/games/anachronox/downloads/anachronox-patch-102-build-44-to-45','This patch is <b>not supported by Eidos</b>.');
$GamesQRKGamePatches['AN'   ][] = new cQRKGamePatch('anoxpatch102build46.exe','https://www.moddb.com/games/anachronox/downloads/anachronox-patch-102-build-45-to-46','This patch is <b>not supported by Eidos</b>.');

#Call of Duty
$GamesQRKGamePatches['CoD'  ] = array();
#$GamesQRKGamePatches['CoD'  ][] = new cQRKGamePatch('CoD_1.4_Patch.exe','http://www.activision.com/ROOT/media/brands/Call of Duty/Call of Duty/patches/CoD_1.4_Patch.exe');
$GamesQRKGamePatches['CoD'  ][] = new cQRKGamePatch('CoD_1.5_Patch.exe','https://gamefront.online/files/3762516/CoD_1.5_Patch.exe');
$GamesQRKGamePatches['CoD'  ][] = new cQRKGamePatch('cod 1.5b BETA.zip','https://gamefront.online/files/3773465/cod%201.5b%20BETA.zip');

#Call of Duty: United Offense
$GamesQRKGamePatches['CoDuo'] = array();
$GamesQRKGamePatches['CoDuo'][] = new cQRKGamePatch('coduo_patch.exe','https://www.fileplanet.com/148646/140000/fileinfo/Call-of-Duty:-United-Offensive-v1.51-Patch');

#Call of Duty 2
$GamesQRKGamePatches['CoD2' ] = array();
$GamesQRKGamePatches['CoD2' ][] = new cQRKGamePatch('CallofDuty2Patchv1_3.exe','https://www.fileplanet.com/162314/160000/fileinfo/Call-of-Duty-2-Patch-v1.3'); #http://www.activision.com/ROOT/media/brands/Call of Duty/Call of Duty 2/patches/CallofDuty2Patchv1_3.exe

#Call of Duty 4: Modern Warfare
$GamesQRKGamePatches['CoD4' ] = array();
$GamesQRKGamePatches['CoD4' ][] = new cQRKGamePatch('CoD4MW-1.6-PatchSetup.exe','https://www.moddb.com/games/call-of-duty-4-modern-warfare/downloads/call-of-duty-4-modern-warfare-v16-patch');
$GamesQRKGamePatches['CoD4' ][] = new cQRKGamePatch('CoD4MW-1.6-1.7-PatchSetup.exe','https://www.moddb.com/games/call-of-duty-4-modern-warfare/downloads/call-of-duty-4-modern-warfare-v17-patch');

#Catechumen
$GamesQRKGamePatches['C'    ] = array();
$GamesQRKGamePatches['C'    ][] = new cQRKGamePatch('latest.exe',$downloadroot.'latest.exe','Catechumen Patch 1.01 (436 KB)');

#Counter-Strike
$GamesQRKGamePatches['CS'   ] = array();
$GamesQRKGamePatches['CS'   ][] = new cQRKGamePatch('cs1005.exe','http://www.fileplanet.com/62470/60000/fileinfo/Counter-Strike-v1.5-Full-Retail-Patch');

#Daikatana
$GamesQRKGamePatches['DK'   ] = array();
$GamesQRKGamePatches['DK'   ][] = new cQRKGamePatch('dk_us_10_12.exe','http://www.fileplanet.com/47141/40000/fileinfo/Daikatana-v1.0---v1.2-Patch');

#Day of Defeat (Original MOD) http://dayofdefeatmod.com
#$GamesQRKGamePatches[''     ] = array();
#$GamesQRKGamePatches[''     ][] = new cQRKGamePatch('dod_v3031.exe','https://www.fileplanet.com/archive/p-75419/Day-of-Defeat-3-1-Patch','Day of Defeat 3.0 - 3.1 Upgrade');

#Digital Paint: Paintball 2
$GamesQRKGamePatches['PB2'  ] = array();
$GamesQRKGamePatches['PB2'  ][] = new cQRKGamePatch('paintball2_build045_update.exe','https://sourceforge.net/projects/paintball2/files/Paintball%202/Paintball%202.0%20Alpha%20build045/paintball2_build045_update.exe/download');

#Doom 3
$GamesQRKGamePatches['DM3'  ] = array();
$GamesQRKGamePatches['DM3'  ][] = new cQRKGamePatch('DOOM3-1.3.1.exe','http://www.gamers.org/pub/idgames/idstuff/doom3/win32/DOOM3-1.3.1.exe'); #ftp://ftp.idsoftware.com/

#Half-Life
$GamesQRKGamePatches['HL'   ] = array();
$GamesQRKGamePatches['HL'   ][] = new cQRKGamePatch('hl1110.exe','http://www.fileplanet.com/57317/50000/fileinfo/Half-Life-1.1.1.0-Client-(Full-Client)');
$GamesQRKGamePatches['HL'   ][] = new cQRKGamePatch('hl1111_release.exe','http://www.fileplanet.com/155583/150000/fileinfo/Half-Life-1.1.1.1-Update');
#$GamesQRKGamePatches['HL'   ][] = new cQRKGamePatch('of1101.exe','http://www.fileplanet.com/47323/40000/fileinfo/Opposing-Force-patch-upgrade-v1.1.0.1');
$GamesQRKGamePatches['HL'   ][] = new cQRKGamePatch('of1106.exe','https://www.fileplanet.com/57356/50000/fileinfo/Opposing-Force-1.1.0.6-Client-Patch-[English]');
$GamesQRKGamePatches['HL'   ][] = new cQRKGamePatch('bspatch.exe','https://www.fileplanet.com/85965/80000/fileinfo/Half-Life:-Blue-Shift-1.0.0.1-Update-(English)');

#Heavy Metal: FAKK2
$GamesQRKGamePatches['FAKK' ] = array();
#$GamesQRKGamePatches['FAKK' ][] = new cQRKGamePatch('fakk2_101.exe','http://www.fileplanet.com/48593/40000/fileinfo/Heavy-Metal:-FAKK2-Patch-to-v1.01');
$GamesQRKGamePatches['FAKK' ][] = new cQRKGamePatch('fakk2_102.exe','http://www.fileplanet.com/49307/40000/fileinfo/Heavy-Metal:-FAKK2-v.1.02-patch');

#Heretic 2
$GamesQRKGamePatches['Hr2'  ] = array();
$GamesQRKGamePatches['Hr2'  ][] = new cQRKGamePatch('Ht2_EP_v1-06.exe','https://www.fileplanet.com/22357/20000/fileinfo/Heretic-II-Enhancement-Pack-v1.06'); #http://www.filefront.com/7777/Heretic-II-Enhancement-Pack-v1.06/

#Hexen 2
$GamesQRKGamePatches['Hx2'  ] = array();
$GamesQRKGamePatches['Hx2'  ][] = new cQRKGamePatch('ph2v111.exe','http://www.filefront.com/5847/Hexen-II-v1.11-Patch/');
$GamesQRKGamePatches['Hx2'  ][] = new cQRKGamePatch('h2mp_patch_v112a.exe','http://www.filefront.com/5848/Hexen-II-Mission-Pack-Patch-Version-v.1.12a/');
#$GamesQRKGamePatches['Hx2'  ][] = new cQRKGamePatch('Hexen II v1.15 Unofficial Patch (4.9M)','http://pa3pyx.dnsalias.org/stuff/h2v115.zip');
#$GamesQRKGamePatches['Hx2'  ][] = new cQRKGamePatch('Hexen II Portal of Praevus v1.15 Unofficial Patch (2.1M)','http://pa3pyx.dnsalias.org/stuff/h2popv115.zip');
#$GamesQRKGamePatches['Hx2'  ][] = new cQRKGamePatch('Hexen II v1.15 Unofficial Patch (Source Code)(1.5M)','http://pa3pyx.dnsalias.org/stuff/h2v115src.zip');

#King-pin
$GamesQRKGamePatches['KP'   ] = array();
$GamesQRKGamePatches['KP'   ][] = new cQRKGamePatch('kingpin_v121_patch.exe','http://www.fileplanet.com/27679/20000/fileinfo/Kingpin-v1.21');

#Medal of Honor
$GamesQRKGamePatches['MOHAA'] = array();
$GamesQRKGamePatches['MOHAA'][] = new cQRKGamePatch('ukusonly_patch111v9safedisk.exe','http://www.fileplanet.com/84126/80000/fileinfo/Medal-of-Honor-Patch---Multiplayer-v1.11-(US/UK)');

#Medal of Honor: Breakthrough
$GamesQRKGamePatches['MOHAAB'] = array();
#$GamesQRKGamePatches['MOHAAB'][] = new cQRKGamePatch('breakthrough_patch_2.40b.exe','http://www.fileplanet.com/134156/130000/fileinfo/MOHAA:-Breakthrough-Version-2.40-Patch');
$GamesQRKGamePatches['MOHAAB'][] = new cQRKGamePatch('breakthrough_patch_2.40b.exe','http://www.gamefront.com/files/1551385/breakthrough_patch_2.40b.exe');

#Medal of Honor: Spearhead
$GamesQRKGamePatches['MOHAAS'] = array();
#$GamesQRKGamePatches['MOHAAS'][] = new cQRKGamePatch('mohaas_patch_20_to_211.exe','http://www.fileplanet.com/117673/110000/fileinfo/MOHAA:-Spearhead-v2.11Retail-Patch');
$GamesQRKGamePatches['MOHAAS'][] = new cQRKGamePatch('mohaas_patch_20_to_211.exe','http://www.gamefront.com/files/687360/mohaas_patch_20_to_211.exe');
#$GamesQRKGamePatches['MOHAAS'][] = new cQRKGamePatch('mohaas_patch_211_to_215.exe','http://www.fileplanet.com/121172/120000/fileinfo/MOHAA:-Spearhead-v2.11---v2.15-Patch');
$GamesQRKGamePatches['MOHAAS'][] = new cQRKGamePatch('mohaas_patch_211_to_215.zip','http://www.gamefront.com/files/826704/mohaas_patch_211_to_215.zip');

#Ominous Horizons: A Paladin's Calling
$GamesQRKGamePatches['OH'   ] = array();
$GamesQRKGamePatches['OH'   ][] = new cQRKGamePatch('latest_oh.exe',$downloadroot.'latest_oh.exe','Ominous Horizons Patch 1.1 (932 KB)');

#Open Arena
$GamesQRKGamePatches['OA'   ] = array();
$GamesQRKGamePatches['OA'   ][] = new cQRKGamePatch('oa085p.zip','http://openarena.ws/request.php?3','OpenArena v0.8.5 patch');
$GamesQRKGamePatches['OA'   ][] = new cQRKGamePatch('oa088p.zip','http://openarena.ws/request.php?5','OpenArena v0.8.8 patch');

#Prey
$GamesQRKGamePatches['PREY' ] = array();
$GamesQRKGamePatches['PREY' ][] = new cQRKGamePatch('SetupPreyPt14.zip','http://downloads.2kgames.com/prey/SetupPreyPt14.zip');

#Quake 1
$GamesQRKGamePatches['Q1'   ] = array();
$GamesQRKGamePatches['Q1'   ][] = new cQRKGamePatch('q101-106.zip','http://www.gamers.org/pub/idgames/idstuff/quake/q101-106.zip','Quake 1.01 to 1.06 patch'); #http://www.fileplanet.com/86878/download/q101-106.zip #ftp://ftp.idsoftware.com/
$GamesQRKGamePatches['Q1'   ][] = new cQRKGamePatch('quake108.zip','http://www.gamers.org/pub/idgames/idstuff/quake/quake108.zip','Quake 1.08 patch'); #http://www.fileplanet.com/86879/download/quake108.zip #ftp://ftp.idsoftware.com/
$GamesQRKGamePatches['Q1'   ][] = new cQRKGamePatch('glq1114.exe','http://www.gamers.org/pub/idgames/idstuff/unsup/glq1114.exe'); #http://planetquake.gamespy.com/fms/Download.php?id=3081 #ftp://ftp.idsoftware.com/
$GamesQRKGamePatches['Q1'   ][] = new cQRKGamePatch('qw230.exe','http://www.gamers.org/pub/idgames/idstuff/quakeworld/qw230.exe','QuakeWorld Client v2.30'); #http://www.fileplanet.com/6680/download/qw230.exe #ftp://ftp.idsoftware.com/

#Quake 2
$GamesQRKGamePatches['Q2'   ] = array();
#$GamesQRKGamePatches['Q2'   ][] = new cQRKGamePatch('q2-3.20-x86-full.exe','https://www.gamers.org/pub/idgames/idstuff/quake2/q2-3.20-x86-full.exe');
$GamesQRKGamePatches['Q2'   ][] = new cQRKGamePatch('q2-3.20-x86-full-ctf.exe','http://www.gamers.org/pub/idgames/idstuff/quake2/q2-3.20-x86-full-ctf.exe'); #ftp://ftp.idsoftware.com/
#$GamesQRKGamePatches['Q2'   ][] = new cQRKGamePatch('quake2-3.24-win32.zip','http://kmq2.toastednet.org/downloads/quake2-3.24-win32.zip','Quake2 Unofficial v3.24 Patch - Win32 Binaries');
#$GamesQRKGamePatches['Q2'   ][] = new cQRKGamePatch('q2-3.24-x86-full-ctf-1.5.zip','http://kmq2.toastednet.org/downloads/q2-3.24-x86-full-ctf-1.5.zip','Quake2 Unofficial v3.24 Patch - Win32 Binaries (Full Patch w/ CTF 1.5)');
$GamesQRKGamePatches['Q2'   ][] = new cQRKGamePatch('q2-3.24-x86-full-ctf-1.5.exe','http://kmq2.toastednet.org/downloads/q2-3.24-x86-full-ctf-1.5.exe','Quake2 Unofficial v3.24 Patch - Win32 Binaries (Full Patch w/ CTF 1.5 self-extractor)');
#$GamesQRKGamePatches['Q2'   ][] = new cQRKGamePatch('http://kmq2.toastednet.org/downloads/quake2-3.24-src.7z','http://kmq2.toastednet.org/downloads/quake2-3.24-src.7z','Quake2 Unofficial v3.24 Patch - Source Code');
#$GamesQRKGamePatches['Q2'   ][] = new cQRKGamePatch('http://kmq2.toastednet.org/downloads/quake2-3.24-src-missionpack.7z','http://kmq2.toastednet.org/downloads/quake2-3.24-src-missionpack.7z','Quake2 Unofficial v3.24 Patch - Rogue/Xatrix Missionpack Source Code');

#Quake 3: Arena
$GamesQRKGamePatches['Q3A'  ] = array();
$GamesQRKGamePatches['Q3A'  ][] = new cQRKGamePatch('q3pointrelease_132.exe','http://www.gamers.org/pub/idgames/idstuff/quake3/win32/q3pointrelease_132.exe'); #ftp://ftp.idsoftware.com/
#$GamesQRKGamePatches['Q3A'  ][] = new cQRKGamePatch('quake3132cwin.zip','http://www.fileplanet.com/hosteddl.aspx?/planetquake/fms/files/quake3/2211/quake3132cwin.zip');
$GamesQRKGamePatches['Q3A'  ][] = new cQRKGamePatch('quake3-1.32c.zip','http://www.gamers.org/pub/idgames/idstuff/quake3/quake3-1.32c.zip'); #ftp://ftp.idsoftware.com/
#$GamesQRKGamePatches['Q3A'  ][] = new cQRKGamePatch('TA_mappak1b.zip','http://www.gamers.org/pub/idgames/idstuff/teamarena/map_paks/TA_mappak1b.zip'); #ftp://ftp.idsoftware.com/
#$GamesQRKGamePatches['Q3A'  ][] = new cQRKGamePatch('TA_mappak2.zip','http://www.gamers.org/pub/idgames/idstuff/teamarena/map_paks/TA_mappak2.zip'); #ftp://ftp.idsoftware.com/
#$GamesQRKGamePatches['Q3A'  ][] = new cQRKGamePatch('hal9000_b_ta.zip','http://www.gamers.org/pub/idgames/idstuff/teamarena/map_paks/hal9000_b_ta.zip'); #ftp://ftp.idsoftware.com/

#Quake 4
$GamesQRKGamePatches['Q4'   ] = array();
$GamesQRKGamePatches['Q4'   ][] = new cQRKGamePatch('Quake4-1.4.2.exe','http://www.gamers.org/pub/idgames/idstuff/quake4/win32/Quake4-1.4.2.exe'); #ftp://ftp.idsoftware.com/

#Return to Castle Wolfenstein
$GamesQRKGamePatches['RTCW' ] = array();
#$GamesQRKGamePatches['RTCW' ][] = new cQRKGamePatch('Wolf_Update_1_41.exe','http://www.activision.com/ROOT/media/brands/Wolfenstein/Return to Castle Wolfenstein/patches/Wolf_Update_1_41.exe');
$GamesQRKGamePatches['RTCW' ][] = new cQRKGamePatch('Wolf_Update_1_41.exe','http://www.activision.com/ROOT/media/brands/Wolfenstein/Return%20to%20Castle%20Wolfenstein/patches/Wolf_Update_1_41.exe');

#Enemy Territory: Wolfenstein
$GamesQRKGamePatches['RTCW-ET'] = array();
#$GamesQRKGamePatches['RTCW-ET'][] = new cQRKGamePatch('ET_Patch_2_60.exe','http://www.activision.com/ROOT/media/brands/Wolfenstein/Return to Castle Wolfenstein/patches/ET_Patch_2_60.exe');
$GamesQRKGamePatches['RTCW-ET'][] = new cQRKGamePatch('ET_Patch_2_60.exe','http://www.activision.com/ROOT/media/brands/Wolfenstein/Return%20to%20Castle%20Wolfenstein/patches/ET_Patch_2_60.exe');

#Sin
$GamesQRKGamePatches['SIN' ] = array();
$GamesQRKGamePatches['SIN' ][] = new cQRKGamePatch('Sin_111_from_100.exe','http://www.fileplanet.com/55786/50000/fileinfo/Sin-1.00---1.11-Update');

#Soldier of Fortune
$GamesQRKGamePatches['SOF' ] = array();
$GamesQRKGamePatches['SOF' ][] = new cQRKGamePatch('sof104patch.exe','http://www.fileplanet.com/41670/40000/fileinfo/Soldier-of-Fortune-v1.04');
#These are really SoF1?
#http://www.activision.com/ROOT/media/brands/Soldier of Fortune_ATVICat/SoldierofFortuneII Gold/patches/SoF107patch.exe
#http://www.activision.com/ROOT/media/brands/Soldier of Fortune_ATVICat/SoldierofFortuneII Gold/patches/SoFMappack.zip

#Soldier of Fortune 2
$GamesQRKGamePatches['SOF2' ] = array();
#$GamesQRKGamePatches['SOF2' ][] = new cQRKGamePatch('sof2goldlite.exe','http://www.fileplanet.com/118480/110000/fileinfo/Soldier-of-Fortune-II-Gold-Patch-(Lite)');
#$GamesQRKGamePatches['SOF2' ][] = new cQRKGamePatch('sof2goldfull.exe','http://www.fileplanet.com/118479/110000/fileinfo/Soldier-of-Fortune-II-Gold-Patch-(Full)');
#http://www.activision.com/ROOT/media/brands/Soldier of Fortune_ATVICat/SoldierofFortuneII Gold/patches/sof2_1_2Patch.exe
#http://www.activision.com/ROOT/media/brands/Soldier of Fortune_ATVICat/SoldierofFortuneII Gold/patches/sof2-101patch.exe
$GamesQRKGamePatches['SOF2' ][] = new cQRKGamePatch('Soldier_of_Fortune_2_Gold_v1.03_Full.zip','http://www.activision.com/ROOT/media/brands/Soldier of Fortune_ATVICat/SoldierofFortuneII Gold/patches/Soldier_of_Fortune_2_Gold_v1.03_Full.zip');

#Soldier of Fortune: Payback
$GamesQRKGamePatches['SoFP' ] = array();
$GamesQRKGamePatches['SoFP' ][] = new cQRKGamePatch('SOFPayback_v1.1.EXE','http://www.fileplanet.com/182572/180000/fileinfo/Soldier-of-Fortune:-Payback---v1.1-Patch');

#Star Trek: Elite Force 2
$GamesQRKGamePatches['EF2'  ] = array();
$GamesQRKGamePatches['EF2'  ][] = new cQRKGamePatch('ef2_patch1.1.exe','http://www.fileplanet.com/131329/130000/fileinfo/Star-Trek:-Elite-Force-II-v1.1-Patch');
$GamesQRKGamePatches['EF2'  ][] = new cQRKGamePatch('ef2_rom_shuttle_fix.zip','https://www.moddb.com/games/star-trek-elite-force-ii/downloads/romulan-invisible-shuttle-fix-1-0','(Unofficial) Corrects a bug that makes the shuttle invisible during the Romulan mission after you patch the game to version 1.1.');
$GamesQRKGamePatches['EF2'  ][] = new cQRKGamePatch('ef2_multiplayer_master_server_fix-100.zip', 'https://www.moddb.com/mods/star-trek-elite-force-ii-coop-hazardmodding/downloads/master-server-patch-for-star-trek-elite-force-2', '(Unofficial) It allows your game to get the Server List from the new community master server, to host and join Internet Servers from inside the game again.');

#Star Trek Voyager: Elite Force
$GamesQRKGamePatches['STVEF'] = array();
#FIXME: Add 1.1 patch too!
$GamesQRKGamePatches['STVEF'][] = new cQRKGamePatch('EliteForcePatch1_2.EXE','http://www.fileplanet.com/59845/50000/fileinfo/Elite-Force-v.1.2-Patch');

# Star Wars Jedi Knight 2: Jedi Outcast
$GamesQRKGamePatches['JK2'  ] = array();
#$GamesQRKGamePatches['JK2'  ][] = new cQRKGamePatch('JKIIUp5_6.exe','ftp://ftp.lucasarts.com/patches/pc/JKIIUp5_6.exe');
$GamesQRKGamePatches['JK2'  ][] = new cQRKGamePatch('JKIIUp104.exe','ftp://ftp.lucasarts.com/patches/pc/JKIIUp104.exe');

# Star Wars Jedi Knight: Jedi Academy
$GamesQRKGamePatches['JA'   ] = array();
$GamesQRKGamePatches['JA'   ][] = new cQRKGamePatch('JKAcademy1_01.exe','ftp://ftp.lucasarts.com/patches/pc/JKAcademy1_01.exe');

#Wolfenstein
$GamesQRKGamePatches['WOLF' ] = array();
#$GamesQRKGamePatches['WOLF' ][] = new cQRKGamePatch('Wolfenstein-1_11_PatchSetup.exe','http://www.fileplanet.com/203811/200000/fileinfo/Wolfenstein-Patch-v1.11');
$GamesQRKGamePatches['WOLF' ][] = new cQRKGamePatch('Wolfenstein_1_2_PatchSetup.exe','http://www.fileplanet.com/203811/200000/fileinfo/Wolfenstein-Patch-v1.2');

#Warsow
$GamesQRKGamePatches['W'    ] = array();
#$GamesQRKGamePatches['W'    ][] = new cQRKGamePatch('warsow_0.62_update.zip','http://www.zcdn.org/dl/warsow_0.62_update.zip');
#$GamesQRKGamePatches['W'    ][] = new cQRKGamePatch('warsow_1.02_update.zip','http://hangy.warsow.net/warsow_1.02_update.zip'); #http://www.zcdn.org/dl/1.02/warsow_1.02_update.zip #http://www.warsow.net:1337/~warsow/1.02/warsow_1.02_update.zip
$GamesQRKGamePatches['W'    ][] = new cQRKGamePatch('warsow_1.51_update.tar.gz','http://hangy.warsow.net/warsow_1.51_update.tar.gz');

#World of Padman
$GamesQRKGamePatches['PAD'  ] = array();
#$GamesQRKGamePatches['PAD'  ][] = new cQRKGamePatch('wop-1.5.1-hotfix.zip','http://mirror.exp.de/games/WoP/wop-1.5.1-hotfix.zip');
#$GamesQRKGamePatches['PAD'  ][] = new cQRKGamePatch('wop-1.5.x-to-1.6-patch-unified.zip','http://mirror.exp.de/games/worldofpadman/wop-1.5.x-to-1.6-patch-unified.zip');
#$GamesQRKGamePatches['PAD'  ][] = new cQRKGamePatch('wop-1.6.1-patch-unified.zip','https://www.moddb.com/games/world-of-padman/downloads/wop-161-patch-unified-zip-windowslinuxmacos');
$GamesQRKGamePatches['PAD'  ][] = new cQRKGamePatch('wop-1.6.2-patch-unified.zip','https://www.moddb.com/games/world-of-padman/downloads/wop-162-patch-unified-zip-windowslinuxmacos');

#Zaero
$GamesQRKGamePatches['Z'    ] = array();
$GamesQRKGamePatches['Z'    ][] = new cQRKGamePatch('zaero-1.1.zip',$downloadroot.'zaero/zaero-1.1.zip','Zaero 1.1 patch');

?>
