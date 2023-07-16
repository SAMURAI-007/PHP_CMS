<?php

include("../database/db.php");
$num = 1;
if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $sort = $_POST['sort'];
    $stat = $_POST['stat'];

    $result = $conn->prepare("INSERT INTO menu SET title=? , sort=? , stats=? ");
    $result->bindValue(1, $title);
    $result->bindValue(2, $sort);
    $result->bindValue(3, $stat);
    $result->execute();
}
$menus = $conn->prepare("SELECT * FROM menu");
$menus->execute();
$menu_display = $menus->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="container" style="padding-left: 300px;">
        <div class=" row">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link " href="index.php">داشبورد</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="menu.php">منو ها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comment.php">نویسندگان</a>
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
                    <input type="text" name="title" placeholder="عنوان">
                    <input type="number" name="sort" placeholder="الویت">
                </div>
                <br>

                <div class="form-check">
                    <label class="form-check-label" style="margin-right: 15px;">
                        <input type="radio" value="true" class="form-check-input" name="stat" style="margin-right: -15px;"checked> فعال
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" style="margin-right: 15px;">
                        <input type="radio" value="false" class="form-check-input" name="stat" style="margin-right: -15px;"> غیر فعال
                    </label>
                </div>
                <br>
                <input class="btn btn-primary" type="submit" name="sub" value="افزودن منو">
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
                        <td><?php echo $menu['title']; ?></td>
                        <td><?php echo $menu['sort']; ?></td>
                        <td><?php if($menu['stats']==1){ ?> <label>فعال</label> <?php }else{ ?> <label>غیر فعال</label> <?php } ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $menu['id']; ?>" class="btn btn-warning">ویرایش</a>
                            <a href="delete.php?id=<?php echo $menu['id']; ?>" class="btn btn-danger">حذف</a>
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

</html>