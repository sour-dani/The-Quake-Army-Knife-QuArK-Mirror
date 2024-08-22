<?php
require_once('_database_config.php');

function getDB($dbname)
{
	global $dbhost, $dbuser, $dbpass;
	try
	{
		$connection = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
	}
	catch (PDOException $e)
	{
		trigger_error('Failed to access database: '.$e->getMessage(), E_USER_ERROR);
		return null;
	}

	return $connection;
}
?>
