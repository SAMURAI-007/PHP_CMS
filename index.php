<?php
include 'database/db.php';
$result = $conn->prepare("SELECT COUNT(id) FROM post");
$result->execute();
$numposts = $result->fetch(PDO::FETCH_ASSOC);
foreach ($numposts as $numpost) {
}

$result2 = $conn->prepare("SELECT COUNT(id) FROM writers");
$result2->execute();
$writers = $result2->fetch(PDO::FETCH_ASSOC);
foreach ($writers as $writer) {
}

$result3 = $conn->prepare("SELECT COUNT(id) FROM user");
$result3->execute();
$users = $result3->fetch(PDO::FETCH_ASSOC);

$posts = $conn->prepare("SELECT * FROM post");
$posts->execute();
$posts_display = $posts->fetchAll(PDO::FETCH_ASSOC);

$writers = $conn->prepare("SELECT * FROM writers");
$writers->execute();
$writers_display = $writers->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
}


function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}
 

 
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="http://localhost/css/bootstrap.css">
  <link rel="stylesheet" href="http://localhost/css/style.css">
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
              <a class="nav-link" href="pages/login.php">ورود/ثبت نام<span class="sr-only">(current)</span></a>
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
    <div>
      <br>
      <br>
      <div class="row d-none d-lg-flex">
        <div class="col-4 information-site">
          <img style="height: 150px;" src="http://localhost/image/stat-time.png" alt="">
          <span style="color: #fff;"><?php echo $numpost ?>مقاله</span>
        </div>

        <div class="col-4 information-site">
          <img style="height: 150px;" src="http://localhost/image/stat-teacher.png" alt="">
          <span style="color: #fff;"><?php echo $writer ?> نویسنده</span>
        </div>
        <div class="col-4 information-site">
          <img style="height: 150px;" src="http://localhost/image/stat-student.png" alt="">
          <span style="color: #fff;"> <?php echo $user ?> کاربر </span>
        </div>
      </div>
    </div>
    <br><br><br>
    <div>
      <h5 style="margin-right: 20px;">مقالات سایت آیکو</h5>
      <br>
      <div class="row">
        <?php foreach ($posts_display as $post) { ?>
          <div class="col12 col-lg-4">
            <div class="post-item">
              <a href="/pages/single.php" class="item-hover-btn"><img src="<?php echo $post['image'] ?>" alt="" width="100%">
                <div class="hovered">
                  <div class="post-item-img d-none d-lg-flex">
                  </div>
                  <a href="/pages/single.php" class="post-page btn d-none d-lg-flex">مشاهده ی مقاله</a>
                </div>
              </a>
              <div class="post-caption">
                <h5 style="font-weight: 500; margin-top:10px;"><?php echo $post['title'] ?></h5>
                <span><?php echo limit_words($post['content'],20); ?></span>
                <br><br>
                <span class="views" style="padding: 5px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                  </svg>۱۶۹
                </span>
                <span class="views comment" style="padding: 5px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
                    <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9.06 9.06 0 0 0 8 15z" />
                  </svg>۴۸
                </span>
                <span class="views-writer float-left" style="padding: bottom 10px;padding: left 15px;">
                  <a href=""> <svg class="writer-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                      <path style="color: #007bff;" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg><?php foreach($writers_display as $writer){if($post['writer']==$writer['id']){echo $writer['name'];}}  ?></a>

                </span>
              </div>
            </div>
          </div>

        <?php } ?>

      </div>
    </div>
  </div>
  <br><br><br>
  <?php if (isset($_SESSION['success'])) { ?>
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
        title: 'با موفقیت وارد شدید'
      })
    </script>
  <?php }  ?>

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
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</html>