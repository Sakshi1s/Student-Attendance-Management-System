<?php
session_start();
if(!isset($_SESSION['email']) ){
    header("Location: http://localhost/Mini-Project/login.php");
}
?>