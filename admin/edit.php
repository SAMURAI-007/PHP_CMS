<?php

include("../database/db.php");
$id=$_GET['id'];
if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $sort = $_POST['sort'];
    $stat = $_POST['stat'];

    $result = $conn->prepare("UPDATE menu SET title=? , sort=? , stats=? WHERE id=? ");
    $result->bindValue(1, $title);
    $result->bindValue(2, $sort);
    $result->bindValue(3, $stat);
    $result->bindValue(4, $id);
    $result->execute();
    header("location:menu.php");
}
$menus = $conn->prepare("SELECT * FROM menu WHERE id=?");
$menus->bindValue(1, $id);
$menus->execute();
$menu_display = $menus->fetch(PDO::FETCH_ASSOC);
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
    <div class="container">
        <br><br><br>
        <div class="row menu-inputs">
            <form method="POST">
                <div>
                    <input type="text" name="title" placeholder="عنوان" value="<?php echo $menu_display['title']; ?>">
                    <input type="number" name="sort" placeholder="الویت" value="<?php echo $menu_display['sort']; ?>">
                </div>
                <br>

                <div class="form-check">
                    <label class="form-check-label" style="margin-right: 15px;">
                        <input type="radio" value="<?php echo $menu_display['title']; ?>" class="form-check-input" name="stat" style="margin-right: -15px;"> فعال
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" style="margin-right: 15px;">
                        <input type="radio" value="<?php echo $menu_display['title']; ?>" class="form-check-input" name="stat" style="margin-right: -15px;"> غیر فعال
                    </label>
                </div>
                <br>
                <input class="btn btn-primary" type="submit" name="sub" value="ویرایش منو">
                <a href="menu.php" class="btn btn-warning">بازگشت</a>
            </form>
        </div>
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