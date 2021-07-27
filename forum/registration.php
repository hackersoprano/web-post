<?php include "bd.php"; ?>
<DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="regg">  
<form action ="" method="POST">
<h1 style="font-size: 40px;" class="reg">Регистрация</h1></br>
<p class="reg"><label>ФИО:<br>
<input name="FIO"="20" type="text" value=""></label></p> 
<p class="reg"><label>Ваш логин:<br>
<input name="login"="20" type="text" value=""></label></p> 
<p class="reg"><label>Ваш email:<br>
<input name="Email"="20" type="email" value=""></label></p> 
<p class="reg"><label>Пароль:<br>
<input name="password" size="30" type="password"></label></p>
<p class="reg"><label>Повторите пароль:<br>
<input name="rpassword" size="30" type="password"></label></p>
<p class="reg">Согласие на обработку персональных данных<input style="height: 18px;width: 18px" type="checkbox" name='check' ></p>
<p class="reg"><input style="cursor:pointer;display: inline;" type="Submit" name="button_id" value="Регистрация" /></p>

    <?php 
    if( isset( $_POST['button_id'])){
        $errors = array();
        $table = 'users';
        $FIO = $_POST["FIO"];
        $login = $_POST["login"];
        $Email = $_POST["Email"];
        $password = $_POST["password"];
        $rpassword = $_POST["rpassword"];
        if ($FIO == '')
        {
            $errors[]= 'Введите ФИО';
        }
        if ($login == '')
        {
            $errors[]= 'Введите Логин';
        }
        if ($Email == '')
        {
            $errors[]= 'Введите Email';
        }
        if ($password == '')
        {
            $errors[]= 'Введите пароль';
        }
        if ($password != $rpassword)
        {
            $errors[]= 'Пароли не совпадают';
        }
        if ($_POST["check"] == '')
        {
            $errors[]= 'Нужно согласие на обработку данных';
        }
        if (empty($errors))
        {
            $date=date("Y-m-d H:i:s");
            $password=password_hash($password, PASSWORD_DEFAULT);
            $result = mysqli_query($db,"INSERT INTO ".$table." (FIO,Login,Email,Password,Role,dateregistr) VALUES ('$FIO','$login',' $Email','$password','2','$date')");
            if ($result == true){
                echo "Информация занесена в базу данных <script>window.location = '/';</script>";
                
            }else{
                echo "Информация не занесена в базу данных";
            }
        }
        {
            echo array_shift($errors);
        }
        
        
    }
    
    ?>
</form>
</div>
</body>
</html>