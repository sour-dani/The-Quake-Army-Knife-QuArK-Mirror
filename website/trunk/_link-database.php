<?php

class cLinkGroup
{
	var $Name;  # The name of this group of links
	var $Tag;   # The HTML anchor-tag used for this group
	var $Links; # An array of all the links

	function __construct($aName, $aTag, $aLinks)
	{
		$this->Name  = $aName;
		$this->Tag   = $aTag;
		$this->Links = $aLinks;
	}
}

class cLink
{
	var $Title;       # Title of the webpage
	var $URL;         # URL to the webpage
	var $Description; # Description of the webpage
	var $ArchiveURL;  # URL to archived page (optional)

	function __construct($aTitle, $aURL, $aDescription=NULL, $aArchiveURL=NULL)
	{
		$this->Title       = $aTitle;
		$this->URL         = $aURL;
		$this->Description = $aDescription;
		$this->ArchiveURL  = $aArchiveURL;
	}

	function getURL()
	{
		if (is_null($this->ArchiveURL))
			return $this->URL;
		return $this->ArchiveURL;
	}
}

global $LinksGeneric;
$LinksGeneric = array();
$LinksGeneric[] = new cLinkGroup('Community', NULL, array(
           new cLink('The Quake ClanRing', 'http://www.mpog.com/clanring/', NULL, 'https://web.archive.org/web/20021004011401/http://www.mpog.com/clanring/')
          ,new cLink('ClanRing Xtended Mod', 'https://crxquake.com/', 'CRx can be considered an extended version of CRMod.')
          ,new cLink('Clanring CRMod', 'http://crmod.com/', 'ClanRing Mod')
          ,new cLink('Quake Domain', 'http://www.gameaholic.com/', 'Complete source of information about computer games.  News, cheats, help, FAQs, thousands of downloadaable files: demos, extra levels and patches, skins and much more.', 'https://web.archive.org/web/20180729013744/http://www.gameaholic.com/')
          ,new cLink('Frag dot Com', 'http://frag.com/', 'Your 3D Action Gaming Center', 'https://web.archive.org/web/20000302033138/http://frag.com/')
           ));

$LinksGeneric[] = new cLinkGroup('Maps', NULL, array(
           new cLink('Map Factory', 'http://www.map-factory.org/', 'The game map database', 'https://web.archive.org/web/20111229224613/http://www.map-factory.org/')
          ,new cLink('The Snarkpit', 'https://www.snarkpit.net/index.php?s=maps', 'The original mapping resource')
//          ,new cLink('Single Player Quake', 'http://hosted.planetquake.gamespy.com/spq/')
//          ,new cLink('Single Player Quake 2', 'http://hosted.planetquake.gamespy.com/spq2/', 'Level Heaven')
          ,new cLink('Quakelevels', 'http://www.quakelevels.com/', NULL, 'https://web.archive.org/web/20070125002013/http://www.quakelevels.com/')
          ,new cLink('Cyber-Rat.com', 'http://www.cyber-rat.com/', 'Half-Life maps and more', 'https://web.archive.org/web/20230930092430/http://cyber-rat.com/')
          ,new cLink('Call of Duty Maps', 'https://callofdutymaps.com/')
          ,new cLink('Call of Duty Repo', 'https://callofdutyrepo.com/')
          ,new cLink('3d Mappers', 'https://www.3dmappers.com/', 'The 3d mappers Website is a resource for the Call of Duty community.')
          ,new cLink('CustomapsCoD', 'https://customapscod.com/', 'Maps hosting for the following games Mohaa, CoD, CoD2, CoD4, CoD5, BO3, B1944 and more...')
           ));

$LinksGeneric[] = new cLinkGroup('Modeling', NULL, array(
          new cLink('Misfit Model 3D', 'http://www.misfitcode.com/misfitmodel3d/', 'An OpenGL-based 3D model editor that works with triangle-based models.')
         ,new cLink('qME', 'https://renep.home.xs4all.nl/quakeme/', 'A One-Stop Quake Model Editing solution.')
          ));

$LinksGeneric[] = new cLinkGroup('Prefabs', NULL, array(
//           new cLink("Bubba's Arena Prefabs", 'http://gotdelirium.com/bubba/bubba.planetquake.gamespy.com/prefabmodel.html', "Bubba's Arena Prefabs") //ORIGINAL ADDRESS: http://bubba.planetquake.gamespy.com/prefabmodel.html
           new cLink('CGTrader', 'https://www.cgtrader.com/free-3d-models', 'Free 3D models for CG digital design and artwork')
//          ,new cLink('ChopShop', 'http://www.planetquake.com/chopshop')
          ,new cLink('GameBanana', 'https://gamebanana.com/prefabs', 'The Game Modding Community') #http://www.fpsbanana.com/prefabs #FPSBanana
//          ,new cLink('Gamedesign', 'http://prefabs.gamedesign.net/', 'Your source for any and all prefabs.')
          ,new cLink('Polycount', 'https://www.polycount.com/', 'videogame art resource & community') //OLD ADDRESS: http://www.planetquake.com/polycount
//          ,new cLink('Quake Prefab park', 'http://www.planetquake.com/qpp/')
          ,new cLink('TurboSquid', 'https://www.turbosquid.com/3d')
           ));

$LinksGeneric[] = new cLinkGroup('Resources', NULL, array(
           new cLink('idDevNet', 'https://iddevnet.com/', NULL, 'https://web.archive.org/web/20210119152054/https://iddevnet.com/')
          ,new cLink("Quake Developer's Pages", 'https://www.gamers.org/dEngine/quake/')
          ,new cLink('QuakeDev.com', 'http://www.quakedev.com/', 'The home of Quake development!', 'https://web.archive.org/web/20111007084113/http://www.quakedev.com/')
          ,new cLink('QuakeUnity.com', 'http://www.quakeunity.com/', 'Uniting The QUAKE Universe', 'https://web.archive.org/web/20151121114500/http://www.quakeunity.com/')
          ,new cLink('Quake Wiki', 'https://www.quakewiki.net/', 'Plain Ol&#039; Quake Bits and Bobs')
          ,new cLink('RavenFiles.com', 'http://www.ravenfiles.com/', 'official filesite of the RavenGames Network', 'https://web.archive.org/web/20091220231055/http://www.ravenfiles.com/')
          ,new cLink('The Archive', 'http://editingarchive.com/', 'Welcome to The Archive!', 'https://web.archive.org/web/20080912154848/http://editingarchive.com/viewsection.php?section=Half-Life&amp;topic=Mapping')
          ,new cLink('Luigi Auriemma - Research', 'https://aluigi.org/papers.htm', 'Various research stuff for various software: algorithms, protocols, formats, documentation and more')
          ,new cLink('MrElusive - Old Projects', 'https://mrelusive.com/oldprojects/index.html')
          ,new cLink("Leroy's World", 'http://leroyw.byethost15.com/')
          ,new cLink('Valve Developer Union', 'https://valvedev.info/', 'A site dedicated to preserving tools and information about modding the Quake, GoldSrc, and Source engines.')
          ,new cLink('Source Modding', 'https://www.sourcemodding.com/', "Discover tutorials covering how to develop for Valve's Half-Life SDK (GoldSrc), Source SDK, Game Authoring Tools and the recently released Half-Life: Alyx Workshop Tools.")
           ));

$LinksGeneric[] = new cLinkGroup('Sounds', NULL, array(
          new cLink('Freesound', 'https://freesound.org/', 'Freesound is a collaborative database of Creative Commons Licensed sounds.')
         ,new cLink('SoundBible', 'https://soundbible.com/', 'SoundBible.com offers free sound clips for download in either wav or mp3 format.')
         ,new cLink('ZapSplat', 'https://www.zapsplat.com/', 'Free sound effects & royalty free music')
         ,new cLink('Partners In Rhyme', 'https://www.partnersinrhyme.com/', 'Partners In Rhyme has been delivering royalty free music online since 1996.')
          ));

