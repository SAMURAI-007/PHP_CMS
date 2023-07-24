<?php

include("../database/db.php");
include("../admin/jdf.php");
$done = false;
$num=1;
if ($_SESSION['role'] != 2) {
    header('location:../');
}
if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $content = $_POST['editor1'];
    $writer = $_POST['writer'];
    $tags = $_POST['tags'];

    $result = $conn->prepare("INSERT INTO post SET title=? , image=? , content=? , writer=? , date=? ,tags=? ");
    $result->bindValue(1, $title);
    $result->bindValue(2, $image);
    $result->bindValue(3, $content);
    $result->bindValue(4, $writer);
    $result->bindValue(5, time());
    $result->bindValue(6, $tags);
    $result->execute();
    $done = true;
}
$writers = $conn->prepare("SELECT * FROM writers");
$writers->execute();
$writers_display = $writers->fetchAll(PDO::FETCH_ASSOC);

$posts = $conn->prepare("SELECT * FROM post");
$posts->execute();
$posts_display = $posts->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link " href="index.php">داشبورد</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">منو ها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comment.php">نویسندگان</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="blog.php">بلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/logout.php">خروج</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <form method="POST">
                <input type="text" name="title" class="form-control post-insert" placeholder="عنوان" style="margin-bottom: 15px;">
                <input type="text" name="image" class="form-control post-insert" placeholder="آدرس تصویر" style="margin-bottom: 15px;">
                <textarea class="post-create" name="editor1" id="editor1" style="margin-bottom: 15px;">&lt;p&gt;متن را وارد کنید.&lt;/p&gt;</textarea>
                <br>
                <select name="writer" class="form-control post-insert" style="margin-bottom: 15px;">
                    <option value="">نام نویسنده</option>
                    <?php foreach ($writers_display as $writer) : ?><option value="<?php echo $writer['id'] ?>"><?php echo $writer['name'] ?></option><?php endforeach; ?>
                </select>
                <input type="text" name="tags" class="form-control post-insert" placeholder="تگ ها" style="margin-bottom: 15px;">
                <input type="submit" name="sub" class="btn btn-primary" value="ثبت مقاله">
                <script>
                    CKEDITOR.replace('editor1', {
                        contentsLangDirection: 'rtl'
                    });
                </script>
            </form>
        </div>
        <div class="row">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>تصویر</th>
                        <th>نویسنده</th>
                        <th>تاریخ</th>
                        <th>تگ ها</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts_display as $post) { ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $post['title']; ?></td>
                            <td><img style="max-width: 100px;" src="<?php echo $post['image']; ?>"></td>
                            <td><?php foreach($writers_display as $writer){if($post['writer']==$writer['id']){echo $writer['name'];}}; ?></td>
                            <td><?php echo jdate("Y/m/d",$post['date']); ?></td>
                            <td><?php echo $post['tags']; ?></td>

                            <td>
                                <a href="p_edit.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">ویرایش</a>
                                <a href="p_delete.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">حذف</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php if ($done) { ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'پست با موفقیت ثبت شد'
            })
        </script>
    <?php } ?>


</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.min.js"></script>

</html>