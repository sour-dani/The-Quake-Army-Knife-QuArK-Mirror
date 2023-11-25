<?php
require_once('_main_paths.php');
global $downloadroot;

global $added_arraycol;
global $updated_arraycol;
global $image_arraycol;
global $file_arraycol;
global $author_arraycol;
$added_arraycol = 0;
$updated_arraycol = 1;
$image_arraycol = 2;
$file_arraycol = 3;
$author_arraycol = 4;

global $prefabs_database;
$prefabs_database = array(
	'Q1' => array(
		array(mktime(0, 0, 0, 10, 21, 2000), mktime(0, 0, 0, 11, 4, 2000)
			,'quake1/prefabspack1.gif'
			,$downloadroot.'prefabs/quark1/prefabspack1Updatebeta1.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake1/prefabspack1Updatebeta1.zip
			,33
		)
		,array(mktime(0, 0, 0, 10, 27, 2000), 0
			,'quake1/balloon.jpg'
			,$downloadroot.'prefabs/quark1/balloon.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake1/balloon.zip
			,34
		)
		,array(mktime(0, 0, 0, 10, 27, 2000), 0
			,'quake1/chandelier.jpg'
			,$downloadroot.'prefabs/quark1/chandelier.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake1/chandelier.zip
			,34
		)
		,array(mktime(0, 0, 0, 10, 27, 2000), 0
			,'quake1/spikeme.jpg'
			,$downloadroot.'prefabs/quark1/spikeme.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake1/spikeme.zip
			,34
		)
		,array(mktime(0, 0, 0, 10, 27, 2000), 0
			,'quake1/amazing.jpg'
			,$downloadroot.'prefabs/quark1/amazing.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake1/amazing.zip
			,34
		)
		,array(mktime(0, 0, 0, 10, 21, 2000), 0
			,'quake1/octapipes.gif'
			,$downloadroot.'prefabs/quark1/octapipes.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake1/octapipes.zip
			,33
		)
	)
	,'Q2' => array(
		array(mktime(0, 0, 0, 6, 18, 2008), 0
			,'quake2/vtech.jpg'
			,'http://www.fileplanet.com/hosteddl.aspx?/hst/c/d/cdunde/quake2/vtech.zip'
			,35
		)
		,array(mktime(0, 0, 0, 6, 14, 2008), 0
			,'quake2/mikemc_q2pref-pack1.jpg'
			,$downloadroot.'prefabs/quark2/mikemc_q2prefabs.zip' #http://www.fileplanet.com/hosteddl.aspx?/hst/c/d/cdunde/quake2/mikemc_q2prefabs.zip
			,36
		)
		,array(mktime(0, 0, 0, 4, 11, 2005), 0
			,'quake2/truck.jpg'
			,$downloadroot.'prefabs/quark2/simpletruck.zip' #http://www.fileplanet.com/hosteddl.aspx?/hst/c/d/cdunde/quake2/simpletruck.zip
			,37
		)
		,array(mktime(0, 0, 0, 5, 11, 2003), 0
			,'quake2/Door1-ByDataKiller.jpg'
			,$downloadroot.'prefabs/quark2/door1-bydatakiller.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/Door1-ByDataKiller.zip
			,38
		)
		,array(mktime(0, 0, 0, 11, 14, 2000), 0
			,'quake2/alphabet.gif'
			,$downloadroot.'prefabs/quark2/alphabet.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/alphabet.zip
			,39
		)
		,array(mktime(0, 0, 0, 9, 17, 2001), 0
			,'quake2/alienship.jpg'
			,$downloadroot.'prefabs/quark2/alienship.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/alienship.zip
			,40
		)
		,array(mktime(0, 0, 0, 4, 13, 2001), 0
			,'quake2/droptube.gif'
			,$downloadroot.'prefabs/quark2/droptube.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/droptube.zip
			,41
		)
		,array(mktime(0, 0, 0, 1, 3, 2001), 0
			,'quake2/pre-spindeath.jpg'
			,$downloadroot.'prefabs/quark2/pre-spindeath.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/pre-spindeath.zip
			,42
		)
		,array(mktime(0, 0, 0, 11, 23, 2000), 0
			,'quake2/stonetower.gif'
			,$downloadroot.'prefabs/quark2/stonetower.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/stonetower.zip
			,43
		)
		,array(mktime(0, 0, 0, 11, 8, 2000), 0
			,'quake2/dog_house_pf.jpg'
			,$downloadroot.'prefabs/quark2/dog_house_pf.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/dog_house_pf.zip
			,44
		)
		,array(mktime(0, 0, 0, 10, 27, 2000), 0
			,'quake2/rollers.jpg'
			,$downloadroot.'prefabs/quark2/rollers.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/rollers.zip
			,34
		)
		,array(mktime(0, 0, 0, 10, 27, 2000), 0
			,'quake2/barracks.jpg'
			,$downloadroot.'prefabs/quark2/barracks.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake2/barracks.zip
			,34
		)
	)
	,'Hr2' => array(
		array(mktime(0, 0, 0, 12, 12, 2000), 0
			,'heretic2/mstairs.gif'
			,$downloadroot.'prefabs/heretic2/mstairs.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/heretic2/mstairs.zip
			,45
		)
	)
	,'HL' => array(
		array(mktime(0, 0, 0, 6, 19, 2002), 0
			,'half-life/pilot.jpg'
			,$downloadroot.'prefabs/half-life/pilot.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/halflife/pilot.zip
			,46
		)
		,array(mktime(0, 0, 0, 5, 28, 2002), 0
			,'half-life/tiger.jpg'
			,$downloadroot.'prefabs/half-life/tiger.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/halflife/tiger.zip
			,47
		)
		,array(mktime(0, 0, 0, 4, 19, 2002), 0
			,'half-life/builder.jpg'
			,$downloadroot.'prefabs/half-life/builder.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/halflife/builder.zip
			,48
		)
		,array(mktime(0, 0, 0, 3, 25, 2001), 0
			,'half-life/ellis-lamppost.gif'
			,$downloadroot.'prefabs/half-life/ellis-lamppost.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/halflife/ellis-lamppost.zip
			,49
		)
		,array(mktime(0, 0, 0, 11, 23, 2000), 0
			,'half-life/t-62.gif'
			,$downloadroot.'prefabs/half-life/t-62.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/halflife/t-62.zip
			,50
		)
		,array(mktime(0, 0, 0, 10, 27, 2000), 0
			,'half-life/prefab-HL.gif'
			,$downloadroot.'prefabs/half-life/prefab-HL.ace' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/halflife/prefab-HL.ace
			,3
		)
	)
	,'Q3A' => array(
		array(mktime(0, 0, 0, 5, 6, 2001), 0
			,'quake3/Q3ArchesLibrary.gif'
			,$downloadroot.'prefabs/quark3/Q3ArchesLibrary.zip' #http://www.fileplanet.com/dl.aspx?/planetquake/quark/userprefabs/quake3/Q3ArchesLibrary.zip
			,51
		)
	)
);
?>