$LinksGeneric[] = new cLinkGroup('Textures', NULL, array(
//           new cLink('The Wadfather', 'http://www.planethalflife.com/wadfather', 'Graphics for Game Developers')
//          ,new cLink("The Serpent Lord's Quake Textures", 'http://www.planetquake.com/gg/textures/', NULL)
           new cLink('Wally', 'http://www.telefragged.com/wally/', 'The freeware texture editing program', 'https://web.archive.org/web/20110920022211/http://www.telefragged.com/wally/')
          ,new cLink('TextureHub', 'http://www.texturehub.net/', 'The Hub of Gamegraphics', 'https://web.archive.org/web/20120111195020/http://www.texturehub.net/')
          ,new cLink('TexMex', 'http://texmex.planetquake.gamespy.com/', "There's no better way to manage your Quake textures!", 'https://www.quakewiki.net/archives/texmex/')
          ,new cLink('Signs of Koth - Quake 1 Textures', 'http://kell.quaddicted.com/q1textures.html', NULL, 'https://www.quaddicted.com/webarchive/kell.quaddicted.com/q1textures.html')
          ,new cLink('textures.com', 'https://www.textures.com/', 'Formerly CGTextures.com') #cgtextures.com
          ,new cLink('Ben Cloward - Technical Artist | Resources - Texture Archive', 'http://www.bencloward.com/resources_textures.shtml', 'An archive of free texture maps for use in 3D animation.')
//          ,new cLink('Free Stock Textures', 'https://freestocktextures.com/')
//          ,new cLink('Free Textures', 'https://everytexture.com/')
//          ,new cLink('My Free Textures', 'https://www.myfreetextures.com/')
          ,new cLink("Mayang's Free Textures Library", 'http://www.mayang.com/textures/', 'Our texture library has over 4350 free to download, high-resolution textures.', 'https://web.archive.org/web/20170414093508/http://www.mayang.com/textures/')
//http://www.fpsbanana.com/textures
//https://www.17buddies.rocks/17b2/View/Wads/Gam/1/All/Pag/1/textures_Half-Life.html
           ));

$LinksGeneric[] = new cLinkGroup('Utilities', NULL, array(
           new cLink('Dragon UnPACKer', 'https://www.elberethzone.net/en/dragon-unpacker.html', 'Free/Open source game file resource explorer/unpacking tool made easy!') #Old: http://dragonunpacker.sourceforge.net/
//          ,new cLink('ArghRad', 'http://arghrad.planetquake.gamespy.com/', 'Radiosityland - Home of ArghRad')
//          ,new cLink('Terrain Generator', 'http://www.planetquake.com/estudio')
          ,new cLink("Nem's Tools", 'http://nemesis.thewavelength.net/', "Nem's Half-Life and Half-Life 2 editing tools.", 'https://web.archive.org/web/20191202151405/http://nemesis.thewavelength.net/')
          ,new cLink("Cannonfodder's Half-Life 2 Site", 'https://www.chaosincarnate.net/cannonfodder/cftools.htm')
          ,new cLink('Q3A Shader Editor', 'http://www.bpeers.com/software/q3ase/', 'This tool will parse a script and present it as a Windows GUI which is easier to understand and navigate than the bare C-like text files.', 'https://web.archive.org/web/20161122073424/http://bpeers.com/software/q3ase/')
          ,new cLink('Gabriel Knight 3 BSP Converter', 'https://fwheel.net/gk3/gk3mod2obj/bsp2obj.html', 'The GK3 BSP Converter lets you convert the .BSP files into more usable .OBJ files.')
          ,new cLink('Big Brother Bot B3', 'http://www.bigbrotherbot.net/', 'Big Brother Bot (B3) is a complete and total server administration package for online games.', 'https://web.archive.org/web/20160105174834/http://www.bigbrotherbot.net/')
          ,new cLink('QuakeViewer', 'https://sourceforge.net/projects/quakeviewer/', 'QuakeViewer is a Windows application that enables you to freely navigate inside maps of games.')
           ));

# The Tag of the LinkGroup MUST be the same to the GameID of the game it is for!

global $LinksGame;
$LinksGame = array();
$LinksGame[] = new cLinkGroup('6DX', '6DX', array(
           new cLink('6DX 3D Engine', 'https://sourceforge.net/project/showfiles.php?group_id=88307')
          ,new cLink('6DX demo views', 'https://www.aaa-multimedia.com/6dx.htm')
          ,new cLink('AAA multimedia', 'https://www.aaa-multimedia.com/aaacms/index.php?module=pnForum&amp;viewcat=2')
           ));

/*$LinksGame[] = new cLinkGroup('Anachronox', 'AN', array(
           new cLink('PlanetAnachronox', 'http://www.planetanachronox.com/', 'The Official Community Site and best place to get what you need on your journey to save the universe from ultimate destruction.')
           ));*/

$LinksGame[] = new cLinkGroup('Call of Duty', 'CoD', array(
//           new cLink('Planet CoD', 'http://planetcallofduty.gamespy.com/')
//          ,new cLink('Call of Duty FileFront', 'http://callofduty.filefront.com/')
           new cLink('Call of Duty Resource', 'http://www.codresource.com/', 'Supplying you with all your COD needs and more', 'https://web.archive.org/web/20081226123040/http://www.codresource.com/')
          ,new cLink('Call of Duty Addicts', 'http://www.codaddicts.com/', NULL, 'https://web.archive.org/web/20140702171009/http://www.codaddicts.com/')
           ));

$LinksGame[] = new cLinkGroup('Call of Duty 4', 'CoD4', array(
           new cLink('Call of Duty 4 Forums', 'http://cod4boards.com/', NULL, 'https://web.archive.org/web/20120626064648/http://www.cod4boards.com/')
//          ,new cLink('Call of Duty Forums', 'http://www.thecodforums.com/', NULL, 'https://web.archive.org/web/20130901132304/http://www.thecodforums.com/') //Is actually: www.cod4boards.com
           ));

$LinksGame[] = new cLinkGroup('Call of Duty: Modern Warfare 2', 'CoD6', array(
           new cLink('The Modern Warfare 2', 'http://www.themodernwarfare2.com/', 'Your Call of Duty Modern Warfare 2 Source')
           ));

$LinksGame[] = new cLinkGroup('Counter-Strike', 'CS', array(
           new cLink('Counter-Map', 'http://countermap2.com/', 'Your complete Counter-Strike mapping resource center.', 'https://web.archive.org/web/20210228175634/http://countermap2.com/')
          ,new cLink('Steamless CS Project', 'https://steamlessproject.nl/', 'Covering the Future of WON')
          ,new cLink('CS-Nation', 'http://csnation.net/content.php?119-cs-nation', 'Covering the future of Counter Strike', 'https://web.archive.org/web/20120408062936/http://csnation.net/content.php?119-cs-nation') #http://www.csnation.net/ #http://csnation.totalgamingnetwork.com/
          ,new cLink('Counter-Strike.com', 'http://www.counter-strike.com/', 'Play the difference', 'https://web.archive.org/web/20170808122440/http://www.counter-strike.com/')
           ));

$LinksGame[] = new cLinkGroup('Counter-Strike: Source', 'CSS', array(
           new cLink('Counter Strike Source', 'http://www.counterstrikesource.com/', 'Counter-Strike News and Forums', 'https://web.archive.org/web/20210411074221/http://www.counterstrikesource.com/')
          ,new cLink('Counter-Strike.com', 'http://www.counter-strike.com/', 'Play the difference', 'https://web.archive.org/web/20170808122440/http://www.counter-strike.com/')
//          ,new cLink('L4Y', 'http://css.levels4you.com/')
           ));

$LinksGame[] = new cLinkGroup('Crystal Space', 'CrSp', array(
           new cLink('Crystal Space material', 'https://www.angelfire.com/empire/legatus/', 'This page is for Crystal Space related material.')
           ));

$LinksGame[] = new cLinkGroup('Daikatana', 'DK', array(
           new cLink('Daikatana 1.3 Project', 'https://github.com/maraakate/daikatana', 'This is a bugfixed Version of Daikatana for Windows, Linux and FreeBSD') #https://bitbucket.org/DGibson/daikatana-1.3/wiki/Home #https://bitbucket.org/daikatana13/daikatana
          ,new cLink('Daikatana Restoration Project', 'https://github.com/atsb/daikatana-restoration-project', 'Daikatana restoration aiming to have a clean 1.2 source and to support modern systems.')
//          ,new cLink('Planet Daikatana', 'http://www.planetdaikatana.com/')
          ,new cLink('DaikatanaNews.net', 'http://www.daikatananews.net/', 'the number one source of Daikatana news')
           ));

$LinksGame[] = new cLinkGroup('Day of Defeat', 'DAY', array(
           new cLink('dodbits.com', 'http://www.dodbits.com/', 'Custom Stuff for Day of Defeat and Source games.')
          ,new cLink('Sturmbot.org', 'http://sturmbot.org/', 'Single player mode for Day of Defeat')
           ));

