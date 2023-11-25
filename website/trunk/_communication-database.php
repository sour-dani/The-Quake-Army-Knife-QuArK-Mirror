<?php

class cForumList
{
	var $Description; # Description of the forums
	var $Forums;      # Array of the forums

	function __construct($aDescription, $aForums)
	{
		$this->Description = $aDescription;
		$this->Forums      = $aForums;
	}
}

class cForum
{
	var $Name;        # Name of the forum
	var $Link;        # Link to the forum
	var $Description; # Description of the forum

	function __construct($aName, $aLink, $aDescription=NULL)
	{
		$this->Name        = $aName;
		$this->Link        = $aLink;
		$this->Description = $aDescription;
	}
}

class cMailingList
{
	var $Name;        # Name of the mailinglist
	var $Title;       # Shortened name
	var $Subscribe;   # Link to subscribe
	var $Unsubscribe; # Link to unsubscribe
	var $Link;        # Link to the mailinglist
	var $Description; # Description of the mailinglist

	function __construct($aName, $aTitle, $aSubscribe, $aUnsubscribe, $aLink, $aDescription=NULL)
	{
		$this->Name        = $aName;
		$this->Title       = $aTitle;
		$this->Subscribe   = $aSubscribe;
		$this->Unsubscribe = $aUnsubscribe;
		$this->Link        = $aLink;
		$this->Description = $aDescription;
	}
}

class cSocialMedia
{
	var $Name;        # Name
	var $Title;       # Shortened name
	var $Link;        # Link to the mailinglist
	var $Description; # Description of the mailinglist

	function __construct($aName, $aTitle, $aLink, $aDescription=NULL)
	{
		$this->Name        = $aName;
		$this->Title       = $aTitle;
		$this->Link        = $aLink;
		$this->Description = $aDescription;
	}
}

/*global $ForumMain;
$ForumMain = new cForumList('Here is a list of unofficial <b>QuArK</b> forums:' ,array());

#                                   Name of the forum-section
#                                   |        Link to the forum-section
#                                   |        |       Description of the forum-section
#                                   |        |       |
$ForumMain->Forums[] = new cForum('RUST/GameDesign\'s QuArK Messageboard' ,'http://forums.gamedesign.net/viewforum.php?f=32' ,'The QuArK section on the RUST/GameDesign forum.');*/

global $ForumOther;
$ForumOther = new cForumList('Here is a list of forums about game editing in general:' ,array());

#                                    Name of the forum-section
#                                    |        Link to the forum-section
#                                    |        |       Description of the forum-section
#                                    |        |       |
#$ForumOther->Forums[] = new cForum('RUST/GameDesign's Messageboard' ,'http://forums.gamedesign.net' ,'Contains forums for different FPS-games, and specific map-editors like QuArK, QeRadiant, WorldCraft, QOOLE and more.');
#$ForumOther->Forums[] = new cForum('Map-Center Forum' ,'http://www.map-center.com/forums/index.php' ,NULL);
#$ForumOther->Forums[] = new cForum('LevelMakers Forum' ,'http://www.levelmakers.com/community/index.php' ,'Contains forums for just about every major FPS-game.');
$ForumOther->Forums[] = new cForum('Quake3World.com Forum - Level Editing &amp; Modeling' ,'https://www.quake3world.com/forum/viewforum.php?f=10' ,'Discussion for Level Designers and 3D modelers alike! Talk about the creation of entire maps, or just map objects!');
#$ForumOther->Forums[] = new cForum('Doom3World.org Forum' ,'http://www.doom3world.org/phpbb2/index.php' ,'The world is yours! Doom 3 - Quake 4 - ET:QW - Prey - Rage');
$ForumOther->Forums[] = new cForum('Doomworld Forums' ,'https://www.doomworld.com/vb/' , NULL);
#$ForumOther->Forums[] = new cForum('Halflife2.net Forums > Source Editing & Development > Custom Mapping' ,'http://www.halflife2.net/forums/forumdisplay.php?f=11' ,NULL);
#$ForumOther->Forums[] = new cForum('General Editing - Halflife2.net Forums' ,'http://www.halflife2.net/forums/forumdisplay.php?f=10' ,'Anything related to Half-Life 2 editing.');
$ForumOther->Forums[] = new cForum('D-Day: Normandy Forums' ,'http://www.ddaydev.com/forum/' ,NULL);
$ForumOther->Forums[] = new cForum('Genesis3D Forums' ,'http://www.genesis3d.com/forum/' ,NULL);
#$ForumOther->Forums[] = new cForum('VERC Collective forums' ,'http://collective.valve-erc.com/index.php?area=forums' ,'These forums mainly consist of material regarding the FPS-game Half-Life and its many modifications.');
#$ForumOther->Forums[] = new cForum('Serpent Lord's discussion forum' ,'http://pluto.beseen.com/boardroom/l/18993' ,'"<i>A good place to discuss just about anything, but especially modeling questions, begging for free stuff and that sort of thing... ;)</i>" - Serpent Lord.');
$ForumOther->Forums[] = new cForum('Q3Map2 Support Forum' ,'https://forums.splashdamage.com/c/q3map2-support' ,'The official support forum for the Q3Map2 compile tool.'); //http://www.splashdamage.com/forums/forumdisplay.php?f=7
$ForumOther->Forums[] = new cForum('Func_Msgboard: Forum' ,'https://celephais.net/board/forum.php' ,'We are a community of hobbyist and professional level designers who share insights, opinions, rants, and flames. While most of us focus on Quake and Quake III Arena, we also have members who map for Doom 3, Half-Life 2, Quake 2, Cube, and more. Our community had previously gravitated around the late QMap message board, but when that died, I built this replacement.');
$ForumOther->Forums[] = new cForum('Quake Mapping', 'https://discordapp.com/invite/j5xh8QT'); //FIXME: Discord server section?
$ForumOther->Forums[] = new cForum('QuakeWorld Team Fortress', 'http://discord.megateamfortress.com/' ,'Quake 1 only Discord server.'); //FIXME: Discord server section?

