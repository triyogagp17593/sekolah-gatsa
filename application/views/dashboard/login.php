<?php date_default_timezone_set("Asia/Jakarta"); $tahun = date("Y"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= constant("HEADER"); ?></title>
    <link rel="icon" href="<?= base_url('assets/')?>images/gatsa.png" type="image/png">
    <!-- Bootstrap -->
    <link href="<?= base_url('assets/')?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/')?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('assets/')?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('assets/')?>vendors/animate.css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/')?>dist/sweetalert2.min.css">
    <!-- PNotify -->
    <link href="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets/')?>build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
      .field-icon {
        float: right;
        margin-right: 10px;
        margin-top: -42px;
        position: relative;
        z-index: 20;
      }
    </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?= form_open('auth'); ?>
              <h1>Login Dashboard</h1>
              <?php if($this->session->flashdata('error')){ ?>
                <div class="flash-data" data-dataflash="<?= $this->session->flashdata('error');?>" data-validasi="error"></div>
              <?php }else if($this->session->flashdata('info')){ ?>
                <div class="flash-data" data-dataflash="<?= $this->session->flashdata('info');?>" data-validasi="info"></div>
              <?php $this->session->sess_destroy(); } ?>
              <div>
                <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="Username or Nomor Induk" required="" autocomplete="off"/>
              </div>
              <div>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Kata Sandi" required="" autocomplete="off"/>
                <span toggle="#inputPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              </div>
              <div style="text-align: left; margin-left: 10px; margin-bottom: 5px;">
                <!-- <input type="checkbox" id="show" name="show" onclick="myFunction()"> Tampilkan kata sandi -->
                <!-- <br> -->
                <a href="<?= base_url('lupapass')?>">Lupa Kata Sandi ?</a>
              </div>
              <div style="margin-left: 80px;">
                <input type="submit" name="submit" id="submit" value="Masuk Panel" class="btn btn-default submit">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <?= constant("SARAN");?>
                <div class="clearfix"></div>
                <br />

                <div>
                  <img src="<?= base_url('assets/')?>images/gatsa.png" width="150px" height="150px">
                  <br><br>
                  <p>©<?= $tahun?> All Rights Reserved. <br> <?= constant("FOOTER"); ?></p>
                </div>
              </div>
            <?= form_close();?>
          </section>
        </div>

        <!-- <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©<?= $tahun?> All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div> -->
      </div>
    </div>
  </body>
  <script src="<?= base_url('assets/')?>jquery-1.11.1.min.js"></script>
  <!-- <script src="<?= base_url('assets/')?>dist/sweetalert2.min.js"></script> -->
  <!-- <script src="<?= base_url('assets/')?>jquery.min.js"></script> -->
  <!-- PNotify -->
  <script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.js"></script>
  <script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.buttons.js"></script>
  <script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.nonblock.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    });

    function myFunction() {
      var x = document.getElementById("inputPassword");
      if (x.type === "password") {
          x.type = "text";
      } else {
          x.type = "password";
      }
    }

    let flashData = $('.flash-data').data('dataflash');
    let validasi = $('.flash-data').data('validasi');
    console.log(flashData);
    console.log(validasi);
    if(flashData){
      new PNotify({
        title: 'Pemberitahuan !!!',
        text: flashData,
        type: validasi,
        delay: 2000,
        styling: 'bootstrap3'
      });
    }
  </script>
</html>