$LinksGame[] = new cLinkGroup('Doom 3', 'DM3', array(
//           new cLink('Planet Doom', 'http://planetdoom.gamespy.com/')
           new cLink('Doom3 World', 'http://www.doom3world.org/index.php?milkme=list_entity&amp;order=abc&amp;letter=d', 'The idtech4 / idtech5 resource', 'https://web.archive.org/web/20140208065204/http://www.doom3world.org/index.php')
//          ,new cLink('Doom 3 FileFront', 'http://doom3.filefront.com/')
          ,new cLink('Doom 3 Portal', 'https://www.doom3portal.com/', 'news and information for Doom 3 and Doom 4')
          ,new cLink('D3HQ.com', 'http://www.d3hq.com/', 'Your No.1 Source for Doom 3 and Doom 4', 'https://web.archive.org/web/20120307234017/http://www.d3hq.com/')
//          ,new cLink('L4Y', 'http://doom3.levels4you.com/')
          ,new cLink('dhewm3', 'https://dhewm3.org/', 'dhewm3 is a source port of the original Doom3')
          ,new cLink('Opencoop', 'https://www.moddb.com/mods/opencoop', 'OpenCoop is a cooperative multiplayer modification for Doom 3.') #http://www.d3opencoop.com/
          ,new cLink('Endarchy / Industri', 'https://endarchy.com/', 'Being re-built (again) on the Doom 3 engine')
          ,new cLink('Doom 3: Phobos', 'https://www.moddb.com/mods/phobos', 'Phobos: A different kind of old school') #http://www.tfuture.org/phobos
          ,new cLink('Hexen: Edge of Chaos', 'http://hexenmod.net/', 'A free game based on the id Tech 4 GPL Engine', 'https://web.archive.org/web/20190814192952/http://hexenmod.net/')
           ));

//RBDOOM-3-BFG
//https://github.com/RobertBeckebans/RBDOOM-3-BFG/
//RBDOOM-3-BFG is a modernization effort of DOOM-3-BFG.

$LinksGame[] = new cLinkGroup('Genesis 3D', 'G3D', array(
           new cLink('Genesis3D World Editor 2.0', 'http://www.michaelbrumm.com/genesis3dworldeditor2.html', 'Resurrection and Redemption of the original Genesis3D World Editor shipped with the Genesis3D 1.1 SDK', 'https://web.archive.org/web/20110918104129/http://www.michaelbrumm.com/genesis3dworldeditor2.html')
           ));

$LinksGame[] = new cLinkGroup('Half-Life', 'HL', array(
//           new cLink('Valve ERC', 'http://www.valve-erc.com/')
//           new cLink('VERC Collective', 'http://collective.valve-erc.com/')
//          ,new cLink('Half-Life ERC', 'http://halflife.gamedesign.net/')
           new cLink("H.V.'s Almanac", 'http://www.karljones.com/halflife/almanac.asp', "This is the old Handy Vandal's Almanac for Half-Life.", 'https://web.archive.org/web/20041204114603/http://www.karljones.com/halflife/almanac.asp')
          ,new cLink('BugfixedHL', 'http://aghl.ru/forum/viewtopic.php?f=32&amp;t=686', 'Bugfixed and improved HL release') #https://github.com/LevShisterov/BugfixedHL
//          ,new cLink('Planet Half-Life', 'http://planethalflife.gamespy.com/', "the Handy Vandal's Almanac")
//          ,new cLink('Half-Life Files', 'http://halflife2.filefront.com/')
//          ,new cLink('Crosshair Central', 'http://www.planethalflife.com/cc')
//          ,new cLink('ERR', 'http://www.planethalflife.com/err')
          ,new cLink('69th Vlatitude', 'http://www.vlatitude.com/', 'Our goal is to provide you with detailed, comprehensive lessons in mapping.', 'https://web.archive.org/web/20090522005012/http://www.vlatitude.com/')
//          ,new cLink('HL Editing Center', 'http://www.halflife.net/hec/')
//          ,new cLink('Wavelength', 'http://www.planethalflife.com/wavelength/') #http://www.contaminated.net/wavelength/
//          ,new cLink('Radium', 'http://www.planethalflife.com/radium')
//          ,new cLink('Radium-TFC', 'http://www.planetfortress.com/radium')
//          ,new cLink("\"Mapping\"", 'http://www.planethalflife.com/mapping')
          ,new cLink('ZHLT documentation', 'http://zhlt.info/', "This is the official documentation reference for Zoner's Half-Life Tools (ZHLT).")
          ,new cLink('Half-Life: Decay', 'https://www.moddb.com/mods/half-life-decay', 'Half-Life: Decay is an add-on included in the PlayStation 2 port of the first-person shooter computer game Half-Life.')
          ,new cLink('Half Life: New Light', 'https://www.moddb.com/mods/half-life-new-light', 'This mod aims to improve Half-Life by improving graphics, gunplay and adding bug fixes.')
          ,new cLink('Half-Life: Restored', 'https://www.moddb.com/mods/restore-life', 'This mod simply restores some of the dropped features from Half-Life.')
          ,new cLink('Metamod', 'http://metamod.org/', 'Metamod is a plugin/DLL manager that sits between the Half-Life Engine and an HL Game mod, allowing the dynamic loading/unloading of mod-like DLL plugins to add functionality to the HL server or game mod.')
          ,new cLink('Metamod-P', 'http://metamod-p.sourceforge.net/', 'Metamod-P is enhanced version of Metamod.')
          ,new cLink('AMX Mod X', 'https://www.amxmodx.org/', 'AMX Mod X is a versatile Half-Life metamod plugin which is targetted toward server administration.')
          ,new cLink('Rho-Bot', 'http://rhobot.sourceforge.net/', 'Rho-Bot is a computer-generated opponent for the Sierra/Valve game Half-Life.')
//          ,new cLink('Half-Life Portal', 'http://www.halflifeportal.com/', 'an extensive Half-Life fansite')
          ,new cLink('The Whole Half-Life', 'https://twhl.info/', 'Level design resources for GoldSource, Source, and beyond') #http://www.twhl.co.za/ #'Half-Life/2 Mapping Tutorials and Resources'
          ,new cLink('Combine OverWiki', 'https://combineoverwiki.net/wiki/Main_Page', 'The original ad-free and independent Half-Life and Portal wiki')
          ,new cLink('Vampire Slayer', 'https://vsmod.co.uk/', 'Vampire Slayer is a multiplayer, team-play modification for Half-Life.')
          ,new cLink('VSUnion.com', 'http://www.vsunion.com/', 'This is a forum about the mod so called Vampire Slayer', 'https://web.archive.org/web/20090124090021/http://www.vsunion.com/')
          ,new cLink('Firearms', 'http://www.firearmsmod.com/', 'Firearms is a realistic modification of the game, that focuses on teamplay with Half-Life gameplay altered to the extreme.', 'https://web.archive.org/web/20090625182731/http://www.firearmsmod.com/')
          ,new cLink('Adrenaline Gamer v6.6', 'https://www.moddb.com/mods/adrenaline-gamer/downloads/adrenaline-gamer-v66', 'Adrenaline Gamer is a full Half-Life Deathmatch replacement mod and is considered to be the OSP mod for Half-Life.')
          ,new cLink('Poke646', 'http://www.poke646.com/', "Poke646 and its sequel Poke646: Vendetta are two of the most ambitious and critically acclaimed singleplayer modifications for Valve's award-winning game Half-Life.")
          ,new cLink('RUN. THINK. SHOOT. LIVE.', 'https://www.runthinkshootlive.com/', 'RUN. THINK. SHOOT. LIVE. lists and reviews single player maps and mods for the Half-Life series of games.')
          ,new cLink('LambdaGeneration', 'http://lambdageneration.com/', 'The Ultimate Half-Life Community')
          ,new cLink('Half-Life Creations', 'http://half-lifecreations.com/', 'Building on 10 years of creativity.')
          ,new cLink('Lambda1VR', 'https://www.lambda1vr.com/', 'Official Page of the Dr Beef Xash mod capable of Playing Half Life 1 on Oculus Quest')
           ));

$LinksGame[] = new cLinkGroup('Half-Life: Source', 'HLS', array(
           new cLink('Half-Life: Source Remastered', 'https://www.moddb.com/mods/half-life-source-remastered', "This mod pack (the mods weren't made by me, but were combined and made to work with each other) is meant to make Half-Life: Source actually good.")
          ,new cLink('Half-Life: Source Fixed', 'https://www.moddb.com/mods/half-life-source-fixed', 'This mod uses the source 2013 base to fix many of the issues present within the base game.')
          ,new cLink('Half-Life: Source Update', 'https://www.moddb.com/mods/half-life-source-update1', 'This project is to finish and polish Half-Life: Source to a shine, to the point where it could be considered to be as good as Half-Life 1.')
           ));

