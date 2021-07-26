
<?php
        $db = mysqli_connect("a350229.mysql.mchost.ru", "a350229_test", "testing", "a350229_main");
        mysqli_query($db, "SET NAMES utf8");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
?>
<!--?php
   require 'rb.php';
   R::setup('mysql:host=a350229.mysql.mchost.ru;dbname=a350229_main',
   'a350229_test', 'testing');
   if (!isset($_SESSION))
   {
       session_start();
   }
?>-->