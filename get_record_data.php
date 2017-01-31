<?
	session_start();
	require 'env.php';

	$section=htmlspecialchars(stripslashes(substr($_REQUEST[section],0,30)));
	$id=htmlspecialchars(stripslashes(substr($_REQUEST[id],0,30)));

	$link = mysql_connect($host, $db_user, $db_password);
	if (!$link) { die('Could not connect: ' . mysql_error()); }
	mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
		
	if($section=='tasks')
	{
		$sql="select id,user_id,type_id,status_id,date_format(task_date,'%Y-%m-%d %H:%i'),subject,note from ".$prefix."tasks where id=$id";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print "task_user{=}".$row[1]."{|}task_type{=}".$row[2]."{|}task_status{=}".$row[3]."{|}task_date{=}".$row[4]."{|}task_subject{=}".$row[5].
					"{|}task_note{=}".$row[6]."{|}\n";
		}
	}
	else if($section=='types')
	{
		$sql="select id,ord,name from ".$prefix."types where id=$id";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print "type_ord{=}".$row[1]."{|}type_name{=}".$row[2]."{|}\n";
		}
	}
	else if($section=='statuses')
	{
		$sql="select id,ord,name,color from ".$prefix."statuses where id=$id";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print "status_ord{=}".$row[1]."{|}status_name{=}".$row[2]."{|}status_color{=}".$row[3]."{|}\n";
		}
	}
	else if($section=='users')
	{
		$sql="select id,login,name,info from ".$prefix."users where id=$id";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print "user_login{=}".$row[1]."{|}user_name{=}".$row[2]."{|}user_info{=}".$row[3]."{|}\n";
		}
	}
?>