$LinksGame[] = new cLinkGroup('Half-Life 2', 'HL2', array(
//           new cLink("THE HANDY VANDAL'S ALMANAC for HALF-LIFE 2", 'http://www.karljones.com/halflife2/home.asp')
           new cLink('SDK Docs', 'https://developer.valvesoftware.com/wiki/SDK_Docs')
          ,new cLink('Wunderboy', 'https://www.wunderboy.org/', 'game modding for gentle folk')
          ,new cLink('Half-Life2.net', 'http://halflife2.net/', 'Halflife2.net is your complete resource to Half-Life 2 and other Valve Software titles.', 'https://web.archive.org/web/20120307090353/http://halflife2.net/')
          ,new cLink('Half-Life Source', 'http://www.halflifesource.com/', 'Your number one source for Half-Life 2 game community news and radio participation.', 'https://web.archive.org/web/20060202002457/http://www.halflifesource.com/')
          ,new cLink('HL2World', 'http://www.hl2world.com/', "The Internet's #2 Half-Life Community", 'https://web.archive.org/web/20030803115154/http://www.hl2world.com/')
#          ,new cLink('Half-Life Fallout', 'https://www.hlfallout.net/', 'Up-to-the-minute coverage of Half-Life 2')
#          ,new cLink('L4Y', 'http://halflife2.levels4you.com/')
#          ,new cLink('Creative Mapping', 'http://www.creativemapping.nl/') #Website broken + malware-infected!
          ,new cLink('Half-Life 2 : MMod', 'https://www.moddb.com/mods/hl2-ep2-enhased-mod', 'The goal of Half-Life 2 : MMod is to enhance and expand gunplay, combat mechanics and the immersion factor by giving the Player more options and combat opportunities as well as refine how the Player handles his arsenal.')
#          new cLinky('FakeFactory Cinematic Mod', 'https://www.moddb.com/mods/fakefactory-cinematic-mod', 'A graphical / music total conversion of the Half-Life 2 storyline.')
          ,new cLink('GarrysMod.com', 'https://garrysmod.com/', "Garry's Mod is a sandbox mod for the Source Engine.")
          ,new cLink('SRCDS Hardening', 'https://wiki.alliedmods.net/SRCDS_Hardening', 'Note from QuArK Development Team: Please use this website for <u>GOOD</u> purposes, not for BAD-ness!')
#          ,new cLink("Misc:HL2 Exploits - Devicenull's Code", 'http://code.devicenull.org/index.php?title=Misc:HL2_Exploits', 'Note from QuArK Development Team: Please use this website for <u>GOOD</u> stuff, not for BAD stuff!') #Moved (see new entry)
#          ,new cLink('', 'http://www.projectvdc.com/', 'Note from QuArK Development Team: Please use this website for <u>GOOD</u> stuff, not for BAD stuff!')
          ,new cLink('RCBot2', 'https://sourceforge.net/projects/rcbot2/', 'An open source GPL bot framework for HL2 Orange Box Mods ONLY')
#          ,new cLink('Black Mesa', 'https://www.blackmesasource.com/', "Black Mesa is a re-envisioning of Valve Software's classic science fiction first person shooter, Half-Life.")
          ,new cLink('Eclipse', 'https://www.moddb.com/mods/eclipse', "Eclipse is a third-person total conversion of Valve's Half-Life 2.") #http://students.guildhall.smu.edu/~eclipse/
          ,new cLink('Firearms: Source', 'http://firearms-source.com/', 'Firearms: Source is a high adrenaline First Person Shooter that emphasizes precision aiming, high mobility, and team-based strategy.', 'https://web.archive.org/web/20190627215154/http://www.firearms-source.com/')
          ,new cLink('World at War', 'http://www.worldatwarmod.com/', 'A tactical first-person shooter modification, brought to you by the team responsible for Firearms Half-Life',  'https://web.archive.org/web/20090506095252/http://www.worldatwarmod.com/')
          ,new cLink('GoldenEye: Source', 'https://geshl2.com/', "GoldenEye: Source is an online multiplayer arena first-person shooter that aims to provide a faithful recreation of the classic N64 title GoldenEye 007's multiplayer with refined gameplay, high definition graphics and sound.") #http://goldeneyesource.net/
          ,new cLink('MINERVA', 'http://www.hylobatidae.org/minerva/', 'MINERVA, by Adam Foster, takes you to a remote island under the control of Combine forces.')
          ,new cLink('Operation Lambda', 'https://www.moddb.com/mods/operation-lambda') #http://operationlambda.com/
          ,new cLink('RUN. THINK. SHOOT. LIVE.', 'https://www.runthinkshootlive.com/', 'RUN. THINK. SHOOT. LIVE. lists and reviews single player maps and mods for the Half-Life series of games.')
          ,new cLink('LambdaGeneration', 'http://lambdageneration.com/', 'The Ultimate Half-Life Community')
           ));

$LinksGame[] = new cLinkGroup('Half-Life 2: Episode 2', 'HL2EP2', array(
           new cLink('Jabroni Brawl: Episode 3', 'https://www.moddb.com/games/jabroni-brawl-episode-3', 'For idiots, by idiots.')
           ));

$LinksGame[] = new cLinkGroup('Heretic 2', 'Hr2', array(
           new cLink('HereticII.com', 'http://www.hereticii.com')
//          ,new cLink('Planet Heretic', 'http://www.planetheretic.com/')
          ,new cLink("The Mapper's Shrine", 'http://www.raven-games.com/', "The HUB of Raven Software's Gaming Community!", 'https://web.archive.org/web/20150123021732/http://www.raven-games.com/')
          ,new cLink('Eye of Horus - Hr2', 'http://www.hereticii.com/tiglari/', 'Your source for tutorials, information and resources on Heretic 2 entities', 'https://web.archive.org/web/20090322195111/http://www.hereticii.com/tiglari/')
          ,new cLink('Heretic Hides', 'https://sites.google.com/site/heretichides/', 'Skins, Models, Maps & Editing Resources for Heretic II') #http://heretichides.soffiles.com
          ,new cLink('T-Mod', 'http://www.amberstar.de/h2/t-mod.html', 'A multi-purpose modification for Heretic II', 'https://web.archive.org/web/20090331115437/http://www.amberstar.de/h2/t-mod.html')
           ));

$LinksGame[] = new cLinkGroup('Hexen 2', 'Hx2', array(
           new cLink('HeXenWorld', 'http://www.hexenworld.net/', NULL, 'https://web.archive.org/web/20090622042639/http://www.hexenworld.net/')
//          ,new cLink('Eye of Horus - Hx2', 'http://www.hexenworld.net/h2entities/')
//          ,new cLink('The Labyrinth', 'http://www.hexenworld.com/labyrinth/')
          ,new cLink('Hexen II: Hammer of Thyrion', 'http://uhexen2.sourceforge.net/', 'Source port to support Linux, FreeBSD, other unices, Mac OS X & Windows')
//          ,new cLink('HexenWorld Vintage Hosted Sites', 'http://www.raven-games.com/vintage/')
          ,new cLink('Ultimate Quake Engine', 'http://www.korvinkorax.com/resources/downloads/games', NULL, 'https://web.archive.org/web/20130731221322/http://www.corvinstein.com/resources/downloads/games')
          ,new cLink('Shadows Of Chaos standalone', 'https://www.moddb.com/mods/shadows-of-chaos-whirled', 'A mod for Hexen 2 that adds weapon altfires and various balance tweaks, effects, bugfixes, & new features for mappers.')
           ));

$LinksGame[] = new cLinkGroup('James Bond 007: Nightfire', 'JBNF', array(
           new cLink('nightfirepc.com', 'http://nightfirepc.com/', 'This website is an initiative to keep the game running and available for download.')
           ));

