<?php
require_once('_server_vars.php');

class cPanel
{
	var $CookieName;    # Name of the cookie associated with the panel
	var $DisplayName;   # String to display as the name of the panel (in layout page)
	var $IncludeFile;   # The file to include to display this panel
	var $State;         # Visibility state of the panel

	function __construct($aCookieName, $aDisplayName, $aIncludeFile, $aState='hidden')
	{
		$this->CookieName    = $aCookieName;
		$this->DisplayName   = $aDisplayName; #FIXME: How to translate this?
		$this->IncludeFile   = $aIncludeFile;
		$this->State         = $aState;
	}

	function SaveSetting()
	{
		global $CookieTime;
		global $HTTP_Secure;
		if (setcookie($this->CookieName, $this->State, time() + $CookieTime, '/', '', $HTTP_Secure, true) === false)
		{
			trigger_error('Unable to set panel cookie!', E_USER_WARNING);
		}
	}
}

$HidePanels = array();

function hidePanel($panelName)
{
	global $HidePanels;
	if (!in_array($panelName, $HidePanels))
	{
		$HidePanels[] = $panelName;
	}
}

function isPanelVisible($panelName)
{
	global $HidePanels;
	global $Panels; //FIXME: Circular to database!!!
	if ((!in_array($panelName, $HidePanels)) and ($Panels[$panelName]->State === 'show'))
	{
		return true;
	}
	else
	{
		return false;
	}
}

?>
