<?php
include 'conn.php';

session_start();
session_unset();
session_destroy();

header("Location: http://localhost/Mini-Project/login.php");
?>