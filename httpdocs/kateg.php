<?php 
include "bd.php";
?>
<DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="menu">

    <div class="podmen">
        <nav>
            <ul class="ml">
                <li class="mmenu"><a class="amenu" href="index.php">Главная</a></li>
                <?php if(isset($_SESSION['user'])): ?>
                <li class="mmenu"><a class="amenu" href="application.php">Заявка</a></li>
                <?php endif;?>
                <?php if($_SESSION["Role"]==3): ?>
                <li class="mmenu"><a class="amenu" href="adm.php">Админ панель</a>
                <ul>
                    <li class="mmenu"><a class="amenu" href="usr.php">Пользователи</a></li>
                    <li class="mmenu"><a class="amenu" href="adm.php">Администраторы</a></li>
                    <li class="mmenu"><a class="amenu" href="applic.php">Просмотр заявок</a></li>
                    <li class="mmenu"><a class="amenu" href="kateg.php">Категории</a></li>

                </ul>
                </li>
                <?php endif; ?>
                
            </ul>
        </nav>
        
        </div>
        <ul style = " float:right; padding-right: 3%;" class="ml">
        <?php if(isset($_SESSION['user'])): ?>
        <li class="mmenu"><a class="amenu" href="userinfo.php"><?php echo $_SESSION['user']?></a></li>
        <li class="mmenu"><a class="amenu" href="logout.php">Выйти</a></li>
                <?php else:  ?>
                <li class="mmenu"><a style="font-size: 20px;" class="amenu" href="#">Гость</a></li>
                <li class="mmenu"><a class="amenu" href="signup.php">Регистрация</a></li>
                <li class="mmenu"><a class="amenu" href="login.php">Авторизация</a></li>
                <?php endif; ?>
        </ul>
        
    </div>
    <table class="tbglav" style="margin: auto;text-align: center;" width="50%">
  <tr>
    <td>ID_Категории</td>
    <td>Категория</td>
  </tr>
<?php
$table = 'categories';
$query = mysqli_query($db,"SELECT * FROM ".$table);
while ($array = mysqli_fetch_array($query))
{
    echo '<tr>' .
           "<td>{$array['ID_Kategory']}</td>" .
           "<td>{$array['Title']}</td>" .
           "<td><a style='background: red;' class='butt' href='?del_id={$array['ID_Kategory']}'>Удалить</a></td>" .
           '</tr>';
}
?>
<?php
  if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
    //удаляем строку из таблицы
    $query = mysqli_query($db, "DELETE FROM `categories` WHERE `ID_Kategory` = ".$_GET['del_id']);
    if ($query) {
      echo "Успешное удаление!<script>window.location = 'kateg.php';</script>";
    }else{
        echo "<p>Ошибка.</p>";
    }
    }
?>
</table>
<div class="regg">
<form action ="" method="POST">
<h4 style = "font-size: 30px;">Добавление категории:</h4>
<p class="reg"><label>Название:<br>
<input name="title"="20" type="text" value=""></label></p> 
<p class="reg"><input style="cursor:pointer;display: inline; background: lime;" type="Submit" name="button_id" value="Добавить" /></p>
</form>
<?php
if( isset( $_POST['button_id'])){
$errors = array();
$table = "categories";
$title = $_POST["title"];
if ($title == '')
        {
            $errors[]= 'Введите Название';
        }
        if (empty($errors))
        {
            $result = mysqli_query($db,"INSERT INTO ".$table." (Title) VALUES ('$title')");
            if ($result == true){
                echo "Информация занесена в базу данных<script>window.location = 'kateg.php';</script>";
            }else{
                echo "Информация не занесена в базу данных";
            }
        }
        {
            echo array_shift($errors);
        }
}
?>
</div>
</body>
</html>