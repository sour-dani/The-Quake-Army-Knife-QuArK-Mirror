<?php
require_once('_database_functions.php');

function GetOldInstaPolls()
{
	$connection = getDB('q1181_website');
	if (is_null($connection))
	{
		return null; //FIXME: Is this right?
	}
	$result = $connection->query('SELECT * FROM InstaPolls');
	if ($result === FALSE)
	{
		throw new RuntimeException('Failed to retrieve InstaPolls from DB: '.$connection->errorCode());
	}

	$OldInstaPolls = array();
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		$NewArray = array();
		$NewArray['Question'] = $row['Question'];
		$NewArray['Picture'] = intval($row['Picture']);
		$NewArray['StartDate'] = strtotime($row['StartDate']);
		$NewArray['EndDate'] = strtotime($row['EndDate']);
		$NewArray['Options'] = intval($row['Options']);
		$OldInstaPolls[] = $NewArray;
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
