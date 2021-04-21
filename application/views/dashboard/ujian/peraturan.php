<div class="right_col" role="main">
  <div id="timer"></div>
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
            <h4>Kerjakan Yang mudah dulu, Jangan menyontek yaa !!!</h4>
            <a href="<?= base_url('kerjakan_ujian/').$id_mapel.'/'.$id_kelas.'/'.$id_guru.'/'.$id_siswa?>" class="btn btn-primary btn-md">Mulai Mengerjakan</a>
            <a href="<?= base_url('dashboard')?>" class="btn btn-success btn-md">Kembali Ke Halaman Utama</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>