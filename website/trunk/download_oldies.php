<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_image_functions.php');

# Load language file
LoadLanguageFile('download_oldies.php');

function DownloadFile($seperator, $filelink, $filename, $description)
{
	$bodytext = '';
	if ($seperator)
	{
		$bodytext .= '<tr><td colspan=3><hr class="smallbreak"></td></tr>';
	}
	$bodytext .= '<tr><td valign=top class="text1" width=100>';
	if (!is_null($filelink))
	{
		$bodytext .= '<a href="'.$filelink.'">';
	}
	else
	{
		$bodytext .= '<a href="http://asp.planetquake.com/dl/dl.asp?quark/'.$filename.'">';
	}
	$bodytext .= $filename.'</a></td>';
	$bodytext .= '<td width=4>&nbsp;</td><td class="text1" width=380 valign=top>'.$description.'</td></tr>';
	return $bodytext;
}

/*
<noscript>
<table align=center cellspacing=0 cellpadding=8 width=500>
	<tr style="background-color: #FF8888;"><td align=center><font size=+2>
		This&nbsp;page&nbsp;uses&nbsp;JavaScript&nbsp;and&nbsp;Style&nbsp;Sheets!</font><br><br>
		<font size=+1>If you use Netscape Navigator 4, Netscape Communicator 4, Internet Explorer 4 or Internet Explorer 5, enable JavaScript and Style sheets!<br><br>
		Have you none of the above browsers, you need to upgrade!<br><br>
		If you still don't get any links, contact the <a href=".DisplayEncodedEmail('decker@planetquake.com',NULL,'-- NOTICE: HTML e-mails will be bounced, so send only in plain-text! /Decker --').">Webmaster</a>
	</font></td></tr>
</table>
</noscript>
*/

#Old links:
#http://asp.planetquake.com/dl/dl.asp?quark/quark407.zip
#http://asp.planetquake.com/dl/dl.asp?quark/qrk3dfx4.zip
#http://asp.planetquake.com/dl/dl.asp?quark/qk37rsrc.zip
#http://asp.planetquake.com/dl/dl.asp?quark/deacc101.zip
#http://asp.planetquake.com/dl/dl.asp?quark/quakepal.zip
#http://asp.planetquake.com/dl/dl.asp?quark/qpaln.zip

function pageLocalDisplay()
{
	pageName('Download Oldies');

	global $downloadroot;

	$bodytext = ' <a name="quark"></a>
<table align=center cellspacing=0 cellpadding=0 width=500>
	<tr class="edge3"><td>
		<table cellspacing=1 cellpadding=0>
			<tr class="head3"><td class="text3" width=498>&nbsp;'.DisplayImage('download').'&nbsp;<b>
Oldies - QuArK
			</b></td></tr>
			<tr class="edge1"><td>
				<table cellpadding=4 cellspacing=0 width="100%">
					<tr class="back1"><td width=4>&nbsp;</td><td class="text1" width=490>
						<table cellspacing=0 cellpadding=0>
'.DownloadFile(FALSE,$downloadroot.'oldies/quark407.zip','quark407.zip','<b>QuArK 4.07.</b><br>This is the previous version of QuArK. It is no longer recommended, as QuArK 5.x is now in its prime, but is provided here nonetheless for completeness. It is possible some may still prefer to use it, or at least give it a look.<br>'.DisplayDate(mktime(0, 0, 0, 1, 5, 1998)).'. <a href="'.$downloadroot.'oldies/quark407.txt">Readme file</a>').'
'.DownloadFile(TRUE,$downloadroot."oldies/qrk3dfx4.zip","qrk3dfx4.zip","Early beta 3DFX viewer module v0.4 for QuArK 4.07.<br>Enables use of a 3DFX card for the 3D viewer in QuArK. <strong>Important:</strong> Please read the file qrk3dfx.txt in the zipfile for install instructions.<br>- Requires QuArK v4.06 or 4.07, and the &quot;opengl32.dll&quot; file from either GLQuake or GLHexen2<br>Updated: ".DisplayDate(mktime(0, 0, 0, 1, 5, 1997)).'. <a href="'.$downloadroot.'oldies/qrk3dfx4.txt">Readme file</a>')."
".DownloadFile(TRUE,"ftp://ftp.microsoft.com/Softlib/MSLFILES/Opengl95.exe","OpenGL95.exe","The Microsoft OpenGL library is required for the OpenGL edit window in QuArK 3.1 and up. You need the package at the left <u>only</u> if you are using the <u>original</u> Win95 release.<br><strong>Win95B (OSR2) and NT4 (with SP3) <u>do not</u> require this package.</strong><br><strong>Caution:</strong> <u>DO NOT</u> install the OpenGL Library into your \"windows\\system\" directory. Put <u>ALL</u> files directly into your QuArK directory. (ie: don't use the subdirectories created by the self-extracting .exe file. Move all of the files from the subdirectories right into your QuArK directory).<br>This is for the &quot;regular&quot; 3D view for those that don't have a 3DFX card.")."
".DownloadFile(TRUE,"ftp://ftp.cdrom.com/pub/idgames2/hexen2/official/unsupported/H2_UTILS.EXE","H2_UTILS.EXE","This is the official utilities for compiling levels in Hexen2. Configure these for QuArK by switching to Hexen2 and setting the proper names in to the configuration menu item.")."
".DownloadFile(TRUE,NULL,'qk37rt.zip',"This is the QuArK DOS runtime module. It is <strong>not</strong> required for QuArK to run. It is simply a DOS version of the QuArK runtimes that will allow DOS users to compile and try QuArK levels in &quot;.qme&quot; format with Quake.")."
".DownloadFile(TRUE,$downloadroot.'oldies/qk37rsrc.zip','qk37rsrc.zip','The source for the QuArK DOS runtime module for those who wish to study it.<br><a href="'.$downloadroot.'oldies/qk37rsrc.txt">Readme file</a>')."
".DownloadFile(TRUE,$downloadroot.'oldies/qmap28rt.zip','qmap28rt.zip',"This is the DOS run-time version of QuakeMap. This program allows you to play with .qme files made with QuakeMap 2.0 to 2.8. Note that any version of the DOS Run-Time will handle most (but not all) files made with newer versions of QuakeMap.<br><a href=\"".$downloadroot."oldies/qmap28rt.txt\">Readme file</a>")."
".DownloadFile(TRUE,$downloadroot.'oldies/qm28rsrc.zip','qm28rsrc.zip','The source for the QuakeMap DOS Run-Time module for those who wish to study it.<br><a href="'.$downloadroot.'oldies/qm28rsrc.txt">Readme file</a>').'
						</table>
					</td><td width=4>&nbsp;</td></tr>
				</table>
			</td></tr>
		</table>
	</td></tr>
