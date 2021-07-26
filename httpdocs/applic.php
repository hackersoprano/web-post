<?php 
include "bd.php";
include_once('loadingProof.php');
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
    <table class="tbglav" style="margin: auto;text-align: center;" width="60%">
  <tr>
    <td>ID_Заявки</td>
    <td>Название</td>
    <td>Описание</td>
    <td>Категория</td>
    <td>Автор</td>
    <td>Статус</td>
  </tr>
<?php
$table = 'applications';
$query = mysqli_query($db,"SELECT * FROM ".$table);
while ($array = mysqli_fetch_array($query))
{
    echo '<tr>' .
           "<td>{$array['ID_Application']}</td>" .
           "<td>{$array['Title']}</td>" .
           "<td>{$array['Description']} </td>" .
           "<td>{$array['Category']} </td>" .
           "<td>{$array['Author']} </td>" .
           "<td>{$array['Status']} </td>" .
           "<td><a style='background: red;' class='butt' href='?del_id={$array['ID_Application']}'>Удалить</a></td>" .
           "<td><a class= 'butt'href='?view_id={$array['ID_Application']}'>Просмотр</a></td>" .
           "<td><a class= 'butt'href='?resh_id={$array['ID_Application']}'>Решение проблемы</a></td>" .
           "<td><a class= 'butt'href='?otk_id={$array['ID_Application']}'>Отклонение</a></td>" .
           '</tr>';
}
?>
</table>

<?php
  if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
    //удаляем строку из таблицы
    $query = mysqli_query($db, "DELETE FROM `applications` WHERE `ID_Application` = ".$_GET['del_id']);
    if ($query) {
      echo "<p>Запись удалена.</p>";
      echo "Успешное удаление!<script>window.location = 'applic.php';</script>";
    }else{
        echo "<p>Ошибка.</p>";
    }
    }
    if (isset($_GET['view_id'])) {
        $query = mysqli_query($db, "SELECT * FROM `applications` WHERE `ID_Application` = ".$_GET['view_id']);
        $Row = mysqli_fetch_array($query);
        echo "<input value='Закрыть просмотр' type='button' onclick='location.href= `applic.php`' />";
        echo "
            <div class = 'blog1'>
            <div class='blog2'><p>Название:".$Row['Title']."</p><br></div>
            <div class='blog3'><p>Описание: ".$Row['Description']."</p><br></div>
            <div class='blog4'><p>Категория: ".$Row['Category']."</p><br></div>
            <div class='blog5'><img class='docoz' src=".$Row['FilePath']."><br></div>
            <div class='blog6'><p>Автор: ".$Row['Author']."</p></div>
            </div>
            "; 
    }
    if (isset($_GET['resh_id'])) {
        echo "
        <form action ='' method='POST' enctype='multipart/form-data'>
        <p class='applic'><label>Загрузка фотографии:<br>
        <input type='file' name='file'>
        </p>
        <p class='applic'><input style='cursor:pointer;display: inline;' type='Submit' name='button_id' value='Отправить' /></p>
        </form>";
    }
    ?>
    <?php
    if (isset($_POST['button_id'])){
        $status = "Выполнен";
        $check = can_upload($_FILES['file']);
      
        if($check === true){
          // загружаем изображение на сервер
          make_upload($_FILES['file']);
          echo "<strong>Файл успешно загружен!</strong><br>";
        }
        else{
          // выводим сообщение об ошибке
          echo "<strong>$check</strong>";  
        }
        $FilePath = "imagesProof/".$_SESSION["FileNameProof"];
        $result = mysqli_query($db, "UPDATE `applications` SET `Status`='$status', `FileProof`='$FilePath' WHERE `ID_Application`=".$_GET['resh_id']);
        if ($result == true){
            echo "Информация занесена в базу данных <script>window.location = 'applic.php';</script>";
        }else{
            echo "Информация не занесена в базу данных";
        }
    }
    if (isset($_GET['otk_id'])){
        $status = "Отклонен";
        $result = mysqli_query($db, "UPDATE `applications` SET `Status`='$status' WHERE `ID_Application`=".$_GET['otk_id']);
        if ($result == true){
            echo "Информация занесена в базу данных <script>window.location = 'applic.php';</script>";
        }else{
            echo "Информация не занесена в базу данных";
        }
    }
    
?>

</body>
</html>