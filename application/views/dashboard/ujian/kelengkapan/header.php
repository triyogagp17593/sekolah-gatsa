<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UJIAN ONLINE || <?= constant("FOOTER"); ?></title>
    <link rel="icon" href="<?= base_url('assets/')?>images/mtsalhidayah.png" type="image/png">
    <?php $this->load->view('dashboard/kelengkapan/css');?>
    <style type="text/css">
      .kotak{
        width: 100%;
        height: 80px;
        background: #fff;
        border-width: 10px;
        border-color: #000;
        border-bottom: 10px;
        z-index: 1;
        position: fixed;
      }
    </style>
  </head>
  <!-- <body class="nav-md footer_fixed"> -->
  <body class="nav-md">
    <?php if($this->session->flashdata('success')){ ?>
      <div class="flash-data" data-dataflash="<?= $this->session->flashdata('success');?>" data-validasi="success"></div>
    <?php }else if($this->session->flashdata('error')){ ?>
      <div class="flash-data" data-dataflash="<?= $this->session->flashdata('error');?>" data-validasi="error"></div>
    <?php }else if($this->session->flashdata('info')){ ?>
      <div class="flash-data" data-dataflash="<?= $this->session->flashdata('info');?>" data-validasi="info"></div>    
    <?php } ?>
    <div class="container body">
      <div class="kotak">
        <div style="margin-top: 20px;" id="timer"></div>
      </div>
      <div class="main_container">
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php if(!empty($this->session->userdata('ses_foto'))){ ?><img src="<?= base_url('assets/images/gambar_user/').$this->session->userdata('ses_foto')?>" alt=""><?php }else{ ?><img src="<?= base_url('assets/images/user.png')?>" alt=""><?php } ?><?= $this->session->userdata('ses_name');?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?= base_url('logout')?>" class="logout"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>
              </ul>
            </nav>  
          </div>
        </div>
        <!-- /top navigation -->