</table>

<hr class="bigbreak">

<a name="build-packs"></a>
<table align=center cellspacing=0 cellpadding=0 width=500>
	<tr class="edge3"><td>
		<table cellspacing=1 cellpadding=0>
			<tr class="head3"><td class="text3" width=498>&nbsp;'.DisplayImage('download').'&nbsp;<b>
Oldies - Build-packs
			</b></td></tr>
			<tr class="edge1"><td>
				<table cellpadding=4 cellspacing=0 width="100%">
					<tr class="back1"><td width=4>&nbsp;</td><td class="text1" width=490>
						<table cellspacing=0 cellpadding=0>
'.DownloadFile(FALSE,NULL,'qbsp3wal.zip',"<b>QBSP3WAL.</b><br>A modified version of QBSP for Quake 2 that can read Quake 1 textures. It's a temporary fix made by a QuArK user that lets you use custom textures with Quake 2.<br><b>NOT meant for use with QuArK 5.x!</b><br>Updated: ".DisplayDate(mktime(0, 0, 0, 1, 26, 1998)).". <a href=\"ftp://ftp.gamers.org/pub/games/idgames2/planetquake/quark/qbsp3wal.txt\">Readme file</a>")."
".DownloadFile(TRUE,NULL,'buildq.zip',"This is the compiling utilities for Quake that includes the file qbsp_ar.exe. Instructions on how to configure it are in the readme.txt file in the Zip file. Included along with qbsp_ar is Arghlite and Rvis (see build.zip). Text files for these 2 utilities are included in the Zip file.<br>Added: ".DisplayDate(mktime(0, 0, 0, 12, 8, 1997)).". <a href=\"ftp://ftp.gamers.org/pub/games/idgames2/planetquake/quark/buildq.txt\">Readme file</a>")."
".DownloadFile(TRUE,NULL,'gdd_q2_utils.zip','These are compiling utils for Quake2 by <a href='.DisplayEncodedEmail('gdewan@prairienet.org').">Geoffrey DeWan</a>. I have put them here as a courtesy for QuArK users. Please read the file gdd_q2_utils.txt in the zip file for info on using them with QuArK. If you want to find other compilers for Quake2, check out: <a href=\"ftp://ftp.cdrom.com/pub/idgames2/quake2/utils/level_edit/bsp_builders/\" target=\"_blank\" rel=\"noopener\">ftp:cdrom.com/.../bsp_builders/</a><br>Added: ".DisplayDate(mktime(0, 0, 0, 1, 16, 1998)).".")."
".DownloadFile(TRUE,NULL,'qbsp3_f.zip','This is an alternative QBSP3 for Quake2 by <a href='.DisplayEncodedEmail('gilmont@dice.ucl.ac.be').">Tanguy Gilmont</a>. He has graciously re-compiled id's QBSP3 to accept QuArK's more accurate floating point calculations. If you wish to try this, or tweak it yourself, he has also included the map.c file with it.<br>Added: ".DisplayDate(mktime(0, 0, 0, 1, 16, 1998)).".")."
".DownloadFile(TRUE,NULL,'build.zip','Contains a set of compile utilities for Quake. Included in this file are:<br><ol><li><a href='.DisplayEncodedEmail('KenA@TSO.Cin.IX.Net').">Ken Alverson</a>'s WQBSP 1.65 (qbsp.exe).<li><a href=".DisplayEncodedEmail('argh@ziplink.net').">Tim Wright</a>'s ARGHLITE 2.0<li><a href=".DisplayEncodedEmail('antony@teamfortress.com').">Antony Suter</a>'s RVIS 1.0</ol>Place all 3 of these utilities in the <strong>same</strong> directory and make sure to set the directory and program names in the QuArK configuration menu item.").'
						</table>

					</td><td width=4>&nbsp;</td></tr>
				</table>
			</td></tr>
		</table>
	</td></tr>
