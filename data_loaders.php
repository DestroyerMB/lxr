<?php

	function fill_regions()
	{
		require 'env.php';

		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
		
		$sql="select id,name from ".$prefix."regions order by ord";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print " <option value=".$row[0].">".$row[1]."</option>";
		}	
	}
	
	function fill_types()
	{
		require 'env.php';

		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
		
		$sql="select id,name from ".$prefix."types order by ord";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print " <option value=".$row[0].">".$row[1]."</option>";
		}	
	}
	
	function fill_options()
	{
		require 'env.php';

		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use '.$db.' : ' . mysql_error());
		
		$sql="select id,name from ".$prefix."options order by ord";
		$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			print " <option value=".$row[0].">".$row[1]."</option>";
		}	
	}

?>