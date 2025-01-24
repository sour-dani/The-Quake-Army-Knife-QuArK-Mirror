<?php

class cPerson
{
	var $Name;    # Real (full) name of the person
	var $Nick;    # Nickname of the person
	var $Address; # Address of the person
	var $Email;   # Email of the person
	var $Picture; # Picture of the person
	var $ForumID; # ID number of the person on the official QuArK forums
	var $CV;      # Array of CV entries
	var $Website; # Website of the person
	var $AllowRealName; # Allow use of real name on website
	var $AllowAddress;  # Allow use of address on website
	var $AllowEmail;    # Allow use of email on website
	var $DateAdded;   #
	var $DateUpdated; #
	var $Notes; #

	function __construct($aName, $aNick='', $aAddress='', $aEmail='', $aPicture=NULL, $aForumID=0, $aCV=NULL, $aWebsite='', $aAllowRealName=false, $aAllowAddress=false, $aAllowEmail=false, $aDateAdded=0, $aDateUpdated=0, $aNotes=NULL)
	{
		$this->Name    = $aName;
		$this->Nick    = $aNick;
		$this->Address = $aAddress;
		$this->Email   = $aEmail;
		$this->Picture = $aPicture;
		$this->ForumID = $aForumID;
		$this->CV      = $aCV;
		$this->Website = $aWebsite;
		$this->AllowRealName = $aAllowRealName;
		$this->AllowAddress  = $aAllowAddress;
		$this->AllowEmail    = $aAllowEmail;
		$this->DateAdded   = $aDateAdded;
		$this->DateUpdated = $aDateUpdated;
		$this->Notes = $aNotes;
	}

	function getDisplayName()
	{
		if ($this->Nick !== '')
		{
			return $this->Nick;
		}
		if ($this->AllowRealName && ($this->Name !== ''))
		{
			return $this->Name;
		}
		return '-';
	}
}

# !!! Disclaimer !!!
# People related to QuArK: IN NO PARTICULAR ORDER! BUT DO NOT CHANGE THIS ORDER!!!

global $personsdatabase;
$personsdatabase = array(
);

?>
