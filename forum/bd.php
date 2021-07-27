<?php
        $db = mysqli_connect("localhost", "admin", "admin", "forum");
        mysqli_query($db, "SET NAMES utf8");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
?>