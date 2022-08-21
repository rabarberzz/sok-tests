<?php
include '../includes/autoload.inc.php';
$controller = new IndexController();
//init variables with post data
$inputName = $_POST['name-input'];
$inputDescription = $_POST['description-input'];
$inputUid = 'undefined';
//checks if uid has been sent in post
if ($_POST['uid-input'] != 'undefined'){
    $inputUid = $_POST['uid-input'];
}
$inputParent = $_POST['parent-uid-input'];
$result = $controller->addItem($inputName, $inputDescription, $inputUid, $inputParent);
//controller sends a result message
if ($result == true){
    header("location: ../index.php");
}elseif ($result == false){
    echo "<h3 class='text-center text-bg-danger'>Error in post data</h3>";
}
