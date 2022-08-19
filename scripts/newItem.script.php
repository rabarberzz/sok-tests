<?php
include '../includes/autoload.inc.php';
$controller = new IndexController();

//print_r($_POST);
$inputName = $_POST['name-input'];
$inputDescription = $_POST['description-input'];
$inputUid = 'undefined';
if ($_POST['uid-input'] != 'undefined'){
    $inputUid = $_POST['uid-input'];
}
$inputParent = $_POST['parent-uid-input'];
$result = $controller->addItem($inputName, $inputDescription, $inputUid, $inputParent);
if ($result == true){
    header("location: ../index.php");
}elseif ($result == false){
    echo "Error in post data";
}
