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
  <form action="<?= base_url('delete_soal_pg_all')?>" method="post">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Soal Ujian Pilihan Ganda<small><b>(tambah, ubah, hapus)</b></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="dropdown navbar-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="menu"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?= base_url('add_soal_pg');?>"><span class="fa fa-plus"></span>&nbsp;Tambah Data</a></li>
                </ul>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatableALL" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th width="3%"><input type="checkbox" id="cek" onClick="toggle(this)"/></th>
                  <th width="3%">No</th>
                  <th>Guru</th>
                  <th>Mata Pelajaran</th>
                  <th>Kelas</th>
                  <th>Kode Soal</th>
                  <th width="6%">Status</th>
                  <th width="10%">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                  foreach ($data_soal_pg as $hasil) {
                ?>
                  <tr>
                    <td width="3%" align="center"><input type="checkbox" id="pilih[]" name="pilih[]" value="<?= $hasil->id_soal;?>"></td>
                    <td width="3%" align="center"><?= $no++;?></td>
                    <td><?= $hasil->nama;?></td>
                    <td><?= $hasil->nama_mapel;?></td>
                    <td><?= $hasil->romawi_kelas."-".$hasil->angka_kelas;?></td>
                    <td><?= $hasil->kode_soal;?></td>
                    <td width="10%" align="center">
                      <div class="onoffswitchSoalPG">
                        <input type="hidden" value="<?= $hasil->id_soal?>"/>
                        <input type="checkbox" class="js-switch" <?php if($hasil->aktif_state == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                      </div>
                    </td>
                    <td width="15%" align="center">
                      <a href="<?= base_url('edit_soal_pg/').$hasil->id_soal;?>" class="btn btn-success btn-xs" title="ubah"><span class="fa fa-pencil"></span></a>
                      <a href="<?= base_url('delete_soal_pg/').$hasil->id_soal;?>" id="hapus" class="btn btn-danger btn-xs" title="hapus"><span class="fa fa-trash"></span></a>
                      <a href="<?= base_url('detail_soal_pg/').$hasil->id_soal;?>" id="detail_soalPG" data-toggle="modal" data-target="#modal_detail_soalPG" class="btn btn-info btn-xs" title="detail"><span class="fa fa-search"></span></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <button class="btn btn-success btn-xs"><span class="fa fa-trash"></span>&nbsp;Hapus Data Pilihan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div> 
<div class="modal fade" id="modal_detail_soalPG" tabindex="-1" role="dialog" aria-labelledby="largeModal1" aria-hidden="true"></div>