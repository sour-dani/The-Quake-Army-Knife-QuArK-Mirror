<?php
class cDonator
{
	var $Name;    # Name of the donator
	var $Date;    # Date of donation
	var $Amount;  # Amount of money donated (in Dollars) --> actually received money, so SUBTRACT any fees!
	var $Comment; # Comment/statement made with the donation

	function __construct($aName, $aDate, $aAmount, $aComment=NULL)
	{
		$this->Name    = $aName;
		$this->Date    = $aDate; //FIXME: Default: 0
		$this->Amount  = $aAmount;
		$this->Comment = $aComment;
	}
}

?>
