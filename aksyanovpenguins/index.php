<?php
include "connect.php"; 
include "header.php";

$sort = isset($_GET["sort"]) ? $_GET["sort"] : false;
$filter = isset($_GET["filter"]) ? $_GET["filter"] : false;

$param = "";

$query = "select * from news";

$paginate_count = 3;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

if ($sort) {
    $query = "SELECT * FROM News ORDER BY publish_date $sort";
}

if ($filter) {
    $param .= "filter=$filter";
    $query = "select * from news where category_id = $filter";
}

if ($sort && $filter) {
    $query = "select * from news where category_id = $filter order by publish_date $sort";
}

if ($searching) {
    $query = "SELECT * FROM NEWS WHERE title LIKE '%$searching%'";
}

$offset = $page * $paginate_count - $paginate_count; 

$count_news = mysqli_num_rows(mysqli_query($con, $query));

$news = mysqli_query($con, $query . " LIMIT $paginate_count OFFSET $offset");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;800&display=swap" rel="stylesheet">
   
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class="sort">
            <ul class="list-group list-group-horizontal mt-5 mb-3">
                <h3>Сортировка по дате публикации:</h3>
                <li class="list-group-item">
                    <a href="/?sort=ASC<?= ($param != '') ? '&' . $param : '' ?>"><img width="20" src="images/asc-sort.png"
                            alt="asc"></a>
                </li>
                <li class="list-group-item">
                    <a href="/?sort=DESC<?= ($param != '') ? '&' . $param : '' ?>"><img width="20" src="images/desc-sort.png"
                            alt="desc"></a>
                </li>
            </ul>
        </section>
        <section class="last-news">
            <div class="container">
                <?php
                while ($new = mysqli_fetch_assoc($news)) {
                    $new_id = $new['news_id'];
                    echo "<a id='newsp' href='oneNew.php?new=$new_id'>Новость: " . $new['news_id'] . "</a>";
              
                    echo "<div class='card'>";
                    echo "<h2 class='c_title'>" . $new['title'] . "</h2><br>";
                    echo "<br><p>" . $new['content'] . "</p>";
                    echo "<img id='img' src=images/news/" . $new['image'] . ">";
                    echo "<p id='newsdate'>Дата публикации" . " " . $new['publish_date'] . "</p>";
                    echo "</div>";

                }
                ?>
        </section>
        <section>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php
                    for ($i = 1; $i <= ceil($count_news / $paginate_count); $i++) { ?>
                        <li class="page-item"><a class="page-link"
                                href="?page=<?= $i ?><?= $filter ? '&filter=' . $filter : '' ?><?= $sort ? '&sort=' . $sort : '' ?>">
                                <?= $i ?>
                            </a></li>
                    <?php } ?>

                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </main>
    </div>
</body>

</html>