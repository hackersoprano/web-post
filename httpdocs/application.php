<?php 
include "bd.php";
include_once('loading.php');
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
        <li class="mmenu"><a  class="amenu" href="userinfo.php"><?php echo $_SESSION['user']?></a></li>
        <li class="mmenu"><a  class="amenu" href="logout.php">Выйти</a></li>
                <?php else:  ?>
                <li class="mmenu"><a style="font-size: 20px;" class="amenu" href="#">Гость</a></li>
                <li class="mmenu"><a class="userinfo" class="amenu" href="signup.php">Регистрация</a></li>
                <li class="mmenu"><a class="userinfo" class="amenu" href="login.php">Авторизация</a></li>
                <?php endif; ?>
        </ul>
        
    </div>

    
    <div class="regg" class="applic">  
    <h1>Заявление на устранение проблемы в городе!!!</h1>
        <form action ="" method="POST" enctype="multipart/form-data">
        <p class="applic"><label>Название:<br>
        <input name="title" type="text" value=""></label></p> 
        <p class="applic"><label>Описание:<br>
        <input name="description" size="30" type="text"></label></p>
        <p class="applic"><label>Категория:<br>
        <select style="width: 300px;font-size: 13px;
	padding: 6px 0 4px  10px;
	border: 1px solid #cecece;
	background: #F6F6f6;
	border-radius: 8px;" name="select">
        <?php
        function LoadDataUsers() // Загрузка списка юзеров
        {
            include "bd.php";
            $table = 'categories';
                $query = mysqli_query($db,"SELECT * FROM ".$table);
                $array = mysqli_fetch_array($query);
                do
                {
                    echo ('<option>'.$array['Title'].'</option>');
                }
                while($array = mysqli_fetch_array($query));
        }
        LoadDataUsers();
        ?>
        </select></p>
        <p class="applic"><label>Загрузка фотографии:<br>
        <input type="file" name="file">
        </p>
        <p class="applic"><input style="cursor:pointer;display: inline; background: lime;" type="Submit" name="button_id" value="Отправить" /></p>
    </form>
    </div>
    <?php
    if( isset( $_POST['button_id']))
    {
        $errors = array();
        $table = 'applications';
        $title = $_POST['title'];
        $description = $_POST['description'];
        $select = $_POST["select"];
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
        $FilePath = "images/".$_SESSION["FileName"];
        $Status = "Рассматривается";
        $Author = $_SESSION['user'];
        if ($title == '')
        {
            $errors[]= 'Введите Название';
        }
        if ($description == '')
        {
            $errors[]= 'Введите Описание';
        }
        if ($select == '')
        {
            $errors[]= 'Выберите категорию';
        }
        /*if ($image == '')
        {
            $errors[]= 'Вставьте фото-доказательство';
        }*/
        if (empty($errors))
        {
            $result = mysqli_query($db,"INSERT INTO ".$table." (Title,Description,Category,Author,Status,FilePath) VALUES ('$title','$description',' $select','$Author','$Status','$FilePath')");
            if ($result == true){
                echo "Информация занесена в базу данных";
            }else{
                echo "Информация не занесена в базу данных";
            }
            
        {
            echo array_shift($errors);
        }
        
        
    }
}
    ?>




</body>
</html>