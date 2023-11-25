<?php
require_once('_server_vars.php');

class cTheme
{
	var $CookieName;      # Name of the theme in the cookie
	var $DisplayName;     # String to display as the name of the theme (in layout page)
	var $CSSFilename;     # Filename of the CSS file associated with the theme
	var $PreviewFilename; # Filename of the preview file associated with the theme
	var $Description;     # Short description of the theme
	var $Selectable;      # Can users switch to this theme?
	var $ImageArray;      # An array of images of this theme that overwrite the default images
	                      # Note: Some images are referenced in the theme's .css file!

	function __construct($aCookieName, $aDisplayName, $aCSSFilename, $aPreviewFilename, $aSelectable=true, $aImageArray=NULL)
	{
		$this->CookieName      = $aCookieName;
		$this->DisplayName     = $aDisplayName;
		$this->CSSFilename     = $aCSSFilename;
		$this->PreviewFilename = $aPreviewFilename;
		$this->Description     = NULL; //$aDescription; //FIXME: Add and integrate!
		$this->Selectable      = $aSelectable;
		$this->ImageArray      = $aImageArray;
	}

	function SaveSettings()
	{
		global $CookieTime;
		global $HTTP_Secure;
		if (setcookie('theme', $this->CookieName, time() + $CookieTime, '/', '', $HTTP_Secure, true) === false)
		{
			trigger_error('Unable to set theme cookie!', E_USER_WARNING);
		}
	}
}

?>
