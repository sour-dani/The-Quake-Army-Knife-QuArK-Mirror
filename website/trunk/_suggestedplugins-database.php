<?php
require_once('_suggestedplugins_functions.php');

class cSuggestedPlugin
{
	var $Tag;           # Tag to identify this suggested plugins
	var $Name;          # Display name
	var $Problem;       # Problem description
	var $Suggestion;    # Suggestion to solve the problem
	var $SuggestedBy;   # Array of people that suggested this
	var $Interested;    # Array of people that are interested in this
	var $DevelopedBy;   # Array of people that developed this
	var $NameEncrypted; # 
	var $Done;          # 
	var $DoneComment;   # 

	function __construct($aTag, $aName, $aProblem, $aSuggestion, $aSuggestedBy=NULL, $aInterested=NULL, $aDevelopedBy=NULL, $aNameEncrypted=NULL, $aDone=0, $aDoneComment=NULL)
	{
		$this->Tag           = $aTag;
		$this->Name          = $aName;
		$this->Problem       = $aProblem;
		$this->Suggestion    = $aSuggestion;
		$this->SuggestedBy   = $aSuggestedBy;
		$this->Interested    = $aInterested;
		$this->DevelopedBy   = $aDevelopedBy;
		$this->NameEncrypted = $aNameEncrypted;
		$this->Done          = $aDone;
		$this->DoneComment   = $aDoneComment;
	}
}

global $date_arraycol;
global $email_arraycol;
global $person_arraycol;
$date_arraycol = 0;
$email_arraycol = 1;
$person_arraycol = 2;

global $SuggestedPlugins;
$SuggestedPlugins = array();
$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest1'
,'Three-point cut plane'
,'Cutting using the current cut-tool, only splits/cuts the polys in the current compass-selected view, looking into the screen. A way of cutting polys with a plane/face thats been defined by three points in space, would be helpfull in those cases where a complex split/cut have to be made.'
,'Three point plane clipping works this way: You place three points in the 2D and/or 3D views, which together define a plane/face. The selected polys are then split/cut along that plane/face.'
,array(array(mktime(0, 0, 0, 6, 15, 1999) ,'wayfinder@ber.netsurf.de' ,'Sebastian'))
,array(array(mktime(0, 0, 0, 6, 18, 1999) ,'j@chokmah.org' ,'J Crossley')
      ,array(mktime(0, 0, 0, 5, 5, 2000) ,'minused@minsk2000.to' , "'-ED'")
      ,array(mktime(0, 0, 0, 9, 5, 2000) ,'slobboo@madasafish.com' ,'Mark David Pittam'))
,NULL
,'Guerr cbvag pyvccvat cynar'
,1
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest02'
,'User-defined pivot point'
,'Transformations are generally centered around the center of a bounding box around your current selection. There is no way to specify a different origin for scaling and rotation transformations.'
,'A system that lets the map designer define a pivot point for rotation and scaling, and linear transformation in general instead of the center of the bounding box. It should be possible to set a permanent (in other words saved in the .QKM or .QRK file containing the map) pivot point for each group.'
,array(array(mktime(0, 0, 0, 6, 17, 1999) ,'sgalbrai@linknet.kitsap.lib.wa.us' ,"'sgalbrai'"))
,array(array(mktime(0, 0, 0, 5, 5, 2000) ,'minused@minsk2000.to', "'-ED'")
      ,array(mktime(0, 0, 0, 9, 26, 2000) ,'j@chokmah.org' , 'J Crossley'))
,NULL
,'Hfre-qrsvarq cvibg cbvag'
,1
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest03'
,"Entity prefab 'editor'"
,'Creating new entity classes, with special specifics, requires hand editing of add-on .QRK files.'
,"Something like the new entities system in <a href=\"download.php\">QuArK 4.07</a> or a full-blown add-on editor similar to <a rel=\"noopener\" target=\"_blank\" href=\"http://members.home.net/pjsteele/quade/\">QUADE</a> but within QuArK. May have to be coded in Delphi, due to limited QuArK functions available to Python." #FIXME: Use mainroot?
,array(array(mktime(0, 0, 0, 6, 17, 1999) ,'sgalbrai@linknet.kitsap.lib.wa.us' ,"'sgalbrai'"))
,array(array(mktime(0, 0, 0, 7, 4, 1999) ,'artemis@comnet.ca' ,'Artemis')
      ,array(mktime(0, 0, 0, 7, 29, 1999) ,'gamesmaster@earthlight.co.nz' ,'Daniel Free')
      ,array(mktime(0, 0, 0, 10, 6, 1999) ,'dobryakov@volga-paper.ru' ,"'dobryakov'")
      ,array(mktime(0, 0, 0, 12, 4, 1999) ,'jadams4@columbus.rr.com' ,'Jon Adams')
      ,array(mktime(0, 0, 0, 12, 5, 1999) ,'yvesa@riotsoftware.com' ,'Yves Allaire'))
