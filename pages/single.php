<?php
include "../database/db.php";
include "../admin/jdf.php";


$posts = $conn->prepare("SELECT * FROM post");
$posts->execute();
$post_display = $posts->fetchAll(PDO::FETCH_ASSOC);
foreach ($post_display as $post) {
}

$writers = $conn->prepare("SELECT * FROM writers");
$writers->execute();
$writers_display = $writers->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/css/bootstrap.css">
    <link rel="stylesheet" href="http://localhost/css/style.css">
    <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>SITE</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">آیکو</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">خانه<span class="sr-only">(current)</span></a>
                    </li>
                    <?php if (isset($_SESSION['login'])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                پروفایل
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <span class="dropdown-item"><?php echo $_SESSION['username'] ?> </span>
                                <span class="dropdown-item"><?php echo $_SESSION['email'] ?></span>
                                <?php if ($_SESSION['role'] == 2) { ?> <a class="dropdown-item" href="admin/index.php">پنل ادمین</a> <?php } ?>
                                <a class="dropdown-item" href="/pages/logout.php">خروج</a>
                            </div>
                        </li>


                    <?php } else { ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="login.php">ورود/ثبت نام<span class="sr-only">(current)</span></a>
                        </li>
                    <?php } ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            مقالات
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">برنامه نویسی</a>
                            <a class="dropdown-item" href="#">سایت</a>
                            <a class="dropdown-item" href="#">امنیت</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 mr-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="دنبال چی میگردی؟" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">جستجو</button>
                </form>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="post-page2">
                <div class="post-img-title">
                    <img src="<?php echo $post['image'] ?>">
                </div>
                <div class="v-d-w">
                    <div>
                        <span class="views" style="padding: 5px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                            </svg>۱۶۹
                        </span>
                    </div>
                    <div>
                        <span class="views comment" style="padding: 5px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z" />
                            </svg><?php echo jdate("Y/m/d",$post['date']) ?>
                        </span>
                    </div>
                    <div>
                        <span class="views-writer" style="padding: bottom 10px;padding: 5px;">
                            <a href=""> <svg class="writer-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path style="color: #007bff;" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg><?php  foreach($writers_display as $writer){if($post['writer']==$writer['id']){echo $writer['name'];}}   ?></a>
                        </span>
                    </div>
                    <br>

                </div>
                <div class="post-content">
                    <h5><?php echo $post['title'] ?></h5>
                    <?php echo $post['content'] ?>
                    
                </div>
                <div class="tag-border">
                    <a href="">شبکه</a>
                    <a href="">برنامه نویسی</a>
                    <a href="">هکینگ</a>
                    <a href="">وبسایت</a>
                </div>
            </div>


            <div>
                <br>
                <b>نظرات کاربران</b>
                <br>
                <br>

                <form>
                    <textarea name="editor1" id="editor1">&lt;p&gt;نظر خود را بنویسید.&lt;/p&gt;</textarea>
                    <script>
                        CKEDITOR.replace('editor1');
                    </script>
                    <input type="button" value="ثبت نظر" class="btn btn-success" style="margin-top: 10px;">
                </form>
            </div>
            <br>
        </div>
        <div class="comments">
            <div class="comment-item">
                <div class="comment-img">
                    <img src="http://localhost/image/profile.png" alt="">
                    <span>امین مظفری</span>
                    <p style="color: #808080; font-size:13px;margin-right: 195px;margin-top: -47px;">ثبت شده در 12/3/02</p>
                </div>
                <div class="comment-text">
                    <p>مقاله مفید و جالبی بود</p>
                    <p>گاهی اوقات کلمات برای تشکر کردن کم است. مدت ها پیش که هیچ دوره مناسب و پروژه محور که به صورت رایگان باشد پیدا نمی‌کردم به دوره شما برخوردم. با دوره شما به دنیای php پا گذاشتم و بعد از مدتی سراغ لاراول رفتم. در لاراول متخصص شدم و سراغ فریمورک‌های جاوااسکریپتی رفتم. چند روزی است به عنوان فول استک کار مشغول شدم. اگر این دوره شما نبود هیچ وقت به اینجا نمی‌رسیدم. واقعا ممنونم...!</p>

                </div>
            </div>
        </div>

    </div>

    <footer>
        <div class="footer1">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <br><br>
                        <form>
                            <input type="text" class="input-group" placeholder="پست الکترونیکی شما">
                            <input type="submit" class="btn btn-success" value="عضویت در خبرنامه">
                        </form>
                    </div>

                    <div class="col-12 col-lg-2">
                        <img class="namad" src="http://localhost/image/namad.png">

                    </div>
                    <div class="col-12 col-lg-2">
                        <img class="namad2" src="http://localhost/image/logo_anjooman_senfi.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer2">
            <p>Created by A_develop™ . all rights reserved</p>
        </div>
    </footer>

</body>
<script src="http://localhost/js/jquery-3.5.1.min.js"></script>
<script src="http://localhost/js/bootstrap.min.js"></script>

</html>