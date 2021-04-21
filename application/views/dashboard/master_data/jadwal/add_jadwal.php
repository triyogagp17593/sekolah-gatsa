<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputMapel">Mata Pelajaran <span class="required">*</span></label>
  <div class="col-md-9 col-sm-6 col-xs-12">
    <select name="inputMapel" id="inputMapel" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Mata Pelajaran ---</option>
      <?php 
        $data_mapel = $this->main_model->get_all_mapel("1")->result();
        foreach ($data_mapel as $hasil) { 
      ?>
        <option value="<?= $hasil->id_mapel?>"><?= $hasil->nama_mapel?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputHari">Hari <span class="required">*</span></label>
  <div class="col-md-9 col-sm-6 col-xs-12">
    <select name="inputHari" id="inputHari" class="form-control col-md-7 col-xs-12">
      <option value="pilih">-- Pilih --</option>
      <?php
          $hari=array("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
          $jlh_hari=count($hari);
          for($c=0; $c<$jlh_hari; $c+=1){
      ?>
          <option value="<?= $hari[$c]?>"><?= $hari[$c]?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputWaktu">Waktu <span class="required">*</span></label>
  <div class="col-md-4 col-sm-3 col-xs-12">
    <input id="inputMulai" class="form-control col-md-7 col-xs-12 inputMulai" name="inputMulai" placeholder="input Mulai" type="text" autocomplete="off">
  </div>
  <div class="col-md-1 col-sm-3 col-xs-12"><p style="text-align: center; margin-top: 8px;">s/d</p></div>
  <div class="col-md-4 col-sm-3 col-xs-12">
    <input id="inputSelesai" class="form-control col-md-7 col-xs-12 inputSelesai" name="inputSelesai" placeholder="input Selesai" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputWaktucount">Count Time (Minutes) <span class="required">*</span></label>
  <div class="col-md-9 col-sm-6 col-xs-12">
    <input id="inputWaktucount" class="form-control col-md-7 col-xs-12" name="inputWaktucount" placeholder="input Count Time (Minutes)" type="text" required="required" maxLength="3" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Jam Ke- <span class="required">*</span></label>
  <div class="col-md-0 col-sm-0 col-xs-6">
    <div class="radio">
      <label><input type="radio" name="jam_ke" class="flat" value="1"> 1</label>
      <label><input type="radio" name="jam_ke" class="flat" value="2"> 2</label>
      <label><input type="radio" name="jam_ke" class="flat" value="3"> 3</label>
    </div>
  </div>
</div>
<b>* Required (Harus di isi)</b>