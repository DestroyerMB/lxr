<?
	//draw main menu
	function AdsView($with_menu)
	{
		require 'env.php';
		require_once 'privs.php';
		
		$user_id=htmlspecialchars(stripslashes(substr($_REQUEST[user_id],0,10)));
		
		if($with_menu)
		{
			print "<div class=\"search_header\" align=\"left\">";
			print "<table border=0 class=\"non_data_table\">";
			
			//user search
			print "<tr><td>";
			print "<label for=\"task_search_user\">User</label>";
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
			
			//type search
			print "<td>";
			print "<label for=\"task_search_type\">Type</label>";
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
			print "<label for=\"task_search_status\">Status</label>";
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
			print "<label for=\"tasks_name_search\">Title search</label>";
			print "</td><td>";
			print "<input type=\"search\" name=\"tasks_name_search\" id=\"tasks_name_search\" value=\"\" />";
			print "</td></tr></table>";
			print "</div>\n";
			
			//toolbar
			print "<div class=\"top\" align=\"right\">";
			if(HasPrivs($user_id,'ad_add')) print "<button id=\"ad_add\">New</button>";
			if(HasPrivs($user_id,'ad_edit')) print "<button id=\"ad_edit\">Edit</button>";
			if(HasPrivs($user_id,'ad_delete')) print "<button id=\"task_delete\">Delete</button>";
			print "</div>\n";
			print "<div id=\"content\">";
			print "<div id=\"data_grid\">\n";
		}
		
		print "<table id=\"data\" class=\"ui-widget\">\n";
		print "		<thead>\n";
		print "			<tr>";
		print "<th id=\"status\" class=\"ui-widget-header\">Created</th>";
		print "<th id=\"type\" class=\"ui-widget-header\">User</th>";
		print "<th id=\"type\" class=\"ui-widget-header\">Region</th>";
		print "<th id=\"type\" class=\"ui-widget-header\">Type</th>";
		print "<th id=\"status\" class=\"ui-widget-header\">Status</th>";
		print "<th id=\"name\" class=\"ui-widget-header\">Title</th></tr>\n";
		print "		</thead>\n";
		print "		<tbody>\n";
		
		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
  
		$sql="select a.id,t.id,t.name,s.id,s.name,date_format(a.created,'%d.%m.%Y %H:%i'),a.name,a.note,s.color,u.id,u.name from ".$prefix."ads a,".$prefix."types t,".$prefix."statuses s,".$prefix."users u where t.id=a.type_id and s.id=a.status_id and u.id=a.user_id order by a.created desc,u.name,r.name,t.ord,s.ord,a.name";
		$result = mysql_query($sql) or die("Invalid query: " . $sql ."<br>". mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			$id=$row[0];
			$type_id=$row[1];
			$type=$row[2];
			$status_id=$row[3];
			$status=$row[4];
			$created=$row[5];
			$name=$row[6];
			$note=$row[7];
			$color=$row[8];
			$ad_user_id=$row[9];
			$ad_user_name=$row[10];
			
			print "			<tr id=".$id." class=\"filter-data\" data-filter=\"".$name."\" data-filter-type=\"".$type_id."\" data-filter-status=\"".$status_id."\" data-filter-user=\"".$ad_user_id."\">";
			print "<td>".$ad_user_name."</td>";
			print "<td>".$type."</td><td bgcolor=".$color.">".$status."</td><td>".$task_date."</td><td>".$name."</td><td>".$note."</td></tr>\n";
		}
		
		if($with_menu) print "</div>\n";
  }
?>
