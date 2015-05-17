<?php
define('PATH',"./");
require_once(PATH."phpinc/constant.php");
require_once(PATH."phpinc/main.class.php"); $main = new main();

$srch = preg_replace('/[^da-z]/i', '', $_GET["srch"]);
$list = $main->auto_complete($srch);
foreach ($list as $rs) {
   // put in bold the written text
	$word = str_replace($_POST['keyword'], '<strong>'.$_POST['keyword'].'</strong>', $rs[$srch]);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs[$srch]).'\')">'.$word.'</li>';
   }

?>