<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Romawi Kelas <span class="required">*</span></label>
  <div class="col-md-9 col-sm-6 col-xs-12">
    <select name="inputRomawi" id="inputRomawi1" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Romawi ---</option>
      <option value="VII">VII</option>
      <option value="VIII">VIII</option>
      <option value="IX">IX</option>
    </select>
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Angka Kelas <span class="required">*</span></label>
  <div class="col-md-9 col-sm-6 col-xs-12">
    <select name="inputAngka" id="inputAngka" class="form-control col-md-7 col-xs-12" required>
      <option value="" selected disabled>--- Pilih Angka ---</option>
      <?php $no=1; for($i=1;$i<=20;$i++){ ?> 
        <option value="<?= $no;?>"><?= $no;?></option>
      <?php $no++;} ?> 
    </select>
  </div>
</div>
<b>* Required (Harus di isi)</b>