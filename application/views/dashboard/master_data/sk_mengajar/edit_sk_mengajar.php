<script src="<?= base_url('assets/')?>myscript.js"></script>
<div class="modal-dialog">
  <div class="modal-content">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">UBAH DATA SK MENGAJAR</h4>
    </div>
    <form action="<?= base_url('update_sk_mengajar');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
      <div class="modal-body">
        <input type="hidden" id="mengajar_id" name="mengajar_id" value="<?= $data_mengajar[0]['id_mengajar'];?>">
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputGuru">Nama Guru <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputGuru" id="inputGuru" class="form-control col-md-7 col-xs-12" required>
              <option value="" selected disabled>--- Pilih Guru ---</option>
              <?php 
                $data_pengguna = $this->db->query("SELECT * FROM view_guru WHERE aktif_state='1'")->result();
                foreach ($data_pengguna as $hasil) {
              ?>
                <?php if($data_mengajar[0]['loginID'] != $hasil->id_login){ ?>
                  <option value="<?= $hasil->id_login?>"><?= $hasil->nama?></option>
                <?php }else{ ?>
                  <?php $data_pengguna_pilih = $this->db->query("SELECT * FROM view_guru WHERE loginID='".$data_mengajar[0]['loginID']."'")->result_array(); ?>
                  <option value="<?= $data_pengguna_pilih[0]['id_login']?>" selected><?= $data_pengguna_pilih[0]['nama']?></option>
                <?php } ?>
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
                <?php if($data_mengajar[0]['mapelID'] != $hasil->id_mapel){ ?>
                  <option value="<?= $hasil->id_mapel?>"><?= $hasil->nama_mapel?></option>
                <?php }else{ ?>
                  <?php $data_mapel_pilih = $this->db->query("SELECT * FROM tbl_mapel WHERE id_mapel='".$data_mengajar[0]['mapelID']."'")->result_array(); ?>
                  <option value="<?= $data_mapel_pilih[0]['id_mapel']?>" selected><?= $data_mapel_pilih[0]['nama_mapel']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKelas">Kelas <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputKelas" id="inputKelas" class="form-control col-md-7 col-xs-12" required>
              <option value="" selected disabled>--- Pilih Kelas ---</option>
              <option value="VII" <?php if($data_mengajar[0]['kelas'] == "VII"){echo "selected";}?>>Kelas VII</option>
              <option value="VIII" <?php if($data_mengajar[0]['kelas'] == "VIII"){echo "selected";}?>>Kelas VIII</option>
              <option value="IX" <?php if($data_mengajar[0]['kelas'] == "IX"){echo "selected";}?>>Kelas IX</option>
              <!-- <?php 
                $data_kelas = $this->db->query("SELECT * FROM tbl_kelas WHERE aktif_state='1' ORDER BY romawi_kelas,angka_kelas ASC")->result();
                foreach ($data_kelas as $hasil) { 
              ?>
                <?php if($data_mengajar[0]['kelasID'] != $hasil->id_kelas){ ?>
                  <option value="<?= $hasil->id_kelas?>"><?= $hasil->romawi_kelas."-".$hasil->angka_kelas?></option>
                <?php }else{ ?>
                  <?php $data_kelas_pilih = $this->db->query("SELECT * FROM tbl_kelas WHERE id_kelas='".$data_mengajar[0]['kelasID']."'")->result_array(); ?>
                  <option value="<?= $data_kelas_pilih[0]['id_kelas']?>" selected><?= $data_kelas_pilih[0]['romawi_kelas']."-".$data_kelas_pilih[0]['angka_kelas']?></option>
                <?php } ?>
              <?php } ?> -->
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
