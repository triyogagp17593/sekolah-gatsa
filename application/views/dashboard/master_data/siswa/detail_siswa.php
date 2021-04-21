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
          <td colspan="2"><h4><b>Biodata Siswa</b></h4></td>
        </tr>
        <tr>
          <td width="35%">Nomor Induk Siswa Nasional</td>
          <td>: <?php if(empty($data_pengguna[0]['nisn'])){echo"-";}else{echo $data_pengguna[0]['nisn'];} ?></td>
        </tr>
        <tr>
          <td width="35%">Nomor Induk Siswa</td>
          <td>: <?php if(empty($data_pengguna[0]['nomor_induk'])){echo"-";}else{echo $data_pengguna[0]['nomor_induk'];} ?></td>
        </tr>
        <tr>
          <td width="35%">Nama Lengkap</td>
          <td>: <?= $data_pengguna[0]['nama']?></td>
        </tr>
        <tr>
          <td width="35%">Email</td>
          <td>: <?php if(empty($data_pengguna[0]['email'])){echo"-";}else{echo $data_pengguna[0]['email'];} ?></td>
        </tr>
        <tr>
          <td width="35%">Username</td>
          <td>: <?= $data_pengguna[0]['username']?></td>
        </tr>
        <tr>
          <td width="35%">Kata Sandi</td>
          <td>: <?= $data_pengguna[0]['password']." (".$data_pengguna[0]['katasandi'].")";?></td>
        </tr>
        <tr>
          <td width="35%">Tempat, Tanggal Lahir</td>
          <td>: <?php if(empty($data_pengguna[0]['tempat'])){echo"-";}else{echo $data_pengguna[0]['tempat'];} ?>, <?php if($data_pengguna[0]['tgl_lahir'] == "0000-00-00"){echo"-";}else{echo date('d M Y',strtotime($data_pengguna[0]['tgl_lahir']));} ?></td>
        </tr>
        <tr>
          <td width="35%">Jenis Kelamin</td>
          <td>: <?php if($data_pengguna[0]['jk'] == 1){echo "Laki-Laki";}else{echo "Perempuan";} ?></td>
        </tr>
        <tr>
          <td width="35%">Agama</td>
          <td>: Islam</td>
        </tr>
        <tr>
          <td width="35%">Anak Ke</td>
          <td>: <?= $data_pengguna[0]['anak_ke'] ?></td>
        </tr>
        <tr>
          <td width="35%">Jumlah Saudara</td>
          <td>: <?php if(empty($data_pengguna[0]['jml_saudara'])){echo "-";}else{echo $data_pengguna[0]['jml_saudara']." bersaudara";} ?></td>
        </tr>
        <tr>
          <td width="35%">Hobi</td>
          <td>: <?php if($data_pengguna[0]['hobi'] == 0){echo"tidak ada hobi";}else{$data_hobi_pilih = $this->main_model->get_all_TabelPendukung("5","1",$data_pengguna[0]['hobi'])->result_array(); echo $data_hobi_pilih[0]['nama_hobi'];}?></td>
        </tr>
        <tr>
          <td width="35%">Cita - Cita</td>
          <td>: <?php if($data_pengguna[0]['citacita'] == 0){echo"tidak ada cita - cita";}else{$data_citacita_pilih = $this->main_model->get_all_TabelPendukung("4","1",$data_pengguna[0]['citacita'])->result_array(); echo $data_citacita_pilih[0]['nama_citacita'];}?></td>
        </tr>
        <tr>
          <td width="35%">Telepon</td>
          <td>: <?php if(empty($data_pengguna[0]['telp'])){echo"-";}else{echo $data_pengguna[0]['telp'];} ?></td>
        </tr>
        <tr>
          <td width="35%">Alamat Siswa</td>
          <td>: <?php if(!empty($data_pengguna[0]['alamat'])){echo $data_pengguna[0]['alamat'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Kelas</td>
          <td>: <?php $kelas = $this->main_model->get_all_kelas_siswaBy($data_pengguna[0]['id_login'])->result_array(); if(empty($kelas[0]['id_login'])){$kondisi=1;echo"<b title='Silahkan ambil kelas dahulu !!!'>Belum ambil kelas</b>";}else{$kondisi=2;echo $kelas[0]['romawi_kelas']."-".$kelas[0]['angka_kelas'];} ?></td>
        </tr>
        <tr>
          <td width="35%">RoleID</td>
          <td>: Siswa</td>
        </tr>
        <tr>
          <td colspan="2"><hr style="border: dashed 2px #000;"></td>
        </tr>
        <tr>
          <td colspan="2"><h4><b>Data Asal Sekolah Siswa</b></h4></td>
        </tr>
        <tr>
          <td width="35%">Nomor Peserta UN</td>
          <td>: <?= $data_pengguna[0]['no_un']?></td>
        </tr>
        <tr>
          <td width="35%">Nomor SKHUN</td>
          <td>: <?= $data_pengguna[0]['no_skhun']?></td>
        </tr>
        <tr>
          <td width="35%">Nomor Ijazah</td>
          <td>: <?= $data_pengguna[0]['no_ijazah']?></td>
        </tr>
        <tr>
          <td width="35%">Nama Sekolah</td>
          <td>: <?= $data_pengguna[0]['nama_sekolah']?></td>
        </tr>
        <tr>
          <td width="35%">NPSN</td>
          <td>: <?= $data_pengguna[0]['npsn']?></td>
        </tr>
        <tr>
          <td width="35%">Jenjang Sekolah</td>
          <td>: <?php if($data_pengguna[0]['jenjang'] == 0){echo"tidak ada jenjang sekolah";}else{$data_jenjang_pilih = $this->main_model->get_all_TabelPendukung("6","1",$data_pengguna[0]['jenjang'])->result_array(); echo $data_jenjang_pilih[0]['nama_jenjang'];}?></td>
        </tr>
        <tr>
          <td width="35%">Status Sekolah</td>
          <td>: <?php if($data_pengguna[0]['status_sekolah'] == 0){echo"-";}else if($data_pengguna[0]['status_sekolah'] == 1){echo"Negeri";}else if($data_pengguna[0]['status_sekolah'] == 2){echo"Swasta";}?></td>
        </tr>
        <tr>
          <td width="35%">Lokasi Sekolah</td>
          <td>: <?php $data_kabkot = $this->main_model->get_all_lokasi($data_pengguna[0]['kabkot_asalsekolah'])->result_array(); echo $data_kabkot[0]['nama'];?></td>
        </tr>
        <tr>
          <td width="35%">Alamat Sekolah</td>
          <td>: <?php if(!empty($data_pengguna[0]['alamat_sekolah'])){echo $data_pengguna[0]['alamat_sekolah'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Nilai UN</td>
          <td>: <?= $data_pengguna[0]['no_un']?></td>
        </tr>
        <tr>
          <td width="35%">Tanggal Lulus</td>
          <td>: <?php if($data_pengguna[0]['tgl_lulus'] == "0000-00-00"){echo"-";}else{echo date('d M Y',strtotime($data_pengguna[0]['tgl_lulus']));} ?></td>
        </tr>
        <tr>
          <td colspan="2"><hr style="border: dashed 2px #000;"></td>
        </tr>
        <tr>
          <td colspan="2"><h4><b>Data Orang Tua / Wali Siswa</b></h4></td>
        </tr>
        <tr>
          <td width="35%">Nama Kepala Keluarga</td>
          <td>: <?= $data_pengguna[0]['nama_kk']?></td>
        </tr>
        <tr>
          <td width="35%">Nomor kartu Keluarga</td>
          <td>: <?= $data_pengguna[0]['no_kk']?></td>
        </tr>
        <tr>
          <td width="35%">Penghasilan Rata - Rata</td>
          <td>: <?php if($data_pengguna[0]['penghasilan'] == 0){echo"-";}else{$data_penghasilan_pilih = $this->main_model->get_all_TabelPendukung("8","1",$data_pengguna[0]['penghasilan'])->result_array(); echo $data_penghasilan_pilih[0]['nama_penghasilan'];}?></td>
        </tr>
        <tr>
          <td width="35%">Alamat Orang Tua</td>
          <td>: <?php if(!empty($data_pengguna[0]['alamat_orangtua'])){echo $data_pengguna[0]['alamat_orangtua'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Provinsi</td>
          <td>: <?php $data_provinsi = $this->main_model->get_all_lokasi($data_pengguna[0]['provinsi'])->result_array(); echo $data_provinsi[0]['nama'];?></td>
        </tr>
        <tr>
          <td width="35%">Kabupaten / Kota</td>
          <td>: <?php $kabkot = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot']; $data_kabkot = $this->main_model->get_all_lokasi($kabkot)->result_array(); echo $data_kabkot[0]['nama'];?></td>
        </tr>
        <tr>
          <td width="35%">Kecamatan</td>
          <td>: <?php $kec = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'].".".$data_pengguna[0]['kec']; $data_kec = $this->main_model->get_all_lokasi($kec)->result_array(); echo $data_kec[0]['nama'];?></td>
        </tr>
        <tr>
          <td width="35%">Desa / Kelurahan</td>
          <td>: <?php $deskel = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'].".".$data_pengguna[0]['kec'].".".$data_pengguna[0]['deskel']; $data_deskel = $this->main_model->get_all_lokasi($deskel)->result_array(); echo $data_deskel[0]['nama'];?></td>
        </tr>
        <tr>
          <td width="35%">Kode Pos</td>
          <td>: <?= $data_pengguna[0]['kodepos']?></td>
        </tr>
        <tr>
          <td width="35%">Status Tempat Tinggal</td>
          <td>: <?php if(empty($data_pengguna[0]['status_tempattinggal'])){echo"-";}else{$data_status_tempattinggal_pilih = $this->main_model->get_all_TabelPendukung("9","1",$data_pengguna[0]['status_tempattinggal'])->result_array(); echo $data_status_tempattinggal_pilih[0]['nama_tempattinggal'];}?></td>
        </tr>
        <tr>
          <td width="35%">Jarak Rumah</td>
          <td>: <?php if(empty($data_pengguna[0]['jarakrumah'])){echo"-";}else{$data_jarakrumah_pilih = $this->main_model->get_all_TabelPendukung("10","1",$data_pengguna[0]['jarakrumah'])->result_array(); echo $data_jarakrumah_pilih[0]['nama_jarakrumah'];}?></td>
        </tr>
        <tr>
          <td width="35%">Transportasi</td>
          <td>: <?php if(empty($data_pengguna[0]['transportasi'])){echo"-";}else{$data_transportasi_pilih = $this->main_model->get_all_TabelPendukung("11","1",$data_pengguna[0]['transportasi'])->result_array(); echo $data_transportasi_pilih[0]['nama_transportasi'];}?></td>
        </tr>
        <tr>
          <td colspan="2"><h5><u><b>Data Ayah</b></u></h5></td>
        </tr>
        <tr>
          <td width="35%">Nomor Induk Kependudukan Ayah</td>
          <td>: <?php if(!empty($data_pengguna[0]['nik_ayah'])){echo $data_pengguna[0]['nik_ayah'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Nama Ayah</td>
          <td>: <?php if(!empty($data_pengguna[0]['nama_ayah'])){echo $data_pengguna[0]['nama_ayah'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Status Ayah</td>
          <td>: <?php if(empty($data_pengguna[0]['status_ayah'])){echo "-";}else if($data_pengguna[0]['status_ayah'] == 1){echo "Masih Hidup";}else if($data_pengguna[0]['status_ayah'] == 2){echo "Sudah Mati";}else if($data_pengguna[0]['status_ayah'] == 3){echo "Tidak Diketahui";} ?></td>
        </tr>
        <tr>
          <td width="35%">Tahun Lahir Ayah</td>
          <td>: <?php if(!empty($data_pengguna[0]['thn_lahir_ayah'])){echo $data_pengguna[0]['thn_lahir_ayah'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Pendidikan Ayah</td>
          <td>: <?php if($data_pengguna[0]['pendidikan_ayah'] == 0){echo"-";}else{$data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_ayah'])->result_array(); echo $data_pendidikan_pilih[0]['nama_pendidikan'];}?></td>
        </tr>
        <tr>
          <td width="35%">Pekerjaan Ayah</td>
          <td>: <?php if($data_pengguna[0]['pekerjaan_ayah'] == 0){echo"-";}else{$data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_ayah'])->result_array(); echo $data_pekerjaan_pilih[0]['nama_pekerjaan'];}?></td>
        </tr>
        <tr>
          <td width="35%">No Telepon Ayah</td>
          <td>: <?php if(!empty($data_pengguna[0]['nohp_ayah'])){echo $data_pengguna[0]['nohp_ayah'];}else{echo "-";} ?></td>
        </tr>

        <tr>
          <td colspan="2"><h5><u><b>Data Ibu</b></u></h5></td>
        </tr>
        <tr>
          <td width="35%">Nomor Induk Kependudukan Ibu</td>
          <td>: <?php if(!empty($data_pengguna[0]['nik_ibu'])){echo $data_pengguna[0]['nik_ibu'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Nama Ibu</td>
          <td>: <?php if(!empty($data_pengguna[0]['nama_ibu'])){echo $data_pengguna[0]['nama_ibu'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Status Ibu</td>
          <td>: <?php if(empty($data_pengguna[0]['status_ibu'])){echo "-";}else if($data_pengguna[0]['status_ibu'] == 1){echo "Masih Hidup";}else if($data_pengguna[0]['status_ibu'] == 2){echo "Sudah Mati";}else if($data_pengguna[0]['status_ibu'] == 3){echo "Tidak Diketahui";} ?></td>
        </tr>
        <tr>
          <td width="35%">Tahun Lahir Ibu</td>
          <td>: <?php if(!empty($data_pengguna[0]['thn_lahir_ibu'])){echo $data_pengguna[0]['thn_lahir_ibu'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Pendidikan Ibu</td>
          <td>: <?php if($data_pengguna[0]['pendidikan_ibu'] == 0){echo"-";}else{$data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_ibu'])->result_array(); echo $data_pendidikan_pilih[0]['nama_pendidikan'];}?></td>
        </tr>
        <tr>
          <td width="35%">Pekerjaan Ibu</td>
          <td>: <?php if($data_pengguna[0]['pekerjaan_ibu'] == 0){echo"-";}else{$data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_ibu'])->result_array(); echo $data_pekerjaan_pilih[0]['nama_pekerjaan'];}?></td>
        </tr>
        <tr>
          <td width="35%">No Telepon Ibu</td>
          <td>: <?php if(!empty($data_pengguna[0]['nohp_ibu'])){echo $data_pengguna[0]['nohp_ibu'];}else{echo "-";} ?></td>
        </tr>

        <tr>
          <td colspan="2"><h5><u><b>Data Wali</b></u></h5></td>
        </tr>
        <tr>
          <td width="35%">Nomor Induk Kependudukan Wali</td>
          <td>: <?php if(!empty($data_pengguna[0]['nik_wali'])){echo $data_pengguna[0]['nik_wali'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Nama Wali</td>
          <td>: <?php if(!empty($data_pengguna[0]['nama_wali'])){echo $data_pengguna[0]['nama_wali'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Status Wali</td>
          <td>: <?php if(empty($data_pengguna[0]['status_wali'])){echo "-";}else if($data_pengguna[0]['status_wali'] == 1){echo "Masih Hidup";}else if($data_pengguna[0]['status_wali'] == 2){echo "Sudah Mati";}else if($data_pengguna[0]['status_wali'] == 3){echo "Tidak Diketahui";} ?></td>
        </tr>
        <tr>
          <td width="35%">Tahun Lahir Wali</td>
          <td>: <?php if(!empty($data_pengguna[0]['thn_lahir_wali'])){echo $data_pengguna[0]['thn_lahir_wali'];}else{echo "-";} ?></td>
        </tr>
        <tr>
          <td width="35%">Pendidikan Wali</td>
          <td>: <?php if($data_pengguna[0]['pendidikan_wali'] == 0){echo"-";}else{$data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_wali'])->result_array(); echo $data_pendidikan_pilih[0]['nama_pendidikan'];}?></td>
        </tr>
        <tr>
          <td width="35%">Pekerjaan Wali</td>
          <td>: <?php if($data_pengguna[0]['pekerjaan_wali'] == 0){echo"-";}else{$data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_wali'])->result_array(); echo $data_pekerjaan_pilih[0]['nama_pekerjaan'];}?></td>
        </tr>
        <tr>
          <td width="35%">No Telepon Wali</td>
          <td>: <?php if(!empty($data_pengguna[0]['nohp_wali'])){echo $data_pengguna[0]['nohp_wali'];}else{echo "-";} ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>