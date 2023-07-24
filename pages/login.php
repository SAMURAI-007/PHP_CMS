<?php
include "../database/db.php";
$success = null;
if (isset($_POST['sub'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];
  $result = $conn->prepare('SELECT * FROM user WHERE email=? AND password=? ');
  $result->bindValue(1, $email);
  $result->bindValue(2, $password);
  $result->execute();
  if ($result->rowCount() >= 1) {
    $success = true;
    $rows=$result->fetch(PDO::FETCH_ASSOC);
    $_SESSION['login']=true;
    $_SESSION['email']=$email;
    $_SESSION['username']=$rows['UserName'];
    $_SESSION['password']=$password;
    $_SESSION['success']=true;
    $_SESSION['role']=$rows['role'];
    header('location:../');
  } else {
    $success = false;
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>ورود</title>
  <script src="sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
  <link rel="stylesheet" href="./sign_in.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <form method="post">
    <div class="screen-1">
      <img src="http://localhost/image/aiko.png" style="margin-bottom: 40px;" alt="">
      <div class="email">
        <label for="email">آدرس ایمیل</label>
        <div class="sec-2">
          <ion-icon name="mail-outline"></ion-icon>
          <input type="email" name="email" placeholder="Username@gmail.com" />
        </div>
      </div>
      <div class="password">
        <label for="password">کلمه عبور</label>
        <div class="sec-2">
          <ion-icon name="lock-closed-outline"></ion-icon>
          <input class="pas" type="password" name="password" placeholder="*********" />
          <ion-icon class="show-hide" name="eye-outline"></ion-icon>
        </div>
      </div>
      <button class="login" name="sub">ورود</button>
      <div class="footer"><span>ثبت نام</span><span>فراموشی رمز</span></div>
    </div>

  </form>

  <?php if ($success){ ?>
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
  <?php } if(isset($_POST['sub'])&& $success==false){?>
    <script>
      const Toast2 = Swal.mixin({
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

      Toast2.fire({
        icon: 'warning',
        title: 'نام کاربری یا کلمه عبور اشتباه'
      })
    </script>

  <?php }?>



  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

  <!-- partial -->

</body>

</html>