$LinksGame[] = new cLinkGroup('Kingpin', 'KP', array(
//           new cLink('Wastelands', 'http://kingpin.qeradiant.com/')
           new cLink('K.D.C. (Kingpin Development Community)', 'http://www.pigwhistler.co.uk/', "Here you'll find all the resources you need to get started with editing Kingpin.", 'https://web.archive.org/web/20030410052109/http://www.pigwhistler.co.uk/')
          ,new cLink('Map Artists', 'http://www.mapartists.com/', NULL, 'https://web.archive.org/web/20010722004038/http://www.mapartists.com/')
          ,new cLink('Kingpin Forever', 'http://kpdownloads.ezewh.com/', NULL, 'https://web.archive.org/web/20161026053104/http://kpdownloads.ezewh.com/') //http://downloads.kingpinforever.com/
          ,new cLink('Kingpin.info', 'https://kingpin.info/', 'News site and archive for everything on Kingpin: Life of Crime (KP)')
          ,new cLink('jjaf.de', 'http://jjaf.de/kingpin/')
          ,new cLink('Kingpin: Life of Crime enhanced graphics v.1', 'https://www.moddb.com/mods/kingpin-life-of-crime-enhanced-graphics/addons/kingpin-life-of-crime-enhanced-graphics-v1', 'OpenGL pseudo-driver that adds some graphical enhancements to OpenGL-based games.')
          ,new cLink('Monkey Mod', 'http://www.monkeymod.com/', NULL, 'https://web.archive.org/web/20030618225126/http://monkeymod.com/')
          ,new cLink('Reactive Kingpin Competition Mod', 'http://www.reactivesoftware.com/projects/kingpin/kingpin.html', NULL, 'https://web.archive.org/web/20020608210052/http://www.reactivesoftware.com/projects/kingpin/kingpin.html')
          ,new cLink('KingpinQ3', 'https://www.kingpinq3.com/', "KingpinQ3 is a clone of Xatrix's Kingpin - Life of Crime.")
          ,new cLink('Power 2', 'http://www.captaindeath.com/kingpin/power2.aspx', "Kingpin: Life of Crime POWER 2 mod is a team based game similar in play to the Unreal Tounament game 'Domination' There are three control points that have to be captured and defended.")
          ,new cLink('Poisonville', 'http://poisonville.com/', NULL, 'https://web.archive.org/web/20010925185354/http://poisonville.com/')
           ));

//http://left4dead.wikia.com/wiki/Left_4_Dead_Wiki

$LinksGame[] = new cLinkGroup('Medal of Honor - Allied Assault', 'MOHAA', array(
//           new cLink('Planet MOH', 'http://planetmedalofhonor.gamespy.com/')
           new cLink('The Modding Theater', 'http://www.modtheater.com/', 'changing the way you play', 'https://web.archive.org/web/20170929071946/http://www.modtheater.com/')
          ,new cLink('MOH Files', 'http://www.mohfiles.com/', NULL, 'https://web.archive.org/web/20040526161116/http://www.mohfiles.com/')
          ,new cLink('HaZardModding Coop: Medal of Honor', 'https://www.moddb.com/mods/medal-of-honor-coop-hazardmodding', 'This is high quality Coop Mod for Medal of Honor War Chest. It allows you to play Medal of Honor War Chest Singleplayer Campaign cooperatively.')
          ,new cLink('OpenMoHAA', 'http://openmohaa.sourceforge.net/', 'a free game engine capable of running Medal of Honor: Allied Assault contents')
          ,new cLink('MOHAA Reunited', 'https://www.mohaareunited.com/', 'MOHAA Reunited is a site dedicated to Medal Of Honor: Allied Assault')
           ));

$LinksGame[] = new cLinkGroup('Medal of Honor - Pacific Assault', 'MOHPA', array(
           new cLink('PAPub.com Pacific Assault Maps', 'http://www.papub.com/', 'Home of the PA Mapper', 'https://web.archive.org/web/20050509080155/http://www.papub.com/')
           ));

$LinksGame[] = new cLinkGroup('Neverball', 'NB', array(
           new cLink('Neverforum', 'http://forum.nevercorner.net/', 'A nice forum to talk about Neverball and Nevertable', 'https://web.archive.org/web/20160205061230/http://forum.nevercorner.net/')
          ,new cLink('Neverwiki', 'http://wiki.nevercorner.net/', 'Your source for community-driven Neverball/Neverputt information!', 'https://web.archive.org/web/20151122134450/http://wiki.nevercorner.net/doku.php')
           ));

$LinksGame[] = new cLinkGroup('Nexuiz', 'NEX', array(
           new cLink('RocketMinsta ', 'https://github.com/dsmit/RocketMinsta', 'A major Nexuiz 2.5.2 mod') #https://nexakari.github.com/RocketMinsta/
           ));

$LinksGame[] = new cLinkGroup('Portal', 'P', array(
//           new cLink('L4Y - Portal', 'http://portal.levels4you.com/')
           new cLink('Portal Unofficial Wiki', 'https://theportalwiki.com/wiki/')
           ));

$LinksGame[] = new cLinkGroup('Quake 1', 'Q1', array(
           new cLink('Planet Quake - Quake 1', 'http://planetquake.gamespy.com/quake1/index.html')
          ,new cLink('Quake Unofficial Remastered', 'https://www.moddb.com/games/quake/downloads/quake-unofficial-remastered', 'This is a fully configured upgrade wherein the engine limits are removed, the proper support for widescreen resolutions is added and the animations are made smooth.')
          ,new cLink('Quake Terminus', 'https://www.quaketerminus.com/', 'A repository of Quake 1 mods, movies, tools, demos and other Quake artifacts.')
          ,new cLink('QuakeOne', 'http://quakeone.com/')
          ,new cLink("Bengt Jardrup's page", 'http://bjp.fov120.com/', 'The Homepage of Bengt Jardrup') //http://user.tninet.se/~xir870k/ //web.comhem.se/bjp/?
          ,new cLink('Disenchant.Net', 'https://disenchant.net/')
          ,new cLink('Qreate', 'https://sourceforge.net/projects/qreate/', 'Qreate allows you to spawn pretty much all the entities made available to use when making a map, but here you can place them in real-time.')
//         new cLink('QuakeLab', 'http://www.planetquake.com/quakelab', 'Level Editing Resource for id Software's Quake 1')
          ,new cLink('Quaddicted.com', 'https://www.quaddicted.com/', 'Browse and download all known and preserved Quake Singleplayer Maps.')
          ,new cLink('DarkPlaces', 'http://icculus.org/twilight/darkplaces/', "LordHavoc's DarkPlaces Quake Modification")
          ,new cLink('Tenebrae', 'http://tenebrae.sourceforge.net/', 'Tenebrae is a modification of the quake source that adds stencil shadows and per pixel lights to quake.')
          ,new cLink('Quake "Epsilon" Build', 'https://www.moddb.com/mods/quake-epsilon-build', 'Quake Epsilon is a graphically enhanced build of Quake 1 for Windows/Linux/Mac.')
          ,new cLink('Fitzquake', 'https://www.celephais.net/fitzquake/', 'Fitzquake is a modified glquake based on the source code released by id Software.')
          ,new cLink('QuakeSpasm', 'http://quakespasm.sourceforge.net/', 'QuakeSpasm is a *Nix friendly Quake Engine based on the SDL port of the popular FitzQuake.') //https://sourceforge.net/projects/quakespasm/
          ,new cLink('Ironwail', 'https://github.com/andrei-drexler/ironwail', 'High-performance QuakeSpasm fork')
          ,new cLink('Open Quartz', 'https://openquartz.sourceforge.net/', "Open Quartz is a project to supply GPL'ed artwork in the form of PAK and WAD files to create a fully GPL game based around the GPL'ed quake sourcecode.") //Or: https://sourceforge.net/projects/openquartz/
          ,new cLink('LibreQuake', 'https://github.com/MissLavender-LQ/LibreQuake', 'The LibreQuake project aims to create a complete, free content first-person shooter game.')
          ,new cLink('vkQuake', 'https://github.com/Novum/vkQuake', "vkQuake is a port of id Software's Quake using Vulkan instead of OpenGL for rendering.")
          ,new cLink('Quake: Ray Traced', 'https://github.com/sultim-t/vkquake-rt', "Quake: Ray Traced adds a path tracing renderer to id Software's Quake using the RayTracedGL1 library.")
          //,new cLink('OQPlus', 'http://openarena.ws/fsfps/oqplus.html', 'OQPlus is a Free Content project for the Q**k* GPL source licensed under the GNU GPL v2.') //leilei is banned
          ,new cLink('ezQuake', 'http://www.ezquake.com/', 'A modern QuakeWorld client focused on competitive online play.') //https://ezquake.github.io/
          ,new cLink('QuakeForge', 'http://www.quakeforge.net/', 'Our purpose is to improve the state of the game by improving the engine, making a good base for game and engine modifications, and making it accessible to the largest number of players we can.')
          ,new cLink('Copper', 'http://www.lunaran.com/copper/', "A single-player refinement mod for id software's QUAKE.")
//          ,new cLink('Quake Addicts', 'http://www.quakeaddicts.com/', 'All Things Quake')
          ,new cLink('Quaketastic', 'http://www.quaketastic.com/', 'A file depository for Quake 1 maps and mods and other related files.')
//          ,new cLink('Inside3D', 'http://www.inside3d.com/', 'Dedicated to helping you learn how to modify your favorite games!')
//          ,new cLink('Inside QC', 'http://www.insideqc.com/', 'Knowledge is Power!')
          ,new cLink('Rune Quake', 'http://www.runequake.com/', 'Rune Quake is a QuakeC modification for Quake and Quakeworld.')
          ,new cLink('Signs of Koth', 'https://www.quaddicted.com/webarchive/kell.quaddicted.com/', 'Quoth - Part Two')
          ,new cLink('The Quake Stomping Grounds', 'http://www.stomped.com', "The web's premier Quake site, dedicated to providing the hottest news, the most in demand software, and the biggest hype to Quake players around the world!", 'https://web.archive.org/web/20031013132652/http://www.stomped.com/')
          ,new cLink('FortressOne', 'https://www.fortressone.org/', 'Quake Team Fortress Remastered')
          ,new cLink("Slayer's Testaments", 'https://www.moddb.com/mods/slayers-testament', 'Recreating the newschool Doom experience in the old quake engine.')
           ));

