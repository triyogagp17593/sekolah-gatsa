<div class="right_col" role="main">
  <div style="float: right;"><h2><?php $this->load->view('dashboard/kelengkapan/jam_aktif');?></h2></div>
  <!-- <div class="clearfix"></div> -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>UBAH SOAL UJIAN PILIHAN GANDA</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li class="dropdown navbar-right">
              <a href="<?= base_url('v_soal_pg');?>" title="kembali"><span class="fa fa-reply"></span></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="<?= base_url('update_soal_pg');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <input type="hidden" id="soal_id" name="soal_id" value="<?= $data_soal_pg[0]['id_soal'];?>">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-12 col-xs-12" for="inputGuru">Nama Guru <span class="required">*</span></label>
              <div class="col-md-9 col-sm-12 col-xs-12">
                <select name="inputGuru" id="inputGuru" class="form-control col-md-7 col-xs-12" required>
                  <option value="" selected disabled>--- Pilih Guru ---</option>
                  <?php 
                    $data_pengguna = $this->db->query("SELECT * FROM view_guru")->result();
                    foreach ($data_pengguna as $hasil) { 
                  ?>
                    <?php if($data_soal_pg[0]['loginID'] != $hasil->id_login){ ?>
                      <option value="<?= $hasil->id_login?>"><?= $hasil->nama?></option>
                    <?php }else{ ?>
                      <?php $data_pengguna_pilih = $this->db->query("SELECT * FROM view_guru WHERE loginID='".$data_soal_pg[0]['loginID']."'")->result_array(); ?>
                      <option value="<?= $data_pengguna_pilih[0]['id_login']?>" selected><?= $data_pengguna_pilih[0]['nama']?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
                
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-12 col-xs-12" for="inputMapelKelas">Mata Pelajaran Dan Kelas <span class="required">*</span></label>
              <div class="col-md-9 col-sm-12 col-xs-12">
                <select name="inputMapelKelas" id="inputMapelKelas" class="form-control col-md-7 col-xs-12" required>
                  <option value="pilih" disabled>--- Mata Pelajaran Dan Kelas ---</option>
                  <option value="<?= $data_soal_pg[0]['mengajarID'];?>" selected><?= $data_soal_pg[0]['nama_mapel']." (".$data_soal_pg[0]['romawi_kelas']."-".$data_soal_pg[0]['angka_kelas'].")";?></option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKodesoal">Kode Soal <span class="required">*</span></label>
              <div class="col-md-9 col-sm-6 col-xs-12" id="kode">
                <input id="inputKodesoal" class="form-control col-md-7 col-xs-12" name="inputKodesoal" value="<?= $data_soal_pg[0]['kode_soal'];?>" placeholder="input Kode Soal" type="text" readonly>
              </div>
            </div>
            
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-2" for="inputPertanyaan" style="margin-left: -70px;">Pertanyaan <span class="required">*</span></label>
              <div class="col-md-12 col-sm-6 col-xs-12">  
                <textarea id="inputPertanyaan" name="inputPertanyaan" class="form-control col-md-7 col-xs-12"><?= $data_soal_pg[0]['pertanyaan'];?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-2" for="inputOpsi1" style="margin-left: -30px;">Pilihan Jawaban 1 <span class="required">*</span></label>
              <div class="col-md-12 col-sm-6 col-xs-12">  
                <textarea id="inputOpsi1" name="inputOpsi1" class="form-control col-md-7 col-xs-12"><?= $data_soal_pg[0]['pilihanA'];?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-2" for="inputOpsi2" style="margin-left: -30px;">Pilihan Jawaban 2 <span class="required">*</span></label>
              <div class="col-md-12 col-sm-6 col-xs-12">  
                <textarea id="inputOpsi2" name="inputOpsi2" class="form-control col-md-7 col-xs-12"><?= $data_soal_pg[0]['pilihanB'];?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-2" for="inputOpsi3" style="margin-left: -30px;">Pilihan Jawaban 3 <span class="required">*</span></label>
              <div class="col-md-12 col-sm-6 col-xs-12">  
                <textarea id="inputOpsi3" name="inputOpsi3" class="form-control col-md-7 col-xs-12"><?= $data_soal_pg[0]['pilihanC'];?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputOpsi4" style="margin-left: -30px;">Pilihan Jawaban 4 <span class="required">*</span></label>
              <div class="col-md-12 col-sm-6 col-xs-12">  
                <textarea id="inputOpsi4" name="inputOpsi4" class="form-control col-md-7 col-xs-12"><?= $data_soal_pg[0]['pilihanD'];?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-6 col-xs-12" for="inputJawaban">Kunci Jawaban <span class="required">*</span></label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <select name="inputJawaban" id="inputJawaban" class="form-control col-md-7 col-xs-12" required>
                  <option value="" selected disabled>--- Pilih Jawaban ---</option>
                  <?php 
                    if($data_soal_pg[0]['kunci_jawaban'] == "A"){$pilihan1="selected";}else{$pilihan1="";}
                    if($data_soal_pg[0]['kunci_jawaban'] == "B"){$pilihan2="selected";}else{$pilihan2="";}
                    if($data_soal_pg[0]['kunci_jawaban'] == "C"){$pilihan3="selected";}else{$pilihan3="";}
                    if($data_soal_pg[0]['kunci_jawaban'] == "D"){$pilihan4="selected";}else{$pilihan4="";}
                  ?>
                  <option value="A" <?= $pilihan1?>>A</option>
                  <option value="B" <?= $pilihan2?>>B</option>
                  <option value="C" <?= $pilihan3?>>C</option>
                  <option value="D" <?= $pilihan4?>>D</option>
                </select>
              </div>
            </div>
            <b>* Required (Harus di isi)</b>
            <div class="item form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">  
                <button class="btn btn-primary">Ubah</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>