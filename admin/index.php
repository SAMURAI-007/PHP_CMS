<?php 
include('../database/db.php');
if($_SESSION['role'] != 2){
    header('location:../');

}


?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">داشبورد</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">منو ها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comment.php">نویسندگان</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">بلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../">خروج</a>
                </li>
            </ul>
        </div>
        <br>
        <h2 style="margin-right: 25px;">پنل ادمین</h2>
    </div>
</body>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.min.js"></script>

</html>