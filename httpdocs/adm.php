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
<tr valign="top">
<td colspan="3">Администраторы:</td>
</tr>
<?php 
function LoadDataUsers() // Загрузка списка юзеров
{
    include "bd.php";
    $table = 'users';
        $query = mysqli_query($db,"SELECT * FROM ".$table);
        $array = mysqli_fetch_array($query);
        do
        {
            if (3 == $array["Role"])
            {
            echo ('<tr valign="top">
            <td width="50%">ID: '.$array['ID_User'].'</td>
            <td>Логин: '.$array['Login'].'</td>
            </tr>');
            }
        }
        while($array = mysqli_fetch_array($query));
}
LoadDataUsers();
?>



</body>
</html>