,NULL
,NULL
,1
,"<img align=right src=\"pics/suggestedplugins/entity_editor.png\" alt=\"Entity Editor\" width=283 height=197>
 Implemented in QuArK 6.2<br><br>
 Open a .BSP file, and press the button to create an add-on with the entities found in the .BSP file.");

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest6'
,'Show width/height/depth of selected poly(s)'
,'QuArK does not display the size (width/height/depth) of the selected poly(s).'
,"Uhm. The problem says it all, doesn't it?"
,array(array(mktime(0, 0, 0, 6, 20, 1999) ,'popeye@paralynx.com' ,'Paul Hildebrandt'))
,array(array(mktime(0, 0, 0, 6, 20, 1999) ,'sblanning@mistral.co.uk' ,'S. Blanning')
      ,array(mktime(0, 0, 0, 7, 10, 1999) ,'fambi@kalligram.sk' ,'G. Farnbauer')
      ,array(mktime(0, 0, 0, 7, 14, 1999) ,'kjello@funcom.com' ,'Kjell Ove Vuttudal')
      ,array(mktime(0, 0, 0, 7, 29, 1999) ,'gamesmaster@earthlight.co.nz' ,'Daniel Free')
      ,array(mktime(0, 0, 0, 8, 11, 1999) ,'lipman@nis.net' ,'Peter Lipman')
      ,array(mktime(0, 0, 0, 2, 17, 2002) ,'phantom@b3041o6b532i.bc.hsia.telus.net' ,'Piotr Banasik'))
,NULL
,NULL
,1
,"<img align=right src=\"pics/suggestedplugins/show_widthheightdepth.gif\" alt=\"Show Width Height Depth\" width=151 height=207>
 Implemented in QuArK 6.00 beta-1<br><br>
 Select a brush (or more), and point the mouse-cursor to the center-movement handle of the selection. The width/height/depth will show in the bottom left hint-box.");

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest7'
,'Merge brushes'
,"Say you got a lot of brushes that is touching each other. Instead of using the intersection-command where you have to enlarge one of the brushes, so it overlaps the others, a 'Make into one brush' command could be handy."
,'Merge brush! Takes two or more brushes and merges them into a single brush. As long as its convex of course.'
,array(array(mktime(0, 0, 0, 6, 20, 1999) ,'popeye@paralynx.com' ,'Paul Hildebrandt'))
,array(array(mktime(0, 0, 0, 7, 3, 1999) ,'kickass@foni.net' ,'Andy Pelzer')
      ,array(mktime(0, 0, 0, 7, 23, 1999) ,'eldumont@netrover.com' ,'Yvan Dumont')
      ,array(mktime(0, 0, 0, 7, 29, 1999) ,'gamesmaster@earthlight.co.nz' ,'Daniel Free')
      ,array(mktime(0, 0, 0, 8, 2, 1999) ,'bigdawg@quakecity.net' ,"'Big Dawg'")
      ,array(mktime(0, 0, 0, 8, 4, 1999) ,'m.oosterbroek@hccnet.nl' ,'Pieter Oosterbroek')
      ,array(mktime(0, 0, 0, 8, 23, 1999) ,'mazany@post.cz' ,"Tomá¹ 'Mazy' Èerný")
      ,array(mktime(0, 0, 0, 9, 3, 1999) ,'usvn@hotmail.com' ,'Niels van Groningen')
      ,array(mktime(0, 0, 0, 10, 6, 1999) ,'dobryakov@volga-paper.ru' ,"'dobryakov'")
      ,array(mktime(0, 0, 0, 10, 7, 1999) ,'chef@pac.com.au' ,'Luke "Hamster" Mcgaffin')
      ,array(mktime(0, 0, 0, 12, 3, 1999) ,'DanilM12@aol.com' ,"'DanilM12'")
      ,array(mktime(0, 0, 0, 2, 17, 2000) ,'phantom@b3041o6b532i.bc.hsia.telus.net' ,'Piotr Banasik')
      ,array(mktime(0, 0, 0, 5, 5, 2000) ,'minused@minsk2000.to' ,"'-ED'")
      ,array(mktime(0, 0, 0, 5, 5, 2000) ,'j.j.beck@chello.nl' ,"'jjjh'"))
