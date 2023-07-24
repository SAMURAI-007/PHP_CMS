<?php
include '../database/db.php';
$success = null;
if (isset($_POST['sub'])) {
  $name = $_POST['usr'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = $conn->prepare("INSERT INTO user SET UserName=? , Password=? , Email=? ");
  $result->bindValue(1, $name);
  $result->bindValue(2, $password);
  $result->bindValue(3, $email);
  $result->execute();
  $success=true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>ثبت نام</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
  <link rel="stylesheet" href="./sign_in.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <form method="POST">
    <div class="screen-1">
      <img src="http://localhost/image/aiko.png" style="margin-bottom: 40px;" alt="">
      <div class="email">
        <label for="email">نام و نام خانوادگی</label>
        <div class="sec-2">
          <ion-icon name="person-outline"></ion-icon>
          <input type="text" name="usr" />
        </div>
      </div>
      <br>
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
      <button name="sub" class="login">ثبت نام</button>
      <div class="footer"><span> ورود</span></div>
    </div>
  </form>
  <!-- partial -->

</body>
<?php if ($success) { ?>
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
      title: 'ثبت نام با موفقیت انجام شد!'
    })
  </script>

<?php } ?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>


</html>