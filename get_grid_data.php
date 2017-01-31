<?
session_start();
require_once 'test.php';
require_once 'desktop.php';
require_once 'tasks.php';
require_once 'types.php';
require_once 'statuses.php';
require_once 'users.php';

$section=htmlspecialchars(stripslashes(substr($_REQUEST[section],0,30)));
if($section=='') return;

if($section=='desktop') DesktopView(true);
else if($section=='tasks') TasksView(false,false);
else if($section=='tasks_my') TasksView(false,true);
else if($section=='types') TypesView(false);
else if($section=='statuses') StatusesView(false);
else if($section=='users') UsersView(false);
else print $section.' NO DATA !!!';

?>