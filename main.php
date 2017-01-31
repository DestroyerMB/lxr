<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	
	<title>rent-lux.com&#8482;</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<link rel="icon" type="image/png" href="img/tasks.png">
	
	<link rel="stylesheet" type="text/css" media="screen" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/dynamic_table.css" />
	<link rel="stylesheet" href="css/jquery.ui.all.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />

	
	<script src="js/jquery-1.8.0.js"></script>
	<script src="js/jquery.bgiframe-2.1.2.js"></script>
	<script src="js/ui/jquery.ui.core.js"></script>
	<script src="js/ui/jquery.ui.widget.js"></script>
	<script src="js/ui/jquery.ui.mouse.js"></script>
	<script src="js/ui/jquery.ui.button.js"></script>
	<script src="js/ui/jquery.ui.draggable.js"></script>
	<script src="js/ui/jquery.ui.position.js"></script>
	<script src="js/ui/jquery.ui.resizable.js"></script>
	<script src="js/ui/jquery.ui.dialog.js"></script>
	<script src="js/ui/jquery.effects.core.js"></script>
	<script src="js/ui/jquery.ui.selectable.js"></script>
	<script src="js/ui/jquery.ui.tabs.js"></script>
	<script src="js/ui/jquery.ui.autocomplete.js"></script>
	<script src="js/ui/jquery.ui.combobox.js"></script>
	<script src="js/ui/jquery.ui.datepicker.js"></script>
	<script src="js/ui/i18n/jquery.ui.datepicker-cs.js"></script>
	
	<!--<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/fabtabulous.js"></script>
	<script type="text/javascript" src="js/tablekit.js"></script>-->
	
	<script src="js/mb_messages.js"></script>
	<script src="js/mb_db.js"></script>
	<script src="js/mb_filter.js"></script>
	
	<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		function resize() {	
			var cnt=document.getElementById('content');
			if(cnt) cnt.setAttribute("style","height: "+(window.innerHeight-185).toString()+"px"); 
		}
		resize();
		$(window).resize(function() { resize();	});

		/*function moveScroller() {
			var move = function() {
			var st = $(window).scrollTop();
			var ot = 200;//$("#scroller-anchor").offset().top;
			var s = $("#scroller");
			if(st > ot) {
				s.css({
					position: "fixed",
					top: "0px",
					width: "99%"
				});
			} else {
				if(st <= ot) {
					s.css({
						position: "relative",
						top: "",
						width: ""
					});
				}
			}
		};
		$(window).scroll(move);
		move();
		}
		moveScroller();*/
		
		$("#tasks_name_search").keyup(function() { filter_data(this,''); });
		
		$.datepicker.setDefaults( $.datepicker.regional[ "cs" ] );
		$( "#date_from" ).datepicker({	showOn: "button", buttonImage: "img/calendar.gif",	buttonImageOnly: true, autoSize: true });
		$( "#date_to" ).datepicker({	showOn: "button", buttonImage: "img/calendar.gif",	buttonImageOnly: true, autoSize: true });
		
		$( "button").button();
		$( "#selectable" ).selectable();
		$( "#tabs" ).tabs();
		$( "#task_user" ).combobox();
		$( "#task_type" ).combobox();
		$( "#task_status" ).combobox();
		$( "#cenik_skupina" ).combobox();
		$( "#cenik_jednotka" ).combobox();
		
		function checkbox(btn) {
				var ch=$(btn).is(':checked');
				if(ch>=1) $(btn).button({ icons: { primary: "ui-icon-circle-check" } });
				else $(btn).button({icons:{}});
		}
		
		/*$( "#check_sklad_view" ).button().click(function() { checkbox(this); });
		$( "#check_sklad_add" ).button().click(function() { checkbox(this); });
		$( "#check_sklad_edit" ).button().click(function() { checkbox(this); });
		$( "#check_sklad_delete" ).button().click(function() { checkbox(this); });
		$( "#check_cenik_view" ).button().click(function() { checkbox(this); });
		$( "#check_cenik_add" ).button().click(function() { checkbox(this); });
		$( "#check_cenik_edit" ).button().click(function() { checkbox(this); });
		$( "#check_cenik_delete" ).button().click(function() { checkbox(this); });
		$( "#check_trzba_view" ).button().click(function() { checkbox(this); });*/
		$("[id^=check_]").button().click(function() { checkbox(this); });
		
		$('#data').selectable({
			filter:'tbody tr',
			stop: function(event, ui){
			document.getElementById('record_id').value=$( this ).find( ".ui-selected" ).map(function() { return this.id; }).get().join(", ");
			}
		});
		
		var g_Command = ""; //dialog command
		var g_Section = ""; //section to load after OK on dialog
		
		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Поле '" + n + "' должно содержать от " + min + " до " + max + " символов");
				return false;
			} else {
				return true;
			}
		}
		
		function replaceAll(str, src, rpl) {
			return str.replace(new RegExp(src,'g'),rpl);
		}
		
		function fillPokladna(text,value)	{
			var combo = document.getElementById("pokladna");
			var option = document.createElement("option");
			option.text = text;
			option.value = value;
			try {
				combo.add(option, null); //Standard 
			}catch(error) {
				combo.add(option); // IE only
			}
		}
		
		$(function() {
			$( "[id^=info_panel]" ).dialog();
		});
		
		$("#info_panel").dialog({
			closeOnEscape: false,
			draggable: false,
			resizable: false,
			height: 350,
			width: 300,
			dialogClass: "info_panel_expired",
			open: function(event, ui) { 
				$(event.target).parent().css('position', 'fixed');
				$(event.target).parent().css('top', '150px');
				$(event.target).parent().css('left', '30px');
			}
		});
		
		$("#info_panel2").dialog({
			closeOnEscape: false,
			draggable: false,
			resizable: false,
			height: 350,
			width: 300,
			dialogClass: "info_panel_today",
			open: function(event, ui) { 
				$(event.target).parent().css('position', 'fixed');
				$(event.target).parent().css('top', '150px');
				$(event.target).parent().css('left', '360px');
			}
		});
		
		$("#info_panel3").dialog({
			closeOnEscape: false,
			draggable: false,
			resizable: false,
			height: 350,
			width: 300,
			dialogClass: "info_panel_future",
			open: function(event, ui) { 
				$(event.target).parent().css('position', 'fixed');
				$(event.target).parent().css('top', '150px');
				$(event.target).parent().css('left', '690px');
			}
		});
		
		//TASK FORM
		var task_user = $( "#task_user" ),
			task_type = $( "#task_type" ),
			task_status = $( "#task_status" ),
			task_date = $( "#task_date" ),
			task_time = $( "#task_time" ),
			task_subject = $( "#task_subject" ),
			task_note = $( "#task_note" ),
			task_allFields = $( [] ).add( task_user ).add( task_type ).add( task_status ).add( task_date ).add( task_time ).add(task_subject).add(task_note),
			task_tips = $( ".validateTips" );
		
		$( "#task_form" ).dialog({
			autoOpen: false,
			height: 530,
			width: 330,
			modal: true,
			title: "Task",
			buttons: {
				"OK": function() {
					var bValid = true;
					task_allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( task_subject, "Наименование", 1, 255 );
					
					if ( bValid ) {
						var action='insert';						
						if(g_Command=="task_edit") action='update';			
						var datetime=task_date.val();
						var time=task_time.val();
						if(time!='') time=time+':00';
						if(datetime!='') datetime=datetime+' '+time;			
						var vals=task_user.val()+','+task_type.val()+','+task_status.val()+','+datetime+','+replaceAll(task_subject.val(),',','^')+','+replaceAll(task_note.val(),',','^');
						vals.replace(' ','|');
						var query='table=mt_tasks&action='+action+'&fields=user_id,type_id,status_id,task_date,subject,note&vals='+vals;
						if(g_Command=='task_edit') {
							var id=document.getElementById('record_id').value;
							query=query+'&where=id='+id;
						}
						$( this ).dialog( "close" );
						db_send(query,g_Section);
					}
				},
				"Отмена": function() { $( this ).dialog( "close" ); }
			},
			close: function() {	task_allFields.val( "" ).removeClass( "ui-state-error" ); }
		});

		$( "#task_add" )
			.button()
			.click(function() {
				g_Command="task_add";
				g_Section="tasks";
				$( "#task_form" ).dialog("option","title",'Новая задача');
				$( "#task_form" ).dialog( "open" );
			});
		
		$( "#task_add_my" )
			.button()
			.click(function() {
				g_Command="task_add";
				g_Section="tasks_my";
				$( "#task_form" ).dialog("option","title",'Новая задача');
				$( "#task_form" ).dialog( "open" );
			});
		
		$( "#task_add_menu" )
			.click(function() {
				g_Command="task_add";
				g_Section="tasks_my";
				$( "#task_form" ).dialog("option","title",'Новая задача');
				$( "#task_form" ).dialog( "open" );
			});
		
		$( "#task_edit" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				g_Command="task_edit";
				g_Section="tasks";
				get_record_data('tasks',id);
				$( "#task_form" ).dialog("option","title",'Редактировать задачу');
				$( "#task_form" ).dialog( "open" );
			});
			
		$( "#task_edit_my" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				g_Command="task_edit";
				g_Section="tasks_my";
				get_record_data('tasks',id);
				$( "#task_form" ).dialog("option","title",'Редактировать задачу');
				$( "#task_form" ).dialog( "open" );
			});
			
		$("[id^=task_edit_desktop_]")
			.click(function() {
				var id=this.id;
				var pos=id.indexOf('__');
				if(pos>0) id=id.substring(pos+2,id.length);
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				g_Command="task_edit";
				g_Section="desktop";
				document.getElementById('record_id').value=id;
				get_record_data('tasks',id);
				$( "#task_form" ).dialog("option","title",'Редактировать задачу');
				$( "#task_form" ).dialog( "open" );
			});
			
		$( "#task_delete" )
			.button()
			.click(function() {
				g_Section="tasks";
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				confirm('Подтверждение','Вы действительно хотите удалить задачу?',function(){
						db_send('table=mt_tasks&action=delete&where=id='+id,g_Section)
					});
			});
			
		$( "#task_delete_my" )
			.button()
			.click(function() {
				g_Section="tasks_my";
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				confirm('Подтверждение','Вы действительно хотите удалить задачу?',function(){
						db_send('table=mt_tasks&action=delete&where=id='+id,g_Section)
					});
		});
		
		$( "#task_google" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				var data=get_record_data_google(id);
				window.open("https://www.google.com/calendar/render?action=TEMPLATE&"+data);
		});
		
		//TYPE FORM
		var type_ord = $( "#type_ord" ),
			type_name = $( "#type_name" ),
			type_allFields = $( [] ).add( type_ord ).add( type_name ),
			type_tips = $( ".validateTips" );
		
		$( "#type_form" ).dialog({
			autoOpen: false,
			height: 250,
			width: 330,
			modal: true,
			title: "Type",
			buttons: {
				"OK": function() {
					var bValid = true;
					type_allFields.removeClass( "ui-state-error" );
					
					bValid = bValid && checkLength( type_name, "Наименование", 3, 30 );
						
					if ( bValid ) {
						var action='insert';
						if(g_Command=="type_edit") action='update';
						var vals=type_ord.val()+','+replaceAll(type_name.val(),',','^');
						vals.replace(' ','|');
						var query='table=mt_types&action='+action+'&fields=ord,name&vals='+vals;
						if(g_Command=='type_edit') {
							var id=document.getElementById('record_id').value;
							query=query+'&where=id='+id;
						}
						$( this ).dialog( "close" );
						db_send(query,'types');
					}
				},
				"Отмена": function() { $( this ).dialog( "close" ); }
			},
			close: function() {	type_allFields.val( "" ).removeClass( "ui-state-error" ); }
		});

		$( "#type_add" )
			.button()
			.click(function() {
				g_Command="type_add";
				$( "#type_form" ).dialog("option","title",'Новый тип');
				$( "#type_form" ).dialog( "open" );
			});
			
		$( "#type_edit" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				g_Command="type_edit";
				get_record_data('types',id);
				$( "#type_form" ).dialog("option","title",'Редактировать тип');
				$( "#type_form" ).dialog( "open" );
			});
			
		$( "#type_delete" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				confirm('Подтверждение','Вы действительно хотите удалить тип?',function(){
						db_send('table=mt_types&action=delete&where=id='+id,'types')
			});	
		});
		
		//STATUS FORM
		var status_ord = $( "#status_ord" ),
			status_name = $( "#status_name" ),
			status_color = $( "#status_color" ),
			status_allFields = $( [] ).add( status_ord ).add( status_name ).add( status_color ),
			status_tips = $( ".validateTips" );
		
		$( "#status_form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 330,
			modal: true,
			title: "Status",
			buttons: {
				"OK": function() {
					var bValid = true;
					status_allFields.removeClass( "ui-state-error" );
					
					bValid = bValid && checkLength( status_name, "Наименование", 3, 30 );
						
					if ( bValid ) {
						var action='insert';
						if(g_Command=="status_edit") action='update';
						var vals=status_ord.val()+','+status_name.val()+','+status_color.val().substring(1,status_color.val().length);
						vals.replace(' ','|');
						var query='table=mt_statuses&action='+action+'&fields=ord,name,color&vals='+vals;
						if(g_Command=='status_edit') {
							var id=document.getElementById('record_id').value;
							query=query+'&where=id='+id;
						}
						$( this ).dialog( "close" );
						db_send(query,'statuses');
					}
				},
				"Отмена": function() { $( this ).dialog( "close" ); }
			},
			close: function() {	status_allFields.val( "" ).removeClass( "ui-state-error" ); }
		});

		$( "#status_add" )
			.button()
			.click(function() {
				g_Command="status_add";
				$( "#status_form" ).dialog("option","title",'Новый статус');
				$( "#status_form" ).dialog( "open" );
			});
			
		$( "#status_edit" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				g_Command="status_edit";
				get_record_data('statuses',id);
				$( "#status_form" ).dialog("option","title",'Редактировать статус');
				$( "#status_form" ).dialog( "open" );
			});
			
		$( "#status_delete" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				confirm('Подтверждение','Вы действительно хотите удалить статус?',function(){
						db_send('table=mt_statuses&action=delete&where=id='+id,'statuses')
			});	
		});
		
		//USER FORM
		var user_login = $( "#user_login" ),
			user_name = $( "#user_name" ),
			user_info = $( "#user_info" ),
			user_allFields = $( [] ).add( user_login ).add( user_name ).add( user_info ),
			user_tips = $( ".validateTips" );
		
		$( "#user_form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 330,
			modal: true,
			title: "User",
			buttons: {
				"OK": function() {
					var bValid = true;
					user_allFields.removeClass( "ui-state-error" );
					
					bValid = bValid && checkLength( user_login, "Логин", 2, 30 );
					bValid = bValid && checkLength( user_name, "ФИО", 3, 30 );
						
					if ( bValid ) {
						var action='insert';
						if(g_Command=="user_edit") action='update';
						var vals=user_login.val()+','+user_name.val()+','+user_info.val();
						vals.replace(' ','|');
						var query='table=mt_users&action='+action+'&fields=login,name,info&vals='+vals;
						if(g_Command=='user_edit') {
							var id=document.getElementById('record_id').value;
							query=query+'&where=id='+id;
						}
						$( this ).dialog( "close" );
						db_send(query,'users');
					}
				},
				"Отмена": function() { $( this ).dialog( "close" ); }
			},
			close: function() {	user_allFields.val( "" ).removeClass( "ui-state-error" ); }
		});

		$( "#user_add" )
			.button()
			.click(function() {
				info('Внимание','В демо-версии эта функция недоступна');
				/*g_Command="user_add";
				$( "#user_form" ).dialog("option","title",'Новый пользователь');
				$( "#user_form" ).dialog( "open" );*/
			});
			
		$( "#user_edit" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				g_Command="user_edit";
				get_record_data('users',id);
				$( "#user_form" ).dialog("option","title",'Редактировать пользователя');
				$( "#user_form" ).dialog( "open" );
			});
			
		$( "#user_delete" )
			.button()
			.click(function() {
				info('Внимание','В демо-версии эта функция недоступна');
				/*var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Внимание','Выберите строку из списка');
					return;
				}
				confirm('Подтверждение','Вы действительно хотите удалить пользователя?',function(){
						db_send('table=mt_users&action=delete&where=id='+id,'users')
			});	*/
		});
		
		//USER PASSWORD FORM
		var user_password = $( "#user_password" ),
			user_password2 = $( "#user_password2" ),
			password_allFields = $( [] ).add( user_password ).add( user_password2 ),
			password_tips = $( ".validateTips" );
		
		$( "#password_form" ).dialog({
			autoOpen: false,
			height: 280,
			width: 330,
			modal: true,
			title: "Password",
			buttons: {
				"OK": function() {
					var bValid = true;
					password_allFields.removeClass( "ui-state-error" );

					bValid = user_password.val()==user_password2.val();
					if(!bValid) {
						user_password2.addClass( "ui-state-error" );
						updateTips( "Heslo pro kontrolu neni stejne jako heslo" );
					}	
						
					if ( bValid ) {
						var id=document.getElementById('record_id').value;
						var query='table=provozni_users&action=update&fields=password&vals='+user_password.val()+'&where=id='+id;
						$( this ).dialog( "close" );
						db_send(query,'users');
					}
				},
				"Storno": function() { $( this ).dialog( "close" ); }
			},
			close: function() {	password_allFields.val( "" ).removeClass( "ui-state-error" ); }
		});
		
		$( "#user_password" )
			.button()
			.click(function() {
				info('Внимание','В демо-версии эта функция недоступна');
				/*var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Pozor','Nevybran žadny radek z seznamu');
					return;
				}
				g_Command="password_edit";
				$( "#password_form" ).dialog("option","title",'Užívatel - heslo');
				$( "#password_form" ).dialog( "open" );*/
			});
		
		//USER PRIVS FORM
		$( "#privs_form" ).dialog({
			autoOpen: false,
			height: 290,
			width: 280,
			modal: true,
			title: "Privs",
			buttons: {
				"OK": function() {
					var bValid = true;
					if ( bValid ) {
						//delete all privs for user
						var user_id=document.getElementById('record_id').value;
						var query='table=provozni_privs&action=delete&where=user_id='+user_id;
						db_send(query);
						//set privs
						query="table=provozni_privs&action=insert&fields=user_id,priv&vals="+user_id+",";
						
						if($('#check_sklad_view').is(':checked')>=1) db_send(query+"sklad_view");
						if($('#check_sklad_add').is(':checked')>=1) db_send(query+"sklad_add");
						if($('#check_sklad_edit').is(':checked')>=1) db_send(query+"sklad_edit");
						if($('#check_sklad_delete').is(':checked')>=1) db_send(query+"sklad_delete");
						
						if($('#check_cenik_view').is(':checked')>=1) db_send(query+"cenik_view");
						if($('#check_cenik_add').is(':checked')>=1) db_send(query+"cenik_add");
						if($('#check_cenik_edit').is(':checked')>=1) db_send(query+"cenik_edit");
						if($('#check_cenik_delete').is(':checked')>=1) db_send(query+"cenik_delete");
						
						if($('#check_trzba_view').is(':checked')>=1) db_send(query+"trzba_view");
						
						$( this ).dialog( "close" );
					}
				},
				"Storno": function() { $( this ).dialog( "close" ); }
			},
		});

		$( "#user_privs" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Pozor','Nevybran žadny radek z seznamu');
					return;
				}
				g_Command="privs_edit";
				var user_id=document.getElementById('record_id').value;
				has_priv(user_id,'sklad_view');
				has_priv(user_id,'sklad_add');
				has_priv(user_id,'sklad_edit');
				has_priv(user_id,'sklad_delete');
				
				has_priv(user_id,'cenik_view');
				has_priv(user_id,'cenik_add');
				has_priv(user_id,'cenik_edit');
				has_priv(user_id,'cenik_delete');
				
				has_priv(user_id,'trzba_view');
				
				$( "#privs_form" ).dialog("option","title",'Užívatel - prava');
				$( "#privs_form" ).dialog( "open" );
			});
			
		//USER POKLADNA FORM
		function process_user_pokladna(index,value)
		{
			var id=$(this).attr('id');
			id=id.substr(15,id.length-15);
			var user_id=document.getElementById('record_id').value;
			
			if($('#check_pokladna_'+id).is(':checked')>=1) 
			{
				query="table=provozni_users_pokladna&action=insert&fields=user_id,pokladna_id&vals="+user_id+","+id;
				db_send(query);
			}
			else
			{
				query="table=provozni_users_pokladna&action=delete&where=user_id="+user_id+" and pokladna_id="+id;
				db_send(query);
			}			
		}
		
		function has_user_pokladna(index,value)
		{
			var id=$(this).attr('id');
			id=id.substr(15,id.length-15);
			var user_id=document.getElementById('record_id').value;
						
			has_pokladna(user_id,id);
		}
		
		$( "#user_pokladna_form" ).dialog({
			autoOpen: false,
			height: 390,
			width: 280,
			modal: true,
			title: "Pokladny",
			buttons: {
				"OK": function() {
					var bValid = true;
					if ( bValid ) {
						$("[id^=check_pokladna]").each( process_user_pokladna );
						$( this ).dialog( "close" );
					}
				},
				"Storno": function() { $( this ).dialog( "close" ); }
			},
		});

		$( "#user_pokladna" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Pozor','Nevybran žadny radek z seznamu');
					return;
				}
				var user_id=document.getElementById('record_id').value;
				$("[id^=check_pokladna]").each( has_user_pokladna );
				
				$( "#user_pokladna_form" ).dialog("option","title",'Užívatel - pokladny');
				$( "#user_pokladna_form" ).dialog( "open" );
			});
		
		
		$( "#trzby_double_click" )
			.button()
			.click(function() {
				var id=document.getElementById('record_id').value;
				if(id=='') {
					info('Pozor','Nevybran žadny radek z seznamu');
					return;
				}
				confirm('Potvrzeni','Opravdu prejit?',function(){
						;//window.location.href="index.php?pokladna=""&action=trzba_view";
					});
			});
		
		
	});
	</script>
	
