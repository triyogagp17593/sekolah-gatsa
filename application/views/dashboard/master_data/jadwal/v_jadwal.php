<div class="right_col" role="main">
  <div style="float: right;"><h2><?php $this->load->view('dashboard/kelengkapan/jam_aktif');?></h2></div>
  <!-- <div class="clearfix"></div> -->
  <form action="<?= base_url('delete_jadwal_all')?>" method="post">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Jadwal Ujian<small><b>(tambah, ubah, hapus)</b></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="dropdown navbar-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="menu"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a data-toggle="modal" data-target="#modal_add_jadwal"><span class="fa fa-plus"></span>&nbsp;Tambah Data</a></li>
                  <!-- <li><a data-toggle="modal" data-target="#modal_import_jadwal"><span class="fa fa-upload"></span>&nbsp;Import Data</a></li> -->
                  <!-- <li><a href="#"><span class="fa fa-print"></span>&nbsp;Cetak Data</a></li> -->
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
                  <th>Mata Pelajaran</th>
                  <th>Hari/Tanggal</th>
                  <th>Waktu</th>
                  <th>Jam-ke</th>
                  <th>Status_Ujian</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                  foreach ($data_jadwal as $hasil) {
                ?>
                  <tr <?php if($hasil->kondisi_aktif == 0){echo"style=background-color:#FF0;color:#000;";}?>>
                    <td width="3%" align="center"><input type="checkbox" id="pilih[]" name="pilih[]" value="<?= $hasil->id_jadwal;?>"></td>
                    <td width="3%" align="center"><?= $no++;?></td>
                    <td><?= $hasil->nama_mapel;?></td>
                    <td><?= $hasil->hari.", ".date('d M Y',strtotime($hasil->waktu_mulai));?></td>
                    <td align="center"><?= date('H:i',strtotime($hasil->waktu_mulai))." s/d ".date('H:i',strtotime($hasil->waktu_selesai))." <br><b>(".$hasil->waktu." menit)</b>";?></td>
                    <td align="center"><?= $hasil->jam_ke;?></td>
                    <td width="10%" align="center">
                      <?php if($hasil->kondisi_aktif != 0){?>
                        <div class="onoffswitchKondisiUjian">
                          <input type="hidden" value="<?= $hasil->id_jadwal?>"/>
                          <input type="checkbox" class="js-switch" <?php if($hasil->kondisi_ujian == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                        </div>
                        <div><?php if($hasil->kondisi_ujian == 1){echo"dibuka";}else{echo"ditutup";}?></div>
                      <?php } ?>
                    </td>
                    <td width="10%" align="center">
                      <?php if($hasil->kondisi_aktif != 0){?>
                        <div class="onoffswitchKondisiJadwal">
                          <input type="hidden" value="<?= $hasil->id_jadwal?>"/>
                          <input type="checkbox" class="js-switch" <?php if($hasil->aktif_state == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                        </div>
                        <div><?php if($hasil->aktif_state == 1){echo"aktif";}else{echo"nonaktif";}?></div>
                      <?php } ?>
                    </td>
                    <td width="15%" align="center">
                      <?php if($hasil->kondisi_aktif != 0){?>
                        <a href="<?= base_url('edit_jadwal/').$hasil->id_jadwal;?>" id="ubah_jadwal" data-toggle="modal" data-target="#modal_edit_jadwal" class="btn btn-success btn-xs" title="ubah"><span class="fa fa-pencil"></span></a>
                        <a href="<?= base_url('delete_jadwal/').$hasil->id_jadwal;?>" id="hapus" class="btn btn-danger btn-xs" title="hapus"><span class="fa fa-trash"></span></a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <b>info: yang berwarna kuning mata pelajaran tidak ada atau tidak aktif</b><br>
            <button class="btn btn-success btn-xs"><span class="fa fa-trash"></span>&nbsp;Hapus Data Pilihan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div> 
<div class="modal fade" id="modal_add_jadwal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title" id="myModalLabel">TAMBAH DATA JADWAL UJIAN</h4>
      </div>
      <form action="<?= base_url('save_jadwal');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
        <div class="modal-body">
          <?php $this->load->view('dashboard/master_data/jadwal/add_jadwal');?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_import_jadwal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title" id="myModalLabel">IMPORT DATA GURU</h4>
      </div>
      <form action="<?= base_url('import_guru');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
        <div class="modal-body">
          <?php $this->load->view('dashboard/master_data/guru/import_guru');?>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-primary">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_edit_jadwal" tabindex="-1" role="dialog" aria-labelledby="largeModal2" aria-hidden="true"></div>