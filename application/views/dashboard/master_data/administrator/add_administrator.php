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
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNama">Nama <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">  
    <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama" placeholder="input Nama Lengkap *" required="required" type="text" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputEmail">Email <span class="required">*</span></label> -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <input id="inputEmail" class="form-control col-md-7 col-xs-12" name="inputEmail" placeholder="input Email *" required="required" type="email" autocomplete="off">
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
    <input id="inputTempat" class="form-control col-md-7 col-xs-12" name="inputTempat" placeholder="input Tempat Lahir" type="text" autocomplete="off">
  </div>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <input id="inputTgl" class="form-control col-md-7 col-xs-12 inputTgl" name="inputTgl" placeholder="input Tanggal Lahir" type="text" autocomplete="off">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-2 col-sm-3 col-xs-12">Jenis Kelamin</label>
  <div class="col-md-4 col-sm-0 col-xs-6">
    <div class="radio">
      <label><input type="radio" name="jk" class="flat" value="1" checked> Laki-Laki</label>
      <label><input type="radio" name="jk" class="flat" value="0"> Perempuan</label>
    </div>
  </div>
  <label class="control-label col-md-2 col-sm-3 col-xs-12">RoleID <span class="required">*</span></label>
  <div class="col-md-4 col-sm-0 col-xs-6">
    <div class="radio">
      <label><input type="radio" name="level" class="flat" value="1"> Administrator</label>
      <label><input type="radio" name="level" class="flat" value="2" checked> Operator</label>
    </div>
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTelepon">Telepon <span class="required">*</span></label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="inputTelepon" class="form-control col-md-7 col-xs-12" name="inputTelepon" placeholder="input Telepon" type="text" required="required" maxLength="15" onkeyup="validAngkatelp(this)" autocomplete="off">
  </div>
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file">Foto</label> -->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="foto" name="foto" placeholder="input Foto" class="form-control col-md-7 col-xs-12" type="file">
  </div>
</div>
<div class="item form-group">
  <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputAlamat">Alamat</span></label> -->
  <div class="col-md-12 col-sm-6 col-xs-12">
    <textarea id="inputAlamat" name="inputAlamat" class="form-control col-md-7 col-xs-12" placeholder="input Alamat"></textarea>
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