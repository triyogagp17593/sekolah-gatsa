<div class="modal-dialog" style="width: 1000px;">
  <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">DETAIL SOAL UJIAN PILIHAN GANDA</h4>
    </div>
    <div class="modal-body">
      <table width="100%">
        <tr>
          <td width="30%">Guru</td>
          <td>: <?= $data_soal_pg[0]['nama']?></td>
        </tr>
        <tr>
          <td width="30%">Mata Pelajaran</td>
          <td>: <?= $data_soal_pg[0]['nama_mapel']?></td>
        </tr>
        <tr>
          <td width="30%">Kelas</td>
          <td>: <?= $data_soal_pg[0]['romawi_kelas']."-".$data_soal_pg[0]['angka_kelas']?></td>
        </tr>
        <tr>
          <td width="30%">Kode Soal</td>
          <td>: <?= $data_soal_pg[0]['kode_soal']?></td>
        </tr>
      </table>
      <hr>
      <b>Pertanyaan :</b> <?= $data_soal_pg[0]['pertanyaan']?>
      <b>Pilihan Jawaban 1 :</b> <?= $data_soal_pg[0]['pilihanA']?>
      <b>Pilihan Jawaban 2 :</b> <?= $data_soal_pg[0]['pilihanB']?>
      <b>Pilihan Jawaban 3 :</b> <?= $data_soal_pg[0]['pilihanC']?>
      <b>Pilihan Jawaban 4 :</b> <?= $data_soal_pg[0]['pilihanD']?>
      <b>Kunci Jawaban :</b> <?= $data_soal_pg[0]['kunci_jawaban']?>
    </div>
  </div>
</div>