</head>

<body>

<?
require_once "env.php";
require_once "main_menu.php";
require_once "login.php";
require_once "tasks.php";
require_once "types.php";
require_once "statuses.php";
require_once "users.php";
require_once "regions.php";
require_once "properties.php";
require_once "desktop.php";

global $user_id;
global $user_name;

if($user=='') 
{
	Login($wrong_user);
	return;
}
$action=htmlspecialchars(stripslashes(substr($_REQUEST[action],0,20)));
$section='';
if($action=='tasks_view_my') $section='Мои задачи';
else if($action=='tasks_view') $section='Все задачи';
else if($action=='types_view') $section='Типы задач';
else if($action=='statuses_view') $section='Статусы задач';
else if($action=='users_view') $section='Коллеги';

?>

&nbsp;<input type="hidden" id="record_id" name="record_id" val="" />
<input type="hidden" id="user_id" name="user_id" val="<? print $user_id; ?>" />
<div id="confirmation_area" class="hidden"></div>

<!--<div id="sidebar" style="width:270px;"> 
  <div id="scroller-anchor"></div> 
  <div id="scroller" style="margin-top:10px; width:270px"> 
    Scroller Scroller Scroller
  </div>
</div>-->

<div id="task_form" title="Task" class="ui_form">
	<p class="validateTips">Заполните пользователя, тип задачи, название и описание</p>
	<form>
	<fieldset>
		<label for="task_user">Кому</label>
		<select name="task_user" id="task_user">
		<? 
			$link = mysql_connect($host, $db_user, $db_password);
			if (!$link) { die('Could not connect: ' . mysql_error()); }
			mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
  
			$sql="select id,name from ".$prefix."users order by name";
			$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
			while ($row = mysql_fetch_array($result)) print "<option value=\"".$row[0]."\">".$row[1]."</option>\n";
		?>
		</select>
		<label for="task_type">Тип задачи</label>
		<select name="task_type" id="task_type">
		<? 
			$link = mysql_connect($host, $db_user, $db_password);
			if (!$link) { die('Could not connect: ' . mysql_error()); }
			mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
  
			$sql="select id,name from ".$prefix."types order by name";
			$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
			while ($row = mysql_fetch_array($result)) print "<option value=\"".$row[0]."\">".$row[1]."</option>\n";
		?>
		</select>
		<label for="task_status">Статус задачи</label>
		<select name="task_status" id="task_status">
		<? 
			$link = mysql_connect($host, $db_user, $db_password);
			if (!$link) { die('Could not connect: ' . mysql_error()); }
			mysql_select_db($db, $link) or die ('Can\'t use $db : ' . mysql_error());
  
			$sql="select id,name from ".$prefix."statuses order by name";
			$result = mysql_query($sql) or die("Invalid query: " . mysql_error());
			while ($row = mysql_fetch_array($result)) print "<option value=\"".$row[0]."\">".$row[1]."</option>\n";
		?>
		</select>
		<label for="task_date">Срок</label>
		<input type="date" name="task_date" id="task_date" class="text ui-widget-content ui-corner-all" />
		<input type="time" name="task_time" id="task_time" class="text ui-widget-content ui-corner-all" />
		<label for="task_subject">Название</label>
		<input type="text" name="task_subject" id="task_subject" class="text ui-widget-content ui-corner-all" />
		<label for="task_note">Описание</label>
		<input type="text" name="task_note" id="task_note" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

