<script src="<?= base_url('assets/')?>myscript.js"></script>
<div class="modal-dialog">
  <div class="modal-content">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">AMBIL KELAS SISWA (<?= $data_pengguna[0]['nama'];?>)</h4>
    </div>
    <?php if($jmldata_kelas == 0){$kondisi=1;}else{$kondisi=2;} ?>
    <form action="<?= base_url('ambilorupdate_ambil_kelas/'.$kondisi);?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
      <div class="modal-body">
        <?php if($jmldata_kelas != 0){ ?>
          <input type="hidden" id="kelas_siswa_id" name="kelas_siswa_id" value="<?= $data_kelas[0]['id_kelas_siswa'];?>">
        <?php } ?>
        <input type="hidden" id="login_id" name="login_id" value="<?= $data_pengguna[0]['id_login'];?>">
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Romawi Kelas <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputRomawi" id="inputRomawi" class="form-control col-md-7 col-xs-12" required>
              <option value="" selected disabled>--- Pilih Romawi ---</option>
              <?php 
                if($data_kelas[0]['romawi_kelas'] == "VII"){$pilihan1="selected";}else{$pilihan1="";}
                if($data_kelas[0]['romawi_kelas'] == "VIII"){$pilihan2="selected";}else{$pilihan2="";}
                if($data_kelas[0]['romawi_kelas'] == "IX"){$pilihan3="selected";}else{$pilihan3="";}
              ?>
                <option value="VII" <?= $pilihan1?>>VII</option>
                <option value="VIII" <?= $pilihan2?>>VIII</option>
                <option value="IX" <?= $pilihan3?>>IX</option>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Angka Kelas <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputAngka" id="inputAngka" class="form-control col-md-7 col-xs-12" required>
              <option value="" disabled <?php if($jmldata_kelas == 0){echo"selected";}{echo"";} ?>>--- Pilih Angka Kelas ---</option>
              <?php 
                $data_allkelas = $this->main_model->get_all_kelasBy($data_kelas[0]['romawi_kelas'])->result();
                foreach ($data_allkelas as $hasilkelas) { 
              ?>
                <?php if($jmldata_kelas != 0 && $data_kelas[0]['romawi_kelas'] == $hasilkelas->romawi_kelas && $data_kelas[0]['angka_kelas'] == $hasilkelas->angka_kelas){ ?>
                  <option value="<?= $hasilkelas->id_kelas?>" selected><?= $hasilkelas->angka_kelas?></option>
                <?php }else{ ?>
                  <option value="<?= $hasilkelas->id_kelas?>"><?= $hasilkelas->angka_kelas?></option>
                <?php } ?> 
              <?php } ?> 
            </select>
          </div>
        </div>
        <b>* Required (Harus di isi)</b>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
        <button class="btn btn-primary">Ubah</button>
      </div>
    </form>
  </div>
</div>
