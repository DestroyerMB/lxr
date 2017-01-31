<?
	function Login($wrong_user)
	{
		$cookie_user=htmlspecialchars(stripslashes(substr($_COOKIE[user],0,30)));
		$wrong_user_warning='&nbsp;';
		if($wrong_user==1) $wrong_user_warning='Неправильный пользователь или пароль!';

		print "<script>  function getLastFormElem(){ var fID = document.forms.length -1; var f = document.forms[fID]; ";
		print "var eID = f.elements.length -1; return f.elements[eID]; }</script>";
		print "<div id=\"container\" style=\"width: 100%; height: 100%;\">";
        print "<form method=\"post\" action=\"index.php\" class=\"FormStyle\">";
		print "<table class=\"FormStyle\">";
        print "  <tr><td>";
        print "   <table class=\"MainTableStyle\">";
        print "    <tr><td><img src=\"img/login_top_border.png\" style=\"height:24px;width:400px;border-width:0px;\" /></td></tr><tr><td>";
		print "						<img src=\"img/login_logo.png\"/></td>";
        print "                    </tr><tr>";
        print "                        <td id=\"loginmainblock\">";
		print "						<label id=\"Login_Warning\" class=\"warning\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$wrong_user_warning</label><br><br>";
		print "						<table border=0 class=\"FooterTableStyle\" id=\"logincont\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>";
		print "						<label for=\"Login_UserName\" id=\"Login_UserNameLabel\">Пользователь*:&nbsp;</label></td><td>";
		print "						<input name=\"user_no_cookie\" type=\"hidden\" value=\"1\"/>";
		print "						<input name=\"user\" type=\"text\" maxlength=\"30\" id=\"Login_UserName\" value=\"$cookie_user\"/>";
		print "						<script>getLastFormElem().focus();</script></td><td></td></tr>";
		print "						<tr><td colspan=\"3\" style=\"height: 10px;\"><span></span></td></tr>";
        print "                        <tr><td><label for=\"Login_Password\" id=\"Login_PasswordLabel\">Пароль:&nbsp;</label></td><td>";
        print "                        <input name=\"password\" type=\"password\" maxlength=\"255\" id=\"Login_Password\"/></td><td></td></tr>";
		print "						<tr><td colspan=\"3\" style=\"height: 10px;\"><span></span></td></tr><tr><td></td><td align=\"center\">";
		print "						<button id=\"Login_Button\">OK</button>";
		print "						</td><td>&nbsp;</td></tr><tr><td colspan=3><br><br><br><label id=\"Login_Hint\">* для ознакомления можете войти как demo, пароль demo</label></td><tr></table></td></tr><tr>";
        print "                        <td id=\"loginbottom\"><img src=\"img/login_bottom.png\" style=\"height:32px;width:400px;border-width:0px;\" /></td>";
        print "                    </tr></table><div id=\"Login_Copyright\"><div  style=\"position: relative; left: -50%;\">Система разработана компанией <a href=\"http://ПишемСофт.рф\">ПишемСофт.рф</a>, Copyright (c) 2015</div></div></td></tr></table></form></div></body></html>";
	}