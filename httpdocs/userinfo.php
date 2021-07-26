<?php 
include "bd.php";
?>
<DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="UTF-8" />
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
                <?php endif; ?>
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
    <?php 
        $open = $_SESSION["user"];
        $table = 'users';
        $result = mysqli_query($db,"SELECT * FROM ".$table." WHERE Login ='$open'");
        $userH = mysqli_fetch_array($result);
        $FIO = $userH["FIO"];
        $login = $userH["Login"];
        $Email = $userH["Email"];
        $password = $userH["Password"];
        $Role = $userH["Role"];
        if ($Role == 3)
        {
            $role = "Администратор";
        }
        else
        {
            $role = "Пользователь";
        }

    ?>

<table class="tbglav" style="margin: auto;text-align: center;" width="50%">
<tr valign="top">
<td colspan="3"><?php echo $_SESSION["user"];?></td>
</tr>
<tr valign="top">
<td width="50%">ФИО: <?php echo $FIO; ?></td>
<td>Логин: <?php echo $login; ?></td>
</tr>
<tr valign="top">
<td width="50%">Пароль: <?php echo $password; ?></td>
<td>Роль: <?php echo $role; ?></td>
</tr>
<tr valign="top">
<td width="50%">Почта: <?php echo $Email; ?></td>
</tr>
</table>



<table class="tbglav" style="margin: auto;text-align: center;" width="50%">
<h3 style ="font-size: 50px;" class="regg">Ваши заявки:</h4>
  <tr>
    <td>Название</td>
    <td>Описание</td>
    <td>Категория</td>
    <td>Статус</td>
  </tr>
<?php
$author = $_SESSION['user'];
$query = mysqli_query($db,"SELECT * FROM `applications` WHERE `Author` ='$author'");
while ($array = mysqli_fetch_array($query))
{
    echo '<tr>' .
           "<td>{$array['Title']}</td>" .
           "<td>{$array['Description']} </td>" .
           "<td>{$array['Category']} </td>" .
           "<td>{$array['Status']} </td>" .
           "<td><a style='background: red;' class='butt' href='?del_id={$array['ID_Application']}'>Удалить</a></td>" .
           "<td><a class='butt' href='?view_id={$array['ID_Application']}'>Просмотр</a></td>" .
           '</tr>';
}
?>
<?php
if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
    //удаляем строку из таблицы
    $query = mysqli_query($db, "DELETE FROM `applications` WHERE `ID_Application` = ".$_GET['del_id']);
    if ($query) {
      echo "<p>Запись удалена.</p>";
      echo "Успешное удаление!<script>window.location = 'userinfo.php';</script>";
    }else{
        echo "<p>Ошибка.</p>";
    }
    }
    if (isset($_GET['view_id'])) {
        $query = mysqli_query($db, "SELECT * FROM `applications` WHERE `ID_Application` = ".$_GET['view_id']);
        $Row = mysqli_fetch_array($query);
        echo "<input value='Закрыть просмотр' type='button' onclick='location.href= `userinfo.php`' />";
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
?>
</table>


</body>
</html>