<div id="type_form" title="Тип задачи" class="ui_form">
	<p class="validateTips">Заполните наименование</p>
	<form>
	<fieldset>
		<label for="type_ord">Порядок</label>
		<input type="text" name="type_ord" id="type_ord" value="" class="text ui-widget-content ui-corner-all" />
		<label for="type_name">Наименование</label>
		<input type="text" name="type_name" id="type_name" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

<div id="status_form" title="Статус задачи" class="ui_form">
	<p class="validateTips">Заполните наименование</p>
	<form>
	<fieldset>
		<label for="status_ord">Порядок</label>
		<input type="text" name="status_ord" id="status_ord" value="" class="text ui-widget-content ui-corner-all" />
		<label for="status_color">Цвет</label>
		<input type="color" name="status_color" id="status_color" value="" class="text ui-widget-content ui-corner-all" />
		<label for="status_name">Наименование</label>
		<input type="text" name="status_name" id="status_name" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

<div id="user_form" title="Пользователь" class="ui_form">
	<p class="validateTips">Заполните логин, ФИО и контактную информацию</p>
	<form>
	<fieldset>
		<label for="user_login">Логин</label>
		<input type="text" name="user_login" id="user_login" value="" class="text ui-widget-content ui-corner-all" />
		<label for="user_name">ФИО</label>
		<input type="text" name="user_name" id="user_name" value="" class="text ui-widget-content ui-corner-all" />
		<label for="user_info">Контактная информация</label>
		<input type="text" name="user_info" id="user_info" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

