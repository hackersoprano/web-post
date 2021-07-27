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
<?php if(!isset($_SESSION['user'])): ?>
<div class="regg">  
<form action ="login.php" method="POST">
<h1 style="font-size: 40px;" class="reg">Авторизация</h1></br>
<p class="reg"><label>Ваш логин:<br>
<input name="login"="20" type="text" value=""></label></p> 
<p class="reg"><label>Пароль:<br>
    <input name="password" size="30" type="password"></label></p>
    <p class="reg"><input style="cursor:pointer;display: inline; background: lime; " type="Submit" name="button_id" value="Авторизация" /></p>
    <p class="reg"><input style="cursor:pointer;display: inline; background: white; width: 25%;" type="button" onClick="window.location='registration.php'" name="registration" value="Регистрация" /></p>

    
</form>
</div>
<?php endif;?>
<?php if(isset($_SESSION['user'])): ?>

<ul>
    <li><a href="logout.php">Выйти</a></li>
    <li><a href="createtopics.php">Создать тему</a></li>
</ul>


<div class="topics">
    <h1 class="title">Темы</h1>
<table style="margin: auto;text-align: center;" width="60%">
<tr>
    <td >Название</td>
    <td>Статус</td>
    <td>Дата создания</td>
    <td>Создатель</td>
    <td>Всего сообщений</td>
    <td>Последнее сообщения от </td>
</tr>
    <?php
    if (isset($_GET['page'])){
        $page = $_GET['page'];
     }else $page = 1;

    
    $kol = 10;  
    $art = ($page * $kol) - $kol; 

    

    $ress = mysqli_query($db,"SELECT COUNT(*) FROM `topics`");
    $roww = mysqli_fetch_row($ress);
    $total = $roww[0]; // всего записей
    $str_pag = ceil($total / $kol);
    for ($i = 1; $i <= $str_pag; $i++){
        echo "<a class='st' href=index.php?page=".$i.">[".$i."] страница </a>";
      }

    $table = 'topics';
    $query = mysqli_query($db,"SELECT * FROM ".$table." LIMIT $art,$kol");
    while ($array = mysqli_fetch_array($query))
    {
        $tablemessage="messages";
        $topic_id=$array["ID"];
        $message = mysqli_query($db,"SELECT * FROM ".$tablemessage." WHERE topic_ID ='$topic_id'");
        $kol = mysqli_num_rows($message);

        // BY `ID_Application` DESC
        $user = mysqli_query($db,"SELECT * FROM `messages` where `topic_ID` = '$topic_id' ORDER BY `ID` DESC");
        $res = mysqli_fetch_array($user);
        if (!isset($res['user_ID'])){
            $usern='Нету';
        }
        else{
            $usern=$res['user_ID'];
        }
        $tableu = 'users';
        $res = mysqli_query($db,"SELECT * FROM ".$tableu." WHERE ID ='$usern'");
        $arrayuse = mysqli_fetch_array($res);

        if (!isset($arrayuse['Login'])){
            $arrayuse['Login']="Нету  сообщений";
        }

        $tableusers = 'users';
        $id=$array["user_ID"];
        $result = mysqli_query($db,"SELECT * FROM ".$tableusers." WHERE ID ='$id' ");
        $arrayuser = mysqli_fetch_array($result);
        echo "<tr onclick='window.location.href=`?view_id={$array['ID']}`;'>" .
           "<td>{$array['title']}</td>" .
           "<td>{$array['status']}</td>" .
           "<td>{$array['date']} </td>" .
           "<td>{$arrayuser['Login']} </td>".
           "<td>{$kol}</td>".
           "<td>{$arrayuse['Login']}</td>".
           "</tr>" ;
    }
    ?>
  
</table>
<?php 

if (isset($_GET['view_id'])) {
    $_SESSION['topics_ID'] = $_GET['view_id'];
    echo "<script>window.location = 'topics.php';</script>";
}
?>
</div>

<?php endif;?>
</body>
</html>