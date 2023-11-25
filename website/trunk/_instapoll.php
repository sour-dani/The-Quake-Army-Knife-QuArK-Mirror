<?php
require_once('_functions.php');

global $mainroot;

/*$instapollno='3435';

global $picsroot;

$instapolltxt='
<form name="form'.$instapollno.'">
<div align=center>
<!-- 2001.02.26 -->
What do you think of QuArK\'s colorful captions:<br><br>
<img width=74 height=44 src="'.$picsroot.'instapoll/instapoll20010226.jpg">
</div>
<!--
<br>
<table cellspacing=2 cellpadding=0>
<tr><td class="instapoll" valign=top><input type=radio name="question" value="16245"></td><td class="instapoll">I don\'t use them and don\'t care if they disappear.<br><br></tr>
<tr><td class="instapoll" valign=top><input type=radio name="question" value="16244"></td><td class="instapoll">I somewhat use them, but would not miss them if they disappeared.<br><br></tr>
<tr><td class="instapoll" valign=top><input type=radio name="question" value="16243"></td><td class="instapoll">I use them and would miss them if they disappeared.<br><br></tr>
<tr><td class="instapoll" valign=top><input type=radio name="question" value="16246"></td><td class="instapoll">What colorful captions?</tr>
</table>
-->
<p>
<!--  <input type=button name="bVote" value=" Vote " onclick="instapoll'.$instapollno.'()">-->
&nbsp;<input type=button name="bView" value="Results" onclick="view'.$instapollno.'()">
</p>
</div>
</form>
';

$instapollscript='
<script language="Javascript" type="text/javascript">
<!--
function instapoll'.$instapollno.'() {
  url = "http://asp.planetquake.com/instapoll/poll.asp?poll_id='.$instapollno.'&maxwidth=300";
  count = 0;
  while (document.form'.$instapollno.'.question[count].checked != true) { count++; }
  url += "&choice=" + document.form'.$instapollno.'.question[count].value;
  ipwindow = open("","prewindow","scrollbars=yes,toolbar=no,height=340,width=500");
  ipwindow.location.href = url;
}
function view'.$instapollno.'() {
  url = "http://asp.planetquake.com/instapoll/poll.asp?poll_id='.$instapollno.'&maxwidth=300&dontvote=true";
  ipwindow = open("","prewindow","scrollbars=yes,toolbar=no,height=340,width=500");
  ipwindow.location.href = url;
}
// -->
</script>
';

pageSidePanel('', 'InstaPoll...', $instapollscript . $instapolltxt);*/

global $keepinframe;

$bodytext = 'There currently are no active instapolls. See <a ' . $keepinframe . 'href="'.$mainroot.'instapolls.php">here</a> for old instapolls.';
pageSidePanel('', 'InstaPoll...', $bodytext);

?>
