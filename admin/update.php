<?php
//  ------------------------------------------------------------------------ //
// ���Ҳե� tad �s�@
// �s�@����G2007-11-04
// $Id: update.php,v 1.1 2008/05/14 01:23:55 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------�ޤJ�ɮװ�--------------*/
include "../../../include/cp_header.php";
include "../function.php";

/*-----------function��--------------*/
function update_form(){

  $main="<table  id='tbl'>
	<tr><th>"._MA_TADPLAYER_AUTOUPDATE."</th>
	<th>"._MA_TADPLAYER_AUTOUPDATE_VER."</th>
	<th>"._MA_TADPLAYER_AUTOUPDATE_STATUS."</th>
	<th>"._MA_TADPLAYER_AUTOUPDATE_GO."</th>
	</tr>";

  $dir="autoupdate";
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if(is_dir("$dir/$file"))continue;
					include_once "$dir/$file";
					
					$ok_text=($ok)?"OK":"---";
					$go_btn=($ok)?"":"<form action='$dir/$file' method='post'><input type='hidden' name='op' value='GO'><input type='submit' value='"._MA_TADPLAYER_AUTOUPDATE_GO."'></form>";
					
					$main.="<tr><td>{$ver}</td><td>$title</td>
					<td align='center'>$ok_text</td>
					<td align='center'>$go_btn</td></tr>";
					$ok="";
					
				}
			closedir($dh);
		}
	}
  $main.="</table>";
  
  $main=div_3d(_MA_TADPLAYER_AUTOUPDATE,$main,"corners","display:inline;");
  
	return $main;
}

/*-----------����ʧ@�P�_��----------*/
$op = (!isset($_REQUEST['op']))? "main":$_REQUEST['op'];

switch($op){

	
	default:
	$main=update_form();
	break;
}

/*-----------�q�X���G��--------------*/
xoops_cp_header();
echo "<link rel='stylesheet' type='text/css' media='screen' href='../module.css' />";
admin_toolbar(5);
echo $main;
xoops_cp_footer();

?>