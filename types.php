<?
	
	function TypesView($with_menu)
	{
		require 'env.php';
		
		if($with_menu)
		{
			print "<div class=\"top\" align=\"right\"><button id=\"type_add\">Новый</button><button id=\"type_edit\">Редактировать</button><button id=\"type_delete\">Удалить</button></div>\n";
			print "<div id=\"content\">";
			print "<div id=\"data_grid\">\n";
		}
		
		print "<table id=\"data\" class=\"ui-widget\">\n";
		print "		<thead>\n";
		print "			<tr><th id=\"ord\" class=\"ui-widget-header\">Порядок</th><th id=\"name\" class=\"ui-widget-header\">Наименование</th></tr>\n";
		print "		</thead>\n";
		print "		<tbody>\n";
		
		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
  
		$sql="select id,ord,name from ".$prefix."types order by name";   
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print "			<tr id=".$row[0]."><td>".$row[1]."</td><td>".$row[2]."</td></tr>\n";
		}
		
		if($with_menu) print "</div>\n";
  }

?>