,NULL
,NULL
,1
,"<img align=right src=\"pics/suggestedplugins/merge_brushes.gif\" alt=\"Merge Brushes\" width=185 height=191>
 Implemented in QuArK 5.11 beta (or was it the QTA version?)<br><br>
 Tag a face (CTRL-T), then bring another brush's face to match that tagged face exactly, which should be merged together. Right-click on the brush to get the context-menu up. If the two brushes can be merged, the \"Merge polys\" menu-item will be active.");

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest10'
,'Polygon'
,'Not a problem, more an idea, of a new object that can be used in map-building, especially for cave and terrain areas.'
,"The way the 'polygon' (2D-shape) would work is you create an arbitrary convex polygon (perhaps you create it from selected point entities or perhaps from a brush face or perhaps you create a 'polygon' first then add vertices to it.) Then at compile time the convex polygon becomes a solid brush by being \"extruded.\"<br>
 <!--This is a very simple process which could be implemented several ways. My favorite is to find the nearest major axis (x, y or z) to the normal of the polygon and duplicate the polygon's vertices along that axis. (you could duplicate the polygon's vertices along it's own normal but then it wouldn't fit neatly with surounding brushes or 'polygons') Then you can find the planes that make up the brush by picking three vertices from the original polygon, then three vertices from the duplicate, then two vertices from one and one vertex from the other for each of the other faces. -->
 This plug-in would eliminate clutter in much the same way that negative polyhedrons do, but without some of the risks associated with csg operations, and it would be especially convenient for modeling complex geometry like caves and terrain.<br>
 <span class=\"sml\">(A simpler but almost just as good alternative to 'polygon' would be 'triangle' which would be less versatile but gauranteed to be a flat convex polygon no matter how you try to move the vertices.)</span>"
,array(array(mktime(0, 0, 0, 8, 5, 1999) ,'sgalbrai@linknet.kitsap.lib.wa.us' ,"'sgalbrai'"))
,array(array(mktime(0, 0, 0, 8, 8, 1999) ,'grob@clic.net', "'grob'")
      ,array(mktime(0, 0, 0, 2, 17, 2000) ,'phantom@b3041o6b532i.bc.hsia.telus.net' ,'Piotr Banasik')
      ,array(mktime(0, 0, 0, 5, 5, 2000) ,'minused@minsk2000.to' ,"'-ED'")
      ,array(mktime(0, 0, 0, 5, 5, 2000) ,'j.j.beck@chello.nl' ,"'jjjh'")
      ,array(mktime(0, 0, 0, 4, 30, 2001) ,'methodermis@yahoo.com' ,"'muffinator'")
      ,array(mktime(0, 0, 0, 11, 5, 2001) ,'will.br@btinternet.com' ,"'Will'"))
