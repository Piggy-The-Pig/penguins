<?php
include "../connect.php";

$id = isset($_POST["id"]) ? ($_POST["id"]) : false;
$file = ($_FILES["userImages"]["size"] != 0) ? $_FILES['userImages'] : false;
$title = isset($_POST["userTitle"]) ? $_POST['userTitle'] : false;
$text = isset($_POST["userText"]) ? $_POST['userText'] : false;
$categ = isset($_POST["userCategory"]) ? $_POST['userCategory'] : false;

function check_error($error, $id) {
    return "<script>alert('$error'); location.href = '/admin?new=$id';</script>";
}

$new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM news WHERE news_id=$id"));

$query_update = "UPDATE news SET ";

$check_update = false;

if($new_info["title"] != $title) 
{
    $query_update .= "title = '$title'";
    $check_update = true;
}
if($new_info["content"] != $text)
{ 
$query_update .= "content = '$text'";
$check_update = true;
}
if($new_info["category_id"] != $categ) 
{
    $query_update .= "category_id = $categ";
    $check_update = true;
}
if($file) {
    $query_update .= "image = '". $file['name'] . "'";
    move_uploaded_file($file['tmp_name'], "../images/news/". $file["name"]);
    $check_update = true;
}

if($check_update) {
$query_update .= " WHERE news_id = $id";
$result = mysqli_query($con, $query_update);
if($result) echo check_error("Данные изменены",$id);
else echo check_error("Ошибка обновления" . mysqli_error($con),$id);
}
else {
    echo check_error("Добавьте изменения",$id);
}

?>