<?php

include("connect.php");
include("header.php");

$new_id = isset($_GET["new"]) ? intval($_GET["new"]) : false;
$query_getNew = "SELECT news.*, categories.name FROM news INNER JOIN categories on news.category_id = categories.category_id where news_id = $new_id";
$new = mysqli_fetch_assoc(mysqli_query($con, $query_getNew));


$date = date("d.m.Y H:i", strtotime($new['publish_date']));

$month = ["01"=>"Январь","02"=>"Февраль","03"=>"Март","04"=>"Апрель","05"=>"Май","06"=>"Июнь","07"=>"Июль","08"=>"Август",
"09"=>"Сентябрь","10"=>"Октябрь","11"=>"Новябрь","12"=>"Декабрь"];

$m_text = $month [substr ($date, 3, 2)];  

$publish_date = substr($date,0,2)." ".$m_text." ".substr($date,6);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;800&display=swap" rel="stylesheet">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class="last-news">
            <div class="container">
                <?php

                echo "<a id='newsp' href='oneNew.php?new=$new_id'>Новость: " . $new['news_id'] . "</a>";
                echo "<div class='cardd'>";
                echo "<h2 class='c_title'>" . $new['title'] . "</h2><br>";
                echo "<p>Категория: <b>" . $new['name'] . "</b></p>";
                echo "<br><p>" . $new['content'] . "</p>";
                echo "<img id='img' src=images/news/" . $new['image'] . ">";
                echo "<p id='newsdate'>Дата публикации" . " " . $publish_date . "</p>";
                echo "</div>";
                ?>
            </div>
        </section>
    </main>

</body>

</html>