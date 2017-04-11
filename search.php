<?php
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents('php://input'));

$rs = array();
if($data->id == 1)
{
  $row1 = '{ "name":"Room", "price":650, "city":"Trier" }';
  $row2 = '{ "name":"Another room", "price":700, "city":"Luxembourg" }';
}
elseif($data->id == 2)
{
  $row1 = '{ "name":"Apartment", "price":1200, "city":"Chicago" }';
  $row2 = '{ "name":"Nice apartment", "price":1100, "city":"Boston" }';
}
elseif($data->id == 3)
{
  $row1 = '{ "name":"House", "price":1300, "city":"Wormeldange" }';
  $row2 = '{ "name":"House", "city":"Sandweiler" }';
}

array_push($rs,$row1);
array_push($rs,$row2);

echo json_encode($rs);

?>
