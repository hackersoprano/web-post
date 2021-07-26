<?php
include "bd.php";
function ft(){
    include "bd.php";
        
        $rez = mysqli_query($db,"SELECT * From `applications` where `Status` = 'Выполнен'");
        $row = mysqli_num_rows($rez);
        if ($_SESSION['row']<$row){
            echo "<audio src='Sound.mp3' autoplay></audio>";
        }
        $_SESSION['row'] = $row;
        echo "<p id='kol'>Всего заявок: ".$_SESSION['row']."</p>";
        

}
ft();
        //<audio src="Sound.mp3" autoplay></audio>    
?>

