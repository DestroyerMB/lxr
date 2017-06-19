<!DOCTYPE html>
<html>

<body>

<h2>Log demo</h2>

<button onclick="log('login')">Login</button>
<button onclick="log('contact')">Contact</button>
<button onclick="log('pay')">Pay</button>

<p id="demo"></p>

<script>
function log(action) {

    var obj = { "username":"John Deer", "action":action, "src":window.location.href  };

    var xhttp;
    xhttp=new XMLHttpRequest();
    xhttp.open("POST", "log.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(obj));
}

</script>

</body>
</html>
