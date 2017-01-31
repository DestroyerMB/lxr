<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	
	<title>Setup</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
</head>

<body>



<?php
  
	require 'env.php';

	$db_name=htmlspecialchars(stripslashes(substr($_REQUEST['db_name'],0,50)));
	if($db_name=="") $db_name="xn80aalk_tasks";
	$db_create=htmlspecialchars(stripslashes(substr($_REQUEST['db_create'],0,50)));
	$debug=htmlspecialchars(stripslashes(substr($_REQUEST['debug'],0,50)));
	
	$link = mysql_connect($host, $db_user, $db_password);
	if (!$link) { die('Could not connect: ' . mysql_error()); }
	mysql_select_db($db, $link) or die ("Can\'t use $db : " . mysql_error());
  
	if($db_create=="1") 
	{
		$sql="create database $db_name";
		if($debug=="1") print $sql.'<br>';
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		if($debug=="1") print 'OK<br><br>';
	}
	
	$sql="use $db_name";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';

	
	/* USERS */
	$sql="DROP TABLE IF EXISTS `".$prefix."users`;";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="CREATE TABLE `".$prefix."users` (
			`id` INT(10) NOT NULL AUTO_INCREMENT,
			`login` VARCHAR(50) NOT NULL DEFAULT '',
			`password` VARCHAR(50) NULL DEFAULT NULL,
			`name` VARCHAR(100) NULL DEFAULT NULL,
			`info` VARCHAR(255) NULL DEFAULT NULL,
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_bin;";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."users`(login,password,name,info) values('admin',md5('admin'),'Максим','Администратор системы');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."users`(login,password,name,info) values('alice',md5('alice'),'Алиса','Отдел дизайна');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."users`(login,password,name,info) values('svet',md5('svet'),'Светлана','Отдел продаж');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."users`(login,password,name,info) values('demo',md5('demo'),'Гость','Гостевой аккаунт');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	
	/* TYPES */
	$sql="DROP TABLE IF EXISTS `".$prefix."types`;";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="CREATE TABLE `".$prefix."types` (
			`id` INT(10) NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(50) NOT NULL,
			`ord` INT(10) NULL,
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_bin;";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."types`(name,ord) VALUES('Задача',1);";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."types`(name,ord) VALUES('Встреча',2);";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	
	/* STATUSES */	
	$sql="DROP TABLE IF EXISTS `".$prefix."statuses`;";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="CREATE TABLE `".$prefix."statuses` (
			`id` INT(10) NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(50) NOT NULL,
			`color` VARCHAR(6) NULL,
			`ord` INT(10) NULL,
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_bin;";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."statuses`(name,color,ord) VALUES('В работе','FFFFB0',2);";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."statuses`(name,color,ord) VALUES('Готово','D0FFB0',1);";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	
	/* TASKS */
	/*$sql="DROP TABLE IF EXISTS `".$prefix."tasks`;";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="CREATE TABLE `".$prefix."tasks` (
			`id` INT(10) NOT NULL AUTO_INCREMENT,
			`user_id` INT(10) NOT NULL,
			`type_id` INT(10) NOT NULL,
			`status_id` INT(10) NOT NULL,
			`task_date` DATETIME NULL,
			`subject` VARCHAR(255) NULL DEFAULT NULL,
			`note` VARCHAR(255) NULL DEFAULT NULL,
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_bin;";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,subject,note) VALUES(1,1,2,'Доработать окно логина','Обновить логитип, сделать подсказку для демо-входа');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,subject,note) VALUES(1,1,1,'Сделать форму регистрации','');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,task_date,subject,note) VALUES(1,2,1,now(),'Презентация системы','Клиент: ЛенОблБанк, м.Чкаловская');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,subject,note) VALUES(2,1,1,'Разработать дизайн для воронки продаж','');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,subject,note) VALUES(3,1,2,'Написать рецензию на новый каталог','');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,subject,note) VALUES(3,1,1,'Проверить остатки продукции на складе','');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,task_date,subject,note) VALUES(3,2,1,now()+interval 1 day,'Встретиться с клиентом в 16:30','Клиент: ЭкоФарм, м.Академическая');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,task_date,subject,note) VALUES(4,1,2,now()-interval 1 day,'Посмотреть как отображаются задачи','');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,task_date,subject,note) VALUES(4,1,1,now(),'Добавить новые задачи себе и коллегам','В одной из задач обозначить срок выполнения');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,subject,note) VALUES(4,1,1,'Пометить задачу как выполненную','В форме задачи в поле \"Статус\" выбрать \"Готово\"');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,task_date,subject,note) VALUES(4,1,1,now()+interval 1 day,'Зарегистрироваться в системе','Заполнить форму регистрации, подтвердить регистрацию по ссылке в теле письма');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';
	
	$sql="INSERT INTO `".$prefix."tasks`(user_id,type_id,status_id,task_date,subject,note) VALUES(4,1,1,now()+interval 2 day,'Добавить коллег для совместной работы в системе','В разделе \"Коллеги\" нажать кнопку \"Добавить\" и выбрать из списка зарегистрированных пользователей');";
	if($debug=="1") print $sql.'<br>';
	$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
	if($debug=="1") print 'OK<br><br>';*/
	
	print "<b>OK - database is ready! ;)</b>"
	
?>

</body>
</html>