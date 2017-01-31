<?php
  session_start();
  require_once('env.php');

  //example of command
  //insert - dbgate.php?table=tables&action=insert&fields=id,nazev,pocet&vals=13,Zahradka|na|verande,4
  //update - dbgate.php?table=tables&action=update&fields=pocet&vals=5&where=id=13
  //delete - dbgate.php?table=tables&action=delete&where=id=13

  $table=htmlspecialchars(stripslashes(substr($_REQUEST['table'],0,50)));
  $action=htmlspecialchars(stripslashes(substr($_REQUEST['action'],0,20)));
  $fields=htmlspecialchars(stripslashes(substr($_REQUEST['fields'],0,255)));
  $vals=htmlspecialchars(stripslashes(substr($_REQUEST['vals'],0,255)));
  $vals=str_replace("|"," ",$vals);
  $where=htmlspecialchars(stripslashes(substr($_REQUEST['where'],0,255)));
  /*if(isset($where))
  {
   $where=str_replace("|"," ",$where);
   $where=str_replace("=","='",$where);
   $where=str_replace(">",">'",$where);
   $where=str_replace(",","' and ",$where);
   $where.="'";
  }*/
  
  $fields_len=strlen($fields);
  $vals_len=strlen($vals);
  $where_len=strlen($where);
  
/*;;print 'table:'.$table.'<br>';  
;;print 'action:'.$action.'<br>';
;;print 'fields:'.$fields.'<br>';
;;print 'vals:'.$vals.'<br>';*/

  $link = mysql_connect($host, $db_user, $db_password);
  if (!$link) { die('Could not connect: ' . mysql_error()); }
  mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
  
  // DELETE
  if($action=="delete")
  {
   $sql="delete from $table";   
   if(isset($where)) $sql.=" where $where";
  }
  // INSERT
  else if($action=="insert")
  {
   $vals=str_replace(",","','",$vals);
   $vals=str_replace("^",",",$vals);
   $sql="insert into $table($fields) values('$vals')";
  }
  // UPDATE
  else if($action=="update")
  {
   $sql="update $table set ";
   $vals_pos=-1;
   for($i=0;$i<$fields_len;$i++) 
   {
    if($fields[$i]==",")
	{
	 $sql.="='";
	 while(++$vals_pos<$vals_len) 
	 {
	  if($vals[$vals_pos]==',') 
	  {
	   $sql.="'";
	   break;
	  }
	  $sql.=str_replace("^",",",$vals[$vals_pos]);
	 }
	}
	$sql.="$fields[$i]";
   }
   $sql.="='";  
   while(++$vals_pos<$vals_len) 
   {
	if($vals[$vals_pos]==',') 
	{
	 $sql.="'";
	 break;
	}
	$sql.=str_replace("^",",",$vals[$vals_pos]);
   }
   $sql.="'";
   if(isset($where)) $sql.=" where $where";
  }

//;;print "sql: ".$sql."<br>";
  $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
  print "\nOK";
  mysql_close($link);
?>