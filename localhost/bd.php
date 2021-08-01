<?php  if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
		$db = mysqli_connect("localhost", "admin", "admin", "main");
        mysqli_query($db, "SET NAMES utf8");
?>