,NULL
,'Cbyltba'
,1 #A capability of the extruder
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest12'
,'Arches'
,'Arches can be annoying to create taking up time, architecture in general is. But there are common elements to make up a level and I think arches is an essential part.'
,"Some sort of plugin (if this is possible) to create an arch where you can determine its width height, how hollow it is, etc. I know this sounds lazy :P but you wouldn't believe the amount of time I've spend making sure vertexes are aligned to not get errors :)"
,array(array(mktime(0, 0, 0, 5, 14, 2000) ,'gregd@mixnmojo.com' ,'GregD'))
,array(array(mktime(0, 0, 0, 8, 2, 2000) ,'barry.allott@ntlworld.com' ,'Barry Allott'))
,NULL
,NULL
,1
,"<img align=right src=\"pics/suggestedplugins/arches.png\" alt=\"Arches\" width=259 height=126>
 Implemented in QuArK 6.1c<br><br>
 Create a cube, right-mouse-click on the cube's movement handle, and then in the context-menu choose 'Brush Curves -&gt; Arch'.");

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest4'
,'Finishing the QuArK model-editor'
,'The QuArK 5.x model editor does not allow editing, and it does not support all model-files for the games.'
,'Maybe this is would require Delphi programming as well as Python coding but it looks like the new QuArK 5.x model editor has a lot of potential (it is currently a working .MDL and .MD2 viewer.) Supporting any other game model formats (Hexen-2, Heretic-2, Half-Life, Sin), or adding even the most primitive editing features (scaling models, deleting parts of them, or moving and deleting frames) would be a big improvement.'
,array(array(mktime(0, 0, 0, 6, 17, 1999) ,'sgalbrai@linknet.kitsap.lib.wa.us' ,"'sgalbrai'"))
,array(array(mktime(0, 0, 0, 7, 4, 1999) ,'artemis@comnet.ca' ,'Artemis')
      ,array(mktime(0, 0, 0, 7, 29, 1999) ,'gamesmaster@earthlight.co.nz' ,'Daniel Free')
      ,array(mktime(0, 0, 0, 8, 2, 1999) ,'bigdawg@quakecity.net' ,"'Big Dawg'")
      ,array(mktime(0, 0, 0, 10, 6, 1999) ,'dobryakov@volga-paper.ru' ,"'dobryakov'")
      ,array(mktime(0, 0, 0, 10, 7, 1999) ,'chef@pac.com.au' ,"Luke 'Hamster' Mcgaffin")
      ,array(mktime(0, 0, 0, 10, 22, 1999) ,'DanilM12@aol.com' ,"'DanilM1'")
      ,array(mktime(0, 0, 0, 5, 3, 2000) ,'zwa.dooyes@quicknet.nl' ,'Scar')
      ,array(mktime(0, 0, 0, 5, 5, 2000) ,'minused@minsk2000.to' ,"'-ED'")
      ,array(mktime(0, 0, 0, 9, 3, 2000) ,'schizo_86@hotmail.com' ,"'Toxic _'")
      ,array(mktime(0, 0, 0, 3, 24, 2001) ,'rainiarus@compuserve.de' ,'Rainer Feller')
      ,array(mktime(0, 0, 0, 4, 17, 2001) ,'tuppant@mbnet.fi' ,'Antti Tuppurainen'))
,array(array(mktime(0, 0, 0, 8, 14, 2007) ,'cdunde@sbcglobal.net' ,'cdunde'))
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest5'
,'Enlarge/shrink a single face'
,"I've got a cube (or any other convex shape, but in this example a cube is just fine), and want to create a 4-sided pyramid with a flat top, out of it. Normaly I would have to move each of the edges that touch the top-face, to get the wanted shape."
,'When a single face is selected, the Enlarge and Shrink buttons should only apply their changes to the face (which in reality is the adjacented faces), and not the whole poly.'
,array(array(mktime(0, 0, 0, 6, 20, 1999) ,'decker@planetquake.com' ,'Decker'))
,array(array(mktime(0, 0, 0, 7, 7, 1999) ,'rawhide@thirdeye.tf' ,"'rawhide'")
      ,array(mktime(0, 0, 0, 8, 2, 1999) ,'bigdawg@quakecity.net' ,"'Big Dawg'")
      ,array(mktime(0, 0, 0, 2, 25, 2000) ,'jadams4@columbus.rr.com' ,"'jadams4'")
      ,array(mktime(0, 0, 0, 5, 5, 2000) ,'minused@minsk2000.to' ,"'-ED'")
      ,array(mktime(0, 0, 0, 4, 24, 2001) ,'ghost@poisonville.com' ,"'{GT}TheGhost'")
      ,array(mktime(0, 0, 0, 5, 18, 2002) ,'remy.vn@xs4all.nl' ,'Remy van Noorden'))
,NULL
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest11'
,'Light emitting textures in OpenGL-views'
,"Textures that emit light in the FPS-game, does not in QuArK's OpenGL views."
,"Extract from kell.hound's e-mail:<br>
 [...] <i>do you plan to have the texture-lighting
 of halflife working in the opengl-view like the light-ents ? ( i.e. via a
 plugin that reads the lights.rad from the directory of the compile tools
 (=no unintended lighting after compile) and places \"virtual\" light-ents
 where a light-emitting-texture is used on a brush ( intensity could be
 dependent on the size of the area the texture is used on ) [but these
 light-ents should not be accessible from QuArK to prevent unclarities during
 editing] ) - that way you could use the existing light-preview code of the
 opengl-view !!</i> [...]"
