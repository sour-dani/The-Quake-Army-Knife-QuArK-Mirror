<?php

class cCredits
{
	var $Name;        # Name of the person
	var $Description; # Description of the contribution(s) made by this person

	function __construct($aName, $aPersonID=-1, $aDescription=NULL)
	{
		$this->Name        = $aName;
		$this->PersonID    = $aPersonID;
		$this->Description = $aDescription;
	}
}

global $Credits;
$Credits = array();
$Credits[] = new cCredits("Armin Rigo",0,"...for creating this <i>ultra cool</i> program that we all love.");
$Credits[] = new cCredits("Derrick McKay",1,"...for creating the official QuArK Home Page and comments and help for Quake Map (the former QuArK) up to versions 4.xx, when he had to leave the Quake community.");
$Credits[] = new cCredits("Bent P. Svendsen [Decker]",3,"...for supporting QuArK by releasing a lot of add-ons, such as new monsters. He helped a lot in QuArK's early times. More recently, he also sorted Quake 2 textures and did most of the Half-Life add-on.");
$Credits[] = new cCredits("Avery [tiglari] Andrews",4,"...for having organized Hexen II textures and entities into groups as well as creating many of the updated versions plugin and root functions.");
$Credits[] = new cCredits("Andy Vincent",7,"...for various new features and improvement.");
$Credits[] = new cCredits("Alexander Haarer",8,"...for building in Half-Life 2 support.");
$Credits[] = new cCredits("Rowdy",9,"...for working on Doom 3 support.");
$Credits[] = new cCredits("Fredrick [Fred] Vamstad",10,"...for C++ and Technical Support, program fixes, releases and Installer scripts, Core Security issues and updates, hardware and Operating Systems analyses and recommendations as well as many other highly technical areas.");
$Credits[] = new cCredits("Robert [cdunde] Jarrett",5,"...for learning Python and creating additional plugin functions, updating and linking the Infobase documentation, creating new toolbars, view scaling and axis view icons, updating game addon model features.");
$Credits[] = new cCredits("Dudley Bryan Jr. [Gryphon]",2,"...for previously running the Official QuArK Homepage and trying to be generally helpful in whatever way he can.");
$Credits[] = new cCredits("Mike Melzer",11,"...for writing and updating a large part of the original documentation.");
$Credits[] = new cCredits("Steve [Sturm]",12,"...for having provided the previous home page for QuakeMap (the former QuArK).");
$Credits[] = new cCredits("Christophe Weibel",13,"...for having organized Quake textures into groups.");
$Credits[] = new cCredits("Kasper Kystol Andersen [SpaceDog]",14,"...for having organized Q1 and Q2 textures and entities for QuArK 5.");
$Credits[] = new cCredits("Brian Wagener",15,"...for helping to review Q1 entities and textures.");
$Credits[] = new cCredits("Akuma",16,"...for lots of help and invaluable support. Also worked on Q2 support. On the list of longtime QuArK contributors.");
$Credits[] = new cCredits("Leonard [paniq] Ritter",17,"...for the KICK ASS new icons and art-work for QuArK version 5!");
$Credits[] = new cCredits("Chen Ken",18,"...for his freeware Delphi component \"MarsCaption\", offering QuArK its colorful caption bars.");
$Credits[] = new cCredits("Jordan Russell",19,"...for his freeware component suite Toolbar97. The docking toolbars are done with his code.");
$Credits[] = new cCredits("Robert",20,"...for completing Hexen II support with .mdl file names, so that models can be displayed in the 3D views. Robert and Tiglari did this almost at the same time! Sorry Tiglari, I finally choose Robert's version.");
$Credits[] = new cCredits("Scott",21,"...for additional help on Hexen II textures.");
$Credits[] = new cCredits("Richard Hatch",22,"...for his review of Quake 2 entities.");
$Credits[] = new cCredits("Taufik Purnomosidi",23,"...for always being closeby with regards to QuArK.");
$Credits[] = new cCredits("Patrick Steele",24,"...for the recent developments of QuArK. Patrick, Paniq and Tim beta-tested QuArK 5.1.");
$Credits[] = new cCredits("Eoghan Murray",25,"...for tons of suggestions.");
$Credits[] = new cCredits("Dariusz Emilianowicz",26,"...for being the Polish QuArK antenna. He made a lot of comments. He also did H2 textures sorting.");
$Credits[] = new cCredits("Denis Dratov",27,"...for making the Compass, VBar and ZoomBar images for 5.0.c4.");
$Credits[] = new cCredits("`eNtiTy",28,"...for preferring QuArK 4.07 over 5, and supplying Armin with &quot;won't give up!&quot; angst!");
$Credits[] = new cCredits("Tim Smith",29,"...for lending incredible help for QuArK 5. He is a programmer, and without even having access to the source code, he located many many bugs! He fixed tons of Python problems and designed several complete plug-ins.");
$Credits[] = new cCredits("PuG",59, "...for being the forum webmaster when we were located at his dark-forge website.");
$Credits[] = new cCredits("DanielPharos [Dancing Dan]",6,"...for fixes and improvements all over the place and keeping QuArK 6.5 alive, and for currently being QuArK's Home Page webmaster.");
$Credits[] = new cCredits("Jimmy [Gregor] McKinney",30,"...for helping to give this wonderful program its name; QuArK.");
$Credits[] = new cCredits("X7[Q2C]",31,"...for adding a lot of nice stuff in the Python files, and adding and updating a lot of addons.");
$Credits[] = new cCredits("gvm",137,"...for helping track down and fix a lot of annoying bugs.");
$Credits[] = new cCredits("crystallize",139,"...for helping track down and fix even more annoying bugs.");
$Credits[] = new cCredits("All the donators",-1,"...for making us able to get all the latest games, and keeping us going.");
$Credits[] = new cCredits("Everyone",-1,"...who wrote Armin with comments and bug reports.<br>...and anyone <i><b>missed</b></i> on this list, but not unappreciated!");

?>
