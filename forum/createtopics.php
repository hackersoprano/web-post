<?php include "bd.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
	<title>Document</title>
</head>
<body>


<div class="regg">  
<form action ="" method="POST">
<h1 style="font-size: 40px;" class="reg">Создание темы</h1></br>
<p class="reg"><label>Название:<br>
<input name="title"="50" type="text" style="width: 300px; height: 20px;" value="" required></label></p> 
<p class="reg"><label>Описание:<br>
    <textarea name="description" rows="10" cols="45" required></textarea></label></p>
    <p class="reg"><input style="cursor:pointer;display: inline; background: lime;  " type="Submit" name="button_id" value="Создать" /></p>
    <?php

if( isset( $_POST['button_id'])){
    $table = 'topics';
    $title = $_POST["title"];
    $description = $_POST["description"];
    $user_ID=$_SESSION["ID_User"];
    $date=date("Y-m-d H:i:s");
            $result = mysqli_query($db,"INSERT INTO ".$table." (user_ID,title,description,date) VALUES ('$user_ID','$title','$description','$date')");
            if ($result == true){
                echo "Информация занесена в базу данных <script>window.location = '/';</script>";
                
            }else{
                echo "Информация не занесена в базу данных";
            }
}

?>
</form>


</div>
</body>
</html>