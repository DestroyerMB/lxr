<?php

  //draw main menu
  function MainMenu($id_user)
  {
	require_once 'privs.php';
	
	global $user_id;//=htmlspecialchars(stripslashes(substr($_REQUEST[user_id],0,10)));
	
	print "<ul id=\"nav\">";
	print "	<li><a href=\"index.php\">Сводка</a></li>";
    print "	<li><a href=\"\">Задачи</a>";
    print "		<ul>";
    if(HasPrivs($user_id,'new_task')) print "			<li id=\"task_add_menu\"><a href=\"#null\">Новая задача</a></li>";
	if(HasPrivs($user_id,'tasks_view')) print "			<li><a href=\"index.php?action=tasks_view_my\">Мои задачи</a></li>";
	if(HasPrivs($user_id,'tasks_view')) print "			<li><a href=\"index.php?action=tasks_view\">Все задачи</a></li>";
	/*if(HasPrivs($user_id,'zrcadlo_view')) 
	{
		print "			<li><a href=\"#null\">Zrcadlo skladu</a>";
		print "				<ul>";
		print "					<li><a href=\"#null\">Zrcadlo sklad</a></li>";
		print "					<li><a href=\"#null\">Zrcadlo skladu na datum</a></li>";
		print "				</ul>";
		print "			</li>";
	}*/
	print "		</ul>";
	print "	</li>";
	if(HasPrivs($user_id,'users_view')) print "	<li><a href=\"index.php?action=users_view\">Коллеги</a></li>";
	print "			<li><a href=\"#null\">Справочники</a>";
	print "				<ul>";
	//print "					<li><a href=\"#null\">Контакты</a></li>";
	//print "					<li><a href=\"#null\">Проекты</a></li>";
	print "					<li><a href=\"index.php?action=types_view\">Типы задач</a></li>";
	print "					<li><a href=\"index.php?action=statuses_view\">Статусы задач</a></li>";
	print "				</ul>";
	print "			</li>";
	print "	<li><a href=\"\">Сервис</a><ul>";
    if(HasPrivs($user_id,'trzba_view')) print "	<li><a href=\"index.php?action=backup_view\">Резервное копирование</a></li>";
	print "</ul></li>";
	print "</ul><br>";
  }
?>