# ---

global $MailingLists;
$MailingLists = array();
/*$MailingLists[] = new cMailingList('The Main QuArK map-editing discussion forum.', 'Main QuArK map-editing forum', 'mailto:quark-subscribe@yahoogroups.com', 'mailto:quark-unsubscribe@yahoogroups.com', 'https://groups.yahoo.com/neo/groups/quark', 'This was the main QuArK discussion forum run through <a rel="noopener" target="_blank" href="https://groups.yahoo.com/neo/groups/quark">YahooGroups</a> <span class="sml">(previously known as eGroups)</span>.
This is a discussion group as well as a mailing list archive. Also, for people who want new messages e-mailed to them, this system can\'t be beat (just sign-up for the mailing list). If you just want to drop by and post, feel free to do that also.<br>
<br>
When you have problems/questions for a specific game and game-engine, please state that in your message or subject-line.
The following abbreviations are commonly used:<br>
<br>

<table width="100%">
<tr>
  <td class="text1"><u>Quake 1 engine</u></td>
  <td class="text1"><u>Quake 2 engine</u></td>
  <td class="text1"><u>Quake 3 engine</u></td>
  <td class="text1"><u>Doom 3 engine</u></td>
  <td class="text1"><u>Misc. engines</u></td>
<tr>
  <td valign=top>
    <table>
      <tr><td class="text1"><b>Q1 </b></td><td class="text1">Quake 1  </td></tr>
      <tr><td class="text1"><b>Hx2</b></td><td class="text1">Hexen 2  </td></tr>
      <tr><td class="text1"><b>HL </b></td><td class="text1">Half-Life</td></tr>
    </table>
  </td>
  <td valign=top>
    <table>
      <tr><td class="text1"><b>Q2   </b></td><td class="text1">Quake 2           </td></tr>
      <tr><td class="text1"><b>Hr2  </b></td><td class="text1">Heretic 2         </td></tr>
      <tr><td class="text1"><b>KP   </b></td><td class="text1">Kingpin           </td></tr>
      <tr><td class="text1"><b>SIN  </b></td><td class="text1">Sin               </td></tr>
      <tr><td class="text1"><b>SOF  </b></td><td class="text1">Soldier of Fortune</td></tr>
      <tr><td class="text1"><b>DK   </b></td><td class="text1">Daikatana         </td></tr>
    </table>
  </td>
  <td valign=top>
    <table>
      <tr><td class="text1"><b>Q3   </b></td><td class="text1">Quake 3: Arena                    </td></tr>
      <tr><td class="text1"><b>FAKK2</b></td><td class="text1">Heavy Metal: F.A.K.K.2            </td></tr>
      <tr><td class="text1"><b>STVEF</b></td><td class="text1">Star Trek: Voyager-Elite Force    </td></tr>
      <tr><td class="text1"><b>RTCW </b></td><td class="text1">Return to Castle Wolfenstein      </td></tr>
      <tr><td class="text1"><b>MOHAA</b></td><td class="text1">Medal of Honor: Allied Assault    </td></tr>
      <tr><td class="text1"><b>JK2  </b></td><td class="text1">Jedi Knight 2: Jedi Outcast       </td></tr>
      <tr><td class="text1"><b>SOF2 </b></td><td class="text1">Soldier of Fortune 2: Double Helix</td></tr>
    </table>
  </td>
  <td valign=top>
    <table>
      <tr><td class="text1"><b>D3   </b></td><td class="text1">Doom 3 </td></tr>
      <tr><td class="text1"><b>PREY </b></td><td class="text1">Prey   </td></tr>
      <tr><td class="text1"><b>Q4   </b></td><td class="text1">Quake 4</td></tr>
    </table>
  </td>
  <td valign=top>
    <table>
      <tr><td class="text1"><b>CrSp</b></td><td class="text1"><a href="http://www.crystalspace3d.org/">Crystal Space</a></td></tr>
      <tr><td class="text1"><b>6DX </b></td><td class="text1"><a href="http://sourceforge.net/projects/aztica">6DX</a></td></tr>
      <tr><td class="text1"><b>T   </b></td><td class="text1"><a href="http://www.garagegames.com/">Torque</a></td></tr>
    </table>
  </td>
</tr>
</table>

<!--
<table align=center>
  <tr><td class="text1"><b>Q1</b>          </td><td class="text1">Quake 1                        </td></tr>
  <tr><td class="text1"><b>Q2</b>          </td><td class="text1">Quake 2                        </td></tr>
  <tr><td class="text1"><b>Q3</b>          </td><td class="text1">Quake 3:Arena                  </td></tr>
  <tr><td class="text1"><b>HL</b>          </td><td class="text1">Half-Life                      </td></tr>
  <tr><td class="text1"><b>HR2</b>         </td><td class="text1">Heretic 2                      </td></tr>
  <tr><td class="text1"><b>HX2</b>         </td><td class="text1">Hexen 2                        </td></tr>
  <tr><td class="text1"><b>KP</b>          </td><td class="text1">Kingpin                        </td></tr>
  <tr><td class="text1"><b>SIN</b>         </td><td class="text1">Sin                            </td></tr>
  <tr><td class="text1"><b>SOF</b>         </td><td class="text1">Soldier of Fortune             </td></tr>
  <tr><td class="text1"><b>STVEF</b>       </td><td class="text1">Star Trek:Voyager - Elite Force</td></tr>
  <tr><td class="text1"><b>RTCW</b>        </td><td class="text1">Return To Castle Wolfenstein   </td></tr>
  <tr><td class="text1"><b>MOHAA</b>       </td><td class="text1">Medal of Honor:Allied Assault  </td></tr>
  <tr><td class="text1"><b>CrSp</b>        </td><td class="text1">Crystal Space                  </td></tr>
</table>
-->
<br>

This way, everyone knows just a little more about your problem/question. <span class="xsml">(Thanks to dolomite)</span>');*/ #http://games.groups.yahoo.com/group/quark/
//$MailingLists[] = new cMailingList('Discussion group for writing plug-ins for QuArK / Python.', 'Coding plug-ins for QuArK using Delphi and Python', 'mailto:quark-python-subscribe@yahoogroups.com', 'mailto:quark-python-unsubscribe@yahoogroups.com', 'https://groups.yahoo.com/neo/groups/quark-python', 'The purpose of this mailing list is to let us speak about technical issues about QuArK (mainly, Python) without flooding users of the Main QuArK forum with our discussion. You can sign-up for this as a mailing list as well.'); #http://tech.groups.yahoo.com/group/quark-python/
//$MailingLists[] = new cMailingList('The Latest News from Armin about QuArK', 'QuArK News Wire', 'mailto:quark-news-subscribe@yahoogroups.com', 'mailto:quark-news-unsubscribe@yahoogroups.com', 'https://groups.yahoo.com/neo/groups/quark-news', 'This is a news-area where the development-team posts about new releases and developments in QuArK. You can sign-up to have these announcements mailed to you.'); #http://games.groups.yahoo.com/group/quark-news/
#pagePanelFile('community', 'Main QuArK map-editing forum', 'Moderator: Daniel Stolz', 'forums_quark.html');
#pagePanelFile('community', 'Coding plug-ins for QuArK using Delphi and Python', 'Moderators: Decker, Tiglari',  'forums_quarkpython.html');
#pagePanelFile('community', 'QuArK News Wire', 'Writer: The development team', 'forums_quarknews.html');

global $SocialMedia;
$SocialMedia = array();
$SocialMedia[] = new cSocialMedia('Quake Army Knife - Software | Facebook', 'Unofficial Facebook page', 'https://www.facebook.com/pages/Quake-Army-Knife/108052489222594');

?>
