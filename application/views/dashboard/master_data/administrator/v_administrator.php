<!-- <style type="text/css">
  .field-icon {
    float: right;
    margin-right: 10px;
    margin-top: -23px;
    position: relative;
    z-index: 20;
  }
</style> -->
<div class="right_col" role="main">
  <div style="float: right;"><h2><?php $this->load->view('dashboard/kelengkapan/jam_aktif');?></h2></div>
  <!-- <div class="clearfix"></div> -->
  <form action="<?= base_url('delete_administrator_all')?>" method="post">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Administrator<small><b>(tambah, ubah, hapus)</b></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="dropdown navbar-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="menu"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a data-toggle="modal" data-target="#modal_add_admin"><span class="fa fa-plus"></span>&nbsp;Tambah Data</a></li>
                  <li><a href="#"><span class="fa fa-print"></span>&nbsp;Cetak Data</a></li>
                </ul>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatableALL" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th><input type="checkbox" id="cek" onClick="toggle(this)"/></th>
                  <th>No</th>
                  <th>Nama Administrator</th>
                  <th>Username</th>
                  <th>RoleID</th>
                  <th>Status</th>
                  <th><a href="<?= base_url();?>">Opsi</a></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                  foreach ($data_pengguna->result() as $hasil) {
                ?>
                  <tr>
                    <td width="3%" align="center"><input type="checkbox" id="pilih[]" name="pilih[]" value="<?= $hasil->id_login;?>"></td>
                    <td width="3%" align="center"><?= $no++;?></td>
                    <td><?= $hasil->nama;?></td>
                    <td><?= $hasil->username;?></td>
                    <td width="10%" align="center">
                      <div class="onoffswitchRole">
                        <input type="hidden" value="<?= $hasil->id_login?>"/>
                        <?php if($this->session->userdata('ses_idlogin') != $hasil->id_login){ ?>
                          <input type="checkbox" class="js-switch" <?php if($hasil->roleID == 1){echo"checked";}elseif($hasil->roleID == 2){echo"unchecked";}?>/>&nbsp;
                        <?php }else{ ?>
                          <input type="checkbox" class="js-switch" <?php if($hasil->roleID == 1){echo"checked";}elseif($hasil->roleID == 2){echo"unchecked";}?> disabled/>&nbsp;
                        <?php } ?>
                      </div>
                    </td>
                    <td width="10%" align="center">
                      <div class="onoffswitchKondisi">
                        <input type="hidden" value="<?= $hasil->id_login?>"/>
                        <?php if($this->session->userdata('ses_idlogin') != $hasil->id_login){ ?>
                          <input type="checkbox" class="js-switch" <?php if($hasil->aktif_state == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                        <?php }else{ ?>
                          <input type="checkbox" class="js-switch" <?php if($hasil->aktif_state == 1){echo"checked";}else{echo"unchecked";}?> disabled/>&nbsp;
                        <?php } ?>
                      </div>
                    </td>
                    <td width="15%" align="center">
                      <?php if($this->session->userdata('ses_idlogin') != $hasil->id_login){ ?>
                        <a href="<?= base_url('edit_administrator/').$hasil->id_login;?>" id="ubah_admin" data-toggle="modal" data-target="#modal_edit_admin" class="btn btn-success btn-xs" title="ubah"><span class="fa fa-pencil"></span></a>
                        <a href="<?= base_url('delete_administrator/').$hasil->id_login;?>" id="hapus" class="btn btn-danger btn-xs" title="hapus"><span class="fa fa-trash"></span></a>
                      <?php }else{ ?>
                        <a href="#" class="btn btn-success btn-xs" title="ubah" disabled><span class="fa fa-pencil"></span></a>
                        <a href="#" class="btn btn-danger btn-xs" title="hapus" disabled><span class="fa fa-trash"></span></a>
                      <?php } ?>
                      <a href="<?= base_url('detail_administrator/').$hasil->id_login;?>" id="detail_admin" data-toggle="modal" data-target="#modal_detail_admin" class="btn btn-info btn-xs" title="detail"><span class="fa fa-search"></span></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php if($data_pengguna->num_rows() > 1){ ?>
              <button class="btn btn-success btn-xs"><span class="fa fa-trash"></span>&nbsp;Hapus Data Pilihan</button>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </form>
</div> 
<div class="modal fade" id="modal_add_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog" style="width: 1000px;">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title" id="myModalLabel">TAMBAH DATA ADMINISTRATOR</h4>
      </div>
      <form action="<?= base_url('save_administrator');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
        <div class="modal-body">
          <?php $this->load->view('dashboard/master_data/administrator/add_administrator');?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_edit_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal2" aria-hidden="true"></div>

<div class="modal fade" id="modal_detail_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal3" aria-hidden="true"></div>