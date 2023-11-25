<?php
require_once('_panels_functions.php');

global $DonatePanel;
global $ThemePanel;
global $DownloadPanel;
global $PoweredByPanel;
global $TimePanel;
global $ValidHTMLPanel;
global $NoticePanel;
global $InstaPollPanel;
global $ForumStatsPanel;
global $UsefulPanel;
global $InterestPanel;
$DonatePanel = 'donatepanel';
$ThemePanel = 'themepanel';
$DownloadPanel = 'downloadpanel';
$PoweredByPanel = 'poweredbypanel';
$TimePanel = 'timepanel';
$ValidHTMLPanel = 'validhtmlpanel';
$NoticePanel = 'noticepanel';
$InstaPollPanel = 'instapollpanel';
$ForumStatsPanel = 'forumstatspanel';
$UsefulPanel = 'usefulpanel';
$InterestPanel = 'interestpanel';

global $Panels;
$Panels = array($DonatePanel => new cPanel('donatepanel', 'Donate panel', '_donatebutton.php', 'show')
               ,$ThemePanel => new cPanel('themepanel', 'Theme panel', '_themepanel.php', 'show')
               ,$DownloadPanel => new cPanel('downloadpanel', 'Download panel', '_downloadbutton.php', 'show')
               ,$PoweredByPanel => new cPanel('poweredbypanel', 'Powered by panel', '_poweredbypanel.php', 'show')
               ,$TimePanel => new cPanel('timepanel', 'Server Time panel', '_servertime.php', 'hidden')
               ,$ValidHTMLPanel => new cPanel('validhtmlpanel', 'Valid HTML panel', '_validhtml.php', 'show')
               ,$NoticePanel => new cPanel('noticepanel', 'Notice panel', '_notice.php', 'show')
               ,$InstaPollPanel => new cPanel('instapollpanel', 'Instapoll panel', '_instapoll.php', 'show')
               ,$ForumStatsPanel => new cPanel('forumstatspanel', 'Forum stats panel', '_forumstatspanel.php', 'show')
               ,$UsefulPanel => new cPanel('usefulpanel', 'Useful links panel', '_useful.php', 'show')
               ,$InterestPanel => new cPanel('interestpanel', 'Sites of Interest panel', '_interest.php', 'show'));
?>
