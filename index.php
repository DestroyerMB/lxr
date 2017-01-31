<?
session_start();
$user=htmlspecialchars(stripslashes(substr($_POST[user],0,30)));
$reset_user=htmlspecialchars(stripslashes(substr($_REQUEST[reset_user],0,3)));
$user_no_cookie=htmlspecialchars(stripslashes(substr($_REQUEST[user_no_cookie],0,3)));

$password=htmlspecialchars(stripslashes(substr($_REQUEST[password],0,30)));
if($password=='' && !$user_no_cookie) $password=htmlspecialchars(stripslashes(substr($_COOKIE[password],0,30)));

if($reset_user==1)
{
	setcookie('user','');
	setcookie('password','');
	$user='';
}
else
{
	if($user=='' && !$user_no_cookie) $user=htmlspecialchars(stripslashes(substr($_COOKIE[user],0,30)));
	$user_id=0;
	if($user!='') //check user in DB
	{
		require 'env.php';
		
		$link = mysql_connect($host, $db_user, $db_password);
		if (!$link) { die('Could not connect: ' . mysql_error()); }
		mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
  
		$sql="select id,name from ".$prefix."users where login='".$user."' and password=md5('".$password."')";
		$result = mysql_query($sql) or die("Invalid query: $sql<br>" . mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{
			$user_id=$row[0];
			$user_name=$row[1];
		}
		
		/*if($user_id<=0 && $user=='awis' && $password=='antonie')
		{
			$sql="insert into provozni_users(login,name,password) values('".$user."','AWIS','".$password."')";
			$result = mysql_query($sql) or die("Invalid query: $sql<br>" . mysql_error());
			$sql="select id from provozni_users where login='".$user."' and password=md5('".$password."')";   
			$result = mysql_query($sql) or die("Invalid query: $sql<br>" . mysql_error());
			while ($row = mysql_fetch_array($result)) 
			{
				$user_id=$row[0];
			}
		}*/
		
		/*if($user=='admin' && $password=='admin')
		{
			$user_id=1;
		}
		else if($user=='sef')
		{
			$user_id=2;
		}*/
		
		if($user_id>0)
		{
			setcookie('user',$user,time()+24*60*60);
			setcookie('password',$password,time()+24*60*60);
			setcookie('user_id',$user_id,time()+24*60*60);
			setcookie('user_name',$user_name,time()+24*60*60);
		}
		else
		{		
			$user='';
			$user_name='';
			$wrong_user=1;
		}
	}
}

include 'main.php'
?>