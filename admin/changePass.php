<?php require_once('../config.php') ?>
<!-- <?php
session_start();
?> -->
<!DOCTYPE html>
<html lang="en">

<?php require_once('inc/header.php') ?>

<body class="hold-transition login-page">

<style>
    body {
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size: cover;
      background-repeat: no-repeat;
      backdrop-filter: contrast(1);
    }

    #page-title {
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
      background: #8080801c;
    }
  </style>

  <?php

  if (isset($_POST['password'], $_POST['confirm_password'])) {

    include('dbcon.php');
    $conn = dbcon();
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);

    $query = "SELECT * FROM users WHERE contact_no='$_SESSION[contact_no]'";
    $result = mysqli_query($conn, $query) or die(mysqli_error());
    $row = mysqli_fetch_array($result);
    $num_row = mysqli_num_rows($result);

    if ($num_row > 0) {
      if ($password == $confirm_password) {
        mysqli_query($conn, "update users set password='$password' where contact_no='$_SESSION[contact_no]'");
  ?>
        <script type='text/javascript'>
          toastr.success('Password change successfully');
          var delay = 1000;
          setTimeout(function() {
            window.location = 'index.php'
          }, delay);
        </script>
      <?php
      } else {
      ?>
        <script type='text/javascript'>
          toastr.error('Password didnt match..!');
        </script>
  <?php
      }
    } else {
      echo 'false';
    }
  }
  ?>

  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1">Change Password</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your <b><?php echo $_SESSION['contact_no']; ?></b> password now.</p>
        <form action="changePass.php" method="post">

          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="index.php">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.bundle.min.js" integrity="sha512-mULnawDVcCnsk9a4aG1QLZZ6rcce/jSzEGqUkeOLy0b6q0+T6syHrxlsAGH7ZVoqC93Pd0lBqd6WguPWih7VHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- AdminLTE App -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/js/adminlte.min.js" integrity="sha512-pbrNMLSckfh8yEOr2o1RT+4zMU3Sj7+zP3BOY6nFVI/FLnjTRyubNppLbosEt4nvLCcdsEa8tmKhH3uqOYFXKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>