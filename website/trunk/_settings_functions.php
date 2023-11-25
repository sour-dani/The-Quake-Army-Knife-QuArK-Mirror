<?php
require_once('_server_vars.php');

class cSetting
{
	var $CookieName;    # Name of the cookie associated with the setting
	var $Value;         # Value of this setting
	var $Range;         # All possible values of this setting
	var $Values;        # Values for the website to use
	var $Texts;         # Texts corresponding to values
	var $DisplayText;   # String to display as 'change me'-text on the layout-page

	function __construct($aCookieName, $aValue, $aRange, $aValues, $aTexts, $aDisplayText=NULL)
	{
		assert(is_array($aRange));
		assert(is_array($aValues));
		assert(is_array($aTexts));
		assert(count($aRange) === count($aValues));
		assert(count($aValues) === count($aTexts));
		assert(in_array($aValue, $aRange));
		$this->CookieName    = $aCookieName;
		$this->Value         = $aValue;
		$this->Range         = $aRange;
		$this->Values        = $aValues;
		$this->Texts         = $aTexts;
		$this->DisplayText   = $aDisplayText;
	}

	function GetCurrentValue()
	{
		$index = array_search($this->Value, $this->Range);
		if ($index === FALSE)
			return null;
		return $this->Values[$index];
	}

	function SaveSetting()
	{
		global $CookieTime;
		global $HTTP_Secure;
		if (setcookie($this->CookieName, strval($this->Value), time() + $CookieTime, '/', '', $HTTP_Secure, true) === false)
		{
			trigger_error('Unable to set setting cookie!', E_USER_WARNING);
		}
	}
}

?>
