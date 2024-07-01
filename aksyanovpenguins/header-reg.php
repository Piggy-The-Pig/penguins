<?php
$query_get_category = "select * from categories";

$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category));
?>

<div class="header">
    <div class="header-div3">
        <a href="/admin/index.php">Только Админы пж :3</a>
        <a href="createNew.php">Создать новость</a>
    </div>
        <hr class="hr1">
        <div class="header-div2">
            <img src="images/search.png" alt="">
            <label for="">
                <input type="search" name="" id="nav-search" placeholder="Поиск">
            </label>
        </div>
        <div class="header-div3">
            <img src="images/profile.png" alt="">
            <a href="../exit.php">Выйти из аккаунта</a>
        </div>
    </div>
    <hr class="hr2">
    <div class="logo-date">
        <div>
            <h1 id="h1" href="../index.php">Пингвинство</h1>
        </div>
        <div class="date-weather">
            <p>insert datetime later**</p>
            <div class="weather">
                <img src="images/weather.png" alt="">
                <p>42°C</p>
            </div>
        </div>
    </div>
    <div class="section">
    <?php
        foreach($categories as $category){
            echo "<li id='styleme'><a href = #>$category[1]</a></li>";
        }
        ?>
    </div>