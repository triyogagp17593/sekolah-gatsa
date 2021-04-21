<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">DETAIL DATA HASIL UJIAN ONLINE SISWA</h4>
    </div>
    <div class="modal-body">
      <div align="center">
        <?php if(!empty($data_hasil_ujian[0]['foto_siswa'])){ ?>
          <img src="<?= base_url('assets/images/foto_siswa_user/').$data_hasil_ujian[0]['foto_siswa'];?>" style="border-radius: 20px;" width="25%" title="<?= $data_hasil_ujian[0]['nama']?>">
        <?php }else{ ?>
          <img src="<?= base_url('assets/images/user.png');?>" style="border-radius: 20px;" width="25%" title="Tidak ada Foto">
        <?php } ?>
      </div>
      
      <hr>
      <table width="100%">
        <tr>
          <td width="30%">Nomor Induk Siswa</td>
          <td>: <?= $data_hasil_ujian[0]['nisn']?></td>
        </tr>
        <tr>
          <td width="30%">Nama Lengkap</td>
          <td>: <?= $data_hasil_ujian[0]['nama_siswa']?></td>
        </tr>
      </table>
      <hr>
      <table width="100%">
        <tr>
          <td width="30%">Nomor Induk Pegawai</td>
          <td>: <?= $data_hasil_ujian[0]['nip']?></td>
        </tr>
        <tr>
          <td width="30%">Nama Lengkap</td>
          <td>: <?= $data_hasil_ujian[0]['nama_guru']?></td>
        </tr>
        <tr>
          <td width="30%">Nama Mata Pelajaran</td>
          <td>: <?= $data_hasil_ujian[0]['nama_mapel']?></td>
        </tr>
        <tr>
          <td width="30%">kelas</td>
          <td>: <?= $data_hasil_ujian[0]['romawi_kelas'].'-'.$data_hasil_ujian[0]['angka_kelas']?></td>
        </tr>
        <tr>
          <td width="30%">Jawaban Benar</td>
          <td>: <?= $data_hasil_ujian[0]['jawaban_benar']?></td>
        </tr>
        <tr>
          <td width="30%">Jawaban Salah</td>
          <td>: <?= $data_hasil_ujian[0]['jawaban_salah']?></td>
        </tr>
        <tr>
          <td width="30%">Tidak Menjawab</td>
          <td>: <?= $data_hasil_ujian[0]['jawaban_kosong']?></td>
        </tr>
        <tr>
          <td width="30%">Nilai Ujian Online</td>
          <td>: <?= $data_hasil_ujian[0]['nilai']?></td>
        </tr>
      </table>
    </div>
  </div>
</div>