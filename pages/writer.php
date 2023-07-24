<?PHP
include "../database/db.php";





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





        <br><br><br><br><br><br><br><br>

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
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>