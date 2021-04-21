<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">DETAIL DATA SISWA</h4>
    </div>
    <div class="modal-body">
      <div align="center">
        <?php if(!empty($data_pengguna[0]['gambar'])){ ?>
          <img src="<?= base_url('assets/images/gambar_user/').$data_pengguna[0]['gambar'];?>" style="border-radius: 20px;" width="25%" title="<?= $data_pengguna[0]['nama']?>">
        <?php }else{ ?>
          <img src="<?= base_url('assets/images/user.png');?>" style="border-radius: 20px;" width="25%" title="Tidak ada Foto">
        <?php } ?>
      </div>
      <table width="100%">
        <tr>
          <td width="30%">Nomor Induk Siswa</td>
          <td>: <?= $data_pengguna[0]['nomor_induk']?></td>
        </tr>
        <tr>
          <td width="30%">Nama Lengkap</td>
          <td>: <?= $data_pengguna[0]['nama']?></td>
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
        <tr>
          <td width="30%">RoleID</td>
          <td>: Siswa</td>
        </tr>
      </table>
      <hr>
      <?php if($jml_lihat_nilai > 0){ ?>
        <table width="100%">
          <tr>
            <td width="30%">Jawaban Benar</td>
            <td>: <?=$lihat_nilai[0]['jawaban_benar']." Soal";?></td>
          </tr>
          <tr>
            <td width="30%">Jawaban Salah</td>
            <td>: <?=$lihat_nilai[0]['jawaban_salah']." Soal";?></td>
          </tr>
          <tr>
            <td width="30%">Tidak Menjawab</td>
            <td>: <?=$lihat_nilai[0]['jawaban_kosong']." Soal";?></td>
          </tr>
          <tr>
            <td width="30%">Nilai Ujian Online</td>
            <td>: <?=$lihat_nilai[0]['nilai']?></td>
          </tr>
        </table>
      <?php }else{echo "<h4>Belum ada nilai</h4>";} ?>
    </div>
  </div>
</div>