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
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNoinduk">NIP <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <input id="inputNoinduk" class="form-control col-md-7 col-xs-12" name="inputNoinduk" placeholder="input Nomor Induk Pegawai" type="text"maxLength="25" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNUPTK">NUPTK / NIGNP <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <input id="inputNUPTK" class="form-control col-md-7 col-xs-12" name="inputNUPTK" placeholder="input NUPTK / NIGNP" type="text"maxLength="20" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNRG">NRG <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <input id="inputNRG" class="form-control col-md-7 col-xs-12" name="inputNRG" placeholder="input NRG" type="text"maxLength="20" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNIPY">NIPY <span class="required"></span></label> -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <input id="inputNIPY" class="form-control col-md-7 col-xs-12" name="inputNIPY" placeholder="input NIPY" type="text"maxLength="20" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-2 col-sm-3 col-xs-12">GTY / GTT</label>
  <div class="col-md-2 col-sm-0 col-xs-6">
    <div class="radio">
      <label><input type="radio" name="gty_gtt" class="flat" value="0" checked> GTY</label>
      <label><input type="radio" name="gty_gtt" class="flat" value="1"> PNS</label>
    </div>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputGolongan">Golongan <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input id="inputGolongan" class="form-control col-md-7 col-xs-12" name="inputGolongan" placeholder="input Golongan" type="text" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTMT">TMT <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input id="inputTMT" class="form-control col-md-7 col-xs-12 inputTMT" name="inputTMT" placeholder="input TMT" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNama">Nama <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama" placeholder="input Nama Lengkap *" required="required" type="text" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputEmail">Email <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input id="inputEmail" class="form-control col-md-7 col-xs-12" name="inputEmail" placeholder="input Email" type="email" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputUsername">Username <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input id="inputUsername" class="form-control col-md-7 col-xs-12" name="inputUsername" placeholder="input Username *" required="required" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPassword">Kata Sandi <span class="required">*</span></label> -->
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input id="inputPasswordAdd" class="form-control col-md-7 col-xs-12 inputPassword" name="inputPassword" placeholder="input Kata Sandi *" required="required" type="password" onkeyup="passwordStrength(this.value)" autocomplete="off">
    <p class="muncul">NOTE: Kata Sandi minimal 6 karakter, Kombinasi Lowercase, Uppercase, number</p>
    <span toggle="#inputPasswordAdd" class="fa fa-fw fa-eye field-icon toggle-password-admin"></span>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div style="margin-top: 10px; font-weight: bold; text-align: center;" id="statusAdd"><div style="font-size: 11px;">#Status Kekuatan Password#</div></div>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTempat">Tempat, Tgl Lahir</label> -->
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input id="inputTempat" class="form-control col-md-7 col-xs-12" name="inputTempat" placeholder="input Tempat" type="text" autocomplete="off">
  </div>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input id="inputTgl" class="form-control col-md-7 col-xs-12 inputTgl" name="inputTgl" placeholder="input Tanggal Lahir" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis Kelamin</label>
  <div class="col-md-0 col-sm-0 col-xs-6">
    <div class="radio">
      <label><input type="radio" name="jk" class="flat" value="1" checked> Laki-Laki</label>
      <label><input type="radio" name="jk" class="flat" value="0"> Perempuan</label>
    </div>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputJabatan">Jabatan <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputJabatan" id="inputJabatan" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Jabatan ---</option>
      <?php 
        $data_jabatan = $this->main_model->get_all_TabelPendukung("0","0","")->result();
        foreach ($data_jabatan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_jabatan?>"><?= $hasil->nama_jabatan?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPendidikan">Pendidikan Terakhir <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputPendidikan" id="inputPendidikan" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Pendidikan Terakhir ---</option>
      <?php 
        $data_pendidikan = $this->main_model->get_all_TabelPendukung("1","0","")->result();
        foreach ($data_pendidikan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_pendidikan?>"><?= $hasil->nama_pendidikan?></option>
      <?php } ?>
    </select>
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusPernikahan">Status Pernikahan <span class="required"></span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <select name="inputStatusPernikahan" id="inputStatusPernikahan" class="form-control col-md-7 col-xs-12">
      <option value="" selected disabled>--- Pilih Status Pernikahan ---</option>
      <?php 
        $data_status_pernikahan = $this->main_model->get_all_TabelPendukung("2","0","")->result();
        foreach ($data_status_pernikahan as $hasil) { 
      ?>
        <option value="<?= $hasil->id_status_pernikahan?>"><?= $hasil->status_pernikahan?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTelepon">Telepon <span class="required">*</span></label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="inputTelepon" class="form-control col-md-7 col-xs-12" name="inputTelepon" placeholder="input Telepon *" type="text" required="required" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Foto</label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="foto" name="foto" placeholder="input Foto" class="form-control col-md-7 col-xs-12" type="file">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputAlamat">Alamat</span></label> -->
  <div class="col-md-12 col-sm-6 col-xs-12">
    <textarea id="inputAlamat" name="inputAlamat" class="form-control col-md-7 col-xs-12" placeholder="input Alamat Guru"></textarea>
  </div>  
</div>
<b>* Required (Harus di isi)</b>
<!-- <script src="<?= base_url('assets/')?>vendors/jquery/dist/jquery.min.js"></script> -->
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

    $('.inputTMT').datetimepicker({
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

    $(".inputPassword").mouseenter(function(){
      $(".muncul").show();
    });

    $(".inputPassword").mouseleave(function(){
      $(".muncul").hide();
    });
  });
</script>