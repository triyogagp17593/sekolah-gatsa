<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputGuru">Nama Guru <span class="required">*</span></label>
  <div class="col-md-9 col-sm-6 col-xs-12">
    <select name="inputGuru" id="inputGuru" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Guru ---</option>
      <?php 
        $data_pengguna = $this->db->query("SELECT * FROM view_guru WHERE aktif_state='1'")->result();
        foreach ($data_pengguna as $hasil) { 
      ?>
        <option value="<?= $hasil->id_login?>"><?= $hasil->nama?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputMapel">Mata Pelajaran <span class="required">*</span></label>
  <div class="col-md-9 col-sm-6 col-xs-12">
    <select name="inputMapel" id="inputMapel" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Mata Pelajaran ---</option>
      <?php 
        $data_mapel = $this->db->query("SELECT * FROM tbl_mapel WHERE aktif_state='1' ORDER BY nama_mapel ASC")->result();
        foreach ($data_mapel as $hasil) { 
      ?>
        <option value="<?= $hasil->id_mapel?>"><?= $hasil->nama_mapel?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKelas">Kelas <span class="required">*</span></label>
  <div class="col-md-9 col-sm-6 col-xs-12">
    <select name="inputKelas" id="inputKelas" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Kelas ---</option>
      <option value="VII">Kelas VII</option>
      <option value="VIII">Kelas VIII</option>
      <option value="IX">Kelas IX</option>
      <!-- <?php 
        $data_kelas = $this->db->query("SELECT * FROM tbl_kelas WHERE aktif_state='1' ORDER BY romawi_kelas,angka_kelas ASC")->result();
        foreach ($data_kelas as $hasil) { 
      ?>
        <option value="<?= $hasil->id_kelas?>"><?= $hasil->romawi_kelas."-".$hasil->angka_kelas?></option>
      <?php } ?> -->
    </select>
  </div>
</div>
<b>* Required (Harus di isi)</b>