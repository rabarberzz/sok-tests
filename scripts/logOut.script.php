<?php
session_start();
//checks if session var is set to true
if ($_SESSION['logged-in'] == 'true'){
    //if user is logged in unsets session var and sends user to log in page
    unset($_SESSION['logged-in']);
    header("location: ../login-page.php");
}