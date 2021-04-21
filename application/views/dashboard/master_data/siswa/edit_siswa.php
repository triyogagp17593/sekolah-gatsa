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
<div class="modal-dialog" style="width: 1000px;">
  <div class="modal-content">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">UBAH DATA SISWA</h4>
    </div>
    <form action="<?= base_url('update_siswa');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
      <div class="modal-body">
        <div class="item form-group"><div class="col-md-12 col-sm-6 col-xs-12"><center><h4><b>Biodata Siswa</b></h4></center></div></div>
        <input type="hidden" id="login_id" name="login_id" value="<?= $data_pengguna[0]['id_login'];?>">
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNoinduk">NIS <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputNoinduk" class="form-control col-md-7 col-xs-12" name="inputNoinduk" placeholder="input Nomor Induk Siswa" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nomor_induk'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nomor_induk'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nomor_induk'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNisn">NISN <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputNisn" class="form-control col-md-7 col-xs-12" name="inputNisn" placeholder="input Nomor Induk Siswa Nasional" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nisn'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nisn'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nisn'];?>')" autocomplete="off">
          </div>
        </div>
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputAnakKe">Anak Ke <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputAnakKe" class="form-control col-md-7 col-xs-12" name="inputAnakKe" placeholder="input Anak Ke" type="text" maxLength="2" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['anak_ke'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['anak_ke'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['anak_ke'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputJmlSaudara">Jumlah Saudara <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputJmlSaudara" class="form-control col-md-7 col-xs-12" name="inputJmlSaudara" placeholder="input Jumlah Saudara" type="text" maxLength="2" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['jml_saudara'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['jml_saudara'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['jml_saudara'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputHobi">Hobi <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputHobi" id="inputHobi" class="form-control col-md-7 col-xs-12">
              <option value="" selected disabled>--- Pilih Hobi ---</option>
              <?php 
                $data_hobi = $this->main_model->get_all_TabelPendukung("5","0","")->result();
                foreach ($data_hobi as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['hobi'] != $hasil->id_hobi){ ?>
                  <option value="<?= $hasil->id_hobi?>"><?= $hasil->nama_hobi?></option>
                <?php }else{ ?>
                  <?php $data_hobi_pilih = $this->main_model->get_all_TabelPendukung("5","1",$data_pengguna[0]['hobi'])->result_array(); ?>
                  <option value="<?= $data_hobi_pilih[0]['id_hobi']?>" selected><?= $data_hobi_pilih[0]['nama_hobi']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputCitaCita">Cita - Cita <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputCitaCita" id="inputCitaCita" class="form-control col-md-7 col-xs-12">
              <option value="" selected disabled>--- Pilih Cita - Cita ---</option>
              <?php 
                $data_citacita = $this->main_model->get_all_TabelPendukung("4","0","")->result();
                foreach ($data_citacita as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['citacita'] != $hasil->id_citacita){ ?>
                  <option value="<?= $hasil->id_citacita?>"><?= $hasil->nama_citacita?></option>
                <?php }else{ ?>
                  <?php $data_citacita_pilih = $this->main_model->get_all_TabelPendukung("4","1",$data_pengguna[0]['citacita'])->result_array(); ?>
                  <option value="<?= $data_citacita_pilih[0]['id_citacita']?>" selected><?= $data_citacita_pilih[0]['nama_citacita']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTelepon">Telepon <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputTelepon" class="form-control col-md-7 col-xs-12" name="inputTelepon" placeholder="input Telepon" type="text" required="required" maxLength="15" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['telp'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['telp'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['telp'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputAlamat">Alamat Sekolah</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <textarea id="inputAlamat" name="inputAlamat" class="form-control col-md-7 col-xs-12" placeholder="input Alamat Sekolah" onfocus="(this.value=='<?= $data_pengguna[0]['alamat'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['alamat'];?>')"><?= $data_pengguna[0]['alamat'];?></textarea>
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
        <hr style="border: dashed 2px #000;">
        <div class="item form-group"><div class="col-md-12 col-sm-6 col-xs-12"><center><h4><b>Data Asal Sekolah Siswa</b></h4></center></div></div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNoUN">Nomor Peserta UN <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputNoUN" class="form-control col-md-7 col-xs-12" name="inputNoUN" placeholder="input Nomor Peserta UN" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['no_un'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['no_un'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['no_un'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNoSKHUN">Nomor SKHUN <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputNoSKHUN" class="form-control col-md-7 col-xs-12" name="inputNoSKHUN" placeholder="input Nomor SKHUN" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['no_skhun'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['no_skhun'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['no_skhun'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNoIjazah">Nomor Ijazah <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputNoIjazah" class="form-control col-md-7 col-xs-12" name="inputNoIjazah" placeholder="input Nomor Ijazah" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['no_ijazah'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['no_ijazah'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['no_ijazah'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNamaSekolah">Nama Sekolah <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNamaSekolah" class="form-control col-md-7 col-xs-12" name="inputNamaSekolah" placeholder="input Nama Sekolah" required="required" type="text" value="<?= $data_pengguna[0]['nama_sekolah'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nama_sekolah'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nama_sekolah'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNPSN">NPSN <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputNPSN" class="form-control col-md-7 col-xs-12" name="inputNPSN" placeholder="input NPSN" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['npsn'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['npsn'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['npsn'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputJenjangSekolah">Jenjang Sekolah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputJenjangSekolah" id="inputJenjangSekolah" class="form-control col-md-7 col-xs-12">
              <option value="" selected disabled>--- Pilih Jenjang Sekolah ---</option>
              <?php 
                $data_jenjang = $this->main_model->get_all_TabelPendukung("6","0","")->result();
                foreach ($data_jenjang as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['jenjang'] != $hasil->id_jenjang){ ?>
                  <option value="<?= $hasil->id_jenjang?>"><?= $hasil->nama_jenjang?></option>
                <?php }else{ ?>
                  <?php $data_jenjang_pilih = $this->main_model->get_all_TabelPendukung("6","1",$data_pengguna[0]['jenjang'])->result_array(); ?>
                  <option value="<?= $data_jenjang_pilih[0]['id_jenjang']?>" selected><?= $data_jenjang_pilih[0]['nama_jenjang']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusSekolah">Status Sekolah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputStatusSekolah" id="inputStatusSekolah" class="form-control col-md-7 col-xs-12">
              <option value="" <?php if($data_pengguna[0]['status_sekolah'] == 0){echo "selected";} ?> disabled>--- Pilih Status Sekolah ---</option>
              <option value="1" <?php if($data_pengguna[0]['status_sekolah'] == 1){echo "selected";} ?>>Negeri</option>
              <option value="2" <?php if($data_pengguna[0]['status_sekolah'] == 2){echo "selected";} ?>>Swasta</option>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputLokasiSekolah">Lokasi Sekolah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputLokasiSekolah" id="inputLokasiSekolah" class="form-control col-md-7 col-xs-12">
              <option value="" selected disabled>--- Pilih Lokasi Sekolah ---</option>
              <?php 
                $data_kabkot = $this->main_model->get_all_kabkotkecdeskel("32")->result();
                foreach ($data_kabkot as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['kabkot_asalsekolah'] != $hasil->kode){ ?>
                  <option value="<?= $hasil->kode?>"><?= $hasil->nama?></option>
                <?php }else{ ?>
                  <?php $data_kabkot_pilih = $this->main_model->get_all_lokasi($data_pengguna[0]['kabkot_asalsekolah'])->result_array(); ?>
                  <option value="<?= $data_kabkot_pilih[0]['kode']?>" selected><?= $data_kabkot_pilih[0]['nama']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNilaiUN">Nilai UN <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputNilaiUN" class="form-control col-md-7 col-xs-12" name="inputNilaiUN" placeholder="input Nilai UN" type="text" required="required" maxLength="3" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nilai_un'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nilai_un'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nilai_un'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTglLulus">Tanggal Lulus</label>
          <div class="col-md-9 col-sm-3 col-xs-12">
          <?php if($data_pengguna[0]['tgl_lulus'] == "0000-00-00"){ ?>
              <input id="inputTglLulus" class="form-control col-md-7 col-xs-12 inputTglLulus" name="inputTglLulus" placeholder="input Tanggal Lulus" type="text" autocomplete="off">
          <?php }else{ ?>
              <input id="inputTglLulus" class="form-control col-md-7 col-xs-12 inputTglLulus" name="inputTglLulus" placeholder="input Tanggal Lulus" type="text" value="<?= date('d-m-Y',strtotime($data_pengguna[0]['tgl_lulus']));?>" onfocus="(this.value=='<?= date('d-m-Y',strtotime($data_pengguna[0]['tgl_lulus']));?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= date('d-m-Y',strtotime($data_pengguna[0]['tgl_lulus']));?>')" autocomplete="off">
          <?php } ?>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputAlamatSekolah">Alamat Sekolah</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <textarea id="inputAlamatSekolah" name="inputAlamatSekolah" class="form-control col-md-7 col-xs-12" placeholder="input Alamat Sekolah" onfocus="(this.value=='<?= $data_pengguna[0]['alamat_sekolah'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['alamat_sekolah'];?>')"><?= $data_pengguna[0]['alamat_sekolah'];?></textarea>
          </div>
        </div>
        <hr style="border: dashed 2px #000;">
        <div class="item form-group"><div class="col-md-12 col-sm-6 col-xs-12"><center><h4><b>Data Orang Tua / Wali Siswa</b></h4></center></div></div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNamaKK">Nama Kepala Keluarga <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNamaKK" class="form-control col-md-7 col-xs-12" name="inputNamaKK" placeholder="input Nama Kepala Keluarga" required="required" type="text" value="<?= $data_pengguna[0]['nama_kk'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nama_kk'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nama_kk'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNoKK">Nomor Kartu Keluarga <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <input id="inputNoKK" class="form-control col-md-7 col-xs-12" name="inputNoKK" placeholder="input Nomor Kartu Keluarga" type="text" required="required" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['no_kk'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['no_kk'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['no_kk'];?>')" autocomplete="off">
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPenghasilan">Penghasilan <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputPenghasilan" id="inputPenghasilan" class="form-control col-md-7 col-xs-12">
              <option value="" selected disabled>--- Pilih Penghasilan ---</option>
              <?php 
                $data_penghasilan = $this->main_model->get_all_TabelPendukung("8","0","")->result();
                foreach ($data_penghasilan as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['penghasilan'] != $hasil->id_penghasilan){ ?>
                  <option value="<?= $hasil->id_penghasilan?>"><?= $hasil->nama_penghasilan?></option>
                <?php }else{ ?>
                  <?php $data_penghasilan_pilih = $this->main_model->get_all_TabelPendukung("8","1",$data_pengguna[0]['penghasilan'])->result_array(); ?>
                  <option value="<?= $data_penghasilan_pilih[0]['id_penghasilan']?>" selected><?= $data_penghasilan_pilih[0]['nama_penghasilan']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusTempattinggal">Status Tempat Tinggal <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputStatusTempattinggal" id="inputStatusTempattinggal" class="form-control col-md-7 col-xs-12">
              <option value="" selected disabled>--- Pilih Status Tempat Tinggal ---</option>
              <?php 
                $data_tempattinggal = $this->main_model->get_all_TabelPendukung("9","0","")->result();
                foreach ($data_tempattinggal as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['status_tempattinggal'] != $hasil->id_tempattinggal){ ?>
                  <option value="<?= $hasil->id_tempattinggal?>"><?= $hasil->nama_tempattinggal?></option>
                <?php }else{ ?>
                  <?php $data_tempattinggal_pilih = $this->main_model->get_all_TabelPendukung("9","1",$data_pengguna[0]['status_tempattinggal'])->result_array(); ?>
                  <option value="<?= $data_tempattinggal_pilih[0]['id_tempattinggal']?>" selected><?= $data_tempattinggal_pilih[0]['nama_tempattinggal']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputJarakRumah">Jarak Rumah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputJarakRumah" id="inputJarakRumah" class="form-control col-md-7 col-xs-12">
              <option value="" selected disabled>--- Pilih Jarak Rumah ---</option>
              <?php 
                $data_jarakrumah = $this->main_model->get_all_TabelPendukung("10","0","")->result();
                foreach ($data_jarakrumah as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['jarakrumah'] != $hasil->id_jarakrumah){ ?>
                  <option value="<?= $hasil->id_jarakrumah?>"><?= $hasil->nama_jarakrumah?></option>
                <?php }else{ ?>
                  <?php $data_jarakrumah_pilih = $this->main_model->get_all_TabelPendukung("10","1",$data_pengguna[0]['jarakrumah'])->result_array(); ?>
                  <option value="<?= $data_jarakrumah_pilih[0]['id_jarakrumah']?>" selected><?= $data_jarakrumah_pilih[0]['nama_jarakrumah']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTransportasi">Transportasi <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputTransportasi" id="inputTransportasi" class="form-control col-md-7 col-xs-12">
              <option value="" selected disabled>--- Pilih Transportasi ---</option>
              <?php 
                $data_transportasi = $this->main_model->get_all_TabelPendukung("11","0","")->result();
                foreach ($data_transportasi as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['transportasi'] != $hasil->id_transportasi){ ?>
                  <option value="<?= $hasil->id_transportasi?>"><?= $hasil->nama_transportasi?></option>
                <?php }else{ ?>
                  <?php $data_transportasi_pilih = $this->main_model->get_all_TabelPendukung("11","1",$data_pengguna[0]['transportasi'])->result_array(); ?>
                  <option value="<?= $data_transportasi_pilih[0]['id_transportasi']?>" selected><?= $data_transportasi_pilih[0]['nama_transportasi']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputAlamatOrangTua">Alamat Orang Tua</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <textarea id="inputAlamatOrangTua" name="inputAlamatOrangTua" class="form-control col-md-7 col-xs-12" placeholder="input Alamat Orang Tua" onfocus="(this.value=='<?= $data_pengguna[0]['alamat_orangtua'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['alamat_orangtua'];?>')"><?= $data_pengguna[0]['alamat_orangtua'];?></textarea>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputProvinsi">Provinsi <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputProvinsi" id="inputProvinsi" class="form-control col-md-7 col-xs-12 inputProvinsi" required>
              <option value="" selected disabled>--- Pilih Provinsi ---</option>
              <?php 
                $data_provinsi = $this->main_model->get_all_provinsi()->result();
                foreach ($data_provinsi as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['provinsi'] != $hasil->kode){ ?>
                  <option value="<?= $hasil->kode?>"><?= $hasil->nama?></option>
                <?php }else{ ?>
                  <?php $data_provinsi_pilih = $this->main_model->get_all_lokasi($data_pengguna[0]['provinsi'])->result_array(); ?>
                  <option value="<?= $data_provinsi_pilih[0]['kode']?>" selected><?= $data_provinsi_pilih[0]['nama']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKabKot">Kabupaten / Kota <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputKabKot" id="inputKabKot" class="form-control col-md-7 col-xs-12 inputKabKot" required>
              <option value="" selected disabled>--- Pilih Kabupaten / Kota ---</option>
              <?php 
                $kabkot = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'];
                $data_kabkot = $this->main_model->get_all_kabkotkecdeskel($data_pengguna[0]['provinsi'])->result();
                foreach ($data_kabkot as $hasil) { 
              ?>
                <?php if($kabkot != $hasil->kode){ ?>
                  <option value="<?= $hasil->kode?>"><?= $hasil->nama?></option>
                <?php }else{ ?>
                  <?php $data_kabkot_pilih = $this->main_model->get_all_lokasi($kabkot)->result_array(); ?>
                  <option value="<?= $data_kabkot_pilih[0]['kode']?>" selected><?= $data_kabkot_pilih[0]['nama']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKec">Kecamatan <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputKec" id="inputKec" class="form-control col-md-7 col-xs-12 inputKec" required>
              <option value="" selected disabled>--- Pilih Kecamatan ---</option>
              <?php 
                $kabkot = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'];
                $data_kec = $this->main_model->get_all_kabkotkecdeskel($kabkot)->result();
                $kec = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'].".".$data_pengguna[0]['kec'];
                foreach ($data_kec as $hasil) { 
              ?>
                <?php if($kec != $hasil->kode){ ?>
                  <option value="<?= $hasil->kode?>"><?= $hasil->nama?></option>
                <?php }else{ ?>
                  <?php $data_kec_pilih = $this->main_model->get_all_lokasi($kec)->result_array(); ?>
                  <option value="<?= $data_kec_pilih[0]['kode']?>" selected><?= $data_kec_pilih[0]['nama']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputDesKel">Desa / Kelurahan <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputDesKel" id="inputDesKel" class="form-control col-md-7 col-xs-12 inputDesKel" required>
              <option value="" selected disabled>--- Pilih Desa / Kelurahan ---</option>
              <?php 
                $kec = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'].".".$data_pengguna[0]['kec'];
                $data_deskel = $this->main_model->get_all_kabkotkecdeskel($kec)->result();
                $deskel = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'].".".$data_pengguna[0]['kec'].".".$data_pengguna[0]['deskel'];
                foreach ($data_deskel as $hasil) { 
              ?>
                <?php if($deskel != $hasil->kode){ ?>
                  <option value="<?= $hasil->kode?>"><?= $hasil->nama?></option>
                <?php }else{ ?>
                  <?php $data_deskel_pilih = $this->main_model->get_all_lokasi($deskel)->result_array(); ?>
                  <option value="<?= $data_deskel_pilih[0]['kode']?>" selected><?= $data_deskel_pilih[0]['nama']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKodePos">Kode Pos <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12 kodepos" id="kodepos">
            <input id="inputKodePos" class="form-control col-md-7 col-xs-12 inputKodePos" name="inputKodePos" value="<?= $data_pengguna[0]['kodepos'];?>" placeholder="input Kode Pos" type="text" readonly>
          </div>
        </div>
        <div class="item form-group"><div class="col-md-12 col-sm-6 col-xs-12"><center><h4><b>Data Ayah</b></h4><br><input type="checkbox" name="dataAyah" id="dataAyah" class="dataAyah" value="Ayah"> Aktifkan Data Ayah</center></div></div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNIKAyah">NIK Ayah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNIKAyah" class="form-control col-md-7 col-xs-12 inputNIKAyah" name="inputNIKAyah" placeholder="input NIK Ayah" type="text" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nik_ayah'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nik_ayah'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nik_ayah'];?>')" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNamaAyah">Nama Ayah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNamaAyah" class="form-control col-md-7 col-xs-12 inputNamaAyah" name="inputNamaAyah" placeholder="input Nama Ayah" type="text" value="<?= $data_pengguna[0]['nama_ayah'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nama_ayah'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nama_ayah'];?>')" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusAyah">Status Ayah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputStatusAyah" id="inputStatusAyah" class="form-control col-md-7 col-xs-12 inputStatusAyah" disabled>
              <option value="" <?php if($data_pengguna[0]['status_ayah'] == 0){echo "selected";} ?> disabled>--- Pilih Status Ayah ---</option>
              <option value="1" <?php if($data_pengguna[0]['status_ayah'] == 1){echo "selected";} ?>>Masih Hidup</option>
              <option value="2" <?php if($data_pengguna[0]['status_ayah'] == 2){echo "selected";} ?>>Sudah Mati</option>
              <option value="3" <?php if($data_pengguna[0]['status_ayah'] == 3){echo "selected";} ?>>Tidak Diketahui</option>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTahunAyah">Tahun Ayah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputTahunAyah" class="form-control col-md-7 col-xs-12 inputTahunAyah" name="inputTahunAyah" placeholder="input Tahun Ayah" type="text" value="<?= $data_pengguna[0]['thn_lahir_ayah'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['thn_lahir_ayah'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['thn_lahir_ayah'];?>')" maxLength="4" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPendidikanAyah">Pendidikan Ayah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputPendidikanAyah" id="inputPendidikanAyah" class="form-control col-md-7 col-xs-12 inputPendidikanAyah" disabled>
              <option value="" selected disabled>--- Pilih Pendidikan Ayah ---</option>
              <?php 
                $data_pendidikan = $this->main_model->get_all_TabelPendukung("1","0","")->result();
                foreach ($data_pendidikan as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['pendidikan_ayah'] != $hasil->id_pendidikan){ ?>
                  <option value="<?= $hasil->id_pendidikan?>"><?= $hasil->nama_pendidikan?></option>
                <?php }else{ ?>
                  <?php $data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_ayah'])->result_array(); ?>
                  <option value="<?= $data_pendidikan_pilih[0]['id_pendidikan']?>" selected><?= $data_pendidikan_pilih[0]['nama_pendidikan']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPekerjaanAyah">Pekerjaan Ayah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputPekerjaanAyah" id="inputPekerjaanAyah" class="form-control col-md-7 col-xs-12 inputPekerjaanAyah" disabled>
              <option value="" selected disabled>--- Pilih Pekerjaan Ayah ---</option>
              <?php 
                $data_pekerjaan = $this->main_model->get_all_TabelPendukung("7","0","")->result();
                foreach ($data_pekerjaan as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['pekerjaan_ayah'] != $hasil->id_pekerjaan){ ?>
                  <option value="<?= $hasil->id_pekerjaan?>"><?= $hasil->nama_pekerjaan?></option>
                <?php }else{ ?>
                  <?php $data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_ayah'])->result_array(); ?>
                  <option value="<?= $data_pekerjaan_pilih[0]['id_pekerjaan']?>" selected><?= $data_pekerjaan_pilih[0]['nama_pekerjaan']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTelpAyah">Telepon Ayah <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputTelpAyah" class="form-control col-md-7 col-xs-12 inputTelpAyah" name="inputTelpAyah" placeholder="input Telepon Ayah" type="text" maxLength="15" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nohp_ayah'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nohp_ayah'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nohp_ayah'];?>')" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group"><div class="col-md-12 col-sm-6 col-xs-12"><center><h4><b>Data Ibu</b></h4><br><input type="checkbox" name="dataIbu" id="dataIbu" class="dataIbu" value="Ibu"> Aktifkan Data Ibu</center></div></div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNIKIbu">NIK Ibu <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNIKIbu" class="form-control col-md-7 col-xs-12 inputNIKIbu" name="inputNIKIbu" placeholder="input NIK Ibu" type="text" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nik_ibu'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nik_ibu'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nik_ibu'];?>')" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNamaIbu">Nama Ibu <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNamaIbu" class="form-control col-md-7 col-xs-12 inputNamaIbu" name="inputNamaIbu" placeholder="input Nama Ibu" type="text" value="<?= $data_pengguna[0]['nama_ibu'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nama_ibu'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nama_ibu'];?>')" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusIbu">Status Ibu <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputStatusIbu" id="inputStatusIbu" class="form-control col-md-7 col-xs-12 inputStatusIbu" disabled>
              <option value="" <?php if($data_pengguna[0]['status_ibu'] == 0){echo "selected";} ?> disabled>--- Pilih Status Ibu ---</option>
              <option value="1" <?php if($data_pengguna[0]['status_ibu'] == 1){echo "selected";} ?>>Masih Hidup</option>
              <option value="2" <?php if($data_pengguna[0]['status_ibu'] == 2){echo "selected";} ?>>Sudah Mati</option>
              <option value="3" <?php if($data_pengguna[0]['status_ibu'] == 3){echo "selected";} ?>>Tidak Diketahui</option>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTahunIbu">Tahun Ibu <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputTahunIbu" class="form-control col-md-7 col-xs-12 inputTahunIbu" name="inputTahunIbu" placeholder="input Tahun Ibu" type="text" value="<?= $data_pengguna[0]['thn_lahir_ibu'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['thn_lahir_ibu'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['thn_lahir_ibu'];?>')" maxLength="4" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPendidikanIbu">Pendidikan Ibu <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputPendidikanIbu" id="inputPendidikanIbu" class="form-control col-md-7 col-xs-12 inputPendidikanIbu" disabled>
              <option value="" selected disabled>--- Pilih Pendidikan Ibu ---</option>
              <?php 
                $data_pendidikan = $this->main_model->get_all_TabelPendukung("1","0","")->result();
                foreach ($data_pendidikan as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['pendidikan_ibu'] != $hasil->id_pendidikan){ ?>
                  <option value="<?= $hasil->id_pendidikan?>"><?= $hasil->nama_pendidikan?></option>
                <?php }else{ ?>
                  <?php $data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_ibu'])->result_array(); ?>
                  <option value="<?= $data_pendidikan_pilih[0]['id_pendidikan']?>" selected><?= $data_pendidikan_pilih[0]['nama_pendidikan']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPekerjaanIbu">Pekerjaan Ibu <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputPekerjaanIbu" id="inputPekerjaanIbu" class="form-control col-md-7 col-xs-12 inputPekerjaanIbu" disabled>
              <option value="" selected disabled>--- Pilih Pekerjaan Ibu ---</option>
              <?php 
                $data_pekerjaan = $this->main_model->get_all_TabelPendukung("7","0","")->result();
                foreach ($data_pekerjaan as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['pekerjaan_ibu'] != $hasil->id_pekerjaan){ ?>
                  <option value="<?= $hasil->id_pekerjaan?>"><?= $hasil->nama_pekerjaan?></option>
                <?php }else{ ?>
                  <?php $data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_ibu'])->result_array(); ?>
                  <option value="<?= $data_pekerjaan_pilih[0]['id_pekerjaan']?>" selected><?= $data_pekerjaan_pilih[0]['nama_pekerjaan']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTelpIbu">Telepon Ibu <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputTelpIbu" class="form-control col-md-7 col-xs-12 inputTelpIbu" name="inputTelpIbu" placeholder="input Telepon Ibu" type="text" maxLength="15" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nohp_ibu'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nohp_ibu'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nohp_ibu'];?>')" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group"><div class="col-md-12 col-sm-6 col-xs-12"><center><h4><b>Data Wali</b></h4><br><input type="checkbox" name="dataWali" id="dataWali" class="dataWali" value="Wali"> Aktifkan Data Wali</center></div></div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNIKWali">NIK Wali <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNIKWali" class="form-control col-md-7 col-xs-12 inputNIKWali" name="inputNIKWali" placeholder="input NIK Wali" type="text" maxLength="25" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nik_wali'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nik_wali'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nik_wali'];?>')" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNamaWali">Nama Wali <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputNamaWali" class="form-control col-md-7 col-xs-12 inputNamaWali" name="inputNamaWali" placeholder="input Nama Wali" type="text" value="<?= $data_pengguna[0]['nama_wali'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nama_wali'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nama_wali'];?>')" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputStatusWali">Status Wali <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputStatusWali" id="inputStatusWali" class="form-control col-md-7 col-xs-12 inputStatusWali" disabled>
              <option value="" <?php if($data_pengguna[0]['status_wali'] == 0){echo "selected";} ?> disabled>--- Pilih Status Wali ---</option>
              <option value="1" <?php if($data_pengguna[0]['status_wali'] == 1){echo "selected";} ?>>Masih Hidup</option>
              <option value="2" <?php if($data_pengguna[0]['status_wali'] == 2){echo "selected";} ?>>Sudah Mati</option>
              <option value="3" <?php if($data_pengguna[0]['status_wali'] == 3){echo "selected";} ?>>Tidak Diketahui</option>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTahunWali">Tahun Wali <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputTahunWali" class="form-control col-md-7 col-xs-12 inputTahunWali" name="inputTahunWali" placeholder="input Tahun Wali" type="text" value="<?= $data_pengguna[0]['thn_lahir_wali'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['thn_lahir_wali'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['thn_lahir_wali'];?>')" maxLength="4" onkeyup="validAngkatelp(this)" autocomplete="off" disabled>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPendidikanWali">Pendidikan Wali <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputPendidikanWali" id="inputPendidikanWali" class="form-control col-md-7 col-xs-12 inputPendidikanWali" disabled>
              <option value="" selected disabled>--- Pilih Pendidikan Wali ---</option>
              <?php 
                $data_pendidikan = $this->main_model->get_all_TabelPendukung("1","0","")->result();
                foreach ($data_pendidikan as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['pendidikan_wali'] != $hasil->id_pendidikan){ ?>
                  <option value="<?= $hasil->id_pendidikan?>"><?= $hasil->nama_pendidikan?></option>
                <?php }else{ ?>
                  <?php $data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_wali'])->result_array(); ?>
                  <option value="<?= $data_pendidikan_pilih[0]['id_pendidikan']?>" selected><?= $data_pendidikan_pilih[0]['nama_pendidikan']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputPekerjaanWali">Pekerjaan Wali <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">
            <select name="inputPekerjaanWali" id="inputPekerjaanWali" class="form-control col-md-7 col-xs-12 inputPekerjaanWali" disabled>
              <option value="" selected disabled>--- Pilih Pekerjaan Wali ---</option>
              <?php 
                $data_pekerjaan = $this->main_model->get_all_TabelPendukung("7","0","")->result();
                foreach ($data_pekerjaan as $hasil) { 
              ?>
                <?php if($data_pengguna[0]['pekerjaan_wali'] != $hasil->id_pekerjaan){ ?>
                  <option value="<?= $hasil->id_pekerjaan?>"><?= $hasil->nama_pekerjaan?></option>
                <?php }else{ ?>
                  <?php $data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_wali'])->result_array(); ?>
                  <option value="<?= $data_pekerjaan_pilih[0]['id_pekerjaan']?>" selected><?= $data_pekerjaan_pilih[0]['nama_pekerjaan']?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputTelpWali">Telepon Wali <span class="required"></span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputTelpWali" class="form-control col-md-7 col-xs-12 inputTelpWali" name="inputTelpWali" placeholder="input Telepon Wali" type="text" maxLength="15" onkeyup="validAngkatelp(this)" value="<?= $data_pengguna[0]['nohp_wali'];?>" onfocus="(this.value=='<?= $data_pengguna[0]['nohp_wali'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_pengguna[0]['nohp_wali'];?>')" autocomplete="off" disabled>
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
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="<?= base_url('assets/')?>jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    // ambil data kabupaten ketika data memilih provinsi
    $(".inputProvinsi").change(function (){
      var url = "<?php echo base_url('Main/add_ajax_kab');?>/"+$(this).val();
      $('.inputKabKot').load(url);
      return false;
    });

    $(".inputKabKot").change(function (){
      var url = "<?php echo site_url('Main/add_ajax_kec');?>/"+$(this).val();
      $('.inputKec').load(url);
      return false;
    });

    $(".inputKec").change(function (){
      var url = "<?php echo site_url('Main/add_ajax_des');?>/"+$(this).val();
      $('.inputDesKel').load(url);
      return false;
    });

    $(".inputPassword").mouseenter(function(){
      $(".muncul").show();
    });

    $(".inputPassword").mouseleave(function(){
      $(".muncul").hide();
    });

    $(".inputDesKel").change(function(){
      var kode = $(".inputDesKel").val();
      console.log(kode);
      $.ajax({
        url : base_url + "Main/GetKodePos",
        method : "GET",
        data : {kode:kode},
        async : false,
        dataType : 'json',
        success: function(data){
            var html = '';
            html = '<input id="inputKodePos" class="form-control col-md-7 col-xs-12" name="inputKodePos" value="'+data.kode_pos+'" type="text" readonly>';

            $('.kodepos').html(html);
        }
      });
    });

    $(".dataAyah").click(function () {
      if ($(this).is(":checked")) {
        $(".inputNIKAyah").removeAttr("disabled");
        $(".inputNamaAyah").removeAttr("disabled");
        $(".inputStatusAyah").removeAttr("disabled");
        $(".inputTahunAyah").removeAttr("disabled");
        $(".inputPendidikanAyah").removeAttr("disabled");
        $(".inputPekerjaanAyah").removeAttr("disabled");
        $(".inputTelpAyah").removeAttr("disabled");
        // $(".inputNIKAyah").focus();
      } else {
        $(".inputNIKAyah").attr("disabled", "disabled");
        $(".inputNamaAyah").attr("disabled", "disabled");
        $(".inputStatusAyah").attr("disabled", "disabled");
        $(".inputTahunAyah").attr("disabled", "disabled");
        $(".inputPendidikanAyah").attr("disabled", "disabled");
        $(".inputPekerjaanAyah").attr("disabled", "disabled");
        $(".inputTelpAyah").attr("disabled", "disabled");
      }
    });

    $(".dataIbu").click(function () {
      if ($(this).is(":checked")) {
        $(".inputNIKIbu").removeAttr("disabled");
        $(".inputNamaIbu").removeAttr("disabled");
        $(".inputStatusIbu").removeAttr("disabled");
        $(".inputTahunIbu").removeAttr("disabled");
        $(".inputPendidikanIbu").removeAttr("disabled");
        $(".inputPekerjaanIbu").removeAttr("disabled");
        $(".inputTelpIbu").removeAttr("disabled");
        // $(".inputNIKIbu").focus();
      } else {
        $(".inputNIKIbu").attr("disabled", "disabled");
        $(".inputNamaIbu").attr("disabled", "disabled");
        $(".inputStatusIbu").attr("disabled", "disabled");
        $(".inputTahunIbu").attr("disabled", "disabled");
        $(".inputPendidikanIbu").attr("disabled", "disabled");
        $(".inputPekerjaanIbu").attr("disabled", "disabled");
        $(".inputTelpIbu").attr("disabled", "disabled");
      }
    });

    $(".dataWali").click(function () {
      if ($(this).is(":checked")) {
        $(".inputNIKWali").removeAttr("disabled");
        $(".inputNamaWali").removeAttr("disabled");
        $(".inputStatusWali").removeAttr("disabled");
        $(".inputTahunWali").removeAttr("disabled");
        $(".inputPendidikanWali").removeAttr("disabled");
        $(".inputPekerjaanWali").removeAttr("disabled");
        $(".inputTelpWali").removeAttr("disabled");
        // $(".inputNIKWali").focus();
      } else {
        $(".inputNIKWali").attr("disabled", "disabled");
        $(".inputNamaWali").attr("disabled", "disabled");
        $(".inputStatusWali").attr("disabled", "disabled");
        $(".inputTahunWali").attr("disabled", "disabled");
        $(".inputPendidikanWali").attr("disabled", "disabled");
        $(".inputPekerjaanWali").attr("disabled", "disabled");
        $(".inputTelpWali").attr("disabled", "disabled");
      }
    });
  });
</script>