<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_image_functions.php');
require_once('_communication-database.php');

# Load language file
LoadLanguageFile('communication.php');

global $forumsroot;

global $webmasteremail;

$OfficialForum = '<div class="centered"><p class="xlarge">The official forums</p>
<p><b>The</b> place to be for support, questions and other QuArK-business.</p>
<p><a href="'.$forumsroot.'">'.DisplayImage('browse').'&nbsp;Go there right now!</a></p></div>';

$irc = '<b>QuArK real-time chat.</b>
<p>On <a href="irc://irc.gamesnet.net/quark">irc.gamesnet.net</a> a channel named #quark has been created. <span class="xsml">(Thanks to rd.)</span><br>
And on <a href="irc://irc.enterthegame.com/quark">irc.enterthegame.com</a> a channel named #QuArK has been created. <span class="xsml">(Thanks to Skarecrowe.)</span><br>
Even on <a href="irc://irc.quakenet.org/quark">irc.quakenet.org</a> a channel named #QuArK is created. <span class="xsml">(Thanks to Neuro.)</span></p>
<p>However, don\'t expect that the QuArK-team always is on those IRC-channels.
Some of us have Real-Life<sup>(tm)</sup> to attend to. Also, some
pay-per-minute they\'re online, so 24/7-online time is not feasible.
If you need support fast, the forum is the best place to look for it.</p>';

$Webmaster = 'If you have any suggestions or comments about the QuArK website, feel free to contact the webmaster of the QuArK website: <a href='.DisplayEncodedEmail($webmasteremail).'>click here</a>.';

function forumForumPanel($ForumList)
{
	$Table2Rows = array('table2rowA', 'table2rowB');
	$CurrentRow = 0;

	$bodytext = '';
	if (!is_null($ForumList->Description))
	{
		$bodytext .= '<p>'.$ForumList->Description.'</p>';
	}

	$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
	$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>Forums</b></td></tr>';
	for ($Forum = 0; $Forum < count($ForumList->Forums); $Forum++)
	{
		$CurrentForum = &$ForumList->Forums[$Forum];
		$bodytext .= '<tr><td class="text1, '.$Table2Rows[$CurrentRow & 1].'" width="25%" valign=top><b>'.$CurrentForum->Name.'</b></td>';
		$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" width="25%" valign=top><a rel="noopener" target="_blank" href="'.$CurrentForum->Link.'">'.DisplayImage('browse').'&nbsp;View with Web-browser</a></td>';
		if (!is_null($CurrentForum->Description))
		{
			$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" width="50%" valign=top>'.$CurrentForum->Description.'</td></tr>';
		}
		else
		{
			$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" width="50%" valign=top>'.'&nbsp;'.'</td></tr>';
		}
		$CurrentRow++;
	}
	$bodytext .= '</table>';

	return $bodytext;
}

function pageLocalDisplay()
{
	global /*$ForumMain,*/ $ForumOther; # See '_communication-database.php'
	global $MailingLists, $SocialMedia; # See '_communication-database.php'
	global $OfficialForum, $irc, $Webmaster;

	pageName('Forums / Messageboards / IRC');

	echo '<a name="forums"></a>';
	pagePanel('community', "QuArK's Official Forums", '', $OfficialForum);

	//pagePanel('community', 'Unofficial QuArK Forums', '', forumForumPanel($ForumMain));

	#pagePanelFile('community', 'Other map-editing web-based messageboards', '',                'forums_other.html');
	pagePanel('community', 'Other map-editing web-based messageboards', '', forumForumPanel($ForumOther));

	echo '<a name="mailinglist"></a>';
	for ($MailingList = 0; $MailingList < count($MailingLists); $MailingList++)
	{
		$curMailingList = &$MailingLists[$MailingList];
		$bodytext = '<b>'.$curMailingList->Name.'</b><br>';
		$bodytext .= '<div class="centered">';
		$bodytext .= '<a href="'.$curMailingList->Subscribe.'">'.DisplayImage('subscribe').'&nbsp;Subscribe to Mailing-List</a>';
		$bodytext .= '&nbsp;&nbsp;-&nbsp;&nbsp;';
		$bodytext .= '<a href="'.$curMailingList->Unsubscribe.'">'.DisplayImage('unsubscribe').'&nbsp;Unsubscribe from Mailing-List</a>';
		$bodytext .= '&nbsp;&nbsp;-&nbsp;&nbsp;';
		$bodytext .= '<a rel="noopener" target="_blank" href="'.$curMailingList->Link.'">'.DisplayImage('browse').'&nbsp;View with Web-browser</a>';
		$bodytext .= '</div><br>';
		if (!is_null($curMailingList->Description))
		{
			$bodytext .= $curMailingList->Description;
			$bodytext .= '<br>';
		}
		pagePanel('community', $curMailingList->Title, '', $bodytext);
	}

	if (count($SocialMedia) != 0)
	{
		$Table2Rows = array('table2rowA', 'table2rowB');
		$CurrentRow = 0;

		echo '<a name="socialmedia"></a>';
		$bodytext = '<p>QuArK also has a presence on social media! Here\'s a list of known locations:</p>';
		$bodytext .= '<table cellpadding=2 cellspacing=0 width="100%">';
		$bodytext .= '<tr><td class="text1, table2head" colspan=3 align=right><b>Social media</b></td></tr>';
		for ($SocialMedium = 0; $SocialMedium < count($SocialMedia); $SocialMedium++)
		{
			$CurrentSocialMedium = &$SocialMedia[$SocialMedium];
			$bodytext .= '<tr><td class="text1, '.$Table2Rows[$CurrentRow & 1].'" width="25%" valign=top><b>'.$CurrentSocialMedium->Name.'</b></td>';
			$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" width="25%" valign=top><a rel="noopener" target="_blank" href="'.$CurrentSocialMedium->Link.'">'.DisplayImage('browse').'&nbsp;View with Web-browser</a>';
			if (!is_null($CurrentSocialMedium->Description))
			{
				$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" width="50%" valign=top>'.$CurrentSocialMedium->Description.'</td></tr>';
			}
			else
			{
				$bodytext .= '<td class="text1, '.$Table2Rows[$CurrentRow & 1].'" width="50%" valign=top>'.'&nbsp;'.'</td></tr>';
			}
			$CurrentRow++;
		}
		$bodytext .= '</table>';
		pagePanel('community', 'Social media', '', $bodytext);
	}

	echo '<a name="chat"></a>';
	#pagePanelFile('community', 'IRC / Chat',                   '',                             'irc.html');
	pagePanel('community', 'IRC / Chat', '', $irc);

	echo '<a name="webmaster"></a>';
	pagePanel('community', 'Webmaster' ,'', $Webmaster);

	# pagePanelFile('community', "Serpent Lord's Editing Messageboard", 'Moderator: Serpent Lord', 'forums_serpentlord.html');
}

pageDisplay('Forums/Messageboards/IRC', 'pageLocalDisplay');

?>
