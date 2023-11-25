<?php
require_once('_base_code.php');
require_once('_language_functions.php');
require_once('_usermaps-database.php');
require_once('_people-database.php');

# Load language file
LoadLanguageFile('usermaps.php');

$checkboxon = array(NULL => ''
                   ,'on' => 'checked '
                   ,'1'  => 'checked ');

if (isset($_GET['page']))
{
	$page = intval($_GET['page']) - 1;
	if ($page < 0)
		$page = 0;
}
else
{
	$page = 0;
}

$Q1 = isset($_GET['Q1']) ? $_GET['Q1'] : NULL;
$Q2 = isset($_GET['Q2']) ? $_GET['Q2'] : NULL;
$Q3A = isset($_GET['Q3A']) ? $_GET['Q3A'] : NULL;
$Q4 = isset($_GET['Q4']) ? $_GET['Q4'] : NULL;
$CS = isset($_GET['CS']) ? $_GET['CS'] : NULL;
$D3 = isset($_GET['D3']) ? $_GET['D3'] : NULL;
$HL = isset($_GET['HL']) ? $_GET['HL'] : NULL;
$HL2 = isset($_GET['HL2']) ? $_GET['HL2'] : NULL;
$HX2 = isset($_GET['HX2']) ? $_GET['HX2'] : NULL;
$HR2 = isset($_GET['HR2']) ? $_GET['HR2'] : NULL;
$KP = isset($_GET['KP']) ? $_GET['KP'] : NULL;
$MOHAA = isset($_GET['MOHAA']) ? $_GET['MOHAA'] : NULL;
$SIN = isset($_GET['SIN']) ? $_GET['SIN'] : NULL;
$SOF = isset($_GET['SOF']) ? $_GET['SOF'] : NULL;
$EF = isset($_GET['EF']) ? $_GET['EF'] : NULL;
$EF2 = isset($_GET['EF2']) ? $_GET['EF2'] : NULL;
$ZZZ = isset($_GET['ZZZ']) ? $_GET['ZZZ'] : NULL;
$ZZX = isset($_GET['ZZX']) ? $_GET['ZZX'] : NULL;

$M_NO = isset($_GET['M_NO']) ? $_GET['M_NO'] : NULL;
$M_RA = isset($_GET['M_RA']) ? $_GET['M_RA'] : NULL;
$M_TFC = isset($_GET['M_TFC']) ? $_GET['M_TFC'] : NULL;
$M_ACT = isset($_GET['M_ACT']) ? $_GET['M_ACT'] : NULL;
$M_CS = isset($_GET['M_CS']) ? $_GET['M_CS'] : NULL;
$M_AIR = isset($_GET['M_AIR']) ? $_GET['M_AIR'] : NULL;
$M_GLM = isset($_GET['M_GLM']) ? $_GET['M_GLM'] : NULL;
$M_OP4 = isset($_GET['M_OP4']) ? $_GET['M_OP4'] : NULL;
$M_KMQ2 = isset($_GET['M_KMQ2']) ? $_GET['M_KMQ2'] : NULL;
$M_ZZZ = isset($_GET['M_ZZZ']) ? $_GET['M_ZZX'] : NULL;
$M_ZZX = isset($_GET['M_ZZX']) ? $_GET['M_ZZX'] : NULL;

$T_SP = isset($_GET['T_SP']) ? $_GET['T_SP'] : NULL;
$T_COOP = isset($_GET['T_COOP']) ? $_GET['T_COOP'] : NULL;
$T_DM = isset($_GET['T_DM']) ? $_GET['T_DM'] : NULL;
$T_TD = isset($_GET['T_TD']) ? $_GET['T_TD'] : NULL;
$T_TOUR = isset($_GET['T_TOUR']) ? $_GET['T_TOUR'] : NULL;
$T_TP = isset($_GET['T_TP']) ? $_GET['T_TP'] : NULL;
$T_CTF = isset($_GET['T_CTF']) ? $_GET['T_CTF'] : NULL;
$T_ZZZ = isset($_GET['T_ZZZ']) ? $_GET['T_ZZZ'] : NULL;
$T_ZZX = isset($_GET['T_ZZX']) ? $_GET['T_ZZX'] : NULL;

