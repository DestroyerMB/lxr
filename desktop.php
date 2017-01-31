<?

	//draw main menu
	function DesktopView($content_only)
	{
		require 'env.php';
		
		global $user_id;
		if($content_only) $user_id=htmlspecialchars(stripslashes(substr($_REQUEST[user_id],0,10)));
		
		if(!$content_only) print "<div id=\"content\">";
		
		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
  
		print "<div id=\"info_panel\" class=\"expired\" title=\"Просроченные задачи\">";
		$sql="select t.id,tt.name,s.name,date_format(t.task_date,'%d.%m.%Y %H:%i'),t.subject,t.note from ".$prefix."tasks t,".$prefix."types tt,".$prefix."statuses s where tt.id=t.type_id and s.id=status_id and t.user_id=".$user_id." and t.task_date is not null and t.task_date<>'0000-00-00 00:00:00' and t.task_date<now() order by t.task_date,tt.ord,tt.name,s.ord,s.name,t.subject";
		$result = mysql_query($sql) or die("Invalid query: " . $sql ."<br>". mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			$id=$row[0];
			$type=$row[1];
			$status=$row[2];
			$task_date=$row[3];
			if(strlen($task_date)>0 && substr($task_date,0,2)=='00') $task_date="";
			if(strlen($task_date)>0) $task_date="<span class=\"rounded_border\"> ".$task_date." </span>";
			$name=$row[4];
			$note=$row[5];
			print "<p id=\"task_desktop__".$id."\"><a id=\"task_edit_desktop__".$id."\" href=\"#null\"><img src=\"img/edit.png\"></a>&nbsp;&nbsp;<b>".$type."</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$task_date."<br><span class=\"big_font\">".$name."</span><br><i>".$note."</i></p><br>";
		}
		print "</div>";
		
		print "<div id=\"info_panel2\" title=\"Задачи на сегодня\">";
		$sql="select t.id,tt.name,s.name,date_format(t.task_date,'%d.%m.%Y %H:%i'),t.subject,t.note from ".$prefix."tasks t,".$prefix."types tt,".$prefix."statuses s where tt.id=t.type_id and s.id=status_id and t.user_id=".$user_id." and date_format(t.task_date,'%d.%m.%Y')=date_format(now(),'%d.%m.%Y') order by t.task_date,tt.ord,tt.name,s.ord,s.name,t.subject";
		$result = mysql_query($sql) or die("Invalid query: " . $sql ."<br>". mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			$id=$row[0];
			$type=$row[1];
			$status=$row[2];
			$task_date=$row[3];
			if(strlen($task_date)>0 && substr($task_date,0,2)=='00') $task_date="";
			if(strlen($task_date)>0) $task_date="<span class=\"rounded_border\"> ".$task_date." </span>";
			$name=$row[4];
			$note=$row[5];
			print "<p id=\"task_desktop__".$id."\"><a id=\"task_edit_desktop__".$id."\" href=\"#null\"><img src=\"img/edit.png\"></a>&nbsp;&nbsp;<b>".$type."</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$task_date."<br><span class=\"big_font\">".$name."</span><br><i>".$note."</i></p><br>";
		}
		print "</div>";
		
		print "<div id=\"info_panel3\" title=\"Остальные задачи\">";
		$sql="select t.id,tt.name,s.name,date_format(t.task_date,'%d.%m.%Y %H:%i'),t.subject,t.note from ".$prefix."tasks t,".$prefix."types tt,".$prefix."statuses s where tt.id=t.type_id and s.id=status_id and t.user_id=".$user_id." and (t.task_date is null or t.task_date='0000-00-00 00:00:00' or t.task_date>now()) order by t.task_date,tt.ord,tt.name,s.ord,s.name,t.subject";
		$result = mysql_query($sql) or die("Invalid query: " . $sql ."<br>". mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			$id=$row[0];
			$type=$row[1];
			$status=$row[2];
			$task_date=$row[3];
			if(strlen($task_date)>0 && substr($task_date,0,2)=='00') $task_date="";
			if(strlen($task_date)>0) $task_date="<span class=\"rounded_border\"> ".$task_date." </span>";
			$name=$row[4];
			$note=$row[5];
			print "<p id=\"task_desktop__".$id."\"><a id=\"task_edit_desktop__".$id."\" href=\"#null\"><img src=\"img/edit.png\"></a>&nbsp;&nbsp;<b>".$type."</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$task_date."<br><span class=\"big_font\">".$name."</span><br><i>".$note."</i></p><br>";
		}
		if(!$content_only) print "</div>";
	}

?>