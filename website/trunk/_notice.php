<?php
require_once('_functions.php');

global $mainroot, $infobaseroot, $forumsroot, $picsroot, $keepinframe;

$noticetxts = array('Remember the good old days? Look in the <a ' . $keepinframe . 'href="'.$mainroot.'archivednews.php">archived news section</a>!'
                   ,'<strong>Questions</strong> and <strong>problems</strong> should be send to the <a ' . $keepinframe . 'href="'.$mainroot.'communication.php">Official QuArK forums</a>!'
                   ,'<strong>Information</strong> and <strong>FAQ</strong> can be found in the <a ' . $keepinframe . 'href="'.$infobaseroot.'">Infobase Online-documentation</a> pages.'
                   ,'QuArK now accepts <strong>donations</strong>! The <a ' . $keepinframe . 'href="'.$mainroot.'donate.php">donate page</a> can be found in the navigation to the left.'
                   ,'There is now a <strong>video section</strong>! The <a ' . $keepinframe . 'href="'.$mainroot.'videos.php?TA=1">video page</a> can be found in the navigation to the left.'
                   ,'Also see the newly added <a target="_blank" href="'.$forumsroot.'">QuArK Resource Forums</a>.'
                   ,'If you want to run QuArK on <strong>Mac OS X</strong> or <strong>Linux</strong>, it runs fine in <a rel="noopener" target="_blank" href="https://appdb.winehq.org/objectManager.php?sClass=application&amp;iId=1532">Wine</a>.'
                   ,'Remember the good old days? Switch back to the <strong>old website theme</strong> in the <a ' . $keepinframe . 'href="'.$mainroot.'layout.php">layout section</a>!'
#                   ,'<a rel="noopener" target="_blank" href="http://www.inktank.com/"><img src="'.$picsroot.'smlbanners/angst88_31.gif" width=88 height=31 alt="Angst Technology"></a> comic strip.' # Taken out due to broken link
);

$bodytext = '<div class="centered">';
$bodytext .= $noticetxts[array_rand($noticetxts, 1)];
$bodytext .= '</div>';

pageSidePanel('', 'Notice...', $bodytext);
?>
