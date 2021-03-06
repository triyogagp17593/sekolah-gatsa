<script src="<?= base_url('assets/')?>myscript.js"></script>
<style type="text/css">
  .field-icon {
    float: right;
    margin-right: 10px;
    margin-top: -25px;
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
<div class="modal-dialog">
  <div class="modal-content">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">UBAH DATA ADMINISTRATOR</h4>
    </div>
    <form action="<?= base_url('update_administrator');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
      <div class="modal-body">
        <input type="hidden" id="login_id" name="login_id" value="<?= $data_pengguna[0]['id_login'];?>">
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNama">Nama <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNama" class="form-control col-md-7 col-xs-12" name="inputNama" placeholder="input Nama Lengkap" required="required" type="text" value="<?= $data_pengguna[0]['nama'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nama'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nama'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputEmail">Email <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputEmail" class="form-control col-md-7 col-xs-12" name="inputEmail" placeholder="input Email" required="required" type="email" value="<?= $data_pengguna[0]['email'];?>" onfocus="(this.value=='<? $data_pengguna[0]['email'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['email'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputUsername">Username <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputUsername" class="form-control col-md-7 col-xs-12" name="inputUsername" placeholder="input Username" required="required" type="text" value="<?= $data_pengguna[0]['username'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['username'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['username'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPassword">Kata Sandi <span class="required">*</span></label>
          <div class="col-md-6 col-sm-3 col-xs-12">
            <input id="inputPassword" class="form-control col-md-7 col-xs-12 inputPassword" name="inputPassword" placeholder="input Kata Sandi" type="password" onkeyup="passwordKekuatan(this.value)" autocomplete="off">
            <p class="muncul">NOTE: Kata Sandi minimal 6 karakter, Kombinasi Lowercase, Uppercase, number</p>
            <span class="field-icon" onclick="passToggle()" id="show"><span class="fa fa-eye"></span></a>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div style="margin-top: 10px; font-weight: bold;" id="statusEdit"><div style="font-size: 8.5px;">#Status Kekuatan Password#</div></div>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTempat">Tempat, Tgl Lahir</label>
          <div class="col-md-5 col-sm-3 col-xs-12">
            <input id="inputTempat" class="form-control col-md-7 col-xs-12" name="inputTempat" placeholder="input Tempat" type="text" value="<?= $data_pengguna[0]['tempat'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['tempat'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['tempat'];?>')" autocomplete="off">
          </div>
          <div class="col-md-4 col-sm-3 col-xs-12">
          <?php if($data_pengguna[0]['tgl_lahir'] == "0000-00-00"){ ?>
              <input id="inputTgl" class="form-control col-md-7 col-xs-12 inputTgl" name="inputTgl" placeholder="input Tanggal Lahir" type="text" autocomplete="off">
          <?php }else{ ?>
              <input id="inputTgl" class="form-control col-md-7 col-xs-12 inputTgl" name="inputTgl" placeholder="input Tanggal Lahir" type="text" value="<?= date('d-m-Y',strtotime($data_pengguna[0]['tgl_lahir']));?>" onfocus="(this.value=='<?= date('d-m-Y',strtotime($data_pengguna[0]['tgl_lahir']));?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= date('d-m-Y',strtotime($data_pengguna[0]['tgl_lahir']));?>')" autocomplete="off">
          <?php } ?>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
          <div class="col-md-0 col-sm-0 col-xs-6">
            <div class="radio">
              <label><input type="radio" name="jk" class="flat" value="1" <?php if($data_pengguna[0]['jk'] == 1){echo "checked";}else{echo "unchecked";} ?>> Laki-Laki</label>
              <label><input type="radio" name="jk" class="flat" value="0" <?php if($data_pengguna[0]['jk'] == 0){echo "checked";}else{echo "unchecked";} ?>> Perempuan</label>
            </div>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTelepon">Telepon <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputTelepon" class="form-control col-md-7 col-xs-12" name="inputTelepon" placeholder="input Telepon" type="text" required="required" maxLength="15" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['telp'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['telp'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['telp'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputAlamat">Alamat</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <textarea id="inputAlamat" name="inputAlamat" class="form-control col-md-7 col-xs-12" placeholder="input Alamat" onfocus="(this.value=='<?= $data_pengguna[0]['alamat'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['alamat'];?>')"><?= $data_pengguna[0]['alamat'];?></textarea>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Foto</label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input type="file" id="myfoto" name="foto" placeholder="input Foto" class="form-control col-md-7 col-xs-12">
            <input type="checkbox" id="lihat" name="lihat" value="1" onclick="tampil(this.checked);"> <span id="text"> Sembunyi</span>
            <br>
            <?php if(empty($data_pengguna[0]['gambar'])){echo"<b>tidak ada foto</b>";}else{ ?>
              <img src="<?= base_url('assets/images/gambar_user/').$data_pengguna[0]['gambar'];?>" width="5%" title="<?= $data_pengguna[0]['gambar']?>">
            <?php } ?>
          </div>
        </div>
        <b>* Required (Harus di isi kecuali kata sandi, kosongkan jika tidak ingin diubah)</b>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
        <button class="btn btn-primary">Ubah</button>
      </div>
    </form>
  </div>
</div>
<script src="<?= base_url('assets/')?>jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $(".inputPassword").mouseenter(function(){
      $(".muncul").show();
    });

    $(".inputPassword").mouseleave(function(){
      $(".muncul").hide();
    });
  });
</script>