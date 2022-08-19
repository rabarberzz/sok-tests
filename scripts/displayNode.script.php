<?php
include '../includes/autoload.inc.php';

$controller = new IndexController();
$getUid = $_POST['uid'];

echo $controller->prepareNodeHtml($getUid);

//echo json_encode($getUid);