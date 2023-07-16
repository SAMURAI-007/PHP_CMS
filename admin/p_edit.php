<?php

include("../database/db.php");
$id = $_GET['id'];
if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $content = $_POST['editor1'];
    $writer = $_POST['writer'];
    $tags = $_POST['tags'];

    $result = $conn->prepare("UPDATE post SET title=? , image=? , content=? , writer=? , tags=? WHERE id=? ");
    $result->bindValue(1, $title);
    $result->bindValue(2, $image);
    $result->bindValue(3, $content);
    $result->bindValue(4, $writer);
    $result->bindValue(5, $tags);
    $result->bindValue(6, $id);
    $result->execute();
    header("location:blog.php");
}
$posts = $conn->prepare("SELECT * FROM post WHERE id=?");
$posts->bindValue(1, $id);
$posts->execute();
$post = $posts->fetch(PDO::FETCH_ASSOC);

$writers = $conn->prepare("SELECT * FROM writers");
$writers->execute();
$writers_display = $writers->fetchAll(PDO::FETCH_ASSOC);

if ($_SESSION['role'] != 2) {
    header('location:../');
}
if (isset($_POST['back'])) {
    header('location:blog.php');
}
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
            <form method="POST">
                <input value="<?php echo $post['title'] ?>" type="text" name="title" class="form-control post-insert" placeholder="عنوان" style="margin-bottom: 15px;">
                <input value="<?php echo $post['image'] ?>" type="text" name="image" class="form-control post-insert" placeholder="آدرس تصویر" style="margin-bottom: 15px;">
                <textarea class="post-create" name="editor1" id="editor1" style="margin-bottom: 15px;">&lt;p&gt;<?php echo $post['content'] ?>&lt;/p&gt;</textarea>
                <br>
                <select value="<?php echo $post['writer'] ?>" name="writer" class="form-control post-insert" style="margin-bottom: 15px;">
                    <option value="">نام نویسنده</option>
                    <?php foreach ($writers_display as $writer) : ?><option value="<?php echo $writer['id'] ?>"><?php echo $writer['name'] ?></option><?php endforeach; ?>
                </select>
                <input value="<?php echo $post['tags'] ?>" type="text" name="tags" class="form-control post-insert" placeholder="تگ ها" style="margin-bottom: 15px;">
                <input type="submit" name="sub" class="btn btn-primary" value="ثبت مقاله">
                <input type="submit" name="back" class="btn btn-warning" value="بازگشت">
                <script>
                    CKEDITOR.replace('editor1', {
                        contentsLangDirection: 'rtl'
                    });
                </script>
            </form>
        </div>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.min.js"></script>

</html>