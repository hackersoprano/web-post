<?php require "bd.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/style.css" >
  <link rel="stylesheet" href="css/animate.css">
	<title>Название</title>
</head>
<body>
<script src="js/jq.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>

<!-- Меню -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid divv">
    <a class="navbar-brand" href="#">Название</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Главная</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shop.php">Магазин</a>
        </li>
        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item">
          <a class="nav-link" href="#">Профиль</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Корзина <span class="badge bg-secondary">4</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Выход</a>
        </li>
          <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" href="#aft">Авторизация</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" href="#reg">Регистрация</a>
        </li>
      <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<?php
  if (isset($_SESSION["Error"])){
    if ($_SESSION["Error"] == "signup"){
    echo '<div class="errordiv">
<!-- ЛОГИН -->
        <form action ="" method="POST">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Логин</span>
          </div>
          <input name="login" type="text" class="form-control" placeholder="Имя пользователя" aria-label="Логин пользователя" aria-describedby="basic-addon1">
        </div>

        <!-- ПАРОЛЬ -->

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Пароль</span>
          </div>
          <input name="password" type="password" class="form-control" placeholder="Пароль" aria-label="Пароль" aria-describedby="basic-addon1">
        </div>

        <!-- Повтор пароля -->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Повтор пароля</span>
          </div>
          <input name="rpassword" type="password" class="form-control" placeholder="Повтор пароля" aria-label="Повтор пароля" aria-describedby="basic-addon1">
        </div>

        <!-- Почта -->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">E-Mail</span>
          </div>
          <input name="email" type="text" class="form-control" placeholder="E-Mail" aria-label="E-Mail" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="modal-footer errordiv">
        <button name="but2" type="submit" class="btn btn-primary">Зарегестрироваться</button>
      </form>
</div>';
  }
  }
?>

<?php 


 if (isset($_SESSION["Error"])){
  if ($_SESSION["Error"] == "login"){
    echo '<div class="errordiv">

  <!-- ЛОГИН -->
        <form id="myform" action ="login.php" method="POST">
        <div class="input-group mb-3" id="maind">
          <div class="input-group-prepend" >
            <span class="input-group-text" id="basic-addon1">Логин</span>
          </div>
          <input name="login" id="login" type="text" class="form-control" placeholder="Имя пользователя" aria-label="Логин пользователя" aria-describedby="basic-addon1" >
        </div>

        <!-- ПАРОЛЬ -->

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Пароль</span>
          </div>
          <input name="password" id="password" type="password" class="form-control" placeholder="Пароль" aria-label="Пароль" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="modal-footer errordiv">
        <button type="button" onclick="start()" name="but1" class="btn btn-primary but1">Войти</button>
        
      </form> 
</div>';
  }
}
?>

</body>
</html>