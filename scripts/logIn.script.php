<?php
session_start();
$email = $_POST['email-input'];
$pwd = $_POST['pwd-input'];

//checks email and password combination
if ($email == "test@test.com" && $pwd == "test"){
    $_SESSION['logged-in'] = 'true';
    header("location: ../index.php");
}