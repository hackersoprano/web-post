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
<ul>
    <li><a href="logout.php">Выйти</a></li>
    <li><a href="/">Вернуться</a></li>
</ul>

  
    
    <?php
    $table = 'topics';
    $id=$_SESSION['topics_ID'];
    $result = mysqli_query($db,"SELECT * FROM ".$table." WHERE ID ='$id'");
    $arraytopics = mysqli_fetch_array($result);

    $tableusers = 'users';
    $id=$arraytopics["user_ID"];
    $query = mysqli_query($db,"SELECT * FROM ".$tableusers." WHERE ID ='$id'");
    $arrayuser = mysqli_fetch_array($query);
    echo "
    <div class = 'blog1'>
    <div class='blog2'><p class='blogp'>Название:".$arraytopics['title']."</p><br></div>
    <div class='blog3'><p class='blogp'>Описание:".$arraytopics['description']."</p><br></div>
    <div class='blog6'><p class='blogp' style = 'margin: 0; padding: 0;'>Автор: ".$arrayuser['Login']." </p></div>
    </div>
    ";

    ?>

    <?php
    if (isset($_GET['page'])){
        $page = $_GET['page'];
     }else $page = 1;

    
    $kol = 10;  
    $art = ($page * $kol) - $kol; 

    

    $ress = mysqli_query($db,"SELECT COUNT(*) FROM `messages`");
    $roww = mysqli_fetch_row($ress);
    $total = $roww[0]; // всего записей
    $str_pag = ceil($total / $kol);
    for ($i = 1; $i <= $str_pag; $i++){
        echo "<a class='st' href=topics.php?page=".$i.">[".$i."] страница сообщений </a></br>";
      }


    $table = 'messages';
    $topic =$_SESSION["topics_ID"];
    $query = mysqli_query($db,"SELECT * FROM ".$table." WHERE topic_ID ='$topic'LIMIT $art,$kol");
    while ($array = mysqli_fetch_array($query))
    {
        $tableusers = 'users';
        $id=$array["user_ID"];
        $result = mysqli_query($db,"SELECT * FROM ".$tableusers." WHERE ID ='$id'");
        $arrayuser = mysqli_fetch_array($result);
        echo '<div class="blog1">
        <div class="blog2">
            <p class="blogp">Сообщение от '.$arrayuser["Login"].' в '.$array["date"].' : '.$array["message"].'</p><br>
        </div>
            </div>';
    }
    ?>
    
    <div class="blog1">
        <div class='blog2'>
            <p>Сообщение</p>
            <form action ="" method="POST">
                <textarea name="message" rows="10" cols="144" required></textarea><br>
                <p class="reg"><input style="cursor:pointer;display: inline; " type="Submit" name="button_id" value="Отправить сообщение" /></p>
            </form>
        </div>
    </div>
    <?php 
    if( isset( $_POST['button_id'])){
        $table='messages';
        $message = $_POST["message"];
        $userID = $_SESSION["ID_User"];
        $topics = $_SESSION['topics_ID'];
        $date=date("Y-m-d H:i:s");
        if ($message != ""){
            $result = mysqli_query($db,"INSERT INTO ".$table." (user_ID,topic_ID,message,date) VALUES ('$userID','$topics','$message','$date')");
            if ($result == true){
                echo "<script>window.location = 'topics.php';</script>";
                
            }else{
                echo "Информация не занесена в базу данных";
            }

        }
    }
    ?>
</body>
</html>