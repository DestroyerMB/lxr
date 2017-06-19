<?php
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents('php://input'));

//check data

//save into db
require_once 'env.php';

$link = mysql_connect($host, $db_user, $db_password);
if (!$link) { die('Could not connect: ' . mysql_error()); }
mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
mysql_query("insert into ".$prefix."log(username,action,src,dt) values('".$data->username."','".$data->action.
            "','".$data->src."',now())");

print '<br>OK - all works! ;)';

mysql_close($link);

?>
