<? require "session_data.php" ?>

<html>

<head></head>
<body>

<div id="test">
  <?
  print "Region was ".getSessionData("region")."<br>";
  setSessionData("region","Malasya");
  print "Now is ".getSessionData("region");
  ?>
</div>

<button type="button" name="button" onclick="nextPage()">Next page</button>

<script type="text/javascript">
  function nextPage() {
    window.location.replace("session_data_test2.php");
  }
</script>


</body>
</html>
