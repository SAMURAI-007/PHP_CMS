<?php

include("../database/db.php");
if($_SESSION['role'] != 2){
    header('location:../');

}

$num=1;
if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $result = $conn->prepare("INSERT INTO writers SET name=? , username=? , password=? ");
    $result->bindValue(1, $name);
    $result->bindValue(2, $uname);
    $result->bindValue(3, $pass);
    $result->execute();
}
$menus = $conn->prepare("SELECT * FROM writers");
$menus->execute();
$menu_display = $menus->fetchAll(PDO::FETCH_ASSOC);
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
                    <a class="nav-link" href="index.php">داشبورد</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">منو ها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="comment.php">نویسندگان</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">بلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/logout.php">خروج</a>
                </li>
            </ul>
        </div>
        <br>
        <div class="row menu-inputs">
            <form method="POST">
                <div>
                    <input type="text" name="name" placeholder="نام نویسنده">
                    <br>
                    <input type="text" name="uname" placeholder="نام کاربری">
                    <br>
                    <input type="tex" name="pass" placeholder="کلمه عبور">
                </div>
                <br>
                <input class="btn btn-primary" type="submit" name="sub" value="افزودن نویسنده">
            </form>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>الویت</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menu_display as $menu) { ?>
                    <tr>
                        <td><?php echo $num++; ?></td>
                        <td><?php echo $menu['name']; ?></td>
                        <td><?php echo $menu['username']; ?></td>
                        <td><?php echo $menu['password']; ?></td>
                        <td>
                            <a href="w_edit.php?id=<?php echo $menu['id']; ?>" class="btn btn-warning">ویرایش</a>
                            <a href="w_delete.php?id=<?php echo $menu['id']; ?>" class="btn btn-danger">حذف</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.min.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<br>
</div>
</body>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.min.js"></script>

</html>