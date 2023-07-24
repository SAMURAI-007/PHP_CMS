<?php

include("../database/db.php");
$id=$_GET['id'];
if (isset($_POST['sub'])) {
    $title = $_POST['name'];
    $sort = $_POST['username'];
    $stat = $_POST['pass'];

    $result = $conn->prepare("UPDATE writers SET name=? , username=? , password=? WHERE id=? ");
    $result->bindValue(1, $title);
    $result->bindValue(2, $sort);
    $result->bindValue(3, $stat);
    $result->bindValue(4, $id);
    $result->execute();
    header("location:comment.php");
}
$menus = $conn->prepare("SELECT * FROM writers WHERE id=?");
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
                    <input type="text" name="name" placeholder="نام نویسنده" value="<?php echo $menu_display['name']; ?>">
                    <input type="text" name="username" placeholder="نام کاربری" value="<?php echo $menu_display['username']; ?>">
                    <input type="text" name="pass" placeholder="کلمه عبور" value="<?php echo $menu_display['password']; ?>">
                </div>
                <br>
                <br>
                <input class="btn btn-primary" type="submit" name="sub" value="ویرایش نویسنده">
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