<?php 
    include "bd.php";
    if( isset( $_POST['button_id']))
    {
        $table = 'users';
        $login = $_POST["login"];
        $password = $_POST["password"];
        

        if ($login != "" && $password != ""){
            $result = mysqli_query($db,"SELECT * FROM ".$table." WHERE Login ='$login'");
            $user = mysqli_fetch_array($result);
            if (password_verify($password, $user['Password']))
            {
                $_SESSION["user"] = $user["Login"];
                $_SESSION["Role"] = $user["Role"];
                $_SESSION["ID_User"] = $user["ID"];
                echo "Успешная авторизация <script>window.location = '/';</script>";
            }
            else 
            {
                echo "Не совпал пароль";
            }
        }
    }
    ?>