$usermapsform = "<div class=\"centered\">
<form action=\"usermaps.php\" method=\"get\">
<table cellspacing=2 cellpadding=0 align=center>
  <tr><td valign=top style=\"padding-left: 8px; padding-right: 8px;\">
    <table cellspacing=0 cellpadding=0>
      <tr><td colspan=2 class=\"filterhead\"><b>Games:</b></td></tr>
      <tr><td class=\"filterbody\" valign=top align=left style=\"padding-left: 8px; padding-right: 8px;\">
        <label><input ".$checkboxon[$Q1] ."type=\"checkbox\" value=\"1\" name=\"Q1\" >Quake 1</label><br>
        <label><input ".$checkboxon[$Q2] ."type=\"checkbox\" value=\"1\" name=\"Q2\" >Quake 2</label><br>
        <label><input ".$checkboxon[$Q3A]."type=\"checkbox\" value=\"1\" name=\"Q3A\">Quake 3: Arena</label><br>
        <label><input ".$checkboxon[$Q4] ."type=\"checkbox\" value=\"1\" name=\"Q4\" >Quake 4</label><br>
        <label><input ".$checkboxon[$CS] ."type=\"checkbox\" value=\"1\" name=\"CS\" >Counter-Strike</label><br>
        <label><input ".$checkboxon[$D3] ."type=\"checkbox\" value=\"1\" name=\"D3\" >Doom 3</label><br>
        <label><input ".$checkboxon[$HL] ."type=\"checkbox\" value=\"1\" name=\"HL\" >Half-Life</label><br>
        <label><input ".$checkboxon[$HL2]."type=\"checkbox\" value=\"1\" name=\"HL2\">Half-Life 2</label><br>
        <label><input ".$checkboxon[$HX2]."type=\"checkbox\" value=\"1\" name=\"HX2\">Hexen II</label>
      </td>
      <td class=\"filterbody\" valign=top align=left style=\"padding-left: 8px; padding-right: 8px;\">
        <label><input ".$checkboxon[$HR2]  ."type=\"checkbox\" value=\"1\" name=\"HR2\"  >Heretic 2</label><br>
        <label><input ".$checkboxon[$KP]   ."type=\"checkbox\" value=\"1\" name=\"KP\"   >Kingpin</label><br>
        <label><input ".$checkboxon[$MOHAA]."type=\"checkbox\" value=\"1\" name=\"MOHAA\">Medal of Honor</label><br>
        <label><input ".$checkboxon[$SIN]  ."type=\"checkbox\" value=\"1\" name=\"SIN\"  >SiN</label><br>
        <label><input ".$checkboxon[$SOF]  ."type=\"checkbox\" value=\"1\" name=\"SOF\"  >Soldier of Fortune</label><br>
        <label><input ".$checkboxon[$EF]   ."type=\"checkbox\" value=\"1\" name=\"EF\"   >Star Trek Voyager: Elite Force</label><br>
        <label><input ".$checkboxon[$EF2]  ."type=\"checkbox\" value=\"1\" name=\"EF2\"  >Star Trek: Elite Force 2</label><br>
        <label><input ".$checkboxon[$ZZZ]  ."type=\"checkbox\" value=\"1\" name=\"ZZZ\"  >Unknown</label>
      </td></tr>
      <tr><td colspan=2 class=\"filterbody\" align=center>
        <label><input ".$checkboxon[$ZZX]."type=\"checkbox\" value=\"1\" name=\"ZZX\">Just show me for all games!</label>
      </td></tr>
    </table>
  </td>
  <td valign=top style=\"padding-left: 8px; padding-right: 8px;\"><b>and</b></td>
  <td valign=top style=\"padding-left: 8px; padding-right: 8px;\">
    <table cellspacing=0 cellpadding=0>
      <tr><td colspan=2 class=\"filterhead\"><b>Mods:</b></td></tr>
      <tr><td class=\"filterbody\" valign=top align=left style=\"padding-left: 8px; padding-right: 8px;\">
        <label><input ".$checkboxon[$M_NO] ."type=\"checkbox\" value=\"1\" name=\"M_NO\" >Vanilla game (no mods)</label><br>
        <label><input ".$checkboxon[$M_RA] ."type=\"checkbox\" value=\"1\" name=\"M_RA\" >Rocket Arena 'Q2'</label><br>
        <label><input ".$checkboxon[$M_TFC]."type=\"checkbox\" value=\"1\" name=\"M_TFC\">Team Fortress 'Q1/HL'</label><br>
        <label><input ".$checkboxon[$M_ACT]."type=\"checkbox\" value=\"1\" name=\"M_ACT\">Action 'Q2/HL'</label><br>
        <label><input ".$checkboxon[$M_AIR]."type=\"checkbox\" value=\"1\" name=\"M_AIR\">AirQuake 'Q1/Q2'</label>
      </td>
      <td class=\"filterbody\" valign=top align=left style=\"padding-left: 8px; padding-right: 8px;\">
        <label><input ".$checkboxon[$M_GLM] ."type=\"checkbox\" value=\"1\" name=\"M_GLM\" >Gloom 'Q2'</label><br>
        <label><input ".$checkboxon[$M_OP4] ."type=\"checkbox\" value=\"1\" name=\"M_OP4\" >Opposing Forces 'HL'</label><br>
        <label><input ".$checkboxon[$M_KMQ2]."type=\"checkbox\" value=\"1\" name=\"M_KMQ2\">Knightmare 'Q2'</label><br>
        <label><input ".$checkboxon[$M_ZZZ] ."type=\"checkbox\" value=\"1\" name=\"M_ZZZ\" >Unknown</label>
      </td></tr>
      <tr><td colspan=2 class=\"filterbody\" align=center>
        <label><input ".$checkboxon[$M_ZZX]."type=\"checkbox\" value=\"1\" name=\"M_ZZX\">Just show me for all mods!</label>
      </td></tr>
    </table>
  </td>
  <td valign=top style=\"padding-left: 8px; padding-right: 8px;\"><b>and</b></td>
  <td valign=top style=\"padding-left: 8px; padding-right: 8px;\">
    <table cellspacing=0 cellpadding=0>
      <tr><td colspan=2 class=\"filterhead\"><b>Maptypes:</b></td></tr>
      <tr><td class=\"filterbody\" valign=top align=left style=\"padding-left: 8px; padding-right: 8px;\">
        <label><input ".$checkboxon[$T_SP]  ."type=\"checkbox\" value=\"1\" name=\"T_SP\"  >Single player</label><br>
        <label><input ".$checkboxon[$T_COOP]."type=\"checkbox\" value=\"1\" name=\"T_COOP\">Cooperative</label><br>
        <label><input ".$checkboxon[$T_DM]  ."type=\"checkbox\" value=\"1\" name=\"T_DM\"  >Deathmatch</label><br>
        <label><input ".$checkboxon[$T_TP]  ."type=\"checkbox\" value=\"1\" name=\"T_TP\"  >Teamplay</label>
      </td>
      <td class=\"filterbody\" valign=top align=left style=\"padding-left: 8px; padding-right: 8px;\">
        <label><input ".$checkboxon[$T_TD]  ."type=\"checkbox\" value=\"1\" name=\"T_TD\"  >Team deathmatch</label><br>
        <label><input ".$checkboxon[$T_TOUR]."type=\"checkbox\" value=\"1\" name=\"T_TOUR\">Tourney</label><br>
        <label><input ".$checkboxon[$T_CTF] ."type=\"checkbox\" value=\"1\" name=\"T_CTF\" >Capture the Flag</label><br>
        <label><input ".$checkboxon[$T_ZZZ] ."type=\"checkbox\" value=\"1\" name=\"T_ZZZ\" >Unknown</label>
      </td></tr>
      <tr><td colspan=2 class=\"filterbody\" align=center>
        <label><input ".$checkboxon[$T_ZZX] ."type=\"checkbox\" value=\"1\" name=\"T_ZZX\">Just show me for all maptypes!</label>
      </td></tr>
    </table>
  </td>
  </tr>
  <tr><td colspan=9 align=center>
  <input type=\"submit\" value=\"Show me\">
  </td></tr>
