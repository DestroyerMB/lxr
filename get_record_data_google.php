<?
	session_start();
	require 'env.php';

	$id=htmlspecialchars(stripslashes(substr($_REQUEST[id],0,30)));

	$link = mysql_connect($host, $db_user, $db_password);
	if (!$link) { die('Could not connect: ' . mysql_error()); }
	mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
		
	$sql="select id,user_id,type_id,date_format(task_date,'%Y%m%dT%H%i00'),date_format(task_date+interval 1 hour,'%Y%m%dT%H%i00'),subject,note from ".$prefix."tasks where id=$id";
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	while ($row = mysql_fetch_array($result)) 
	{
		print "text=".$row[5]."&dates=".$row[3]."/".$row[4]."&ctz=Europe/Moscow&details=".$row[6];
	}
?>