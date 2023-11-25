<?php

class cTestimonial
{
	var $Name;   # Name of the person
	var $Author; # Author of the testimonial
	var $Date;   # Date of the testimonial
	var $Text;   # Text of the testimonial
	var $Source; # Source of the testimonial

	function __construct($aName, $aAuthor=NULL, $aDate=0, $aText=NULL, $aSource=NULL)
	{
		$this->Name   = $aName;
		$this->Author = $aAuthor;
		$this->Date   = $aDate;
		$this->Text   = $aText;
		$this->Source = $aSource;
	}
}

global $Testimonials;
$Testimonials = array();
$Testimonials[] = new cTestimonial('FZEEROX', NULL, mktime(22, 43, 24, 3, 1, 2021), "QUARK is still one of the best editors because of it's ease of use interface. Much better than even Worldcraft.", 'Youtube comment'); #From: https://www.youtube.com/watch?v=NGowmr5a0oA
$Testimonials[] = new cTestimonial('resonancerim', NULL, mktime(0, 0, 0, 2, 13, 2021), 'QuArK is a nice editor even in 2021.', 'Youtube description'); #From: https://www.youtube.com/watch?v=NGowmr5a0oA
$Testimonials[] = new cTestimonial('Marandal', NULL, mktime(19, 6, 24, 3, 1, 2020), 'Quark is awsome.', 'Youtube comment'); #From: https://www.youtube.com/watch?v=uYlqj2Mbn3g
$Testimonials[] = new cTestimonial('IsraeliRD', NULL, mktime(16, 24, 0, 7, 2, 2013), "Unless [...] are something you cannot live without or some of [...]'s rotation/shapes tools, QuArK is the ultimate choice.<br><br>You can debug maps, find errors super easily, you rarely get crashes and it's very solid. It also supports dozens of other games, meaning it comes with more options than anything else. Making convertible curves, pipes and loops is trivial. You never have problems with triangles, so MBP scenery is easy. Floating point errors are non-existent (unless you use maps made in [...]) and it's generally awesome all around. The downside is that you're gonna have to do manual texturing and tex-wrapping.<br><br>Lastly, you can create packages that include textures, maps and others all in one file (think of [...]'s albums going advanced). If you've got plenty of experience of level design and want to go to the next stage, QuArK is yours.<br><br>QuArK has been used by professionals across many games, universities, even GarageGames when they created Marble Blast (Gold, Gold Xbox, Ultra). It's the #1 tool used by the top level designers, including [...] and myself.", 'Forum'); #From: https://marbleblast.com/index.php/forum/mb-level-building/190-quark-vs-cstr-which-is-better-to-make-levels#11741
$Testimonials[] = new cTestimonial('Clipz', NULL, mktime(20, 5, 47, 4, 18, 2013), 'Quark is the best... ftw.', 'Forum'); #From: https://forums.digitalpaint.org/index.php?topic=25919.msg232817#msg232817
$Testimonials[] = new cTestimonial('Forrest Collman', 52, mktime(0, 0, 0, 10, 21, 2009), "I can't underestimate the time and effort QuArK saved us in the process. We have many people in the lab, with a wide range of programming abilities, but everyone is able to learn the basics of how QuArK words and design their own custom experiments in a matter of weeks without much training.  In fact, the environment used most extensively used in the paper was conceived over lunch, and implemented that same afternoon. A testament to how easy QuArK is to use.", 'Forum');
$Testimonials[] = new cTestimonial('DanielPharos (Dancing Dan)', 6, mktime(0, 0, 0, 6, 8, 2009), 'Before I became a developer for QuArK, I used QuArK to teach myself the art of making maps. I chose QuArK because it was much easier to learn than the other editors for Quake 3, and because QuArK supported so many different games.', 'Conversation');
$Testimonials[] = new cTestimonial('0kelvin', 54, mktime(0, 0, 0, 3, 23, 2009), "Two things made me give up with radiant and go quark for my OA map.<br><br>1st. It's impossible to make hollowed 16 sided cylinders (not bezier curves) and cones. I always notice microgaps because perfect, regular, polygons have non integer vertexes coordinates.<br><br>2nd. For some odd bug radiant is refusing to save maps unless I use a different name, else it does nothing. That was caused by light entities having intensity values too large, or something else related to lights, after I deleted all lights my map saved just fine No, it's something related to entities in general, not just lights. Or... some shader.", 'Forum');
$Testimonials[] = new cTestimonial('67.9.148.47', NULL, mktime(8, 3, 0, 2, 3, 2009), "If people here had even the slightest clue about mapping, or how many maps have been made with this software, or how many different games and engines and mods have used this, then there wouldn't even be a \"notability\" discussion. Go read any mapping forum and ask about it.", "Wikipedia comment"); #From: https://en.wikipedia.org/wiki/Talk:Quake_Army_Knife
$Testimonials[] = new cTestimonial('skynardlynard', 53, mktime(0, 0, 0, 7, 30, 2008), 'First of all, I would like to say GREAT WEBSITE!<br><br>This place will help me out tremendously on what I need to accomplish...and thank you to the developers of Quark, my hat goes off to you.<br>I will probably be frequenting these forums a bit.', 'Forum');
$Testimonials[] = new cTestimonial('Tectonic', 55, mktime(0, 0, 0, 6, 18, 2008), "I just have to say wow. Kudos to you guys for developing an awesome editor. This is just miles and miles above the experience I've had with gtk/qeradiant. Somehow I had never heard of QuArK until yesterday, and I've spent some time researching Quake 3 editors and talking with Quake 3 mappers in the past. I'm looking forward to using this tool once I get some inspiration.<br><br>Thanks so much for the development effort! I hope you keep it up and this tool becomes THE existing-gen (no idea what's in the future with Idtech5, but it sounded like significant changes to level development) Quake engine map editor.", 'Forum');
$Testimonials[] = new cTestimonial('Wolv', 56, mktime(0, 0, 0, 2, 7, 2000), "QuArK has got very precise and easy texture and brush manipulation (floating points), a very fast 3D window, integrated programs for pak viewing (including .bsp decompiler) and an easy to customise interface.", 'GameDesign.net Forums'); #From: http://chordian.dk/jchq/faq/editors.htm
$Testimonials[] = new cTestimonial('PC Games', NULL, mktime(0, 0, 0, 4, 1, 1998), "QuArK stands for the \"Quake Army Knife,\" and it's as versatile as the name implies! You can use this handy utility to edit Quake I and Quake II maps, as well as browse the textures and models and such. This is a great utility that wraps a ton of features into one handy package.", 'Readme'); #http://cd.textfiles.com/pcgamesexe/pcge199804/QUAKE2/QUARK.PCG
$Testimonials[] = new cTestimonial('Mark LaCroix', 138, mktime(0, 0, 0, 4, 16, 1997), 'I was VERY impressed with QuArK.', 'Email'); #https://web.archive.org/web/19970430160039/http://users.yknet.yk.ca:80/dmckay/qmap/archive.html

?>
