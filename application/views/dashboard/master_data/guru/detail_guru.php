<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">DETAIL DATA GURU / STAFF</h4>
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
          <td width="30%">NIP / NIGNP</td>
          <td>: <?php if(empty($data_pengguna[0]['nomor_induk'])){echo"-";}else{echo $data_pengguna[0]['nomor_induk'];} ?></td>
        </tr>
        <tr>
          <td width="30%">NUPTK / ID</td>
          <td>: <?php if(empty($data_pengguna[0]['nuptk'])){echo"-";}else{echo $data_pengguna[0]['nuptk'];} ?></td>
        </tr>
        <tr>
          <td width="30%">NRG</td>
          <td>: <?php if(empty($data_pengguna[0]['nrg'])){echo"-";}else{echo $data_pengguna[0]['nrg'];} ?></td>
        </tr>
        <tr>
          <td width="30%">GTY / GTT</td>
          <td>: <?php if($data_pengguna[0]['gty_gtt'] == 0){echo "GTY";}else{echo "PNS";} ?></td>
        </tr>
        <tr>
          <td width="30%">GOLONGAN</td>
          <td>: <?php if(empty($data_pengguna[0]['gol'])){echo"-";}else{echo $data_pengguna[0]['gol'];} ?></td>
        </tr>
        <tr>
          <td width="30%">NIPY</td>
          <td>: <?php if(empty($data_pengguna[0]['nipy'])){echo"-";}else{echo $data_pengguna[0]['nipy'];} ?></td>
        </tr>
        <tr>
          <td width="30%">TMT</td>
          <td>: <?php if($data_pengguna[0]['tmt'] == "0000-00-00"){echo"-";}else{echo date('d M Y',strtotime($data_pengguna[0]['tmt']));} ?></td>
        </tr>
        <tr>
          <td width="30%">Nama Lengkap</td>
          <td>: <?= $data_pengguna[0]['nama']?></td>
        </tr>
        <tr>
          <td width="30%">Email</td>
          <td>: <?php if(empty($data_pengguna[0]['email'])){echo"-";}else{echo $data_pengguna[0]['email'];} ?></td>
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
          <td width="30%">Jabatan</td>
          <td>: <?php if($data_pengguna[0]['jabatan'] == 0){echo"tidak ada jabatan";}else{$data_jabatan_pilih = $this->main_model->get_all_TabelPendukung("0","1",$data_pengguna[0]['jabatan'])->result_array(); echo $data_jabatan_pilih[0]['nama_jabatan'];}?></td>
        </tr>
        <tr>
          <td width="30%">pendidikan</td>
          <td>: <?php if($data_pengguna[0]['pendidikan'] == 0){echo"tidak ada pendidikan terakhir";}else{$data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan'])->result_array(); echo $data_pendidikan_pilih[0]['nama_pendidikan'];}?></td>
        </tr>
        <tr>
          <td width="30%">Status Pernikahan</td>
          <td>: <?php if($data_pengguna[0]['status_pernikahan'] == 0){echo"tidak ada status pernikahan";}else{$data_status_pernikahan_pilih = $this->main_model->get_all_TabelPendukung("2","1",$data_pengguna[0]['status_pernikahan'])->result_array(); echo $data_status_pernikahan_pilih[0]['status_pernikahan'];}?></td>
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
          <td>: <?php if(empty($data_pengguna[0]['telp'])){echo"-";}else{echo $data_pengguna[0]['telp'];} ?></td>
        </tr>
        <tr>
          <td width="30%">Alamat</td>
          <td>: <?php if(!empty($data_pengguna[0]['alamat'])){echo $data_pengguna[0]['alamat'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="30%">RoleID</td>
          <td>: Guru</td>
        </tr>
        <tr>
          <td width="30%">Mengajar Kelas</td>
          <td>: <b>
            <?php 
              $kelas_ajar = $data_mengajar->result_array(); 
              $jmlkelas_ajar = $data_mengajar->num_rows(); 
              if($jmlkelas_ajar == 0){
                echo "belum memilih kelas yang di ajar";
              }else if($jmlkelas_ajar == 1){
                echo $kelas_ajar[0]['kelas'];
              }else if($jmlkelas_ajar == 2){
                echo $kelas_ajar[0]['kelas']." & ".$kelas_ajar[1]['kelas'];
              }else if($jmlkelas_ajar == 3){
                echo $kelas_ajar[0]['kelas'].", ".$kelas_ajar[1]['kelas'].", ".$kelas_ajar[2]['kelas'];
              }
            ?></b></td>
        </tr>
      </table>
    </div>
  </div>
</div>