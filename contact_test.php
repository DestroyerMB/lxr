<html>

<head></head>
<body>

<select name="test">
<?php
	require_once 'data_loaders.php';
	fill_options();
?>
</select>

<div id="contacts_hidden"></div>
<button onclick="showContacts()">Show contacts</button>

<script type="text/javascript">
	function showContacts() {
    var obj = { "id":17 };

    var xhttp;
    xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
				var contact_record =  JSON.parse(JSON.parse(this.responseText));
				;;alert(contact_record);
				var txt = contact_record.name;
        document.getElementById("contacts_hidden").innerHTML = txt;
      }
    };
    xhttp.open("POST", "contact_data.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(obj));
	}
</script>

</body>
</html>
