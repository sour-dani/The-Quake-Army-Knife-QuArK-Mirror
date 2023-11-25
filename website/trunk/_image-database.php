<?php
require_once('_main_paths.php');
require_once('_image_functions.php');
#require_once('_theme_functions.php');

global $picsroot;

global $imgs;
$imgs = array('quarkiconlarge' => new cImage($picsroot.'icons/quarkiconlarge.gif', 'QuArK icon', '64', '64')
             ,'quarkforums'    => new cImage($picsroot.'quarkforums.png', 'QuArK Forums', '120', '285')
             ,'php'            => new cImage($picsroot.'smlbanners/php-power-white.png', 'Powered by PHP', '88', '31')
             ,'mysql'          => new cImage($picsroot.'smlbanners/powered-by-mysql-88x31.png', 'Powered by MySQL', '88', '31')
             ,'supportus'      => new cImage($picsroot.'project-support.jpg', 'Support this project', '88', '32')
             ,'downloadnow'    => new cImage($picsroot.'download_button.gif', 'Download button', '88', '32')
             ,'idlogo'         => new cImage($picsroot.'company/idlogo.gif', 'id logo', '50', '50')

             ,'quark'     => new cImage($picsroot.'icons/quark.gif', 'quark', '16', '16', 'class="icon"')
             ,'worldspawn'=> new cImage($picsroot.'icons/worldspawn.gif', 'worldspawn', '16', '16', 'class="icon"')
             ,'news'      => new cImage($picsroot.'icons/news.gif', 'news', '16', '16', 'class="icon"')
             ,'community' => new cImage($picsroot.'icons/community.gif', 'community', '16', '16', 'class="icon"')
             ,'download'  => new cImage($picsroot.'icons/download.gif', 'download', '16', '16', 'class="icon"')
             ,'beta'      => new cImage($picsroot.'icons/beta.gif', 'beta', '16', '16', 'class="icon"')
             ,'documents' => new cImage($picsroot.'icons/documents.gif', 'documents', '16', '16', 'class="icon"')
             ,'config'    => new cImage($picsroot.'icons/config.gif', 'config', '16', '16', 'class="icon"')
             ,'features'  => new cImage($picsroot.'icons/features.gif', 'features', '16', '16', 'class="icon"')
             ,'globe'     => new cImage($picsroot.'icons/globe.gif', 'globe', '16', '16', 'class="icon"')
             ,'movies'    => new cImage($picsroot.'icons/movies.gif', 'movies', '16', '16', 'class="icon"')
             ,'stats'     => new cImage($picsroot.'icons/stats.gif', 'stats', '16', '16', 'class="icon"')
             ,'award'     => new cImage($picsroot.'icons/award.gif', 'award', '16', '16', 'class="icon"')

             ,'downright' => new cImage($picsroot.'downright.gif', 'downright', '12', '16', 'style="padding-left: 4px;"')
             ,'down'      => new cImage($picsroot.'down.gif', 'down', '12', '16', 'style="padding-left: 4px;"')
             ,'right'     => new cImage($picsroot.'right.gif', 'right', '12', '16', 'style="padding-left: 4px;"')
             ,'none'      => new cImage($picsroot.'none.gif', 'none', '12', '16', 'style="padding-left: 4px;"')

             ,'instapoll' => new cImage($picsroot.'instapoll.gif', '', '0', '5') #Note: Alt override in code.

             ,'smiley_happy'  => new cImage($picsroot.'SmileyHappy.gif', 'happy smiley', '15', '15', 'class="smiley"')
             ,'smiley_medium' => new cImage($picsroot.'SmileyMedium.gif', 'medium smiley', '15', '15', 'class="smiley"')
             ,'smiley_sad'    => new cImage($picsroot.'SmileySad.gif', 'sad smiley', '15', '15', 'class="smiley"')

             ,'star'       => new cImage($picsroot.'icons/star.gif', 'star', '16', '16', 'class="icon"')
             ,'thumbup'    => new cImage($picsroot.'icons/thumbup.gif', 'thumb up', '16', '16', 'class="icon"')

             ,'download_arrow' => new cImage($picsroot.'download_arrow.png', 'Download now!', '64', '64', "style=\"vertical-align: middle;\"")

             ,'alert'  => new cImage($picsroot.'icons/alert.gif', 'alert', '15', '15', 'class="icon"')
             ,'browse' => new cImage($picsroot.'icons/view_with_browser.gif', 'Browse', '16', '16', 'class="icon"')
             ,'cd'     => new cImage($picsroot.'icons/cd.png', 'cd', '15', '15', 'class="icon"')

             ,'subscribe'   => new cImage($picsroot.'icons/mailinglist_subscribe.gif', 'Subscribe' ,'16', '16', 'class="icon"')
             ,'unsubscribe' => new cImage($picsroot.'icons/mailinglist_unsubscribe.gif', 'Unsubscribe' ,'16', '16', 'class="icon"')

             ,'validhtml' => new cImage('http://www.w3.org/Icons/valid-html401', 'Valid HTML 4.01 Transitional', '88', '31')
             ,'validcss' => new cImage('http://jigsaw.w3.org/css-validator/images/vcss', 'Valid CSS!', '88', '31')
             );

function imgsProgressBar($Progress)
{
	global $picsroot;

	$Progress = 5 * floor(20 * $Progress);

	return '<img width="100%" height="64" src="'.$picsroot.'donate/ProgressBar'.$Progress.'.jpg" alt="'.$Progress.'%">';
}

?>
