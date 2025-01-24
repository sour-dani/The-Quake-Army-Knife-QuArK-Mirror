<?php
require_once('_helpers.php');
require_once('_main_paths.php');

class cLanguage
{
	var $Name;        # Name of the language
	var $DisplayName; # Name of the language to display
	var $Tag;         # Language tag (for HTML)
	var $MainFile;    # Main language file
	var $Fallback;    # Fallback language
	var $Files;       # Array of additional language files

	function __construct($aName, $aDisplayName, $aTag, $aMainFile, $aFallback=NULL, $aFiles=NULL)
	{
		$this->Name        = $aName;
		$this->DisplayName = $aDisplayName;
		$this->Tag         = $aTag;
		$this->Fallback    = $aFallback;
		$this->MainFile    = $aMainFile;
		$this->Files       = $aFiles;
	}
}

$LanguageNR = 0;
$SelectedLanguage = NULL;

function InitializeLanguage()
{
	require_once('_settings-database.php');
	global $Settings;
	global $SiteLanguage;
	global $LanguageAutomatic;

	require_once('_language-database.php');
	global $Languages;
	global $LanguageDefault;

	# Fill in the language settings
	global $LanguageNR;
	if ($LanguageNR === 0)
	{
		$LanguageSetting = &$Settings[$SiteLanguage];
		foreach ($Languages as $LanguageName => $Language)
		{
			$LanguageNR++;
			$LanguageSetting->Range[] = $LanguageNR;
			$LanguageSetting->Values[] = $Language->Name;
			$LanguageSetting->Texts[] = $Language->DisplayName;
		}
	}

	global $SelectedLanguage;
	$SelectedLanguage = $Settings[$SiteLanguage]->GetCurrentValue();
	if ($SelectedLanguage === $LanguageAutomatic)
	{
		$foundLanguage = false;
		$acceptedLanguages = parseAcceptHeader($_SERVER['HTTP_ACCEPT_LANGUAGE']);
		arsort($acceptedLanguages, SORT_NUMERIC);
		foreach (array_keys($acceptedLanguages) as $acceptedLanguage)
		{
			$tags = explode('-', $acceptedLanguage);
			foreach ($Languages as $LanguageName => $Language)
			{
				//FIXME: Handle subtags properly!!!
				if ($Language->Tag === $tags[0])
				{
					//Found a compatible language
					$foundLanguage = true;
					$SelectedLanguage = $Language->Name;
					break;
				}
			}
			if ($foundLanguage)
			{
				break;
			}
		}
		if (!$foundLanguage)
		{
			$SelectedLanguage = $LanguageDefault;
		}
	}
	if (!array_key_exists($SelectedLanguage, $Languages))
	{
		$SelectedLanguage = $LanguageDefault;
	}

	$tagsToSet = array($Languages[$SelectedLanguage]->Tag);
	setlocale(LC_MONETARY, $tagsToSet);
	setlocale(LC_NUMERIC, $tagsToSet);
	setlocale(LC_TIME, $tagsToSet);
}

function GetLanguageObj()
{
	global $SelectedLanguage;
	if (is_null($SelectedLanguage))
	{
		die('Language files referenced before they were loaded!');
	}

	require_once('_language-database.php');
	global $Languages;

	return $Languages[$SelectedLanguage];
}

$languageFileLoaded = false;
function LoadLanguageFile($File)
{
	global $SelectedLanguage;
	if (is_null($SelectedLanguage))
	{
		die('Language files referenced before they were loaded!');
	}

	global $languageroot;

	//Load the language's MainFile
	if (!(require_once $languageroot.(GetLanguageObj()->MainFile)))
	{
		die('Missing language file!');
	}

	//Find the language's File, or fallback through languages until we do find a usable one
	require_once('_language-database.php');
	global $Languages;

	$LanguageFile = NULL;
	$CurrentLanguage = $SelectedLanguage;
	while (!is_null($CurrentLanguage))
	{
		$CurrentLanguageObj = &$Languages[$CurrentLanguage];
		if (is_array($CurrentLanguageObj->Files))
		{
			if (array_key_exists($File, $CurrentLanguageObj->Files))
			{
				# Found it!
				$LanguageFile = $CurrentLanguageObj->Files[$File];
				break;
			}
		}

		# Couldn't find it; fallback!
		$CurrentLanguage = $CurrentLanguageObj->Fallback;
	}

	if (is_null($LanguageFile))
	{
		die('Unable to locate correct language files!');
	}

	//Load the language's File
	if (!(require_once $languageroot.$LanguageFile))
	{
		die('Missing language file!');
	}

	global $languageFileLoaded;
	$languageFileLoaded = true;
}

function GetLanguageString($String)
{
	global $languageFileLoaded;
	if (!$languageFileLoaded)
	{
		die('Language files referenced before they were loaded!');
	}

	global $Strings;
	return $Strings[$String];
}

?>
