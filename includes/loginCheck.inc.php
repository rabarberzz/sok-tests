<?php
session_start();
//checks whether session var is set to something other than true
if ($_SESSION['logged-in'] != 'true'){
    //sends user to log in page if not logged in.
    header("location: ../login-page.php");
}