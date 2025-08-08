<?php
require_once("_main_paths.php");

class cQRKTools
{
	var $Title;       # Name of the tool
	var $URL;         # URL of the tool
	var $Description; # Description of the tool
	var $Recommended; # Is this tool the recommended one?

	function __construct($aTitle, $aURL, $aDescription=NULL, $aRecommended=FALSE)
	{
		$this->Title       = $aTitle;
		$this->URL         = $aURL;
		$this->Description = $aDescription;
		$this->Recommended = $aRecommended;
	}
}

global $downloadroot;

##
## -- Tools --
##
global $GamesQRKTools;
$GamesQRKTools = array();

#                    Tool (file)name
#                    |        Download URL
#                    |        |         Description
#                    |        |         |

global $GenericTools;

#Source games (Source SDK)
$GamesQRKTools["CSS"  ] = array();
$GamesQRKTools["CSS"  ][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
$GamesQRKTools["HLS"  ] = array();
$GamesQRKTools["HLS"  ][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
$GamesQRKTools["HL2"  ] = array();
$GamesQRKTools["HL2"  ][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
$GamesQRKTools["HL2DM"] = array();
$GamesQRKTools["HL2DM"][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
$GamesQRKTools["HL2EP1"] = array();
$GamesQRKTools["HL2EP1"][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
$GamesQRKTools["HL2EP2"] = array();
$GamesQRKTools["HL2EP2"][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
#$GamesQRKTools["HL2EP3"] = array();
#$GamesQRKTools["HL2EP3"][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
#$GamesQRKTools["HL2LC"] = array();
#$GamesQRKTools["HL2LC"][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
$GamesQRKTools["P"    ] = array();
$GamesQRKTools["P"    ][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
#$GamesQRKTools["P2"   ] = array();
#$GamesQRKTools["P2"   ][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");
$GamesQRKTools["TF2"  ] = array();
$GamesQRKTools["TF2"  ][] = new cQRKTools("Source SDK","steam://install/211","(You'll need Steam for this link to work)");

# Quake
$GamesQRKTools["Q1"   ] = array();
#$GamesQRKTools["Q1"   ][] = new cQRKTools("qutils.zip","http://www.gamers.org/pub/idgames/idstuff/source/qutils.zip"); #ftp://ftp.idsoftware.com/
#$GamesQRKTools["Q1"   ][] = new cQRKTools("qutils_win.zip","http://bspquakeeditor.com/files/qutils_win.zip");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("rvis1.zip","http://bspquakeeditor.com/files/rvis1.zip","This program RVIS is a speed enhancment to VIS distributed by iD on the 21th September 96.");
$GamesQRKTools["Q1"   ][] = new cQRKTools("ericw-tools","http://ericwa.github.io/ericw-tools/","Map compile tools for Quake and Hexen 2");
$GamesQRKTools["Q1"   ][] = new cQRKTools("Jury-Rigged BJP Tools","http://www.voidspark.net/projects/bjptools_xt/","The \"Jury-Rigged BJP Tools\" are a modified version of Bengt Jardrup's Quake BSP Compiler suite, with added support for Detail-Brushes, Hint-Brushes, the BSP2 format, among other things.");
$GamesQRKTools["Q1"   ][] = new cQRKTools("txqbspbjp.zip","http://bjp.fov120.com/txqbspbjp.zip","Enhanced version of TxQBSP by Bengt Jardrup (Version 1.13 Oct 2006)"); #http://web.comhem.se/bjp/txqbspbjp.zip
$GamesQRKTools["Q1"   ][] = new cQRKTools("treeqbspbjp.zip","http://bjp.fov120.com/treeqbspbjp.zip","Enhanced version of TreeQBSP by Bengt Jardrup (Version 2.05 Apr 2007)"); #http://web.comhem.se/bjp/treeqbspbjp.zip
$GamesQRKTools["Q1"   ][] = new cQRKTools("visbjp.zip","http://bjp.fov120.com/visbjp.zip","Enhanced versions of RVis, Light & BspInfo by Bengt Jardrup (Versions 2.31/1.43/1.27 May 2006)"); #http://web.comhem.se/bjp/visbjp.zip
$GamesQRKTools["Q1"   ][] = new cQRKTools("WVis.zip","http://www.quaketastic.com/upload/files/tools/windows/misc/WVis.zip","WVis is a modified version of Bengt Jardrup's VIS tool. It's the exact same program except that it has multithreading turned on.");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("Enhanced TxQBSP",$downloadroot."build_tools/xir870k/txqbspbjp.zip","TxQBSP 1.13 (Oct 5 2006); see <a href=\"".$downloadroot."build_tools/xir870k/readmetx.txt\">readme</a>."); #http://user.tninet.se/~xir870k/
#$GamesQRKTools["Q1"   ][] = new cQRKTools("Enhanced TreeQBSP",$downloadroot."build_tools/xir870k/treeqbspbjp.zip","TreeQBSP 2.05 (Apr 10 2007); see <a href=\"".$downloadroot."build_tools/xir870k/readmetree.txt\">readme</a>."); #http://user.tninet.se/~xir870k/
#$GamesQRKTools["Q1"   ][] = new cQRKTools("Enhanced RVis/Light/BspInfo utilities",$downloadroot."build_tools/xir870k/visbjp.zip","RVis 2.31, Light 1.43 and BspInfo 1.27 (May 1 2006); see <a href=\"".$downloadroot."build_tools/xir870k/readmevis.txt\">readme</a>."); #http://user.tninet.se/~xir870k/
$GamesQRKTools["Q1"   ][] = new cQRKTools("buildq1-06.zip",$downloadroot."build_tools/buildq1-06.zip"); #http://dl.fileplanet.com/dl/dl.asp?quark/buildtools/quake1/buildq1-06.zip
#$GamesQRKTools["Q1"   ][] = new cQRKTools("tyrutils-0.4-win32.zip","http://disenchant.net/files/utils/tyrutils-0.4-win32.zip");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("tyrutils-0.10-win32.zip","https://www.quaddicted.com/files/tools/tyrutils-0.10-win32.zip");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("tyrutils-0.15-win32.zip","http://disenchant.net/files/utils/tyrutils-0.15-win32.zip","A collection of command line utilities for building Quake levels and working with various Quake file formats.");
$GamesQRKTools["Q1"   ][] = new cQRKTools("tyrutils-0.17-win32.zip","https://disenchant.net/files/utils/tyrutils-0.17-win32.zip","A collection of command line utilities for building Quake levels and working with various Quake file formats.");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("wqbsp165.zip","http://bspquakeeditor.com/files/wqbsp165.zip","Transparent Water QBSP with Hipnitual Extensions - Version 1.65");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("TreeQBSP v1.63","http://www.yossman.net/~tree/qbsp163.zip");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("hmap20031119.zip","https://icculus.org/twilight/darkplaces/files/2003/hmap20031119.zip");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("hmap20070412.zip","https://icculus.org/twilight/darkplaces/files/hmap20070412.zip");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("hmap2build20100113.zip","http://icculus.org/twilight/darkplaces/files/hmap2build20100113.zip");
$GamesQRKTools["Q1"   ][] = new cQRKTools("hmap2build20121222.zip","http://icculus.org/twilight/darkplaces/files/hmap2build20121222.zip");
#$GamesQRKTools["Q1"   ][] = new cQRKTools("lhtgatools20070412.zip","http://icculus.org/twilight/darkplaces/files/lhtgatools20070412.zip"); #!
$GamesQRKTools["Q1"   ][] = new cQRKTools("vispatch-1.4.6.tgz", "https://sourceforge.net/projects/vispatch/files/vispatch/1.4.6/vispatch-1.4.6.tgz/download", "VisPatch is a tool for patching quake maps for transparent water in glquake");
$GamesQRKTools["Q1"   ][] = new cQRKTools("arghlite.zip","http://www.gamers.org/pub/games/quake/utils/level_edit/bsp_builders/arghlite.zip","ArghLite - Version 2.0");
$GamesQRKTools["Q1"   ][] = new cQRKTools("qccx100.zip",$downloadroot."build_tools/qccx100.zip","qccx v1.0 optimizing QuakeC compiler");
$GamesQRKTools["Q1"   ][] = new cQRKTools("frikdos.zip",$downloadroot."build_tools/frikdos.zip","FrikQCC 2.2");
$GamesQRKTools["Q1"   ][] = new cQRKTools("FTEQCC","https://www.fteqcc.org/","Next-generation Quake-C compiler");

# Quake Mission Pack 1: Scourge of Armagon
$GamesQRKTools["Q1XP1"][] = new cQRKTools(": : See Quake 1 : : :",NULL);

# Quake Mission Pack 2: Dissolution of Eternity
$GamesQRKTools["Q1XP2"][] = new cQRKTools(": : See Quake 1 : : :",NULL);

# Hexen-2
$GamesQRKTools["Hx2"  ] = array();
$GamesQRKTools["Hx2"  ][] = new cQRKTools("buildh2-06.zip",$downloadroot."build_tools/buildh2-06.zip"); #http://www.fileplanet.com/dl/dl.asp?/quark/buildtools/hexen2/buildh2-06.zip
$GamesQRKTools["Hx2"  ][] = new cQRKTools("ericw-tools","http://ericwa.github.io/ericw-tools/","Map compile tools for Quake and Hexen 2");
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("H2_UTILS.EXE","http://www.planetquake.com/dl/dl.asp?hexenworld/stables/edit/H2_UTILS.EXE");
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("hexv2.zip","http://www.planetquake.com/dl/dl.asp?hexenworld/stables/edit/hexv2.zip","Eric Hobbs' updated version.");
$GamesQRKTools["Hx2"  ][] = new cQRKTools("hexutils.zip",$downloadroot."build_tools/hexutils.zip"); #http://www.fileplanet.com/dl/dl.asp?/quark/buildtools/hexen2/hexutils.zip
$GamesQRKTools["Hx2"  ][] = new cQRKTools("uqeh2_116.7z",$downloadroot."build_tools/uqeh2_116.7z","UQE Hexen II"); #http://www.korvinkorax.com/download/ec6b8f1f-8f15-4af2-b794-0dd98e6d84d1/uqeh2_116.7z
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("uqeh2_116_source.7z",$downloadroot."build_tools/uqeh2_116_source.7z");
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("hexen2-utils-1.4.3-windows.zip","http://downloads.sourceforge.net/uhexen2/hexen2-utils-1.4.3-windows.zip");
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("hexen2-utils-1.5.4-win32.zip","http://downloads.sourceforge.net/project/uhexen2/Hammer%20of%20Thyrion/1.5.4/Windows/hexen2-utils-1.5.4-win32.zip");
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("hexen2-utils-1.5.6-win32.zip","http://sourceforge.net/projects/uhexen2/files/Hammer%20of%20Thyrion/1.5.6/Windows/hexen2-utils-1.5.6-win32.zip/download");
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("hexen2-utils-1.5.7-win32.zip","http://sourceforge.net/projects/uhexen2/files/Hammer%20of%20Thyrion/1.5.7/Windows/hexen2-utils-1.5.7-win32.zip/download");
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("hexen2-utils-1.5.8-win32.zip","http://sourceforge.net/projects/uhexen2/files/Hammer%20of%20Thyrion/1.5.8/Windows/hexen2-utils-1.5.8-win32.zip/download");
$GamesQRKTools["Hx2"  ][] = new cQRKTools("hexen2-utils-1.5.9-win32.zip","https://sourceforge.net/projects/uhexen2/files/Hammer%20of%20Thyrion/1.5.9/Windows/hexen2-utils-1.5.9-win32.zip/download");
$GamesQRKTools["Hx2"  ][] = new cQRKTools("adlight.zip",$downloadroot."build_tools/adlight.zip");
$GamesQRKTools["Hx2"  ][] = new cQRKTools("BSP2MAP v0.12 for Hexen II",$downloadroot."bsp2mph2.zip","Allows you to decompile Hexen II .bsp files."); #http://pa3pyx.dnsalias.org/stuff/bsp2mph2.zip
#$GamesQRKTools["Hx2"  ][] = new cQRKTools("Hexen2Quake .bsp converter",$downloadroot."h2q01.zip","it converts Hexen II maps to make them appear the same format as Quake ones"); #http://pa3pyx.dnsalias.org/stuff/h2q01.zip

# Hexen 2: Portal of Praevus
$GamesQRKTools["Hx2XP"][] = new cQRKTools(": : See Hexen 2 : : :",NULL);

# Quake 2
$GamesQRKTools["Q2"   ] = array();
#$GamesQRKTools["Q2"   ][] = new cQRKTools("bsputils3","http://peter-b.co.uk/downloads/");
$GamesQRKTools["Q2"   ][] = new cQRKTools("q2bsp-0.5-win32.zip","https://sourceforge.net/p/quark/code/HEAD/tree/q2bsp/trunk/q2bsp-0.5-win32.zip?format=raw"); #http://quark.cvs.sourceforge.net/viewvc/quark/q2bsp/q2bsp-0.5-win32.zip
$GamesQRKTools["Q2"   ][] = new cQRKTools("buildq2-39.zip",$downloadroot."build_tools/buildq2-39.zip"); #http://dl.fileplanet.com/dl/dl.asp?quark/buildtools/quake2/buildq2-39.zip
$GamesQRKTools["Q2"   ][] = new cQRKTools("gddqbsp3_109.zip","http://home.insightbb.com/~gryndehl/q2compile/gddqbsp3_109.zip","QBSP3 Revision 1.09"); #http://home.insightbb.com/~gryndehl/q2compile/quake2.html
$GamesQRKTools["Q2"   ][] = new cQRKTools("winqbsp3.zip","http://www.gamers.org/pub/games/quake2/utils/level_edit/bsp_builders/winqbsp3.zip","WinQBSP3 v0.90");
$GamesQRKTools["Q2"   ][] = new cQRKTools("txqbsp310.zip",$downloadroot."build_tools/txqbsp310.zip"); #http://dl.fileplanet.com/dl/dl.asp?quark/buildtools/quake2/txqbsp310.zip
$GamesQRKTools["Q2"   ][] = new cQRKTools("gddqvis3_103.zip","http://home.insightbb.com/~gryndehl/q2compile/gddqvis3_103.zip","QVIS3 Revision 1.03");
$GamesQRKTools["Q2"   ][] = new cQRKTools("kmqbsp_113d.zip","http://kmq2.toastednet.org/downloads/kmqbsp_113d.zip","KMQBSP3 1.13d"); #http://www.markshan.com/knightmare/downloads/kmqbsp_113d.zip
$GamesQRKTools["Q2"   ][] = new cQRKTools("arghrad.zip",$downloadroot."build_tools/arghrad.zip","ArghRad v2.01");
$GamesQRKTools["Q2"   ][] = new cQRKTools("arghrad300t.zip",$downloadroot."build_tools/arghrad300t.zip","ArghRad v3.00 test 9");
$GamesQRKTools["Q2"   ][] = new cQRKTools("fqrad11.zip","http://www.gamers.org/pub/games/quake2/utils/level_edit/bsp_builders/fqrad11.zip","FastRadiosity 1.1");
$GamesQRKTools["Q2"   ][] = new cQRKTools("vrad.zip","http://www.gamers.org/pub/games/quake2/utils/level_edit/bsp_builders/vrad.zip","VRad 1.0 for Win32");
$GamesQRKTools["Q2"   ][] = new cQRKTools("gddqrad3_104.zip","http://home.insightbb.com/~gryndehl/q2compile/gddqrad3_104.zip","QRAD3 Revision 1.04");
$GamesQRKTools["Q2"   ][] = new cQRKTools("MapSpy 1.0",$downloadroot."MAPSPY.ZIP","Quake2 map diagnostic utility");

# Quake 2: The Reckoning
$GamesQRKTools["Q2TR" ] = array();
$GamesQRKTools["Q2TR" ][] = new cQRKTools(": : See Quake 2 : : :",NULL);

# Quake 2: Ground Zero
$GamesQRKTools["Q2GZ" ] = array();
$GamesQRKTools["Q2GZ" ][] = new cQRKTools(": : See Quake 2 : : :",NULL);

# Zaero
$GamesQRKTools["Z"    ] = array();
$GamesQRKTools["Z"    ][] = new cQRKTools(": : See Quake 2 : : :",NULL);

#Digital Paint: Paintball 2
$GamesQRKTools['PB2'  ] = array();
$GamesQRKTools['PB2'  ][] = new cQRKTools('pb2quark_full_01.zip','ftp://otb-server.de/pub/Tools/pb2quark_full_01.zip');

# Heretic-2
$GamesQRKTools["Hr2"  ] = array();
$GamesQRKTools["Hr2"  ][] = new cQRKTools("buildq2-39.zip",$downloadroot."build_tools/buildq2-39.zip"); #http://dl.fileplanet.com/dl/dl.asp?quark/buildtools/quake2/buildq2-39.zip
$GamesQRKTools["Hr2"  ][] = new cQRKTools("toolkit.zip",$downloadroot."build_tools/toolkit.zip");
$GamesQRKTools["Hr2"  ][] = new cQRKTools("h2tku104.zip",$downloadroot."build_tools/h2tku104.zip","Update for the toolkit.zip file."); #FIXME: http://www.ravenfiles.com/file.php?id=29, http://www.filefront.com/898214/h2tku104.zip
$GamesQRKTools["Hr2"  ][] = new cQRKTools("Ht2Toolkit_v1.06.exe","https://www.quaddicted.com/files/idgames2/planetquake/hereticii/files/Ht2Toolkit_v1.06.exe"); #http://www.filefront.com/7930/Heretic-II-Toolkit-Update/

# Half-life
$GamesQRKTools['HL'   ] = array();
#$GamesQRKTools['HL'   ][] = new cQRKTools('Official SDKs','http://www.fileplanet.com/32334/0/0/0/1/section/SDKs_/_Source_Code');
#$GamesQRKTools['HL'   ][] = new cQRKTools('HLStandardSDK.zip','http://www.fileplanet.com/10361/10000/fileinfo/HL-Standard-SDK');
#$GamesQRKTools['HL'   ][] = new cQRKTools('fullsdk.EXE','http://www.fileplanet.com/44991/40000/fileinfo/Half-Life-SDK-v2.1-(Full)');
#$GamesQRKTools['HL'   ][] = new cQRKTools('standardsdk.EXE','http://www.fileplanet.com/44992/40000/fileinfo/Half-Life-SDK-v2.1-(Standard)');
#$GamesQRKTools['HL'   ][] = new cQRKTools('HL_Standard_SDK_2_2.exe','http://www.fileplanet.com/81536/80000/fileinfo/Standard-Half-Life-SDK-2.2');
$GamesQRKTools['HL'   ][] = new cQRKTools('hl_sdk_v23.exe','https://www.moddb.com/games/half-life/downloads/half-life-sdk-23'); #http://www.fileplanet.com/81535/80000/fileinfo/Full-Half-Life-SDK-2.3
$GamesQRKTools['HL'   ][] = new cQRKTools('Half-Life Unified SDK', 'https://github.com/twhl-community/halflife-unified-sdk', 'The Half-Life Unified SDK is a project that provides an updated version of the Half-Life SDK, with full support for the expansion packs Opposing Force and Blue Shift as well as new features.');
#$GamesQRKTools['HL'   ][] = new cQRKTools("zhlt_1.7p15.zip","http://www.trepid.net/files/");
#$GamesQRKTools['HL'   ][] = new cQRKTools("zhlt1.7 Custom Build","http://collective.valve-erc.com/index.php?go=mhlt");
$GamesQRKTools['HL'   ][] = new cQRKTools("Zoner's Half-Life Tools","https://www.ammahls.com/zhlt/zhlt.htm"); #http://www.zhlt.info/
$GamesQRKTools['HL'   ][] = new cQRKTools("Vluzacn's Map Compile Tools","https://gamebanana.com/tools/5391","Vluzacn's Map Compile Tools is derived from ZHLT 3.4 and massive amount of modification have been made during its development."); #https://forums.svencoop.com/showthread.php/40983-Downloads-amp-Changelogs
$GamesQRKTools['HL'   ][] = new cQRKTools("seedee's Half-Life Compilation Tools","https://github.com/seedee/SDHLT","Based on code modifications by Sean 'Zoner' Cavanaugh. Based on Valve's version, modified with permission.", true);
$GamesQRKTools['HL'   ][] = new cQRKTools("BSPTwoMap version 1.4b",$downloadroot."BSP2Map.zip","The purpose of BSPTwoMap is to decompile a Half-Life BSP file into a MAP file viewable in Valve's Hammer editor.");
$GamesQRKTools['HL'   ][] = new cQRKTools('Half-Life Unified SDK Map Decompiler', 'https://github.com/twhl-community/HalfLife.UnifiedSdk.MapDecompiler', 'The Half-Life Unified SDK Map Decompiler is a cross-platform map decompiler for Half-Life 1 BSP version 29 (Half-Life Alpha 0.52) and 30 files.<!-- Quake 1/2/3 and Source maps, as well as engine offshoots like Svengine and Paranoia 2 are not supported.-->');
#$GamesQRKTools['HL'   ][] = new cQRKTools("Half-Life Model Viewer v1.25",$downloadroot."hlmv125.zip"); #http://chumbalum.swissquake.ch/hlmv/index.html
$GamesQRKTools['HL'   ][] = new cQRKTools("Jed's Half-Life Model Viewer v1.36",$downloadroot."hlmv136_setup.zip");
$GamesQRKTools['HL'   ][] = new cQRKTools("Sprite Explorer v2.12",$downloadroot."spritexplo212.zip"); #http://www.hl2source.com/?content=projects&id=sprexplorer
$GamesQRKTools['HL'   ][] = new cQRKTools("Half-Life Sprite Viewer v1.05 Beta",$downloadroot."sprview.zip"); #http://www.planethalflife.com/mach3/sprites/sprview.html
$GamesQRKTools['HL'   ][] = new cQRKTools("Half-Life Sprite Maker v1.00 Beta",$downloadroot."sprmake.zip"); #http://www.planethalflife.com/mach3/sprites/sprmake.html
$GamesQRKTools['HL'   ][] = new cQRKTools("Half-Life Sprite Wizard v1.1",$downloadroot."sprwiz.zip","A Half-Life sprite compiler with a Windows interface.");
$GamesQRKTools['HL'   ][] = new cQRKTools("Darkulator - Version 2.0",$downloadroot."darkulator_2_0.zip","A utility for Half-Life BSP map files that will allow you to adjust the light levels in the map.");

# Half-Life: Opposing Force
$GamesQRKTools["HLOF" ] = array();
$GamesQRKTools["HLOF" ][] = new cQRKTools(" : : See Half-Life : : :",NULL);

# Half-Life: Blue Shift
$GamesQRKTools["HLBS" ] = array();
$GamesQRKTools["HLBS" ][] = new cQRKTools(" : : See Half-Life : : :",NULL);
$GamesQRKTools["HLBS" ][] = new cQRKTools("bspfix v1.1",$downloadroot."bspfix.zip","A program to convert to and from the Blue Shift .bsp format.");

# Counter-Strike
$GamesQRKTools["CS"   ] = array();
$GamesQRKTools["CS"   ][] = new cQRKTools(" : : See Half-Life : : :",NULL);

# Cry of Fear
$GamesQRKTools["CoF"  ] = array();
$GamesQRKTools["CoF"  ][] = new cQRKTools("CryOfFear_SDK_1.3.4.rar","https://www.moddb.com/games/cry-of-fear/downloads/cry-of-fear-sdk-v13");
$GamesQRKTools["CoF"  ][] = new cQRKTools(" : : See Half-Life : : :",NULL);

# Gunman Chronicles
$GamesQRKTools["GC"   ] = array();
$GamesQRKTools["GC"   ][] = new cQRKTools(" : : See Half-Life : : :",NULL);

# Ricochet
$GamesQRKTools["RICO" ] = array();
$GamesQRKTools["RICO" ][] = new cQRKTools(" : : See Half-Life : : :",NULL);

# Sin
$GamesQRKTools["SIN"  ] = array();
$GamesQRKTools["SIN"  ][] = new cQRKTools("sinbuild.zip",$downloadroot."build_tools/sinbuild.zip");
$GamesQRKTools["SIN"  ][] = new cQRKTools("sintools_full.zip",$downloadroot."build_tools/sintools_full.zip");
$GamesQRKTools["SIN"  ][] = new cQRKTools("wostools.zip",$downloadroot."build_tools/wostools.zip");
$GamesQRKTools["SIN"  ][] = new cQRKTools("wosctftools.zip",$downloadroot."build_tools/wosctftools.zip");

# King-pin
$GamesQRKTools["KP"   ] = array();
$GamesQRKTools["KP"   ][] = new cQRKTools("buildq2-39.zip",$downloadroot."build_tools/buildq2-39.zip"); #http://dl.fileplanet.com/dl/dl.asp?quark/buildtools/quake2/buildq2-39.zip
$GamesQRKTools["KP"   ][] = new cQRKTools("Kingpin_SDK_121.zip","https://dukeworld.com/planetquake/q2pmp/kingpin_sdk_121.zip"); #http://www.fileplanet.com/39676/30000/fileinfo/Kingpin-SDK-v1.21

# Soldier of Fortune
$GamesQRKTools["SOF"  ] = array();
#$GamesQRKTools["SOF"  ][] = new cQRKTools("sofsdk.zip","http://www.fileplanet.com/41191/40000/fileinfo/Soldier-of-Fortune-SDK");
$GamesQRKTools["SOF"  ][] = new cQRKTools("SOFSDK11.zip","https://www.gamefront.com/games/soldier-of-fortune/file/sof-sdk-1-1"); #http://www.fileplanet.com/45356/40000/fileinfo/Soldier-of-Fortune-SDK-v1.1

# Quake 3: Arena
$GamesQRKTools["Q3A"  ] = array();
$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.16",$downloadroot."build_tools/q3map_2.5.16_win32_x86.zip");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17 - Unofficial",$downloadroot."build_tools/q3map_2.5.17_win32_x86-unofficial.zip","Version from GtkRadiant-1.6.4-20131213");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x86-gtkradiant1.6.4-20131213.zip","Version from GtkRadiant1.6.4-20131213, 32 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x64-gtkradiant1.6.4-20131213.zip","Version from GtkRadiant1.6.4-20131213, 64 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x86-gtkradiant1.6.5-20151108.zip","Version from GtkRadiant1.6.5-20151108, 32 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x86-gtkradiant1.6.5-20151224.zip","Version from GtkRadiant1.6.5-20151224, 32 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x64-gtkradiant1.6.5-20151224.zip","Version from GtkRadiant1.6.5-20151224, 64 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x86-gtkradiant1.6.5-20160424.zip","Version from GtkRadiant1.6.5-20160424, 32 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x64-gtkradiant1.6.5-20160424.zip","Version from GtkRadiant1.6.5-20160424, 64 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x86-gtkradiant1.6.5-20160813.zip","Version from GtkRadiant1.6.5-20160813, 32 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x64-gtkradiant1.6.5-20160813.zip","Version from GtkRadiant1.6.5-20160813, 64 bit");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x86-gtkradiant1.6.5-20170806.zip","Version from GtkRadiant1.6.5-20170806, 32 bit", True);
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x64-gtkradiant1.6.5-20170806.zip","Version from GtkRadiant1.6.5-20170806, 64 bit");
$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x86-gtkradiant1.6.7-20230820.zip","Version from GtkRadiant1.6.7-20230820, 32 bit", True);
$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3Map2 Version 2.5.17",$downloadroot."build_tools/q3map_2.5.17_win32_x64-gtkradiant1.6.7-20230820.zip","Version from GtkRadiant1.6.7-20230820, 64 bit");
$GamesQRKTools["Q3A"  ][] = new cQRKTools("rmapc Version 0.4","https://sourceforge.net/projects/rmapc/files/rmapc/v0.4/rmapc.v0.4.zip/download","rmapc is an efficient free map compiler for games using BSP files. Although influenced by id Software's quake map compiler, rmapc is developed from scratch and does not reuse code with similar utilities.");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("MAP3BSPC - version 0.3","http://sourceforge.net/projects/map3bspc/files/Win32%20Binaries/MAP3BSPC%20v0.3%20binaries/map3bspc_win32bin_0.3.zip/download"); #Most likely incompatible
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("BSPC - v2.1h",$downloadroot."build_tools/bspc-v2.1h.zip");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("BSPC - v2.1h",$downloadroot."build_tools/bspc_2.1h_win32_x86-gtkradiant1.6.4-20131213.zip","Version from GtkRadiant1.6.4-20131213");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("BSPC - v2.1h",$downloadroot."build_tools/bspc_2.1h_win32_x86-gtkradiant1.6.5-20151224.zip","Version from GtkRadiant1.6.5-20151224");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("BSPC - v2.1h",$downloadroot."build_tools/bspc_2.1h_win32_x86-gtkradiant1.6.5-20160424.zip","Version from GtkRadiant1.6.5-20160424");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("BSPC - v2.1h",$downloadroot."build_tools/bspc_2.1h_win32_x86-gtkradiant1.6.5-20170806.zip","Version from GtkRadiant1.6.5-20170806");
$GamesQRKTools["Q3A"  ][] = new cQRKTools("BSPC - v2.1h",$downloadroot."build_tools/bspc_2.1h_win32_x86-gtkradiant1.6.7-20230820.zip","Version from GtkRadiant1.6.7-20230820");
$GamesQRKTools["Q3A"  ][] = new cQRKTools("BSPC - v2.1i",$downloadroot."build_tools/bspc_v2_1i.zip","Increases some map limits; v2.1h is fine if you're not having trouble with it.", True);
$GamesQRKTools["Q3A"  ][] = new cQRKTools("pakscape-011.zip",$downloadroot."pakscape-011.zip","For viewing & creation of .pak files");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3ToolSetup.exe","http://www.gamers.org/pub/idgames/idstuff/quake3/tools/Q3ToolSetup.exe"); #ftp://ftp.idsoftware.com/
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3ToolSetup_Dec221999.exe","http://www.gamers.org/pub/idgames/idstuff/quake3/tools/Q3ToolSetup_Dec221999.exe"); #ftp://ftp.idsoftware.com/
$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3ToolSetup_Mar172000.exe","http://www.gamers.org/pub/idgames/idstuff/quake3/tools/Q3ToolSetup_Mar172000.exe"); #ftp://ftp.idsoftware.com
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("Q3ToolSetup_Mar172000.exe","http://www.fileplanet.com/39158/30000/fileinfo/Quake3:-Arena-Editing-Tools-(Build-197)");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("readme.txt","http://shaderlab.com/q3map2/md3fix/readme.txt");
#$GamesQRKTools["Q3A"  ][] = new cQRKTools("md3fix_0.1.zip","http://shaderlab.com/q3map2/md3fix/md3fix_0.1.zip");
$GamesQRKTools["Q3A"  ][] = new cQRKTools("md3fix_0.2.zip","http://shaderlab.com/q3map2/md3fix/md3fix_0.2.zip","Quake III Arena MD3 model fixer. Fixes bad shader names, corrupted vertex normals, incorrect frame bounds, and misc other stuff.");

# Quake 3: Team Arena
$GamesQRKTools["Q3TA" ][] = new cQRKTools(" : : See Quake 3: Arena : : :",NULL);

# Star Trek Voyager: Elite Force
$GamesQRKTools["STVEF"] = array();
#$GamesQRKTools["STVEF"][] = new cQRKTools("eliteforceGDK.zip","http://www.fileplanet.com/50614/50000/fileinfo/Elite-Force-Game-Development-Kit");
#$GamesQRKTools["STVEF"][] = new cQRKTools("eliteforcegdk11.zip","http://eliteforce2.filefront.com/file/Elite_Force_Game_Development_Kit;709");
$GamesQRKTools["STVEF"][] = new cQRKTools("eliteforceGDK2.zip","http://eliteforce2.filefront.com/file/Elite_Force_GDK_2;1063");
$GamesQRKTools["STVEF"][] = new cQRKTools("Q3Map2 Version 2.5.16",$downloadroot."build_tools/q3map_2.5.16_win32_x86.zip");
$GamesQRKTools["STVEF"][] = new cQRKTools("Q3Map2 Version 2.5.17 - Unofficial",$downloadroot."build_tools/q3map_2.5.17_win32_x86-unofficial.zip","Version from GtkRadiant-1.6.4-20131213", True);
$GamesQRKTools["STVEF"][] = new cQRKTools("eliteforce-icarus.zip","http://eliteforce2.filefront.com/file/Ravens_Icarus_scripting_tools;657");
$GamesQRKTools["STVEF"][] = new cQRKTools("pakscape-011.zip",$downloadroot."pakscape-011.zip","For viewing & creation of .pak files");
$GamesQRKTools["STVEF"][] = new cQRKTools("arenagenerator.zip","http://eliteforce2.filefront.com/file/Arena_File_Generator;4546");
$GamesQRKTools["STVEF"][] = new cQRKTools("agv11.zip","http://eliteforce2.filefront.com/file/Arena_Generator_Patch;4547","Update for arenagenerator.zip file.");
#$GamesQRKTools["STVEF"][] = new cQRKTools("BSPC - v1.9 (Raven mod)",$downloadroot."build_tools/bspc-v1.9-Raven.zip","With Raven modifications");
$GamesQRKTools["STVEF"][] = new cQRKTools("BSPC - v1.9a (Raven mod)",$downloadroot."build_tools/bspc-v1.9a-Raven.zip","With Raven modifications", True);

# Star Trek Voyager: Elite Force: Expansion Pack
$GamesQRKTools["STVEFXP"][] = new cQRKTools(": : See Star Trek Voyager: Elite Force : : :",NULL);

# Crystal Space
#$GamesQRKTools["CrSp" ] = array();
#$GamesQRKTools["CrSp" ][] = new cQRKTools("",NULL);

# Return to Castle Wolfenstein
$GamesQRKTools["RTCW" ] = array();
$GamesQRKTools["RTCW" ][] = new cQRKTools("WolfToolsSDK.zip","https://www.doomworld.com/idgames/idstuff/qeradiant/SDK-unsupported/WolfToolsSDK"); #http://www.fileplanet.com/83872/80000/fileinfo/Wolfenstein-Level-Editing-Tools
$GamesQRKTools["RTCW" ][] = new cQRKTools("Q3Map2 Version 2.5.16",$downloadroot."build_tools/q3map_2.5.16_win32_x86.zip");
$GamesQRKTools["RTCW" ][] = new cQRKTools("Q3Map2 Version 2.5.17 - Unofficial",$downloadroot."build_tools/q3map_2.5.17_win32_x86-unofficial.zip","Version from GtkRadiant-1.6.4-20131213");
$GamesQRKTools["RTCW" ][] = new cQRKTools("RTCW_bspc.zip",$downloadroot."build_tools/RTCW_bspc.zip","To be placed in the *RTCW*\\QuArK files\\bspc folder");

# Return to Castle Wolfenstein: Enemy Territory
$GamesQRKTools["RTCW-ET"] = array();
$GamesQRKTools["RTCW-ET"][] = new cQRKTools(": : See Return to Castle Wolfenstein : : :",NULL);

# 6DX
#$GamesQRKTools["6DX"  ] = array();
#$GamesQRKTools["6DX"  ][] = new cQRKTools("",NULL);

# Torque
$GamesQRKTools["T"    ] = array();
$GamesQRKTools["T"    ][] = new cQRKTools("Torque DIF build tool",$downloadroot."build_tools/TORQUEmap2dif_DEBUG.zip");
#$GamesQRKTools["T"    ][] = new cQRKTools("map2dif converter","http://alexswanson.com/torque/downloads/map2dif.exe.zip","April 04 version"); #http://alexswanson.com/torque/dif/
#$GamesQRKTools["T"    ][] = new cQRKTools("Valve220 .MAP to DIF","http://www.garagegames.com/mg/projects/torque1/artist.php#DIF");
$GamesQRKTools["T"    ][] = new cQRKTools("map2dif_plus.exe","http://www.rustycode.com/matt/map2dif_plus.exe","Map2dif Plus for TGE");
$GamesQRKTools["T"    ][] = new cQRKTools("map2dif_plus_tse.exe","http://www.rustycode.com/matt/map2dif_plus_tse.exe","Map2dif Plus for TSE");
#$GamesQRKTools["T"    ][] = new cQRKTools("map2dif_plus_tse.exe","http://www.monsterpacks.com/contentpacks/code/v2/map2dif_plus_tse.exe");

# Jedi Knight 2
$GamesQRKTools["JK2"  ] = array();
#$GamesQRKTools["JK2"  ][] = new cQRKTools("JK2EditingTools.zip","http://files.filefront.com/jk2editingtoolszip/;2662102;/fileinfo.html");
#$GamesQRKTools["JK2"  ][] = new cQRKTools("JK2EditingTools2.exe","http://www.fileplanet.com/87277/80000/fileinfo/Jedi-Knight-II:-Jedi-Outcast-Tools-[Updated]");
$GamesQRKTools["JK2"  ][] = new cQRKTools("jk2editingtools2.exe","http://jediknight3.filefront.com/file/JK2_Editing_Tools;2888");
$GamesQRKTools["JK2"  ][] = new cQRKTools("Q3Map2 Version 2.5.16",$downloadroot."build_tools/q3map_2.5.16_win32_x86.zip");
$GamesQRKTools["JK2"  ][] = new cQRKTools("Q3Map2 Version 2.5.17 - Unofficial",$downloadroot."build_tools/q3map_2.5.17_win32_x86-unofficial.zip","Version from GtkRadiant-1.6.4-20131213");

# Medal of Honor: Allied Assault
$GamesQRKTools["MOHAA"] = array();
$GamesQRKTools["MOHAA"][] = new cQRKTools("MOHAATools.zip","https://www.gamefront.com/games/medal-of-honor/file/mohaa-tools"); #http://www.fileplanet.com/86998/80000/fileinfo/Medal-of-Honor:-Allied-Assault-Tools
#$GamesQRKTools["MOHAA"][] = new cQRKTools("mohaatools.zip","http://www.gamefront.com/files/967110/mohaatools_zip");
$GamesQRKTools["MOHAA"][] = new cQRKTools("MohaaTools1.6b.zip","http://www.gamefront.com/files/1323400/MohaaTools1_6b_zip");

# Medal of Honor: Allied Assault: Breakthrough
$GamesQRKTools["MOHAAB"][] = new cQRKTools(": : See Medal of Honor: Allied Assault : : :",NULL);

# Medal of Honor: Allied Assault: Spearhead
$GamesQRKTools["MOHAAS"] = array();
$GamesQRKTools["MOHAAS"][] = new cQRKTools("mohaas_sdk_install.exe","http://www.gamefront.com/files/816391/mohaas_sdk_install.exe");
$GamesQRKTools["MOHAAS"][] = new cQRKTools(": : See Medal of Honor: Allied Assault : : :",NULL);

# Medal of Honor: Pacific Assault
$GamesQRKTools["MOHPA"] = array();
#$GamesQRKTools["MOHPA"][] = new cQRKTools("mdk_final_1.1_broadband.zip","http://www.fileplanet.com/148386/140000/fileinfo/Medal-of-Honor:-Pacific-Assault---Mod-Developer's-Kit-v1.1");
$GamesQRKTools["MOHPA"][] = new cQRKTools("mdk_final_11.zip","https://www.moddb.com/games/medal-of-honor-pacific-assault/downloads/modification-developers-kit");

# Soldier of Fortune 2
$GamesQRKTools["SOF2" ] = array();
$GamesQRKTools["SOF2" ][] = new cQRKTools("Soldier of Fortune 2 SDK (1.01a)","http://soldieroffortune2.filefront.com/file/Soldier_of_Fortune_2_SDK;4032"); #"sof2sdk-101a.zip"
$GamesQRKTools["SOF2" ][] = new cQRKTools("Soldier of Fortune 2 Single Player SDK - Update (1.01b)","http://soldieroffortune2.filefront.com/file/Soldier_of_Fortune_2_Single_Player_SDK_Update;6909"); #"sof2sdk-101b.zip"
#$GamesQRKTools["SOF2" ][] = new cQRKTools("sof2mpsdk.zip","http://www.fileplanet.com/88445/80000/fileinfo/Soldier-of-Fortune-II-Multiplayer-SDK");
#$GamesQRKTools["SOF2" ][] = new cQRKTools("Soldier of Fortune 2 Multiplayer SDK (1.0)","http://soldieroffortune2.filefront.com/file/Soldier_of_Fortune_2_Multiplayer_SDK;2777"); #"sof2mpsdk.zip"
#$GamesQRKTools["SOF2" ][] = new cQRKTools("Soldier of Fortune 2 Multiplayer SDK (1.01)","http://soldieroffortune2.filefront.com/file/Soldier_of_Fortune_2_Multiplayer_SDK;3943"); #"sof2sdk-101.msi"
$GamesQRKTools["SOF2" ][] = new cQRKTools("Soldier of Fortune 2 Multiplayer SDK (1.02)","http://soldieroffortune2.filefront.com/file/Soldier_of_Fortune_2_Multiplayer_SDK;5824"); #"sof2_1_2sdk.msi"
$GamesQRKTools["SOF2" ][] = new cQRKTools("Unofficial SOF2 1.03 MP Source Code","http://soldieroffortune2.filefront.com/file/;15375");

# Sylphis engine
#$GamesQRKTools["S"    ] = array();
#$GamesQRKTools["S"    ][] = new cQRKTools("",NULL);

# Jedi Academy
$GamesQRKTools["JA"   ] = array();
#$GamesQRKTools["JA"   ][] = new cQRKTools("jedi_academy_sdk_mp.exe","http://www.fileplanet.com/133690/130000/fileinfo/Star-Wars-Jedi-Knight:-Jedi-Academy-SDK");
$GamesQRKTools["JA"   ][] = new cQRKTools("jedi_academy_sdk.zip","http://jediknight3.filefront.com/file/Jedi_Academy_SDK_MP;20909","Jedi Academy SDK (MP)");
$GamesQRKTools["JA"   ][] = new cQRKTools("Q3Map2 Version 2.5.16",$downloadroot."build_tools/q3map_2.5.16_win32_x86.zip");
$GamesQRKTools["JA"   ][] = new cQRKTools("Q3Map2 Version 2.5.17 - Unofficial",$downloadroot."build_tools/q3map_2.5.17_win32_x86-unofficial.zip","Version from GtkRadiant-1.6.4-20131213");

# Star Trek: Elite Force 2
$GamesQRKTools["EF2"  ] = array();
$GamesQRKTools["EF2"  ][] = new cQRKTools("Elite Force 2 GDK", "https://www.gamefront.com/games/elite-force-2/file/elite-force-2-gdk"); #http://www.fileplanet.com/129283/120000/fileinfo/Star-Trek:-Elite-Force-II-GDK-v1.0.0
#$GamesQRKTools["EF2"][] = new cQRKTools("ubertools_gdk_1_0_0.exe","http://eliteforce2.filefront.com/file/Elite_Force_2_GDK;17844"); #FIXME!

# Doom 3
$GamesQRKTools["DM3"  ] = array();
$GamesQRKTools["DM3"  ][] = new cQRKTools("Doom 3 1.3.1 SDK","http://www.gamers.org/pub/idgames/idstuff/doom3/source/win32/D3_1.3.1_SDK.exe"); #ftp://ftp.idsoftware.com/
#$GamesQRKTools["DM3"  ][] = new cQRKTools("Osman Turan's BSP compiler","http://www.osmanturan.com/");

# Doom Eternal
$GamesQRKTools["DM5"  ] = array();
$GamesQRKTools["DM5"  ][] = new cQRKTools("idStudio","https://idstudio.idsoftware.com/","Only available on Steam (PC), idStudio Beta allows community members to create and publish original mods for all Steam (PC) and Microsoft Store (PC) players."); #steam://store/2545650

# Half-Life 2
#$GamesQRKTools["HL2"  ] = array(); #Note: Already done above for Source SDK!
$GamesQRKTools["HL2"  ][] = new cQRKTools("Custom Source Tools","https://www.ammahls.com/zhlt/cst.htm","These tools are for all games Built on the Source Engine, including, Counter-Strike Source, and Half Life 2.");
$GamesQRKTools["HL2"  ][] = new cQRKTools("BSPSource","https://github.com/ata4/bspsrc","BSPSource is a map decompiler for Source engine maps, written in Java."); #http://ata4.info/bspsrc/
$GamesQRKTools["HL2"  ][] = new cQRKTools("VMEX","http://www.bagthorpe.org/bob/cofrdrbob/vmex.html","VMEX is a simple map decompiler for Half-Life 2 Source engine maps (i.e., for HL2, HL2DM, CS:S, and DoD:S).");
$GamesQRKTools["HL2"  ][] = new cQRKTools("Entspy","http://www.bagthorpe.org/bob/cofrdrbob/entspy.html","Entspy is a program that lets you view and edit the entity properties of a compiled BSP map file (for Source Engine games such as HL2, CS:S and VtMB).");
$GamesQRKTools["HL2"  ][] = new cQRKTools("VMTMak0r-Eng.exe",$downloadroot."VMTMak0r-Eng.exe","H-L2 vmt flag setting program-English version"); #http://www.marcel-soehnchen.de/downloads/vmtmak0r.rar
#$GamesQRKTools["HL2"  ][] = new cQRKTools("VMTMak0r-Ger.exe",$downloadroot."VMTMak0r-Ger.exe","H-L2 vmt flag setting program-German version"); #http://www.mapping-tutorials.de/forum/showthread.php?p=20972
#$GamesQRKTools["HL2"  ][] = new cQRKTools("GCFScape","http://nemesis.thewavelength.net/index.php?p=26","GCFScape is an explorer like utility that enables users to browse Half-Life packages and extract their contents.");
$GamesQRKTools["HL2"  ][] = new cQRKTools("StudioCompiler","http://www.chaosincarnate.net/cannonfodder/download.php?id=StudioCompilerSetup.V0.4A.exe","A GUI interface to studiomdl and vtex.");
#$GamesQRKTools["HL2"  ][] = new cQRKTools("MDLDecompiler","http://www.chaosincarnate.net/cannonfodder/download.php?id=mdldecompiler.05.rar","A program for decompiling Half-Life 2 and CS:Source models.");
#$GamesQRKTools["HL2"  ][] = new cQRKTools("VPKEdit","https://github.com/craftablescience/VPKEdit/releases","A library and CLI/GUI tool to create, read, and write several pack file formats.");
#$GamesQRKTools["HL2"  ][] = new cQRKTools("VTF Explorer",$downloadroot."vtfexplorer13_setup.exe"); #http://www.hl2source.com/?content=projects&id=vtftool

# Counter-strike: Source
$GamesQRKTools["CSS"  ][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Half-Life: Source
$GamesQRKTools["HLS"  ][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Half-Life 2: Deathmatch
$GamesQRKTools["HL2DM"][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Half-Life 2: Episode 1
$GamesQRKTools["HL2EP1"][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Half-Life 2: Episode 2
$GamesQRKTools["HL2EP2"][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Half-Life 2: Episode 3
#$GamesQRKTools["HL2EP3"][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Half-Life 2: Lost Coast
#$GamesQRKTools["HL2LC"][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Portal
$GamesQRKTools["P"    ][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Portal 2
#$GamesQRKTools["P2"   ][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Team Fortress 2
$GamesQRKTools["TF2"  ][] = new cQRKTools(": : See Half-Life 2 : : :",NULL);

# Quake 4
$GamesQRKTools["Q4"   ] = array();
$GamesQRKTools["Q4"   ][] = new cQRKTools("quake4-1.4.2-sdk.exe","http://www.gamers.org/pub/idgames/idstuff/quake4/source/win32/Quake4-1.4.2-SDK.exe"); #ftp://ftp.idsoftware.com

# Enemy Territory: QUAKE Wars
$GamesQRKTools["ETQW" ] = array();
$GamesQRKTools["ETQW" ][] = new cQRKTools("ETQW-SDK-1.5.exe","https://www.ausgamers.com/files/download/35927/enemy-territory-quake-wars-sdk-v15"); #http://www.fileplanet.com/183867/180000/fileinfo/Enemy-Territory:-Quake-Wars-v1.5-SDK

# Prey
$GamesQRKTools["PREY" ] = array();
#$GamesQRKTools["PREY" ][] = new cQRKTools("PREY_SDK_2006-10-09.zip","http://www.fileplanet.com/169067/160000/fileinfo/Prey-SDK");
$GamesQRKTools["PREY" ][] = new cQRKTools("PREY_SDK_2006-10-13.zip","ftp://ftp.3drealms.com/source/PREY_SDK_2006-10-13.zip"); #http://www.prey.com/downloads/PREY_SDK_2006-10-13.zip

# American McGee's Alice
$GamesQRKTools["ALICE"] = array();
$GamesQRKTools["ALICE"][] = new cQRKTools("Wonderland tools",$downloadroot."build_tools/Wonderland_tools.zip","Bsp2wonderland converts maps created for FAKK into Alice format and Wonderland2map decompile bsp to map."); #https://sites.google.com/site/yannhennequin/Wonderland_tools.zip?attredirects=0

# Anachronox
$GamesQRKTools["AN"   ] = array();
$GamesQRKTools["AN"   ][] = new cQRKTools("anachrodox1_2.zip","https://www.moddb.com/downloads/anachronox-modding-tools"); #https://www.fileplanet.com/63920/60000/fileinfo/Anachronox-Editing-Tools-and-Docs-v1.2
$GamesQRKTools["AN"   ][] = new cQRKTools("AnachroRadiant1_65.zip","http://anachrodox.disinterest.org/tools/tools/AnachroRadiant1_65.zip","Currently the best Anachronox map editing program."); #http://www.euksy.oldtimes-software.com/files/Anachronox/AnachroRadiant1_65.zip
$GamesQRKTools["AN"   ][] = new cQRKTools("IONRadiant.zip","http://anachrodox.disinterest.org/tools/tools/IONRadiant.zip","This is the original map editing program for Anachronox."); #http://www.euksy.oldtimes-software.com/files/Anachronox/IONRadiant.zip
$GamesQRKTools["AN"   ][] = new cQRKTools("datextract2.zip",$downloadroot."build_tools/datextract2.zip"); #http://dl.fileplanet.com/dl/dl.asp?planetanachronox/utilities/datextract2.zip
$GamesQRKTools["AN"   ][] = new cQRKTools("decompile2_0.zip","http://anachrodox.disinterest.org/tools/tools/decompile2_0.zip","Decompile V 2.0 A.K.A Anoxtools");

# Daikatana
$GamesQRKTools["DK"   ] = array();
$GamesQRKTools["DK"   ][] = new cQRKTools("dkmapedit.zip","https://www.moddb.com/downloads/ionradiant-for-daikatana"); #http://www.fileplanet.com/48509/40000/fileinfo/IonRadiant-(Daikatana-Map-Editing-Tools)
$GamesQRKTools["DK"   ][] = new cQRKTools("dktools_11h.7z","https://bitbucket.org/daikatana13/daikatana/downloads/dktools_11h.7z","Updated for IonRadiant 1.1 by Knightmare");

# Heavy Metal:F.A.K.K.2
$GamesQRKTools["FAKK" ] = array();
$GamesQRKTools["FAKK" ][] = new cQRKTools("fakktools102.zip",$downloadroot."build_tools/fakktools102.zip");

# Nexuiz
$GamesQRKTools["NEX"  ] = array();
#$GamesQRKTools["NEX"  ][] = new cQRKTools("Q3Map2 Version 2.5.16",$downloadroot."build_tools/q3map_2.5.16_win32_x86.zip");
#$GamesQRKTools["NEX"  ][] = new cQRKTools("Q3Map2 Version 2.5.17 - Unofficial",$downloadroot."build_tools/q3map_2.5.17_win32_x86-unofficial.zip","Version from GtkRadiant-1.6.4-20131213");
#$GamesQRKTools["NEX"  ][] = new cQRKTools("Q3Map2 Version 2.5.17 - svn402",$downloadroot."build_tools/q3map_2.5.17_win32_x86-svn402.zip","Unofficial version of Q3Map2 specifically updated for Nexuiz support.");
#$GamesQRKTools["NEX"  ][] = new cQRKTools("Q3Map2 Version 2.5.17 - n-git-f43d2c5",$downloadroot."build_tools/q3map_2.5.17_win32_x86-n-git-f43d2c5.zip","Unofficial version of Q3Map2 specifically updated for Nexuiz support.");
$GamesQRKTools["NEX"  ][] = new cQRKTools("Q3Map2 Version 2.5.17 - n-git-34dd934",$downloadroot."build_tools/q3map_2.5.17_win32_x86-n-git-34dd934.zip","Unofficial version of Q3Map2 specifically updated for Nexuiz support.");
#$GamesQRKTools["NEX"  ][] = new cQRKTools("q3map2-2.5.16-nexuiz.zip","http://zdev.dvrdns.org/nexuiz/q3map2-2.5.16-nexuiz.zip");
#$GamesQRKTools["NEX"  ][] = new cQRKTools("nexuiz-radiant.zip","http://zdev.dvrdns.org/nexuiz/nexuiz-radiant.zip"); #OLD
#$GamesQRKTools["NEX"  ][] = new cQRKTools("NetRadiant","http://www.icculus.org/netradiant/");

# Call of Duty 1
$GamesQRKTools["CoD"  ] = array();
$GamesQRKTools["CoD"  ][] = new cQRKTools("codtools.zip","https://www.gamefront.com/games/call-of-duty/file/call-of-duty-mod-tools"); #http://files.filefront.com/Call+Of+Duty+MOD+Tools/;1390643;/fileinfo.html
#$GamesQRKTools["CoD"  ][] = new cQRKTools("codtools.exe","http://www.fileplanet.com/133475/130000/fileinfo/Call-of-Duty-Mod-&-Map-Tools");
#$GamesQRKTools["CoD"  ][] = new cQRKTools("mapping_codtools_win98-me.zip","http://www.fileplanet.com/136214/130000/fileinfo/Call-of-Duty-Mod-&-Map-Tools-[Windows-98]");
$GamesQRKTools["CoD"  ][] = new cQRKTools("viewmodeltools.zip","https://www.gamefront.com/games/call-of-duty/file/cod-viewmodel-tools"); #http://www.fileplanet.com/135717/130000/fileinfo/Call-of-Duty-Modeling-Tool
$GamesQRKTools["CoD"  ][] = new cQRKTools("BSP Decompiler.exe","https://github.com/kungfooman/CoD-BSP-Decompiler/","Call of Duty 1 and 2 BSP Decompiler");

# Call of Duty 1: United Offensive
$GamesQRKTools["CoDuo"] = array();
$GamesQRKTools["CoDuo"][] = new cQRKTools("coduo_tools.exe","https://www.gamefront.com/games/call-of-duty/file/call-of-duty-united-offensive-map-and-mod-tools"); #https://gamefront.online/files/3649114/coduo_tools.exe

# Call of Duty 2
$GamesQRKTools["CoD2" ] = array();
$GamesQRKTools["CoD2" ][] = new cQRKTools("callofduty2modtools.exe","https://www.ausgamers.com/files/download/21960/call-of-duty-2-mod-tools"); #http://www.fileplanet.com/162620/160000/fileinfo/Call-of-Duty-2-MOD-Tools
$GamesQRKTools["CoD2" ][] = new cQRKTools("BSP Decompiler.exe","https://github.com/kungfooman/CoD-BSP-Decompiler/","Call of Duty 1 and 2 BSP Decompiler");

# Call of Duty 4
$GamesQRKTools["CoD4" ] = array();
$GamesQRKTools["CoD4" ][] = new cQRKTools("cod4mw_modtools_v1.zip","https://www.ausgamers.com/files/download/33184/call-of-duty-4-modern-warfare-mod-tools-v10"); #http://www.fileplanet.com/183907/180000/fileinfo/Call-of-Duty-4:-Modern-Warfare-Mod-Tools
$GamesQRKTools["CoD4" ][] = new cQRKTools("cod4mw_modtools_v11_update.zip","https://www.ausgamers.com/files/download/33368/call-of-duty-4-modern-warfare-mod-tools-patch-v11"); #http://www.fileplanet.com/184151/180000/fileinfo/Call-of-Duty-4-v1.1-Mod-Tools-Patch
$GamesQRKTools["CoD4" ][] = new cQRKTools("cod4mwmodtoolssppatchsetup.exe","https://gamefront.online/files/9554208/cod4mwmodtoolssppatchsetup.exe"); #http://callofduty.filefront.com/file/CoD4_Modern_Warfare_v15_Mod_Tools_Patch;86291

# Call of Duty 5
$GamesQRKTools["CoD5" ] = array();
#http://www.gamefront.com/games/call-of-duty-world-at-war/downloads/call-of-duty-world-at-war-sdk
#http://www.fileplanet.com/194755/190000/fileinfo/Call-of-Duty:-World-at-War---Mod-Tools
#http://wiki.modsrepository.com/codww_files/codww_modtools_1.2.1.zip
#$GamesQRKTools["CoD5" ][] = new cQRKTools("CoDWaW_ModTools_Package_v1.1b.zip","http://www.fileplanet.com/196288/190000/fileinfo/Call-of-Duty:-World-At-War---ModTools-Package-v1.1-Update");
#$GamesQRKTools["CoD5" ][] = new cQRKTools("CoD_WW_MODTOOLS_v1.2.zip","http://www.fileplanet.com/198535/190000/fileinfo/Call-of-Duty:-World-At-War---ModTools-Package-v1.2-Update-");
#$GamesQRKTools["CoD5" ][] = new cQRKTools("CoD_WW_MODTOOLS_1.3.zip","http://www.fileplanet.com/202518/200000/fileinfo/Call-of-Duty:-World-At-War---ModTools-Package-v1.3-Update-");
#$GamesQRKTools["CoD5" ][] = new cQRKTools("CoD_WW_MODTOOLS_1.4.zip","http://www.fileplanet.com/205214/200000/fileinfo/Call-of-Duty:-World-at-War---ModTools-Package-v1.4-Update");
$GamesQRKTools["CoD5" ][] = new cQRKTools("CodWaW_ModTools_v1.4.zip","https://www.ausgamers.com/files/download/47316/call-of-duty-world-at-war-mod-tools-v14"); #http://www.fileplanet.com/194755/190000/fileinfo/Call-of-Duty:-World-at-War-ModTools-v1.4

#UFO: Alien Invasion
$GamesQRKTools["UFO"  ] = array();
#$GamesQRKTools["UFO"  ][] = new cQRKTools("uforadiant-1.5.0-win32.exe","https://sourceforge.net/projects/ufoai/files/UFO_AI%202.x/2.3/uforadiant-1.5.0-win32.exe/download");
$GamesQRKTools["UFO"  ][] = new cQRKTools("uforadiant-1.6.0-win32.exe","https://sourceforge.net/projects/ufoai/files/UFO_AI%202.x/2.4/uforadiant-1.6.0-win32.exe/download"); #http://www.destructavator.com/ufoai/uforadiant-1.6.0-win32.exe

#Warsow
$GamesQRKTools["W"    ] = array();
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_0.4_sdk.zip","http://launchpad.net/warsow/0.4/0.4/+download/warsow_0.4_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_0.41_sdk.zip","http://launchpad.net/warsow/0.4/0.41/+download/warsow_0.41_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_0.42_sdk.zip","http://launchpad.net/warsow/0.4/0.42/+download/warsow_0.42_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_0.5_sdk.zip","http://launchpad.net/warsow/0.5/0.5/+download/warsow_0.5_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_0.6_sdk.zip","http://www.zcdn.org/dl/warsow_0.6_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_0.61_sdk.zip","http://www.zcdn.org/dl/warsow_0.61_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_0.62_sdk.zip","http://www.zcdn.org/dl/warsow_0.62_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_1.02_sdk.tar.gz","http://www.warsow.net:1337/~warsow/1.02/warsow_1.02_sdk.tar.gz"); #http://www.zcdn.org/dl/1.02/warsow_1.02_sdk.tar.gz
#$GamesQRKTools["W"    ][] = new cQRKTools("warsow_1.51_sdk.tar.gz","http://www.warsow.net/download?dl=warsow151sdk");
$GamesQRKTools["W"    ][] = new cQRKTools("warsow_21_sdk.tar.gz","https://warsow.net/warsow_21_sdk.tar.gz"); #https://www.warsow.gg/download?dl=warsow21sdk
#$GamesQRKTools["W"    ][] = new cQRKTools("qfmap2_2.5.17_Warsow_0.61_sdk.zip",$downloadroot."build_tools/qfmap2_2.5.17_Warsow_0.61_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("qfmap2_2.5.17_Warsow_0.62_sdk.zip",$downloadroot."build_tools/qfmap2_2.5.17_Warsow_0.62_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("qfmap2_2.5.17_Warsow_1.02_sdk.zip",$downloadroot."build_tools/qfmap2_2.5.17_Warsow_1.02_sdk.zip");
#$GamesQRKTools["W"    ][] = new cQRKTools("qfmap2_2.5.17_Warsow_1.51_sdk.zip",$downloadroot."build_tools/qfmap2_2.5.17_Warsow_1.51_sdk.zip");
$GamesQRKTools["W"    ][] = new cQRKTools("q3map2_2.5.17_Warsow_2.1_sdk.zip",$downloadroot."build_tools/q3map2_2.5.17_Warsow_2.1_sdk.zip");

#World of Padman
#$GamesQRKTools["PAD"  ] = array();
#$GamesQRKTools["PAD"  ][] = new cQRKTools("?","http://www.moddb.com/games/world-of-padman/downloads/wop-mapping-2in1-installer-for-windows");
#$GamesQRKTools["PAD"  ][] = new cQRKTools("Q3Map2.5.17 FS 20g compiler by TwentySeven","http://www.moddb.com/games/world-of-padman/downloads/q3map2517-fs-20g-compiler-by-twentyseven");

# Blockland
$GamesQRKTools["BL"   ] = array();
$GamesQRKTools["BL"   ][] = new cQRKTools("map2dif.zip","http://www.blockland.us/files/map2dif.zip","map2dif 0.900d-beta");

# James Bond 007: Nightfire
$GamesQRKTools["JBNF" ] = array();
$GamesQRKTools["JBNF" ][] = new cQRKTools("jbn-bsp-lump-tools","http://code.google.com/p/jbn-bsp-lump-tools/","A comprehensive set of tools for maps from James Bond 007: Nightfire (PC) in BSP form.");

# Marble Blast
$GamesQRKTools["MB"   ] = array();
$GamesQRKTools["MB"   ][] = new cQRKTools("map2dif_plus_mbg_v1.01.zip","https://marbleblast.com/index.php/downloads/extras/download/18-extras/199-map2dif-plus-mbg-v1-01","Map2Dif Plus - Windows 1.01");
$GamesQRKTools["MB"   ][] = new cQRKTools(": : See Torque engine : : :",NULL);

# OverDose
$GamesQRKTools["OD"   ] = array();
$GamesQRKTools["OD"   ][] = new cQRKTools("ODMap.exe","https://sourceforge.net/p/odblur/code/HEAD/tree/ODMap.exe?format=raw","OverDose uses .map files in the editing stage that are compiled into .bsp files. This is a tool designed to make that compile not only a simple click, but also allow the user to select many configurable options, such as removing certain features of levels and fast compiling.");

# Sven Co-op
$GamesQRKTools["SC"   ] = array();
$GamesQRKTools["SC"   ][] = new cQRKTools("Sven Co-op SDK","steam://install/276160","(You'll need Steam for this link to work)");

# Transfusion
$GamesQRKTools["TRANS"] = array();
$GamesQRKTools["TRANS"][] = new cQRKTools("TFn_SDK_20080322.zip","http://www.transfusion-game.com/files/TFn_SDK_20080322.zip");

# The Dark Mod
$GamesQRKTools["TDM"  ] = array();
$GamesQRKTools["TDM"  ][] = new cQRKTools("DarkRadiant","https://www.darkradiant.net/","An open-source Level Editor for Doom 3 and The Dark Mod.");

#Generic tools
$GenericTools = array();
$GenericTools['Extracting'] = array();
$GenericTools['Extracting'][] = array('PakScape', 'https://www.quaddicted.com/files/tools/pakscape-011.zip'); #https://www.fileplanet.com/50620/50000/fileinfo/PakScape
$GenericTools['Mapping'] = array();
$GenericTools['Mapping'][] = array('debsp.zip', $downloadroot.'debsp.zip', 'A tool that can decompile any quake engine map except SOF maps.'); #http://www.fileplanet.com/dl/dl.asp?/planetwolfenstein/tramdesign/debsp.zip #http://downloads.kingpinforever.com/utilities/mapping_tools/debsp.zip
#$GenericTools['Mapping'][] = array('MapConv_100x32.zip', 'https://www.ogier-editor.com/mapconv/MapConv_100x32.zip', 'MapConv is an application built to support the use of newer editors with older Quake engine titles.');
#$GenericTools['Mapping'][] = array('MapConv_105x32.zip', 'https://www.ogier-editor.com/mapconv/MapConv_105x32.zip', 'MapConv is an application built to support the use of newer editors with older Quake engine titles.');
$GenericTools['Mapping'][] = array('MapConv_107x32.zip', 'https://www.ogier-editor.com/mapconv/MapConv_107x32.zip', 'MapConv is an application built to support the use of newer editors with older Quake engine titles.');
$GenericTools["Modeling"] = array();
$GenericTools["Modeling"][] = array("Blender", "https://www.blender.org/", "The free open source 3D content creation suite.");
$GenericTools["Modeling"][] = array("MilkShape 3D", "http://www.milkshape3d.com/", "Create and edit models for games like Quake I, II, III, Half-Life, Unreal Tournament, including full animation."); #http://chumbalum.swissquake.ch/ms3d/index.html
$GenericTools["Modeling"][] = array("NSTv09b3.zip", "https://archive.org/download/ign_20210226/NSTv09b3.zip", "NPherno's skin tool"); #http://www.fileplanet.com/8245/0/fileinfo/NSTv09b3.zip
#$GenericTools["Modeling"][] = array("Seamless3d", "http://www.seamless3d.com/", "Seamless3d is open source 3D modeling software free and available for all under the MIT license."); #We don't share model formats... :(
$GenericTools["Modeling"][] = array("Source Filmmaker", "https://www.sourcefilmmaker.com/");
#$GenericTools["Modeling"][] = array("Crowbar", "https://github.com/ZeqMacaw/Crowbar", "GoldSource and Source Engine Modding Tool");
$GenericTools["Textures"] = array();
$GenericTools["Textures"][] = array("Paint.NET", "https://www.getpaint.net/", "Free Software for Digital Photo Editing");
$GenericTools["Textures"][] = array("GIMP", "https://www.gimp.org/", "The GNU Image Manipulation Program");
$GenericTools["Textures"][] = array("DirectX Texture Editor (Dxtex.exe)", "https://msdn.microsoft.com/en-us/library/bb219744(VS.85).aspx");
$GenericTools["Textures"][] = array("Wally", "http://www.gamefront.com/files/3632507/This_is_wally_version_1_55b"); #http://www.telefragged.com/files/278/beta-version-of-wally-the-best-wadtexture-editing-tool

?>
