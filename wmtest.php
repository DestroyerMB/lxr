<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


    <?
      require 'watermark.php';
      makeWatermark('test.jpg','test_out.jpg');
    ?>
    <img src="test_out.jpg" alt="">


  </body>
</html>
