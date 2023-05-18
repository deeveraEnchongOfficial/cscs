<?php require_once('../config.php') ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition login-page">
<!-- <script>
    start_loader()
  </script> -->
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
  if (isset($_POST['contact_no'])) {

    // session_start();
    include('dbcon.php');
    $conn = dbcon();
    $contact_no = $_POST['contact_no'];
    /*................................................ admin .....................................................*/
    $query = "SELECT * FROM users WHERE contact_no='$contact_no'";
    $result = mysqli_query($conn, $query) or die(mysqli_error());
    $row = mysqli_fetch_array($result);
    $num_row = mysqli_num_rows($result);

    if ($num_row > 0) {

      $device_name_query = mysqli_query($conn, "SELECT * FROM users WHERE contact_no='$contact_no'") or die(mysqli_error());
      while ($row = mysqli_fetch_array($device_name_query)) {

        $otp = rand(11111, 99999);
        mysqli_query($conn, "update users set otp='$otp' where contact_no='$contact_no'");


        // echo $row['contact_no'];

        echo $_SESSION['contact_no'] = $row['contact_no'];

        $email = $contact_no;
        $subject = "Verification";
        $message = "Reset Password Verification code: {$otp}";

        $mail = new PHPMailer(true);
        try {
          //Server settings
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'replyno486@gmail.com';
          $mail->Password = 'ujxvurcoyslexuup';
          $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
          );
          $mail->SMTPSecure = 'ssl';
          $mail->Port = 465;

          //Send Email
          $mail->setFrom('replyno486@gmail.com');

          //Recipients
          $mail->addAddress($email);
          $mail->addReplyTo('replyno486@gmail.com');

          //Content
          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body    = $message;

          $mail->send();

          $_SESSION['result'] = 'Message has been sent';
          $_SESSION['status'] = 'ok';
        } catch (Exception $e) {
          $_SESSION['result'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
          $_SESSION['status'] = 'error';
        }

  ?>
        <script type='text/javascript'>
          toastr.success('Verification code sent successfully');
          var delay = 1000;
          setTimeout(function() {
            window.location = 'otp.php'
          }, delay);
        </script>
      <?php
      }
    } else {
      ?>
      <script type='text/javascript'>
        toastr.info('Incorrect email..!');
      </script>
  <?php
    }
  }


  if (isset($_POST['secret_key'])) {

    // session_start();
    include('dbcon.php');
    $conn = dbcon();
    $contact_no = $_POST['secret_key'];
    /*................................................ admin .....................................................*/
    $query = "SELECT * FROM users WHERE contact_no='$contact_no'";
    $result = mysqli_query($conn, $query) or die(mysqli_error());
    $row = mysqli_fetch_array($result);
    $num_row = mysqli_num_rows($result);

    if ($num_row > 0) {
  ?>
        <script type='text/javascript'>
          toastr.success('Email Matched');
          var delay = 1000;
          setTimeout(function() {
            window.location = 'secret_key.php'
          }, delay);
        </script>
      <?php
      
    } else {
      ?>
      <script type='text/javascript'>
        toastr.info('Incorrect email..!');
      </script>
  <?php
    }
  }
  ?>

<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="true">Email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="text-tab" data-toggle="tab" href="#text" role="tab" aria-controls="text" aria-selected="false">Secret Key</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
          <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
          <form id="login_form1" action="forgot.php" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="contact_no" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Send OTP</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane fade" id="text" role="tabpanel" aria-labelledby="text-tab">
          <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
          <form id="login_form2" action="forgot.php" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="secret_key" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
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