$LinksGame[] = new cLinkGroup('Quake 2', 'Q2', array(
           new cLink('Planet Quake - Quake 2', 'http://planetquake.gamespy.com/quake2/index.html')
//           new cLink('Rust Quake-2 tutorials', 'http://www.gamedesign.net/quake2/quake2tutorials.shtml')
          ,new cLink('Quake 2 Unofficial Remastered', 'https://www.moddb.com/games/quake-2/downloads/quake-2-unofficial-remastered', 'This is a fully configured upgrade wherein the engine limits are removed and the support for widescreen resolutions is added.')
          ,new cLink("Peter Brett's Build Tools", 'http://peter-b.co.uk/software/index.html')
          ,new cLink('Quake2.com', 'http://www.quake2.com/', 'The Ultimate Quake 2 Site')
          ,new cLink('Q2PRO', 'https://skuller.net/q2pro/', 'Q2PRO is an enhanced Quake 2 client and server for Windows and Linux.')
          ,new cLink('Quake II Servers', 'http://q2servers.com/')
//          ,new cLink('Lazarus', 'http://lazarus.planetquake.gamespy.com/', 'Lazarus Quake2 Modification') #http://www.planetquake.com/lazarus/
          ,new cLink('Q2 LNX stuff', 'http://icculus.org/quake2/')
          ,new cLink('The Quake 2 Café', 'http://leray.proboards.com/', 'Home of Clan Q2C - Dedicated To The Creation Of New Q2 Maps!')
          ,new cLink('Action Quake2', 'http://aq2.action-web.net/', 'All the speed and fun of your favorite action movie, without the cost of a ticket!!', 'https://web.archive.org/web/20050214113453/http://aq2.action-web.net/')
          ,new cLink('Action Gear', 'http://marlporo.pp.fi/aq2/index.html', 'The AQ2 Accessories Archive')
          ,new cLink('QUAKE2 Max v.44 Graphics Engine ', 'https://www.moddb.com/downloads/quake2-max-v44-graphics-engine', 'This is another Graphic Engine to play with. This Engine increases the gore and the visual effects of the game.')
          ,new cLink("R1CH's OpenGL Renderer for Quake II", 'http://www.r1ch.net/stuff/r1gl/')
          ,new cLink('R1Q2 - R1CHs Enhanced Quake II Client/Server', 'http://www.r1ch.net/stuff/r1q2/')
//          ,new cLink("Mark Shan's Quake 2 Site", 'http://www.markshan.com/') #Yeah, linking to KMQ2 directly:
          ,new cLink('KMQuake II', 'http://www.markshan.com/knightmare/')
          ,new cLink('Quake II Evolved', 'https://quake2.gamebanana.com/gamefiles/1283', 'Quake II Evolved is a high end graphical update to id Softwares Quake 2') #quake2evolved.com
          ,new cLink('Quake II xp', 'http://quake2xp.sourceforge.net/', 'QuakeIIxp is a multi-platform (Windows, Linux and FreeBSD (experimental)) graphics port of the game Quake II developed by Id Software.')
          ,new cLink('Yamagi Quake II', 'http://www.yamagi.org/quake2/', "Yamagi Quake II is an enhanced client for id Software's Quake II.")
          ,new cLink('Dawn of Darkness', 'https://www.moddb.com/mods/dawn-of-darkness1', 'Dawn of Darkness was an excellent RPG/adventure/action game that was dumped by Ward Six Entertainment in 1999.')
          ,new cLink('Gloom', 'https://www.moddb.com/mods/gloom', 'Gloom is a Quake II modification that blends fast paced action and strategy to create a unique gameplay expierience that will take many years to master.') #http://www.planetquake.com/rxn/gloom/
          ,new cLink("lOkO's MegaMod", 'https://www.angelfire.com/jazz/loko/', 'a Quake2 Bot and Weapons Mod')
          ,new cLink("Loki's Minions Capture the Flag", 'https://lmctf.com/', 'The Original Capture The Flag Mod For Quake II.')
           ));

$LinksGame[] = new cLinkGroup('Quake 3: Arena', 'Q3A', array(
           new cLink('Planet Quake - Quake 3', 'http://planetquake.gamespy.com/quake3/index.html')
//          ,new cLink('Entities &amp; Settings', 'http://www.qeradiant.com/manual/Q3Rad_Manual/index.htm')
          ,new cLink('Quake3World', 'https://www.quake3world.com', 'The official community site for Quake III Arena by id Software.')
          ,new cLink('Q3Arena.com', 'http://www.q3arena.com/', 'The Ultimate Quake III Site')
//          ,new cLink('Q3R', 'http://quake3.qeradiant.com/')
          ,new cLink('Quaketweaks', 'http://www.quaketweaks.com/', 'Here you will find help and advice on tweaking Quake 3 Arena.', 'https://web.archive.org/web/20111215083700/http://www.quaketweaks.com/')
//          ,new cLink('The Gothic Revival', 'http://www.planetquake.com/gothic/')
          ,new cLink('ioquake3', 'https://ioquake3.org', 'Our permanent goal is to create the open source Quake 3 distribution upon which people base their games, ports to new platforms, and other projects.')
//          ,new cLink('XreaL', 'http://xreal-project.net/', 'The highly advanced id Tech 3 engine and free indie game project')
//          ,new cLink('Spearmint', 'http://spearmint.pw/', 'Spearmint is a heavily modified version of the Quake III Arena engine.')
          ,new cLink('Excessive dawn', 'http://www.edawn-mod.org/', 'Excessive dawn (edawn) is a free Quake 3 Arena mod, with numerous improvements, both client and server side.')
          ,new cLink('The Unofficial Patch', 'https://www.moddb.com/mods/the-unofficial-patch', '[TUP] The Unofficial Patch')
          ,new cLink('High Quality Quake', 'https://www.moddb.com/mods/high-quality-quake/', 'High resolution textures for menu and ingame hud.')
          ,new cLink('IoQuake III Arena 4K', 'https://www.moddb.com/mods/ioquake-iii-arena-4k', 'New executable for the game, new models from MetalTech v2.0 of G-n3tiK Productions and HD menu and icons from awesome High Quality Quake by ZerTerO and complete weapon pack with new effects.')
          ,new cLink('Quake3 Depot', 'http://www.quake3depot.com/', 'Where gamers can find anything and everything for Quake3.', 'https://web.archive.org/web/20000815235217/http://www.quake3depot.com/')
          ,new cLink("Smokin' Guns", 'https://www.smokin-guns.org/')
          ,new cLink('Q3Map2 - Shaderlab', 'https://rr.co/q3map2') #OLD: http://shaderlab.com/q3map2/  MIRROR: http://q3map2.robotrenegade.com/ #http://ydnar.com/q3map2
          ,new cLink('..::LvL', 'https://lvlworld.com/', 'Quake 3 (Q3A) Custom Maps')
          ,new cLink('qscore', 'http://qscore.sourceforge.net/', 'parse Quake III: Arena (and compatible) games.log into high scores and statistics')
//          ,new cLink('aa2map', 'http://aa2map.sourceforge.net/', 'Parse ASCII Art into a Quake III: Arena (id Tech 3) map file') //NOT USEFUL
          ,new cLink('Gates of Midian: Chronicles of evillair', 'http://www.evillair.net/v4/downloads/') #HFX, http://www.planetquake.com/hfx #http://www.evillair.net/v2/?option=com_remository #http://evillair.net/v3/pages/downloads.php
          ,new cLink('Reaction Quake 3', 'https://www.rq3.com/')
          ,new cLink('Uber Arena', 'https://www.moddb.com/mods/uber-arena', 'Uber Arena is a mod that takes the standard gameplay of Quake 3 and attempts to build upon and revitalize it with new gameplay mechanics and items.')
          ,new cLink('EntityPlus', 'https://www.moddb.com/mods/entityplus/', 'EntityPlus is a Quake III Arena mod that is aimed at expanding the toolset for Quake III Arena map makers.')
          ,new cLink('True Combat', 'https://www.moddb.com/mods/true-combat', 'True Combat is an action packed realism mod where big jumps, fancy strafing and fantasy weapons are no where to be seen.')
          ,new cLink("Claudec's Lair", 'http://www.claudec.com', NULL, 'https://web.archive.org/web/20040604172538/http://www.claudec.com/')
           ));

