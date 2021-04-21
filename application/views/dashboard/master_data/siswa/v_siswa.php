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
  <form action="<?= base_url('delete_siswa_all')?>" method="post">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Siswa<small><b>(tambah, ubah, hapus)</b></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="dropdown navbar-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="menu"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a data-toggle="modal" data-target="#modal_add_admin"><span class="fa fa-plus"></span>&nbsp;Tambah Data</a></li>
                  <li><a data-toggle="modal" data-target="#modal_import_admin"><span class="fa fa-upload"></span>&nbsp;Import Data</a></li>
                  <li><a data-toggle="modal" data-target="#modal_cetak_admin"><span class="fa fa-print"></span>&nbsp;Cetak Data</a></li>
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
                  <th>NISN</th>
                  <th>Nama Siswa</th>
                  <th>Username</th>
                  <th>Kelas</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                  foreach ($data_pengguna->result() as $hasil) {
                    $kelas = $this->main_model->get_all_kelas_siswaBy($hasil->id_login)->result_array();
                ?>
                  <tr>
                    <td width="3%" align="center"><input type="checkbox" id="pilih[]" name="pilih[]" value="<?= $hasil->id_login;?>"></td>
                    <td width="3%" align="center"><?= $no++;?></td>
                    <td><?= $hasil->nomor_induk;?></td>
                    <td><?= $hasil->nama;?></td>
                    <td><?= $hasil->username;?></td>
                    <td><?php if(empty($kelas[0]['id_login'])){$kondisi=1;echo"<b title='Silahkan ambil kelas dahulu !!!'>Belum ambil kelas</b>";}else{$kondisi=2;echo $kelas[0]['romawi_kelas']."-".$kelas[0]['angka_kelas'];}?></td>
                    <td width="10%" align="center">
                      <div class="onoffswitchKondisi">
                        <input type="hidden" value="<?= $hasil->id_login?>"/>
                        <input type="checkbox" class="js-switch" <?php if($hasil->aktif_state == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                      </div>
                    </td>
                    <td width="15%" align="center">
                      <a href="<?= base_url('edit_siswa/').$hasil->id_login;?>" id="ubah_admin" data-toggle="modal" data-target="#modal_edit_admin" class="btn btn-success btn-xs" title="ubah"><span class="fa fa-pencil"></span></a>
                      <a href="<?= base_url('delete_siswa/').$hasil->id_login;?>" id="hapus" class="btn btn-danger btn-xs" title="hapus"><span class="fa fa-trash"></span></a>
                      <a href="<?= base_url('detail_siswa/').$hasil->id_login;?>" id="detail_admin" data-toggle="modal" data-target="#modal_detail_admin" class="btn btn-info btn-xs" title="detail"><span class="fa fa-search"></span></a>
                      <a href="<?= base_url('ambil_kelas_siswa/').$hasil->id_login;?>" id="ambil_kelas" data-toggle="modal" data-target="#modal_edit_ambil_kelas" class="btn btn-warning btn-xs" title="ambil kelas"><span class="fa fa-check"></span></a>
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
          <h4 class="modal-title" id="myModalLabel">TAMBAH DATA SISWA</h4>
      </div>
      <form action="<?= base_url('save_siswa');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
        <div class="modal-body">
          <?php $this->load->view('dashboard/master_data/siswa/add_siswa');?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_import_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title" id="myModalLabel">IMPORT DATA SISWA</h4>
      </div>
      <form action="<?= base_url('import_siswa');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
        <div class="modal-body">
          <?php $this->load->view('dashboard/master_data/siswa/import_siswa');?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-primary">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_cetak_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title" id="myModalLabel">CETAK DATA SISWA</h4>
      </div>
      <form action="<?= base_url('import_siswa');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
        <div class="modal-body">
          <?php $this->load->view('dashboard/master_data/siswa/cetak_siswa');?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-primary">Cetak</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_edit_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal2" aria-hidden="true"></div>

<div class="modal fade" id="modal_detail_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal3" aria-hidden="true"></div>

<div class="modal fade" id="modal_edit_ambil_kelas" tabindex="-1" role="dialog" aria-labelledby="largeModal4" aria-hidden="true"></div>