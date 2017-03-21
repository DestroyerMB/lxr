<?php
header("Content-Type: application/json; charset=UTF-8");
$callback = $_GET["callback"];
$data = json_decode($_GET["data"], false);

/*$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$result = $conn->query("SELECT name FROM ".$obj->$table." LIMIT ".$obj->$limit);
$outp = array();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo "myFunc(".json_encode($outp).")";*/

$myJSON = '{ "name":"'.$data->name.'", "age":30, "city":"New York" }';

echo "(".$myJSON.");";
?>