$LinksGame[] = new cLinkGroup('Quake 4', 'Q4', array(
//           new cLink('Quake 4 FileFront', 'http://quake4.filefront.com/')
           new cLink('Planet Quake - Quake 4', 'http://planetquake.gamespy.com/quake4/index.html')
//          ,new cLink('Quake IV - RavenGames Network', 'http://quake4.ravengames.com/')
          ,new cLink('Quake 4 Portal', 'http://www.quake4portal.com/', 'the source for Quake 4', 'https://web.archive.org/web/20100327140017/http://www.quake4portal.com/')
          ,new cLink('ETG Quake 4', 'http://quake4.enterthegame.com/', 'ETG Official Quake IV Site', 'https://web.archive.org/web/20090629071735/http://quake4.enterthegame.com/')
          ,new cLink('Q4MAX.com', 'http://www.q4max.com/', 'Quake 4 Maximiser', 'https://web.archive.org/web/20110423142600/http://www.q4max.com/')
          ,new cLink('Q4 OpenCoop', 'https://www.moddb.com/mods/q4-opencoop', 'Quake4 Opencoop is mod for playing Quake4 cooperatively.')
          ,new cLink('Quake 4 Hi Def', 'https://www.moddb.com/mods/quake-4-hi-def', "Updating Quake 4's graphics, improved textures and models, full shadows map files")
          ,new cLink('Quake 4: Rivarez Mod', 'https://www.moddb.com/mods/quake-4-rivarez-mod', 'This mod makes changes in game graphics and gameplay.')
           ));

$LinksGame[] = new cLinkGroup('Quake Live', 'QL', array(
           new cLink('Planet Quake - Quake Live', 'http://planetquake.gamespy.com/quakelive/index.html')
           ));

$LinksGame[] = new cLinkGroup('Enemy Territory: QUAKE Wars', 'ETQW', array(
           new cLink('Planet Quake - Quake Wars - Enemy Territory', 'http://planetquake.gamespy.com/enemyterritory/index.html')
          ,new cLink('ETQW Mapping', 'http://www.etqwmapping.com/', 'Enemy Territory: QUAKE Wars Mapping', 'https://web.archive.org/web/20090815121845/http://www.etqwmapping.com/')
           ));

$LinksGame[] = new cLinkGroup('Return to Castle Wolfenstein', 'RTCW', array(
//           new cLink('Planet Wolfenstein', 'http://www.planetwolfenstein.com')
//           new cLink('RTCW FileFront', 'http://returntocastlewolfenstein.filefront.com/')
           new cLink('Wolfenstein Resource', 'http://wolfensteinresource.com/', 'Wolfenstein Resource is dedicated to the Wolfenstein and Enemy Territory series of video games.', 'https://web.archive.org/web/20120127052056/http://wolfensteinresource.playgamesforfun.net/main/index.php')
          ,new cLink('Wolfstuff', 'http://www.wolfstuff.org/', 'A community committed to good spirit and supporting the Wolfenstein series of Games.', 'https://web.archive.org/web/20080812030931/http://www.wolfstuff.org/')
          ,new cLink('Taktik Wolfenstein', 'http://www.wolftactics.com/', 'Class-based warfare for RTCW', 'https://web.archive.org/web/20031127043804/http://www.wolftactics.com/')
          ,new cLink('Wolfenstein Xtreme', 'http://www.wolfensteinx.com/', 'The War Starts here!', 'https://web.archive.org/web/20090206092756/http://www.wolfensteinx.com/')
          ,new cLink("Nib's Mapper Resource Center", 'http://www.nibsworld.com/rtcw/index.shtml', "Welcome to nib's Mapper Resource Center (MRC).", 'https://web.archive.org/web/20110206183042/http://www.nibsworld.com/rtcw/index.shtml')
          ,new cLink('wils ego | art | wolfenstein', 'http://www.wilsego.com:80/web/art-wolfenstein.shtml', NULL, 'https://web.archive.org/web/20040805001511/http://www.wilsego.com:80/web/art-wolfenstein.shtml')
           ));

$LinksGame[] = new cLinkGroup('Wolfenstein: Enemy Territory', 'RTCW-ET', array(
//           new cLink('enemy-territory.com', 'http://www.enemy-territory.com/')
           new cLink('ET: Legacy', 'https://www.etlegacy.com/', 'An open source project that aims to create a fully compatible client and server for the popular online FPS game Wolfenstein: Enemy Territory.') //http://dev.etlegacy.com/projects/etlegacy
          ,new cLink('ET: XreaL Edition', 'https://www.moddb.com/mods/etxreal', 'ETXreaL is a graphics mod for Wolfenstein: Enemy Territory using the enhanced XreaL id Tech 3 GPL engine.')
           ));

$LinksGame[] = new cLinkGroup('SiN', 'SIN', array(
           new cLink('Ritualistic', 'http://www.ritualistic.com/games/sin/', "Ritual Entertainment's Online Community Hub")
          ,new cLink('The Node', 'http://ritualistic.com/node/')
          ,new cLink('SiN Post', 'http://www.sinpost.com/', "The Sinner's choice.", 'https://web.archive.org/web/20010516035328/http://www.sinpost.com/')
           ));

$LinksGame[] = new cLinkGroup('Soldier of Fortune', 'SOF', array(
//           new cLink('SOF Files', 'http://www.soffiles.com/')
//          ,new cLink('Foyle Man', 'http://www.sofcenter.com/foyleman')
//           new cLink('Planet Soldier | Soldier of Fortune', 'http://www.planetsoldier.com/sof/')
           new cLink('SoF Mod Central', 'http://www.sofmodcentral.com/', '#1 for all mods info', 'https://web.archive.org/web/20030622232553/http://www.sofmodcentral.com/')
          ,new cLink('Soldier-of-Fortune.com', 'http://www.soldier-of-fortune.com/', 'Your first stop for official Soldier of Fortune news, maps, walkthroughs, interviews, files, forums, and more!', 'https://web.archive.org/web/20141220072912/http://www.soldier-of-fortune.com/')
          ,new cLink('SoF Center', 'http://www.sofcenter.com/', "The Gamers' Choice!", 'https://web.archive.org/web/20030126234742/http://sofcenter.com/')
          ,new cLink('Soldier of Fortune Download', 'http://www.sof1.info/', NULL, 'https://web.archive.org/web/20170809215418/http://www.sof1.info/') //Not the latest archive, but the latest functional one.
          ,new cLink('SoFplus', 'http://sof1.megalag.org/sofplus/', 'The primary purpose is to fix SoF1 1.07f bugs.')
           ));

$LinksGame[] = new cLinkGroup('Soldier of Fortune 2', 'SOF2', array(
//           new cLink('SoF2 FileFront', 'http://soldieroffortune2.filefront.com/')
//          ,new cLink('Planet Soldier of Fortune | Soldier of Fortune 2', 'http://www.planetsoldier.com/SoF2/')
           new cLink('UNF104', 'https://krisredbeard.wordpress.com/projects/old-projects/unf104/')
          ,new cLink('SOF2.ORG', 'https://www.sof2.org/', 'Soldier Of Fortune 2 Community Website.')
          ,new cLink('SOFII Players', 'http://www.sofplayers.co.uk/', 'News, Tips, Downloads & Player Listing')
           ));

/*$LinksGame[] = new cLinkGroup('Soldier of Fortune: Payback', 'SoFP', array(
           new cLink('Soldier of Fortune: Payback Community', 'http://www.sofpayback.com/')
           ));*/

