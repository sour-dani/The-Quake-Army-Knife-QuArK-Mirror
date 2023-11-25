<?php
require_once('_settings_functions.php');

global $LanguageAutomatic;
$LanguageAutomatic = '(automatic)';

global $NewsItemNumber;
global $NewsItemNumberIndex;
global $PeoplePageSize;
global $UserMapsPageSize;
global $ForumStatsRecentPosts;
global $ForumStatsRecentTopics;
global $ForumStatsRecentEvents;
global $SiteDateFormat;
global $SiteTimeFormat;
global $SiteLanguage;
global $SiteNumberSeparators;
global $SiteByteFormat;
global $VideoPlayer;
$NewsItemNumber = 'newsitemnumber';
$NewsItemNumberIndex = 'newsitemnumberindex';
$PeoplePageSize = 'peoplepagesize';
$UserMapsPageSize = 'usermapspagesize';
$ForumStatsRecentPosts = 'forumstatsrecentposts';
$ForumStatsRecentTopics = 'forumstatsrecenttopics';
$ForumStatsRecentEvents = 'forumstatsrecentevents';
$SiteDateFormat = 'dateformat';
$SiteTimeFormat = 'timeformat';
$SiteLanguage = 'language';
$SiteNumberSeparators = 'numberseparators';
$SiteByteFormat = 'byteformat';
$VideoPlayer = 'videoplayer';

global $Settings;
$Settings = array($NewsItemNumber => new cSetting('newsitemnumber',
                    7, range(1, 10), range(1, 10), range(1, 10),
                    'Select the number of newsposts to display on the news-page:')
                 ,$NewsItemNumberIndex => new cSetting('newsitemnumberindex',
                    3, range(1, 10), range(1, 10), range(1, 10),
                    'Select the number of newsposts to display on the index-page:')
                 ,$PeoplePageSize => new cSetting('peoplepagesize',
                    1, range(0, 3), array(10, 25, 50, 100), array(10, 25, 50, 100),
                    'Select the number of people to display per page:')
                 ,$UserMapsPageSize => new cSetting('usermapspagesize',
                    0, range(0, 3), array(10, 25, 50, 100), array(10, 25, 50, 100),
                    'Select the number of user maps to display per page:')
                 ,$ForumStatsRecentPosts => new cSetting('forumstatsrecentposts',
                    4, range(0, 8), range(0, 8), range(0, 8),
                    'Select the number of recent posts to display in the forum stats panel:')
                 ,$ForumStatsRecentTopics => new cSetting('forumstatsrecenttopics',
                    4, range(0, 8), range(0, 8), range(0, 8),
                    'Select the number of recent topics to display in the forum stats panel:')
                 ,$ForumStatsRecentEvents => new cSetting('forumstatsrecentevents',
                    4, range(0, 7), range(0, 7), range(0, 7),
                    'Select the number of recent events to display in the forum stats panel:')
                 ,$SiteDateFormat => new cSetting('dateformat',
                    0, range(0, 4), array('m/d/Y', 'd/m/Y', 'Y-m-d', 'd M Y', 'd F Y'), array('12/31/2001', '31/12/2001', '2001-12-31', '31 Dec 2001', '31 December 2001'),
                    'Select the format to display dates in:') #From: http://en.wikipedia.org/wiki/Calendar_date
                 ,$SiteTimeFormat => new cSetting('timeformat',
                    0, range(0, 1), array('H:i:s', 'g:i:s A'), array('20:30:00', '8:30:00 PM'),
                    'Select the format to display times in:')
                 ,$SiteLanguage => new cSetting('xlanguage',
                    0, range(0, 0), array($LanguageAutomatic), array('(automatic)'),
                    'Select the language to display the website in:') #Rest will be added in below
                 ,$SiteNumberSeparators => new cSetting('numberseparators',
                    0, range(0, 1), array(array('.', ','), array(',', '.')), array('"." for decimals, "," for thousands', '"," for decimals, "." for thousands'),
                    'Select the kind of separators to use to display numbers with:')
                 ,$SiteByteFormat => new cSetting('byteformat',
                    0, range(0, 5), range(0, 5), array('Auto', 'Bytes', 'Kilobytes', 'Megabytes', 'Gigabytes', 'Terabytes'),
                    'Select the format you want to display numbers of bytes in:')
                 ,$VideoPlayer => new cSetting('videoplayer',
                    0, range(0, 4), range(0, 4), array('Auto', 'Windows Media Player up to 6', 'Windows Media Player 7 or higher', 'QuickTime Player', 'HTML5 video'),
                    'Select the video player you want to use:')
                 );

#Load the values of the settings
foreach ($Settings as $SettingName => $Setting)
{
	if (isset($_COOKIE[$Setting->CookieName]))
	{
		$Setting->Value = intval($_COOKIE[$Setting->CookieName]);
	}
}

?>
