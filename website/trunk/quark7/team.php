<?php
require_once ('..'.DIRECTORY_SEPARATOR.'_people-database.php');

function DisplayPerson($PersonID)
{
	global $personsdatabase;
	$CurrentPerson = &$personsdatabase[$PersonID];
	if ($CurrentPerson->Nick !== '')
	{
		return '<a href="person.php?PersonID='.($PersonID+1).'">'.$CurrentPerson->Nick.'</a>';
	}
	elseif ($CurrentPerson->AllowRealName)
	{
		return '<a href="person.php?PersonID='.($PersonID+1).'">'.$CurrentPerson->Name.'</a>';
	}
	return '*NONAME*';
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
<TITLE>QuArK 7 team</TITLE>
</HEAD>
<BODY style="text-align: center;">
<H1>QuArK 7 team</H1>
<TABLE border=1 align=center style="text-align: left;" cellpadding=4>
<TR><TD><B>Name</B>
    <TD><B>Role</B>
<TR><TD><?php echo DisplayPerson(6); ?>
    <TD>Project lead
<TR><TD><?php echo DisplayPerson(5); ?>
    <TD>?
<TR><TD><?php echo DisplayPerson(57); ?>
    <TD>Programmer
<TR><TD><?php echo DisplayPerson(58); ?>
    <TD>Programmer
<TR><TD><?php echo DisplayPerson(11); ?>
    <TD>Tester on Mac OS X, maybe some programming
<TR><TD>Mooztik
    <TD>Awesome-logo creator
</TABLE>
</BODY>
</HTML>
