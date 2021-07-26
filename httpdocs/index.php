    <?php 
include "bd.php";
?>
<DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
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
                <li style="margin-left: 30px; float: left;"><a style="font-size: 30px; color: Red;" class="amenu" href="#">Гость</a></li>
                <li style="margin-left: 30px; float: left;"><a class="amenu" href="signup.php">Регистрация</a></li>
                <li style="margin-left: 30px; float:left;"><a class="amenu" href="login.php">Авторизация</a></li>
                <?php endif; ?>
        </ul>
        
    </div>
<div class="kol" id = "block" >
<script>
setTimeout(F2, 0); // Первый раз запускаем функцию    
    function F2(){
        $.get('info.php?info_path=info', function(data){
            $('#block').html(data);
        });
        setTimeout(F2, 5000); // Запускаем эту же функцию 2-й раз, потом 3-й, 4-й и так до бесконечности
    }
</script>
</div>
<div class="blog10">
<script>
setTimeout(F1, 0); // Первый раз запускаем функцию    
    function F1(){
        $.get('blogindex.php?blogindex_path=blogindex', function(data){
            $('.blog10').html(data);
        });
        setTimeout(F1, 5000); // Запускаем эту же функцию 2-й раз, потом 3-й, 4-й и так до бесконечности
    }
</script>
</div>
<!-- 

setInterval(function(){
$("#block").load("index.php #block");// создание обновления объекта
}, 5000);
-->

</body>
</html>