</table>

<hr class="bigbreak">

<a name="misc"></a>
<table align=center cellspacing=0 cellpadding=0 width=500>
	<tr class="edge3"><td>
		<table cellspacing=1 cellpadding=0>
			<tr class="head3"><td class="text3" width=498>&nbsp;'.DisplayImage('download').'&nbsp;<b>
Oldies - Miscellaneous
			</b></td></tr>
			<tr class="edge1"><td>
				<table cellpadding=4 cellspacing=0 width="100%">
					<tr class="back1"><td width=4>&nbsp;</td><td class="text1" width=490>

						<table cellspacing=0 cellpadding=0>
'.DownloadFile(FALSE,$downloadroot.'oldies/deacc101.zip','deacc101.zip',"<b>DEACC32.</b><br>A decompiler for Quake and Hexen2 progs.dat files. It is not necessary for QuArK, it is just another utility written by Armin. It may be useful for those of you interested in learning QuakeC though. You'll be able to see how certain things were done. It is <em>only</em> a decompiler though. It will not recompile a progs.dat file.<br><a href=\"".$downloadroot.'oldies/deacc101.txt">Readme file</a>')."
".DownloadFile(TRUE,$downloadroot.'oldies/acc-qc.zip','acc-qc.zip',"<b>DEACC & REACC.</b><br>This is a set of utilities allowing you to decompile and recompile the QuakeC programs included into the game Quake, from Id Software. See how they programmed Quake behaviors.
It is not necessary for QuArK.<br><a href=\"".$downloadroot.'oldies/acc-qc.txt">Readme file</a>')."
							<tr><td colspan=3><hr class=\"smallbreak\"></td></tr>
						</table>

<p>
These 2 files below are for those of you wishing to make/change textures for your Quake levels. The files are in Paintshop Pro .PAL format.<br>
If you don't have Paintshop Pro, it is a shareware paint program from <a href=\"http://www.jasc.com\" target=\"_blank\" rel=\"nofollow noopener\">JASC. Inc.</a>
</p>

						<table cellspacing=0 cellpadding=0>
".DownloadFile(FALSE,$downloadroot.'oldies/quakepal.zip','quakepal.zip',"<b>Quake palette for PSP.</b><br>Includes 2 files. &quot;quake.pal&quot; which is the full Quake palette in PSP format, and &quot;qpal.gif&quot; which is a small GIF image which can be used to import the Quake palette into other paint programs.<br><a href=\"".$downloadroot.'oldies/quakepal.txt">Readme file</a>')."
".DownloadFile(TRUE,$downloadroot.'oldies/qpaln.zip','qpaln.zip','Courtesy of <a href='.DisplayEncodedEmail('dexter@apc.net').">Joe Waters</a>. A PSP palette file which contains <strong>no</strong> &quot;fullbright&quot; colors.<br><a href=\"".$downloadroot.'oldies/qpaln.txt">Readme file</a>').'
						</table>

					</td><td width=4>&nbsp;</td></tr>
				</table>
			</td></tr>
		</table>
	</td></tr>
</table>';

	pagePanel('download', 'Download oldies', '', $bodytext);
}

pageDisplay('Download oldies', 'pageLocalDisplay');

?>
