<?php
require_once('_main_paths.php');

class cPatch
{
	var $VersionID;    # For which version of the program is this patch?
	var $Description;  # Description of the patch
	var $DownloadURL;  # Download-link
	var $ReleaseDate;  # Release date of this patch
	var $AlwaysHidden; # Are people allowed to see (and thus download) this patch?

	function __construct($aVersionID, $aDescription=null, $aDownloadURL=null, $aReleaseDate=0, $aAlwaysHidden=False)
	{
		$this->VersionID    = $aVersionID;
		$this->Description  = $aDescription;
		$this->DownloadURL  = $aDownloadURL;
		$this->ReleaseDate  = $aReleaseDate;
		$this->AlwaysHidden = $aAlwaysHidden;
	}
}

global $downloadroot;

global $Patches;
$Patches = array();
$Patches[] = new cPatch('361'
                       ,'Fixes a bug in 3.61 that was introduced when putting in the new logo. It is a fairly minor bug that made the windows in the QuArK Explorer unable to function.<br>This is a bugfix release for 3.61. If you have downloaded and installed "quark361.zip", please get the patched "quark.exe" in the qk361exe.zip file. This is a replacement for the 3.61 quark.exe. The zipfile qrk361p.zip contains the full package with the fixed quark.exe.'
                       ,array('http://www.cdrom.com/pub/idgames2/planetquake/quark/qk361exe.zip')
                       ,mktime(0, 0, 0, 7, 18, 1997)
                       ,False);
$Patches[] = new cPatch('58'
                       ,'Fixes :<br>* rectangle dragging with the mouse to select polyhedron: crashed<br>* Half-Life maps running: crashed<br><br>And minor stuff (invalid texture names in Half-Life maps were not signaled).'
                       ,array($downloadroot.'oldies/quark58p.zip')
                       ,mktime(0, 0, 0, 11, 30, 1999)
                       ,False);
$Patches[] = new cPatch('510'
                       ,'A fix for Half-Life, Counterstrike and Team Fortress Classic support.'
                       ,array($downloadroot.'oldies/QuArK510-QuakeContext-Fix.zip')
                       ,mktime(0, 0, 0, 11, 30, 1999)
                       ,False);
$Patches[] = new cPatch('61c'
                       ,'This patch is supposed to be a \'cumulative update\' to QuArK 6.1, comprising stable improvements to QuArK.'
                       ,array('https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.1/quark61c_patch_16_01_01.zip')
                       ,mktime(0, 0, 0, 1, 16, 2001)
                       ,False);
$Patches[] = new cPatch('630'
                       ,'Update 1 for QuArK 6.3.0.'
                       ,array('https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.3/QuArK_v630_update1.ZIP')
                       ,mktime(0, 0, 0, 2, 4, 2003)
                       ,True);
/*$Patches[] = new cPatch('630'
                       ,'QuArK 6.3.0 update 2'
                       ,array('https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.3/QuArK_v630_update2.ZIP')
                       ,mktime(0, 0, 0, 2, 4, 2003)@@
                       ,True);*/
/*$Patches[] = new cPatch('630'
                       ,'This update provides some new plugins, and improved versions of others.'
                       ,array('https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.3/QuArK_v630_update3.ZIP')
                       ,mktime(0, 0, 0, 3, 28, 2003)
                       ,True);*/
$Patches[] = new cPatch('630'
                       ,'Bug-fixed version of Update 3 for QuArK 6.3.0.'
                       ,array('https://sourceforge.net/projects/quark/files/QuArK/QuArK%206.3/QuArK_v630_update3b.ZIP')
                       ,mktime(0, 0, 0, 4, 4, 2003)
                       ,False);
$Patches[] = new cPatch('650b4'
                       ,'Anybody that has trouble exporting HL2/CSS maps or opening RTCW maps with <b>QuArK 6.5.0 Beta 4</b> should try the fixed executable posted here.'
                       ,array($downloadroot.'release_zips/QuArK-6.5.0Beta4-FixedHL2AndRTCWMaps.zip')
                       ,mktime(0, 0, 0, 6, 7, 2008)
                       ,False);
$Patches[] = new cPatch('660b2'
                       ,'Anybody that has trouble importing and/or exporting MOHAA maps with <b>QuArK 6.6.0 Beta 2</b> should try the fixed executable posted here.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta2-FixedMOHAAMaps.zip')
                       ,mktime(0, 0, 0, 3, 19, 2009)
                       ,False);
$Patches[] = new cPatch('660b2'
                       ,'For those of you who are trying to run QuArK on Wine, and are running into trouble trying to start the map editor (an error message like "AttributeError: \'module\' object has no attribute \'mapsearch\'" will be displayed), a patch for it is posted here.'
                       ,array($downloadroot."release_zips/QuArK-6.6.0Beta2-PluginPatch.zip")
                       ,mktime(0, 0, 0, 9, 26, 2009)
                       ,False);