,array(array(mktime(0, 0, 0, 5, 3, 2000) ,'kell_hound@gmx.at' ,"'kell.hound'"))
,array(array(mktime(0, 0, 0, 7, 15, 2000) ,'Marauder_98@excite.com' ,'Marauder')
      ,array(mktime(0, 0, 0, 1, 13, 2001) ,'asouffer86@yahoo.com' ,"'astouffer86'"))
,NULL
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest8'
,'Extract used textures from selected .BSPs'
,"\"<i>Wow, now that is a neat combination of textures.</i>\" If just QuArK could generate a list of the textures that are used in these BSPs, so finding the right textures for your own map will be easier."
,'A plug-in or function which could be given a set of BSP-files (from any of the supported games), and extract just the textures that these maps uses, into a new folder in the texture-browser.'
,array(array(mktime(0, 0, 0, 6, 26, 1999) ,'shryqe@voyager.net' ,'Shryqe'))
,array(array(mktime(0, 0, 0, 7, 4, 1999) ,'artemis@comnet.ca' ,'Artemis')
      ,array(mktime(0, 0, 0, 8, 8, 1999) ,'grob@clic.net' ,"'grob'")
      ,array(mktime(0, 0, 0, 8, 20, 1999) ,'FLC-Clan@gmx.net' ,"'Raven'")
      ,array(mktime(0, 0, 0, 8, 24, 1999) ,'surfncardiff@home.com' ,"'BWR'")
      ,array(mktime(0, 0, 0, 12, 29, 1999) ,'gokhan_ozturk@hotmail.com' ,"'gokhan ozturk'")
      ,array(mktime(0, 0, 0, 9, 5, 2000) ,'slobboo@madasafish.com' ,'Mark David Pittam')
      ,array(mktime(0, 0, 0, 12, 3, 2000) ,'sansa@buzau.ro' ,'Sansa buzoiana')
      ,array(mktime(0, 0, 0, 12, 10, 2000) ,'emilian_d@yahoo.com' ,'Emilian Dobre')
      ,array(mktime(0, 0, 0, 3, 20, 2001) ,'nacho_duart@softhome.net' ,"'KNac007'")
      ,array(mktime(0, 0, 0, 6, 2, 2001) ,'Cymodonay@microsoft.com' ,'Marc-André Jargstorff'))
,NULL
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest9'
,'Import/Export of games special file-formats'
,"You've got all these utility-programs which import/export/convert one or a few file-formats like .WAD, .LMP, .SPR, .SP2 etc. for just that particular game or games."
,"Its more like multiple plug-ins. Give QuArK the ability to read almost every type of file-format of the games that it supports, and make it able to convert between the different formats (as much as possible).<br>
 For instance; import/export Quake-1/Half-Life GFX.WAD file, convert to/from Quake-1/Hexen-2 .LMP bitmap files, manage Quake-2/Heretic-2 .SP2 sprite files, edit Quake-1/Half-Life .DEM and Quake-2 .DM2 demo files <span class=\"sml\">(a tough one)</span>, convert textures from one game to another game, etc. etc.<br>"
,array(array(mktime(0, 0, 0, 7, 7, 1999) ,'tiglari@hexenworld.com' ,"'tiglari'")
      ,array(mktime(0, 0, 0, 7, 7, 1999) ,'sgalbrai@linknet.kitsap.lib.wa.us' ,"'sgalbrai'")
      ,array(mktime(0, 0, 0, 10, 6, 1999) ,'dobryakov@volga-paper.ru' ,"'dobryakov'")
      ,array(mktime(0, 0, 0, 1, 20, 2000) ,'andyvinc@hotmail.com' ,'Andy Vincent')
      ,array(mktime(0, 0, 0, 7, 8, 2001) ,'robvoss@houston.rr.com' ,"'rob voss'"))
