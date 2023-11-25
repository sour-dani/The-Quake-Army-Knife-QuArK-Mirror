<?php
require_once('_main_paths.php');

class cQRKGamepaks
{
	var $Title;       # Name of the game pak
	var $URL;         # URL of the game pak
	var $Description; # Description of the game pak

	function __construct($aTitle, $aURL, $aDescription=NULL)
	{
		$this->Title       = $aTitle;
		$this->URL         = $aURL;
		$this->Description = $aDescription;
	}
}

global $projectdownloadroot;
global $downloadroot;

##
## -- Game paks --
##
global $GamesQRKGamepaks;
$GamesQRKGamepaks = array();

#                    Gamepak (file)name
#                    |        Download URL
#                    |        |         Description
#                    |        |         |

# Quake 2
$GamesQRKGamepaks['Q2'   ] = array();
$GamesQRKGamepaks['Q2'   ][] = new cQRKGamepaks('beta2105.zip',$downloadroot.'lazarus/beta2105.zip','Last beta release of Lazarus DLL.');
$GamesQRKGamepaks['Q2'   ][] = new cQRKGamepaks('source_051902.zip',$downloadroot.'lazarus/source_051902.zip','Lazarus 2.105 source code.');
$GamesQRKGamepaks['Q2'   ][] = new cQRKGamepaks('total_092001.zip',$downloadroot.'lazarus/total_092001.zip','Lazarus. The whole enchillada.');

# Quake 3: Arena
$GamesQRKGamepaks['Q3A'  ] = array();
$GamesQRKGamepaks['Q3A'  ][] = new cQRKGamepaks('cleanshader.zip',$projectdownloadroot.'cleanshaders.zip');
$GamesQRKGamepaks['Q3A'  ][] = new cQRKGamepaks('common-spog.pk3',$projectdownloadroot.'common-spog.pk3');
$GamesQRKGamepaks['Q3A'  ][] = new cQRKGamepaks('common-q3map2.pk3',$projectdownloadroot.'common-q3map2.pk3','Made by Obsidian (Dated: 2004.04.20)');
//$GamesQRKGamepaks['Q3A'  ][] = new cQRKGamepaks('curry.pk3',$projectdownloadroot.'curry.pk3');
//$GamesQRKGamepaks['Q3A'  ][] = new cQRKGamepaks('mapmedia.pk3',$projectdownloadroot.'mapmedia.pk3');

# Star Trek Voyager: Elite Force
$GamesQRKGamepaks['STVEF'] = array();
$GamesQRKGamepaks['STVEF'][] = new cQRKGamepaks('QuArK_STVEF.zip',$projectdownloadroot.'QuArK_STVEF.zip');

# Return to Castle Wolfenstein
$GamesQRKGamepaks['RTCW' ] = array();
$GamesQRKGamepaks['RTCW' ][] = new cQRKGamepaks('QuArK_RTCW.zip',$projectdownloadroot.'QuArK_RTCW.zip');

# Return to Castle Wolfenstein: Enemy Territory
$GamesQRKGamepaks['RTCW-ET'] = array();
$GamesQRKGamepaks['RTCW-ET'][] = new cQRKGamepaks('QuArK_RTCW-ET.zip',$projectdownloadroot.'QuArK_RTCW-ET.zip');

# Torque
$GamesQRKGamepaks['T'    ] = array();
$GamesQRKGamepaks['T'    ][] = new cQRKGamepaks('Torque_textures.zip',$projectdownloadroot.'Torque_textures.zip');

# Half-Life 2
$GamesQRKGamepaks['HL2'  ] = array();
$GamesQRKGamepaks['HL2'  ][] = new cQRKGamepaks('QuArK_Beta1_H-L2_qrk_files.zip',$projectdownloadroot.'QuArK_Beta1_H-L2_qrk_files.zip','Needed for QuArK 6.5.0 Beta1');
$GamesQRKGamepaks['HL2'  ][] = new cQRKGamepaks('QuArK_HL2_CS_textures.zip',$projectdownloadroot.'QuArK_HL2_CS_textures.zip','Needed for QuArK 6.5.0 Beta1');

# Quake 4
$GamesQRKGamepaks['Q4'   ] = array();
$GamesQRKGamepaks['Q4'   ][] = new cQRKGamepaks('QuArK_Quake4.zip',$projectdownloadroot.'QuArK_Quake4.zip');
$GamesQRKGamepaks['Q4'   ][] = new cQRKGamepaks('QuArK_Quake4md3.zip',$projectdownloadroot.'QuArK_Quake4md3.zip');

# Prey
$GamesQRKGamepaks['PREY' ] = array();
$GamesQRKGamepaks['PREY' ][] = new cQRKGamepaks('QuArK_Prey_files.zip',$projectdownloadroot.'QuArK_Prey_files.zip');

# Star Trek: Elite Force 2
$GamesQRKGamepaks['EF2'  ] = array();
$GamesQRKGamepaks['EF2'  ][] = new cQRKGamepaks('QuArK_EF2_files.zip',$projectdownloadroot.'QuArK_EF2_files.zip');

# Nexuiz
$GamesQRKGamepaks['NEX'  ] = array();
$GamesQRKGamepaks['NEX'  ][] = new cQRKGamepaks('QuArK_NEXUIZ_files.rar',$projectdownloadroot.'QuArK_NEXUIZ_files.rar');

# Warsow
$GamesQRKGamepaks['W'    ] = array();
$GamesQRKGamepaks['W'    ][] = new cQRKGamepaks('QuArK_Warsow_files.zip',$projectdownloadroot.'QuArK_Warsow_files.zip');

?>
