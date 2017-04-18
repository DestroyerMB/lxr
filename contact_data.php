<?
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents('php://input'));

$rs = '{ "name":"John Smith", "phone":"650 678 902", "email":"trier.ham@marta.com" }';

echo json_encode($rs);
?>
