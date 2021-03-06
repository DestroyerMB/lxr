<?
	//draw main menu
	function TasksView($with_menu,$my_only)
	{
		require 'env.php';
		require_once 'privs.php';
		
		$user_id=htmlspecialchars(stripslashes(substr($_REQUEST[user_id],0,10)));
		
		if($with_menu)
		{
			print "<div class=\"search_header\" align=\"left\">";
			print "<table border=0 class=\"non_data_table\">";
			
			if(!$my_only)
			{
				//user search
				print "<tr><td>";
				print "<label for=\"task_search_user\">Кому</label>";
				print "</td><td>";
				print "<select onchange=\"filter_data(this,'-user')\" name=\"tasks_search\" id=\"tasks_search_user\">";
				print "<option value=\"\"></option>\n";
				$link = mysql_connect($host, $db_user, $db_password);
				if (!$link) { die('Could not connect: ' . mysql_error()); }
				mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
			
				$sql="select id,name from ".$prefix."users order by name";
				$result = mysql_query($sql);
				while ($row = mysql_fetch_array($result)) print "<option value=\"".$row[0]."\">".$row[1]."</option>\n";
			
				print "</select></td>";
			}
			
			//type search
			print "<td>";
			print "<label for=\"task_search_type\">Тип задачи</label>";
			print "</td><td>";
			print "<select onchange=\"filter_data(this,'-type')\" name=\"tasks_search\" id=\"tasks_search_type\">";
			print "<option value=\"\"></option>\n";
			$link = mysql_connect($host, $db_user, $db_password);
			if (!$link) { die('Could not connect: ' . mysql_error()); }
			mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
			
			$sql="select id,name from ".$prefix."types order by name";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result)) print "<option value=\"".$row[0]."\">".$row[1]."</option>\n";
			
			print "</select></td>";
			
			//status search
			print "<td>";
			print "<label for=\"task_search_status\">Статус задачи</label>";
			print "</td><td>";
			print "<select onchange=\"filter_data(this,'-status')\" name=\"tasks_search\" id=\"tasks_search_status\">";
			print "<option value=\"\"></option>\n";
			$link = mysql_connect($host, $db_user, $db_password);
			if (!$link) { die('Could not connect: ' . mysql_error()); }
			mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
			
			$sql="select id,name from ".$prefix."statuses order by name";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_array($result)) print "<option value=\"".$row[0]."\">".$row[1]."</option>\n";
			
			print "</select></td>";
			
			//name search
			print "<td>";
			print "<label for=\"tasks_name_search\">Поиск по названию</label>";
			print "</td><td>";
			print "<input type=\"search\" name=\"tasks_name_search\" id=\"tasks_name_search\" value=\"\" />";
			print "</td></tr></table>";
			print "</div>\n";
			
			//toolbar
			print "<div class=\"top\" align=\"right\">";
			if(HasPrivs($user_id,'task_add')) 
			{
				if($my_only) print "<button id=\"task_add_my\">Новая</button>";
				else print "<button id=\"task_add\">Новая</button>";
			}
			if(HasPrivs($user_id,'task_edit')) 
			{
				if($my_only) print "<button id=\"task_edit_my\">Исправить</button>";
				else print "<button id=\"task_edit\">Исправить</button>";
			}
			if(HasPrivs($user_id,'task_delete')) 
			{
				if($my_only) print "<button id=\"task_delete_my\">Удалить</button>";
				else print "<button id=\"task_delete\">Удалить</button>";
			}
			print " <button id=\"task_google\">Добавить в Календарь Google</button>";
			print "</div>\n";
			print "<div id=\"content\">";
			print "<div id=\"data_grid\">\n";
		}
		
		print "<table id=\"data\" class=\"ui-widget\">\n";
		print "		<thead>\n";
		print "			<tr>";
		if(!$my_only) print "<th id=\"type\" class=\"ui-widget-header\">Кому</th>";
		print "<th id=\"type\" class=\"ui-widget-header\">Тип</th><th id=\"status\" class=\"ui-widget-header\">Статус</th><th id=\"status\" class=\"ui-widget-header\">Срок</th><th id=\"name\" class=\"ui-widget-header\">Название</th><th id=\"note\" class=\"ui-widget-header\">Описание</th></tr>\n";
		print "		</thead>\n";
		print "		<tbody>\n";
		
		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
  
		$sql="select t.id,tt.id,tt.name,s.id,s.name,date_format(t.task_date,'%d.%m.%Y %H:%i'),t.subject,t.note,s.color,u.id,u.name from ".$prefix."tasks t,".$prefix."types tt,".$prefix."statuses s,".$prefix."users u where tt.id=t.type_id and s.id=status_id and u.id=t.user_id";
		if($my_only) $sql=$sql." and t.user_id=".$user_id;
		$sql=$sql." order by tt.ord,tt.name,s.ord,s.name,u.name,t.subject";
		$result = mysql_query($sql) or die("Invalid query: " . $sql ."<br>". mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			$id=$row[0];
			$type_id=$row[1];
			$type=$row[2];
			$status_id=$row[3];
			$status=$row[4];
			$task_date=$row[5];
			if(strlen($task_date)>0 && substr($task_date,0,2)=='00') $task_date="";
			$name=$row[6];
			$note=$row[7];
			$color=$row[8];
			$task_user_id=$row[9];
			$task_user_name=$row[10];
			
			print "			<tr id=".$id." class=\"filter-data\" data-filter=\"".$name."\" data-filter-type=\"".$type_id."\" data-filter-status=\"".$status_id."\" data-filter-user=\"".$task_user_id."\">";
			if(!$my_only) print "<td>".$task_user_name."</td>";
			print "<td>".$type."</td><td bgcolor=".$color.">".$status."</td><td>".$task_date."</td><td>".$name."</td><td>".$note."</td></tr>\n";
		}
		
		if($with_menu) print "</div>\n";
  }

?>