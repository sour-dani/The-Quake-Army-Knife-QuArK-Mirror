<?php
require_once('_main_paths.php');
require_once('_image_functions.php');

global $screenshot_image_arraycol;
global $screenshot_label_arraycol;
global $screenshot_description_arraycol;
$screenshot_image_arraycol = 0;
$screenshot_label_arraycol = 1;
$screenshot_description_arraycol = 2;

global $picsroot;

global $Screenshots;
$Screenshots = array();
$Screenshots[] = array(new cImage($picsroot.'features/quark_explorer1.gif', 'QuArK Explorer - Viewing a project with multiple maps', '451', '301'), 'QuArK Explorer - Viewing a project with multiple maps', 'Multiple resources, such as maps, can be conveniently bundled into a single project file. This can help keeping track of what maps belongs to what mod or project being worked on.');
$Screenshots[] = array(new cImage($picsroot.'features/quark_explorer2.gif', 'QuArK Explorer - Opening a PAK0.PAK file', '441', '344'), 'QuArK Explorer - Opening a PAK0.PAK file', 'Opening up game pak files is just as easy as opening up any other file. Explore and modify the resources that are inside.');
$Screenshots[] = array(new cImage($picsroot.'features/quark_mapeditor1.gif', 'QuArK Map-editor - Classic 2-view layout', '482', '481'), 'QuArK Map-editor - Classic 2-view layout', 'Originally, QuArK started out with a 2-view layout. This is still available!');
$Screenshots[] = array(new cImage($picsroot.'features/quark_mapeditor2.gif', 'QuArK Map-editor - 4-view layout with textured 3D-views', '482', '481'), 'QuArK Map-editor - 4-view layout with textured 3D-views', 'With and X-, Y-, and Z-viewport, and a fully textured 3D viewport, mapping in QuArK turns into a What-You-See-Is-What-You-Get experience.');
$Screenshots[] = array(new cImage($picsroot.'features/quark_mapeditor3.gif', 'QuArK Map-editor - Build and game menu', '481', '479'), 'QuArK Map-editor - Build and game menu', 'Compiling your map for the game and testing it in the game are all options available from the build and game menu.');
$Screenshots[] = array(new cImage($picsroot.'features/quark_mapeditor4.gif', 'QuArK Map-editor - OpenGL window with colored lights', '481', '479'), 'QuArK Map-editor - OpenGL window with colored lights', 'Lighting can be previewed in the 3D views, which can be configured to use OpenGL for high graphical fidelity.');
$Screenshots[] = array(new cImage($picsroot.'features/quark_mapeditor5.gif', 'QuArK Map-editor - Function and map items selection window', '475', '442'), 'QuArK Map-editor - Function and map items selection window', 'Find all entities that can be used in a map from a conveniently organized list.');
$Screenshots[] = array(new cImage($picsroot.'features/quark_mapeditor6.gif', 'QuArK Map-editor - Rotated views', '481', '479'), 'QuArK Map-editor - Rotated views', 'Viewports can be rotated and customized.');
$Screenshots[] = array(new cImage($picsroot.'features/quark_texturebrowser.gif', 'QuArK Texture-browser', '480', '404'), 'QuArK Texture-browser', 'Pick the texture for a face from a preview list.');
$Screenshots[] = array(new cImage($picsroot.'features/quark_modeleditor.gif', 'QuArK Model-viewer', '448', '330'), 'QuArK Model-viewer', 'View models from many of the supported games and look at their animations.');

?>
