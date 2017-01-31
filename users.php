<?
	
	function UsersView($with_menu)
	{
		require 'env.php';
		
		if($with_menu)
		{
			//print "<div class=\"top\" align=\"right\"><button id=\"user_add\">Новый</button><button id=\"user_edit\">Редактировать</button><button id=\"user_delete\">Удалить</button> <button id=\"user_password\">Пароль</button><button id=\"user_privs\">Права</button></div>\n";
			print "<div class=\"top\" align=\"right\"><button id=\"user_add\">Добавить</button><button id=\"user_delete\">Удалить</button> <button id=\"user_password\">Сообщения</button></div>\n";
			print "<div id=\"content\">";
			print "<div id=\"data_grid\">\n";
		}
		
		print "<table id=\"data\" class=\"ui-widget\">\n";
		print "		<thead>\n";
		print "			<tr><th id=\"login\" class=\"ui-widget-header\">Логин</th><th id=\"name\" class=\"ui-widget-header\">ФИО</th><th id=\"contacts\" class=\"ui-widget-header\">Контактная информация</th></tr>\n";
		print "		</thead>\n";
		print "		<tbody>\n";
		
		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
  
		$sql="select id,login,name,info from ".$prefix."users order by login";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print "			<tr id=".$row[0]."><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>\n";
		}
		
		if($with_menu) print "</div>\n";
  }

?>