$LinksGame[] = new cLinkGroup('Star Trek: Elite Force 2', 'EF2', array(
//           new cLink('Elite Force 2 FileFront', 'http://eliteforce2.filefront.com/')
           new cLink('Totally Elite Force', 'https://www.totallyef.net/', 'Your source for Star Trek Elite Force 2 and more')
          ,new cLink('Star Trek Elite Force I & II', 'https://eliteforce.gamebub.com/', 'mods, tutorials, skins & fansite')
          ,new cLink('HaZardModding Coop: Star Trek Elite Force II', 'https://www.moddb.com/mods/star-trek-elite-force-ii-coop-hazardmodding', 'The HaZardModding Coop Mod allows you to play the Single-Player Story and all the Secret levels Co-Operatively in Multi-Player.')
          ,new cLink('A Gate two Birds and the Beautiful Sky', 'https://www.moddb.com/mods/a-gate-two-birds-and-the-beautiful-sky', 'The A Gate two Birds and the beautiful Sky Mod adds all new single player adventure to the game.') //http://www.gate-birds-sky.org/
           ));

$LinksGame[] = new cLinkGroup('Star Trek: Voyager - Elite Force', 'STVEF', array(
//           new cLink('EF Files', 'http://www.effiles.com/')
           new cLink('VoyagerEliteForce.com', 'http://www.voyagereliteforce.com/', 'Your first stop for official Star Trek Voyager: Elite Force news, maps, walkthroughs, interviews, files, forums, and more!', 'https://web.archive.org/web/20150218040426/http://www.voyagereliteforce.com/')
          ,new cLink('EliteForce.com', 'http://www.eliteforce.com/')
          ,new cLink('cMod', 'https://www.stvef.org/cmod', 'cMod is an unofficial Elite Force multiplayer client based on ioEF. It is optimized for modern systems and has various improvements over the original Elite Force client.') #https://github.com/Chomenor/ioef-cmod
//          ,new cLink('Elite Force Universe', 'http://eliteforce.3dactionplanet.gamespy.com/', 'Your Resource For Elite Force I & II')
//          ,new cLink('RPG-X Mod', 'http://www.ubergames.net/projects/rpg-x') //http://www.rpg-x.net/
          ,new cLink('TotallyEliteForce', 'https://www.totallyef.net/', 'Set phasers to FRAG!')
          ,new cLink('Star Trek Elite Force I & II', 'https://eliteforce.gamebub.com/', 'mods, tutorials, skins & fansite')
          ,new cLink("Laz's bots for Elite Force", 'http://lazrojas.com/elitefarce/bots/index.html', "Laz's Bots & Skins for Star Trek Voyager: Elite Force")
           ));

$LinksGame[] = new cLinkGroup('Star Wars Jedi Knight II: Jedi Outcast', 'JK2', array(
//           new cLink('Jedi Knight 2 FileFront', 'http://jediknight2.filefront.com/')
           new cLink('JediKnight.Net', 'http://www.jediknight.net/', 'Star Wars Gaming At Its Best!', 'https://web.archive.org/web/20190108110946/http://www.jediknight.net/')
          ,new cLink('Jedi Knight 2', 'http://www.jediknightii.net/', NULL, 'https://web.archive.org/web/20190104173659/http://www.jediknightii.net/')
          ,new cLink('Force Temple :: Jedi Knight 2: Jedi Outcast', 'http://www.force-temple.com/jk2/', NULL, 'https://web.archive.org/web/20090406011945/http://www.force-temple.com/jk2/')
          ,new cLink('EchoNetwork', 'http://www.echonetwork.net/', 'The Star Wars gaming resource', 'https://web.archive.org/web/20170620024235/http://www.echonetwork.net/')
          ,new cLink('OpenJK', 'https://github.com/JACoders/OpenJK', 'OpenJK is a community effort to maintain and improve the game and engine powering Jedi Academy and Jedi Outcast, while maintaining full backwards compatibility with the existing games and mods.')
          ,new cLink('JK2MV', 'https://jk2mv.org/', 'improved, modernized JK2 client and server.')
          ,new cLink('JKMods.com', 'http://www.jkmods.com/', NULL, 'https://web.archive.org/web/20060404181752/http://www.jkmods.com/')
           ));

$LinksGame[] = new cLinkGroup('Star Wars Jedi Knight: Jedi Academy', 'JA', array(
//           new cLink('Jedi Academy FileFront', 'http://jediknight3.filefront.com/')
           new cLink('JediKnight.Net', 'http://www.jediknight.net/', 'Star Wars Gaming At Its Best!', 'https://web.archive.org/web/20190108110946/http://www.jediknight.net/')
          ,new cLink('Force Temple :: Jedi Knight: Jedi Academy', 'http://www.force-temple.com/jk3/', NULL, 'https://web.archive.org/web/20090218172417/http://www.force-temple.com/jk3/')
          ,new cLink('EchoNetwork', 'http://www.echonetwork.net/', 'The Star Wars gaming resource', 'https://web.archive.org/web/20170620024235/http://www.echonetwork.net/', 'The Star Wars gaming resource')
          ,new cLink('OpenJK', 'https://github.com/JACoders/OpenJK', 'OpenJK is a community effort to maintain and improve the game and engine powering Jedi Academy and Jedi Outcast, while maintaining full backwards compatibility with the existing games and mods.')
          ,new cLink('JKMods.com', 'http://www.jkmods.com/', NULL, 'https://web.archive.org/web/20060404181752/http://www.jkmods.com/')
          ,new cLink('The Jedi Academy', 'https://www.thejediacademy.net/', 'THE place for Jedi training.')
          ,new cLink('Movie Battles II', 'https://www.moviebattles.org/', 'Movie Battles is a fast-paced, action packed mod for the award winning Jedi Knight Jedi Academy game, that lets players play and fight in the most iconic battles seen throughout the entire saga!')
           ));

$LinksGame[] = new cLinkGroup('Sven Co-op', 'SC', array(
           new cLink('SCMapDB', 'http://scmapdb.com/', 'The Sven Co-op Map Database, a wiki for Sven Co-op maps!')
           ));

/*$LinksGame[] = new cLinkGroup('Sylphis', 'S', array(
           new cLink('Sylphis3D Game Engine Developer Network', 'http://devnet.sylphis3d.com')
           ));*/

$LinksGame[] = new cLinkGroup('Team Fortress 2', 'TF2', array(
//           new cLink('Exploits - TF2 Wiki', 'http://tf2wiki.net/wiki/Exploits#List_of_Exploits')
           new cLink('Official Team Fortress Wiki', 'https://wiki.teamfortress.com/', 'The official resource for the Team Fortress series.')
           ));

$LinksGame[] = new cLinkGroup('Torque', 'T', array(
           new cLink('Online Documentation', 'http://docs.garagegames.com/')
//          ,new cLink('QuArK-Torque config', 'http://www.garagegames.com/docs/torque/general/ch11s02.html')
//          ,new cLink('Torque/QuArK tutorials', 'http://holodeck.st.usm.edu/vrcomputing/vrc_t/')
          ,new cLink('ToRK GameDev', 'http://tork.beffy.de/', NULL, 'https://web.archive.org/web/20120711213250/http://tork.beffy.de/')
          ,new cLink('Torque3D', 'https://github.com/GarageGames/Torque3D', 'MIT Licensed Open Source version of Torque 3D from GarageGames')
           ));

$LinksGame[] = new cLinkGroup('Urban Terror', 'URT', array(
           new cLink('Urban-Zone', 'http://www.urban-zone.org/')
           ));

$LinksGame[] = new cLinkGroup('Warfork', 'WAR', array(
           new cLink('Official Warfork Wiki', 'https://warforkwiki.com/', 'A player maintained resource which anyone can edit!')
           ));

$LinksGame[] = new cLinkGroup('Warsow', 'W', array(
           new cLink('warsownews.net', 'http://warsownews.de/', 'Your #1 news page for war§ow news, articles, guides, cups and files', 'https://web.archive.org/web/20190906165713/http://warsownews.de/') //http://warsownews.net/
          ,new cLink('Racesow 1.5', 'http://mgxrace.net/', NULL, 'https://web.archive.org/web/20181202110411/https://mgxrace.net/')
//          ,new cLink('The Warsow Racenet', 'http://www.warsow-race.net/')
           ));

//Not sure which category:
#https://web.archive.org/web/19971210224324/http://www.slipgatecentral.com/ #https://web.archive.org/web/19980522223932/http://www.slipgatecentral.com:80/
#https://web.archive.org/web/20030210132750/http://www.captured.com/q2ctfring/

#FIXME: Currently not used.

/*global $LinksCompany;
$LinksCompany = array();
$LinksCompany[] = new cLinkGroup('Valve', 'Valve', array(
           new cLink('ValveTime.net', 'https://www.valvetime.net/category/half-life/', 'Valve News. On Time. Sometimes.', 'https://web.archive.org/web/20200208062945/https://www.valvetime.net/')
           ));*/
?>
