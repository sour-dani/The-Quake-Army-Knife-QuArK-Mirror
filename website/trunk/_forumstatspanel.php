<?php
//Note: SSI.php loads SMF. There could be huge GLOBAL or function conflicts!
require('forums/SSI.php');
require_once('_functions.php');
require_once('_settings-database.php');

global $Settings;
global $ForumStatsRecentPosts, $ForumStatsRecentTopics, $ForumStatsRecentEvents;

$forumstats = '';

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
	$forumstats .= '<p>';
	$forumstats .= 'Number of users online: '.count($WhosOnline['users']);
	$forumstats .= '<br>';
	$forumstats .= 'Number of guests online: '.$WhosOnline['guests'];
	$forumstats .= '</p>';
}

if (count($RecentPosts) !== 0)
{
	$forumstats .= '<p style="margin-bottom: 0px;"><b>Recent posts:</b></p>';
	$forumstats .= '<ul class="nowhitespace">';
	foreach ($RecentPosts as $RecentPost => $CurrentRecentPost)
	{
		$forumstats .= '<li>'.$CurrentRecentPost['link'].'</li>';
	}
	$forumstats .= '</ul>';
}

if (count($RecentTopics) !== 0)
{
	$forumstats .= '<p style="margin-bottom: 0px;"><b>Recent topics:</b></p>';
	$forumstats .= '<ul class="nowhitespace" style="display: inline;">';
	foreach ($RecentTopics as $CurrentRecentTopic)
	{
		$forumstats .= '<li>'.$CurrentRecentTopic['link'].'</li>';
	}
	$forumstats .= '</ul>';
}

if (count($RecentEvents) !== 0)
{
	$forumstats .= '<p style="margin-bottom: 0px;"><b>Recent events:</b></p>';
	$forumstats .= '<ul class="nowhitespace" style="display: inline;">';
	foreach ($RecentEvents as $RecentEvent => $CurrentRecentEvent)
	{
		$forumstats .= '<li>'.$CurrentRecentEvent['link'].'</li>';
	}
	$forumstats .= '</ul>';
}

pageSidePanel('', 'Forum stats...', $forumstats);
?>