<div id="password_form" title="Пароль" class="ui_form">
	<p class="validateTips">Задайте пароль</p>
	<form>
	<fieldset>
		<label for="user_password">Пароль</label>
		<input type="password" name="user_password" id="user_password" value="" class="text ui-widget-content ui-corner-all" />
		<label for="user_password2">Пароль (подтверждение)</label>
		<input type="password" name="user_password2" id="user_password2" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

<div id="privs_form" title="Privs" class="ui_form">
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Sklad</a></li>
			<li><a href="#tabs-2">Cenik</a></li>
			<li><a href="#tabs-3">Tržba směny</a></li>
		</ul>
		<div id="tabs-1">
		<form>
			<input type="checkbox" id="check_sklad_view" /><label for="check_sklad_view">Prehled skladu</label><br>
			<input type="checkbox" id="check_sklad_add" /><label for="check_sklad_add">Pridat položku skladu</label><br>
			<input type="checkbox" id="check_sklad_edit" /><label for="check_sklad_edit">Upravit položku skladu</label><br>
			<input type="checkbox" id="check_sklad_delete" /><label for="check_sklad_delete">Zrušit položku skladu</label>
		</form>
		</div>
		<div id="tabs-2">
		<form>
			<input type="checkbox" id="check_cenik_view" /><label for="check_cenik_view">Prehled ceniku</label><br>
			<input type="checkbox" id="check_cenik_add" /><label for="check_cenik_add">Pridat položku ceniku</label><br>
			<input type="checkbox" id="check_cenik_edit" /><label for="check_cenik_edit">Upravit položku ceniku</label><br>
			<input type="checkbox" id="check_cenik_delete" /><label for="check_cenik_delete">Zrušit položku ceniku</label>
		</form>
		</div>
		<div id="tabs-3">
		<form>
			<input type="checkbox" id="check_trzba_view" /><label for="check_trzba_view">Prehled tržby směny</label>
		</form>
		</div>
	</div>
</div>

&nbsp;
	<div class="top">
		<div class="article_header">Rent apartments in Luxembourg</div>
		<div class="sub_article_header">
			<table class="non_data_table">
			<tr><td valign="top"><form action="index.php" method="post"><input type="hidden" name="reset_user" value="1">
				<button id="exit">Logout</button>
			</form></td><td></td><td></td></tr>
			<tr>
			<td><div class="warning">User: <? print $user_name; ?></div></td>
			<td>&nbsp;</td><td><div class="warning">&nbsp;<? print $section; ?></td></tr></table>
		</div>
	</div>
	
	<? 
		MainMenu(9); 

		if($action=='tasks_view_my') TasksView(true,true);
		else if($action=='tasks_view') TasksView(true,false);
		else if($action=='types_view') TypesView(true);
		else if($action=='statuses_view') StatusesView(true);
		else if($action=='regions_view') RegionsView(true);
		else if($action=='properties_view') PropertiesView(true);
		else if($action=='users_view') UsersView(true);
		else DesktopView(false);
		
		print "</div>";
	?>
	
</body>

</html>
