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
                


            </ul>
        </nav>       
        </div>
        <ul style = " float:right; padding-right: 3%;" class="ml">
        <li class="mmenu"><a class="amenu" href="signup.php">Регистрация</a></li>
        <li class="mmenu"><a class="amenu" href="login.php">Авторизация</a></li>
        </ul>
    </div>

<div class="regg">  
<form action ="" method="POST">
<h1 style="font-size: 40px;" class="reg">Авторизация</h1></br>
<p class="reg"><label>Ваш логин:<br>
<input name="login"="20" type="text" value=""></label></p> 
<p class="reg"><label>Пароль:<br>
    <input name="password" size="30" type="password"></label></p>
    <p class="reg"><input style="cursor:pointer;display: inline; background: lime;" type="Submit" name="button_id" value="Авторизация" /></p>

    <?php 
    if( isset( $_POST['button_id']))
    {
        $table = 'users';
        $login = $_POST["login"];
        $password = $_POST["password"];

        if ($login != "" && $password != ""){
            $result = mysqli_query($db,"SELECT * FROM ".$table." WHERE Login ='$login'");
            $user = mysqli_fetch_array($result);
            if ($password == $user['Password'])
            {
                $_SESSION["user"] = $user["Login"];
                $_SESSION["Role"] = $user["Role"];
                $_SESSION["ID_User"] = $user["ID_User"];
                echo "Успешная авторизация <script>window.location = '/';</script>";
            }
            else 
            {
                echo "Не совпал пароль";
            }
        }
    }
    ?>
</form>
</div>

</body>
</html>