$Patches[] = new cPatch('660b3'
                       ,'A nightly build that tries to fix all of the Steam issues. More information about it is: <a target="_blank" href="'.$forumsroot.'index.php?topic=420.msg2386#msg2386">here</a>.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta4-Nightly-09Feb2010.zip')
                       ,mktime(0, 0, 0, 2, 9, 2010)
                       ,True);
$Patches[] = new cPatch('660b3'
                       ,'A nightly build that tries to fix all of the Steam issues. More information about it is: <a target="_blank" href="'.$forumsroot.'index.php?topic=420.msg2386#msg2386">here</a>.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta4-Nightly-09Feb2010.zip')
                       ,mktime(0, 0, 0, 2, 9, 2010)
                       ,True);
$Patches[] = new cPatch('660b3'
                       ,'A nightly build that tries to fix all of the Steam issues. More information about it is: <a target="_blank" href="'.$forumsroot.'index.php?topic=420.msg2400#msg2400">here</a>.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta4-Nightly-17Feb2010.zip')
                       ,mktime(0, 0, 0, 2, 17, 2010)
                       ,True);
$Patches[] = new cPatch('660b3'
                       ,'A nightly build that tries to fix a lot of the Steam issues. More information about it is: <a target="_blank" href="'.$forumsroot.'index.php?topic=420.msg2408#msg2408">here</a>.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta4-Nightly-22Feb2010.zip')
                       ,mktime(0, 0, 0, 2, 22, 2010)
                       ,True);
$Patches[] = new cPatch('660b3'
                       ,'A build with additional DevIL library logging. More information about it is: <a target="_blank" href="'.$forumsroot.'index.php?topic=431.msg2443#msg2443">here</a>.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta4-ExtraLogging(source)-8Mar2010.zip')
                       ,mktime(0, 0, 0, 3, 8, 2010)
                       ,True);
$Patches[] = new cPatch('660b4'
                       ,'Due to a bug in one of the Python files, the buttons next to the compass can go missing in the map editor. A fix is posted <a target="_blank" href="'.$forumsroot.'index.php?topic=784.msg3908#msg3908">here</a>.'
                       ,array($forumsroot.'index.php?topic=784.msg3908#msg3908')
                       ,mktime(0, 0, 0, 6, 29, 2011)
                       ,False);
$Patches[] = new cPatch('660b5'
                       ,'Some of the map exporting options were broken several versions ago, including the option to disable floating-point coordinates. This patch fixes those options; especially Q1 mappers should try this if they are having trouble with small gaps between poly\'s being introduced by the compiler.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta5-FixedMapOptions.zip')
                       ,mktime(0, 0, 0, 6, 8, 2012)
                       ,False);
$Patches[] = new cPatch('660b5'
                       ,'This patch introduces a fix for the SOF1 build tools (vis and arghrad), because they can\'t handle the proper slashes in filenames, and thus claim they can\'t find the bsp-file.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta5-SOF1ToolsFix.zip')
                       ,mktime(0, 0, 0, 10, 7, 2012)
                       ,False);
$Patches[] = new cPatch('660b5'
                       ,'This patch fixes a bug where empty textures in HL1 bsp-files weren\'t saved properly, causing the bsp-file to fail to work.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta5-HL1BSPMipTexFix.zip')
                       ,mktime(0, 0, 0, 10, 7, 2012)
                       ,False);
$Patches[] = new cPatch('660b6'
                       ,'This patch fixes a longstanding issue where QuArK doesn\'t work properly on Chinese Windows\'s, and doesn\'t run properly under Wine. More information about it is: <a target="_blank" href="'.$forumsroot.'index.php?topic=1017">here</a>.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta6-SpecificsFix.zip')
                       ,mktime(0, 0, 0, 3, 6, 2014)
                       ,False);
$Patches[] = new cPatch('660b6'
                       ,'This patch fixes a bug where the Texture Positioning Tool makes the panels of the treeview disappear. More information about it is: <a target="_blank" href="'.$forumsroot.'index.php?topic=1074.msg5783#msg5783">here</a>.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta6-TexturePosTreeviewFix.zip')
                       ,mktime(0, 0, 0, 6, 21, 2015)
                       ,False);
$Patches[] = new cPatch('660b6'
                       ,'This patch fixes two instances of circular imports in the Model Editor, causing crashes when running QuArK in Wine.'
                       ,array($downloadroot.'release_zips/QuArK-6.6.0Beta6-CircularImportFix.zip')
                       ,mktime(0, 0, 0, 5, 17, 2016)
                       ,False);

?>
