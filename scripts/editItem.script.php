<?php
include '../includes/autoload.inc.php';
$controller = new IndexController();
var_dump($_POST);
$inputsArr = array(
    'name' => $_POST['new-name-input'],
    'description' => $_POST['new-description-input']
);
$uid = $_POST['node-uid-input'];

$result = $controller->editNode($uid, $inputsArr);
if ($result == false) {
    echo "Error changing node data";
}elseif ($result == true) {
    header("location: ../index.php");
}