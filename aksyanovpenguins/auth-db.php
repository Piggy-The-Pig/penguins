<?php
include "connect.php"; 
session_start();
$login = strip_tags(trim($_POST['login']));
$pass = strip_tags(trim($_POST['password']));
$query = "SELECT * FROM Users WHERE username = '$login' and password = '$pass'";
$result1 = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result1);
if($login == "admin" and $pass == "admin")
{
	header('Location: admin/index.php');
	exit();
}
else{
	if(is_null ($user) ){
		echo "Такой пользователь не найден.";
		exit();
	}
	else if(count($user) == 1){
		echo "Логин или пароль введены неверно";
		exit();
	}

	$_SESSION["user"]= $user['user_id'];

	header('Location: page.php');}