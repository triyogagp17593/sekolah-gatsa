<div class="right_col" role="main">
  <div style="float: right;"><h2><?php $this->load->view('dashboard/kelengkapan/jam_aktif');?></h2></div>
  <!-- <div class="clearfix"></div> -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>TAMBAH SOAL UJIAN PILIHAN GANDA</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li class="dropdown navbar-right">
              <a href="<?= base_url('v_soal_pg');?>" title="kembali"><span class="fa fa-reply"></span></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
        	<form action="<?= base_url('save_soal_pg');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
        		<div class="item form-group">
						  <label class="control-label col-md-3 col-sm-12 col-xs-12" for="inputGuru">Nama Guru <span class="required">*</span></label>
						  <div class="col-md-9 col-sm-12 col-xs-12">
						    <select name="inputGuru" id="inputGuru" class="form-control col-md-7 col-xs-12" required>
						      <option value="" selected disabled>--- Pilih Guru ---</option>
						      <?php 
						        $data_pengguna = $this->db->query("SELECT * FROM view_guru")->result();
						        foreach ($data_pengguna as $hasil) { 
						      ?>
						        <option value="<?= $hasil->id_login?>"><?= $hasil->nama?></option>
						      <?php } ?>
						    </select>
						    
						  </div>
						</div>
		        <div class="item form-group">
		          <label class="control-label col-md-3 col-sm-12 col-xs-12" for="inputMapelKelas">Mata Pelajaran Dan Kelas <span class="required">*</span></label>
		          <div class="col-md-9 col-sm-12 col-xs-12">
		            <select name="inputMapelKelas" id="inputMapelKelas" class="form-control col-md-7 col-xs-12" required>
		              <option value="pilih" disabled selected>--- Mata Pelajaran Dan Kelas ---</option>
		            </select>
		          </div>
		        </div>
		        <div class="item form-group">
						  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputKodesoal">Kode Soal <span class="required">*</span></label>
						  <div class="col-md-9 col-sm-6 col-xs-12" id="kode">
						    <input id="inputKodesoal" class="form-control col-md-7 col-xs-12" name="inputKodesoal" placeholder="input Kode Soal" type="text" disabled>
						  </div>
						</div>
						<div class="item form-group">
						  <label class="control-label col-md-2 col-sm-3 col-xs-2" for="inputPertanyaan" style="margin-left: -70px;">Pertanyaan <span class="required">*</span></label>
						  <div class="col-md-12 col-sm-6 col-xs-12">  
						    <textarea id="inputPertanyaan" name="inputPertanyaan" class="form-control col-md-7 col-xs-12"></textarea>
						  </div>
						</div>
						<div class="item form-group">
						  <label class="control-label col-md-2 col-sm-3 col-xs-2" for="inputOpsi1" style="margin-left: -30px;">Pilihan Jawaban 1 <span class="required">*</span></label>
						  <div class="col-md-12 col-sm-6 col-xs-12">  
						    <textarea id="inputOpsi1" name="inputOpsi1" class="form-control col-md-7 col-xs-12"></textarea>
						  </div>
						</div>
						<div class="item form-group">
						  <label class="control-label col-md-2 col-sm-3 col-xs-2" for="inputOpsi2" style="margin-left: -30px;">Pilihan Jawaban 2 <span class="required">*</span></label>
						  <div class="col-md-12 col-sm-6 col-xs-12">  
						    <textarea id="inputOpsi2" name="inputOpsi2" class="form-control col-md-7 col-xs-12"></textarea>
						  </div>
						</div>
						<div class="item form-group">
						  <label class="control-label col-md-2 col-sm-3 col-xs-2" for="inputOpsi3" style="margin-left: -30px;">Pilihan Jawaban 3 <span class="required">*</span></label>
						  <div class="col-md-12 col-sm-6 col-xs-12">  
						    <textarea id="inputOpsi3" name="inputOpsi3" class="form-control col-md-7 col-xs-12"></textarea>
						  </div>
						</div>
						<div class="item form-group">
						  <label class="control-label col-md-2 col-sm-3 col-xs-12" for="inputOpsi4" style="margin-left: -30px;">Pilihan Jawaban 4 <span class="required">*</span></label>
						  <div class="col-md-12 col-sm-6 col-xs-12">  
						    <textarea id="inputOpsi4" name="inputOpsi4" class="form-control col-md-7 col-xs-12"></textarea>
						  </div>
						</div>
						<div class="item form-group">
						  <label class="control-label col-md-2 col-sm-6 col-xs-12" for="inputJawaban">Kunci Jawaban <span class="required">*</span></label>
						  <div class="col-md-3 col-sm-6 col-xs-12">
						    <select name="inputJawaban" id="inputJawaban" class="form-control col-md-7 col-xs-12" required>
						      <option value="" selected disabled>--- Pilih Jawaban ---</option>
						      <option value="A">A</option>
						      <option value="B">B</option>
						      <option value="C">C</option>
						      <option value="D">D</option>
						    </select>
						  </div>
						</div>
						<b>* Required (Harus di isi)</b>
						<div class="item form-group">
						  <div class="col-md-12 col-sm-12 col-xs-12">  
		          	<button class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>