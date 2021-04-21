<style type="text/css">
  .field-icon {
    float: right;
    margin-right: 10px;
    margin-top: -22px;
    position: relative;
    z-index: 20;
  }

  .muncul {
    background: #000;
    color: #FFF;
    border-radius: 2px #000;
    margin-right: 10px;
    margin-top: -22px;
    padding: 5px;
    position: fixed;
    font-size: 11px;
    font-weight: bold;
    display: none;
    z-index: 100;
  }
</style>
<h4>Biodata Siswa</h4>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNoinduk">NIS <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input id="inputNoinduk" class="form-control col-md-7 col-xs-12" name="inputNoinduk" placeholder="input Nomor Induk Siswa *" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNisn">NISN <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNisn" class="form-control col-md-7 col-xs-12" name="inputNisn" placeholder="input Nomor Induk Siswa Nasional *" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNama">Nama <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama" placeholder="input Nama Lengkap *" required="required" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputEmail">Email <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <input id="inputEmail" class="form-control col-md-7 col-xs-12" name="inputEmail" placeholder="input Email" type="email" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputUsername">Username <span class="required">*</span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <input id="inputUsername" class="form-control col-md-7 col-xs-12" name="inputUsername" placeholder="input Username *" required="required" type="text" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputPassword">Kata Sandi <span class="required">*</span></label> -->
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input id="inputPasswordAdd" class="form-control col-md-7 col-xs-12 inputPassword" name="inputPassword" placeholder="input Kata Sandi *" required="required" type="password" onkeyup="passwordStrength(this.value)" autocomplete="off">
    <p class="muncul">NOTE: Kata Sandi minimal 6 karakter, Kombinasi Lowercase, Uppercase, number</p>
    <span toggle="#inputPasswordAdd" class="fa fa-fw fa-eye field-icon toggle-password-admin"></span>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div style="margin-top: 10px; font-weight: bold; text-align: center;" id="statusAdd"><div style="font-size: 11px;">#Status Kekuatan Password#</div></div>
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis Kelamin</label>
  <div class="col-md-3 col-sm-0 col-xs-6">
    <div class="radio">
      <label><input type="radio" name="jk" class="flat" value="1" checked> Laki-Laki</label>
      <label><input type="radio" name="jk" class="flat" value="0"> Perempuan</label>
    </div>
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputTempat">Tempat, Tgl Lahir</label> -->
  <div class="col-md-4 col-sm-3 col-xs-12">
    <input id="inputTempat" class="form-control col-md-7 col-xs-12" name="inputTempat" placeholder="input Tempat Lahir" type="text" autocomplete="off">
  </div>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input id="inputTgl" class="form-control col-md-7 col-xs-12 inputTgl" name="inputTgl" placeholder="input Tanggal Lahir" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputAnakKe">Anak Ke <span class="required">*</span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <input id="inputAnakKe" class="form-control col-md-7 col-xs-12" name="inputAnakKe" placeholder="input Anak Ke" type="text" maxLength="2" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputJmlSaudara">Jumlah Saudara <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <input id="inputJmlSaudara" class="form-control col-md-7 col-xs-12" name="inputJmlSaudara" placeholder="input Jumlah Saudara" type="text" maxLength="2" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputHobi">Hobi <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputHobi" id="inputHobi" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Hobi ---</option>
      <?php 
        $data_hobi = $this->main_model->get_all_TabelPendukung("5","0","")->result();
        foreach ($data_hobi as $hasil) { 
      ?>
        <option value="<?= $hasil->id_hobi?>"><?= $hasil->nama_hobi?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputCitaCita">Cita - Cita <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputCitaCita" id="inputCitaCita" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Cita - Cita ---</option>
      <?php 
        $data_citacita = $this->main_model->get_all_TabelPendukung("4","0","")->result();
        foreach ($data_citacita as $hasil) { 
      ?>
        <option value="<?= $hasil->id_citacita?>"><?= $hasil->nama_citacita?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputTelepon">Telepon <span class="required">*</span></label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="inputTelepon" class="form-control col-md-7 col-xs-12" name="inputTelepon" placeholder="input Telepon" type="text" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="file">Foto</label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="foto" name="foto" placeholder="input Foto" class="form-control col-md-7 col-xs-12" type="file">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputAlamat">Alamat</span></label> -->
  <div class="col-md-12 col-sm-6 col-xs-12">
    <textarea id="inputAlamat" name="inputAlamat" class="form-control col-md-7 col-xs-12" placeholder="input Alamat Siswa"></textarea>
  </div>
</div>
<hr style="border: dashed 2px #000;">
<h4>Data Asal Sekolah Siswa</h4>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNoUN">Nomor Peserta UN <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input id="inputNoUN" class="form-control col-md-7 col-xs-12" name="inputNoUN" placeholder="input Nomor Peserta UN *" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNoSKHUN">Nomor SKHUN <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNoSKHUN" class="form-control col-md-7 col-xs-12" name="inputNoSKHUN" placeholder="input Nomor SKHUN *" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNoIjazah">Nomor Ijazah <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNoIjazah" class="form-control col-md-7 col-xs-12" name="inputNoIjazah" placeholder="input Nomor Ijazah *" required="required" maxLength="25" onkeyup="validAngkatelp(this)" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNamaSekolah">Nama Sekolah <span class="required">*</span></label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">  
    <input id="inputNamaSekolah" class="form-control col-md-7 col-xs-12" name="inputNamaSekolah" placeholder="input Nama Sekolah *" type="text" required="required" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNPSN">NPSN <span class="required">*</span></label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">  
    <input id="inputNPSN" class="form-control col-md-7 col-xs-12" name="inputNPSN" placeholder="input NPSN *" required="required" maxLength="25" onkeyup="validAngkatelp(this)" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputJenjangSekolah">Jenjang Sekolah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputJenjangSekolah" id="inputJenjangSekolah" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Jenjang Sekolah ---</option>
      <?php 
        $data_jenjang = $this->main_model->get_all_TabelPendukung("6","0","")->result();
        foreach ($data_jenjang as $hasil) { 
      ?>
        <option value="<?= $hasil->id_jenjang?>"><?= $hasil->nama_jenjang?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusSekolah">Status Sekolah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputStatusSekolah" id="inputStatusSekolah" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Status Sekolah ---</option>
      <option value="1">Negeri</option>
      <option value="2">Swasta</option>
    </select>
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputLokasiSekolah">Lokasi Sekolah <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputLokasiSekolah" id="inputLokasiSekolah" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Lokasi Sekolah Kab/Kota ---</option>
      <?php 
        $data_kabkot = $this->main_model->get_all_kabkotkecdeskel("32")->result();
        foreach ($data_kabkot as $hasil) { 
      ?>
        <option value="<?= $hasil->kode?>"><?= $hasil->nama?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
<!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputNilaiUN">Nilai UN</label> -->
  <div class="col-md-6 col-sm-3 col-xs-12">
    <input id="inputNilaiUN" class="form-control col-md-7 col-xs-12" name="inputNilaiUN" placeholder="input Nilai UN *" type="text" maxLength="3" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <div class="col-md-6 col-sm-3 col-xs-12">
    <input id="inputTglLulus" class="form-control col-md-7 col-xs-12 inputTglLulus" name="inputTglLulus" placeholder="input Tanggal Lulus *" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputAlamatSekolah">Alamat Sekolah</span></label> -->
  <div class="col-md-12 col-sm-6 col-xs-12">
    <textarea id="inputAlamatSekolah" name="inputAlamatSekolah" class="form-control col-md-7 col-xs-12" placeholder="input Alamat Sekolah"></textarea>
  </div>
</div>
<hr style="border: dashed 2px #000;">
<h4>Data Orang Tua / Wali Siswa</h4>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNamaKK">Nama Kepala Keluaraga <span class="required">*</span></label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">  
    <input id="inputNamaKK" class="form-control col-md-7 col-xs-12" name="inputNamaKK" placeholder="input Nama Kepala Keluaraga *" type="text" required="required" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNoKK">No Kartu Keluarga <span class="required">*</span></label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">  
    <input id="inputNoKK" class="form-control col-md-7 col-xs-12" name="inputNoKK" placeholder="input No Kartu Keluarga *" required="required" maxLength="25" onkeyup="validAngkatelp(this)" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12">Data <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="checkbox" name="dataAyah" id="dataAyah" value="Ayah"> Data Ayah
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="checkbox" name="dataIbu" id="dataIbu" value="Ibu"> Data Ibu
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input type="checkbox" name="dataWali" id="dataWali" value="Wali"> Data Wali 
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNIKAyah">NIK Ayah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNIKAyah" class="form-control col-md-7 col-xs-12" name="inputNIKAyah" placeholder="input NIK Ayah" type="text" maxLength="25" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNIKIbu">NIK Ibu <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNIKIbu" class="form-control col-md-7 col-xs-12" name="inputNIKIbu" placeholder="input NIK Ibu" type="text" maxLength="25" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNIKWali">NIK Wali <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNIKWali" class="form-control col-md-7 col-xs-12" name="inputNIKWali" placeholder="input NIK Wali" type="text" maxLength="25" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNamaAyah">Nama Ayah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNamaAyah" class="form-control col-md-7 col-xs-12" name="inputNamaAyah" placeholder="input Nama Ayah" type="text" autocomplete="off" disabled>
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNamaIbu">Nama Ibu <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNamaIbu" class="form-control col-md-7 col-xs-12" name="inputNamaIbu" placeholder="input Nama Ibu" type="text" autocomplete="off" disabled>
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputNamaWali">Nama Wali <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNamaWali" class="form-control col-md-7 col-xs-12" name="inputNamaWali" placeholder="input Nama Wali" type="text" autocomplete="off" disabled>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusAyah">Status Ayah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputStatusAyah" id="inputStatusAyah" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Status Ayah ---</option>
      <option value="1">Masih Hidup</option>
      <option value="2">Sudah Mati</option>
      <option value="3">Tidak Diketahui</option>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusIbu">Status Ibu <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputStatusIbu" id="inputStatusIbu" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Status Ibu ---</option>
      <option value="1">Masih Hidup</option>
      <option value="2">Sudah Mati</option>
      <option value="3">Tidak Diketahui</option>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusWali">Status Wali <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputStatusWali" id="inputStatusWali" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Status Wali ---</option>
      <option value="1">Masih Hidup</option>
      <option value="2">Sudah Mati</option>
      <option value="3">Tidak Diketahui</option>
    </select>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputTahunAyah">Tahun Ayah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputTahunAyah" class="form-control col-md-7 col-xs-12" name="inputTahunAyah" placeholder="input Tahun Ayah" type="text" maxLength="4" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputTahunIbu">Tahun Ibu <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputTahunIbu" class="form-control col-md-7 col-xs-12" name="inputTahunIbu" placeholder="input Tahun Ibu" type="text" maxLength="4" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputTahunWali">Tahun Wali <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputTahunWali" class="form-control col-md-7 col-xs-12" name="inputTahunWali" placeholder="input Tahun Wali" type="text" maxLength="4" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPendidikanAyah">Pendidikan Ayah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputPendidikanAyah" id="inputPendidikanAyah" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Pendidikan Ayah ---</option>
      <?php 
        $data_pendidikan = $this->main_model->get_all_TabelPendukung("1","0","")->result();
        foreach ($data_pendidikan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_pendidikan?>"><?= $hasil->nama_pendidikan?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPendidikanIbu">Pendidikan Ibu <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputPendidikanIbu" id="inputPendidikanIbu" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Pendidikan Ibu ---</option>
      <?php 
        $data_pendidikan = $this->main_model->get_all_TabelPendukung("1","0","")->result();
        foreach ($data_pendidikan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_pendidikan?>"><?= $hasil->nama_pendidikan?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPendidikanWali">Pendidikan Wali <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputPendidikanWali" id="inputPendidikanWali" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Pendidikan Wali ---</option>
      <?php 
        $data_pendidikan = $this->main_model->get_all_TabelPendukung("1","0","")->result();
        foreach ($data_pendidikan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_pendidikan?>"><?= $hasil->nama_pendidikan?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPekerjaanAyah">Pekerjaan Ayah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputPekerjaanAyah" id="inputPekerjaanAyah" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Pekerjaan Ayah ---</option>
      <?php 
        $data_pekerjaan = $this->main_model->get_all_TabelPendukung("7","0","")->result();
        foreach ($data_pekerjaan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_pekerjaan?>"><?= $hasil->nama_pekerjaan?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPekerjaanIbu">Pekerjaan Ibu <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputPekerjaanIbu" id="inputPekerjaanIbu" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Pekerjaan Ibu ---</option>
      <?php 
        $data_pekerjaan = $this->main_model->get_all_TabelPendukung("7","0","")->result();
        foreach ($data_pekerjaan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_pekerjaan?>"><?= $hasil->nama_pekerjaan?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPekerjaanWali">Pekerjaan Wali <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputPekerjaanWali" id="inputPekerjaanWali" class="form-control col-md-7 col-xs-12" disabled>
      <option value="" selected disabled>--- Pilih Pekerjaan Wali ---</option>
      <?php 
        $data_pekerjaan = $this->main_model->get_all_TabelPendukung("7","0","")->result();
        foreach ($data_pekerjaan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_pekerjaan?>"><?= $hasil->nama_pekerjaan?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputTelpAyah">Telp Ayah <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputTelpAyah" class="form-control col-md-7 col-xs-12" name="inputTelpAyah" placeholder="input Telp Ayah" type="text" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputTelpIbu">Telp Ibu <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputTelpIbu" class="form-control col-md-7 col-xs-12" name="inputTelpIbu" placeholder="input Telp Ibu" type="text" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputTelpWali">Telp Wali <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputTelpWali" class="form-control col-md-7 col-xs-12" name="inputTelpWali" placeholder="input Telp Wali" type="text" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPenghasilan">Penghasilan <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputPenghasilan" id="inputPenghasilan" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Penghasilan ---</option>
      <?php 
        $data_penghasilan = $this->main_model->get_all_TabelPendukung("8","0","")->result();
        foreach ($data_penghasilan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_penghasilan?>"><?= $hasil->nama_penghasilan?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusTempattinggal">Status Tempat Tinggal <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputStatusTempattinggal" id="inputStatusTempattinggal" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Status Tempat Tinggal ---</option>
      <?php 
        $data_tempattinggal = $this->main_model->get_all_TabelPendukung("9","0","")->result();
        foreach ($data_tempattinggal as $hasil) { 
      ?>
        <option value="<?= $hasil->id_tempattinggal?>"><?= $hasil->nama_tempattinggal?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputJarakRumah">Jarak Rumah <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputJarakRumah" id="inputJarakRumah" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Jarak Rumah ---</option>
      <?php 
        $data_jarakrumah = $this->main_model->get_all_TabelPendukung("10","0","")->result();
        foreach ($data_jarakrumah as $hasil) { 
      ?>
        <option value="<?= $hasil->id_jarakrumah?>"><?= $hasil->nama_jarakrumah?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTransportasi">Transportasi <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputTransportasi" id="inputTransportasi" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Transportasi ---</option>
      <?php 
        $data_transportasi = $this->main_model->get_all_TabelPendukung("11","0","")->result();
        foreach ($data_transportasi as $hasil) { 
      ?>
        <option value="<?= $hasil->id_transportasi?>"><?= $hasil->nama_transportasi?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputAlamatOrangTua">Alamat Orang Tua</span></label> -->
  <div class="col-md-12 col-sm-6 col-xs-12">
    <textarea id="inputAlamatOrangTua" name="inputAlamatOrangTua" class="form-control col-md-7 col-xs-12" placeholder="input Alamat Orang Tua"></textarea>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputProvinsi">Provinsi <span class="required">*</span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputProvinsi" id="inputProvinsi" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Provinsi ---</option>
      <?php 
        $data_provinsi = $this->main_model->get_all_provinsi()->result();
        foreach ($data_provinsi as $hasil) { 
      ?>
        <option value="<?= $hasil->kode?>"><?= $hasil->nama?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputKabKot">Kabupaten / Kota <span class="required">*</span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputKabKot" id="inputKabKot" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Kabupaten / Kota ---</option>
    </select>
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputKec">Kecamatan <span class="required">*</span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputKec" id="inputKec" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Kecamatan ---</option>
    </select>
  </div>
  <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputDesKel">Desa / Kelurahan <span class="required">*</span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <select name="inputDesKel" id="inputDesKel" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Desa / Kelurahan ---</option>
    </select>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-1 col-sm-3 col-xs-12" for="inputKodePos">Kode Pos <span class="required"></span></label> -->
  <div class="col-md-12 col-sm-6 col-xs-12" id="kodepos">  
    <input id="inputKodePos" class="form-control col-md-7 col-xs-12" name="inputKodePos" placeholder="input Kode Pos" type="text" disabled>
  </div>
</div>
<b>* Required (Harus di isi)</b>
<!-- <script src="<?= base_url('assets/')?>vendors/jquery/dist/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="<?= base_url('assets/')?>jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  function passwordStrength(p){
    var status = document.getElementById('statusAdd');
    var regex = new Array();
    regex.push("[A-Z]");
    regex.push("[a-z]");
    regex.push("[0-9]");
   
    var passed = 0;
      for(var x = 0; x < regex.length;x++){
        if(new RegExp(regex[x]).test(p)){
          console.log(passed++);
        }
      }

    var strength = null;
    var color = null;

    switch(passed){
      case 0:
        strength = "<div style='font-size: 11px;'>#Status Kekuatan Password#</div>";
      break;
      case 1:
        strength = "Tidak Aman";
        color = "#FF3232";
      break;
      case 2:
        strength = "Cukup Aman";
        color = "#E1D441";
      break;
      case 3:
        strength = "Sangat Aman";
        color = "#27D644";
      break;
      case 4:
      break;
    }
    status.innerHTML = strength;
    status.style.color = color;
  }

  $(document).ready(function () {
    $('.inputTgl').datetimepicker({
      format: 'DD-MM-YYYY',
    });

    $('.inputTglLulus').datetimepicker({
      format: 'DD-MM-YYYY',
    });

    $(".toggle-password-admin").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    // ambil data kabupaten ketika data memilih provinsi
    $("#inputProvinsi").change(function (){
      var url = "<?php echo base_url('Main/add_ajax_kab');?>/"+$(this).val();
      $('#inputKabKot').load(url);
      return false;
    });

    $("#inputKabKot").change(function (){
      var url = "<?php echo site_url('Main/add_ajax_kec');?>/"+$(this).val();
      $('#inputKec').load(url);
      return false;
    });

    $("#inputKec").change(function (){
      var url = "<?php echo site_url('Main/add_ajax_des');?>/"+$(this).val();
      $('#inputDesKel').load(url);
      return false;
    });

    $(".inputPassword").mouseenter(function(){
      $(".muncul").show();
    });

    $(".inputPassword").mouseleave(function(){
      $(".muncul").hide();
    });

    $("#inputDesKel").change(function(){
      var kode = $("#inputDesKel").val();
      console.log(kode);
      $.ajax({
        url : base_url + "Main/GetKodePos",
        method : "GET",
        data : {kode:kode},
        async : false,
        dataType : 'json',
        success: function(data){
            var html = '';
            html = '<input id="inputKodePos" class="form-control col-md-7 col-xs-12" name="inputKodePos" value="'+data.kode_pos+'" type="text" readonly>';

            $('#kodepos').html(html);
        }
      });
    });

    $("#dataAyah").click(function () {
      if ($(this).is(":checked")) {
        $("#inputNIKAyah").removeAttr("disabled");
        $("#inputNamaAyah").removeAttr("disabled");
        $("#inputStatusAyah").removeAttr("disabled");
        $("#inputTahunAyah").removeAttr("disabled");
        $("#inputPendidikanAyah").removeAttr("disabled");
        $("#inputPekerjaanAyah").removeAttr("disabled");
        $("#inputTelpAyah").removeAttr("disabled");
        // $("#inputNIKAyah").focus();
      } else {
        $("#inputNIKAyah").attr("disabled", "disabled");
        $("#inputNamaAyah").attr("disabled", "disabled");
        $("#inputStatusAyah").attr("disabled", "disabled");
        $("#inputTahunAyah").attr("disabled", "disabled");
        $("#inputPendidikanAyah").attr("disabled", "disabled");
        $("#inputPekerjaanAyah").attr("disabled", "disabled");
        $("#inputTelpAyah").attr("disabled", "disabled");
      }
    });

    $("#dataIbu").click(function () {
      if ($(this).is(":checked")) {
        $("#inputNIKIbu").removeAttr("disabled");
        $("#inputNamaIbu").removeAttr("disabled");
        $("#inputStatusIbu").removeAttr("disabled");
        $("#inputTahunIbu").removeAttr("disabled");
        $("#inputPendidikanIbu").removeAttr("disabled");
        $("#inputPekerjaanIbu").removeAttr("disabled");
        $("#inputTelpIbu").removeAttr("disabled");
        // $("#inputNIKIbu").focus();
      } else {
        $("#inputNIKIbu").attr("disabled", "disabled");
        $("#inputNamaIbu").attr("disabled", "disabled");
        $("#inputStatusIbu").attr("disabled", "disabled");
        $("#inputTahunIbu").attr("disabled", "disabled");
        $("#inputPendidikanIbu").attr("disabled", "disabled");
        $("#inputPekerjaanIbu").attr("disabled", "disabled");
        $("#inputTelpIbu").attr("disabled", "disabled");
      }
    });

    $("#dataWali").click(function () {
      if ($(this).is(":checked")) {
        $("#inputNIKWali").removeAttr("disabled");
        $("#inputNamaWali").removeAttr("disabled");
        $("#inputStatusWali").removeAttr("disabled");
        $("#inputTahunWali").removeAttr("disabled");
        $("#inputPendidikanWali").removeAttr("disabled");
        $("#inputPekerjaanWali").removeAttr("disabled");
        $("#inputTelpWali").removeAttr("disabled");
        // $("#inputNIKWali").focus();
      } else {
        $("#inputNIKWali").attr("disabled", "disabled");
        $("#inputNamaWali").attr("disabled", "disabled");
        $("#inputStatusWali").attr("disabled", "disabled");
        $("#inputTahunWali").attr("disabled", "disabled");
        $("#inputPendidikanWali").attr("disabled", "disabled");
        $("#inputPekerjaanWali").attr("disabled", "disabled");
        $("#inputTelpWali").attr("disabled", "disabled");
      }
    });
  });
</script>