</table>
</form>
Select minimum a game checkbox, mod checkbox, <u>and</u> a maptype checkbox, to view the list of maps.
</div>
";

# Create a search array for game-ids
$games = array();
if ($Q1  || $ZZX) $games[] = 'Q1';
if ($Q2  || $ZZX) $games[] = 'Q2';
if ($Q3A || $ZZX) $games[] = 'Q3';
if ($Q4  || $ZZX) $games[] = 'Q4';
if ($CS  || $ZZX) $games[] = 'CS';
if ($D3  || $ZZX) $games[] = 'D3';
if ($HL  || $ZZX) $games[] = 'HL';
if ($HL2 || $ZZX) $games[] = 'HL2';
if ($HX2 || $ZZX) $games[] = 'HX2';
if ($HR2 || $ZZX) $games[] = 'HR2';
if ($KP  || $ZZX) $games[] = 'KP';
if ($MOHAA || $ZZX) $games[] = 'MOHAA';
if ($SIN || $ZZX) $games[] = 'SIN';
if ($SOF || $ZZX) $games[] = 'SOF';
if ($EF  || $ZZX) $games[] = 'EF';
if ($EF2 || $ZZX) $games[] = 'EF2';
if ($ZZZ || $ZZX) $games[] = NULL;

# Create a search array for maptype-ids
$maptypes = array();
if ($T_SP   || $T_ZZX) $maptypes[] = 'SP';
if ($T_COOP || $T_ZZX) $maptypes[] = 'COOP';
if ($T_DM   || $T_ZZX) $maptypes[] = 'DM';
if ($T_TP   || $T_ZZX) $maptypes[] = 'TP';
if ($T_TD   || $T_ZZX) $maptypes[] = 'TD';
if ($T_TOUR || $T_ZZX) $maptypes[] = 'TOUR';
if ($T_CTF  || $T_ZZX) $maptypes[] = 'CTF';
if ($T_ZZZ  || $T_ZZX) $maptypes[] = NULL;

