<script src="<?= base_url('assets/')?>myscript.js"></script>
<div class="modal-dialog">
  <div class="modal-content">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">AMBIL MENGAJAR GURU (<?= $data_pengguna[0]['nama'];?>)</h4>
    </div>
    <form action="<?= base_url('ambil_ajar_kelas');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
      <div class="modal-body">
        <input type="hidden" id="login_id" name="login_id" value="<?= $data_pengguna[0]['id_login'];?>">
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNamaGuru">Nama Guru <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input type="text" id="inputNamaGuru" name="inputNamaGuru" class="form-control col-md-7 col-xs-12" value="<?= $data_pengguna[0]['nama'];?>" disabled>
          </div>
        </div>
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKelas">Kelas <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input type="text" id="inputKelas" name="inputKelas" class="form-control col-md-7 col-xs-12" placeholder="input Kelas Di ajar (ex. VII,VIII,IX / VII & VIII) huruf romawi" autocomplete="off" required>
          </div>
        </div>
        <b>* Required (Harus di isi)</b>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
        <button class="btn btn-primary">Ambil Kelas Yang Di Ajar</button>
      </div>
    </form>
  </div>
</div>
