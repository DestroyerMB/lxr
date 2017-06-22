<!DOCTYPE html>
<html>
<head>
  <script src="local_settings.js" charset="utf-8"></script>
</head>
<body>

<h2 id="name">Log demo</h2>

<button onclick="setLocal('user','John Carmak')">Set user</button>
<button onclick="get('user')">Get user</button>

<p id="demo"></p>

<script>
function get(name) {

    var user = getLocal(name);
    document.getElementById("name").innerHTML = user;
}

</script>

</body>
</html>
