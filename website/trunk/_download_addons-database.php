<?php
require_once('_main_paths.php');

class cQRKAddon
{
	var $Title;           # Readable title of QRK addon
	var $TitleURL;        # Optional URL for more info of the title
	var $TitleComment;    # Optional more comment-text for title
	var $Filename;        # Filename of the QRK addon
	var $FileDownloadURL; # DownloadURL of the QRK addon
	var $FileComment;     # Optional more comment-text for file

	function __construct($aTitle, $aTitleURL='', $aTitleComment='', $aFilename='', $aFileDownloadURL='', $aFileComment='')
	{
		$this->Title           = $aTitle;
		$this->TitleURL        = $aTitleURL;
		$this->TitleComment    = $aTitleComment;
		$this->Filename        = $aFilename;
		$this->FileDownloadURL = $aFileDownloadURL;
		$this->FileComment     = $aFileComment;
	}
}

global $mainroot;
global $svnroot;
global $infobaseroot;
global $downloadroot;

##
## -- QuArK Addons --
##
$OfficialQRKAddon = "(Directly from our <a href=\"".$svnroot."runtime/trunk/addons/\">SourceForge SVN Repository</a>)";

global $GamesQRKAddons;
$GamesQRKAddons = array();

#               Short abbreviation of game-name (Look at the $Games array above)
#               |                          Add-on title
#               |                          |                          Add-on info-URL (optional)
#               |                          |                          |                                              Add-on extra comments (optional)
#               |                          |                          |                                              |   Add-on filename
#               |                          |                          |                                              |   |                   Add-on download URL
#               |                          |                          |                                              |   |                   |                                                                                                           Add-on filename extra comments
#               |                          |                          |                                              |   |                   |                                                                                                           |

