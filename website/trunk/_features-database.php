<?php
require_once('_main_paths.php');

global $mainroot, $forumsroot, $infobaseroot;

global $FeaturesMain;
$FeaturesMain = array();
$FeaturesMain[] = 'Released free of charge, and open source under the <a rel="nofollow noopener" target="_blank" href="https://www.gnu.org/licenses/#GPL">GNU General Public License</a>.';
$FeaturesMain[] = 'No restrictions or limitations for both commercial and non-commercial usage.';
$FeaturesMain[] = 'A convenient installer that bundles everything required to install and run the program.';
$FeaturesMain[] = 'Extremely newbie-friendly interface, very different from other popular (map) editors, with context help and intuitive functions.'; #@@@ "very different"... SCRAP!
$FeaturesMain[] = 'Support for many games: Quake 1, Hexen 2, Quake 2, Heretic 2, Half-Life, Sin, Kingpin, Soldier of Fortune, Quake 3: Arena, Star Trek Voyager: Elite Force, Half-Life 2 and a lot more... Look <a href="'.$mainroot.'games.php">here</a> for a more complete list.';
$FeaturesMain[] = 'Unique and editable <i>tree-view</i> display, which shows objects that the map/model consists of.';
$FeaturesMain[] = 'All valid specifics (options) for entities are listed, so no need to look them up. Additionally, things like a color picker and a folder browser make for the easy picking of options.';
#FIXME: QuArK uses keyboard shortcuts and mouse buttons schemes similar to that of other Windows programs, so no need to learn new, unintuitive combinations!
$FeaturesMain[] = 'Customizable keys, mouse-buttons, colors, ...';
$FeaturesMain[] = 'Undo/redo system per open file, with a configurable number of steps to remember.';
$FeaturesMain[] = 'Internal resource management where files are only loaded when they are needed, and automatically released so that memory usage will stay below a configurable threshold.';
$FeaturesMain[] = 'Auto-save functionality to prevent data loss in the event of a computer crash or power loss.';
$FeaturesMain[] = 'Automatically checks for program updates. <span class="sml">(Can be turned off)</span>';

$FeaturesMain[] = 'Texture-browser with textures neatly grouped into categories.';
$FeaturesMain[] = 'Project-explorer to keep all files of the TC/PC/MOD collected in one file.';

global $FeaturesMap;
$FeaturesMap = array();
$FeaturesMap[] = 'Group objects or rooms together, toggle their visibility and give them custom colors to easily find your way around your map.';
$FeaturesMap[] = 'Mirror-, Duplicator- and Hollow-maker functions for easy and quick map making.';
$FeaturesMap[] = '<i>Negative brushes</i> - creates a movable hole, no more redoing your carving/brush subtraction.';
$FeaturesMap[] = 'Bezier/patch editing, with helper functions to ease creation.';
#FIXME: Scaling and shearing tools?
$FeaturesMap[] = 'Unique high accuracy of brush- and texture-alignment in map editor. <span class="sml">(May require special build-programs)</span>';
#FIXME: Set-up multiple build-tools with custom settings, so you can compile your maps and test them in the game with just a single button press!
#FIXME: Large maps support...?
#FIXME: Issue checker. Hole/leak finder.
#FIXME: Point file support.
#FIXME: Entity browser

global $FeaturesModel;
$FeaturesModel = array();
$FeaturesModel[] = 'A fully functional model-editor. <span class="sml">(Not all model formats are supported)</span>';
$FeaturesModel[] = 'Support for skeletal animation (bones/joints), including weighted bones.';

global $FeaturesViewports;
$FeaturesViewports = array();
$FeaturesViewports[] = 'Various 2-, 3- and 4-view layouts for the map editor, with combinations of 2D and 3D viewports.'; #You can change the layout of the viewports to match your favorite layout. @@@Floating window
$FeaturesViewports[] = 'Viewports are resizable, and the new sizes are remembered across sessions.';
$FeaturesViewports[] = 'Customize the resizable viewports by rendering in wireframe, solid color or textured modes.';
$FeaturesViewports[] = 'Manipulate brushes, textures and entities directly in the 3D viewports.';
$FeaturesViewports[] = '3D preview with software-, OpenGL-, Direct3D- and 3Dfx(Glide)-rendering support.';
$FeaturesViewports[] = 'Colored lights and transparent texture support in OpenGL and Direct3D render modes.';
$FeaturesViewports[] = 'Player-, monster- and item-models viewable in 3D preview. <span class="sml">(Not supported for all games)</span>';

global $FeaturesSupport;
$FeaturesSupport = array();
$FeaturesSupport[] = 'QuArK\'s own file format (.qrk) allows the storing of information that\'s useful for editing, such as duplicators or negative brushes. Conversion to the right format for the game happens seamlessly on export.';
$FeaturesSupport[] = 'Open game file archives, extract files from them, and create new archives for easy mod distribution.';
$FeaturesSupport[] = 'Easily convert FGD and DEF files to add new entity definitions.';
$FeaturesSupport[] = 'Full support for game mods.';
#FIXME: Game file format support. Need a complete list in the Infobase for that.

global $FeaturesOthers;
$FeaturesOthers = array();
$FeaturesOthers[] = 'Extendable with plug-ins, coded in <a rel="nofollow noopener" target="_blank" href="https://www.python.org">Python</a>, with over 60 already bundled!';
#$FeaturesOthers[] = '<a href="'.$mainroot.'communication.php#mailinglist">Mailing-lists</a> supplied by <a rel="nofollow noopener" target="_blank" href="https://groups.yahoo.com/">YahooGroups</a>, for easy communication to and from QuArK users.'; #http://www.yahoogroups.com
$FeaturesOthers[] = 'For support and other tips and tricks, you can visit our <a href="'.$forumsroot.'">forums</a>.';
$FeaturesOthers[] = 'And much more; check out our <a href="'.$infobaseroot.'">online documentation</a>!';

#PLUGINS:
#FIXME: Add?: Navigating a large, complex map can get quite difficult, and losing your way is annoying. Luckily, QuArK comes with a handy plugin that allows you to save and restore custom camera/eye positions, so you can "teleport" around your map as you're editing!

?>