,NULL
,NULL
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest13'
,'Torus Creator'
,'Trying to create a pipe with a radiused corner is a real pain in the #$%. It seems as though you have to go through a thousand changes to create the radiused segment.'
,"Create a plug-in for creating a torus. This would/could be similar to the prism plug-in that QuArK already has. It would make those sweeping corners for piping a breeze to create. You could create the base torus and delete the segments you don't need and bingo, a radiused corner."
,array(array(mktime(0, 0, 0, 9, 2, 2000) ,'jefman@speakeasy.org' ,"'Jef'"))
,array(array(mktime(0, 0, 0, 9, 5, 2000) ,'slobboo@madasafish.com' ,'Mark David Pittam')
      ,array(mktime(0, 0, 0, 9, 26, 2000) ,'j@chokmah.org' ,"'J Crossley'")
      ,array(mktime(0, 0, 0, 11, 20, 2000) ,'heavytank2@mindspring.com' ,"'Rambozo'")
      ,array(mktime(0, 0, 0, 4, 24, 2001) ,'ghost@poisonville.com' ,"'{GT}TheGhost'"))
,array(array(mktime(0, 0, 0, 6, 28, 2002) ,'plungermonkey@cox.net' ,"'Jef'"))
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest14'
,'Import DXF Files'
,'...'
,'hey I have an idea for a plug-in for QuArK. (it would rock!) if you had a plugin that would let you import 3d studio files.'
,array(array(mktime(0, 0, 0, 9, 28, 2000) ,'pj667@yahoo.com' ,"'pj667'"))
,array(array(mktime(0, 0, 0, 10, 20, 2000) ,'TodPalin@ic24.net' ,"'TodPalin'")
      ,array(mktime(0, 0, 0, 10, 24, 2000) ,'spg@mail.md' ,'Strambeanu Petru')
      ,array(mktime(0, 0, 0, 10, 27, 2000) ,'daniel@fizz.earthlight.co.nz' ,'Daniel Free')
      ,array(mktime(0, 0, 0, 10, 12, 2000) ,'apollon.amiens@freesurf.fr' ,"'BOB_XYGENE'") #FIXME: Month-date screwup?
      ,array(mktime(0, 0, 0, 2, 23, 2001) ,'pisaksen@hotmail.com' ,'Peter Isaksen')
      ,array(mktime(0, 0, 0, 6, 7, 2001) ,'shark@sbox.tu-graz.ac.at' ,'Reinhard Hainisch')
      ,array(mktime(0, 0, 0, 10, 14, 2001) ,'dodger@cannabismail.com' ,'moi même'))
,array(array(mktime(0, 0, 0, 10, 21, 2000) ,'TodPalin@dial.pipex.com' ,"'TodPalin'"))
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest15'
,'Bad brushes'
,"The error that comes up in Quake 2 when i load my map is: \"ERROR: Map has too many surfaces\" or in r1q2: \"Cmod_loadsurfaces: Map has too many surfaces\"<br>
 So i went looking brush by brush (only 1500+ mind you) and came across one particular brush that had 1000's of faces on one side weirdly enough, deleted that brush and vola! The error is gone and I can open my map up just fine in Quake 2."
,"well, and, for the future, it would be nice to know how to find this thousands-of-faces brush... so people don't waste their time looking at the brushes one by one..."
,array(array(mktime(0, 0, 0, 8, 14, 2007) ,'' ,'symphonic')
      ,array(mktime(0, 0, 0, 8, 14, 2007) ,'mkurpel@gmail.com' ,'Mek'))
,NULL
,NULL
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest16'
,'Memopad for notes'
,'...' #https://quark.sourceforge.io/forums/index.php?topic=1086.msg5824#msg5824
,'Adding a text box, where you can use it as a notepad, within Quark. Yes, a memo-pad inside the editor. Like the little info book you see in Quark.'
,array(array(mktime(0, 0, 0, 10, 3, 2015) ,'' ,'roarke'))
,NULL
,NULL
,NULL
,0
,NULL);

$SuggestedPlugins[] = new cSuggestedPlugin(
 'suggest17'
,'Userfriendly VMF id support'
,'...' #https://quark.sourceforge.io/forums/index.php?topic=1221.msg6681
,"HL2's .vmf file have a system of id's, where you can refer to a worldspawn, entity, solid, or face by its id-specific. Setting these all by hand is cumbersome, and it would be nice if there were some dialog boxes, drawn arrows, etc. to help out."
,array(array(mktime(0, 0, 0, 6, 22, 2020) ,'' ,'kodan50'))
,NULL
,NULL
,NULL
,0
,NULL);

?>