# Create a search array for mod-ids
$mods = array();
if ($M_NO  || $M_ZZX) $mods[] = 'NO';
if ($M_RA  || $M_ZZX) $mods[] = 'RA';
if ($M_TFC || $M_ZZX) $mods[] = 'TFC';
if ($M_ACT || $M_ZZX) $mods[] = 'ACT';
if ($M_AIR || $M_ZZX) $mods[] = 'AIR';
if ($M_GLM || $M_ZZX) $mods[] = 'GLM';
if ($M_OP4 || $M_ZZX) $mods[] = 'OP4';
if ($M_KMQ2 || $M_ZZX) $mods[] = 'KMQ2';
if ($M_ZZZ || $M_ZZX) $mods[] = NULL;

# This is used for the next/prev button panel
#FIXME: This should be done better!
$listhidden = '';
if ($Q1)  $listhidden .= '<input type="hidden" name="Q1" value="1">';
if ($Q2)  $listhidden .= '<input type="hidden" name="Q2" value="1">';
if ($Q3A) $listhidden .= '<input type="hidden" name="Q3A" value="1">';
if ($Q4)  $listhidden .= '<input type="hidden" name="Q4" value="1">';
if ($CS)  $listhidden .= '<input type="hidden" name="CS" value="1">';
if ($D3)  $listhidden .= '<input type="hidden" name="D3" value="1">';
if ($HL)  $listhidden .= '<input type="hidden" name="HL" value="1">';
if ($HL2) $listhidden .= '<input type="hidden" name="HL2" value="1">';
if ($HX2) $listhidden .= '<input type="hidden" name="HX2" value="1">';
if ($HR2) $listhidden .= '<input type="hidden" name="HR2" value="1">';
if ($KP)  $listhidden .= '<input type="hidden" name="KP" value="1">';
if ($MOHAA) $listhidden .= '<input type="hidden" name="MOHAA" value="1">';
if ($SIN) $listhidden .= '<input type="hidden" name="SIN" value="1">';
if ($SOF) $listhidden .= '<input type="hidden" name="SOF" value="1">';
if ($EF)  $listhidden .= '<input type="hidden" name="EF" value="1">';
if ($EF2) $listhidden .= '<input type="hidden" name="EF2" value="1">';
if ($ZZZ) $listhidden .= '<input type="hidden" name="ZZZ" value="1">';
if ($ZZX) $listhidden .= '<input type="hidden" name="ZZX" value="1">';

if ($M_NO)   $listhidden .= '<input type="hidden" name="M_NO" value="1">';
if ($M_RA)   $listhidden .= '<input type="hidden" name="M_RA" value="1">';
if ($M_TFC)  $listhidden .= '<input type="hidden" name="M_TFC" value="1">';
if ($M_ACT)  $listhidden .= '<input type="hidden" name="M_ACT" value="1">';
if ($M_AIR)  $listhidden .= '<input type="hidden" name="M_AIR" value="1">';
if ($M_GLM)  $listhidden .= '<input type="hidden" name="M_GLM" value="1">';
if ($M_OP4)  $listhidden .= '<input type="hidden" name="M_OP4" value="1">';
if ($M_KMQ2) $listhidden .= '<input type="hidden" name="M_KMQ2" value="1">';
if ($M_ZZZ)  $listhidden .= '<input type="hidden" name="M_ZZZ" value="1">';
if ($M_ZZX)  $listhidden .= '<input type="hidden" name="M_ZZX" value="1">';

