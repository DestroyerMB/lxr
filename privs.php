<?
	function HasPrivs($user_id,$priv)
	{
		return true;
		
		/*require 'env.php';
		
		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) return false;
	
		$res = mysql_select_db($db, $link);
		if(!$res) return false;
			
		//check if it is awis
		$sql="select login from provozni_users where id=$user_id";
		$result = mysql_query($sql);
		if(!$result) return false;
		if ($row = mysql_fetch_array($result))
		{
			if($row[0]=='awis') return true;
		}
		
		//check privs
		$sql="select id from provozni_privs where user_id=$user_id and priv='$priv'";
		$result = mysql_query($sql);
		if(!$result) return false;
		if ($row = mysql_fetch_array($result)) return true;
		else return false;*/
	}
		
?>