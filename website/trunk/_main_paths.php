<?php
$mainroot = '/'; #This is the URL main root.
$picsroot = $mainroot.'pics/';
$videosroot = $mainroot.'videos/';
$infobaseroot = $mainroot.'infobase/';
$forumsroot = $mainroot.'forums/';
$downloadroot = $mainroot.'downloads/';
$XDocumentRoot = $_SERVER['DOCUMENT_ROOT'];
$newsroot = $XDocumentRoot.DIRECTORY_SEPARATOR.'news'.DIRECTORY_SEPARATOR; #Note: On the local file system
$languageroot = $XDocumentRoot.DIRECTORY_SEPARATOR.'_languages'.DIRECTORY_SEPARATOR; #Note: On the local file system
$projectdownloadroot = 'http://downloads.sourceforge.net/quark/';
#$keepinframe = ' target="bodyframe" ';
$keepinframe = '';
$webmasteremail = $_SERVER['SERVER_ADMIN'];
#$projectwebsite = 'http://sourceforge.net/project/?group_id=1181';
$projectwebsite = 'https://sourceforge.net/projects/quark/';
$prefabs_imageroot = $picsroot.'userprefabs/';
$cvsroot = 'http://quark.cvs.sourceforge.net/viewvc/quark/';
$svnroot = 'https://sourceforge.net/p/quark/code/HEAD/tree/';
?>
