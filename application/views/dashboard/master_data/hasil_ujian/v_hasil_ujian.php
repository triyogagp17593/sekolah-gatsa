<div class="right_col" role="main">
  <div style="float: right;"><h2><?php $this->load->view('dashboard/kelengkapan/jam_aktif');?></h2></div>
  <!-- <div class="clearfix"></div> -->
  <form action="<?= base_url('delete_hasil_ujian_all')?>" method="post">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Kelas<small><b>(tambah, ubah, hapus)</b></small></h2>
            <!-- <ul class="nav navbar-right panel_toolbox">
              <li class="dropdown navbar-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="menu"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a data-toggle="modal" data-target="#modal_add_kelas"><span class="fa fa-plus"></span>&nbsp;Tambah Data</a></li>
                </ul>
              </li>
            </ul> -->
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatableALL" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th width="3%"><input type="checkbox" id="cek" onClick="toggle(this)"/></th>
                  <th width="3%">No</th>
                  <th>Nama Siswa</th>
                  <th>Nama Kelas</th>
                  <th>Nama Guru</th>
                  <th>Mata Pelajaran</th>
                  <th>Nilai</th>
                  <!-- <th width="6%">Status</th> -->
                  <th width="10%">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                  foreach ($data_hasil_ujian as $hasil) {
                ?>
                  <tr>
                    <td width="3%" align="center"><input type="checkbox" id="pilih[]" name="pilih[]" value="<?= $hasil->id_hasil;?>"></td>
                    <td width="3%" align="center"><?= $no++;?></td>
                    <td><?= $hasil->nama_siswa;?></td>
                    <td><?= $hasil->romawi_kelas."-".$hasil->angka_kelas;?></td>
                    <td><?= $hasil->nama_guru;?></td>
                    <td><?= $hasil->nama_mapel;?></td>
                    <td><?= $hasil->nilai;?></td>
                    <!-- <td width="10%" align="center">
                      <div class="onoffswitchKelas">
                        <input type="hidden" value="<?= $hasil->id_hasil?>"/>
                        <input type="checkbox" class="js-switch" <?php if($hasil->aktif_state == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                      </div>
                    </td> -->
                    <td width="15%" align="center">
                      <a href="<?= base_url('detail_hasil_ujian/').$hasil->id_hasil;?>" id="detail_hasil_ujian" data-toggle="modal" data-target="#modal_detail_hasil_ujian" class="btn btn-info btn-xs" title="detail"><span class="fa fa-search"></span></a>
                      <a href="<?= base_url('delete_hasil_ujian/').$hasil->id_hasil;?>" id="hapus" class="btn btn-danger btn-xs" title="hapus"><span class="fa fa-trash"></span></a>
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
<div class="modal fade" id="modal_detail_hasil_ujian" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true"></div>