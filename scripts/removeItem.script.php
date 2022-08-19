<?php
include '../includes/autoload.inc.php';
$controller = new IndexController();

$removableUid = $_POST['uid'];
$result = $controller->removeItem($removableUid);
$responseArr['status'] = $result;
header('Content-type: application/json');
echo json_encode($responseArr);
