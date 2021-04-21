<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $level = $this->session->userdata('ses_level'); if($level == 1){$sbg = "Super Admin";}else if($level == 2){$sbg = "Operator";}else if($level == 3){$sbg = "Guru / Staff";}else if($level == 4){$sbg = "Siswa";} ?>
    <title>DASHBOARD <?= strtoupper($sbg);?> || <?= constant("HEADER"); ?></title>
    <link rel="icon" href="<?= base_url('assets/')?>images/gatsa.png" type="image/png">
    <?php $this->load->view('dashboard/kelengkapan/css');?>
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
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <!-- <a href="<?= base_url('dashboard')?>" class="site_title"></a> -->
            </div>

            <div class="clearfix"></div>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <?php $level = $this->session->userdata('ses_level');?>
              <div class="menu_section">
                <br>
                <h3>MENU UTAMA</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('dashboard')?>"><i class="fa fa-home"></i> Dashboard</a></li>
                  <?php if($level == 1 || $level == 2){ ?>  
                    <li><a><i class="fa fa-edit"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <?php if($level == 1){ ?>
                          <li><a href="<?= base_url('v_administrator') ?>">Tabel Administrator</a></li>
                        <?php } ?>
                        <li><a href="<?= base_url('v_guru') ?>">Tabel Guru / Staff</a></li>
                        <li><a href="<?= base_url('v_siswa') ?>">Tabel Siswa</a></li>
                        <li><a href="<?= base_url('v_kelas') ?>">Tabel Kelas</a></li>
                        <li><a href="<?= base_url('v_mapel') ?>">Tabel Mata Pelajaran</a></li>
                        <li><a href="<?= base_url('v_sk_mengajar') ?>">Tabel SK Mengajar</a></li>
                        <li><a href="<?= base_url('v_jadwal') ?>">Tabel Jadwal Ujian</a></li>
                        <li><a href="<?= base_url('v_hasil_ujian') ?>">Tabel Hasil Ujian</a></li>
                        <li><a>Tabel Soal Ujian <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?= base_url('v_soal_pg') ?>">Sub Pilihan Ganda</a></li>
                            <!-- <li class="sub_menu"><a href="<?= base_url('v_soal_essay') ?>">Sub Essay</a></li> -->
                          </ul>
                        </li>
                        <!-- <li><a href="<?= base_url('v_persentase_nilai') ?>">Tabel Persentase Nilai</a></li>
                        <li><a href="<?= base_url('v_qrcode') ?>">Tabel QRCode</a></li>
                        <li><a href="<?= base_url('v_session_akun') ?>">Tabel Session Akun</a ></li>-->
                      </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i> Proses Data <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?= base_url('v_absensi') ?>">Absensi Siswa</a></li>
                        <li><a href="<?= base_url('v_penilaian') ?>">Penilaian Siswa</a></li>
                        <li><a href="<?= base_url('v_raport') ?>">Blanko Raport Siswa</a></li>
                      </ul>
                    </li>
                  <?php }else if($level == 3){ ?>
                    <li><a href="<?= base_url('data_guru')?>"><i class="fa fa-user"></i> Tabel Guru / Staff</a></li>
                    <!-- <li><a href="<?= base_url('data_ujian')?>"><i class="fa fa-list"></i> Data Ujian</a></li> -->
                  <?php }else if($level == 4){ ?>
                    <li><a href="<?= base_url('data_guru')?>"><i class="fa fa-user"></i> Tabel Guru / Staff</a></li>
                  <?php } ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= base_url('logout')?>" class="logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
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
                    <li><a href="<?= base_url('profile')?>"> Profile<?php echo " <b>(".$sbg.")</b>"; ?></a></li>
                    <li><a href="<?= base_url('logout')?>" class="logout"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>

                <!-- <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
              </ul>
            </nav>  
          </div>
        </div>
        <!-- /top navigation -->