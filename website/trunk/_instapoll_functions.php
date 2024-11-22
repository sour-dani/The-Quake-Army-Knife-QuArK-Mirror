<?php
require_once('_database_functions.php');

class cInstapoll
{
	var $Question;  # Text question of this poll
	var $StartDate; # Date this instapoll opened
	var $EndDate;   # Date this instapoll closed
	var $Picture;   # Picture that goes with the question (if any)
	var $Options;   # Array of instapoll options/choices

	function __construct($aQuestion, $aStartDate, $aEndDate=0, $aPicture=NULL, $aOptions=NULL)
	{
		$this->Question  = $aQuestion;
		$this->StartDate = $aStartDate;
		$this->EndDate   = $aEndDate;
		$this->Picture   = $aPicture;
		$this->Options   = $aOptions;

		# Calculate total number of votes:
		$this->TotalVotes = 0;
		if (is_array($this->Options))
		{
			for ($Option = 0; $Option < count($this->Options); $Option++)
			{
				$CurrentOption = &$this->Options[$Option];
				$this->TotalVotes += $CurrentOption->Votes;
			}
		}
	}
}

class cInstapollOption
{
	var $InstapollID; #ID of the instapoll to which this option belongs
	var $Text;        # Text description of the option
	var $Picture;     # Picture that goes with this option (if any)
	var $Votes;       # Number of votes for this option

	function __construct($aInstapollID, $aText, $aPicture=NULL, $aVotes=0)
	{
		$this->InstapollID = $aInstapollID;
		$this->Text        = $aText;
		$this->Picture     = $aPicture;
		$this->Votes       = $aVotes;
	}
}

function GetOldInstaPolls()
{
	$connection = getDB('q1181_website');
	$result = $connection->query('SELECT * FROM `InstaPolls_options`;');
	if ($result === FALSE)
	{
		throw new RuntimeException('Failed to retrieve InstaPoll-options from DB.', $connection->errorCode());
	}
	$AllOptions = array();
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		$AllOptions[] = new cInstapollOption($row['InstaPoll'], $row['Text'], $row['Picture'], $row['Votes']);
	}
	$result->closeCursor();

	$result = $connection->query('SELECT * FROM `InstaPolls`;');
	if ($result === FALSE)
	{
		throw new RuntimeException('Failed to retrieve InstaPolls from DB.', $connection->errorCode());
	}

	$OldInstaPolls = array();
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		//Gather the options that belong to this InstaPoll.
		$Options = array_filter($AllOptions, function($option) use ($row) { return $option->InstapollID === $row['ID']; } );

		$OldInstaPolls[] = new cInstapoll($row['Question'], strtotime($row['StartDate']), is_null($row['EndDate']) ? 0 : strtotime($row['EndDate']), is_null($row['Picture']) ? 0 : $row['Picture'], $Options);
	}
	$result->closeCursor();

	$connection = null; //Close database connection
	return $OldInstaPolls;
}

//FIXME: DEBUG:
try
{
	var_dump(GetOldInstaPolls());
}
catch (Exception $e)
{
	echo 'An error has occurred! '.$e->getMessage()."\n";
}

?>
