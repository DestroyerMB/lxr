<!doctype html>
<html>
<body>
  <script src="https://code.jquery.com/jquery-3.1.0.js"
  integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk="
  crossorigin="anonymous"></script>

<div id="target-location"></div>
<div id="hidden-resizer" style="display: none"></div>

  <script type="text/javascript">

  function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  }

  function showPrice(price) {
    var size;
    var desired_width = 50;
    var resizer = $("#hidden-resizer");

    price = numberWithSpaces(price);
    resizer.html(price+" E");

    while(resizer.width() > desired_width) {
      size = parseInt(resizer.css("font-size"), 10);
      ;;console.log(size);
      if(size<6) break;
      resizer.css("font-size", size - 1);
    }

    $("#target-location").css("font-size", size).html(resizer.html());
  }

  showPrice(1200000);

  </script>
</body>

</html>
