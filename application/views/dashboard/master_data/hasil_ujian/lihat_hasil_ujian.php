<div class="right_col" role="main">
  <div style="float: right;"><h2><?php $this->load->view('dashboard/kelengkapan/jam_aktif');?></h2></div>
  <!-- <div class="clearfix"></div> -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Data Hasil Ujian<small><b>(hapus)</b></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a href="<?= base_url('dashboard')?>" title="Kembali"><span class="fa fa-reply"></span>&nbsp;Kembali</a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php 
            $view_guru = $this->main_model->ubahordetail_pengguna($data_mengajar[0]['loginID'])->result_array(); 
            $view_kelas = $this->main_model->ubah_kelas($data_mengajar[0]['kelasID'])->result_array(); 
            $view_mapel = $this->main_model->ubah_mapel($data_mengajar[0]['mapelID'])->result_array(); 
            
            $kelas = $view_kelas[0]['romawi_kelas']."-".$view_kelas[0]['angka_kelas'];
          ?>
          <table width="600px">
            <tr>
              <td><b>Mata Pelajaran</b></td>
              <td>: <?= $view_mapel[0]['nama_mapel'];?></td>
            </tr>
            <tr>
              <td><b>Kelas</b></td>
              <td>: <?= $kelas;?></td>
            </tr>
            <tr>
              <td><b>Guru</b></td>
              <td>: <?= $view_guru[0]['nama'];?></td>
            </tr>
          </table><br>
          <table id="datatableALL" class="table table-striped table-bordered bulk_action">
            <thead>
              <tr>
                <th width="3%">No</th>
                <th width="20%">Nama Nomor Induk Siswa</th>
                <th>Nama Siswa</th>
                <th width="15%">Nilai</th>
                <!-- <th width="6%">Status</th> -->
                <th width="10%">Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                $lihat_hasil_ujian = $this->main_model->get_all_kelas_siswaBy2($data_mengajar[0]['kelasID'])->result(); 
                foreach ($lihat_hasil_ujian as $hasil) {
                  $view_mengajar = $this->main_model->get_all_sk_mengajarBy3($data_mengajar[0]['mapelID'])->result_array(); 
                  $view_siswa = $this->main_model->ubahordetail_pengguna($hasil->id_login)->result_array(); 
                  $view_nilai = $this->main_model->get_all_hasil_ujianBy2($view_mengajar[0]['id_mapel'],$view_mengajar[0]['id_kelas'],$hasil->id_login)->result_array(); 
                  $jml_view_nilai = $this->main_model->get_all_hasil_ujianBy2($view_mengajar[0]['id_mapel'],$view_mengajar[0]['id_kelas'],$hasil->id_login)->num_rows(); 
              ?>
                <tr>
                  <td width="3%" align="center"><?= $no++;?></td>
                  <td><?= $view_siswa[0]['nomor_induk'];?></td>
                  <td><?= $view_siswa[0]['nama'];?></td>
                  <td><?php if(empty($view_nilai[0]['nilai'])){echo "<b>belum ada nilai</b>";}else{echo $view_nilai[0]['nilai'];}?></td>
                  <!-- <td width="10%" align="center">
                    <div class="onoffswitchKelas">
                      <input type="hidden" value="<?= $hasil->id_hasil?>"/>
                      <input type="checkbox" class="js-switch" <?php if($hasil->aktif_state == 1){echo"checked";}else{echo"unchecked";}?>/>&nbsp;
                    </div>
                  </td> -->
                  <td width="15%" align="center">
                    <?php if(!empty($view_nilai[0]['nilai'])){?>
                      <a href="<?=base_url('lihat_nilai/').$view_nilai[0]['id_hasil'].'/'.$view_mengajar[0]['id_kelas'].'/'.$view_mengajar[0]['id_login'].'/'.$view_siswa[0]['id_login'];?>" id="detail_hasil_ujian" data-toggle="modal" data-target="#modal_detail_hasil_ujian" class="btn btn-info btn-xs" title="detail"><span class="fa fa-search"></span></a>
                      <a href="<?=base_url('delete_hasil_ujian/').$view_nilai[0]['id_hasil'];?>" id="hapus" class="btn btn-danger btn-xs" title="hapus"><span class="fa fa-trash"></span></a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> 
<div class="modal fade" id="modal_detail_hasil_ujian" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true"></div>