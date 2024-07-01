<?php 

$login = strip_tags(trim($_POST['login']));
$email = strip_tags(trim($_POST['email']));
$pass = strip_tags(trim($_POST['password']));
if(mb_strlen($login) < 5 || mb_strlen($login) > 100){
  echo "Недопустимая длина логина";
  exit();
}
require "connect.php"; 
$result1 = mysqli_query($con,"SELECT * FROM `users` WHERE `username` = '$login'");
$user1 = mysqli_fetch_assoc($result1); 
if(!empty($user1)){
  echo "Данный логин уже используется!";
  exit();
}
$result2 = mysqli_query($con,"SELECT * FROM Users WHERE email = '$email'");
$user1 = mysqli_fetch_assoc($result1); 
  echo "Данный логин уже используется!";
  exit();
  
$querryUser = mysqli_query($con,"INSERT INTO `users` (`username`, `password`, `email`)VALUES('$login', '$pass', '$email')");

if ($querryUser) {
	echo "<script>alert(\"Вы успешно зарегистрировались!\")
	location.href = 'auth.php';
	</script>";
} else {
	echo "<script>alert(\"Вы не смогли зарегистрироваться!\");
	location.href = 'reg.php';
	</script>";
}
?>
