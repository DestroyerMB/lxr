<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	
	<title>DB test</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
</head>

<body>

<?php
  
  require 'env.php';

  $host2=htmlspecialchars(stripslashes(substr($_REQUEST['host'],0,50)));
  $db_user2=htmlspecialchars(stripslashes(substr($_REQUEST['db_user'],0,20)));
  $db_password2=htmlspecialchars(stripslashes(substr($_REQUEST['db_password'],0,255)));
  $db2=htmlspecialchars(stripslashes(substr($_REQUEST['db'],0,255)));
  $create=htmlspecialchars(stripslashes(substr($_REQUEST['create'],0,1)));
  
  if($host2!="") $host=$host2;
  if($db_user2!="") $db_user=$db_user2;
  if($db_password2!="") $db_password=$db_password2;
  if($db2!="") $db=$db2;

  print 'Usage: dbtest.php?host=localhost&db_user=test&db_password=test&db=test_data&create=0/1'.'<br><br>';
  print 'host: '.$host.'<br>';  
  print 'db_user: '.$db_user.'<br>';
  print 'db_password: '.$db_password.'<br>';  
  print 'db: '.$db.'<br>';  
  print 'create: '.$create.'<br><br>';  

  $link = mysql_connect($host, $db_user, $db_password);
  if (!$link) { die('Could not connect: ' . mysql_error()); }
  mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
  
	if($create)
	{
		//users
		$sql="CREATE TABLE IF NOT EXISTS `".$prefix."users` (`id` INT(10) NOT NULL AUTO_INCREMENT,`login` VARCHAR(50) NOT NULL DEFAULT '',`name` VARCHAR(50) NULL DEFAULT NULL,`info` VARCHAR(255) NULL DEFAULT NULL,`password` VARCHAR(50) NULL DEFAULT NULL,PRIMARY KEY (`id`));";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		$sql="delete from ".$prefix."users";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."users(login,name,password) values('demo','demo',md5('demo'))";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		//regions
		$sql="CREATE TABLE IF NOT EXISTS `".$prefix."regions` (`id` INT(10) NOT NULL AUTO_INCREMENT,ord INT(10) NOT NULL DEFAULT 1,`name` VARCHAR(50) NULL DEFAULT NULL,PRIMARY KEY (`id`));";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		$sql="delete from ".$prefix."regions";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."regions(name) values('Luxembourg')";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."regions(name) values('Trier')";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		//types
		$sql="CREATE TABLE IF NOT EXISTS `".$prefix."types` (`id` INT(10) NOT NULL AUTO_INCREMENT,ord INT(10) NOT NULL DEFAULT 1,`name` VARCHAR(50) NULL DEFAULT NULL,PRIMARY KEY (`id`));";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		$sql="delete from ".$prefix."types";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."types(name) values('apartment')";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		//statuses
		$sql="CREATE TABLE IF NOT EXISTS `".$prefix."statuses` (`id` INT(10) NOT NULL AUTO_INCREMENT,ord INT(10) NOT NULL DEFAULT 1,`name` VARCHAR(50) NULL DEFAULT NULL,`color` VARCHAR(10) NOT NULL DEFAULT '#eeffff',PRIMARY KEY (`id`));";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		$sql="delete from ".$prefix."statuses";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."statuses(name) values('confirmed')";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		//options
		$sql="CREATE TABLE IF NOT EXISTS `".$prefix."options` (`id` INT(10) NOT NULL AUTO_INCREMENT,ord INT(10) NOT NULL DEFAULT 1,`name` VARCHAR(50) NULL DEFAULT NULL,PRIMARY KEY (`id`));";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		$sql="delete from ".$prefix."options";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."options(name) values('Internet')"; 
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."options(name) values('Pets allowed')";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		//tasks
		$sql="CREATE TABLE IF NOT EXISTS `".$prefix."tasks` (`id` INT(10) NOT NULL AUTO_INCREMENT,type_id INT(10) NULL DEFAULT NULL,status_id INT(10) NULL DEFAULT NULL,user_id INT(10) NULL DEFAULT NULL,task_date datetime NULL DEFAULT NULL,`subject` VARCHAR(255) NULL DEFAULT NULL,`note` VARCHAR(255) NULL DEFAULT NULL,PRIMARY KEY (`id`));";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		$sql="delete from ".$prefix."tasks";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."tasks(type_id,status_id,user_id,task_date,subject,note) values(1,1,1,now(),'Test task','Already done')";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		//ads
		$sql="CREATE TABLE IF NOT EXISTS `".$prefix."ads` (`id` INT(10) NOT NULL AUTO_INCREMENT,region_id INT(10) NULL DEFAULT NULL,type_id INT(10) NULL DEFAULT NULL,status_id INT(10) NULL DEFAULT NULL,user_id INT(10) NULL DEFAULT NULL,created datetime NULL DEFAULT NULL,`subject` VARCHAR(255) NULL DEFAULT NULL,`note` VARCHAR(255) NULL DEFAULT NULL,PRIMARY KEY (`id`));";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		$sql="delete from ".$prefix."ads";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."ads(region_id,type_id,status_id,user_id,created,subject,note) values(1,1,1,1,now(),'Nice apartments near Trier','No agencies and no comission!')";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		//ads options
		$sql="CREATE TABLE IF NOT EXISTS `".$prefix."ads_options` (`id` INT(10) NOT NULL AUTO_INCREMENT,ads_id INT(10) NOT NULL,options_id INT(10) NOT NULL,PRIMARY KEY (`id`));";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
		$sql="delete from ".$prefix."ads_options";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."ads_options(ads_id,options_id) values(1,1)"; 
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		$sql="insert into ".$prefix."ads_options(ads_id,options_id) values(1,2)"; 
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		
	}
	
	$sql="select name from ".$prefix."users order by login";   
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	while ($row = mysql_fetch_array($result)) 
	{
			print $row[0]."<br>";
	}
  
  print '<br>OK - all works! ;)';
  
  mysql_close($link);
?>

</body>
</html>
