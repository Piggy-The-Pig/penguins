<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;800&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>
<?php
include "connect.php";
include "header-reg.php";
$UserID = $_COOKIE['user'];
$info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Users WHERE username = '$UserID'"));

?>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Личный кабинет</h2>
        <div class='card'>
            <div class='card-body'>
                <div class="mb-3">
                    <label for="username" class="form-label">Никнейм</label>
                    <input type="text" class="form-control" id="username" value="<?php echo $info['username']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail</label>
                    <input type="email" class="form-control" id="email" value="<?php echo $info['email']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" value="<?php echo $info['password']; ?>" readonly>
                        <span class="input-group-text password-toggle" onclick="togglePassword()">
                            <i class="far fa-eye" id="toggleEye"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            var y = document.getElementById("toggleEye");
            if (x.type === "password") {
                x.type = "text";
                y.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                x.type = "password";
                y.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
</body>

</html>