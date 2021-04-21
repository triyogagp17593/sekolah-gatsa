<script src="<?= base_url('assets/')?>myscript.js"></script>
<div class="modal-dialog">
  <div class="modal-content">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">UBAH DATA KELAS</h4>
    </div>
    <form action="<?= base_url('update_kelas');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
      <div class="modal-body">
        <input type="hidden" id="kelas_id" name="kelas_id" value="<?= $data_kelas[0]['id_kelas'];?>">
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Romawi Kelas <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputRomawi" id="inputRomawi" class="form-control col-md-7 col-xs-12" required>
              <option value="" disabled>--- Pilih Romawi ---</option>
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
              <option value="" disabled>--- Pilih Angka ---</option>
              <?php $no=1; for($i=1;$i<=20;$i++){ ?> 
                <?php if($data_kelas[0]['angka_kelas'] != $no){ ?>
                  <option value="<?= $no;?>"><?= $no;?></option>
                <?php }else{ ?> 
                  <option value="<?= $no;?>" selected><?= $no;?></option>
                <?php } ?> 
              <?php $no++;} ?> 
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
