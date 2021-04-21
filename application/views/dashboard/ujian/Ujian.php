<?php error_reporting(0);?>
<script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
<?php 
  $mulai = $this->session->userdata('waktu_sekarang');
  $selesai=$data_jadwal[0]['waktu_selesai'];
  $mulai_time=(is_string($mulai)?strtotime($mulai):$mulai);
  $selesai_time=(is_string($selesai)?strtotime($selesai):$selesai);
  $detik_itung=$selesai_time-$mulai_time;
  $menit_itung=floor($detik_itung/60);
  $sisa_detik=$detik_itung%$menit_itung;
  // echo $menit_itung;
  if($menit_itung < 60){ 
    $menit = $menit_itung; 
    $jam = 0; 
  }else{ 
    $menit = $menit_itung%60;
    $jam = (int)($menit_itung/60); //dijadikan integer
  }
?>
<div class="right_col" role="main">
  <!-- <div class="clearfix"></div> -->
  <div class="row" style="margin-top: 100px;">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Profile Siswa</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div align="center">
              <?php if(!empty($data_pengguna[0]['gambar'])){ ?>
                <img src="<?= base_url('assets/images/gambar_user/').$data_pengguna[0]['gambar'];?>" style="border-radius: 20px;" width="80%" title="<?= $data_pengguna[0]['nama']?>">
              <?php }else{ ?>
                <img src="<?= base_url('assets/images/user.png');?>" width="80%" style="border-radius: 20px;" title="Tidak ada Foto">
              <?php } ?>
              <br><br>
              <a href="<?= base_url('logout')?>" class="btn btn-danger btn-xs logout"> Logout Panel</a>
            </div>
          </div>
          <div class="col-md-9 col-sm-3 col-xs-12">
            <table width="100%">
              <tr>
                <td width="30%">Nomor Induk Siswa</td>
                <td>: <?= $data_pengguna[0]['nomor_induk']?></td>
              </tr>
              <tr>
                <td width="30%">Nama Lengkap</td>
                <td>: <?= $data_pengguna[0]['nama'] ?></td>
              </tr>
              <tr>
                <td width="30%">Email</td>
                <td>: <?= $data_pengguna[0]['email']?></td>
              </tr>
              <tr>
                <td width="30%">Username</td>
                <td>: <?= $data_pengguna[0]['username']?></td>
              </tr>
              <tr>
                <td width="30%">Kata Sandi</td>
                <td>: <?= $data_pengguna[0]['password']." (".$data_pengguna[0]['katasandi'].")";?></td>
              </tr>
              <tr>
                <td width="30%">Tempat, Tanggal Lahir</td>
                <td>: <?php if(empty($data_pengguna[0]['tempat'])){echo"-";}else{echo $data_pengguna[0]['tempat'];} ?>, <?php if($data_pengguna[0]['tgl_lahir'] == "0000-00-00"){echo"-";}else{echo date('d M Y',strtotime($data_pengguna[0]['tgl_lahir']));} ?></td>
              </tr>
              <tr>
                <td width="30%">Jenis Kelamin</td>
                <td>: <?php if($data_pengguna[0]['jk'] == 1){echo "Laki-Laki";}else{echo "Perempuan";} ?></td>
              </tr>
              <tr>
                <td width="30%">Agama</td>
                <td>: Islam</td>
              </tr>
              <tr>
                <td width="30%">Telepon</td>
                <td>: <?= $data_pengguna[0]['telp']?></td>
              </tr>
              <tr>
                <td width="30%">Alamat</td>
                <td>: <?php if(!empty($data_pengguna[0]['alamat'])){echo $data_pengguna[0]['alamat'];}else{echo "-";} ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>LAMPIRAN UJIAN ONLINE</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-12 col-sm-3 col-xs-12">
            <table width="100%">
              <tr>
                <td width="30%">Mata Pelajaran</td>
                <td>: <?= $data_ngajar[0]['nama_mapel']?></td>
              </tr>
              <tr>
                <td width="30%">Guru</td>
                <td>: <?= $data_ngajar[0]['nama']?></td>
              </tr>
              <tr>
                <td width="30%">Kelas</td>
                <td>: <?= $data_ngajar[0]['romawi_kelas'].'-'.$data_ngajar[0]['angka_kelas']?></td>
              </tr>
              <tr>
                <td width="30%">Hari/Tanggal</td>
                <td>: <?= $data_jadwal[0]['hari'].', '.date('d M Y',strtotime($data_jadwal[0]['waktu_mulai']))?></td>
              </tr>
              <tr>
                <td width="30%">Waktu Ujian</td>
                <td>: <?= date('H:i',strtotime($data_jadwal[0]['waktu_mulai'])).' s/d '.date('H:i',strtotime($data_jadwal[0]['waktu_selesai'])).' ('.$data_jadwal[0]['waktu'].' menit)'?></td>
              </tr>
              <tr>
                <td width="30%">Jenis Soal</td>
                <td>: 50 Soal Pilihan Ganda</td>
              </tr>
            </table>
            <h4>Kerjakan dengan jujur dan baik.<br>Pilih lah jawaban yang paling benar !!!</h4>
            <hr style="border-style: dotted;border-width: 2px;">
            <form action="<?= base_url('penilaian');?>" method="post" id="frmSoal" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <?php 
                $no=1;
                $soal_pg = $this->main_model->get_all_soal_pgBy2($id_mapel)->result(); 
                foreach ($soal_pg as $value) {
                  $_pertanyaan = strip_tags($value->pertanyaan,'<img><div>');
                  $_a = strip_tags($value->pilihanA,'');
                  $_b = strip_tags($value->pilihanB,'');
                  $_c = strip_tags($value->pilihanC,'');
                  $_d = strip_tags($value->pilihanD,'');
                  if($value->pertanyaan=="<p>.</p>"){ $pertanyaan=""; }else{ $pertanyaan=$_pertanyaan; }
                  if($value->pilihanA=="<p>.</p>"){ $pilihanA=""; }else{ $pilihanA=$_a; }
                  if($value->pilihanB=="<p>.</p>"){ $pilihanB=""; }else{ $pilihanB=$_b; }
                  if($value->pilihanC=="<p>.</p>"){ $pilihanC=""; }else{ $pilihanC=$_c; }
                  if($value->pilihanD=="<p>.</p>"){ $pilihanD=""; }else{ $pilihanD=$_d; }
              ?>
                <input type="hidden" name="mapel_id" id="mapel_id" value="<?= $id_mapel?>">
                <input type="hidden" name="kelas_id" id="kelas_id" value="<?= $id_kelas?>">
                <input type="hidden" name="guru_id" id="guru_id" value="<?= $id_guru?>">
                <input type="hidden" name="siswa_id" id="siswa_id" value="<?= $id_siswa?>">
                <?= $no++.'. '.$pertanyaan?><br>
                <input type="radio" name="jawaban[<?= $value->id_soal?>]" value="A"> <?= $pilihanA?><br>
                <input type="radio" name="jawaban[<?= $value->id_soal?>]" value="B"> <?= $pilihanB?><br>
                <input type="radio" name="jawaban[<?= $value->id_soal?>]" value="C"> <?= $pilihanC?><br>
                <input type="radio" name="jawaban[<?= $value->id_soal?>]" value="D"> <?= $pilihanD?><br><br>
              <?php } ?>
              <button type="submit" class="btn btn-success btn-md"><span class="fa fa-check"></span>&nbsp;Simpan Jawaban</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var detik = 0;
    var menit = <?=$menit?>;
    var jam   = <?=$jam?>;
    // var hari  = 2;
    console.log(menit);

    function updateWaktu(){
      <?php 
        date_default_timezone_set("Asia/Jakarta");
        $tgl = date("Y-m-d H:i:s");
        $this->session->set_userdata('waktu_sekarang',$tgl);
      ?>
    }

    function hitung() {
      setTimeout(hitung,1000);
      setTimeout(updateWaktu,1000);
      if(menit < 10 && jam == 0){
          var peringatan = 'style="color:red"';
      };
      
      $('#timer').html(
        '<h2 align="center"'+peringatan+'> WAKTU MENGERJAKAN UJIAN ONLINE<br>' + jam + ' jam : ' + menit + ' menit : ' + detik + ' detik</h2>'
      );
      detik --;
      if(detik < 0) {
        detik = 59;
        menit --;
        
        if(menit < 0) {
          menit = 59;
          jam --;

          if(jam < 0) { 
            clearInterval(); 
            var frmSoal = document.getElementById("frmSoal"); 
            frmSoal.submit();
          } 
        } 
      } 
    }           
    hitung(); 
    updateWaktu();

    function my_onkeydown_handler( event ) {
    switch (event.keyCode) {
      case 116 : // 'F5'
        event.preventDefault();
        event.keyCode = 0;
        window.status = "F5 disabled";
        break;
      }
    }
    document.addEventListener("keydown", my_onkeydown_handler);
  }); 
</script>