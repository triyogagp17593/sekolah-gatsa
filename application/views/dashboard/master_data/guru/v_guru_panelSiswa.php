<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>DATA GURU</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
	        <?php if($data_pengguna->num_rows() > 0){ ?>
	        	<?php foreach ($data_pengguna->result() as $hasil) { ?>
	        		<div class="animated flipInY col-lg-12 col-md-6 col-sm-6 col-xs-12">
		            <div class="tile-stats">
		            	<div class="col-md-3 col-sm-3 col-xs-12" style="padding: 20px;">
				            <div align="center">
				              <?php if(!empty($hasil->gambar)){ ?>
				                <img src="<?= base_url('assets/images/gambar_user/').$hasil->gambar;?>" style="border-radius: 20px;" width="80%" title="<?= $hasil->nama?>">
				              <?php }else{ ?>
				                <img src="<?= base_url('assets/images/user.png');?>" width="80%" style="border-radius: 20px;" title="Tidak ada Foto">
				              <?php } ?>
				            </div>
				          </div>
		              <div class="col-md-9 col-sm-3 col-xs-12" style="margin-top: 20px;">
				            <table width="100%">
				              <tr>
				                <td width="30%">Nama Lengkap</td>
				                <td>: <?= $hasil->nama ?></td>
				              </tr>
				              <tr>
				                <td width="30%">Email</td>
				                <td>: <?= $hasil->email?></td>
				              </tr>
				              <tr>
				                <td width="30%">Tempat, Tanggal Lahir</td>
				                <td>: <?php if($hasil->kondisi_data == 1){ if(empty($hasil->tempat)){echo"-";}else{echo $hasil->tempat;} ?>, <?php if($hasil->tgl_lahir == "0000-00-00"){echo"-";}else{echo date('d M Y',strtotime($hasil->tgl_lahir));} }else{ echo "<b>--- data di sembunyikan ---</b>";} ?></td>
				              </tr>
				              <tr>
				                <td width="30%">Jenis Kelamin</td>
				                <td>: <?php if($hasil->kondisi_data == 1){ if($hasil->jk == 1){echo "Laki-Laki";}else{echo "Perempuan";} }else{ echo "<b>--- data di sembunyikan ---</b>";} ?></td>
				              </tr>
				              <tr>
				                <td width="30%">Agama</td>
				                <td>: <?php if($hasil->kondisi_data == 1){echo "Islam";}else{ echo "<b>--- data di sembunyikan ---</b>";} ?></td>
				              </tr>
				              <tr>
				                <td width="30%">Telepon</td>
				                <td>: <?php if($hasil->kondisi_data == 1){ echo $hasil->telp; }else{ echo "<b>--- data di sembunyikan ---</b>";} ?></td>
				              </tr>
				              <tr>
				                <td width="30%">Alamat</td>
				                <td>: <?php if($hasil->kondisi_data == 1){ if(!empty($hasil->alamat)){echo $hasil->alamat;}else{echo "-";} }else{ echo "<b>--- data di sembunyikan ---</b>";} ?></td>
				              </tr>
				            </table>
				          </div>
		            </div>
		          </div>
	        	<?php } ?>
	        <?php }else{$this->session->set_flashdata('info', 'Data Guru di MTS AL-HIDAYAH 1 Tidak Ada !!! Terimakasih ..');redirect('dashboard');} ?>
        </div>
      </div>
    </div>
  </div>
</div>