<?php
session_start(); 
unset($_SESSION['user']);
unset($_SESSION["ID_User"]);
unset($_SESSION["Role"]);
header ('location: /');
?>
