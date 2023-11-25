<?php
require_once('_language_functions.php');

$LanguageEnglish = 'English';
$LanguageDutch = 'Dutch';

global $LanguageDefault;
$LanguageDefault = $LanguageEnglish;

# Do NOT change the order of languages! This will mess up the user selected setting!
global $Languages;
$Languages = array();
$Languages[$LanguageEnglish] = new cLanguage($LanguageEnglish, 'English', 'en', 'english.php', NULL, NULL);
$Languages[$LanguageDutch] = new cLanguage($LanguageDutch, 'Nederlands (gedeeltelijk)', 'nl', 'dutch.php', $LanguageEnglish, NULL);

$Languages[$LanguageEnglish]->Files = array(
    'adbanners.php' => 'english_archivednews.php'
   ,'adbuttons.php' => 'english_archivednews.php'
   ,'archivednews.php' => 'english_archivednews.php'
   ,'awards.php' => 'english_awards.php'
   ,'choosevideoplayer.php' => 'english_news.php' #!
   ,'communication.php' => 'english_communication.php'
   ,'companies.php' => 'english_companies.php'
   ,'credits.php' => 'english_credits.php'
   ,'donate.php' => 'english_donate.php'
   ,'download.php' => 'english_download.php'
   ,'download_addons.php' => 'english_download_addons.php'
   ,'download_gamepaks.php' => 'english_download_gamepaks.php'
   ,'download_gamepatches.php' => 'english_news.php' #!
   ,'download_oldies.php' => 'english_news.php' #!
   ,'download_other.php' => 'english_download_other.php'
   ,'download_tools.php' => 'english_download_tools.php'
   ,'engines.php' => 'english_engines.php'
   ,'features.php' => 'english_features.php'
   ,'games.php' => 'english_games.php'
   ,'index.php' => 'english_index.php'
   ,'instapolls.php' => 'english_instapolls.php'
   ,'interview.php' => 'english_news.php' #!
   ,'layout.php' => 'english_layout.php'
   ,'links.php' => 'english_links.php'
   ,'moved.php' => 'english_moved.php'
   ,'news.php' => 'english_news.php'
   ,'newsarticle.php' => 'english_news.php' #!
   ,'people.php' => 'english_news.php' #!
   ,'person.php' => 'english_news.php' #!
   ,'quark7.php' => 'english_news.php' #!
   ,'showvideo.php' => 'english_news.php' #!
   ,'stats.php' => 'english_news.php' #!
   ,'suggestedplugins.php' => 'english_news.php' #!
   ,'testimonials.php' => 'english_news.php' #!
   ,'tutorials.php' => 'english_news.php' #!
   ,'usermaps.php' => 'english_news.php' #!
   ,'usermaps_submit.php' => 'english_news.php' #!
   ,'userprefabs.php' => 'english_news.php' #!
   ,'videos.php' => 'english_videos.php'
);
$Languages[$LanguageDutch]->Files = array(
    'adbanners.php' => 'dutch_news.php' #!
   ,'adbuttons.php' => 'dutch_news.php' #!
   ,'archivednews.php' => 'dutch_news.php' #!
   ,'awards.php' => 'dutch_awards.php'
   ,'choosevideoplayer.php' => 'dutch_news.php' #!
   ,'communication.php' => 'dutch_news.php' #!
   ,'companies.php' => 'dutch_news.php' #!
   ,'credits.php' => 'dutch_credits.php'
   ,'donate.php' => 'dutch_news.php' #!
   ,'download.php' => 'dutch_news.php' #!
   ,'download_addons.php' => 'dutch_news.php' #!
   ,'download_gamepaks.php' => 'dutch_news.php' #!
   ,'download_gamepatches.php' => 'dutch_news.php' #!
   ,'download_oldies.php' => 'english_news.php' #!
   ,'download_other.php' => 'dutch_news.php' #!
   ,'download_tools.php' => 'dutch_news.php' #!
   ,'engines.php' => 'dutch_news.php' #!
   ,'features.php' => 'dutch_news.php' #!
   ,'games.php' => 'dutch_news.php' #!
   ,'index.php' => 'dutch_index.php'
   ,'instapolls.php' => 'dutch_news.php' #!
   ,'interview.php' => 'dutch_news.php' #!
   ,'layout.php' => 'dutch_layout.php'
   ,'links.php' => 'dutch_news.php' #!
   ,'moved.php' => 'dutch_news.php' #!
   ,'news.php' => 'dutch_news.php'
   ,'newsarticle.php' => 'dutch_news.php' #!
   ,'people.php' => 'dutch_news.php' #!
   ,'person.php' => 'dutch_news.php' #!
   ,'quark7.php' => 'dutch_news.php' #!
   ,'showvideo.php' => 'dutch_news.php' #!
   ,'stats.php' => 'dutch_news.php' #!
   ,'suggestedplugins.php' => 'dutch_news.php' #!
   ,'testimonials.php' => 'dutch_news.php' #!
   ,'tutorials.php' => 'dutch_news.php' #!
   ,'usermaps.php' => 'dutch_news.php' #!
   ,'usermaps_submit.php' => 'dutch_news.php' #!
   ,'userprefabs.php' => 'dutch_news.php' #!
   ,'videos.php' => 'dutch_news.php' #!
);
?>
