<?php
//Note: SSI.php loads SMF. There could be huge GLOBAL or function conflicts!
require('forums/SSI.php');
require_once('_functions.php');
require_once('_settings-database.php');

global $Settings;
global $ForumStatsRecentPosts, $ForumStatsRecentTopics, $ForumStatsRecentEvents;

$bodytext = '';

$WhosOnline = ssi_whosOnline('');
$RecentPosts = ssi_recentPosts($Settings[$ForumStatsRecentPosts]->GetCurrentValue(), null, null, '');
$RecentTopics = ssi_recentTopics($Settings[$ForumStatsRecentTopics]->GetCurrentValue(), null, null, '');
$RecentEvents = ssi_recentEvents($Settings[$ForumStatsRecentEvents]->GetCurrentValue(), '');
#ssi_recentPoll()
#ssi_latestMember()
#ssi_news()
#ssi_todaysBirthdays()
#ssi_todaysHolidays()
#ssi_todaysEvents()
#ssi_todaysCalendar()

if (!empty($WhosOnline))
{
	$bodytext .= '<p>Number of users online: '.count($WhosOnline['users']).'<br>Number of guests online: '.$WhosOnline['guests'].'</p>';
}

if (count($RecentPosts) !== 0)
{
	$bodytext .= '<p style="margin-bottom: 0px;"><b>Recent posts:</b></p>';
	$bodytext .= '<ul class="nowhitespace">';
	foreach ($RecentPosts as $RecentPost => $CurrentRecentPost)
	{
		$bodytext .= '<li>'.$CurrentRecentPost['link'].'</li>';
	}
	$bodytext .= '</ul>';
}

if (count($RecentTopics) !== 0)
{
	$bodytext .= '<p style="margin-bottom: 0px;"><b>Recent topics:</b></p>';
	$bodytext .= '<ul class="nowhitespace" style="display: inline;">';
	foreach ($RecentTopics as $CurrentRecentTopic)
	{
		$bodytext .= '<li>'.$CurrentRecentTopic['link'].'</li>';
	}
	$bodytext .= '</ul>';
}

if ((!is_null($RecentEvents)) and (count($RecentEvents) !== 0)) #Note: A bug in SMF: this function can return NULL instead of an empty array if this functionality has been disabled.
{
	$bodytext .= '<p style="margin-bottom: 0px;"><b>Recent events:</b></p>';
	$bodytext .= '<ul class="nowhitespace" style="display: inline;">';
	foreach ($RecentEvents as $RecentEvent => $CurrentRecentEvent)
	{
		$bodytext .= '<li>'.$CurrentRecentEvent['link'].'</li>';
	}
	$bodytext .= '</ul>';
}

pageSidePanel('', 'Forum stats...', $bodytext);
?>
