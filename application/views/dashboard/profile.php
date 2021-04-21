<?php error_reporting(0); ?>
<?php $level = $this->session->userdata('ses_level'); if($level == 1){$sbg = "Super Admin";}else if($level == 2){$sbg = "Operator";}else if($level == 3){$sbg = "Guru / Staff";}else if($level == 4){$sbg = "Siswa";}?>
<div class="right_col" role="main">
  <div style="float: right;"><h2><?php $this->load->view('dashboard/kelengkapan/jam_aktif');?></h2></div>
  <!-- <div class="clearfix"></div> -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Profile <?= $sbg ?></h2>
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
              <br>
              <b><?= $sbg ?></b>
              <?php if($level == 4){ ?> 
                <br>
                <b>Kelas <?php $kelas = $this->main_model->get_all_kelas_siswaBy($data_pengguna[0]['id_login'])->result_array(); if(empty($kelas[0]['id_login'])){$kondisi=1;echo"<b title='Silahkan ambil kelas dahulu !!!'>Belum ambil kelas</b>";}else{$kondisi=2;echo $kelas[0]['romawi_kelas']."-".$kelas[0]['angka_kelas'];} ?></b>
              <?php }else if($level == 3){ ?>
                <br>
                <b>Mengajar Kelas 
                <?php 
                  $kelas_ajar = $this->main_model->get_all_sk_mengajarBy($data_pengguna[0]['id_login'])->result_array(); 
                  $jmlkelas_ajar = $this->main_model->get_all_sk_mengajarBy($data_pengguna[0]['id_login'])->num_rows(); 
                  if($jmlkelas_ajar == 0){
                    echo "<br>(belum memilih kelas yang di ajar)";
                  }else if($jmlkelas_ajar == 1){
                    echo "(".$kelas_ajar[0]['kelas'].")";
                  }else if($jmlkelas_ajar == 2){
                    echo "(".$kelas_ajar[0]['kelas']." & ".$kelas_ajar[1]['kelas'].")";
                  }else if($jmlkelas_ajar == 3){
                    echo "(".$kelas_ajar[0]['kelas'].", ".$kelas_ajar[1]['kelas'].", ".$kelas_ajar[2]['kelas'].")";
                  }
                ?>
                </b>
              <?php } ?>
            </div>
          </div>
          <div class="col-md-9 col-sm-3 col-xs-12">
            <table width="100%">
              <?php if($level == 3){ ?>
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
              <?php }else if($level == 4){ ?>
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
              <?php } ?>
              <tr>
                <td width="30%">Nama Lengkap</td>
                <td>: <?= $data_pengguna[0]['nama'] ?></td>
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
              <?php if($level == 3){ ?>
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
              <?php } ?>
              <tr>
                <td width="30%">Jenis Kelamin</td>
                <td>: <?php if($data_pengguna[0]['jk'] == 1){echo "Laki-Laki";}else{echo "Perempuan";} ?></td>
              </tr>
              <tr>
                <td width="30%">Agama</td>
                <td>: Islam</td>
              </tr>
              <?php if($level == 4){ ?>
                <tr>
                  <td width="30%">Anak Ke</td>
                  <td>: <?= $data_pengguna[0]['anak_ke'] ?></td>
                </tr>
                <tr>
                  <td width="30%">Jumlah Saudara</td>
                  <td>: <?php if(empty($data_pengguna[0]['jml_saudara'])){echo "-";}else{echo $data_pengguna[0]['jml_saudara']." bersaudara";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Hobi</td>
                  <td>: <?php if($data_pengguna[0]['hobi'] == 0){echo"tidak ada hobi";}else{$data_hobi_pilih = $this->main_model->get_all_TabelPendukung("5","1",$data_pengguna[0]['hobi'])->result_array(); echo $data_hobi_pilih[0]['nama_hobi'];}?></td>
                </tr>
                <tr>
                  <td width="30%">Cita - Cita</td>
                  <td>: <?php if($data_pengguna[0]['citacita'] == 0){echo"tidak ada cita - cita";}else{$data_citacita_pilih = $this->main_model->get_all_TabelPendukung("4","1",$data_pengguna[0]['citacita'])->result_array(); echo $data_citacita_pilih[0]['nama_citacita'];}?></td>
                </tr>
              <?php } ?>
              <tr>
                <td width="30%">Telepon</td>
                <td>: <?php if(empty($data_pengguna[0]['telp'])){echo"-";}else{echo $data_pengguna[0]['telp'];} ?></td>
              </tr>
              <tr>
                <td width="30%">Alamat <?= $sbg ?></td>
                <td>: <?php if(!empty($data_pengguna[0]['alamat'])){echo $data_pengguna[0]['alamat'];}else{echo "-";} ?></td>
              </tr>
              <?php if($level == 4){ ?>
                <tr>
                  <td colspan="2"><hr style="border: dashed 2px #000;"></td>
                </tr>
                <tr>
                  <td colspan="2"><h4><b>Data Asal Sekolah Siswa</b></h4></td>
                </tr>
                <tr>
                  <td width="30%">Nomor Peserta UN</td>
                  <td>: <?= $data_pengguna[0]['no_un']?></td>
                </tr>
                <tr>
                  <td width="30%">Nomor SKHUN</td>
                  <td>: <?= $data_pengguna[0]['no_skhun']?></td>
                </tr>
                <tr>
                  <td width="30%">Nomor Ijazah</td>
                  <td>: <?= $data_pengguna[0]['no_ijazah']?></td>
                </tr>
                <tr>
                  <td width="30%">Nama Sekolah</td>
                  <td>: <?= $data_pengguna[0]['nama_sekolah']?></td>
                </tr>
                <tr>
                  <td width="30%">NPSN</td>
                  <td>: <?= $data_pengguna[0]['npsn']?></td>
                </tr>
                <tr>
                  <td width="30%">Jenjang Sekolah</td>
                  <td>: <?php if($data_pengguna[0]['jenjang'] == 0){echo"tidak ada jenjang sekolah";}else{$data_jenjang_pilih = $this->main_model->get_all_TabelPendukung("6","1",$data_pengguna[0]['jenjang'])->result_array(); echo $data_jenjang_pilih[0]['nama_jenjang'];}?></td>
                </tr>
                <tr>
                  <td width="30%">Status Sekolah</td>
                  <td>: <?php if($data_pengguna[0]['status_sekolah'] == 0){echo"-";}else if($data_pengguna[0]['status_sekolah'] == 1){echo"Negeri";}else if($data_pengguna[0]['status_sekolah'] == 2){echo"Swasta";}?></td>
                </tr>
                <tr>
                  <td width="30%">Lokasi Sekolah</td>
                  <td>: <?php $data_kabkot = $this->main_model->get_all_lokasi($data_pengguna[0]['kabkot_asalsekolah'])->result_array(); echo $data_kabkot[0]['nama'];?></td>
                </tr>
                <tr>
                  <td width="30%">Alamat Sekolah</td>
                  <td>: <?php if(!empty($data_pengguna[0]['alamat_sekolah'])){echo $data_pengguna[0]['alamat_sekolah'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Nilai UN</td>
                  <td>: <?= $data_pengguna[0]['no_un']?></td>
                </tr>
                <tr>
                  <td width="30%">Tanggal Lulus</td>
                  <td>: <?php if($data_pengguna[0]['tgl_lulus'] == "0000-00-00"){echo"-";}else{echo date('d M Y',strtotime($data_pengguna[0]['tgl_lulus']));} ?></td>
                </tr>
                <tr>
                  <td colspan="2"><hr style="border: dashed 2px #000;"></td>
                </tr>
                <tr>
                  <td colspan="2"><h4><b>Data Orang Tua / Wali Siswa</b></h4></td>
                </tr>
                <tr>
                  <td width="30%">Nama Kepala Keluarga</td>
                  <td>: <?= $data_pengguna[0]['nama_kk']?></td>
                </tr>
                <tr>
                  <td width="30%">Nomor kartu Keluarga</td>
                  <td>: <?= $data_pengguna[0]['no_kk']?></td>
                </tr>
                <tr>
                  <td width="30%">Penghasilan Rata - Rata</td>
                  <td>: <?php if($data_pengguna[0]['penghasilan'] == 0){echo"-";}else{$data_penghasilan_pilih = $this->main_model->get_all_TabelPendukung("8","1",$data_pengguna[0]['penghasilan'])->result_array(); echo $data_penghasilan_pilih[0]['nama_penghasilan'];}?></td>
                </tr>
                <tr>
                  <td width="30%">Alamat Orang Tua</td>
                  <td>: <?php if(!empty($data_pengguna[0]['alamat_orangtua'])){echo $data_pengguna[0]['alamat_orangtua'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Provinsi</td>
                  <td>: <?php $data_provinsi = $this->main_model->get_all_lokasi($data_pengguna[0]['provinsi'])->result_array(); echo $data_provinsi[0]['nama'];?></td>
                </tr>
                <tr>
                  <td width="30%">Kabupaten / Kota</td>
                  <td>: <?php $kabkot = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot']; $data_kabkot = $this->main_model->get_all_lokasi($kabkot)->result_array(); echo $data_kabkot[0]['nama'];?></td>
                </tr>
                <tr>
                  <td width="30%">Kecamatan</td>
                  <td>: <?php $kec = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'].".".$data_pengguna[0]['kec']; $data_kec = $this->main_model->get_all_lokasi($kec)->result_array(); echo $data_kec[0]['nama'];?></td>
                </tr>
                <tr>
                  <td width="30%">Desa / Kelurahan</td>
                  <td>: <?php $deskel = $data_pengguna[0]['provinsi'].".".$data_pengguna[0]['kabkot'].".".$data_pengguna[0]['kec'].".".$data_pengguna[0]['deskel']; $data_deskel = $this->main_model->get_all_lokasi($deskel)->result_array(); echo $data_deskel[0]['nama'];?></td>
                </tr>
                <tr>
                  <td width="30%">Kode Pos</td>
                  <td>: <?= $data_pengguna[0]['kodepos']?></td>
                </tr>
                <tr>
                  <td width="30%">Status Tempat Tinggal</td>
                  <td>: <?php if(empty($data_pengguna[0]['status_tempattinggal'])){echo"-";}else{$data_status_tempattinggal_pilih = $this->main_model->get_all_TabelPendukung("9","1",$data_pengguna[0]['status_tempattinggal'])->result_array(); echo $data_status_tempattinggal_pilih[0]['nama_tempattinggal'];}?></td>
                </tr>
                <tr>
                  <td width="30%">Jarak Rumah</td>
                  <td>: <?php if(empty($data_pengguna[0]['jarakrumah'])){echo"-";}else{$data_jarakrumah_pilih = $this->main_model->get_all_TabelPendukung("10","1",$data_pengguna[0]['jarakrumah'])->result_array(); echo $data_jarakrumah_pilih[0]['nama_jarakrumah'];}?></td>
                </tr>
                <tr>
                  <td width="30%">Transportasi</td>
                  <td>: <?php if(empty($data_pengguna[0]['transportasi'])){echo"-";}else{$data_transportasi_pilih = $this->main_model->get_all_TabelPendukung("11","1",$data_pengguna[0]['transportasi'])->result_array(); echo $data_transportasi_pilih[0]['nama_transportasi'];}?></td>
                </tr>
                <tr>
                  <td colspan="2"><h5><u><b>Data Ayah</b></u></h5></td>
                </tr>
                <tr>
                  <td width="30%">Nomor Induk Kependudukan Ayah</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nik_ayah'])){echo $data_pengguna[0]['nik_ayah'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Nama Ayah</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nama_ayah'])){echo $data_pengguna[0]['nama_ayah'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Status Ayah</td>
                  <td>: <?php if(empty($data_pengguna[0]['status_ayah'])){echo "-";}else if($data_pengguna[0]['status_ayah'] == 1){echo "Masih Hidup";}else if($data_pengguna[0]['status_ayah'] == 2){echo "Sudah Mati";}else if($data_pengguna[0]['status_ayah'] == 3){echo "Tidak Diketahui";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Tahun Lahir Ayah</td>
                  <td>: <?php if(!empty($data_pengguna[0]['thn_lahir_ayah'])){echo $data_pengguna[0]['thn_lahir_ayah'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Pendidikan Ayah</td>
                  <td>: <?php if($data_pengguna[0]['pendidikan_ayah'] == 0){echo"-";}else{$data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_ayah'])->result_array(); echo $data_pendidikan_pilih[0]['nama_pendidikan'];}?></td>
                </tr>
                <tr>
                  <td width="30%">Pekerjaan Ayah</td>
                  <td>: <?php if($data_pengguna[0]['pekerjaan_ayah'] == 0){echo"-";}else{$data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_ayah'])->result_array(); echo $data_pekerjaan_pilih[0]['nama_pekerjaan'];}?></td>
                </tr>
                <tr>
                  <td width="30%">No Telepon Ayah</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nohp_ayah'])){echo $data_pengguna[0]['nohp_ayah'];}else{echo "-";} ?></td>
                </tr>

                <tr>
                  <td colspan="2"><h5><u><b>Data Ibu</b></u></h5></td>
                </tr>
                <tr>
                  <td width="30%">Nomor Induk Kependudukan Ibu</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nik_ibu'])){echo $data_pengguna[0]['nik_ibu'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Nama Ibu</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nama_ibu'])){echo $data_pengguna[0]['nama_ibu'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Status Ibu</td>
                  <td>: <?php if(empty($data_pengguna[0]['status_ibu'])){echo "-";}else if($data_pengguna[0]['status_ibu'] == 1){echo "Masih Hidup";}else if($data_pengguna[0]['status_ibu'] == 2){echo "Sudah Mati";}else if($data_pengguna[0]['status_ibu'] == 3){echo "Tidak Diketahui";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Tahun Lahir Ibu</td>
                  <td>: <?php if(!empty($data_pengguna[0]['thn_lahir_ibu'])){echo $data_pengguna[0]['thn_lahir_ibu'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Pendidikan Ibu</td>
                  <td>: <?php if($data_pengguna[0]['pendidikan_ibu'] == 0){echo"-";}else{$data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_ibu'])->result_array(); echo $data_pendidikan_pilih[0]['nama_pendidikan'];}?></td>
                </tr>
                <tr>
                  <td width="30%">Pekerjaan Ibu</td>
                  <td>: <?php if($data_pengguna[0]['pekerjaan_ibu'] == 0){echo"-";}else{$data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_ibu'])->result_array(); echo $data_pekerjaan_pilih[0]['nama_pekerjaan'];}?></td>
                </tr>
                <tr>
                  <td width="30%">No Telepon Ibu</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nohp_ibu'])){echo $data_pengguna[0]['nohp_ibu'];}else{echo "-";} ?></td>
                </tr>

                <tr>
                  <td colspan="2"><h5><u><b>Data Wali</b></u></h5></td>
                </tr>
                <tr>
                  <td width="30%">Nomor Induk Kependudukan Wali</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nik_wali'])){echo $data_pengguna[0]['nik_wali'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Nama Wali</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nama_wali'])){echo $data_pengguna[0]['nama_wali'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Status Wali</td>
                  <td>: <?php if(empty($data_pengguna[0]['status_wali'])){echo "-";}else if($data_pengguna[0]['status_wali'] == 1){echo "Masih Hidup";}else if($data_pengguna[0]['status_wali'] == 2){echo "Sudah Mati";}else if($data_pengguna[0]['status_wali'] == 3){echo "Tidak Diketahui";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Tahun Lahir Wali</td>
                  <td>: <?php if(!empty($data_pengguna[0]['thn_lahir_wali'])){echo $data_pengguna[0]['thn_lahir_wali'];}else{echo "-";} ?></td>
                </tr>
                <tr>
                  <td width="30%">Pendidikan Wali</td>
                  <td>: <?php if($data_pengguna[0]['pendidikan_wali'] == 0){echo"-";}else{$data_pendidikan_pilih = $this->main_model->get_all_TabelPendukung("1","1",$data_pengguna[0]['pendidikan_wali'])->result_array(); echo $data_pendidikan_pilih[0]['nama_pendidikan'];}?></td>
                </tr>
                <tr>
                  <td width="30%">Pekerjaan Wali</td>
                  <td>: <?php if($data_pengguna[0]['pekerjaan_wali'] == 0){echo"-";}else{$data_pekerjaan_pilih = $this->main_model->get_all_TabelPendukung("7","1",$data_pengguna[0]['pekerjaan_wali'])->result_array(); echo $data_pekerjaan_pilih[0]['nama_pekerjaan'];}?></td>
                </tr>
                <tr>
                  <td width="30%">No Telepon Wali</td>
                  <td>: <?php if(!empty($data_pengguna[0]['nohp_wali'])){echo $data_pengguna[0]['nohp_wali'];}else{echo "-";} ?></td>
                </tr>
              <?php } ?>
            </table>
            <br>
            <a href="<?= base_url('ubah_profil/').$data_pengguna[0]['id_login'];?>" id="adminprofile" data-toggle="modal" data-target="#modal_admin" class="btn btn-primary btn-xs"><span class="fa fa-pencil"></span> Ubah Profile</a>
            <?php if($data_pengguna[0]['kondisi_data'] == 1){ ?>
              <a href="<?= base_url('tampildata/0/').$data_pengguna[0]['id_login'];?>" class="btn btn-primary btn-xs"><span class="fa fa-user"></span> Sembunyikan Profile</a>
            <?php }else{ ?>
              <a href="<?= base_url('tampildata/1/').$data_pengguna[0]['id_login'];?>" class="btn btn-primary btn-xs"><span class="fa fa-user"></span> Tampilkan Profile</a>
            <?php } ?>
            <?php if(!empty($data_pengguna[0]['gambar'])){ ?>
              <a href="<?= base_url('hapusgambar/').$data_pengguna[0]['id_login'];?>" class="btn btn-primary btn-xs"><span class="fa fa-trash"></span> Hapus Gambar</a>
            <?php } ?>
            <?php if($level == 4){ ?>
              <!-- <a href="<?= base_url('ambil_kelas/').$data_pengguna[0]['id_login'];?>" id="ambilKelas" data-toggle="modal" data-target="#modal_ambil_kelas" class="btn btn-primary btn-xs"><span class="fa fa-check"></span> Pilih Kelas</a> -->
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if($level == 3){?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Mata Pelajaran Yang Di Ajar</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-12 col-sm-3 col-xs-12">
              <?php
                $data_kelas = $this->main_model->get_all_sk_mengajarBy($this->session->userdata('ses_idlogin'))->result(); 
                foreach ($data_kelas as $hasil) {
                  $jml_kelas = $this->main_model->get_all_kelasBy($hasil->kelas)->num_rows(); 
                  $kelas = $this->main_model->get_all_kelasBy($hasil->kelas)->result(); 
                  echo "<div class='col-lg-12 col-md-6 col-sm-6 col-xs-12'><h2 style='color: black;margin-left: 5px;font-weight: bold;'>Kategori Kelas : $hasil->kelas</h2></div>";
                  foreach ($kelas as $hasil2) {
                  $jml_siswa = $this->main_model->get_all_kelas_siswaBy3($hasil2->romawi_kelas,$hasil2->angka_kelas)->num_rows(); 
              ?>
                <a href="<?=base_url('lihat_hasil_ujian/').$hasil->id_mapel.'/'.$hasil->id_kelas.'/'.$this->session->userdata('ses_idlogin');?>" title="Melihat hasil ujian kelas <?=$hasil2->romawi_kelas."-".$hasil2->angka_kelas?> mata pelajaran <?=$hasil->nama_mapel?>">
                  <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-file-text"></i>
                      </div>
                      <div class="count"><?=$jml_siswa?></div>
                      <h5 style="color: black;margin-left: 5px;font-weight: bold;"><?=$hasil->nama_mapel?></h5>
                      <h5 style="color: black;margin-left: 5px;font-weight: bold;"><?="Kelas : ".$hasil2->romawi_kelas."-".$hasil2->angka_kelas?></h5>
                    </div>
                  </div>
                </a>
              <?php } ?>
              <hr style="border: dashed 1px #000; width: 100%;">
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php }elseif($level == 4){?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Mata Pelajaran Yang Di Ambil <b>(<?= $this->session->userdata('ses_name') ?>)</b> 
              <?php if($jmldata_kelas != 0){ ?> 
                - Kelas <?= $data_kelas[0]['romawi_kelas']."-".$data_kelas[0]['angka_kelas']?></h2>
              <?php }else{ ?>
                </h2>
              <?php } ?>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-12 col-sm-3 col-xs-12">
              <?php 
                $data_mapel = $this->main_model->get_all_mapel("1")->result();
                foreach ($data_mapel as $hasil) { 
                  $guru = $this->main_model->get_all_sk_mengajarBy3($hasil->id_mapel)->result_array();
                  // foreach ($kelas as $hasil2) {
                  $jml_siswa = $this->main_model->get_all_kelas_siswaBy3($data_kelas[0]['romawi_kelas'],$data_kelas[0]['angka_kelas'])->num_rows();
              ?>
                <a href="<?=base_url('lihat_hasil_ujian/').$hasil->id_mapel.'/'.$hasil->id_kelas.'/'.$this->session->userdata('ses_idlogin');?>" title="Melihat hasil ujian kelas <?=$hasil2->romawi_kelas."-".$hasil2->angka_kelas?> mata pelajaran <?=$hasil->nama_mapel?>">
                  <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                      <div class="icon"><i class="fa fa-file-text"></i>
                      </div>
                      <br><br>
                      <!-- <div class="count"><?=$jml_siswa?></div> -->
                      <h5 style="color: black;margin-left: 5px;font-weight: bold;"><?=$hasil->nama_mapel?></h5>
                      <h5 style="color: black;margin-left: 5px;font-weight: bold;"><?php if(empty($guru[0]['nama'])){echo"-";}else{echo $guru[0]['nama'];} ?></h5>
                      <br><br>
                    </div>
                  </div>
                </a>
              <?php }//} ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  </div> 
<div class="modal fade" id="modal_admin" tabindex="-1" role="dialog" aria-labelledby="largeModal2" aria-hidden="true"></div>

<div class="modal fade" id="modal_ambil_kelas" tabindex="-1" role="dialog" aria-labelledby="largeModal3" aria-hidden="true"></div>

<div class="modal fade" id="modal_ambil_Ajarkelas" tabindex="-1" role="dialog" aria-labelledby="largeModal4" aria-hidden="true"></div>

<div class="modal fade" id="modal_detail_nilai" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true"></div>

<script type="text/javascript">
  $(document).ready(function() {
    var detik = 0;
    var menit = <?=$menit?>;
    var jam   = <?=$jam?>;
    // var hari  = 2;
    console.log(menit);
    function hitung() {
      setTimeout(hitung,1000);
      if(menit < 10 && jam == 0){
          var peringatan = 'style="color:red"';
      };
      
      $('#timer').html(
        '<h5 align="center"'+peringatan+'>' + jam + ' jam : ' + menit + ' menit : ' + detik + ' detik</h5>'
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
  }); 
</script>