# 6DX
$GamesQRKAddons["6DX"  ] = array();
$GamesQRKAddons["6DX"  ][] = new cQRKAddon("6DX"                      ,""                                           ,"" ,"6DXEntities.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/6DX/6DXEntities.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["6DX"  ][] = new cQRKAddon("6DX"                      ,""                                           ,"" ,"Data6DX.qrk"         ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/6DX/Data6DX.qrk?format=raw"              ,$OfficialQRKAddon);
$GamesQRKAddons["6DX"  ][] = new cQRKAddon("6DX"                      ,""                                           ,"" ,"UserData 6DX.qrk"    ,
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/6DX/UserData 6DX.qrk?format=raw"         ,$OfficialQRKAddon);

# Alice
$GamesQRKAddons["ALICE"] = array();
$GamesQRKAddons["ALICE"][] = new cQRKAddon("Alice"                    ,""                                           ,"" ,"AliceEntities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Alice/AliceEntities.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["ALICE"][] = new cQRKAddon("Alice"                    ,""                                           ,"" ,"AliceScripts.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Alice/AliceScripts.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["ALICE"][] = new cQRKAddon("Alice"                    ,""                                           ,"" ,"AliceTextures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Alice/AliceTextures.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["ALICE"][] = new cQRKAddon("Alice"                    ,""                                           ,"" ,"AliceWeapon-ModelEntities.qrk",
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Alice/AliceWeapon-ModelEntities.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["ALICE"][] = new cQRKAddon("Alice"                    ,""                                           ,"" ,"DataAlice.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Alice/DataAlice.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["ALICE"][] = new cQRKAddon("Alice"                    ,""                                           ,"" ,"UserData Alice.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Alice/UserData Alice.qrk?format=raw"     ,$OfficialQRKAddon);

# Call of Duty 1
$GamesQRKAddons["CoD"  ] = array();
$GamesQRKAddons["CoD"  ][] = new cQRKAddon("Call of Duty"             ,""                                           ,"" ,"DataCoD1.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD1/DataCoD1.qrk?format=raw"            ,$OfficialQRKAddon);
$GamesQRKAddons["CoD"  ][] = new cQRKAddon("Call of Duty"             ,""                                           ,"" ,"CoD1Entities.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD1/CoD1Entities.qrk?format=raw"        ,$OfficialQRKAddon);
$GamesQRKAddons["CoD"  ][] = new cQRKAddon("Call of Duty"             ,""                                           ,"" ,"CoD1Textures.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD1/CoD1Textures.qrk?format=raw"        ,$OfficialQRKAddon);
$GamesQRKAddons["CoD"  ][] = new cQRKAddon("Call of Duty"             ,""                                           ,"" ,"UserData CoD1.qrk"   ,
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD1/UserData CoD1.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["CoD"  ][] = new cQRKAddon("Call of Duty: United Offensive" ,""                                           ,"" ,"CoD1UOEntities.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD1/CoD1UOEntities.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["CoD"  ][] = new cQRKAddon("Call of Duty: United Offensive" ,""                                           ,"" ,"CoD1UOTextures.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD1/CoD1UOTextures.qrk?format=raw"      ,$OfficialQRKAddon);

# Call of Duty 1: United Offensive (yes, this is a double-entry)
$GamesQRKAddons["CoDuo"] = array();
$GamesQRKAddons["CoDuo"][] = new cQRKAddon("Call of Duty: United Offensive" ,""                                           ,"" ,"CoD1UOEntities.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD1/CoD1UOEntities.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["CoDuo"][] = new cQRKAddon("Call of Duty: United Offensive" ,""                                           ,"" ,"CoD1UOTextures.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD1/CoD1UOTextures.qrk?format=raw"      ,$OfficialQRKAddon);

# Call of Duty 2
$GamesQRKAddons["CoD2" ] = array();
$GamesQRKAddons["CoD2" ][] = new cQRKAddon("Call of Duty 2"           ,""                                           ,"" ,"DataCoD2.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD2/DataCoD2.qrk?format=raw"            ,$OfficialQRKAddon);
$GamesQRKAddons["CoD2" ][] = new cQRKAddon("Call of Duty 2"           ,""                                           ,"" ,"CoD2Entities.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD2/CoD2Entities.qrk?format=raw"        ,$OfficialQRKAddon);
$GamesQRKAddons["CoD2" ][] = new cQRKAddon("Call of Duty 2"           ,""                                           ,"" ,"CoD2Textures.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD2/CoD2Textures.qrk?format=raw"        ,$OfficialQRKAddon);
$GamesQRKAddons["CoD2" ][] = new cQRKAddon("Call of Duty 2"           ,""                                           ,"" ,"UserData CoD2.qrk"   ,
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/CoD2/UserData CoD2.qrk?format=raw"       ,$OfficialQRKAddon);

# Counter-strike
$GamesQRKAddons["CS"   ] = array();
$GamesQRKAddons["CS"   ][] = new cQRKAddon("Counter-Strike"           ,"http://www.counter-strike.net"              ,"" ,"DataHL.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/DataHL.qrk?format=raw"             ,$OfficialQRKAddon."<br><a href=\"".$downloadroot."addons/half-life/datahl_20020714.zip\">DataHL_20020714.zip</a> (Dated 2002-07-14)"); #http://www.fileplanet.com/dl/dl.asp?/planetquake/quark/addons/half-life/DataHL_20020714.zip

# Counterstrike: Source
$GamesQRKAddons["CSS"  ] = array();
$GamesQRKAddons["CSS"  ][] = new cQRKAddon("Counter-Strike: Source"   ,""                                           ,"" ,"entities-css.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/entities-css.qrk?format=raw"  ,$OfficialQRKAddon);
$GamesQRKAddons["CSS"  ][] = new cQRKAddon("Counter-Strike: Source"   ,""                                           ,"" ,"textures-css.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/textures-css.qrk?format=raw" ,$OfficialQRKAddon);

# Cry of Fear
$GamesQRKAddons["CoF"  ] = array();
$GamesQRKAddons["CoF"  ][] = new cQRKAddon("Cry of Fear"              ,""                                           ,"" ,"DataCoF.qrk"             ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Cry_of_Fear/DataCoF.qrk?format=raw"              ,$OfficialQRKAddon);
$GamesQRKAddons["CoF"  ][] = new cQRKAddon("Cry of Fear"              ,""                                           ,"" ,"CoFEntities.qrk"         ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Cry_of_Fear/CoFEntities.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["CoF"  ][] = new cQRKAddon("Cry of Fear"              ,""                                           ,"" ,"CoFTextures.qrk"         ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Cry_of_Fear/CoFTextures.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["CoF"  ][] = new cQRKAddon("Cry of Fear"              ,""                                           ,"" ,"UserData Cry of Fear.qrk",
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Cry_of_Fear/UserData Cry of Fear.qrk?format=raw" ,$OfficialQRKAddon);

# Crystal Space
$GamesQRKAddons["CrSp" ] = array();
$GamesQRKAddons["CrSp" ][] = new cQRKAddon("Crystal Space"            ,""                                           ,"" ,"CSEntities.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Crystal_Space/CSEntities.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["CrSp" ][] = new cQRKAddon("Crystal Space"            ,""                                           ,"" ,"CSTextures.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Crystal_Space/CSTextures.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["CrSp" ][] = new cQRKAddon("Crystal Space"            ,""                                           ,"" ,"DataCS.qrk"          ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Crystal_Space/DataCS.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["CrSp" ][] = new cQRKAddon("Crystal Space"            ,""                                           ,"" ,"UserData Crystal Space.qrk",
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Crystal_Space/UserData Crystal Space.qrk?format=raw" ,$OfficialQRKAddon);

# Day of Defeat
$GamesQRKAddons["DAY"  ] = array();
$GamesQRKAddons["DAY"  ][] = new cQRKAddon("Day of Defeat"            ,"http://www.dayofdefeatmod.com"              ,"" ,"DataHL.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/DataHL.qrk?format=raw"             ,$OfficialQRKAddon."<br><a href=\"".$downloadroot."addons/half-life/datahl_20020714.zip\">DataHL_20020714.zip</a> (Dated 2002-07-14)"); #http://www.fileplanet.com/dl/dl.asp?/planetquake/quark/addons/half-life/DataHL_20020714.zip

# Day of Defeat: Source
$GamesQRKAddons["DAYS" ] = array();
$GamesQRKAddons["DAYS" ][] = new cQRKAddon("Day of Defeat: Source"    ,""                                           ,"" ,"entities-dod.qrk",
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/entities-dod.qrk?format=raw" ,$OfficialQRKAddon);

# Doom3
$GamesQRKAddons["DM3"  ] = array();
$GamesQRKAddons["DM3"  ][] = new cQRKAddon("Doom 3"                   ,""                                           ,"" ,"DataD3.qrk"          ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Doom_3/DataD3.qrk?format=raw"            ,$OfficialQRKAddon);
$GamesQRKAddons["DM3"  ][] = new cQRKAddon("Doom 3"                   ,""                                           ,"" ,"Doom3Entities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Doom_3/Doom3Entities.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["DM3"  ][] = new cQRKAddon("Doom 3"                   ,""                                           ,"" ,"Doom3Materials.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Doom_3/Doom3Materials.qrk?format=raw"    ,$OfficialQRKAddon);
$GamesQRKAddons["DM3"  ][] = new cQRKAddon("Doom 3"                   ,""                                           ,"" ,"UserData Doom 3.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Doom_3/DataD3.qrk?format=raw"            ,$OfficialQRKAddon);

# Star Trek: Elite Force 2
$GamesQRKAddons["EF2"  ] = array();
$GamesQRKAddons["EF2"  ][] = new cQRKAddon("Star Trek: Elite Force 2" ,""                                           ,"" ,"DataEF2.qrk"         ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/EF2/DataEF2.qrk?format=raw"              ,$OfficialQRKAddon);
$GamesQRKAddons["EF2"  ][] = new cQRKAddon("Star Trek: Elite Force 2" ,""                                           ,"" ,"EF2Entities.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/EF2/EF2Entities.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["EF2"  ][] = new cQRKAddon("Star Trek: Elite Force 2" ,""                                           ,"" ,"EF2Shaders.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/EF2/EF2Shaders.qrk?format=raw"           ,$OfficialQRKAddon);
$GamesQRKAddons["EF2"  ][] = new cQRKAddon("Star Trek: Elite Force 2" ,""                                           ,"" ,"EF2Textures.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/EF2/EF2Textures.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["EF2"  ][] = new cQRKAddon("Star Trek: Elite Force 2" ,""                                           ,"" ,"EF2Weapon-ModelEntities.qrk",
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/EF2/EF2Weapon-ModelEntities.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["EF2"  ][] = new cQRKAddon("Star Trek: Elite Force 2" ,""                                           ,"" ,"UserData EF2.qrk"    ,
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/EF2/UserData EF2.qrk?format=raw"         ,$OfficialQRKAddon);

# Heavy Metal:F.A.K.K.2
$GamesQRKAddons["FAKK" ] = array();
$GamesQRKAddons["FAKK" ][] = new cQRKAddon("Heavy Metal: F.A.K.K.2"   ,""                                           ,"" ,"DataFAKK2.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/FAKK2/DataFAKK2.qrk?format=raw"             ,$OfficialQRKAddon);
$GamesQRKAddons["FAKK" ][] = new cQRKAddon("Heavy Metal: F.A.K.K.2"   ,""                                           ,"" ,"FAKK2Entities.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/FAKK2/FAKK2Entities.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["FAKK" ][] = new cQRKAddon("Heavy Metal: F.A.K.K.2"   ,""                                           ,"" ,"FAKK2Scripts.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/FAKK2/FAKK2Scripts.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["FAKK" ][] = new cQRKAddon("Heavy Metal: F.A.K.K.2"   ,""                                           ,"" ,"FAKK2Weapon-ModelEntities.qrk",
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/FAKK2/FAKK2Weapon-ModelEntities.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["FAKK" ][] = new cQRKAddon("Heavy Metal: F.A.K.K.2"   ,""                                           ,"" ,"FAKK2textures.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/FAKK2/FAKK2textures.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["FAKK" ][] = new cQRKAddon("Heavy Metal: F.A.K.K.2"   ,""                                           ,"" ,"UserData FAKK2.qrk",
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/FAKK2/UserData FAKK2.qrk?format=raw"        ,$OfficialQRKAddon);

# Genesis 3D
$GamesQRKAddons["G3D"  ] = array();
$GamesQRKAddons["G3D"  ][] = new cQRKAddon("Genesis 3D"               ,""                                           ,"" ,"DataGen3d.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Genesis3D/DataGen3d.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["G3D"  ][] = new cQRKAddon("Genesis 3D"               ,""                                           ,"" ,"Gen3dEntities.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Genesis3D/Gen3dEntities.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["G3D"  ][] = new cQRKAddon("Genesis 3D"               ,""                                           ,"" ,"Gen3dTextures.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Genesis3D/Gen3dTextures.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["G3D"  ][] = new cQRKAddon("Genesis 3D"               ,""                                           ,"" ,"UserData Genesis3d.qrk",
"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Genesis3D/UserData Genesis3d.qrk?format=raw",$OfficialQRKAddon);

# Gunman Chronicles
$GamesQRKAddons["GC"   ][] = new cQRKAddon("Gunman Chronicles"        ,""                                           ,"" ,"DataGC.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/DataGC.qrk?format=raw"             ,$OfficialQRKAddon."<br>NOTE: QuArK supports 'Gunman Chronicles' map-editing, but it is a bit difficult to setup correctly, so please ask in the <a href=\"".$mainroot."communication.php\">QuArK-forum</a> if you need to know how, or look at <a href=\"".$infobaseroot."maped.games.half-life.html#cstrike_retail_setup\">this info</a> in the <a href=\"".$infobaseroot."\">InfoBase</a>.");

# Half-Life
$GamesQRKAddons["HL"   ] = array();
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Half-Life"                ,""                                           ,"Counter-Strike, Blue Shift and many more..."
                                                                                                                        ,"DataHL.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/DataHL.qrk?format=raw"             ,$OfficialQRKAddon."<br><a href=\"".$downloadroot."addons/half-life/datahl_20020714.zip\">DataHL_20020714.zip</a> (Dated 2002-07-14)"); #http://www.fileplanet.com/dl/dl.asp?/planetquake/quark/addons/half-life/DataHL_20020714.zip
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Half-Life"                ,""                                           ,"" ,"HLEntities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/HLEntities.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Half-Life"                ,""                                           ,"" ,"HLTextures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/HLTextures.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Half-Life"                ,""                                           ,"" ,"UserData Half-Life.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/UserData Half-Life.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Gunman Chronicles"        ,""                                           ,"" ,"DataGC.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/DataGC.qrk?format=raw"             ,$OfficialQRKAddon."<br>NOTE: QuArK supports 'Gunman Chronicles' map-editing, but it is a bit difficult to setup correctly, so please ask in the <a href=\"".$mainroot."communication.php\">QuArK-forum</a> if you need to know how, or look at <a href=\"".$infobaseroot."maped.games.half-life.html#cstrike_retail_setup\">this info</a> in the <a href=\"".$infobaseroot."\">InfoBase</a>.");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Blue Shift"               ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)<br>NOTE: QuArK supports 'Blue Shift' map-editing, but it is a bit difficult to setup correctly, so please ask in the <a href=\"".$mainroot."communication.php\">QuArK-forum</a> if you need to know how, or look at <a href=\"".$infobaseroot."maped.games.half-life.html#cstrike_retail_setup\">this info</a> in the <a href=\"".$infobaseroot."\">InfoBase</a>.");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Counter-Strike"           ,"http://www.counter-strike.net"              ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)<br>NOTE: QuArK supports 'Counter-Strike Retail' map-editing, but it is a bit difficult to setup correctly, so please ask in the <a href=\"".$mainroot."communication.php\">QuArK-forum</a> if you need to know how, or look at <a href=\"".$infobaseroot."maped.games.half-life.html#cstrike_retail_setup\">this info</a> in the <a href=\"".$infobaseroot."\">InfoBase</a>.");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Opposing Force"           ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Ricochet"                 ,""                                           ,"" ,"RicochetHL.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/RicochetHL.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Team Fortress Classic"    ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Deathmatch Classic"       ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("BuzzyBots"                ,"http://www.buzzybots.dk"                    ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("HL Rally"                 ,"http://www.hlrally.net"                     ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Action Half-Life"         ,"http://ahl.action-web.net"                  ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Science & Industry"       ,"http://www.planethalflife.com/si"           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Classic CTF"              ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("The Assignment"           ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Kanonball"                ,"http://www.planethalflife.com/kanonball"    ,"" ,"KanonballHL.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/KanonballHL.qrk?format=raw"        ,$OfficialQRKAddon);
$GamesQRKAddons["HL"   ][] = new cQRKAddon("FireArms"                 ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Desert Crisis"            ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("The Sherman Project"      ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Arg! The Pirates Strike Back"
                                                                      ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Sven-Coop"                ,"http://www.svencoop.com"                    ,"" ,"SvenCoop48.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/SvenCoop48.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Front Line Force"         ,"http://www.planethalflife.com/frontline"    ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Day of Defeat"            ,"http://www.dayofdefeatmod.com"              ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Turbo"                    ,""                                           ,"" ,""                 ,""                                                                                                  ,"(In the same DataHL.QRK file as above.)");
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Pirates and Vikings and Knights"
                                                                      ,""                                           ,"" ,"pvkHL.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/pvkHL.qrk?format=raw"              ,$OfficialQRKAddon);
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Swarm"                    ,"http://swarm.edgegaming.com"                ,"" ,"SwarmHL.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/SwarmHL.qrk?format=raw"            ,$OfficialQRKAddon);
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Wizard Wars"              ,"http://www.planethalflife.com/wizardwars"   ,"" ,"wwqrk.zip"        ,$downloadroot."addons/half-life/wwqrk.zip"                               ,"(Dated 2001-01-16)"); #http://dl.fileplanet.com/dl/dl.asp?quark/addons/half-life/wwqrk.zip
$GamesQRKAddons["HL"   ][] = new cQRKAddon("War in Europe"            ,""                                           ,"" ,"wieHL.zip"        ,$downloadroot."addons/half-life/wieHL.zip"                               ,"(Dated 2001-01-12)"); #http://dl.fileplanet.com/dl/dl.asp?quark/addons/half-life/wieHL.zip
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Prefabs"                  ,""                                           ,"Selected prefabs from <a href=\"http://prefabs.gamedesign.net/\">prefabs.gamedesign.net</a>"
                                                                                                                        ,"prefabsHL.zip"    ,$downloadroot."addons/half-life/prefabsHL.zip"                           ,"(Dated 2001-03-17)"); #http://dl.fileplanet.com/dl/dl.asp?quark/addons/half-life/prefabsHL.zip
$GamesQRKAddons["HL"   ][] = new cQRKAddon("The Opera"                ,"http://opera.redeemedsoft.com"              ,"" ,"OperaHL.zip"      ,$downloadroot."addons/half-life/OperaHL.zip"                             ,"(Dated 2001-07-22)"); #http://dl.fileplanet.com/dl/dl.asp?quark/addons/half-life/OperaHL.zip
$GamesQRKAddons["HL"   ][] = new cQRKAddon("Natural Selection"        ,"http://www.natural-selection.org"           ,"Thanks to \"<a href=\"javascript:mail_decode('fso@ubzr.ay');\">nugigerulus</a>\" for sorting the textures"
                                                                                                                        ,"nstrHL_20020125.zip"
                                                                                                                                            ,$downloadroot."addons/half-life/nstrhl_20020125.zip"                     ,"(Technology Release. Textures updated 2002-01-25)"); #http://dl.fileplanet.com/dl/dl.asp?quark/addons/half-life/nstrHL_20020125.zip
$GamesQRKAddons["HL"   ][] = new cQRKAddon("MMod"                     ,"https://www.moddb.com/mods/half-life-mmod"  ,"" ,"HL1MMod.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/HL1MMod.qrk?format=raw"            ,$OfficialQRKAddon); #http://gunshipstuff.x10.mx/

# Half-Life: Opposing Force
$GamesQRKAddons["HLOF" ] = array();
$GamesQRKAddons["HLOF" ][] = new cQRKAddon("Opposing Force"           ,""                                           ,"" ,"DataHL.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/DataHL.qrk?format=raw"             ,$OfficialQRKAddon."<br><a href=\"".$downloadroot."addons/half-life/datahl_20020714.zip\">DataHL_20020714.zip</a> (Dated 2002-07-14)"); #http://www.fileplanet.com/dl/dl.asp?/planetquake/quark/addons/half-life/DataHL_20020714.zip

# Half-Life: Blueshift
$GamesQRKAddons["HLBS" ] = array();
$GamesQRKAddons["HLBS" ][] = new cQRKAddon("Blue Shift"               ,""                                           ,"" ,"DataHL.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/DataHL.qrk?format=raw"             ,$OfficialQRKAddon."<br><a href=\"".$downloadroot."addons/half-life/datahl_20020714.zip\">DataHL_20020714.zip</a> (Dated 2002-07-14)"); #http://www.fileplanet.com/dl/dl.asp?/planetquake/quark/addons/half-life/DataHL_20020714.zip


# Half-Life: Source
$GamesQRKAddons["HLS"  ] = array();
$GamesQRKAddons["HLS"  ][] = new cQRKAddon("Half-Life: Source"        ,""                                           ,"" ,"entities-hl1s.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/entities-hl1s.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["HLS"  ][] = new cQRKAddon("Half-Life: Source"        ,""                                           ,"" ,"textures-hl1s.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/textures-hl1s.qrk?format=raw"     ,$OfficialQRKAddon);

# Half-Life 2
$GamesQRKAddons["HL2"  ] = array();
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"DataHL2.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/DataHL2.qrk?format=raw"           ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"UserData Half-Life2.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/UserData Half-Life2.qrk?format=raw"
                                                                                                           ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"entities-base.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/entities-base.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"textures-base.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/textures-base.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"entities-hl2.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/entities-hl2.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"gamesounds-hl2.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/gamesounds-hl2.qrk?format=raw"    ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"models-hl2.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/models-hl2.qrk?format=raw"        ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"prefabs-hl2.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/prefabs-hl2.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"soundscapes-hl2.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/soundscapes-hl2.qrk?format=raw"   ,$OfficialQRKAddon);
#$GamesQRKAddons["HL2"  ][] = new cQRKAddon("Half-Life 2"              ,""                                           ,"" ,"textures-hl2.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/textures-hl2.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["HL2"  ][] = new cQRKAddon("D.I.P.R.I.P."             ,"http://diprip.com/"                         ,"" ,"Diprip.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/Diprip.qrk?format=raw"            ,$OfficialQRKAddon);

# Half-Life 2: Deathmatch
$GamesQRKAddons["HL2DM"] = array();
$GamesQRKAddons["HL2DM"][] = new cQRKAddon("Half-Life 2 Multiplayer"  ,""                                           ,"" ,"entities-hl2mp.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/entities-hl2mp.qrk?format=raw"    ,$OfficialQRKAddon);

# Heretic-2
$GamesQRKAddons["Hr2"  ] = array();
$GamesQRKAddons["Hr2"  ][] = new cQRKAddon("Heretic-2"                ,""                                           ,"" ,"DataHr2.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Heretic_II/DataHr2.qrk?format=raw"           ,$OfficialQRKAddon);
$GamesQRKAddons["Hr2"  ][] = new cQRKAddon("Heretic-2"                ,""                                           ,"" ,"Hr2Entities.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Heretic_II/Hr2Entities.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["Hr2"  ][] = new cQRKAddon("Heretic-2"                ,""                                           ,"" ,"Hr2Textures.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Heretic_II/Hr2Textures.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["Hr2"  ][] = new cQRKAddon("Heretic-2"                ,""                                           ,"" ,"UserData Heretic II.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Heretic_II/UserData Heretic II.qrk?format=raw"
                                                                                                                                                                                                                                                 ,$OfficialQRKAddon);

# Hexen-2
$GamesQRKAddons["Hx2"  ] = array();
$GamesQRKAddons["Hx2"  ][] = new cQRKAddon("Hexen-2"                  ,""                                           ,"" ,"DataH2.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Hexen_II/DataH2.qrk?format=raw"              ,$OfficialQRKAddon);
$GamesQRKAddons["Hx2"  ][] = new cQRKAddon("Hexen-2"                  ,""                                           ,"" ,"H2Entities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Hexen_II/H2Entities.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["Hx2"  ][] = new cQRKAddon("Hexen-2"                  ,""                                           ,"" ,"H2Textures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Hexen_II/H2Textures.qrk?format=raw"          ,$OfficialQRKAddon);
$GamesQRKAddons["Hx2"  ][] = new cQRKAddon("Hexen-2"                  ,""                                           ,"" ,"UserData Hexen II.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Hexen_II/UserData Hexen II.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["Hx2"  ][] = new cQRKAddon("Portal of Praevus"        ,""                                           ,"" ,"Praevus.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Hexen_II/Praevus.qrk?format=raw"             ,$OfficialQRKAddon);

# Hexen 2: Portal of Praevus
$GamesQRKAddons["Hx2XP"] = array();
$GamesQRKAddons["Hx2XP"][] = new cQRKAddon("Portal of Praevus"        ,""                                           ,"" ,"Praevus.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Hexen_II/Praevus.qrk?format=raw"             ,$OfficialQRKAddon);

# Jedi Academy
$GamesQRKAddons["JA"   ] = array();
$GamesQRKAddons["JA"   ][] = new cQRKAddon("Jedi Academy"             ,""                                           ,"" ,"DataJA.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/JA/DataJA.qrk?format=raw"                    ,$OfficialQRKAddon);
$GamesQRKAddons["JA"   ][] = new cQRKAddon("Jedi Academy"             ,""                                           ,"" ,"JAEntities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/JA/JAEntities.qrk?format=raw"                ,$OfficialQRKAddon);
$GamesQRKAddons["JA"   ][] = new cQRKAddon("Jedi Academy"             ,""                                           ,"" ,"JATextures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/JA/JATextures.qrk?format=raw"                ,$OfficialQRKAddon);
$GamesQRKAddons["JA"   ][] = new cQRKAddon("Jedi Academy"             ,""                                           ,"" ,"UserData JA.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/JA/UserData JA.qrk?format=raw"               ,$OfficialQRKAddon);

# Jedi Knight 2:Jedi Outcast
$GamesQRKAddons["JK2"  ] = array();
$GamesQRKAddons["JK2"  ][] = new cQRKAddon("Jedi Knight 2:Jedi Outcast"
                                                                      ,""                                           ,"" ,"DataJK2.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/JK2/DataJK2.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["JK2"  ][] = new cQRKAddon("Jedi Knight 2:Jedi Outcast"
                                                                      ,""                                           ,"" ,"JK2Entities.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/JK2/JK2Entities.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["JK2"  ][] = new cQRKAddon("Jedi Knight 2:Jedi Outcast"
                                                                      ,""                                           ,"" ,"JK2Textures.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/JK2/JK2Textures.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["JK2"  ][] = new cQRKAddon("Jedi Knight 2:Jedi Outcast"
                                                                      ,""                                           ,"" ,"UserData JK2.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/JK2/UserData JK2.qrk?format=raw"    ,$OfficialQRKAddon);

# Kingpin
$GamesQRKAddons["KP"   ] = array();
$GamesQRKAddons["KP"   ][] = new cQRKAddon("Kingpin"                  ,""                                           ,"" ,"DataKP.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/KingPin/DataKP.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["KP"   ][] = new cQRKAddon("Kingpin"                  ,""                                           ,"" ,"KPEntities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/KingPin/KPEntities.qrk?format=raw"  ,$OfficialQRKAddon);
$GamesQRKAddons["KP"   ][] = new cQRKAddon("Kingpin"                  ,""                                           ,"" ,"KPTextures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/KingPin/KPTextures.qrk?format=raw"  ,$OfficialQRKAddon);
$GamesQRKAddons["KP"   ][] = new cQRKAddon("Kingpin"                  ,""                                           ,"" ,"UserData KingPin.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/KingPin/UserData KingPin.qrk?format=raw"
                                                                                                                                                                                                                                        ,$OfficialQRKAddon);
$GamesQRKAddons["KP"   ][] = new cQRKAddon("Power 2"                  ,"http://www.captaindeath.com/kingpin/power2.aspx"
                                                                                                                    ,"" ,"quark-power2-addon.zip"
                                                                                                                                            ,"http://download.kingpin.info/index.php?dir=kingpin/editing/maps/map_editors/Quark/addon/power2/&file=quark-power2-addon.zip");

# Marble Blast
$GamesQRKAddons["MB"   ] = array();
$GamesQRKAddons["MB"   ][] = new cQRKAddon("MBG/P textures & empty toolbox"
                                                                      ,""                                           ,"" ,"MarbleBlastTextures-MBG_MBP_Empty.qrk"
                                                                                                                                            ,"http://platinum.philsempire.com/platinum/MarbleBlastTextures-MBG_MBP_Empty.qrk" ,"A pre-made sample containing Marble Blast Gold and Marble Blast Platinum textures as well as an empty Texture Toolbox.");
$GamesQRKAddons["MB"   ][] = new cQRKAddon("Empty toolboxes"          ,""                                           ,"" ,"MarbleBlastTextures-EmptyToolboxes.qrk"
                                                                                                                                            ,"http://platinum.philsempire.com/platinum/MarbleBlastTextures-EmptyToolboxes.qrk" ,"A basic file containing three empty toolboxes.");

# Medal of Honor:Allied Assault
$GamesQRKAddons["MOHAA"] = array();
$GamesQRKAddons["MOHAA"][] = new cQRKAddon("Medal of Honor:Allied Assault"
                                                                      ,""                                           ,"" ,"DataMOHAA.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/MOHAA/DataMOHAA.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["MOHAA"][] = new cQRKAddon("Medal of Honor:Allied Assault"
                                                                      ,""                                           ,"" ,"DataMOHAA_Read me.txt"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/MOHAA/DataMOHAA_Read me.txt?format=raw"
                                                                                                                                                                                                                                        ,$OfficialQRKAddon);
$GamesQRKAddons["MOHAA"][] = new cQRKAddon("Medal of Honor:Allied Assault"
                                                                      ,""                                           ,"" ,"MOHAAEntities.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/MOHAA/MOHAAEntities.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["MOHAA"][] = new cQRKAddon("Medal of Honor:Allied Assault"
                                                                      ,""                                           ,"" ,"MOHAATextures.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/MOHAA/MOHAATextures.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["MOHAA"][] = new cQRKAddon("Medal of Honor:Allied Assault"
                                                                      ,""                                           ,"" ,"MOHAAWeapon-ModelEntities.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/MOHAA/MOHAAWeapon-ModelEntities.qrk?format=raw"
                                                                                                                                                                                                                                                    ,$OfficialQRKAddon);
$GamesQRKAddons["MOHAA"][] = new cQRKAddon("Medal of Honor:Allied Assault"
                                                                      ,""                                           ,"" ,"UserData MOHAA.qrk","https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/MOHAA/UserData MOHAA.qrk?format=raw"     ,$OfficialQRKAddon);

# Nexuiz
$GamesQRKAddons["NEX"  ] = array();
$GamesQRKAddons["NEX"  ][] = new cQRKAddon("Nexuiz"                   ,""                                           ,"" ,"DataNEXUIZ.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/NEXUIZ/DataNEXUIZ.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["NEX"  ][] = new cQRKAddon("Nexuiz"                   ,""                                           ,"" ,"NEXUIZEntities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/NEXUIZ/NEXUIZEntities.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["NEX"  ][] = new cQRKAddon("Nexuiz"                   ,""                                           ,"" ,"NEXUIZScripts.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/NEXUIZ/NEXUIZScripts.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["NEX"  ][] = new cQRKAddon("Nexuiz"                   ,""                                           ,"" ,"NEXUIZ_jpgTextures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/NEXUIZ/NEXUIZ_jpgTextures.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["NEX"  ][] = new cQRKAddon("Nexuiz"                   ,""                                           ,"" ,"NEXUIZ_tgaTextures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/NEXUIZ/NEXUIZ_tgaTextures.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["NEX"  ][] = new cQRKAddon("Nexuiz"                   ,""                                           ,"" ,"UserData NEXUIZ.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/NEXUIZ/UserData NEXUIZ.qrk?format=raw"   ,$OfficialQRKAddon);

# Portal
$GamesQRKAddons["P"    ] = array();
$GamesQRKAddons["P"    ][] = new cQRKAddon("Portal"                   ,""                                           ,"" ,"entities-portal.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/entities-portal.qrk?format=raw"
                                                                                                  ,$OfficialQRKAddon);
$GamesQRKAddons["P"    ][] = new cQRKAddon("Portal"                   ,""                                           ,"" ,"textures-portal.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/textures-portal.qrk?format=raw"
                                                                                                  ,$OfficialQRKAddon);


# Prey
$GamesQRKAddons["PREY" ] = array();
$GamesQRKAddons["PREY" ][] = new cQRKAddon("Prey"                     ,""                                           ,"" ,"DataPrey.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Prey/DataPrey.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["PREY" ][] = new cQRKAddon("Prey"                     ,""                                           ,"" ,"PreyEntities.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Prey/PreyEntities.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["PREY" ][] = new cQRKAddon("Prey"                     ,""                                           ,"" ,"PreyMaterials.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Prey/PreyMaterials.qrk?format=raw"  ,$OfficialQRKAddon);
$GamesQRKAddons["PREY" ][] = new cQRKAddon("Prey"                     ,""                                           ,"" ,"UserData Prey.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Prey/UserData Prey.qrk?format=raw"  ,$OfficialQRKAddon);

# Quake
$GamesQRKAddons["Q1"   ] = array();
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Quake 1"                  ,""                                           ,"" ,"DataQ1.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/DataQ1.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Quake 1"                  ,""                                           ,"" ,"Q1Entities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/Q1Entities.qrk?format=raw"  ,$OfficialQRKAddon);
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Quake 1"                  ,""                                           ,"" ,"Q1Textures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/Q1Textures.qrk?format=raw"  ,$OfficialQRKAddon);
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Quake 1"                  ,""                                           ,"" ,"UserData Quake 1.qrk"
                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/UserData Quake 1.qrk?format=raw"
                                                                                                                                                                                                                                        ,$OfficialQRKAddon);
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Scourge of Armagon"       ,""                                           ,"" ,"HipnoticQ1.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/HipnoticQ1.qrk?format=raw"  ,$OfficialQRKAddon);
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Dissolution of Eternity"  ,""                                           ,"" ,"RogueQ1.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/RogueQ1.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Nehahra"                  ,"https://web.archive.org/web/20090422222713/http://nehahra.planetquake.gamespy.com/nehindex.html"         ,"" ,"NehahraQ1.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/NehahraQ1.qrk?format=raw"   ,$OfficialQRKAddon); #http://www.planetquake.com/nehahra
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("CTF"                      ,""                                           ,"" ,"CTFq1.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/CTFq1.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["Q1"][] = new cQRKAddon("Copper", "http://www.lunaran.com/copper/", "",
                                        "Copper.qrk", "https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/Copper.qrk?format=raw", $OfficialQRKAddon);
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Team Fortress"            ,"https://web.archive.org/web/20071023183027/http://www.planetfortress.com/teamfortress/" ,"" ,"TFq1.qrk"         ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/TFq1.qrk?format=raw"        ,$OfficialQRKAddon); #http://www.planetfortress.com/teamfortress
$GamesQRKAddons["Q1"   ][] = new cQRKAddon("Rally Quake 1"            ,"https://web.archive.org/web/19980224193448/http://impact.frag.com/rally/"   ,"" ,"RallyQ1.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/RallyQ1.qrk?format=raw"     ,$OfficialQRKAddon); #http://impact.frag.com/rally/

# Quake Mission Pack 1: Scourge of Armagon
$GamesQRKAddons["Q1XP1" ][] = new cQRKAddon("Scourge of Armagon"       ,""                                           ,"" ,"HipnoticQ1.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/HipnoticQ1.qrk?format=raw"  ,$OfficialQRKAddon);

# Quake Mission Pack 2: Dissolution of Eternity
$GamesQRKAddons["Q1XP2" ][] = new cQRKAddon("Dissolution of Eternity"  ,""                                           ,"" ,"RogueQ1.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_1/RogueQ1.qrk?format=raw"     ,$OfficialQRKAddon);

# Quake 2
$GamesQRKAddons["Q2"   ] = array();
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Quake 2"                  ,""                                           ,"" ,"DataQ2.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/DataQ2.qrk?format=raw"                 ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Quake 2"                  ,""                                           ,"" ,"Q2Entities.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Q2Entities.qrk?format=raw"                 ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Quake 2"                  ,""                                           ,"" ,"Q2SortedTextures.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Q2SortedTextures.qrk?format=raw"                 ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Quake 2"                  ,""                                           ,"" ,"Q2Textures.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Q2Textures.qrk?format=raw"                 ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Quake 2"                  ,""                                           ,"" ,"UserData Quake 2.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/UserData Quake 2.qrk?format=raw"                 ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Ground Zero"              ,""                                           ,"" ,"Rogueq2.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Rogueq2.qrk?format=raw"                ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("The Reckoning"            ,""                                           ,"" ,"Xatrixq2.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Xatrixq2.qrk?format=raw"               ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Zaero"                    ,""                                           ,"" ,"Zaeroq2.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Zaeroq2.qrk?format=raw"                ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("CTF"                      ,""                                           ,"" ,"CTFq2.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/CTFq2.qrk?format=raw"                  ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Future Wars"              ,"https://web.archive.org/web/20090508145831/http://futurewar.planetquake.gamespy.com/"       ,"" ,"FutureWarsq2.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/FutureWarsq2.qrk?format=raw"           ,$OfficialQRKAddon); #http://www.planetquake.com/futurewar
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("KMQuake II"               ,""                                           ,"" ,"KM_quake2Entities.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/KM_quake2Entities.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Lazarus"                  ,"https://web.archive.org/web/20090514144123/http://lazarus.planetquake.gamespy.com/"         ,"" ,"Q2_Lazarus.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Q2_Lazarus.qrk?format=raw"             ,$OfficialQRKAddon); #http://www.planetquake.com/lazarus
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("LOX mod"                  ,""                                           ,"" ,"Q2_LOX.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Q2_LOX.qrk?format=raw"                 ,$OfficialQRKAddon);
$GamesQRKAddons["Q2"   ][] = new cQRKAddon("Dawn of Darkness mod"     ,"" ,"" ,"Dawn_of_darkness_qrk.rar" ,"http://www.moddb.com/mods/dawn-of-darkness1/addons/quark-editor-dawn-of-darknessqrk-file1"                 ,"");

# Quake 2: The Reckoning
$GamesQRKAddons["Q2TR" ][] = new cQRKAddon("The Reckoning"            ,""                                           ,"" ,"Xatrixq2.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Xatrixq2.qrk?format=raw"               ,$OfficialQRKAddon);

# Quake 2: Ground Zero
$GamesQRKAddons["Q2GZ" ][] = new cQRKAddon("Ground Zero"              ,""                                           ,"" ,"Rogueq2.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Rogueq2.qrk?format=raw"                ,$OfficialQRKAddon);

# Quake-3:Arena
$GamesQRKAddons["Q3A"  ] = array();
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Quake-3:Arena"            ,""                                           ,"" ,"DataQ3.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/DataQ3.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Quake-3:Arena"            ,""                                           ,"" ,"Q3Entities.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3Entities.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Quake-3:Arena"            ,""                                           ,"" ,"Q3Textures.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3Textures.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Quake-3:Arena"            ,""                                           ,"" ,"UserData Quake 3.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/UserData Quake 3.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Quake-3 Team Arena"       ,""                                           ,"" ,"DataQ3TA.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/DataQ3TA.qrk?format=raw"    ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Arch library"             ,""                                           ,"" ,"Q3Archlib.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Q3Archlib.qrk"           ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Q3Fortress"               ,""                                           ,"" ,"Q3Fq3.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3Fq3.qrk?format=raw"       ,$OfficialQRKAddon); #http://www.q3f.com
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Q3 map model prefabs"     ,""                                           ,"By <a href=\"javascript:mail_decode('E.C.Uhyforetra@Fghqrag.GHQrysg.AY');\">Rolf Hulsbergen</a>. (original <a href=\"http://www.student.citg.tudelft.nl/c9375215/idmodels.zip\">file</a>)"
                                                                                                                        ,"Q3models.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3models.qrk?format=raw"    ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Q3 sample DM maps"        ,""                                           ,"The three Q3Radiant sample maps, fixed and converted into QuArK format, using tree-view groups. By <a href=\"javascript:mail_decode('E.C.Uhyforetra@Fghqrag.GHQrysg.AY');\">Rolf Hulsbergen</a>. (original <a href=\"http://www.student.citg.tudelft.nl/c9375215/samples.zip\">file</a>)"
                                                                                                                        ,"Q3A_Map_Samples.zip"
                                                                                                                                            ,$downloadroot."addons/quake3/Q3A_Map_Samples.zip"                             ,"(Dated 2001-03-17)"); #http://dl.fileplanet.com/dl/dl.asp?quark/addons/quake3/Q3A_Map_Samples.zip
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Q3 Pong"                  ,""                                           ,"By <a href=\"javascript:mail_decode('jroznfgre@zdz.vjnec.pbz');\">\"Xypher\"</a>."
                                                                                                                        ,"Q3Pong.zip"       ,$downloadroot."addons/quake3/Q3Pong.zip"                                      ,"(Dated 2001-07-18)"); #http://dl.fileplanet.com/dl/dl.asp?quark/addons/quake3/Q3Pong.zip
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Q3 Rally"                 ,""                                           ,"By <a href=\"javascript:mail_decode('jroznfgre@zdz.vjnec.pbz');\">\"Xypher\"</a>."
                                                                                                                        ,"Q3Rally.zip"      ,$downloadroot."addons/quake3/Q3Rally.zip"                                     ,"(Dated 2001-07-18)"); #http://dl.fileplanet.com/dl/dl.asp?quark/addons/quake3/Q3Rally.zip
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("True Combat"              ,""                                           ,"" ,"tcaddon.zip"      ,"https://www.tcmapping.com/wp-content/uploads/2018/12/tcaddon.zip"                                     ,"(Dated 2004-08-03)"); #Made by: [NL]Freshmeat ?
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Enemy Terror"             ,""                                           ,"" ,"DataQ3ET.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/DataQ3ET.qrk?format=raw"    ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Urban Terror-unit2"       ,""                                           ,"" ,"Q3UT2.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3UT2.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Urban Terror-unit3"       ,""                                           ,"" ,"Q3UT3.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3UT3.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Smokin' Guns"             ,"https://www.smokin-guns.org/"               ,"" ,"Q3_SG.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3_SG.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["Q3A"  ][] = new cQRKAddon("Smokin' Guns (textures)"  ,"https://www.smokin-guns.org/"               ,"" ,"Q3_SG_textures.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3_SG_textures.qrk?format=raw" ,$OfficialQRKAddon);

# Quake 3: Team Arena (yes, this is a double-entry)
$GamesQRKAddons["Q3TA" ][] = new cQRKAddon("Quake-3 Team Arena"       ,""                                           ,"" ,"DataQ3TA.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/DataQ3TA.qrk?format=raw"    ,$OfficialQRKAddon);

# Quake 4
$GamesQRKAddons["Q4"   ] = array();
$GamesQRKAddons["Q4"   ][] = new cQRKAddon("Quake 4"                  ,""                                           ,"" ,"DataQ4.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_4/DataQ4.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q4"   ][] = new cQRKAddon("Quake 4"                  ,""                                           ,"" ,"Q4Entities.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_4/Q4Entities.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q4"   ][] = new cQRKAddon("Quake 4"                  ,""                                           ,"" ,"Q4Materials.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_4/Q4Materials.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["Q4"   ][] = new cQRKAddon("Quake 4"                  ,""                                           ,"" ,"UserData Quake 4.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_4/UserData Quake 4.qrk?format=raw"      ,$OfficialQRKAddon);

# Return To Castle Wolfenstein
$GamesQRKAddons["RTCW" ] = array();
$GamesQRKAddons["RTCW" ][] = new cQRKAddon("Return to Castle Wolfenstein"
                                                                      ,""                                           ,"" ,"DataRTCW.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/RTCW/DataRTCW.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["RTCW" ][] = new cQRKAddon("Return to Castle Wolfenstein"
                                                                      ,""                                           ,"" ,"RTCWEntities.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/RTCW/RTCWEntities.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["RTCW" ][] = new cQRKAddon("Return to Castle Wolfenstein"
                                                                      ,""                                           ,"" ,"RTCWTextures.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/RTCW/RTCWTextures.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["RTCW" ][] = new cQRKAddon("Return to Castle Wolfenstein"
                                                                      ,""                                           ,"" ,"UserData RTCW.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/RTCW/UserData RTCW.qrk?format=raw"       ,$OfficialQRKAddon);

# Return To Castle Wolfenstein: Enemy Territory
$GamesQRKAddons["RTCW-ET"] = array();
$GamesQRKAddons["RTCW-ET"][] = new cQRKAddon("Return to Castle Wolfenstein: Enemy Territory"
                                                                      ,""                                           ,"" ,"DataET.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/RTCW-ET/DataET.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["RTCW-ET"][] = new cQRKAddon("Return to Castle Wolfenstein: Enemy Territory"
                                                                      ,""                                           ,"" ,"RTCW-ETEntities.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/RTCW-ET/RTCW-ETEntities.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["RTCW-ET"][] = new cQRKAddon("Return to Castle Wolfenstein: Enemy Territory"
                                                                      ,""                                           ,"" ,"RTCW-ETTextures.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/RTCW-ET/RTCW-ETTextures.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["RTCW-ET"][] = new cQRKAddon("Return to Castle Wolfenstein: Enemy Territory"
                                                                      ,""                                           ,"" ,"UserData RTCW-ET.qrk"       ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/RTCW-ET/UserData RTCW-ET.qrk?format=raw"      ,$OfficialQRKAddon);

# Ricochet
$GamesQRKAddons["RICO" ] = array();
$GamesQRKAddons["RICO" ][] = new cQRKAddon("Ricochet"                 ,""                                           ,"" ,"RicochetHL.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life/RicochetHL.qrk?format=raw"         ,$OfficialQRKAddon);

# Sin
$GamesQRKAddons["SIN"  ] = array();
$GamesQRKAddons["SIN"  ][] = new cQRKAddon("Sin"                      ,""                                           ,"" ,"DataSin.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sin/DataSin.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["SIN"  ][] = new cQRKAddon("Sin"                      ,""                                           ,"" ,"SinEntities.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sin/SinEntities.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["SIN"  ][] = new cQRKAddon("Sin"                      ,""                                           ,"" ,"SinTextures.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sin/SinTextures.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["SIN"  ][] = new cQRKAddon("Sin"                      ,""                                           ,"" ,"UserData Sin.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sin/UserData Sin.qrk?format=raw"         ,$OfficialQRKAddon);

# Smokin' Guns (yes, these are duplicated)
$GamesQRKAddons["SG"  ][] = new cQRKAddon("Smokin' Guns"             ,"https://www.smokin-guns.org/"                ,"" ,"Q3_SG.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3_SG.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["SG"  ][] = new cQRKAddon("Smokin' Guns (textures)"  ,"https://www.smokin-guns.org/"                ,"" ,"Q3_SG_textures.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3_SG_textures.qrk?format=raw" ,$OfficialQRKAddon);

# Soldier of Fortune
$GamesQRKAddons["SOF"  ] = array();
$GamesQRKAddons["SOF"  ][] = new cQRKAddon("Soldier of Fortune"       ,""                                           ,"" ,"DataSOF.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SOF/DataSOF.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["SOF"  ][] = new cQRKAddon("Soldier of Fortune"       ,""                                           ,"" ,"SOFEntities.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SOF/SOFEntities.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["SOF"  ][] = new cQRKAddon("Soldier of Fortune"       ,""                                           ,"" ,"SOFTextures.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SOF/SOFTextures.qrk?format=raw"         ,$OfficialQRKAddon);
$GamesQRKAddons["SOF"  ][] = new cQRKAddon("Soldier of Fortune"       ,""                                           ,"" ,"UserData SOF.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SOF/UserData SOF.qrk?format=raw"         ,$OfficialQRKAddon);

# Soldier of Fortune 2
$GamesQRKAddons["SOF2" ] = array();
$GamesQRKAddons["SOF2" ][] = new cQRKAddon("Soldier of Fortune 2"     ,""                                           ,"" ,"DataSoF2.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SoF2/DataSoF2.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["SOF2" ][] = new cQRKAddon("Soldier of Fortune 2"     ,""                                           ,"" ,"SoF2Entities.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SoF2/SoF2Entities.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["SOF2" ][] = new cQRKAddon("Soldier of Fortune 2"     ,""                                           ,"" ,"SoF2Textures.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SoF2/SoF2Textures.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["SOF2" ][] = new cQRKAddon("Soldier of Fortune 2"     ,""                                           ,"" ,"UserData SoF2.qrk"     ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SoF2/UserData SoF2.qrk?format=raw"       ,$OfficialQRKAddon);

# Star Trek: Voyager - Elite Force
$GamesQRKAddons["STVEF"] = array();
$GamesQRKAddons["STVEF"][] = new cQRKAddon("Star Trek: Voyager Elite Force"
                                                                      ,""                                           ,"" ,"DataSTVEF.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/STVEF/DataSTVEF.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["STVEF"][] = new cQRKAddon("Star Trek: Voyager Elite Force"
                                                                      ,""                                           ,"" ,"DataSTVEF_HM.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/STVEF/DataSTVEF_HM.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["STVEF"][] = new cQRKAddon("Star Trek: Voyager Elite Force"
                                                                      ,""                                           ,"" ,"STVEFEntities.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/STVEF/STVEFEntities.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["STVEF"][] = new cQRKAddon("Star Trek: Voyager Elite Force"
                                                                      ,""                                           ,"" ,"STVEFTextures.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/STVEF/STVEFTextures.qrk?format=raw"     ,$OfficialQRKAddon);
$GamesQRKAddons["STVEF"][] = new cQRKAddon("Star Trek: Voyager Elite Force"
                                                                      ,""                                           ,"" ,"UserData STVEF.qrk"    ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/STVEF/UserData STVEF.qrk?format=raw"     ,$OfficialQRKAddon);

# Sven Co-op
$GamesQRKAddons["SC"   ] = array();
$GamesQRKAddons["SC"   ][] = new cQRKAddon("Sven Co-op"               ,""                                           ,"" ,"DataSC.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SvenCoop/DataSC.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["SC"   ][] = new cQRKAddon("Sven Co-op"               ,""                                           ,"" ,"SCEntities.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SvenCoop/SCEntities.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["SC"   ][] = new cQRKAddon("Sven Co-op"               ,""                                           ,"" ,"SCTextures.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SvenCoop/SCTextures.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["SC"   ][] = new cQRKAddon("Sven Co-op"               ,""                                           ,"" ,"UserData SvenCoop.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/SvenCoop/UserData SvenCoop.qrk?format=raw" ,$OfficialQRKAddon);

# Sylphis
$GamesQRKAddons["S"    ] = array();
$GamesQRKAddons["S"    ][] = new cQRKAddon("Sylphis"                  ,""                                           ,"" ,"DataSylphis.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sylphis/DataSylphis.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["S"    ][] = new cQRKAddon("Sylphis"                  ,""                                           ,"" ,"SylphisEntities.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sylphis/SylphisEntities.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["S"    ][] = new cQRKAddon("Sylphis"                  ,""                                           ,"" ,"SylphisTextures.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sylphis/SylphisTextures.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["S"    ][] = new cQRKAddon("Sylphis"                  ,""                                           ,"" ,"UserData Sylphis.qrk"  ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sylphis/UserData Sylphis.qrk?format=raw" ,$OfficialQRKAddon);
#$GamesQRKAddons["S"    ][] = new cQRKAddon("Sylphis autogen"          ,""                                           ,"" ,"Sylphis_autogen.qrk"
#                                                                                                                                            ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Sylphis/Sylphis_autogen.qrk?format=raw" ,$OfficialQRKAddon);

# Team Fortress 2
$GamesQRKAddons["TF2"  ] = array();
$GamesQRKAddons["TF2"  ][] = new cQRKAddon("Team Fortress 2"          ,""                                           ,"" ,"entities-tf2.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/entities-tf2.qrk?format=raw"      ,$OfficialQRKAddon);
$GamesQRKAddons["TF2"  ][] = new cQRKAddon("Team Fortress 2"          ,""                                           ,"" ,"textures-tf2.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Half-Life2/textures-tf2.qrk?format=raw"      ,$OfficialQRKAddon);

# Torque
$GamesQRKAddons["T"    ] = array();
$GamesQRKAddons["T"    ][] = new cQRKAddon("Torque"                   ,""                                           ,"" ,"DataTorque.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Torque/DataTorque.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["T"    ][] = new cQRKAddon("Torque"                   ,""                                           ,"" ,"TorqueEntities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Torque/TorqueEntities.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["T"    ][] = new cQRKAddon("Torque"                   ,""                                           ,"" ,"UserData Torque.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Torque/UserData Torque.qrk?format=raw"   ,$OfficialQRKAddon);

# Urban Terror
$GamesQRKAddons["URT"  ][] = new cQRKAddon("Urban Terror-unit2"       ,""                                           ,"" ,"Q3UT2.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3UT2.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["URT"  ][] = new cQRKAddon("Urban Terror-unit3"       ,""                                           ,"" ,"Q3UT3.qrk"        ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/Q3UT3.qrk?format=raw"       ,$OfficialQRKAddon);
$GamesQRKAddons["URT"  ][] = new cQRKAddon("Urban Terror 4"           ,""                                           ,"" ,"UrT4.qrk"         ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_3/UrT4.qrk?format=raw"        ,$OfficialQRKAddon);

# Warfork
$GamesQRKAddons["WAR"] = array();
$GamesQRKAddons["WAR"][] = new cQRKAddon("Warfork", "", "",
                                         "DataWarfork.qrk", "https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warfork/DataWarfork.qrk?format=raw", $OfficialQRKAddon);
$GamesQRKAddons["WAR"][] = new cQRKAddon("Warfork", "", "",
                                         "WarforkEntities.qrk", "https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warfork/WarforkEntities.qrk?format=raw", $OfficialQRKAddon);
$GamesQRKAddons["WAR"][] = new cQRKAddon("Warfork", "", "",
                                         "WarforkTextures.qrk", "https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warfork/WarforkTextures.qrk?format=raw", $OfficialQRKAddon);
$GamesQRKAddons["WAR"][] = new cQRKAddon("Warfork", "", "",
                                         "UserData Warfork.qrk", "https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warfork/UserData Warfork.qrk?format=raw", $OfficialQRKAddon);

# Warsow
$GamesQRKAddons["W"    ] = array();
$GamesQRKAddons["W"    ][] = new cQRKAddon("Warsow"                   ,""                                           ,"" ,"DataWarsow.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warsow/DataWarsow.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["W"    ][] = new cQRKAddon("Warsow"                   ,""                                           ,"" ,"WarsowEntities.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warsow/WarsowEntities.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["W"    ][] = new cQRKAddon("Warsow"                   ,""                                           ,"" ,"WarsowScripts.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warsow/WarsowScripts.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["W"    ][] = new cQRKAddon("Warsow"                   ,""                                           ,"" ,"WarsowTextures.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warsow/WarsowTextures.qrk?format=raw"   ,$OfficialQRKAddon);
$GamesQRKAddons["W"    ][] = new cQRKAddon("Warsow"                   ,""                                           ,"" ,"UserData Warsow.qrk"   ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Warsow/UserData Warsow.qrk?format=raw"   ,$OfficialQRKAddon);

# WildWest
$GamesQRKAddons["WW"   ] = array();
$GamesQRKAddons["WW"   ][] = new cQRKAddon("WildWest"                 ,""                                           ,"" ,"DataWildWest.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/WildWest/DataWildWest.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["WW"   ][] = new cQRKAddon("WildWest"                 ,""                                           ,"" ,"WildWestEntities.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/WildWest/WildWestEntities.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["WW"   ][] = new cQRKAddon("WildWest"                 ,""                                           ,"" ,"WildWestTextures.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/WildWest/WildWestTextures.qrk?format=raw" ,$OfficialQRKAddon);
$GamesQRKAddons["WW"   ][] = new cQRKAddon("WildWest"                 ,""                                           ,"" ,"UserData WildWest.qrk" ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/WildWest/UserData WildWest.qrk?format=raw" ,$OfficialQRKAddon);

# Zaero
$GamesQRKAddons["Z"    ][] = new cQRKAddon("Zaero"                    ,""                                           ,"" ,"Zaeroq2.qrk"      ,"https://sourceforge.net/p/quark/code/HEAD/tree/runtime/trunk/addons/Quake_2/Zaeroq2.qrk?format=raw"                ,$OfficialQRKAddon);

?>
