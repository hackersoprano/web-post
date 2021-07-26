<?php
include "bd.php";
?>
<?php
function LoadDataUsers() // Загрузка списка юзеров
{   
    include "bd.php";
    //$result = mysqli_query($db,"SELECT * FROM ".$table." ORDER BY ID DESC LIMIT 1");//Вывод последней
    $result = mysqli_query($db,"SELECT * FROM `applications` where `Status` = 'Выполнен' ORDER BY `ID_Application` DESC LIMIT 4");
    $array = mysqli_fetch_array($result);
    do {
        if ($array["Status"]=="Выполнен"){
        echo "
    <div class = 'blog1'>
    <div class='blog2'><p class='blogp'>Название:".$array['Title']."</p><br></div>
    <div class='blog3'><p class='blogp'>Описание: ".$array['Description']."</p><br></div>
    <div class='blog4'><p class='blogp'>Категория: ".$array['Category']."</p><br></div>
    <div class='blog5'><div class='imgg'><img class='docoz' src=".$array['FileProof']."><img class='ist' src=".$array['FilePath']."><br></div></div>
    <div class='blog6'><p class='blogp' style = 'margin: 0; padding: 0;'>Автор: ".$array['Author']."</p></div>
    </div>
    ";
        }
    }
    while ($array = mysqli_fetch_array($result));
}
LoadDataUsers();
?>