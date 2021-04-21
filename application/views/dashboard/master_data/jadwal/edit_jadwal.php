<div class="modal-dialog">
  <div class="modal-content">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">UBAH DATA JADWAL UJIAN</h4>
    </div>
    <form action="<?= base_url('update_jadwal');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
      <div class="modal-body">
        <input type="hidden" id="jadwal_id" name="jadwal_id" value="<?= $data_jadwal[0]['id_jadwal'];?>">
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputMapel">Mata Pelajaran <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputMapel" id="inputMapel" class="form-control col-md-7 col-xs-12" required>
              <option value="" selected disabled>--- Pilih Mata Pelajaran ---</option>
              <?php 
                $data_mapel = $this->main_model->get_all_mapel("1")->result();
                foreach ($data_mapel as $hasil) { 
              ?>
                <?php if($data_jadwal[0]['mapelID'] != $hasil->id_mapel){ ?>
                  <option value="<?= $hasil->id_mapel?>"><?= $hasil->nama_mapel?></option>
                <?php }else{ ?>
                  <?php $data_mapel_pilih = $this->main_model->ubah_mapel($data_jadwal[0]['mapelID'])->result_array(); ?>
                  <option value="<?= $data_mapel_pilih[0]['id_mapel']?>" selected><?= $data_mapel_pilih[0]['nama_mapel']?></option>
                <?php } ?>
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
                <?php if($data_jadwal[0]['hari'] != $hari[$c]){ ?>
                  <option value="<?= $hari[$c]?>"><?=$hari[$c] ?></option>
                <?php }else{ ?>
                  <option value="<?= $data_jadwal[0]['hari']?>" selected><?= $data_jadwal[0]['hari']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputWaktu">Waktu <span class="required">*</span></label>
          <div class="col-md-4 col-sm-3 col-xs-12">
            <input id="inputMulai" class="form-control col-md-7 col-xs-12 inputMulai" name="inputMulai" placeholder="input Mulai" type="text" value="<?= date('d-m-Y H:i:s',strtotime($data_jadwal[0]['waktu_mulai']));?>" autocomplete="off">
          </div>
          <div class="col-md-1 col-sm-3 col-xs-12"><p style="text-align: center; margin-top: 8px;">s/d</p></div>
          <div class="col-md-4 col-sm-3 col-xs-12">
            <input id="inputSelesai" class="form-control col-md-7 col-xs-12 inputSelesai" name="inputSelesai" placeholder="input Selesai" type="text" value="<?= date('d-m-Y H:i:s',strtotime($data_jadwal[0]['waktu_selesai']));?>" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputWaktucount">Count Time (Minutes) <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputWaktucount" class="form-control col-md-7 col-xs-12" name="inputWaktucount" placeholder="input Count Time (Minutes)" type="text" required="required" maxLength="3" onkeyup="validAngkatelp(this)" value="<?= $data_jadwal[0]['waktu'];?>" onfocus="(this.value=='<?= $data_jadwal[0]['waktu'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_jadwal[0]['waktu'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jam Ke- <span class="required">*</span></label>
          <div class="col-md-0 col-sm-0 col-xs-6">
            <div class="radio">
              <label><input type="radio" name="jam_ke" class="flat" value="1" <?php if($data_jadwal[0]['jam_ke'] == 1){echo "checked";}else{echo "unchecked";} ?>> 1</label>
              <label><input type="radio" name="jam_ke" class="flat" value="2" <?php if($data_jadwal[0]['jam_ke'] == 2){echo "checked";}else{echo "unchecked";} ?>> 2</label>
              <label><input type="radio" name="jam_ke" class="flat" value="3" <?php if($data_jadwal[0]['jam_ke'] == 3){echo "checked";}else{echo "unchecked";} ?>> 3</label>
            </div>
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
<script type="text/javascript">
  $('.inputMulai').datetimepicker({
    format: 'DD-MM-YYYY HH:mm'
  });

  $('.inputSelesai').datetimepicker({
    format: 'DD-MM-YYYY HH:mm'
  });
</script>