if ($T_SP)   $listhidden .= '<input type="hidden" name="T_SP" value="1">';
if ($T_COOP) $listhidden .= '<input type="hidden" name="T_COOP" value="1">';
if ($T_DM)   $listhidden .= '<input type="hidden" name="T_DM" value="1">';
if ($T_TP)   $listhidden .= '<input type="hidden" name="T_TP" value="1">';
if ($T_TD)   $listhidden .= '<input type="hidden" name="T_TD" value="1">';
if ($T_CTF)  $listhidden .= '<input type="hidden" name="T_CTF" value="1">';
if ($T_ZZZ)  $listhidden .= '<input type="hidden" name="T_ZZZ" value="1">';
if ($T_ZZX)  $listhidden .= '<input type="hidden" name="T_ZZX" value="1">';

function pageLocalDisplay()
{
	global $usermapsform, $games, $maptypes, $mods;
	global $gameslist, $maptypeslist, $modslist;

	global $userlevelsdatabase;
	global $mapname_arraycol;
	global $maptype_arraycol;
	global $game_arraycol;
	global $mod_arraycol;
	global $screenshot_arraycol;
	global $description_arraycol;
	global $download_arraycol;
	global $size_arraycol;
	global $author_arraycol;
	global $website_arraycol;

	global $personsdatabase;

	pageName('User maps');

	pagePanel(NULL, 'Filter...', '', $usermapsform);

	if ($games && $maptypes && $mods)
	{
		global $page;
		global $listhidden;

		# First, find all the maps that match the filter options
		$SelectedMaps = array();

		for ($mapno = 0; $mapno < count($userlevelsdatabase); $mapno++)
		{
			$CurrentUserMap = &$userlevelsdatabase[$mapno];
			if ((count(array_intersect(explode(' ', $CurrentUserMap[$game_arraycol]), $games)) !== 0) && (count(array_intersect(explode(' ', $CurrentUserMap[$maptype_arraycol]), $maptypes)) !== 0) && (count(array_intersect(explode(' ', $CurrentUserMap[$mod_arraycol]), $mods)) !== 0))
			{
				$SelectedMaps[] = $mapno;
			}
		}

		$SelectedMapsCount = count($SelectedMaps);
		if ($SelectedMapsCount === 0)
		{
			$bodytext = '<p>No user maps matching your filter options were found.</p>';
			pagePanel('community', 'Nothing to display', '', $bodytext);
		}
		else
		{
			global $Settings;
			global $UserMapsPageSize;
			$mapsperpage = $Settings[$UserMapsPageSize]->GetCurrentValue();

			$max_page = (floor(($SelectedMapsCount + $mapsperpage - 1) / $mapsperpage)) - 1;

			if (($page * $mapsperpage) > $SelectedMapsCount)
			{
				$page = 0;
			}

			#FIXME: Allow to disable paging!
			if ($SelectedMapsCount > $mapsperpage)
			{
				# If needed, display the top paging panel
				if ($page > 0)
				{
					$prevbutton = '<form action="usermaps.php" method="get">'.$listhidden.'<input type="hidden" name="page" value="' . ($page + 1 - 1) . '"><input type="submit" value="&lt;--- Prev page"></form>';
				}
				else
				{
					$prevbutton = '';
				}
				if ($page < $max_page)
				{
					$nextbutton = '<form action="usermaps.php" method="get">'.$listhidden.'<input type="hidden" name="page" value="' . ($page + 1 + 1) . '"><input type="submit" value="Next page ---&gt;"></form>';
				}
				else
				{
					$nextbutton = '';
				}
				$filterpanel = ''; #$listhidden
				#FIXME: TEMP:
				$filterpanel = 'Page: ' . ($page + 1) . ' / ' . ($max_page + 1);

				$pagepaneltext = '<table cellspacing=8 cellpadding=0 width="100%"><tr><td align=left>'.$prevbutton.'</td><td align=center>'.$filterpanel.'</td><td align=right>'.$nextbutton.'</td></tr></table>';
				pagePanel(NULL, 'Select...', '', $pagepaneltext);
			}

			# Display the maps
			for ($SelectedMap = $page * $mapsperpage; $SelectedMap < (($page + 1) * $mapsperpage); $SelectedMap++)
			{
				if ($SelectedMap === $SelectedMapsCount)
					# Done all the maps that need to be done (this page is not full)
					break;
				$CurrentUserMap = &$userlevelsdatabase[$SelectedMaps[$SelectedMap]];

				$bodytext = '<table cellspacing="2px" cellpadding=0>';

				$bodytext .= '<tr><td>';
				$bodytext .= 'Maptype:';
				$bodytext .= '</td><td>';
				$currentmaptypes = explode(' ', $CurrentUserMap[$maptype_arraycol]);
				for ($i = 0; $i < count($currentmaptypes); $i++)
				{
					if ($i !== 0)
						$bodytext .= '<br>';
					$bodytext .= $maptypeslist[$currentmaptypes[$i]];
				}
				$bodytext .= '</td></tr>';

				if (!is_null($CurrentUserMap[$screenshot_arraycol]))
				{
					$bodytext .= '<tr><td>';
					$bodytext .= 'Screenshot:';
					$bodytext .= '</td><td>';
					$bodytext .= '<a rel="noopener" target="_blank" href="' . $CurrentUserMap[$screenshot_arraycol] . '">Click here</a>';
					$bodytext .= '</td></tr>';
				}

				$bodytext .= '<tr><td>';
				$bodytext .= 'Size:';
				$bodytext .= '</td><td>';
				if (is_null($CurrentUserMap[$size_arraycol]))
					$bodytext .= '*unknown*';
				else
					$bodytext .= DisplayByteSize($CurrentUserMap[$size_arraycol]);
				$bodytext .= '</td></tr>';

				$bodytext .= '<tr><td>';
				$bodytext .= '<b>Download</b>:';
				$bodytext .= '</td><td>';
				if (is_null($CurrentUserMap[$download_arraycol]))
					$bodytext .= '*no link*';
				else
					$bodytext .= '<a rel="noopener" target="_blank" href="' . $CurrentUserMap[$download_arraycol] . '">Click here</a>';
				$bodytext .= '</td></tr>';

				$bodytext .= '<tr><td>';
				$bodytext .= '&nbsp;';
				$bodytext .= '</td><td>';
				$bodytext .= '&nbsp;';
				$bodytext .= '</td></tr>';

				if (!is_null($CurrentUserMap[$author_arraycol]))
				{
					$bodytext .= '<tr><td>';
					$bodytext .= 'Author:';
					$bodytext .= '</td><td>';
					for ($i = 0; $i < count($CurrentUserMap[$author_arraycol]); $i++)
					{
						if ($i !== 0)
						{
							$bodytext .= '<br>';
						}
						$PersonIndex = $CurrentUserMap[$author_arraycol][$i];
						$CurrentPerson = &$personsdatabase[$PersonIndex]; //FIXME: Check for bounds?
						$bodytext .= '<a href="person.php?PersonID='.($PersonIndex+1).'">'.$CurrentPerson->getDisplayName().'</a>'; //FIXME: Need to escape HTML entities!!! EVERYWHERE!!!
					}
					$bodytext .= '</td></tr>';
				}

				if (!is_null($CurrentUserMap[$website_arraycol]))
				{
					$bodytext .= '<tr><td>';
					$bodytext .= 'Website:';
					$bodytext .= '</td><td>';
					$bodytext .= '<a rel="noopener" target="_blank" href="' . $CurrentUserMap[$website_arraycol] . '">Website</a>';
					$bodytext .= '</td></tr>';
				}

				$bodytext .= '</table>';

				$bodytext .= '<br>';

				$bodytext .= '<p>Description:<br>';
				if (is_null($CurrentUserMap[$description_arraycol]))
				{
					$bodytext .= '-';
				}
				else
				{
					$bodytext .= $CurrentUserMap[$description_arraycol];
				}
				$bodytext .= '</p>';

				pagePanel('community', $CurrentUserMap[$mapname_arraycol], $gameslist[$CurrentUserMap[$game_arraycol]], $bodytext);
			}

			if ($SelectedMapsCount > $mapsperpage)
			{
				# Display bottom paging panel
				$pagepaneltext = '<table cellspacing=8 cellpadding=0 width="100%"><tr><td align=left>'.$prevbutton.'</td><td align=right>'.$nextbutton.'</td></tr></table>';
				pagePanel(NULL, '', '', $pagepaneltext);
			}
		}
	}
	else
	{
		$bodytext = '<p>Please select both at least one game, mod, <u>and</u> maptype!</p>';
		pagePanel('alert', 'Nothing to display', '', $bodytext);
	}
}

pageDisplay('User maps', 'pageLocalDisplay');

?>
