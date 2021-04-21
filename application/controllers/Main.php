<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	private $filename_guru = "import_dataguru_";
	private $filename_siswa = "import_datasiswa_";

	function __construct(){
		parent::__construct();
		$this->load->model('main_model');
    $this->load->library('upload');
    if($this->session->userdata('masuk') != TRUE){
			$url=base_url();
			$this->session->set_flashdata('error', 'Anda tidak boleh masuk Dashboard, silahkan login terlebih dahulu !!');
			redirect('login');
		}
	}

	function index(){
		$level = $this->session->userdata('ses_level');
		$this->load->view('dashboard/kelengkapan/header');
		if($level == 1 || $level == 2){
			$this->load->view('dashboard/dashboard');
		}else if($level == 3 || $level == 4){
			if($level == 3){$tbl = 2;}else if($level == 4){$tbl = 3;}
			$id_login = $this->session->userdata('ses_idlogin');
			$data = array(
				'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,$tbl)->result_array(),
				'data_ngajar' => $this->main_model->get_all_sk_mengajarBy($id_login)->result_array(),
				'data_kelas' => $this->main_model->get_all_kelas_siswaBy($id_login)->result_array(),
				'jmldata_kelas' => $this->main_model->get_all_kelas_siswaBy($id_login)->num_rows(),
		  );
			$this->load->view('dashboard/profile', $data);
		}
		$this->load->view('dashboard/kelengkapan/footer');
	}
	//Profile
	function profile(){
		$level = $this->session->userdata('ses_level');
		if($level == 1 || $level == 2){$tbl = 1;}else if($level == 3){$tbl = 2;}else if($level == 4){$tbl = 3;}
		$id_login = $this->session->userdata('ses_idlogin');
		$data = array(
			'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,$tbl)->result_array(),
			'data_ngajar' => $this->main_model->get_all_sk_mengajarBy($id_login)->result_array(),
			'data_kelas' => $this->main_model->get_all_kelas_siswaBy($id_login)->result_array(),
			'jmldata_kelas' => $this->main_model->get_all_kelas_siswaBy($id_login)->num_rows(),
	  );
		$this->load->view('dashboard/kelengkapan/header');
		$this->load->view('dashboard/profile', $data);
		$this->load->view('dashboard/kelengkapan/footer');
	}

	function tampildata($kondisi_data,$id_login){
    $kirimdata['kondisi_data'] = $kondisi_data;
		$success = $this->main_model->update_profiltampildata($kirimdata, $id_login);
		if($success){
			$this->session->set_flashdata('info', 'Profile anda di ubah otorisasi nya !!! Terimakasih ..');
	  	redirect('profile');
	  }
	}

	function ubah_profil($id_login){
		$level = $this->session->userdata('ses_level');
		if($level == 1 || $level == 2){$tbl = 1;}else if($level == 3){$tbl = 2;}else if($level == 4){$tbl = 3;}
		$data = array(
  	  'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,$tbl)->result_array(),
    );
    if($level == 1 || $level == 2){
    	$this->load->view('dashboard/master_data/administrator/edit_administrator', $data);
    }else if($level == 3){
    	$this->load->view('dashboard/master_data/guru/edit_guru', $data);
    }else if($level == 4){
    	$this->load->view('dashboard/master_data/siswa/edit_siswa', $data);
    }
	}

	function ambil_kelas($id_login){
		$data = array(
  	  'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,3)->result_array(),
			'data_kelas' => $this->main_model->get_all_kelas_siswaBy($id_login)->result_array(),
			'jmldata_kelas' => $this->main_model->get_all_kelas_siswaBy($id_login)->num_rows(),
    );
		$this->load->view('dashboard/ambil_kelas', $data);
	}

	function GetKelas(){
		$GetKelas = $this->main_model->get_all_kelasBy($_GET['romawi_kelas']);
		if($GetKelas->num_rows() > 0){
			foreach ($GetKelas->result() as $value) {
				$data[] = array(
					"id_kelas" => $value->id_kelas,
					"angka_kelas" => $value->angka_kelas,
				);
			}
		}else{
			$data = array();
		}
		echo json_encode($data);
	}

	function update_profil(){
		$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
		$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
		$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
		$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
 		
    if ($this->form_validation->run() == FALSE) { 
    	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
  		redirect('profile');
		}else{
			$config['upload_path'] = './assets/images/gambar_user/'; //path folder
	    $config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

	    $this->upload->initialize($config);
    	if(!empty($_FILES['foto']['name'])){

	    	if ($this->upload->do_upload('foto')){
        	$gbr = $this->upload->data();
        	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
          $config['image_library']='gd2';
          $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
          $config['create_thumb']= FALSE;
          $config['maintain_ratio']= FALSE;
          $config['quality']= '50%';
          $config['width']= 200;
          $config['height']= 200;
          $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();
          $gambar = $file_gbr;
        }
    		$login_id = $this->input->post('login_id');
    		$inputUsername = $this->input->post('inputUsername', true);
    		$inputEmail = $this->input->post('inputEmail');
    		if(!empty($this->input->post('inputPassword'))){
    			$inputPassword = md5($this->input->post('inputPassword', true)); 
					$kirimdata['password'] = $inputPassword;
					$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
    		}
    		$kirimdata['username'] = $inputUsername;
				$kirimdata['email'] = $inputEmail;
				$this->main_model->update_profil($kirimdata, 1, $login_id);

    		$inputNama = $this->input->post('inputNama');
    		$inputTempat = $this->input->post('inputTempat');
    		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
    		$jk = $this->input->post('jk');
    		$inputTelepon = $this->input->post('inputTelepon');
    		$inputAlamat = $this->input->post('inputAlamat');
		
    		if($inputTgl == "1970-01-01"){
    			$tanggal = "0000-00-00";
    		}else{
    			$tanggal = $inputTgl;
    		}

				$kirimdata2['nama'] = $inputNama;
				$kirimdata2['tempat'] = $inputTempat;
				$kirimdata2['tgl_lahir'] = $tanggal;
				$kirimdata2['jk'] = $jk;
				$kirimdata2['telp'] = $inputTelepon;
				$kirimdata2['alamat'] = $inputAlamat;
				$lihat = $this->input->post('lihat');
				if($lihat != 1){
					$kirimdata2['gambar'] = $gambar;
				}
				$success = $this->main_model->update_profil($kirimdata2, 2, $login_id);
    		$this->session->set_userdata('masuk',TRUE);
        $this->session->set_userdata('ses_idlogin',$login_id);
		    $this->session->set_userdata('ses_name',$inputNama);
        $this->session->set_userdata('ses_username',$inputUsername);
        $this->session->set_userdata('ses_email',$inputEmail);
        $this->session->set_userdata('ses_foto',$gambar);
				
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
	    		redirect('profile');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
	    			redirect('profile');
	 			}
    	}else{
    		$login_id = $this->input->post('login_id');
    		$inputUsername = $this->input->post('inputUsername', true);
    		$inputEmail = $this->input->post('inputEmail');
    		if(!empty($this->input->post('inputPassword'))){
    			$inputPassword = md5($this->input->post('inputPassword', true)); 
					$kirimdata['password'] = $inputPassword;
					$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
    		}
				$kirimdata['username'] = $inputUsername;
				$kirimdata['email'] = $inputEmail;
				$this->main_model->update_profil($kirimdata, 1, $login_id);

        $inputNama = $this->input->post('inputNama');
    		$inputTempat = $this->input->post('inputTempat');
    		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
    		$jk = $this->input->post('jk');
    		$inputTelepon = $this->input->post('inputTelepon');
    		$inputAlamat = $this->input->post('inputAlamat');
		
    		if($inputTgl == "1970-01-01"){
    			$tanggal = "0000-00-00";
    		}else{
    			$tanggal = $inputTgl;
    		}

				$kirimdata2['nama'] = $inputNama;
				$kirimdata2['tempat'] = $inputTempat;
				$kirimdata2['tgl_lahir'] = $tanggal;
				$kirimdata2['jk'] = $jk;
				$kirimdata2['telp'] = $inputTelepon;
				$kirimdata2['alamat'] = $inputAlamat;
				$lihat = $this->input->post('lihat');
				if($lihat != 1){
					$kirimdata2['gambar'] = '';
				}
				$success = $this->main_model->update_profil($kirimdata2, 2, $login_id);
				$this->session->set_userdata('masuk',TRUE);
		    $this->session->set_userdata('ses_idlogin',$login_id);
		    $this->session->set_userdata('ses_name',$inputNama);
		    $this->session->set_userdata('ses_username',$inputUsername);
		    $this->session->set_userdata('ses_email',$inputEmail);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
	    		redirect('profile');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
	    		redirect('profile');
	 			}
    	}
		}
	}

	function ambilorupdate_ambil_kelas($kondisi){
		$level = $this->session->userdata('ses_level');
		if($kondisi == 1){
			$login_id = $this->input->post('login_id', true);
	    $inputAngka = $this->input->post('inputAngka', true);
			$kirimdata['loginID'] = $login_id;
			$kirimdata['kelasID'] = $inputAngka;
			$success = $this->main_model->insert_kelas_siswa($kirimdata);
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
    		if($level == 1 || $level == 2){
    			redirect('v_siswa');
    		}else if($level == 3 || $level == 4){
    			redirect('profile');
    		}
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
    		if($level == 1 || $level == 2){
    			redirect('v_siswa');
    		}else if($level == 3 || $level == 4){
    			redirect('profile');
    		}
 			}
		}else if($kondisi == 2){
	    $kelas_siswa_id = $this->input->post('kelas_siswa_id', true);
			$login_id = $this->input->post('login_id', true);
	    $inputAngka = $this->input->post('inputAngka', true);
			$kirimdata['loginID'] = $login_id;
			$kirimdata['kelasID'] = $inputAngka;
			$success = $this->main_model->update_kelas_siswa($kirimdata,$kelas_siswa_id);
 			if($success){
 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
    		if($level == 1 || $level == 2){
    			redirect('v_siswa');
    		}else if($level == 3 || $level == 4){
    			redirect('profile');
    		}
 			}else{
 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
    		if($level == 1 || $level == 2){
    			redirect('v_siswa');
    		}else if($level == 3 || $level == 4){
    			redirect('profile');
    		}
 			}
		}
	}

	function hapusgambar($id_login){
    $kirimdata['gambar'] = '';
    $this->session->set_userdata('ses_foto','');
		$success = $this->main_model->update_profil($kirimdata, 2, $id_login);
		if($success){
			$this->session->set_flashdata('info', 'Foto berhasil di hapus !!! Terimakasih ..');
	  	redirect('profile');
	  }
	}

	function updateActived(){
		$kirimdata['aktif_state'] = $_GET['aktif_state'];
		$data = $this->main_model->update_profil($kirimdata,1,$_GET['id']);	
		echo json_encode($data);
	}

	function updateActivedRole(){
		$kirimdata['roleID'] = $_GET['roleID'];
		$data = $this->main_model->update_profil($kirimdata,1,$_GET['id']);	
		echo json_encode($data);
	}

	function no_nilai(){
		$this->session->set_flashdata('info', 'Anda belum mengerjakan soal !!! Terimakasih ..');
		redirect('dashboard');
	}

	//Master Data
		//Administrator
		function v_administrator(){
			$data = array(
	      'data_pengguna' => $this->main_model->get_all_admin(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/administrator/v_administrator', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function save_administrator(){
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('inputPassword','Input Password', 'required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
			$this->form_validation->set_rules('level','Pilih Level', 'required');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_administrator');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
       	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
       	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

		    $this->upload->initialize($config);
        if(!empty($_FILES['foto']['name'])){

		    	if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
          }
                    
          $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputEmail = $this->input->post('inputEmail');
      		$inputCode = $code;
      		$level = $this->input->post('level');
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
					$kirimdata['email'] = $inputEmail;
					$kirimdata['code'] = $code;
					$kirimdata['roleID'] = $level;
					$kirimdata['kondisi_data'] = "1";
					$kirimdata['aktif_state'] = "1";
					$this->main_model->insert_pengguna($kirimdata,1);

					$cek_admin = $this->db->query("SELECT * FROM tbl_login ORDER BY id_login DESC LIMIT 1")->result_array();
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['loginID'] = $cek_admin[0]['id_login'];
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$kirimdata2['gambar'] = $gambar;
					$success = $this->main_model->insert_pengguna($kirimdata2,2);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_administrator');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_administrator');
		 			}
       	}else{
        	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputEmail = $this->input->post('inputEmail');
      		$inputCode = $code;
      		$level = $this->input->post('level');
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
					$kirimdata['email'] = $inputEmail;
					$kirimdata['code'] = $code;
					$kirimdata['roleID'] = $level;
					$kirimdata['kondisi_data'] = "1";
					$kirimdata['aktif_state'] = "1";
					$this->main_model->insert_pengguna($kirimdata,1);

					$cek_admin = $this->db->query("SELECT * FROM tbl_login ORDER BY id_login DESC LIMIT 1")->result_array();
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['loginID'] = $cek_admin[0]['id_login'];
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$kirimdata2['gambar'] = '';
					$success = $this->main_model->insert_pengguna($kirimdata2,2);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_administrator');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_administrator');
		 			}
       	}
			}
		}

		function edit_administrator($id_login){
			$data = array(
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,1)->result_array(),
	    );
			$this->load->view('dashboard/master_data/administrator/edit_administrator', $data);
		}

		function update_administrator(){
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_administrator');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
       	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
       	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

	     	$this->upload->initialize($config);
	  		if(!empty($_FILES['foto']['name'])){

          if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
      		}

      		$login_id = $this->input->post('login_id');
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputEmail = $this->input->post('inputEmail');
      		if(!empty($this->input->post('inputPassword'))){
	    			$inputPassword = md5($this->input->post('inputPassword', true)); 
						$kirimdata['password'] = $inputPassword;
						$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
	    		}
      		$status = $this->input->post('kondisi');
					$kirimdata['username'] = $inputUsername;
					$kirimdata['email'] = $inputEmail;
					$this->main_model->update_profil($kirimdata, 1, $id_login);

      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata2['gambar'] = $gambar;
					}
					$success = $this->main_model->update_profil($kirimdata2, 2, $login_id);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_administrator');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_administrator');
		 			}
        }else{
      		$login_id = $this->input->post('login_id');
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputEmail = $this->input->post('inputEmail');
      		if(!empty($this->input->post('inputPassword'))){
	    			$inputPassword = md5($this->input->post('inputPassword', true)); 
						$kirimdata['password'] = $inputPassword;
						$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
	    		}
      		$kirimdata['username'] = $inputUsername;
					$kirimdata['email'] = $inputEmail;
					$this->main_model->update_profil($kirimdata, 1, $login_id);

      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata2['gambar'] = '';
					}
					$success = $this->main_model->update_profil($kirimdata2, 2, $login_id);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_administrator');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_administrator');
		 			}
        }
			}
		}

		function detail_administrator($id_login){
			$data = array(
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,1)->result_array(),
	    );
			$this->load->view('dashboard/master_data/administrator/detail_administrator', $data);
		}

		function delete_administrator($id_login){
      $success = $this->main_model->hapus_pengguna($id_login,1);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_administrator');
  	}

  	function delete_administrator_all(){
      $id_login = $this->input->post('pilih');
      $jumlah_dipilih = count($id_login);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_pengguna($id_login[$x],1);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_administrator');
  	}

		//Siswa
		function v_siswa(){
			$data = array(
	      'data_pengguna' => $this->main_model->get_all_siswa(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/siswa/v_siswa', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function save_siswa(){
			$this->form_validation->set_rules('inputNoinduk','Input Nomor Induk Siswa', 'required');
			$this->form_validation->set_rules('inputNisn','Input Nomor Induk Siswa Nasional', 'required');
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('inputPassword','Input Password', 'required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('inputNoUN','Input Nomor Ujian Nasional', 'required');
			$this->form_validation->set_rules('inputNoSKHUN','Input Nomor SKHUN', 'required');
			$this->form_validation->set_rules('inputNoIjazah','Input Nomor Ijazah', 'required');
			$this->form_validation->set_rules('inputNamaSekolah','Input Nama Sekolah', 'required');
			$this->form_validation->set_rules('inputNPSN','Input NPSN', 'required');
			$this->form_validation->set_rules('inputNilaiUN','Input Nilai Ujian Nasional', 'required');
			$this->form_validation->set_rules('inputTglLulus','Input Tanggal Lulus', 'required');
			$this->form_validation->set_rules('inputNamaKK','Input Nama Kepala Keluarga', 'required');
			$this->form_validation->set_rules('inputNoKK','Input Nomor Kartu Keluarga', 'required');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_siswa');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
       	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
       	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

		    $this->upload->initialize($config);
        if(!empty($_FILES['foto']['name'])){

		    	if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
          }
                    
          $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputEmail = $this->input->post('inputEmail');
      		$inputCode = $code;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
					$kirimdata['email'] = $inputEmail;
					$kirimdata['code'] = $code;
					$kirimdata['roleID'] = '4';
					$kirimdata['kondisi_data'] = "1";
					$kirimdata['aktif_state'] = "1";
					$this->main_model->insert_pengguna($kirimdata,1);

					$cek_admin = $this->db->query("SELECT * FROM tbl_login ORDER BY id_login DESC LIMIT 1")->result_array();
      		$inputNoinduk = $this->input->post('inputNoinduk');
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

      		$inputNisn = $this->input->post('inputNisn');
      		$inputAnakKe = $this->input->post('inputAnakKe');
      		$inputJmlSaudara = $this->input->post('inputJmlSaudara');
      		$inputHobi = $this->input->post('inputHobi');
      		$inputCitaCita = $this->input->post('inputCitaCita');
      		$inputNoUN = $this->input->post('inputNoUN');
      		$inputNoSKHUN = $this->input->post('inputNoSKHUN');
      		$inputNoIjazah = $this->input->post('inputNoIjazah');
      		$inputNamaSekolah = $this->input->post('inputNamaSekolah');
      		$inputNPSN = $this->input->post('inputNPSN');
      		$inputJenjangSekolah = $this->input->post('inputJenjangSekolah');
      		$inputStatusSekolah = $this->input->post('inputStatusSekolah');
      		$inputLokasiSekolah = $this->input->post('inputLokasiSekolah');
      		$inputNilaiUN = $this->input->post('inputNilaiUN');
      		$inputTglLulus = date("Y-m-d",strtotime($this->input->post('inputTglLulus')));
      		$inputAlamatSekolah = $this->input->post('inputAlamatSekolah');
      		$inputNamaKK = $this->input->post('inputNamaKK');
      		$inputNoKK = $this->input->post('inputNoKK');
      		$inputNIKAyah = $this->input->post('inputNIKAyah');
      		$inputNIKIbu = $this->input->post('inputNIKIbu');
      		$inputNIKWali = $this->input->post('inputNIKWali');
      		$inputNamaAyah = $this->input->post('inputNamaAyah');
      		$inputNamaIbu = $this->input->post('inputNamaIbu');
      		$inputNamaWali = $this->input->post('inputNamaWali');
      		$inputStatusAyah = $this->input->post('inputStatusAyah');
      		$inputStatusIbu = $this->input->post('inputStatusIbu');
      		$inputStatusWali = $this->input->post('inputStatusWali');
      		$inputTahunAyah = $this->input->post('inputTahunAyah');
      		$inputTahunIbu = $this->input->post('inputTahunIbu');
      		$inputTahunWali = $this->input->post('inputTahunWali');
      		$inputPendidikanAyah = $this->input->post('inputPendidikanAyah');
      		$inputPendidikanIbu = $this->input->post('inputPendidikanIbu');
      		$inputPendidikanWali = $this->input->post('inputPendidikanWali');
      		$inputPekerjaanAyah = $this->input->post('inputPekerjaanAyah');
      		$inputPekerjaanIbu = $this->input->post('inputPekerjaanIbu');
      		$inputPekerjaanWali = $this->input->post('inputPekerjaanWali');
      		$inputTelpAyah = $this->input->post('inputTelpAyah');
      		$inputTelpIbu = $this->input->post('inputTelpIbu');
      		$inputTelpWali = $this->input->post('inputTelpWali');
      		$inputPenghasilan = $this->input->post('inputPenghasilan');
      		$inputStatusTempattinggal = $this->input->post('inputStatusTempattinggal');
      		$inputJarakRumah = $this->input->post('inputJarakRumah');
      		$inputTransportasi = $this->input->post('inputTransportasi');
      		$inputAlamatOrangTua = $this->input->post('inputAlamatOrangTua');
      		$inputDesKel = $this->input->post('inputDesKel', true);
      		$inputKodePos = $this->input->post('inputKodePos', true);
       		$pembagi = explode(".", $inputDesKel);

      		if($inputTglLulus == "1970-01-01"){
      			$tanggalLulus = "0000-00-00";
      		}else{
      			$tanggalLulus = $inputTglLulus;
      		}

      		$dataAyah = $this->input->post('dataAyah', true);
      		$dataIbu = $this->input->post('dataIbu', true);
      		$datawali = $this->input->post('datawali', true);

      		$kirimdata3['loginID'] = $cek_admin[0]['id_login'];
					$kirimdata3['nisn'] = $inputNisn;
					$kirimdata3['anak_ke'] = $inputAnakKe;
					$kirimdata3['jml_saudara'] = $inputJmlSaudara;
					$kirimdata3['hobi'] = $inputHobi;
					$kirimdata3['citacita'] = $inputCitaCita;
					$kirimdata3['jenjang'] = $inputJenjangSekolah;
					$kirimdata3['status_sekolah'] = $inputStatusSekolah;
					$kirimdata3['nama_sekolah'] = $inputNamaSekolah;
					$kirimdata3['npsn'] = $inputNPSN;
					$kirimdata3['alamat_sekolah'] = $inputAlamatSekolah;
					$kirimdata3['kabkot_asalsekolah'] = $inputLokasiSekolah;
					$kirimdata3['no_un'] = $inputNoUN;
					$kirimdata3['no_skhun'] = $inputNoSKHUN;
					$kirimdata3['no_ijazah'] = $inputNoIjazah;
					$kirimdata3['nilai_un'] = $inputNilaiUN;
					$kirimdata3['tgl_lulus'] = $tanggalLulus;
					$kirimdata3['no_kk'] = $inputNoKK;
					$kirimdata3['nama_kk'] = $inputNamaKK;
					
					if($dataAyah == "Ayah"){
						$kirimdata3['nik_ayah'] = $inputNIKAyah;
						$kirimdata3['nama_ayah'] = $inputNamaAyah;
						$kirimdata3['status_ayah'] = $inputStatusAyah;
						$kirimdata3['thn_lahir_ayah'] = $inputTahunAyah;
						$kirimdata3['pendidikan_ayah'] = $inputPendidikanAyah;
						$kirimdata3['pekerjaan_ayah'] = $inputPekerjaanAyah;
						$kirimdata3['nohp_ayah'] = $inputTelpAyah;
					}

					if($dataIbu == "Ibu"){
						$kirimdata3['nik_ibu'] = $inputNIKIbu;
						$kirimdata3['nama_ibu'] = $inputNamaIbu;
						$kirimdata3['status_ibu'] = $inputStatusIbu;
						$kirimdata3['thn_lahir_ibu'] = $inputTahunIbu;
						$kirimdata3['pendidikan_ibu'] = $inputPendidikanIbu;
						$kirimdata3['pekerjaan_ibu'] = $inputPekerjaanIbu;
						$kirimdata3['nohp_ibu'] = $inputTelpIbu;
					}
						
					if($dataWali == "Wali"){
						$kirimdata3['nik_wali'] = $inputNIKWali;
						$kirimdata3['nama_wali'] = $inputNamaWali;
						$kirimdata3['status_wali'] = $inputStatusWali;
						$kirimdata3['thn_lahir_wali'] = $inputTahunWali;
						$kirimdata3['pendidikan_wali'] = $inputPendidikanWali;
						$kirimdata3['pekerjaan_wali'] = $inputPekerjaanWali;
						$kirimdata3['nohp_wali'] = $inputTelpWali;
					}

					$kirimdata3['penghasilan'] = $inputPenghasilan;
					$kirimdata3['alamat_orangtua'] = $inputAlamatOrangTua;
					$kirimdata3['provinsi'] = $pembagi[0];
					$kirimdata3['kabkot'] = $pembagi[1];
					$kirimdata3['kec'] = $pembagi[2];
					$kirimdata3['deskel'] = $pembagi[3];
					$kirimdata3['kodepos'] = $inputKodePos;
					$kirimdata3['status_tempattinggal'] = $inputStatusTempattinggal;
					$kirimdata3['jarakrumah'] = $inputJarakRumah;
					$kirimdata3['transportasi'] = $inputTransportasi;
					$this->main_model->insert_pengguna($kirimdata3,3);

					$kirimdata2['loginID'] = $cek_admin[0]['id_login'];
					$kirimdata2['nomor_induk'] = $inputNoinduk;
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$kirimdata2['gambar'] = $gambar;
					$success = $this->main_model->insert_pengguna($kirimdata2,2);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_siswa');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_siswa');
		 			}
       	}else{
        	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputEmail = $this->input->post('inputEmail');
      		$inputCode = $code;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
					$kirimdata['email'] = $inputEmail;
					$kirimdata['code'] = $code;
					$kirimdata['roleID'] = "4";
					$kirimdata['kondisi_data'] = "1";
					$kirimdata['aktif_state'] = "1";
					$this->main_model->insert_pengguna($kirimdata,1);

					$cek_admin = $this->db->query("SELECT * FROM tbl_login ORDER BY id_login DESC LIMIT 1")->result_array();
      		$inputNoinduk = $this->input->post('inputNoinduk');
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}
      		
      		$inputNisn = $this->input->post('inputNisn');
      		$inputAnakKe = $this->input->post('inputAnakKe');
      		$inputJmlSaudara = $this->input->post('inputJmlSaudara');
      		$inputHobi = $this->input->post('inputHobi');
      		$inputCitaCita = $this->input->post('inputCitaCita');
      		$inputNoUN = $this->input->post('inputNoUN');
      		$inputNoSKHUN = $this->input->post('inputNoSKHUN');
      		$inputNoIjazah = $this->input->post('inputNoIjazah');
      		$inputNamaSekolah = $this->input->post('inputNamaSekolah');
      		$inputNPSN = $this->input->post('inputNPSN');
      		$inputJenjangSekolah = $this->input->post('inputJenjangSekolah');
      		$inputStatusSekolah = $this->input->post('inputStatusSekolah');
      		$inputLokasiSekolah = $this->input->post('inputLokasiSekolah');
      		$inputNilaiUN = $this->input->post('inputNilaiUN');
      		$inputTglLulus = date("Y-m-d",strtotime($this->input->post('inputTglLulus')));
      		$inputAlamatSekolah = $this->input->post('inputAlamatSekolah');
      		$inputNamaKK = $this->input->post('inputNamaKK');
      		$inputNoKK = $this->input->post('inputNoKK');
      		$inputNIKAyah = $this->input->post('inputNIKAyah');
      		$inputNIKIbu = $this->input->post('inputNIKIbu');
      		$inputNIKWali = $this->input->post('inputNIKWali');
      		$inputNamaAyah = $this->input->post('inputNamaAyah');
      		$inputNamaIbu = $this->input->post('inputNamaIbu');
      		$inputNamaWali = $this->input->post('inputNamaWali');
      		$inputStatusAyah = $this->input->post('inputStatusAyah');
      		$inputStatusIbu = $this->input->post('inputStatusIbu');
      		$inputStatusWali = $this->input->post('inputStatusWali');
      		$inputTahunAyah = $this->input->post('inputTahunAyah');
      		$inputTahunIbu = $this->input->post('inputTahunIbu');
      		$inputTahunWali = $this->input->post('inputTahunWali');
      		$inputPendidikanAyah = $this->input->post('inputPendidikanAyah');
      		$inputPendidikanIbu = $this->input->post('inputPendidikanIbu');
      		$inputPendidikanWali = $this->input->post('inputPendidikanWali');
      		$inputPekerjaanAyah = $this->input->post('inputPekerjaanAyah');
      		$inputPekerjaanIbu = $this->input->post('inputPekerjaanIbu');
      		$inputPekerjaanWali = $this->input->post('inputPekerjaanWali');
      		$inputTelpAyah = $this->input->post('inputTelpAyah');
      		$inputTelpIbu = $this->input->post('inputTelpIbu');
      		$inputTelpWali = $this->input->post('inputTelpWali');
      		$inputPenghasilan = $this->input->post('inputPenghasilan');
      		$inputStatusTempattinggal = $this->input->post('inputStatusTempattinggal');
      		$inputJarakRumah = $this->input->post('inputJarakRumah');
      		$inputTransportasi = $this->input->post('inputTransportasi');
      		$inputAlamatOrangTua = $this->input->post('inputAlamatOrangTua');
      		$inputDesKel = $this->input->post('inputDesKel', true);
      		$inputKodePos = $this->input->post('inputKodePos', true);
       		$pembagi = explode(".", $inputDesKel);

      		if($inputTglLulus == "1970-01-01"){
      			$tanggalLulus = "0000-00-00";
      		}else{
      			$tanggalLulus = $inputTglLulus;
      		}

      		$dataAyah = $this->input->post('dataAyah', true);
      		$dataIbu = $this->input->post('dataIbu', true);
      		$dataWali = $this->input->post('dataWali', true);

      		$kirimdata3['loginID'] = $cek_admin[0]['id_login'];
					$kirimdata3['nisn'] = $inputNisn;
					$kirimdata3['anak_ke'] = $inputAnakKe;
					$kirimdata3['jml_saudara'] = $inputJmlSaudara;
					$kirimdata3['hobi'] = $inputHobi;
					$kirimdata3['citacita'] = $inputCitaCita;
					$kirimdata3['jenjang'] = $inputJenjangSekolah;
					$kirimdata3['status_sekolah'] = $inputStatusSekolah;
					$kirimdata3['nama_sekolah'] = $inputNamaSekolah;
					$kirimdata3['npsn'] = $inputNPSN;
					$kirimdata3['alamat_sekolah'] = $inputAlamatSekolah;
					$kirimdata3['kabkot_asalsekolah'] = $inputLokasiSekolah;
					$kirimdata3['no_un'] = $inputNoUN;
					$kirimdata3['no_skhun'] = $inputNoSKHUN;
					$kirimdata3['no_ijazah'] = $inputNoIjazah;
					$kirimdata3['nilai_un'] = $inputNilaiUN;
					$kirimdata3['tgl_lulus'] = $tanggalLulus;
					$kirimdata3['no_kk'] = $inputNoKK;
					$kirimdata3['nama_kk'] = $inputNamaKK;
					
					if($dataAyah == "Ayah"){
						$kirimdata3['nik_ayah'] = $inputNIKAyah;
						$kirimdata3['nama_ayah'] = $inputNamaAyah;
						$kirimdata3['status_ayah'] = $inputStatusAyah;
						$kirimdata3['thn_lahir_ayah'] = $inputTahunAyah;
						$kirimdata3['pendidikan_ayah'] = $inputPendidikanAyah;
						$kirimdata3['pekerjaan_ayah'] = $inputPekerjaanAyah;
						$kirimdata3['nohp_ayah'] = $inputTelpAyah;
					}

					if($dataIbu == "Ibu"){
						$kirimdata3['nik_ibu'] = $inputNIKIbu;
						$kirimdata3['nama_ibu'] = $inputNamaIbu;
						$kirimdata3['status_ibu'] = $inputStatusIbu;
						$kirimdata3['thn_lahir_ibu'] = $inputTahunIbu;
						$kirimdata3['pendidikan_ibu'] = $inputPendidikanIbu;
						$kirimdata3['pekerjaan_ibu'] = $inputPekerjaanIbu;
						$kirimdata3['nohp_ibu'] = $inputTelpIbu;
					}
						
					if($dataWali == "Wali"){
						$kirimdata3['nik_wali'] = $inputNIKWali;
						$kirimdata3['nama_wali'] = $inputNamaWali;
						$kirimdata3['status_wali'] = $inputStatusWali;
						$kirimdata3['thn_lahir_wali'] = $inputTahunWali;
						$kirimdata3['pendidikan_wali'] = $inputPendidikanWali;
						$kirimdata3['pekerjaan_wali'] = $inputPekerjaanWali;
						$kirimdata3['nohp_wali'] = $inputTelpWali;
					}

					$kirimdata3['penghasilan'] = $inputPenghasilan;
					$kirimdata3['alamat_orangtua'] = $inputAlamatOrangTua;
					$kirimdata3['provinsi'] = $pembagi[0];
					$kirimdata3['kabkot'] = $pembagi[1];
					$kirimdata3['kec'] = $pembagi[2];
					$kirimdata3['deskel'] = $pembagi[3];
					$kirimdata3['kodepos'] = $inputKodePos;
					$kirimdata3['status_tempattinggal'] = $inputStatusTempattinggal;
					$kirimdata3['jarakrumah'] = $inputJarakRumah;
					$kirimdata3['transportasi'] = $inputTransportasi;
					$this->main_model->insert_pengguna($kirimdata3,3);

					$kirimdata2['loginID'] = $cek_admin[0]['id_login'];
					$kirimdata2['nomor_induk'] = $inputNoinduk;
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$kirimdata2['gambar'] = '';
					// echo json_encode($kirimdata3);
					$success = $this->main_model->insert_pengguna($kirimdata2,2);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_siswa');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_siswa');
		 			}
       	}
			}
		}

		function edit_siswa($id_login){
			$data = array(
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,3)->result_array(),
	    );
			$this->load->view('dashboard/master_data/siswa/edit_siswa', $data);
		}

		function update_siswa(){
			$this->form_validation->set_rules('inputNoinduk','Input Nomor Induk Siswa', 'required');
			$this->form_validation->set_rules('inputNisn','Input Nomor Induk Siswa Nasional', 'required');
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('inputNoUN','Input Nomor Ujian Nasional', 'required');
			$this->form_validation->set_rules('inputNoSKHUN','Input Nomor SKHUN', 'required');
			$this->form_validation->set_rules('inputNoIjazah','Input Nomor Ijazah', 'required');
			$this->form_validation->set_rules('inputNamaSekolah','Input Nama Sekolah', 'required');
			$this->form_validation->set_rules('inputNPSN','Input NPSN', 'required');
			$this->form_validation->set_rules('inputNilaiUN','Input Nilai Ujian Nasional', 'required');
			$this->form_validation->set_rules('inputTglLulus','Input Tanggal Lulus', 'required');
			$this->form_validation->set_rules('inputNamaKK','Input Nama Kepala Keluarga', 'required');
			$this->form_validation->set_rules('inputNoKK','Input Nomor Kartu Keluarga', 'required');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_siswa');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
       	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
       	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

	     	$this->upload->initialize($config);
	  		if(!empty($_FILES['foto']['name'])){

          if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
      		}

      		$login_id = $this->input->post('login_id');
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputEmail = $this->input->post('inputEmail');
      		if(!empty($this->input->post('inputPassword'))){
	    			$inputPassword = md5($this->input->post('inputPassword', true)); 
						$kirimdata['password'] = $inputPassword;
						$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
	    		}
      		$status = $this->input->post('kondisi');
					$kirimdata['username'] = $inputUsername;
					$kirimdata['email'] = $inputEmail;
					$this->main_model->update_profil($kirimdata, 1, $id_login);

      		$inputNoinduk = $this->input->post('inputNoinduk');
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

      		$inputNisn = $this->input->post('inputNisn');
      		$inputAnakKe = $this->input->post('inputAnakKe');
      		$inputJmlSaudara = $this->input->post('inputJmlSaudara');
      		$inputHobi = $this->input->post('inputHobi');
      		$inputCitaCita = $this->input->post('inputCitaCita');
      		$inputNoUN = $this->input->post('inputNoUN');
      		$inputNoSKHUN = $this->input->post('inputNoSKHUN');
      		$inputNoIjazah = $this->input->post('inputNoIjazah');
      		$inputNamaSekolah = $this->input->post('inputNamaSekolah');
      		$inputNPSN = $this->input->post('inputNPSN');
      		$inputJenjangSekolah = $this->input->post('inputJenjangSekolah');
      		$inputStatusSekolah = $this->input->post('inputStatusSekolah');
      		$inputLokasiSekolah = $this->input->post('inputLokasiSekolah');
      		$inputNilaiUN = $this->input->post('inputNilaiUN');
      		$inputTglLulus = date("Y-m-d",strtotime($this->input->post('inputTglLulus')));
      		$inputAlamatSekolah = $this->input->post('inputAlamatSekolah');
      		$inputNamaKK = $this->input->post('inputNamaKK');
      		$inputNoKK = $this->input->post('inputNoKK');
      		$inputNIKAyah = $this->input->post('inputNIKAyah');
      		$inputNIKIbu = $this->input->post('inputNIKIbu');
      		$inputNIKWali = $this->input->post('inputNIKWali');
      		$inputNamaAyah = $this->input->post('inputNamaAyah');
      		$inputNamaIbu = $this->input->post('inputNamaIbu');
      		$inputNamaWali = $this->input->post('inputNamaWali');
      		$inputStatusAyah = $this->input->post('inputStatusAyah');
      		$inputStatusIbu = $this->input->post('inputStatusIbu');
      		$inputStatusWali = $this->input->post('inputStatusWali');
      		$inputTahunAyah = $this->input->post('inputTahunAyah');
      		$inputTahunIbu = $this->input->post('inputTahunIbu');
      		$inputTahunWali = $this->input->post('inputTahunWali');
      		$inputPendidikanAyah = $this->input->post('inputPendidikanAyah');
      		$inputPendidikanIbu = $this->input->post('inputPendidikanIbu');
      		$inputPendidikanWali = $this->input->post('inputPendidikanWali');
      		$inputPekerjaanAyah = $this->input->post('inputPekerjaanAyah');
      		$inputPekerjaanIbu = $this->input->post('inputPekerjaanIbu');
      		$inputPekerjaanWali = $this->input->post('inputPekerjaanWali');
      		$inputTelpAyah = $this->input->post('inputTelpAyah');
      		$inputTelpIbu = $this->input->post('inputTelpIbu');
      		$inputTelpWali = $this->input->post('inputTelpWali');
      		$inputPenghasilan = $this->input->post('inputPenghasilan');
      		$inputStatusTempattinggal = $this->input->post('inputStatusTempattinggal');
      		$inputJarakRumah = $this->input->post('inputJarakRumah');
      		$inputTransportasi = $this->input->post('inputTransportasi');
      		$inputAlamatOrangTua = $this->input->post('inputAlamatOrangTua');
      		$inputDesKel = $this->input->post('inputDesKel', true);
      		$inputKodePos = $this->input->post('inputKodePos', true);
       		$pembagi = explode(".", $inputDesKel);

      		if($inputTglLulus == "1970-01-01"){
      			$tanggalLulus = "0000-00-00";
      		}else{
      			$tanggalLulus = $inputTglLulus;
      		}

					$dataAyah = $this->input->post('dataAyah', true);
      		$dataIbu = $this->input->post('dataIbu', true);
      		$dataWali = $this->input->post('dataWali', true);

					$kirimdata3['nisn'] = $inputNisn;
					$kirimdata3['anak_ke'] = $inputAnakKe;
					$kirimdata3['jml_saudara'] = $inputJmlSaudara;
					$kirimdata3['hobi'] = $inputHobi;
					$kirimdata3['citacita'] = $inputCitaCita;
					$kirimdata3['jenjang'] = $inputJenjangSekolah;
					$kirimdata3['status_sekolah'] = $inputStatusSekolah;
					$kirimdata3['nama_sekolah'] = $inputNamaSekolah;
					$kirimdata3['npsn'] = $inputNPSN;
					$kirimdata3['alamat_sekolah'] = $inputAlamatSekolah;
					$kirimdata3['kabkot_asalsekolah'] = $inputLokasiSekolah;
					$kirimdata3['no_un'] = $inputNoUN;
					$kirimdata3['no_skhun'] = $inputNoSKHUN;
					$kirimdata3['no_ijazah'] = $inputNoIjazah;
					$kirimdata3['nilai_un'] = $inputNilaiUN;
					$kirimdata3['tgl_lulus'] = $tanggalLulus;
					$kirimdata3['no_kk'] = $inputNoKK;
					$kirimdata3['nama_kk'] = $inputNamaKK;
					
					if($dataAyah == "Ayah"){
						$kirimdata3['nik_ayah'] = $inputNIKAyah;
						$kirimdata3['nama_ayah'] = $inputNamaAyah;
						$kirimdata3['status_ayah'] = $inputStatusAyah;
						$kirimdata3['thn_lahir_ayah'] = $inputTahunAyah;
						$kirimdata3['pendidikan_ayah'] = $inputPendidikanAyah;
						$kirimdata3['pekerjaan_ayah'] = $inputPekerjaanAyah;
						$kirimdata3['nohp_ayah'] = $inputTelpAyah;
					}

					if($dataIbu == "Ibu"){
						$kirimdata3['nik_ibu'] = $inputNIKIbu;
						$kirimdata3['nama_ibu'] = $inputNamaIbu;
						$kirimdata3['status_ibu'] = $inputStatusIbu;
						$kirimdata3['thn_lahir_ibu'] = $inputTahunIbu;
						$kirimdata3['pendidikan_ibu'] = $inputPendidikanIbu;
						$kirimdata3['pekerjaan_ibu'] = $inputPekerjaanIbu;
						$kirimdata3['nohp_ibu'] = $inputTelpIbu;
					}
						
					if($dataWali == "Wali"){
						$kirimdata3['nik_wali'] = $inputNIKWali;
						$kirimdata3['nama_wali'] = $inputNamaWali;
						$kirimdata3['status_wali'] = $inputStatusWali;
						$kirimdata3['thn_lahir_wali'] = $inputTahunWali;
						$kirimdata3['pendidikan_wali'] = $inputPendidikanWali;
						$kirimdata3['pekerjaan_wali'] = $inputPekerjaanWali;
						$kirimdata3['nohp_wali'] = $inputTelpWali;
					}

					$kirimdata3['penghasilan'] = $inputPenghasilan;
					$kirimdata3['alamat_orangtua'] = $inputAlamatOrangTua;
					$kirimdata3['provinsi'] = $pembagi[0];
					$kirimdata3['kabkot'] = $pembagi[1];
					$kirimdata3['kec'] = $pembagi[2];
					$kirimdata3['deskel'] = $pembagi[3];
					$kirimdata3['kodepos'] = $inputKodePos;
					$kirimdata3['status_tempattinggal'] = $inputStatusTempattinggal;
					$kirimdata3['jarakrumah'] = $inputJarakRumah;
					$kirimdata3['transportasi'] = $inputTransportasi;
					$this->main_model->update_profil($kirimdata3, 3, $login_id);

					$kirimdata2['nomor_induk'] = $inputNoinduk;
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata2['gambar'] = $gambar;
					}
					$success = $this->main_model->update_profil($kirimdata2, 2, $login_id);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_siswa');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_siswa');
		 			}
        }else{
      		$login_id = $this->input->post('login_id');
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputEmail = $this->input->post('inputEmail');
      		if(!empty($this->input->post('inputPassword'))){
	    			$inputPassword = md5($this->input->post('inputPassword', true)); 
						$kirimdata['password'] = $inputPassword;
						$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
	    		}
      		$kirimdata['username'] = $inputUsername;
					$kirimdata['email'] = $inputEmail;
					$this->main_model->update_profil($kirimdata, 1, $login_id);

      		$inputNoinduk = $this->input->post('inputNoinduk');
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

      		$inputNisn = $this->input->post('inputNisn');
      		$inputAnakKe = $this->input->post('inputAnakKe');
      		$inputJmlSaudara = $this->input->post('inputJmlSaudara');
      		$inputHobi = $this->input->post('inputHobi');
      		$inputCitaCita = $this->input->post('inputCitaCita');
      		$inputNoUN = $this->input->post('inputNoUN');
      		$inputNoSKHUN = $this->input->post('inputNoSKHUN');
      		$inputNoIjazah = $this->input->post('inputNoIjazah');
      		$inputNamaSekolah = $this->input->post('inputNamaSekolah');
      		$inputNPSN = $this->input->post('inputNPSN');
      		$inputJenjangSekolah = $this->input->post('inputJenjangSekolah');
      		$inputStatusSekolah = $this->input->post('inputStatusSekolah');
      		$inputLokasiSekolah = $this->input->post('inputLokasiSekolah');
      		$inputNilaiUN = $this->input->post('inputNilaiUN');
      		$inputTglLulus = date("Y-m-d",strtotime($this->input->post('inputTglLulus')));
      		$inputAlamatSekolah = $this->input->post('inputAlamatSekolah');
      		$inputNamaKK = $this->input->post('inputNamaKK');
      		$inputNoKK = $this->input->post('inputNoKK');
      		$inputNIKAyah = $this->input->post('inputNIKAyah');
      		$inputNIKIbu = $this->input->post('inputNIKIbu');
      		$inputNIKWali = $this->input->post('inputNIKWali');
      		$inputNamaAyah = $this->input->post('inputNamaAyah');
      		$inputNamaIbu = $this->input->post('inputNamaIbu');
      		$inputNamaWali = $this->input->post('inputNamaWali');
      		$inputStatusAyah = $this->input->post('inputStatusAyah');
      		$inputStatusIbu = $this->input->post('inputStatusIbu');
      		$inputStatusWali = $this->input->post('inputStatusWali');
      		$inputTahunAyah = $this->input->post('inputTahunAyah');
      		$inputTahunIbu = $this->input->post('inputTahunIbu');
      		$inputTahunWali = $this->input->post('inputTahunWali');
      		$inputPendidikanAyah = $this->input->post('inputPendidikanAyah');
      		$inputPendidikanIbu = $this->input->post('inputPendidikanIbu');
      		$inputPendidikanWali = $this->input->post('inputPendidikanWali');
      		$inputPekerjaanAyah = $this->input->post('inputPekerjaanAyah');
      		$inputPekerjaanIbu = $this->input->post('inputPekerjaanIbu');
      		$inputPekerjaanWali = $this->input->post('inputPekerjaanWali');
      		$inputTelpAyah = $this->input->post('inputTelpAyah');
      		$inputTelpIbu = $this->input->post('inputTelpIbu');
      		$inputTelpWali = $this->input->post('inputTelpWali');
      		$inputPenghasilan = $this->input->post('inputPenghasilan');
      		$inputStatusTempattinggal = $this->input->post('inputStatusTempattinggal');
      		$inputJarakRumah = $this->input->post('inputJarakRumah');
      		$inputTransportasi = $this->input->post('inputTransportasi');
      		$inputAlamatOrangTua = $this->input->post('inputAlamatOrangTua');
      		$inputDesKel = $this->input->post('inputDesKel', true);
      		$inputKodePos = $this->input->post('inputKodePos', true);
       		$pembagi = explode(".", $inputDesKel);

      		if($inputTglLulus == "1970-01-01"){
      			$tanggalLulus = "0000-00-00";
      		}else{
      			$tanggalLulus = $inputTglLulus;
      		}

					$dataAyah = $this->input->post('dataAyah', true);
      		$dataIbu = $this->input->post('dataIbu', true);
      		$dataWali = $this->input->post('dataWali', true);

					$kirimdata3['nisn'] = $inputNisn;
					$kirimdata3['anak_ke'] = $inputAnakKe;
					$kirimdata3['jml_saudara'] = $inputJmlSaudara;
					$kirimdata3['hobi'] = $inputHobi;
					$kirimdata3['citacita'] = $inputCitaCita;
					$kirimdata3['jenjang'] = $inputJenjangSekolah;
					$kirimdata3['status_sekolah'] = $inputStatusSekolah;
					$kirimdata3['nama_sekolah'] = $inputNamaSekolah;
					$kirimdata3['npsn'] = $inputNPSN;
					$kirimdata3['alamat_sekolah'] = $inputAlamatSekolah;
					$kirimdata3['kabkot_asalsekolah'] = $inputLokasiSekolah;
					$kirimdata3['no_un'] = $inputNoUN;
					$kirimdata3['no_skhun'] = $inputNoSKHUN;
					$kirimdata3['no_ijazah'] = $inputNoIjazah;
					$kirimdata3['nilai_un'] = $inputNilaiUN;
					$kirimdata3['tgl_lulus'] = $tanggalLulus;
					$kirimdata3['no_kk'] = $inputNoKK;
					$kirimdata3['nama_kk'] = $inputNamaKK;
					
					if($dataAyah == "Ayah"){
						$kirimdata3['nik_ayah'] = $inputNIKAyah;
						$kirimdata3['nama_ayah'] = $inputNamaAyah;
						$kirimdata3['status_ayah'] = $inputStatusAyah;
						$kirimdata3['thn_lahir_ayah'] = $inputTahunAyah;
						$kirimdata3['pendidikan_ayah'] = $inputPendidikanAyah;
						$kirimdata3['pekerjaan_ayah'] = $inputPekerjaanAyah;
						$kirimdata3['nohp_ayah'] = $inputTelpAyah;
					}

					if($dataIbu == "Ibu"){
						$kirimdata3['nik_ibu'] = $inputNIKIbu;
						$kirimdata3['nama_ibu'] = $inputNamaIbu;
						$kirimdata3['status_ibu'] = $inputStatusIbu;
						$kirimdata3['thn_lahir_ibu'] = $inputTahunIbu;
						$kirimdata3['pendidikan_ibu'] = $inputPendidikanIbu;
						$kirimdata3['pekerjaan_ibu'] = $inputPekerjaanIbu;
						$kirimdata3['nohp_ibu'] = $inputTelpIbu;
					}
						
					if($dataWali == "Wali"){
						$kirimdata3['nik_wali'] = $inputNIKWali;
						$kirimdata3['nama_wali'] = $inputNamaWali;
						$kirimdata3['status_wali'] = $inputStatusWali;
						$kirimdata3['thn_lahir_wali'] = $inputTahunWali;
						$kirimdata3['pendidikan_wali'] = $inputPendidikanWali;
						$kirimdata3['pekerjaan_wali'] = $inputPekerjaanWali;
						$kirimdata3['nohp_wali'] = $inputTelpWali;
					}

					$kirimdata3['penghasilan'] = $inputPenghasilan;
					$kirimdata3['alamat_orangtua'] = $inputAlamatOrangTua;
					$kirimdata3['provinsi'] = $pembagi[0];
					$kirimdata3['kabkot'] = $pembagi[1];
					$kirimdata3['kec'] = $pembagi[2];
					$kirimdata3['deskel'] = $pembagi[3];
					$kirimdata3['kodepos'] = $inputKodePos;
					$kirimdata3['status_tempattinggal'] = $inputStatusTempattinggal;
					$kirimdata3['jarakrumah'] = $inputJarakRumah;
					$kirimdata3['transportasi'] = $inputTransportasi;
					$this->main_model->update_profil($kirimdata3, 3, $login_id);

					$kirimdata2['nomor_induk'] = $inputNoinduk;
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata2['gambar'] = '';
					}
					$success = $this->main_model->update_profil($kirimdata2, 2, $login_id);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_siswa');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_siswa');
		 			}
        }
			}
		}

		function detail_siswa($id_login){
			$data = array(
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,3)->result_array(),
	    );
			$this->load->view('dashboard/master_data/siswa/detail_siswa', $data);
		}

		function delete_siswa($id_login){
      $success = $this->main_model->hapus_pengguna($id_login,3);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_siswa');
  	}

  	function delete_siswa_all(){
      $id_login = $this->input->post('pilih');
      $jumlah_dipilih = count($id_login);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_pengguna($id_login[$x],3);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_siswa');
  	}

  	function import_siswa(){
  		error_reporting(0);
  		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
  		$config['upload_path'] = './assets/excel_import/data_siswa/'; //path folder
     	$config['allowed_types'] = 'xlsx'; //type yang dapat diakses bisa anda sesuaikan
     	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
     	$config['max_size'] = '2048';
     	$config['overwrite'] = true;
      $config['file_name'] = $this->filename_siswa.date("Y-m-d");

	    $this->upload->initialize($config);
      if(!empty($_FILES['dataSiswa']['name'])){

	    	if ($this->upload->do_upload('dataSiswa')){
        	$upload = $this->upload->data();
        	$upload['hasil_upload'] = "success";
        }else{
        	$upload['hasil_upload'] = "failed";
        }
      }

			if($upload['hasil_upload'] == "success"){
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/excel_import/data_siswa/'.$this->filename_siswa.date("Y-m-d").'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				$numrow = 1;
				foreach($sheet as $row){
					if($numrow > 1){
						$cek_admin = $this->db->query("SELECT * FROM tbl_login ORDER BY id_login DESC LIMIT 1")->result_array();
						$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$code = substr(str_shuffle($set), 0, 15);
						$kirimdata['username'] = $row['D'];
						$kirimdata['password'] = md5($row['E']);
						$kirimdata['katasandi'] = $row['E'];
						$kirimdata['code'] = $code;
						$kirimdata['roleID'] = '4';
						$kirimdata['kondisi_data'] = "1";
						$kirimdata['aktif_state'] = "1";
						$this->main_model->insert_pengguna($kirimdata,1);

						$kirimdata3['loginID'] = $cek_admin[0]['id_login'];
						$kirimdata3['nisn'] = $row['B'];
						$kirimdata3['anak_ke'] = $row['I'];
						$kirimdata3['jml_saudara'] = $row['J'];
						$kirimdata3['hobi'] = $row['K'];
						$kirimdata3['citacita'] = $row['L'];
						$kirimdata3['jenjang'] = $row['R'];
						$kirimdata3['status_sekolah'] = $row['S'];
						$kirimdata3['nama_sekolah'] = $row['P'];
						$kirimdata3['npsn'] = $row['Q'];
						$kirimdata3['alamat_sekolah'] = $row['W'];
						$kirimdata3['kabkot_asalsekolah'] = $row['T'];
						$kirimdata3['no_un'] = $row['M'];
						$kirimdata3['no_skhun'] = $row['N'];
						$kirimdata3['no_ijazah'] = $row['O'];
						$kirimdata3['nilai_un'] = $row['U'];
						$kirimdata3['tgl_lulus'] = $row['V'];
						$kirimdata3['no_kk'] = $row['X'];
						$kirimdata3['nama_kk'] = $row['Y'];
						$kirimdata3['nik_ayah'] = $row['AJ'];
						$kirimdata3['nama_ayah'] = $row['AK'];
						$kirimdata3['status_ayah'] = $row['AL'];
						$kirimdata3['thn_lahir_ayah'] = $row['AM'];
						$kirimdata3['pendidikan_ayah'] = $row['AN'];
						$kirimdata3['pekerjaan_ayah'] = $row['AO'];
						$kirimdata3['nohp_ayah'] = $row['AP'];
						$kirimdata3['nik_ibu'] = $row['AQ'];
						$kirimdata3['nama_ibu'] = $row['AR'];
						$kirimdata3['status_ibu'] = $row['AS'];
						$kirimdata3['thn_lahir_ibu'] = $row['AT'];
						$kirimdata3['pendidikan_ibu'] = $row['AU'];
						$kirimdata3['pekerjaan_ibu'] = $row['AV'];
						$kirimdata3['nohp_ibu'] = $row['AW'];
						$kirimdata3['nik_wali'] = $row['AX'];
						$kirimdata3['nama_wali'] = $row['AY'];
						$kirimdata3['status_wali'] = $row['AZ'];
						$kirimdata3['thn_lahir_wali'] = $row['BA'];
						$kirimdata3['pendidikan_wali'] = $row['BB'];
						$kirimdata3['pekerjaan_wali'] = $row['BC'];
						$kirimdata3['nohp_wali'] = $row['BD'];
						$kirimdata3['penghasilan'] = $row['Z'];
						$kirimdata3['alamat_orangtua'] = $row['AA'];
						$kirimdata3['provinsi'] = $row['AB'];
						$kirimdata3['kabkot'] = $row['AC'];
						$kirimdata3['kec'] = $row['AD'];
						$kirimdata3['deskel'] = $row['AE'];
						$kirimdata3['kodepos'] = $row['AF'];
						$kirimdata3['status_tempattinggal'] = $row['AG'];
						$kirimdata3['jarakrumah'] = $row['AH'];
						$kirimdata3['transportasi'] = $row['AI'];
						$this->main_model->insert_pengguna($kirimdata3,3);

						$kirimdata2['loginID'] = $cek_admin[0]['id_login'];
						$kirimdata2['nomor_induk'] = $row['A'];
						$kirimdata2['nama'] = $row['C'];
						$kirimdata2['tempat'] = $row['G'];
						$kirimdata2['tgl_lahir'] = $row['H'];
						$kirimdata2['jk'] = $row['F'];
						$this->main_model->insert_pengguna($kirimdata2,2);
					}
					$numrow++;
				}
				$this->session->set_flashdata('success', 'Import Data Siswa berhasil !!! Terimakasih ..');
	    	redirect('v_siswa');
			}else{
				$this->session->set_flashdata('error', 'Import Data Siswa gagal !!! Terimakasih ..');
	    	redirect('v_siswa');
			}
  	}

  	function ambil_kelas_siswa($id_login){
			$data = array(
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,3)->result_array(),
				'data_kelas' => $this->main_model->get_all_kelas_siswaBy($id_login)->result_array(),
				'jmldata_kelas' => $this->main_model->get_all_kelas_siswaBy($id_login)->num_rows(),
	    );
			$this->load->view('dashboard/master_data/siswa/ambil_kelas_siswa', $data);
		}

		function lihat_nilai($id_mapel,$id_kelas,$id_guru,$id_siswa){
			$data = array(
				'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_siswa,3)->result_array(),
	      'lihat_nilai' => $this->main_model->lihat_nilai($id_mapel,$id_kelas,$id_guru,$id_siswa)->result_array(),
	      'jml_lihat_nilai' => $this->main_model->lihat_nilai($id_mapel,$id_kelas,$id_guru,$id_siswa)->num_rows(),
	    );
			$this->load->view('dashboard/master_data/siswa/lihat_nilai', $data);
		}

  	//Guru
		function v_guru(){
			$data = array(
	      'data_pengguna' => $this->main_model->get_all_guru(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/guru/v_guru', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function data_guru(){
			$data = array(
	      'data_pengguna' => $this->main_model->get_all_guruPanel(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/guru/v_guru_panelSiswa', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function save_guru(){
			// $this->form_validation->set_rules('inputNoinduk','Input Nomor Induk Pegawai', 'required');
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			// $this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('inputPassword','Input Password', 'required|min_length[6]|max_length[50]');
			$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_guru');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
       	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
       	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

		    $this->upload->initialize($config);
        if(!empty($_FILES['foto']['name'])){

		    	if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
          }
                    
          $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputEmail = $this->input->post('inputEmail');
      		$inputCode = $code;
      		$level = $this->input->post('level');
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
					$kirimdata['email'] = $inputEmail;
					$kirimdata['code'] = $code;
					$kirimdata['roleID'] = "3";
					$kirimdata['kondisi_data'] = "1";
					$kirimdata['aktif_state'] = "1";
					$this->main_model->insert_pengguna($kirimdata,1);

					$cek_admin = $this->db->query("SELECT * FROM tbl_login ORDER BY id_login DESC LIMIT 1")->result_array();
      		$inputNoinduk = $this->input->post('inputNoinduk');
      		$inputNUPTK = $this->input->post('inputNUPTK');
      		$inputNRG = $this->input->post('inputNRG');
      		$gty_gtt = $this->input->post('gty_gtt');
      		$inputGolongan = $this->input->post('inputGolongan');
      		$inputNIPY = $this->input->post('inputNIPY');
      		$inputTMT = date("Y-m-d",strtotime($this->input->post('inputTMT')));
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$inputJabatan = $this->input->post('inputJabatan');
      		$inputPendidikan = $this->input->post('inputPendidikan');
      		$inputStatusPernikahan = $this->input->post('inputStatusPernikahan');
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

      		if($inputTMT == "1970-01-01"){
      			$tanggalTMT = "0000-00-00";
      		}else{
      			$tanggalTMT = $inputTMT;
      		}

					$kirimdata2['loginID'] = $cek_admin[0]['id_login'];
					$kirimdata2['nomor_induk'] = $inputNoinduk;
					$kirimdata2['nuptk'] = $inputNUPTK;
					$kirimdata2['nrg'] = $inputNRG;
					$kirimdata2['gty_gtt'] = $gty_gtt;
					$kirimdata2['gol'] = $inputGolongan;
					$kirimdata2['nipy'] = $inputNIPY;
					$kirimdata2['tmt'] = $tanggalTMT;
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jabatan'] = $inputJabatan;
					$kirimdata2['pendidikan'] = $inputPendidikan;
					$kirimdata2['status_pernikahan'] = $inputStatusPernikahan;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$kirimdata2['gambar'] = $gambar;
					$success = $this->main_model->insert_pengguna($kirimdata2,2);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_guru');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_guru');
		 			}
       	}else{
        	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputEmail = $this->input->post('inputEmail');
      		$inputCode = $code;
      		$level = $this->input->post('level');
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
					$kirimdata['email'] = $inputEmail;
					$kirimdata['code'] = $code;
					$kirimdata['roleID'] = "3";
					$kirimdata['kondisi_data'] = "1";
					$kirimdata['aktif_state'] = "1";
					$this->main_model->insert_pengguna($kirimdata,1);

					$cek_admin = $this->db->query("SELECT * FROM tbl_login ORDER BY id_login DESC LIMIT 1")->result_array();
      		$inputNoinduk = $this->input->post('inputNoinduk');
      		$inputNUPTK = $this->input->post('inputNUPTK');
      		$inputNRG = $this->input->post('inputNRG');
      		$gty_gtt = $this->input->post('gty_gtt');
      		$inputGolongan = $this->input->post('inputGolongan');
      		$inputNIPY = $this->input->post('inputNIPY');
      		$inputTMT = date("Y-m-d",strtotime($this->input->post('inputTMT')));
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$inputJabatan = $this->input->post('inputJabatan');
      		$inputPendidikan = $this->input->post('inputPendidikan');
      		$inputStatusPernikahan = $this->input->post('inputStatusPernikahan');
      		$jk = $this->input->post('jk');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

      		if($inputTMT == "1970-01-01"){
      			$tanggalTMT = "0000-00-00";
      		}else{
      			$tanggalTMT = $inputTMT;
      		}

					$kirimdata2['loginID'] = $cek_admin[0]['id_login'];
					$kirimdata2['nomor_induk'] = $inputNoinduk;
					$kirimdata2['nuptk'] = $inputNUPTK;
					$kirimdata2['nrg'] = $inputNRG;
					$kirimdata2['gty_gtt'] = $gty_gtt;
					$kirimdata2['gol'] = $inputGolongan;
					$kirimdata2['nipy'] = $inputNIPY;
					$kirimdata2['tmt'] = $tanggalTMT;
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jabatan'] = $inputJabatan;
					$kirimdata2['pendidikan'] = $inputPendidikan;
					$kirimdata2['status_pernikahan'] = $inputStatusPernikahan;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$kirimdata2['gambar'] = '';
					$success = $this->main_model->insert_pengguna($kirimdata2,2);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_guru');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_guru');
		 			}
       	}
			}
		}

		function edit_guru($id_login){
			$data = array(
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,2)->result_array(),
	    );
			$this->load->view('dashboard/master_data/guru/edit_guru', $data);
		}

		function update_guru(){
			// $this->form_validation->set_rules('inputNoinduk','Input Nomor Induk Pegawai', 'required');
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			// $this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('info', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_guru');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
       	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
       	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

	     	$this->upload->initialize($config);
	  		if(!empty($_FILES['foto']['name'])){

          if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
      		}

      		$login_id = $this->input->post('login_id');
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputEmail = $this->input->post('inputEmail');
      		if(!empty($this->input->post('inputPassword'))){
	    			$inputPassword = md5($this->input->post('inputPassword', true)); 
						$kirimdata['password'] = $inputPassword;
						$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
	    		}
      		$status = $this->input->post('kondisi');
					$kirimdata['username'] = $inputUsername;
					$kirimdata['email'] = $inputEmail;
					$this->main_model->update_profil($kirimdata, 1, $id_login);

      		$inputNoinduk = $this->input->post('inputNoinduk');
      		$inputNUPTK = $this->input->post('inputNUPTK');
      		$inputNRG = $this->input->post('inputNRG');
      		$gty_gtt = $this->input->post('gty_gtt');
      		$inputGolongan = $this->input->post('inputGolongan');
      		$inputNIPY = $this->input->post('inputNIPY');
      		$inputTMT = date("Y-m-d",strtotime($this->input->post('inputTMT')));
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputJabatan = $this->input->post('inputJabatan');
      		$inputPendidikan = $this->input->post('inputPendidikan');
      		$inputStatusPernikahan = $this->input->post('inputStatusPernikahan');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

      		if($inputTMT == "1970-01-01"){
      			$tanggalTMT = "0000-00-00";
      		}else{
      			$tanggalTMT = $inputTMT;
      		}

					$kirimdata2['nomor_induk'] = $inputNoinduk;
					$kirimdata2['nuptk'] = $inputNUPTK;
					$kirimdata2['nrg'] = $inputNRG;
					$kirimdata2['gty_gtt'] = $gty_gtt;
					$kirimdata2['gol'] = $inputGolongan;
					$kirimdata2['nipy'] = $inputNIPY;
					$kirimdata2['tmt'] = $tanggalTMT;
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jabatan'] = $inputJabatan;
					$kirimdata2['pendidikan'] = $inputPendidikan;
					$kirimdata2['status_pernikahan'] = $inputStatusPernikahan;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata2['gambar'] = $gambar;
					}
					$success = $this->main_model->update_profil($kirimdata2, 2, $login_id);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_guru');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_guru');
		 			}
        }else{
      		$login_id = $this->input->post('login_id');
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputEmail = $this->input->post('inputEmail');
      		if(!empty($this->input->post('inputPassword'))){
	    			$inputPassword = md5($this->input->post('inputPassword', true)); 
						$kirimdata['password'] = $inputPassword;
						$kirimdata['katasandi'] = $this->input->post('inputPassword', true);
	    		}
      		$kirimdata['username'] = $inputUsername;
					$kirimdata['email'] = $inputEmail;
					$this->main_model->update_profil($kirimdata, 1, $login_id);

      		$inputNoinduk = $this->input->post('inputNoinduk');
      		$inputNUPTK = $this->input->post('inputNUPTK');
      		$inputNRG = $this->input->post('inputNRG');
      		$gty_gtt = $this->input->post('gty_gtt');
      		$inputGolongan = $this->input->post('inputGolongan');
      		$inputNIPY = $this->input->post('inputNIPY');
      		$inputTMT = date("Y-m-d",strtotime($this->input->post('inputTMT')));
      		$inputNama = $this->input->post('inputNama');
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$inputJabatan = $this->input->post('inputJabatan');
      		$inputPendidikan = $this->input->post('inputPendidikan');
      		$inputStatusPernikahan = $this->input->post('inputStatusPernikahan');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

      		if($inputTMT == "1970-01-01"){
      			$tanggalTMT = "0000-00-00";
      		}else{
      			$tanggalTMT = $inputTMT;
      		}

					$kirimdata2['nomor_induk'] = $inputNoinduk;
					$kirimdata2['nuptk'] = $inputNUPTK;
					$kirimdata2['nrg'] = $inputNRG;
					$kirimdata2['gty_gtt'] = $gty_gtt;
					$kirimdata2['gol'] = $inputGolongan;
					$kirimdata2['nipy'] = $inputNIPY;
					$kirimdata2['tmt'] = $tanggalTMT;
					$kirimdata2['nama'] = $inputNama;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jabatan'] = $inputJabatan;
					$kirimdata2['pendidikan'] = $inputPendidikan;
					$kirimdata2['status_pernikahan'] = $inputStatusPernikahan;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata2['gambar'] = '';
					}
					$success = $this->main_model->update_profil($kirimdata2, 2, $login_id);
					
		 			if($success){
		 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_guru');
		 			}else{
		 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_guru');
		 			}
        }
			}
		}

		function detail_guru($id_login){
			$data = array(
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,2)->result_array(),
	      'data_mengajar' => $this->main_model->get_all_sk_mengajarBy($id_login),
	    );
			$this->load->view('dashboard/master_data/guru/detail_guru', $data);
		}

		function delete_guru($id_login){
      $success = $this->main_model->hapus_pengguna($id_login,2);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_guru');
  	}

  	function delete_guru_all(){
      $id_login = $this->input->post('pilih');
      $jumlah_dipilih = count($id_login);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_pengguna($id_login[$x],2);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_guru');
  	}

  	function import_guru(){
  		error_reporting(0);
  		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
  		$config['upload_path'] = './assets/excel_import/data_guru/'; //path folder
     	$config['allowed_types'] = 'xlsx'; //type yang dapat diakses bisa anda sesuaikan
     	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
     	$config['max_size'] = '2048';
     	$config['overwrite'] = true;
      $config['file_name'] = $this->filename_guru.date("Y-m-d");

	    $this->upload->initialize($config);
      if(!empty($_FILES['dataGuru']['name'])){

	    	if ($this->upload->do_upload('dataGuru')){
        	$upload = $this->upload->data();
        	$upload['hasil_upload'] = "success";
        }else{
        	$upload['hasil_upload'] = "failed";
        }
      }

			if($upload['hasil_upload'] == "success"){
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/excel_import/data_guru/'.$this->filename_guru.date("Y-m-d").'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

				$numbaris = 1;
				foreach($sheet as $baris){
					if($numbaris > 1){
						$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$code = substr(str_shuffle($set), 0, 15);
						$kirimdata['username'] = $baris['I'];
						$kirimdata['password'] = md5($baris['J']);
						$kirimdata['katasandi'] = $baris['J'];
						$kirimdata['code'] = $code;
						$kirimdata['roleID'] = '3';
						$kirimdata['kondisi_data'] = "1";
						$kirimdata['aktif_state'] = "1";
						$this->main_model->insert_pengguna($kirimdata,1);

						$cek_admin = $this->db->query("SELECT * FROM tbl_login ORDER BY id_login DESC LIMIT 1")->result_array();
						$kirimdata2['loginID'] = $cek_admin[0]['id_login'];
						$kirimdata2['nomor_induk'] = $baris['A'];
						$kirimdata2['nuptk'] = $baris['B'];
						$kirimdata2['nrg'] = $baris['C'];
						$kirimdata2['gty_gtt'] = $baris['E'];
						$kirimdata2['gol'] = $baris['F'];
						$kirimdata2['nipy'] = $baris['D'];
						$kirimdata2['tmt'] = $baris['G'];
						$kirimdata2['nama'] = $baris['H'];
						$kirimdata2['tempat'] = $baris['L'];
						$kirimdata2['tgl_lahir'] = $baris['M'];
						$kirimdata2['jabatan'] = $baris['N'];
						$kirimdata2['pendidikan'] = $baris['O'];
						$kirimdata2['status_pernikahan'] = $baris['P'];
						$kirimdata2['jk'] = $baris['K'];
						$this->main_model->insert_pengguna($kirimdata2,2);
						// var_dump($kirimdata);
						// echo"<br>";
						// var_dump($kirimdata2);
						// echo $numbaris;
					}
					$numbaris++;
				}
				$this->session->set_flashdata('success', 'Import Data Guru berhasil !!! Terimakasih ..');
	    	redirect('v_guru');
			}else{
				$this->session->set_flashdata('error', 'Import Data Guru gagal !!! Terimakasih ..');
	    	redirect('v_guru');
			}
  	}

  	function ambil_mengajar_guru($id_login){
			$data = array(
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_login,2)->result_array(),
	    );
			$this->load->view('dashboard/master_data/guru/ambil_mengajar_guru', $data);
		}

  	function ambil_ajar_kelas(){
  		$login_id = $this->input->post('login_id');
  		$inputMapel = $this->input->post('inputMapel');
  		$inputKelas = $this->input->post('inputKelas');
			if(preg_match("/&/i", $inputKelas)) {
				$pisah = explode("&",$inputKelas);
	    }else if(preg_match("/,/i", $inputKelas)) {
				$pisah = explode(",",$inputKelas);
	    }else{
				$pisah = explode(" ",$inputKelas);
	    }
	    for($i=0;$i<count($pisah);$i++){
				$kirimdata['loginID'] = $login_id;
				$kirimdata['mapelID'] = $inputMapel;
				$kirimdata['kelas'] = $pisah[$i];
				$kirimdata['aktif_state'] = "1";
				$success = $this->main_model->insert_sk_mengajar($kirimdata);
				// echo json_encode($kirimdata);
	    }
	    if($success){
 				$this->session->set_flashdata('success', 'Kelas Yang Diajar Berhasil di Tambahkan !!! Terimakasih ..');
    		redirect('v_guru');
 			}else{
 				$this->session->set_flashdata('error', 'Kelas Yang Diajar Gagal di Tambahkan !!! Terimakasih ..');
    		redirect('v_guru');
 			}
  	}

  	function lihat_hasil_ujian($id_mapel,$id_kelas,$id_guru){
			$data = array(
	      'data_mengajar' => $this->main_model->lihat_hasil_ujian($id_mapel,$id_kelas,$id_guru)->result_array(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/hasil_ujian/lihat_hasil_ujian', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

  	//Kelas
		function v_kelas(){
			$data = array(
	      'data_kelas' => $this->main_model->get_all_kelas()->result(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/kelas/v_kelas', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function save_kelas(){
      $inputRomawi = $this->input->post('inputRomawi', true);
  		$inputAngka = $this->input->post('inputAngka', true);
  		$cek_kelas = $this->db->query("SELECT * FROM tbl_kelas WHERE romawi_kelas='$inputRomawi' && angka_kelas='$inputAngka'")->num_rows();
  		// echo $cek_kelas;
  		if($cek_kelas > 0){
    		$this->session->set_flashdata('info', 'Data sudah ada !!! Terimakasih ..');
    		redirect('v_kelas');
			}else{
				$kirimdata['romawi_kelas'] = $inputRomawi;
				$kirimdata['angka_kelas'] = $inputAngka;
				$kirimdata['aktif_state'] = "1";
				$success = $this->main_model->insert_kelas($kirimdata);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_kelas');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_kelas');
	 			}
			}
		}

		function edit_kelas($id_kelas){
			$data = array(
	      'data_kelas' => $this->main_model->ubah_kelas($id_kelas)->result_array(),
	    );
			$this->load->view('dashboard/master_data/kelas/edit_kelas', $data);
		}

		function update_kelas(){
      $kelas_id = $this->input->post('kelas_id', true);
      $inputRomawi = $this->input->post('inputRomawi', true);
  		$inputAngka = $this->input->post('inputAngka', true);
  		$cek_kelas = $this->db->query("SELECT * FROM tbl_kelas WHERE romawi_kelas='$inputRomawi' && angka_kelas='$inputAngka'")->num_rows();
  		// echo $cek_kelas;
  		if($cek_kelas > 0){
    		$this->session->set_flashdata('info', 'Data sudah ada !!! Terimakasih ..');
    		redirect('v_kelas');
			}else{
				$kirimdata['romawi_kelas'] = $inputRomawi;
				$kirimdata['angka_kelas'] = $inputAngka;
				$kirimdata['aktif_state'] = "1";
				$success = $this->main_model->update_kelas($kirimdata,$kelas_id);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
	    		redirect('v_kelas');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
	    		redirect('v_kelas');
	 			}
			}
		}

		function delete_kelas($id_kelas){
      $success = $this->main_model->hapus_kelas($id_kelas);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_kelas');
  	}

  	function delete_kelas_all(){
      $id_kelas = $this->input->post('pilih');
      $jumlah_dipilih = count($id_kelas);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_kelas($id_kelas[$x]);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_kelas');
  	}

		function updateActivedKelas(){
			$kirimdata['aktif_state'] = $_GET['aktif_state'];
			$data = $this->main_model->update_kelas($kirimdata,$_GET['id']);	
			echo json_encode($data);
		}

		//MaPel
		function v_mapel(){
			$data = array(
	      'data_mapel' => $this->main_model->get_all_mapel("0")->result(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/mapel/v_mapel', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function save_mapel(){
      $inputMapel = $this->input->post('inputMapel', true);
  		$cek_mapel = $this->db->query("SELECT * FROM tbl_mapel WHERE nama_mapel='$inputMapel'")->num_rows();
  		// echo $cek_mapel;
  		if($cek_mapel > 0){
    		$this->session->set_flashdata('info', 'Data sudah ada !!! Terimakasih ..');
    		redirect('v_mapel');
			}else{
				$kirimdata['nama_mapel'] = $inputMapel;
				$kirimdata['aktif_state'] = "1";
				$success = $this->main_model->insert_mapel($kirimdata);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_mapel');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_mapel');
	 			}
			}
		}

		function edit_mapel($id_mapel){
			$data = array(
	      'data_mapel' => $this->main_model->ubah_mapel($id_mapel)->result_array(),
	    );
			$this->load->view('dashboard/master_data/mapel/edit_mapel', $data);
		}

		function update_mapel(){
      $mapel_id = $this->input->post('mapel_id', true);
      $inputMapel = $this->input->post('inputMapel', true);
  		$cek_mapel = $this->db->query("SELECT * FROM tbl_mapel WHERE nama_mapel='$inputMapel'")->num_rows();
  		// echo $cek_kelas;
  		if($cek_mapel > 0){
    		$this->session->set_flashdata('info', 'Data sudah ada !!! Terimakasih ..');
    		redirect('v_mapel');
			}else{
				$kirimdata['nama_mapel'] = $inputMapel;
				$success = $this->main_model->update_mapel($kirimdata,$mapel_id);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
	    		redirect('v_mapel');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
	    		redirect('v_mapel');
	 			}
			}
		}

		function delete_mapel($id_mapel){
      $success = $this->main_model->hapus_mapel($id_mapel);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_mapel');
  	}

  	function delete_mapel_all(){
      $id_mapel = $this->input->post('pilih');
      $jumlah_dipilih = count($id_mapel);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_mapel($id_mapel[$x]);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_mapel');
  	}

		function updateActivedMapel(){
			$kirimdata['aktif_state'] = $_GET['aktif_state'];
			$kirimdata2['aktif_state'] = $_GET['aktif_state'];
			$this->main_model->update_jadwalWhere_mapel($kirimdata2,$_GET['id']);	
			$data = $this->main_model->update_mapel($kirimdata,$_GET['id']);	
			echo json_encode($data);
		}

		//SK Mengajar
		function v_sk_mengajar(){
			$data = array(
	      'data_sk_mengajar' => $this->main_model->get_all_sk_mengajar(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/sk_mengajar/v_sk_mengajar', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function save_sk_mengajar(){
      $inputGuru = $this->input->post('inputGuru', true);
      $inputMapel = $this->input->post('inputMapel', true);
      $inputKelas = $this->input->post('inputKelas', true);
  		$cek_mengajar = $this->db->query("SELECT * FROM tbl_mengajar WHERE loginID='$inputGuru' && mapelID='$inputMapel' && kelas='$inputKelas'")->num_rows();
  		// echo $cek_mengajar;
  		if($cek_mengajar > 0){
    		$this->session->set_flashdata('info', 'Data sudah ada !!! Terimakasih ..');
    		redirect('v_sk_mengajar');
			}else{
				$kirimdata['loginID'] = $inputGuru;
				$kirimdata['mapelID'] = $inputMapel;
				$kirimdata['kelas'] = $inputKelas;
				$kirimdata['aktif_state'] = "1";
				$success = $this->main_model->insert_sk_mengajar($kirimdata);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_sk_mengajar');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_sk_mengajar');
	 			}
			}
		}

		function edit_sk_mengajar($id_mengajar){
			$data = array(
	      'data_mengajar' => $this->main_model->ubah_sk_mengajar($id_mengajar)->result_array(),
	    );
			$this->load->view('dashboard/master_data/sk_mengajar/edit_sk_mengajar', $data);
		}

		function update_sk_mengajar(){
      $mengajar_id = $this->input->post('mengajar_id', true);
      $inputGuru = $this->input->post('inputGuru', true);
      $inputMapel = $this->input->post('inputMapel', true);
      $inputKelas = $this->input->post('inputKelas', true);
  		$cek_mengajar = $this->db->query("SELECT * FROM tbl_mengajar WHERE loginID='$inputGuru' && mapelID='$inputMapel' && kelas='$inputKelas'")->num_rows();
  		// echo $cek_mengajar;
  		if($cek_mengajar > 1){
    		$this->session->set_flashdata('info', 'Data sudah ada !!! Terimakasih ..');
    		redirect('v_sk_mengajar');
			}else{
				$kirimdata['loginID'] = $inputGuru;
				$kirimdata['mapelID'] = $inputMapel;
				$kirimdata['kelas'] = $inputKelas;
				$kirimdata['aktif_state'] = "1";
				$success = $this->main_model->update_sk_mengajar($kirimdata,$mengajar_id);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil diubah !!! Terimakasih ..');
	    		redirect('v_sk_mengajar');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal diubah !!! Terimakasih ..');
	    		redirect('v_sk_mengajar');
	 			}
			}
		}

		function delete_sk_mengajar($id_mengajar){
      $success = $this->main_model->hapus_sk_mengajar($id_mengajar);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_sk_mengajar');
  	}

  	function delete_sk_mengajar_all(){
      $id_mengajar = $this->input->post('pilih');
      $jumlah_dipilih = count($id_mengajar);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_sk_mengajar($id_mengajar[$x]);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_sk_mengajar');
  	}

		function updateActivedMengajar(){
			$kirimdata['aktif_state'] = $_GET['aktif_state'];
			$data = $this->main_model->update_sk_mengajar($kirimdata,$_GET['id']);	
			echo json_encode($data);
		}

		//Soal Ujian PG
		function v_soal_pg(){
			$data = array(
	      'data_soal_pg' => $this->main_model->get_all_soal_pg()->result(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/soal_ujian/soal_pg/v_soal_pg', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function add_soal_pg(){
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/soal_ujian/soal_pg/add_soal_pg');
			$this->load->view('dashboard/kelengkapan/footer');	
		}

		function GetSKMengajar(){
			$GetSKMengajar = $this->main_model->get_all_sk_mengajarBy($_GET['id_login'])->result();
			foreach ($GetSKMengajar as $value) {
				$data[] = array(
					"id_mengajar" => $value->id_mengajar,
					"nama_mapel" => $value->nama_mapel,
					"romawi_kelas" => $value->romawi_kelas,
					"angka_kelas" => $value->angka_kelas,
				);
			}
			echo json_encode($data);
		}

		function GetKode(){
			$GetKode = $this->main_model->get_all_soal_pgBy($_GET['id_MapelKelas']);
			if($GetKode->num_rows() > 0){
				foreach ($GetKode->result() as $value) {
					$last = $value->kode_soal;
					$lastUrut = substr($last, 2, 5);
          $nextNoUrut = $lastUrut + 1;
          $kode_soal = "PG".sprintf('%05s', $nextNoUrut);
					$data = array(
						"kode_soal" => $kode_soal,
					);
				}
			}else{
				$data = array(
					"kode_soal" => "PG00001",
				);
			}
			echo json_encode($data);
		}

		function save_soal_pg(){
      $inputMengajar = $this->input->post('inputMapelKelas', true);
      $inputKodesoal = $this->input->post('inputKodesoal', true);
      $inputPertanyaan = $this->input->post('inputPertanyaan', true);
      $inputOpsi1 = $this->input->post('inputOpsi1', true);
      $inputOpsi2 = $this->input->post('inputOpsi2', true);
      $inputOpsi3 = $this->input->post('inputOpsi3', true);
      $inputOpsi4 = $this->input->post('inputOpsi4', true);
      $inputJawaban = $this->input->post('inputJawaban', true);
  		// $cek_mengajar = $this->db->query("SELECT * FROM tbl_mengajar WHERE loginID='$inputGuru' && mapelID='$inputMapel' && kelasID='$inputKelas'")->num_rows();
  		// echo $cek_mengajar;
  		if(empty($inputPertanyaan) || empty($inputOpsi4) || empty($inputOpsi4) || empty($inputOpsi4) || empty($inputOpsi4)){
    		$this->session->set_flashdata('info', 'Coba cek inputan anda, kemungkinan terdapat inputan yang masih kosong !!! Terimakasih ..');
    		redirect('add_soal_pg');
			}else{
				date_default_timezone_set("Asia/Jakarta");
		    $tgl = date("Y-m-d H:i:s");
				$kirimdata['MengajarID'] = $inputMengajar;
				$kirimdata['kode_soal'] = $inputKodesoal;
				$kirimdata['pertanyaan'] = $inputPertanyaan;
				$kirimdata['pilihanA'] = $inputOpsi1;
				$kirimdata['pilihanB'] = $inputOpsi2;
				$kirimdata['pilihanC'] = $inputOpsi3;
				$kirimdata['pilihanD'] = $inputOpsi4;
				$kirimdata['kunci_jawaban'] = $inputJawaban;
				$kirimdata['tgl_update'] = $tgl;
				$kirimdata['aktif_state'] = "1";
				$success = $this->main_model->insert_soal_pg($kirimdata);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_soal_pg');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('add_soal_pg');
	 			}
			}
		}

		function edit_soal_pg($id_soal){
			$data = array(
	      'data_soal_pg' => $this->main_model->ubahordetail_soal_pg($id_soal)->result_array(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/soal_ujian/soal_pg/edit_soal_pg', $data);
			$this->load->view('dashboard/kelengkapan/footer');	
		}

		function detail_soal_pg($id_soal){
			$data = array(
	      'data_soal_pg' => $this->main_model->ubahordetail_soal_pg($id_soal)->result_array(),
	    );
			$this->load->view('dashboard/master_data/soal_ujian/soal_pg/detail_soal_pg', $data);
		}

		function update_soal_pg(){
      $soal_id = $this->input->post('soal_id', true);
      $inputMengajar = $this->input->post('inputMapelKelas', true);
      $inputKodesoal = $this->input->post('inputKodesoal', true);
      $inputPertanyaan = $this->input->post('inputPertanyaan', true);
      $inputOpsi1 = $this->input->post('inputOpsi1', true);
      $inputOpsi2 = $this->input->post('inputOpsi2', true);
      $inputOpsi3 = $this->input->post('inputOpsi3', true);
      $inputOpsi4 = $this->input->post('inputOpsi4', true);
      $inputJawaban = $this->input->post('inputJawaban', true);
  		// $cek_mengajar = $this->db->query("SELECT * FROM tbl_mengajar WHERE loginID='$inputGuru' && mapelID='$inputMapel' && kelasID='$inputKelas'")->num_rows();
  		// echo $cek_mengajar;
  		if(empty($inputPertanyaan) || empty($inputOpsi4) || empty($inputOpsi4) || empty($inputOpsi4) || empty($inputOpsi4)){
    		$this->session->set_flashdata('info', 'Coba cek inputan anda, kemungkinan terdapat inputan yang masih kosong !!! Terimakasih ..');
    		redirect('edit_soal_pg/'.$soal_id);
			}else{
				date_default_timezone_set("Asia/Jakarta");
		    $tgl = date("Y-m-d H:i:s");
				$kirimdata['MengajarID'] = $inputMengajar;
				$kirimdata['kode_soal'] = $inputKodesoal;
				$kirimdata['pertanyaan'] = $inputPertanyaan;
				$kirimdata['pilihanA'] = $inputOpsi1;
				$kirimdata['pilihanB'] = $inputOpsi2;
				$kirimdata['pilihanC'] = $inputOpsi3;
				$kirimdata['pilihanD'] = $inputOpsi4;
				$kirimdata['kunci_jawaban'] = $inputJawaban;
				$kirimdata['tgl_update'] = $tgl;
				$kirimdata['aktif_state'] = "1";
				$success = $this->main_model->update_soal_pg($kirimdata,$soal_id);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_soal_pg');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('edit_soal_pg/'.$soal_id);
	 			}
			}
		}

		function delete_soal_pg($id_soal){
      $success = $this->main_model->hapus_soal_pg($id_soal);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_soal_pg');
  	}

  	function delete_soal_pg_all(){
      $id_soal = $this->input->post('pilih');
      $jumlah_dipilih = count($id_soal);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_soal_pg($id_soal[$x]);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_soal_pg');
  	}

		function updateActivedSoalPG(){
			$kirimdata['aktif_state'] = $_GET['aktif_state'];
			$data = $this->main_model->update_soal_pg($kirimdata,$_GET['id']);	
			echo json_encode($data);
		}

		//jadwal
		function v_jadwal(){
			$data = array(
	      'data_jadwal' => $this->main_model->get_all_jadwal()->result(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/jadwal/v_jadwal', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function save_jadwal(){
      $inputMapel = $this->input->post('inputMapel', true);
      $inputHari = $this->input->post('inputHari', true);
      $inputMulai = date('Y-m-d H:i',strtotime($this->input->post('inputMulai', true)));
      $inputSelesai = date('Y-m-d H:i',strtotime($this->input->post('inputSelesai', true)));
      $inputWaktucount = $this->input->post('inputWaktucount', true);
      $jam_ke = $this->input->post('jam_ke', true);
  		$cek_jadwal = $this->db->query("SELECT * FROM tbl_jadwal WHERE mapelID='$inputMapel'")->num_rows();
  		// echo $cek_jadwal;
  		if($cek_jadwal > 0){
    		$this->session->set_flashdata('info', 'Data sudah ada !!! Terimakasih ..');
    		redirect('v_jadwal');
			}else{
				$kirimdata['mapelID'] = $inputMapel;
				$kirimdata['hari'] = $inputHari;
				$kirimdata['waktu_mulai'] = $inputMulai;
				$kirimdata['waktu_selesai'] = $inputSelesai;
				$kirimdata['waktu'] = $inputWaktucount;
				$kirimdata['jam_ke'] = $jam_ke;
				$kirimdata['kondisi_ujian'] = "0";
				$kirimdata['aktif_state'] = "0";
				$success = $this->main_model->insert_jadwal($kirimdata);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_jadwal');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_jadwal');
	 			}
			}
		}

		function edit_jadwal($id_jadwal){
			$data = array(
	      'data_jadwal' => $this->main_model->ubah_jadwal($id_jadwal)->result_array(),
	    );
			$this->load->view('dashboard/master_data/jadwal/edit_jadwal', $data);
		}

		function update_jadwal(){
      $jadwal_id = $this->input->post('jadwal_id', true);
      $inputMapel = $this->input->post('inputMapel', true);
      $inputHari = $this->input->post('inputHari', true);
      $inputMulai = date('Y-m-d H:i',strtotime($this->input->post('inputMulai', true)));
      $inputSelesai = date('Y-m-d H:i',strtotime($this->input->post('inputSelesai', true)));
      $inputWaktucount = $this->input->post('inputWaktucount', true);
      $jam_ke = $this->input->post('jam_ke', true);
  		$cek_jadwal = $this->db->query("SELECT * FROM tbl_jadwal WHERE mapelID='$inputMapel'")->num_rows();
  		// echo $cek_jadwal;
  		if($cek_jadwal > 1){
    		$this->session->set_flashdata('info', 'Data sudah ada !!! Terimakasih ..');
    		redirect('v_jadwal');
			}else{
				$kirimdata['mapelID'] = $inputMapel;
				$kirimdata['hari'] = $inputHari;
				$kirimdata['waktu_mulai'] = $inputMulai;
				$kirimdata['waktu_selesai'] = $inputSelesai;
				$kirimdata['waktu'] = $inputWaktucount;
				$kirimdata['jam_ke'] = $jam_ke;
				$success = $this->main_model->update_jadwal($kirimdata,$jadwal_id);
	 			if($success){
	 				$this->session->set_flashdata('success', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_jadwal');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_jadwal');
	 			}
			}
		}

		function delete_jadwal($id_jadwal){
      $success = $this->main_model->hapus_jadwal($id_jadwal);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_jadwal');
  	}

  	function delete_jadwal_all(){
      $id_jadwal = $this->input->post('pilih');
      $jumlah_dipilih = count($id_jadwal);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_jadwal($id_jadwal[$x]);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_jadwal');
  	}

		function updateActivedJadwal(){
			$kirimdata['aktif_state'] = $_GET['aktif_state'];
			$data = $this->main_model->update_jadwal($kirimdata,$_GET['id']);	
			echo json_encode($data);
		}

		function updateActivedKondisiUjian(){
			$kirimdata['kondisi_ujian'] = $_GET['kondisi_ujian'];
			$data = $this->main_model->update_jadwal($kirimdata,$_GET['id']);
			echo json_encode($data);
		}

//===================================================================================//
		//======================UJIAN=========================//

		function peraturan($id_mapel,$id_kelas,$id_guru,$id_siswa){
			date_default_timezone_set("Asia/Jakarta");
		  $tgl = date("Y-m-d H:i:s");
			$this->session->set_userdata('waktu_sekarang',$tgl);
			$data = array(
	      'id_mapel' => $id_mapel,
	      'id_kelas' => $id_kelas,
	      'id_guru' => $id_guru,
	      'id_siswa' => $id_siswa,
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_siswa,3)->result_array(),
				'data_ngajar' => $this->main_model->get_all_sk_mengajarBy($id_guru)->result_array(),
				'data_jadwal' => $this->main_model->get_all_jadwalBy($id_mapel)->result_array(),
	    );
			$this->load->view('dashboard/ujian/kelengkapan/header');
			$this->load->view('dashboard/ujian/peraturan', $data);
			$this->load->view('dashboard/ujian/kelengkapan/footer');
		}

		function kerjakan_ujian($id_mapel,$id_kelas,$id_guru,$id_siswa){
			$data = array(
	      'id_mapel' => $id_mapel,
	      'id_kelas' => $id_kelas,
	      'id_guru' => $id_guru,
	      'id_siswa' => $id_siswa,
	      'data_pengguna' => $this->main_model->ubahordetail_pengguna($id_siswa,3)->result_array(),
				'data_ngajar' => $this->main_model->get_all_sk_mengajarBy($id_guru)->result_array(),
				'data_jadwal' => $this->main_model->get_all_jadwalBy($id_mapel)->result_array(),
	    );
			$this->load->view('dashboard/ujian/kelengkapan/header');
			$this->load->view('dashboard/ujian/Ujian', $data);
			$this->load->view('dashboard/ujian/kelengkapan/footer');
		}

		function penilaian(){
			$mapel_id = $this->input->post('mapel_id', true);
			$kelas_id = $this->input->post('kelas_id', true);
			$guru_id = $this->input->post('guru_id', true);
			$siswa_id = $this->input->post('siswa_id', true);
			$jawaban = $this->input->post('jawaban', true);
			// echo "<br><br><br><br><br><br>";
			$benar=0;
			$salah=0;
			$nilai=0;
			date_default_timezone_set("Asia/Jakarta");
      $tgl = date("Y-m-d H:i:s");
			foreach($jawaban as $key => $value){
				$ceksoal = $this->main_model->ubahordetail_soal_pg($key)->result_array();
				if($value==$ceksoal[0]['kunci_jawaban']){
		        $benar++;
		    }else{
		        $salah++;
		    }
			}
			$total_jawaban = $benar + $salah;
			$jawaban_kosong = 50 - $total_jawaban;
			$nilai = $benar * 2;
			$cek_hasil = $this->db->query("SELECT * FROM tbl_hasil_ujian WHERE mapelID='$mapel_id' && kelasID='$kelas_id' && guruID='$guru_id' && siswaID='$siswa_id'")->num_rows();
  		// echo $cek_jadwal;
  		if($cek_jadwal > 0){
  			$this->session->set_flashdata('error', 'Anda sudah mengerjakan sebelum nya !!! Terimakasih ..');
    		redirect('dashboard');
  		}else{
		    $kirimdata['mapelID'] = $mapel_id;
		    $kirimdata['kelasID'] = $kelas_id;
		    $kirimdata['guruID'] = $guru_id;
		    $kirimdata['siswaID'] = $siswa_id;
		    $kirimdata['jawaban_benar'] = $benar;
		    $kirimdata['jawaban_salah'] = $salah;
		    $kirimdata['jawaban_kosong'] = $jawaban_kosong;
		    $kirimdata['nilai'] = $nilai;
				$kirimdata['tgl_update'] = $tgl;
				$success = $this->main_model->insert_hasil_ujian($kirimdata);
				if($success){
	 				$this->session->set_flashdata('success', 'Anda telah selesai mengerjakan soal ujian online !!! Terimakasih ..');
	    		redirect('dashboard');
	 			}else{
	 				$this->session->set_flashdata('error', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('dashboard');
	 			}
	 		}
		}

		function v_hasil_ujian(){
			$data = array(
	      'data_hasil_ujian' => $this->main_model->get_all_hasil_ujian()->result(),
	    );
			$this->load->view('dashboard/kelengkapan/header');
			$this->load->view('dashboard/master_data/hasil_ujian/v_hasil_ujian', $data);
			$this->load->view('dashboard/kelengkapan/footer');
		}

		function detail_hasil_ujian($id_hasil){
			$data = array(
	      'data_hasil_ujian' => $this->main_model->get_all_hasil_ujianBy($id_hasil)->result_array(),
	    );
			$this->load->view('dashboard/master_data/hasil_ujian/detail_hasil_ujian', $data);
		}

		function delete_hasil_ujian($id_hasil){
      $success = $this->main_model->hapus_hasil_ujian($id_hasil);
      $this->session->set_flashdata('success', 'Data berhasil dihapus !!! Terimakasih ..');
	    redirect('v_hasil_ujian');
  	}

  	function delete_hasil_ujian_all(){
      $id_hasil = $this->input->post('pilih');
      $jumlah_dipilih = count($id_hasil);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_hasil_ujian($id_hasil[$x]);
      }
      $this->session->set_flashdata('success', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_hasil_ujian');
  	}

//===================================================================================//

    //Mahasiswa
		function v_mahasiswa(){
			$data = array(
	    	'data_mahasiswa' => $this->main_model->get_all_mahasiswa()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/master_data/mahasiswa/v_mahasiswa', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function save_mahasiswa(){
			$this->form_validation->set_rules('inputTahun','Input Tahun', 'required');
			$this->form_validation->set_rules('inputNpm','Input Npm', 'required');
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('inputPassword','Input Password', 'required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
			$this->form_validation->set_rules('akses','Pilih Akses', 'required');
			$this->form_validation->set_rules('jenis','Pilih Jenis', 'required');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
	    	redirect('v_mahasiswa');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
			 	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
			 	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

			 	$this->upload->initialize($config);
				if(!empty($_FILES['foto']['name'])){

		      if ($this->upload->do_upload('foto')){
	        	$gbr = $this->upload->data();
	        	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
	          $config['image_library']='gd2';
	          $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
	          $config['create_thumb']= FALSE;
	          $config['maintain_ratio']= FALSE;
	          $config['quality']= '50%';
	          $config['width']= 200;
	          $config['height']= 200;
	          $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
	          $this->load->library('image_lib', $config);
	          $this->image_lib->resize();
	          $gambar = $file_gbr;
		  		}
          
          $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
	    		$inputNama = $this->input->post('inputNama', true);
	    		$inputUsername = $this->input->post('inputUsername', true);
	    		$inputPassword = md5($this->input->post('inputPassword', true));
	    		$inputCode = $code;
	    		$akses = $this->input->post('akses');
	    		$jenis = $this->input->post('jenis');
	    		$inputNpm = $this->input->post('inputNpm', true);
	    		$inputTahun = $this->input->post('inputTahun');
	    		$npm = "0651".substr($inputTahun,2,4).$inputNpm;
					$kirimdata['nama'] = $inputNama;
					$kirimdata['npm'] = $npm;
					$kirimdata['tahun'] = $inputTahun;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['code'] = $code;
					$kirimdata['akses'] = $akses;
					$kirimdata['jenis'] = $jenis;
					$kirimdata['gambar'] = $gambar;
					$kirimdata['status'] = "1";
					$this->main_model->insert_mahasiswa($kirimdata);

					$cek_user = $this->db->query("SELECT * FROM tbl_user ORDER BY id_user DESC LIMIT 1")->result();			
					foreach($cek_user as $hasil){
					  $id_user = $hasil->id_user;
		      }
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$agama = $this->input->post('agama');
      		if(empty($agama)){$agama = "0";}
      		$inputEmail = $this->input->post('inputEmail');
      		$inputNamaayah = $this->input->post('inputNamaayah');
      		$inputNamaibu = $this->input->post('inputNamaibu');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['id_user'] = $id_user;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['agama'] = $agama;
					$kirimdata2['email'] = $inputEmail;
					$kirimdata2['nama_ayah'] = $inputNamaayah;
					$kirimdata2['nama_ibu'] = $inputNamaibu;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$success = $this->main_model->insert_Lmahasiswa($kirimdata2);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_mahasiswa');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_mahasiswa');
		 			}
       	}else{
        	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputNama = $this->input->post('inputNama', true);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputCode = $code;
      		$akses = $this->input->post('akses');
      		$jenis = $this->input->post('jenis');
      		$inputNpm = $this->input->post('inputNpm', true);
      		$inputTahun = $this->input->post('inputTahun');
      		$npm = "0651".substr($inputTahun,2,4).$inputNpm;
					$kirimdata['nama'] = $inputNama;
					$kirimdata['npm'] = $npm;
					$kirimdata['tahun'] = $inputTahun;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['code'] = $code;
					$kirimdata['akses'] = $akses;
					$kirimdata['jenis'] = $jenis;
					$kirimdata['gambar'] = '';
					$kirimdata['status'] = "1";
					$this->main_model->insert_mahasiswa($kirimdata);

					$cek_user = $this->db->query("SELECT * FROM tbl_user ORDER BY id_user DESC LIMIT 1")->result();			
					foreach($cek_user as $hasil){
					  $id_user = $hasil->id_user;
		      }
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$agama = $this->input->post('agama');
      		if(empty($agama)){$agama = "0";}
      		$inputEmail = $this->input->post('inputEmail');
      		$inputNamaayah = $this->input->post('inputNamaayah');
      		$inputNamaibu = $this->input->post('inputNamaibu');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['id_user'] = $id_user;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['agama'] = $agama;
					$kirimdata2['email'] = $inputEmail;
					$kirimdata2['nama_ayah'] = $inputNamaayah;
					$kirimdata2['nama_ibu'] = $inputNamaibu;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$success = $this->main_model->insert_Lmahasiswa($kirimdata2);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_mahasiswa');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_mahasiswa');
		 			}
        }
			}
		}

		function edit_mahasiswa($id_user){
			$data = array(
	     	'data_mahasiswa' => $this->main_model->ubah_mahasiswa($id_user)->result(),
	    );
			$this->load->view('admin/master_data/mahasiswa/edit_mahasiswa', $data);
		}

		function update_mahasiswa(){
			$this->form_validation->set_rules('inputTahun','Input Tahun', 'required');
			$this->form_validation->set_rules('inputNpm','Input Npm', 'required');
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
			$this->form_validation->set_rules('akses','Pilih Akses', 'required');
	 		
	    if ($this->form_validation->run() == FALSE) { 
	    	$this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
		    redirect('v_mahasiswa');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
       	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
       	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

       	$this->upload->initialize($config);
    		if(!empty($_FILES['foto']['name'])){

          if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
      		}

      		$user_id = $this->input->post('user_id');
      		$inputNama = $this->input->post('inputNama', true);
      		$inputUsername = $this->input->post('inputUsername', true);
      		if(empty($this->input->post('inputPassword1'))){
      			$inputPassword = $this->input->post('inputPassword', true);
      		}else{
      			$inputPassword = md5($this->input->post('inputPassword1', true)); 
      		}
      		$akses = $this->input->post('akses');
      		$jenis = $this->input->post('jenis');
      		$status = $this->input->post('kondisi');
      		$inputNpm = $this->input->post('inputNpm', true);
      		$inputTahun = $this->input->post('inputTahun');
      		$npm = "0651".substr($inputTahun,2,4).$inputNpm;
					$kirimdata['nama'] = $inputNama;
					$kirimdata['npm'] = $npm;
					$kirimdata['tahun'] = $inputTahun;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['akses'] = $akses;
					$kirimdata['jenis'] = $jenis;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata['gambar'] = $gambar;
					}
					$kirimdata['status'] = $status;
					$this->main_model->update_mahasiswa($kirimdata, $user_id);

      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$agama = $this->input->post('agama');
      		$inputEmail = $this->input->post('inputEmail');
      		$inputNamaayah = $this->input->post('inputNamaayah');
      		$inputNamaibu = $this->input->post('inputNamaibu');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['id_user'] = $user_id;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['agama'] = $agama;
					$kirimdata2['email'] = $inputEmail;
					$kirimdata2['nama_ayah'] = $inputNamaayah;
					$kirimdata2['nama_ibu'] = $inputNamaibu;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$success = $this->main_model->update_Lmahasiswa($kirimdata2, $user_id);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_mahasiswa');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_mahasiswa');
		 			}
       	}else{
      		$user_id = $this->input->post('user_id');
      		$inputNama = $this->input->post('inputNama', true);
      		$inputUsername = $this->input->post('inputUsername', true);
      		if(empty($this->input->post('inputPassword1'))){
      			$inputPassword = $this->input->post('inputPassword', true);
      		}else{
      			$inputPassword = md5($this->input->post('inputPassword1', true)); 
      		}
      		$akses = $this->input->post('akses');
      		$jenis = $this->input->post('jenis');
      		$status = $this->input->post('kondisi');
      		$inputNpm = $this->input->post('inputNpm', true);
      		$inputTahun = $this->input->post('inputTahun');
      		$npm = "0651".substr($inputTahun,2,4).$inputNpm;
					$kirimdata['nama'] = $inputNama;
					$kirimdata['npm'] = $npm;
					$kirimdata['tahun'] = $inputTahun;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['akses'] = $akses;
					$kirimdata['jenis'] = $jenis;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata['gambar'] = '';
					}
					$kirimdata['status'] = $status;
					$this->main_model->update_mahasiswa($kirimdata, $user_id);

      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$agama = $this->input->post('agama');
      		$inputEmail = $this->input->post('inputEmail');
      		$inputNamaayah = $this->input->post('inputNamaayah');
      		$inputNamaibu = $this->input->post('inputNamaibu');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['id_user'] = $user_id;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['agama'] = $agama;
					$kirimdata2['email'] = $inputEmail;
					$kirimdata2['nama_ayah'] = $inputNamaayah;
					$kirimdata2['nama_ibu'] = $inputNamaibu;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$success = $this->main_model->update_Lmahasiswa($kirimdata2, $user_id);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_mahasiswa');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_mahasiswa');
		 			}
       	}
			}
		}

		function detail_mahasiswa($id_user){
			$data = array(
	      'data_mahasiswa' => $this->main_model->detail_mahasiswa($id_user)->result(),
	      'data_kelas_mhs' => $this->main_model->get_kelas_mhs($id_user)->result(),
	      'data_kelas_matkul' => $this->main_model->get_kelas_matkulBy($id_user)->result(),
	    );
			$this->load->view('admin/master_data/mahasiswa/detail_mahasiswa', $data);
		}

		function delete_mahasiswa($id_user){
      $this->main_model->hapus_mahasiswa($id_user);
	    redirect('v_mahasiswa');
  	}

  	function delete_mahasiswa_all(){
      $id_user = $this->input->post('pilih');
      $jumlah_dipilih = count($id_user);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_mahasiswa($id_user[$x]);
      }
      $this->session->set_flashdata('sukses', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
	    redirect('v_mahasiswa');
  	}

  	//Asisten Dosen
		function v_asdos(){
			$data = array(
	      'data_asdos' => $this->main_model->get_all_asdos()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/master_data/asdos/v_asdos', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function save_asdos(){
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('inputPassword','Input Password', 'required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
			$this->form_validation->set_rules('akses','Pilih Akses', 'required');
	 		
	    if ($this->form_validation->run() == FALSE) { 
	      $this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
		    redirect('v_asdos');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
     		$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
     		$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

     		$this->upload->initialize($config);
  			if(!empty($_FILES['foto']['name'])){

          if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
      		}
              
          $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputNama = $this->input->post('inputNama', true);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputCode = $code;
      		$akses = $this->input->post('akses');
      		if($akses == 2){
      			$inputTahun = $this->input->post('inputTahun');
      			$inputNpm = "0651".substr($inputTahun,2,4).$this->input->post('inputNpm', true);
						$kirimdata['tahun'] = $inputTahun;
      		}else if($akses == 4){
      			$inputNpm = $this->input->post('inputNomorinduk', true);
      		}
					$kirimdata['nama'] = $inputNama;
					$kirimdata['npm'] = $inputNpm;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['code'] = $code;
					$kirimdata['akses'] = $akses;
					$kirimdata['gambar'] = $gambar;
					$kirimdata['status'] = "1";
					$this->main_model->insert_asdos($kirimdata);

					$cek_user = $this->db->query("SELECT * FROM tbl_user ORDER BY id_user DESC LIMIT 1")->result();			
					foreach($cek_user as $hasil){
					  $id_user = $hasil->id_user;
		      }
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$agama = $this->input->post('agama');
      		$inputEmail = $this->input->post('inputEmail');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['id_user'] = $id_user;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['agama'] = $agama;
					$kirimdata2['email'] = $inputEmail;
					$kirimdata2['nama_ayah'] = "-";
					$kirimdata2['nama_ibu'] = "-";
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$success = $this->main_model->insert_Lasdos($kirimdata2);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_asdos');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_asdos');
		 			}
       	}else{
        	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$code = substr(str_shuffle($set), 0, 15);
      		$inputNama = $this->input->post('inputNama', true);
      		$inputUsername = $this->input->post('inputUsername', true);
      		$inputPassword = md5($this->input->post('inputPassword', true));
      		$inputCode = $code;
      		$akses = $this->input->post('akses');
      		if($akses == 2){
      			$inputTahun = $this->input->post('inputTahun');
      			$inputNpm = "0651".substr($inputTahun,2,4).$this->input->post('inputNpm', true);
						$kirimdata['tahun'] = $inputTahun;
      		}else if($akses == 4){
      			$inputNpm = $this->input->post('inputNomorinduk', true);
      		}
					$kirimdata['nama'] = $inputNama;
					$kirimdata['npm'] = $inputNpm;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['code'] = $code;
					$kirimdata['akses'] = $akses;
					$kirimdata['status'] = "1";
					$this->main_model->insert_asdos($kirimdata);

					$cek_user = $this->db->query("SELECT * FROM tbl_user ORDER BY id_user DESC LIMIT 1")->result();			
					foreach($cek_user as $hasil){
					  $id_user = $hasil->id_user;
		      }
      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$agama = $this->input->post('agama');
      		$inputEmail = $this->input->post('inputEmail');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['id_user'] = $id_user;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['agama'] = $agama;
					$kirimdata2['email'] = $inputEmail;
					$kirimdata2['nama_ayah'] = "-";
					$kirimdata2['nama_ibu'] = "-";
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$success = $this->main_model->insert_Lasdos($kirimdata2);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_asdos');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_asdos');
		 			}
       	}
			}
		}

		function edit_asdos($id_user){
			$data = array(
	      'data_asdos' => $this->main_model->ubah_asdos($id_user)->result(),
	    );
			$this->load->view('admin/master_data/asdos/edit_asdos', $data);
		}

		function update_asdos(){
			$this->form_validation->set_rules('inputNama','Input Nama Lengkap', 'required');
			$this->form_validation->set_rules('inputEmail','Input Email', 'required|valid_email');
			$this->form_validation->set_rules('inputUsername','Input Username', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('inputTelepon','Input Telepon', 'required|max_length[15]');
			$this->form_validation->set_rules('level','Pilih Akses', 'required');
	 		
	    if ($this->form_validation->run() == FALSE) { 
	    	$this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
		    redirect('v_asdos');
			}else{
				$config['upload_path'] = './assets/images/gambar_user/'; //path folder
       	$config['allowed_types'] = 'jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
       	$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload

       	$this->upload->initialize($config);
    		if(!empty($_FILES['foto']['name'])){

          if ($this->upload->do_upload('foto')){
          	$gbr = $this->upload->data();
          	$file_gbr = str_replace(" ", "_", $gbr['file_name']);
            $config['image_library']='gd2';
            $config['source_image']='./assets/images/gambar_user/'.$file_gbr;
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 200;
            $config['height']= 200;
            $config['new_image']= './assets/images/gambar_user/'.$file_gbr;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $file_gbr;
      		}

      		$user_id = $this->input->post('user_id');
      		$inputNama = $this->input->post('inputNama', true);
      		$inputUsername = $this->input->post('inputUsername', true);
      		if(empty($this->input->post('inputPassword1'))){
      			$inputPassword = $this->input->post('inputPassword', true);
      		}else{
      			$inputPassword = md5($this->input->post('inputPassword1', true)); 
      		}
      		$akses = $this->input->post('level');
      		$status = $this->input->post('kondisi');
      		if($akses == 2 || $akses == 3){
      			$inputTahun = $this->input->post('inputTahun');
      			$inputNpm = $this->input->post('inputNpm', true);
      			$npm = "0651".substr($inputTahun,2,4).$inputNpm;
						$kirimdata['npm'] = $npm;
						$kirimdata['tahun'] = $inputTahun;
      		}elseif($akses == 4){
      			$inputNomorinduk = $this->input->post('inputNomorinduk', true);
						$kirimdata['npm'] = $inputNomorinduk;
      		}
					$kirimdata['nama'] = $inputNama;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['akses'] = $akses;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata['gambar'] = $gambar;
					}
					$kirimdata['status'] = $status;
					$this->main_model->update_asdos($kirimdata, $user_id);

      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$agama = $this->input->post('agama');
      		$inputEmail = $this->input->post('inputEmail');
      		$inputNamaayah = $this->input->post('inputNamaayah');
      		$inputNamaibu = $this->input->post('inputNamaibu');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['id_user'] = $user_id;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['agama'] = $agama;
					$kirimdata2['email'] = $inputEmail;
					$kirimdata2['nama_ayah'] = $inputNamaayah;
					$kirimdata2['nama_ibu'] = $inputNamaibu;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$success = $this->main_model->update_Lasdos($kirimdata2, $user_id);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_asdos');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_asdos');
		 			}
        }else{
      		$user_id = $this->input->post('user_id');
      		$inputNama = $this->input->post('inputNama', true);
      		$inputUsername = $this->input->post('inputUsername', true);
      		if(empty($this->input->post('inputPassword1'))){
      			$inputPassword = $this->input->post('inputPassword', true);
      		}else{
      			$inputPassword = md5($this->input->post('inputPassword1', true)); 
      		}
      		$akses = $this->input->post('level');
      		$status = $this->input->post('kondisi');
      		if($akses == 2){
      			$inputTahun = $this->input->post('inputTahun');
      			$inputNpm = $this->input->post('inputNpm', true);
      			$npm = "0651".substr($inputTahun,2,4).$inputNpm;
						$kirimdata['npm'] = $npm;
						$kirimdata['tahun'] = $inputTahun;
      		}elseif($akses == 4){
      			$inputNomorinduk = $this->input->post('inputNomorinduk', true);
						$kirimdata['npm'] = $inputNomorinduk;
      		}
					$kirimdata['nama'] = $inputNama;
					$kirimdata['username'] = $inputUsername;
					$kirimdata['password'] = $inputPassword;
					$kirimdata['akses'] = $akses;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata['gambar'] = '';
					}
					$kirimdata['status'] = $status;
					$this->main_model->update_asdos($kirimdata, $user_id);

      		$inputTempat = $this->input->post('inputTempat');
      		$inputTgl = date("Y-m-d",strtotime($this->input->post('inputTgl')));
      		$jk = $this->input->post('jk');
      		$agama = $this->input->post('agama');
      		$inputEmail = $this->input->post('inputEmail');
      		$inputNamaayah = $this->input->post('inputNamaayah');
      		$inputNamaibu = $this->input->post('inputNamaibu');
      		$inputTelepon = $this->input->post('inputTelepon');
      		$inputAlamat = $this->input->post('inputAlamat');
		
      		if($inputTgl == "1970-01-01"){
      			$tanggal = "0000-00-00";
      		}else{
      			$tanggal = $inputTgl;
      		}

					$kirimdata2['id_user'] = $user_id;
					$kirimdata2['tempat'] = $inputTempat;
					$kirimdata2['tgl_lahir'] = $tanggal;
					$kirimdata2['jk'] = $jk;
					$kirimdata2['agama'] = $agama;
					$kirimdata2['email'] = $inputEmail;
					$kirimdata2['nama_ayah'] = $inputNamaayah;
					$kirimdata2['nama_ibu'] = $inputNamaibu;
					$kirimdata2['telp'] = $inputTelepon;
					$kirimdata2['alamat'] = $inputAlamat;
					$success = $this->main_model->update_Lasdos($kirimdata2, $user_id);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil diubah !!! Terimakasih ..');
		    		redirect('v_asdos');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal diubah !!! Terimakasih ..');
		    		redirect('v_asdos');
		 			}
        }
			}
		}

		function detail_asdos($id_user){
			$data = array(
	      'data_asdos' => $this->main_model->detail_asdos($id_user)->result(),
	      'data_kelas_matkul' => $this->main_model->get_kelas_matkulBy($id_user)->result(),
	    );
			$this->load->view('admin/master_data/asdos/detail_asdos', $data);
		}

		function delete_asdos($id_user){
      $this->main_model->hapus_asdos($id_user);
	    redirect('v_asdos');
    }

  	function delete_asdos_all(){
      $id_user = $this->input->post('pilih');
      $jumlah_dipilih = count($id_user);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_asdos($id_user[$x]);
      }
      $this->session->set_flashdata('sukses', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
  	  redirect('v_asdos');
  	}

  	//Mata Kuliah
		function v_matkul(){
			$data = array(
	      'data_matkul' => $this->main_model->get_all_matkul()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/master_data/matkul/v_matkul', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function save_matkul(){
			$this->form_validation->set_rules('inputMatkul','Input Mata Kuliah', 'required');
			$this->form_validation->set_rules('semester','Pilih semester', 'required');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_matkul');
			}else{
        if(!empty($_FILES['modulfile']['name'])){
        	$fileasli = str_replace(" ", "_", $_FILES['modulfile']['name']);
        	$config['upload_path'] 		= './assets/images/file_modul/'; //path folder
			   	$config['allowed_types'] 	= 'pdf|doc|docx'; //type yang dapat diakses bisa anda sesuaikan
			   	$config['max_size']      	= 1024;  
          $config['file_name']      = $fileasli;
	        $this->load->library('upload', $config); 
        	$this->upload->initialize($config);
		    	if($this->upload->do_upload('modulfile')){
	      		$inputMatkul = $this->input->post('inputMatkul', true);
	      		$semester = $this->input->post('semester', true);
	      		$kirimdata['matkul'] = $inputMatkul;
						$kirimdata['semester'] = $semester;
						$kirimdata['file'] = $fileasli;
						$kirimdata['status'] = "1";
						$success = $this->main_model->insert_matkul($kirimdata);
						
			 			if($success){
			 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
			    		redirect('v_matkul');
			 			}else{
			 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
			    		redirect('v_matkul');
			 			}
          }else{
			 			$this->session->set_flashdata('gagal', 'Modul gagal diupload !!! Terimakasih ..');
			    	redirect('v_matkul');
          }
       	}else{
        	$inputMatkul = $this->input->post('inputMatkul', true);
      		$semester = $this->input->post('semester', true);
      		$kirimdata['matkul'] = $inputMatkul;
					$kirimdata['semester'] = $semester;
					$kirimdata['file'] = '';
					$kirimdata['status'] = "1";
					$success = $this->main_model->insert_matkul($kirimdata);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_matkul');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_matkul');
		 			}
       	}
			}
		}

		function edit_matkul($id_matkul){
			$data = array(
	      'data_matkul' => $this->main_model->ubah_matkul($id_matkul)->result(),
	    );
			$this->load->view('admin/master_data/matkul/edit_matkul', $data);
		}

		function update_matkul(){
			$this->form_validation->set_rules('inputMatkul','Input Mata Kuliah', 'required');
			$this->form_validation->set_rules('semester','Pilih semester', 'required');
	 		
	    if ($this->form_validation->run() == FALSE) { 
	    	$this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
		    redirect('v_matkul');
			}else{
				if(!empty($_FILES['modulfile']['name'])){
        	$fileasli = str_replace(" ", "_", $_FILES['modulfile']['name']);
        	$config['upload_path'] 		= './assets/images/file_modul/'; //path folder
			   	$config['allowed_types'] 	= 'pdf|doc|docx'; //type yang dapat diakses bisa anda sesuaikan
			   	$config['max_size']      	= 1024;  
          $config['file_name']      = $fileasli;
	        $this->load->library('upload', $config); 
        	$this->upload->initialize($config);
		    	if($this->upload->do_upload('modulfile')){
	      		$matkul_id = $this->input->post('matkul_id');
	      		$inputMatkul = $this->input->post('inputMatkul', true);
	      		$inputMatkul = $this->input->post('inputMatkul', true);
	      		$semester = $this->input->post('semester', true);
						$status = $this->input->post('kondisi');
	      		$kirimdata['matkul'] = $inputMatkul;
						$kirimdata['semester'] = $semester;
						$lihat = $this->input->post('lihat');
						if($lihat != 1){
							$kirimdata['file'] = $fileasli;
						}
						$kirimdata['status'] = $status;
						$success = $this->main_model->update_matkul($kirimdata, $matkul_id);
						
			 			if($success){
			 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
			    		redirect('v_matkul');
			 			}else{
			 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
			    		redirect('v_matkul');
			 			}
          }else{
			 			$this->session->set_flashdata('gagal', 'Modul gagal diupload !!! Terimakasih ..');
			    	redirect('v_matkul');
          }
        }else{
      		$matkul_id = $this->input->post('matkul_id');
      		$inputMatkul = $this->input->post('inputMatkul', true);
      		$inputMatkul = $this->input->post('inputMatkul', true);
      		$semester = $this->input->post('semester', true);
					$status = $this->input->post('kondisi');
      		$kirimdata['matkul'] = $inputMatkul;
					$kirimdata['semester'] = $semester;
					$lihat = $this->input->post('lihat');
					if($lihat != 1){
						$kirimdata['file'] = '';
					}
					$kirimdata['status'] = $status;
					$success = $this->main_model->update_matkul($kirimdata, $matkul_id);
					
		 			if($success){
		 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
		    		redirect('v_matkul');
		 			}else{
		 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
		    		redirect('v_matkul');
		 			}
        }
			}
		}

		function detail_matkul($id_matkul){
			$data = array(
	      'data_matkul' => $this->main_model->detail_matkul($id_matkul)->result(),
	    );
			$this->load->view('admin/master_data/matkul/detail_matkul', $data);
		}

		function delete_matkul($id_matkul){
      $this->main_model->hapus_matkul($id_matkul);
	    redirect('v_matkul');
    }

  	function delete_matkul_all(){
      $id_matkul = $this->input->post('pilih');
      $jumlah_dipilih = count($id_matkul);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_matkul($id_matkul[$x]);
      }
      $this->session->set_flashdata('sukses', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
  	  redirect('v_matkul');
  	}

  	function ambil_matkul_mahasiswa($id_user){
			$data = array(
	     	'data_mahasiswa' => $this->main_model->detail_mahasiswa($id_user)->result(),
	     	'data_kelas_mhs' => $this->main_model->get_kelas_mhs($id_user)->result(),
	    );
	    $this->load->view('admin/master_data/matkul/ambil_matkul', $data);
		}

		function save_ambil_matkul(){
			$this->form_validation->set_rules('inputNpm','Input Npm', 'required');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_mahasiswa');
			}else{
    		$inputNpm = $this->input->post('inputNpm', true);
    		$user_id = $this->input->post('user_id', true);
    		$semester = $this->input->post('semester', true);
    		//genap
    		$pambagisi = explode(" ",$this->input->post('si', true));
    		$pambagiorkom = explode(" ",$this->input->post('orkom', true));
    		$pambagisigit2 = explode(" ",$this->input->post('sigit2', true));
    		$pambagijarkom = explode(" ",$this->input->post('jarkom', true));
    		$pambagispm = explode(" ",$this->input->post('spm', true));
    		$pambagimobile = explode(" ",$this->input->post('mobile', true));
    		$pambagipython = explode(" ",$this->input->post('python', true));
    		$pambagikejar = explode(" ",$this->input->post('kejar', true));

    		$si = $pambagisi[0];
    		// $id_kelas_matkul_si = $pambagisi[1];
    		$orkom = $pambagiorkom[0];
    		// $id_kelas_matkul_orkom = $pambagiorkom[1];
    		$sigit2 = $pambagisigit2[0];
    		// $id_kelas_matkul_sigit2 = $pambagisigit2[1];
    		$jarkom = $pambagijarkom[0];
    		// $id_kelas_matkul_jarkom = $pambagijarkom[1];
    		$spm = $pambagispm[0];
    		// $id_kelas_matkul_spm = $pambagispm[1];
    		$mobile = $pambagimobile[0];
    		// $id_kelas_matkul_mobile = $pambagimobile[1];
    		$python = $pambagipython[0];
    		// $id_kelas_matkul_python = $pambagipython[1];
    		$kejar = $pambagikejar[0];
    		// $id_kelas_matkul_kejar = $pambagikejar[1];

    		//ganjil
    		$pambagielektronika = explode(" ",$this->input->post('elektronika', true));
    		$pambagisigit1 = explode(" ",$this->input->post('sigit1', true));
    		$pambagisismik = explode(" ",$this->input->post('sismik', true));
    		$pambagiiot = explode(" ",$this->input->post('iot', true));
    		$pambagiadminjar = explode(" ",$this->input->post('adminjar', true));
    		$pambagisim = explode(" ",$this->input->post('sim', true));
    		$pambagirobotik = explode(" ",$this->input->post('robotik', true));
    		
    		$elektronika = $pambagielektronika[0];
    		// $id_kelas_matkul_elektronika = $pambagielektronika[1];
    		$sigit1 = $pambagisigit1[0];
    		// $id_kelas_matkul_sigit1 = $pambagisigit1[1];
    		$sismik = $pambagisismik[0];
    		// $id_kelas_matkul_sismik = $pambagisismik[1];
    		$iot = $pambagiiot[0];
    		// $id_kelas_matkul_iot = $pambagiiot[1];
    		$adminjar = $pambagiadminjar[0];
    		// $id_kelas_matkul_adminjar = $pambagiadminjar[1];
    		$sim = $pambagisim[0];
    		// $id_kelas_matkul_sim = $pambagisim[1];
    		$robotik = $pambagirobotik[0];
    		// $id_kelas_matkul_robotik = $pambagirobotik[1];

    		if(empty($pambagisi[0])){$tambah1 = 0;}else{$tambah1 = 1;}
    		if(empty($pambagiorkom[0])){$tambah2 = 0;}else{$tambah2 = 1;}
    		if(empty($pambagielektronika[0])){$tambah3 = 0;}else{$tambah3 = 1;}
    		if(empty($pambagisigit1[0])){$tambah4 = 0;}else{$tambah4 = 1;}
    		if(empty($pambagijarkom[0])){$tambah5 = 0;}else{$tambah5 = 1;}
    		if(empty($pambagisigit2[0])){$tambah6 = 0;}else{$tambah6 = 1;}
    		if(empty($pambagisismik[0])){$tambah7 = 0;}else{$tambah7 = 1;}
    		if(empty($pambagiiot[0])){$tambah8 = 0;}else{$tambah8 = 1;}
    		if(empty($pambagiadminjar[0])){$tambah9 = 0;}else{$tambah9 = 1;}
    		if(empty($pambagispm[0])){$tambah10 = 0;}else{$tambah10 = 1;}
    		if(empty($pambagimobile[0])){$tambah11 = 0;}else{$tambah11 = 1;}
    		if(empty($pambagipython[0])){$tambah12 = 0;}else{$tambah12 = 1;}
    		if(empty($pambagikejar[0])){$tambah13 = 0;}else{$tambah13 = 1;}
    		if(empty($pambagisim[0])){$tambah14 = 0;}else{$tambah14 = 1;}
    		if(empty($pambagirobotik[0])){$tambah15 = 0;}else{$tambah15 = 1;}

    		if(empty($pambagisi[1])){$id_kelas_matkul_si = '';}else{$id_kelas_matkul_si = $pambagisi[1];}
    		if(empty($pambagiorkom[1])){$id_kelas_matkul_orkom = '';}else{$id_kelas_matkul_orkom = $pambagiorkom[1];}
    		if(empty($pambagielektronika[1])){$id_kelas_matkul_elektronika = '';}else{$id_kelas_matkul_elektronika = $pambagielektronika[1];}
    		if(empty($pambagisigit1[1])){$id_kelas_matkul_sigit1 = '';}else{$id_kelas_matkul_sigit1 = $pambagisigit1[1];}
    		if(empty($pambagijarkom[1])){$id_kelas_matkul_jarkom = '';}else{$id_kelas_matkul_jarkom = $pambagijarkom[1];}
    		if(empty($pambagisigit2[1])){$id_kelas_matkul_sigit2 = '';}else{$id_kelas_matkul_sigit2 = $pambagisigit2[1];}
    		if(empty($pambagisismik[1])){$id_kelas_matkul_sismik = '';}else{$id_kelas_matkul_sismik = $pambagisismik[1];}
    		if(empty($pambagiiot[1])){$id_kelas_matkul_iot = '';}else{$id_kelas_matkul_iot = $pambagiiot[1];}
    		if(empty($pambagiadminjar[1])){$id_kelas_matkul_adminjar = '';}else{$id_kelas_matkul_adminjar = $pambagiadminjar[1];}
    		if(empty($pambagispm[1])){$id_kelas_matkul_spm = '';}else{$id_kelas_matkul_spm = $pambagispm[1];}
    		if(empty($pambagimobile[1])){$id_kelas_matkul_mobile = '';}else{$id_kelas_matkul_mobile = $pambagimobile[1];}
    		if(empty($pambagipython[1])){$id_kelas_matkul_python = '';}else{$id_kelas_matkul_python = $pambagipython[1];}
    		if(empty($pambagikejar[1])){$id_kelas_matkul_kejar = '';}else{$id_kelas_matkul_kejar = $pambagikejar[1];}
    		if(empty($pambagisim[1])){$id_kelas_matkul_sim = '';}else{$id_kelas_matkul_sim = $pambagisim[1];}
    		if(empty($pambagirobotik[1])){$id_kelas_matkul_robotik = '';}else{$id_kelas_matkul_robotik = $pambagirobotik[1];}
    		// $total = $tambah1+$tambah2+$tambah3+$tambah4+$tambah5+$tambah6+$tambah7+$tambah8+$tambah9+$tambah10+$tambah11+$tambah12+$tambah13+$tambah14+$tambah15;

    		$kirimdata['id_user'] = $user_id;
				$kirimdata['sistem_instrumentasi'] = $si;
				$kirimdata['Organisasi_komputer'] = $orkom;
				$kirimdata['elektronika'] = $elektronika;
				$kirimdata['sistem_digital_1'] = $sigit1;
				$kirimdata['jaringan_komputer'] = $jarkom;
				$kirimdata['sistem_digital_2'] = $sigit2;
				$kirimdata['sistem_mikroprosesor'] = $sismik;
				$kirimdata['otomasi'] = $iot;
				$kirimdata['administrasi_jaringan'] = $adminjar;
				$kirimdata['sistem_pemrograman_mikroprosesor'] = $spm;
				$kirimdata['mobile_programing'] = $mobile;
				$kirimdata['keamanan_jaringan'] = $kejar;
				$kirimdata['pemrograman_python'] = $python;
				$kirimdata['sistem_interface_mikrokontroler'] = $sim;
				$kirimdata['robotik'] = $robotik;
				$this->main_model->hapus_absensi_mhs($user_id);
	 			$this->main_model->hapus_nilai_mhs($user_id);
				if($semester == 2){
					$total = 8;
					$data_array = array($id_kelas_matkul_si,$id_kelas_matkul_orkom,$id_kelas_matkul_sigit2,$id_kelas_matkul_jarkom,$id_kelas_matkul_spm,$id_kelas_matkul_mobile,$id_kelas_matkul_python,$id_kelas_matkul_kejar);
				}elseif($semester == 1){
					$total = 7;
					$data_array = array($id_kelas_matkul_elektronika,$id_kelas_matkul_sigit1,$id_kelas_matkul_sismik,$id_kelas_matkul_iot,$id_kelas_matkul_adminjar,$id_kelas_matkul_sim,$id_kelas_matkul_robotik);
				}
				$cek_user = $this->db->query("SELECT * FROM tbl_kelas_mhs WHERE id_user='$user_id'")->num_rows();		
				if($cek_user>0){
					for($i=0;$i<$total;$i++){
	    			$kirimdata2['id_kelas_matkul'] = $data_array[$i];
	    			$kirimdata2['id_user'] = $user_id;
	    			if($data_array[$i] != 0){
			 				$this->main_model->insert_absensi_mhs($kirimdata2);
			 				$this->main_model->insert_nilai_mhs($kirimdata2);
			 			}
		 			}
					$success = $this->main_model->update_kelas_mhs($kirimdata, $user_id);
				}else{
					for($i=0;$i<$total;$i++){
	    			$kirimdata2['id_kelas_matkul'] = $data_array[$i];
	    			$kirimdata2['id_user'] = $user_id;
	    			if($data_array[$i] != 0){
			 				$this->main_model->insert_absensi_mhs($kirimdata2);
			 				$this->main_model->insert_nilai_mhs($kirimdata2);
			 			}
		 			}
					$success = $this->main_model->insert_kelas_mhs($kirimdata);
				}
				
	 			if($success){
	 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_mahasiswa');
	 			}else{
	 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_mahasiswa');
	 			}
			}
		}

  	//Kelas Mata Kuliah
		function v_kelas_matkul(){
			$data = array(
	      'data_kelas_matkul' => $this->main_model->get_all_kelas_matkul()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/master_data/kelas_matkul/v_kelas_matkul', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function save_kelas_matkul(){
			$this->form_validation->set_rules('inputMatkul','Input Mata Kuliah', 'required');
			$this->form_validation->set_rules('inputKelas','Input Kelas', 'required');
			$this->form_validation->set_rules('lab','Pilih Laboratorium', 'required');
			$this->form_validation->set_rules('inputMaksmhs','Input Maksimal Mahasiswa', 'required');
			$this->form_validation->set_rules('inputHari','Input Hari', 'required');
			$this->form_validation->set_rules('inputMulai','Input Mulai Praktikum', 'required');
			$this->form_validation->set_rules('inputSelesai','Input Selesai Praktikum', 'required');
	 		
      if ($this->form_validation->run() == FALSE) { 
      	$this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
    		redirect('v_kelas_matkul');
			}else{
    		$inputMatkul = $this->input->post('inputMatkul', true);
    		$inputKelas = $this->input->post('inputKelas', true);
    		$kodematkul = $this->input->post('kodematkul', true);
    		$data_explode = explode(" ", $kodematkul);
				foreach ($data_explode as $key => $value) {
					$sub_kalimat = substr($value,0,3);
					$hasil[$key] = $sub_kalimat;
				}
				$data_implode = implode("", $hasil);
				$kodekelas = $data_implode."-".$inputKelas;
    		$kelas = $kodematkul." ".$inputKelas;
    		$lab = $this->input->post('lab', true);
    		$inputMaksmhs = $this->input->post('inputMaksmhs', true);
    		$inputAsdos_1 = $this->input->post('inputAsdos_1', true);
    		$inputAsdos_2 = $this->input->post('inputAsdos_2', true);
    		if(empty($inputAsdos_2)){
    			$inputAsdos_2 = "0";
    		}
    		$inputHari = $this->input->post('inputHari', true);
    		$inputMulai = $this->input->post('inputMulai', true);
    		$inputSelesai = $this->input->post('inputSelesai', true);
    		$kirimdata['id_matkul'] = $inputMatkul;
				$kirimdata['kode'] = $kodekelas;
				$kirimdata['kelas'] = $kelas;
				$kirimdata['lab'] = $lab;
				$kirimdata['maks_mhs'] = $inputMaksmhs;
				$kirimdata['asdos_1'] = $inputAsdos_1;
				$kirimdata['asdos_2'] = $inputAsdos_2;
				$kirimdata['hari'] = $inputHari;
				$kirimdata['mulai_praktikum'] = $inputMulai.":00";
				$kirimdata['selesai_praktikum'] = $inputSelesai.":00";
				$kirimdata['status'] = "1";
				$success = $this->main_model->insert_kelas_matkul($kirimdata);
				
	 			if($success){
	 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_kelas_matkul');
	 			}else{
	 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_kelas_matkul');
	 			}
			}
		}

		function edit_kelas_matkul($id_kelas_matkul){
			$data = array(
	      'data_kelas_matkul' => $this->main_model->ubah_kelas_matkul($id_kelas_matkul)->result(),
	    );
			$this->load->view('admin/master_data/kelas_matkul/edit_kelas_matkul', $data);
		}

		function update_kelas_matkul(){
			$this->form_validation->set_rules('inputMatkul','Input Mata Kuliah', 'required');
			$this->form_validation->set_rules('inputKelas','Input Kelas', 'required');
			$this->form_validation->set_rules('lab','Pilih Laboratorium', 'required');
			$this->form_validation->set_rules('inputMaksmhs','Input Maksimal Mahasiswa', 'required');
			$this->form_validation->set_rules('inputHari','Input Hari', 'required');
			$this->form_validation->set_rules('inputMulai','Input Mulai Praktikum', 'required');
			$this->form_validation->set_rules('inputSelesai','Input Selesai Praktikum', 'required');
	 		
	    if ($this->form_validation->run() == FALSE) { 
	    	$this->session->set_flashdata('gagal', 'Coba cek lagi data input anda, kemungkinan terdapat kesalahan !!! Terimakasih ..');
		    redirect('v_kelas_matkul');
			}else{
      	$kelas_matkul_id = $this->input->post('kelas_matkul_id');
      	$inputMatkul = $this->input->post('inputMatkul', true);
    		$inputKelas = $this->input->post('inputKelas', true);
    		$kodematkul = $this->input->post('kodematkul', true);
    		$data_explode = explode(" ", $kodematkul);
				foreach ($data_explode as $key => $value) {
					$sub_kalimat = substr($value,0,3);
					$hasil[$key] = $sub_kalimat;
				}
				$data_implode = implode("", $hasil);
				$kodekelas = $data_implode."-".$inputKelas;
    		$kelas = $kodematkul." ".$inputKelas;
    		$lab = $this->input->post('lab', true);
    		$inputMaksmhs = $this->input->post('inputMaksmhs', true);
    		$inputAsdos_1 = $this->input->post('inputAsdos_1', true);
    		$inputAsdos_2 = $this->input->post('inputAsdos_2', true);
    		if(empty($inputAsdos_2)){
    			$inputAsdos_2 = "0";
    		}
    		$inputHari = $this->input->post('inputHari', true);
    		$inputMulai = $this->input->post('inputMulai', true);
    		$inputSelesai = $this->input->post('inputSelesai', true);
    		$status = $this->input->post('kondisi', true);
    		$kirimdata['id_matkul'] = $inputMatkul;
				$kirimdata['kode'] = $kodekelas;
				$kirimdata['kelas'] = $kelas;
				$kirimdata['lab'] = $lab;
				$kirimdata['maks_mhs'] = $inputMaksmhs;
				$kirimdata['asdos_1'] = $inputAsdos_1;
				$kirimdata['asdos_2'] = $inputAsdos_2;
				$kirimdata['hari'] = $inputHari;
				$kirimdata['mulai_praktikum'] = $inputMulai.":00";
				$kirimdata['selesai_praktikum'] = $inputSelesai.":00";
				$kirimdata['status'] = $status;
				$success = $this->main_model->update_kelas_matkul($kirimdata, $kelas_matkul_id);
					
	 			if($success){
	 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_kelas_matkul');
	 			}else{
	 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_kelas_matkul');
	 			}
			}
		}

		function delete_kelas_matkul($id_kelas_matkul){
      $this->main_model->hapus_kelas_matkul($id_kelas_matkul);
	    redirect('v_kelas_matkul');
    }

    function detail_kelas_matkul($id_kelas_matkul){
			$data = array(
	      'data_kelas_matkul' => $this->main_model->detail_kelas_matkul($id_kelas_matkul)->result(),
	    );
			$this->load->view('admin/master_data/kelas_matkul/detail_kelas_matkul', $data);
		}

  	function delete_kelas_matkul_all($id_kelas_matkul){
      $jumlah_dipilih = count($id_kelas_matkul);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_kelas_matkul($id_kelas_matkul[$x]);
      }
      $this->session->set_flashdata('sukses', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
  	  redirect('v_kelas_matkul');
  	}

  	//Kelas Mahasiswa
		function v_kelas_mhs(){
			$data = array(
	      'data_kelas_mhs_reguler' => $this->main_model->get_all_kelas_mhs_reguler()->result(),
	      'data_kelas_mhs_malam' => $this->main_model->get_all_kelas_mhs_malam()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/master_data/kelas_mhs/v_kelas_mhs', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		//Persentase Nilai
		function v_persentase_nilai(){
			$data = array(
	      'data_persentase_nilai' => $this->main_model->get_all_persentase_nilai()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/master_data/persentase_nilai/v_persentase_nilai', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function edit_persentase_nilai($id_persentase){
			$data = array(
	      'data_persentase_nilai' => $this->main_model->ubah_persentase_nilai($id_persentase)->result(),
	    );
			$this->load->view('admin/master_data/persentase_nilai/edit_persentase_nilai', $data);
		}

		function update_persentase_nilai(){
    	$persentase_id = $this->input->post('persentase_id');
    	$matkul_id = $this->input->post('matkul_id');
    	$inputAbsen = $this->input->post('inputAbsen')/100;
    	$inputKuis = $this->input->post('inputKuis')/100;
    	$inputTugas = $this->input->post('inputTugas')/100;
    	$inputUAP = $this->input->post('inputUAP')/100;
    	$inputTugasakhir = $this->input->post('inputTugasakhir')/100;
    	$jml = $inputAbsen + $inputKuis + $inputTugas + $inputUAP + $inputTugasakhir;
    	if($jml == 1){
	  		$kirimdata['id_matkul'] = $matkul_id;
				$kirimdata['absen'] = $inputAbsen;
				$kirimdata['kuis'] = $inputKuis;
				$kirimdata['tugas'] = $inputTugas;
				$kirimdata['uap'] = $inputUAP;
				$kirimdata['tugasakhir'] = $inputTugasakhir;
				$success = $this->main_model->update_persentase_nilai($kirimdata, $persentase_id);
				
	 			if($success){
	 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
	    		redirect('v_persentase_nilai');
	 			}else{
	 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
	    		redirect('v_persentase_nilai');
	 			}
	 		}elseif($jml < 1){
	 			$this->session->set_flashdata('gagal', 'Total Persentase Nilai kurang dari 100%');
	    	redirect('v_persentase_nilai');
	 		}elseif($jml > 1){
	 			$this->session->set_flashdata('gagal', 'Total Persentase Nilai lebih dari 100%');
	    	redirect('v_persentase_nilai');
	 		}
		}

		//Qrcode
		function v_qrcode(){
			$data = array(
	      'data_qrcode' => $this->main_model->get_all_qrcode()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/master_data/qrcode/v_qrcode', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function save_qrcode(){
			$this->load->library('ciqrcode');
    	$inputMatkul = $this->input->post('inputMatkul');			
    	$getkelas = $this->main_model->get_kelas_matkulBY2($inputMatkul)->result();
			foreach ($getkelas as $value) {
				$qrcode = $this->main_model->get_all_qrcodeBY($value->kode)->num_rows();
				if($qrcode > 0) {
					$this->session->set_flashdata('gagal', 'Qrcode sudah di buat !!! Terimakasih ..');
    			redirect('v_qrcode');
				}else{
	    		$inputPertemuan = $this->input->post('inputPertemuan');		
					$kode = $value->kode;
					$nama_qrcode = $kode."-".$inputPertemuan;
					$qrcode_gbr = $nama_qrcode.".png";
					$data = array(
						"kode" => $kode,
						"pertemuan" => $inputPertemuan,
					);
					$result = json_encode($data);
					$config['cacheable']    = true;
	        $config['cachedir']     = './assets/';
	        $config['errorlog']     = './assets/';
	        $config['imagedir']     = './assets/images/imgqrcode/absen/';
	        $config['quality']      = true;
	        $config['size']         = '1024';
	        $config['black']        = array(224,255,255);
	        $config['white']        = array(70,130,180);
	        $this->ciqrcode->initialize($config);
	 
	        $params['data'] = $result;
	        $params['level'] = 'H';
	        $params['size'] = 10;
	        $params['savename'] = FCPATH.$config['imagedir'].$qrcode_gbr;
	        $this->ciqrcode->generate($params);

	        $kirimdata['kode'] = $kode;
	        $kirimdata['pertemuan'] = $inputPertemuan;
	        $kirimdata['nama_qrcode'] = $nama_qrcode;
	        $kirimdata['qrcode'] = $qrcode_gbr;
	        $kirimdata['id_kelas_matkul'] = $value->id_kelas_matkul;
	        $kirimdata['status'] = "1";
					$success = $this->main_model->insert_qrcode($kirimdata);
				}
			}
			if($success){
 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
    		redirect('v_qrcode');
 			}else{
 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
    		redirect('v_qrcode');
 			}
		}

		function detail_qrcode($kode){
			$data = array(
	      'data_qrcode' => $this->main_model->get_all_qrcodeBY($kode)->result(),
	    );
			$this->load->view('admin/master_data/qrcode/detail_qrcode', $data);
		}

		function delete_qrcode_all(){
      $id_qrcode = $this->input->post('pilih');
      $jumlah_dipilih = count($id_qrcode);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$qrcode = $this->main_model->get_all_qrcodeBY2($id_qrcode[$x])->result_array();
      	unlink("assets/images/imgqrcode/absen/".$qrcode[0]['qrcode']);
      	$this->main_model->hapus_qrcode($id_qrcode[$x]);
      }
      $this->session->set_flashdata('sukses', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
  	  redirect('v_qrcode');
  	}

  	//Session Akun
  	function v_session_akun(){
			$data = array(
	      'data_session_akun' => $this->main_model->get_all_session_akun()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/master_data/session_akun/v_session_akun', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function delete_session_akun_all(){
      $ip_address = $this->input->post('pilih');
      $jumlah_dipilih = count($ip_address);
      for($x=0;$x<$jumlah_dipilih;$x++){
      	$this->main_model->hapus_session_akun($ip_address[$x]);
      }
      $this->session->set_flashdata('sukses', 'Data yang di pilih berhasil dihapus !!! Terimakasih ..');
  	  redirect('v_qrcode');
  	}

  	//Absensi
  	function v_absensi(){
			$data = array(
	      'data_absensi' => $this->main_model->get_all_matkul()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/proses_data/absensi/v_absensi', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

  	function absen_kelas_matkul($id_matkul){
  		$data = array(
	      'data_absensi_kelas' => $this->main_model->get_kelas_matkulBY2($id_matkul),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/proses_data/absensi/v_absensi_kelas', $data);
			$this->load->view('admin/kelengkapan/footer');	
  	}

  	function absen_kelas($id_kelas_matkul,$kode){
			$data = array(
	      'data_absensi' => $this->main_model->get_all_absen_mhs($id_kelas_matkul,$kode),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/proses_data/absensi/v_absen', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function edit_absen($id_user,$id_kelas_matkul){
			$data = array(
	      'data_absensi' => $this->main_model->ubah_absen_mhs($id_user,$id_kelas_matkul)->result(),
	    );
			$this->load->view('admin/proses_data/absensi/edit_absen', $data);
		}

		function update_absensi(){
    	$kelas_matkul_id = $this->input->post('kelas_matkul_id');
    	$user_id = $this->input->post('user_id');
    	$kode = $this->input->post('kode');
    	$inputAbsen1 = $this->input->post('inputAbsen1');
    	$inputAbsen2 = $this->input->post('inputAbsen2');
    	$inputAbsen3 = $this->input->post('inputAbsen3');
    	$inputAbsen4 = $this->input->post('inputAbsen4');
    	$inputAbsen5 = $this->input->post('inputAbsen5');
    	$inputAbsen6 = $this->input->post('inputAbsen6');
    	$inputAbsen7 = $this->input->post('inputAbsen7');
    	$inputAbsen8 = $this->input->post('inputAbsen8');
    	$inputAbsen9 = $this->input->post('inputAbsen9');
    	$inputAbsen10 = $this->input->post('inputAbsen10');
  		$kirimdata['a_1'] = $inputAbsen1;
  		$kirimdata['a_2'] = $inputAbsen2;
  		$kirimdata['a_3'] = $inputAbsen3;
  		$kirimdata['a_4'] = $inputAbsen4;
  		$kirimdata['a_5'] = $inputAbsen5;
  		$kirimdata['a_6'] = $inputAbsen6;
  		$kirimdata['a_7'] = $inputAbsen7;
  		$kirimdata['a_8'] = $inputAbsen8;
  		$kirimdata['a_9'] = $inputAbsen9;
  		$kirimdata['a_10'] = $inputAbsen10;
			$success = $this->main_model->update_absensi($kirimdata,$kelas_matkul_id,$user_id);
			
 			if($success){
 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
    		redirect('absen_kelas/'.$kelas_matkul_id."/".$kode);
 			}else{
 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
    		redirect('absen_kelas/'.$kelas_matkul_id."/".$kode);
 			}
		}

		//Nilai
  	function v_penilaian(){
			$data = array(
	      'data_nilai' => $this->main_model->get_all_matkul()->result(),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/proses_data/nilai/v_penilaian', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function nilai_kelas_matkul($id_matkul){
  		$data = array(
	      'data_nilai_kelas' => $this->main_model->get_kelas_matkulBY2($id_matkul),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/proses_data/nilai/v_nilai_kelas', $data);
			$this->load->view('admin/kelengkapan/footer');	
  	}

  	function nilai_kelas($id_kelas_matkul,$kode){
			$data = array(
	      'data_nilai' => $this->main_model->get_all_nilai_mhs($id_kelas_matkul,$kode),
	    );
			$this->load->view('admin/kelengkapan/header');
			$this->load->view('admin/proses_data/nilai/v_nilai', $data);
			$this->load->view('admin/kelengkapan/footer');
		}

		function edit_nilai($id_user,$id_kelas_matkul){
			$data = array(
	      'data_nilai' => $this->main_model->ubah_nilai_mhs($id_user,$id_kelas_matkul)->result(),
	    );
			$this->load->view('admin/proses_data/nilai/edit_nilai', $data);
		}

		function update_penilaian(){
    	$kelas_matkul_id = $this->input->post('kelas_matkul_id');
    	$user_id = $this->input->post('user_id');
    	$kode = $this->input->post('kode');
    	$inputTugas1 = $this->input->post('inputTugas1');
    	$inputTugas2 = $this->input->post('inputTugas2');
    	$inputTugas3 = $this->input->post('inputTugas3');
    	$inputTugas4 = $this->input->post('inputTugas4');
    	$inputTugas5 = $this->input->post('inputTugas5');
    	$inputKuis = $this->input->post('inputKuis');
    	$inputUAP = $this->input->post('inputUAP');
    	$inputTugasAkhir = $this->input->post('inputTugasAkhir');
  		$kirimdata['tugas1'] = $inputTugas1;
  		$kirimdata['tugas2'] = $inputTugas2;
  		$kirimdata['tugas3'] = $inputTugas3;
  		$kirimdata['tugas4'] = $inputTugas4;
  		$kirimdata['tugas5'] = $inputTugas5;
  		$kirimdata['kuis'] = $inputKuis;
  		$kirimdata['uap'] = $inputUAP;
  		$kirimdata['tugasakhir'] = $inputTugasAkhir;
			$success = $this->main_model->update_nilai($kirimdata,$kelas_matkul_id,$user_id);
			
 			if($success){
 				$this->session->set_flashdata('sukses', 'Data berhasil disimpan !!! Terimakasih ..');
    		redirect('nilai_kelas/'.$kelas_matkul_id."/".$kode);
 			}else{
 				$this->session->set_flashdata('gagal', 'Data gagal disimpan !!! Terimakasih ..');
    		redirect('nilai_kelas/'.$kelas_matkul_id."/".$kode);
 			}
		}

		function add_ajax_kab($id)
		{
    	$query = $this->main_model->get_all_kabkotkecdeskel($id);
    	$data = "<option value=''>--- Pilih Kabupaten / Kota ---</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->kode."'>".$value->nama."</option>";
    	}
    	echo $data;
		}
	  
		function add_ajax_kec($id)
		{
    	$query = $this->main_model->get_all_kabkotkecdeskel($id);
    	$data = "<option value=''>--- Pilih Kecamatan ---</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->kode."'>".$value->nama."</option>";
    	}
    	echo $data;
		}
	  
		function add_ajax_des($id)
		{
    	$query = $this->main_model->get_all_kabkotkecdeskel($id);
    	$data = "<option value=''>--- Pilih Desa / Kelurahan ----</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->kode."'>".$value->nama."</option>";
    	}
    	echo $data;
		}

		function GetKodePos(){
			$GetKodePos = $this->main_model->get_all_kodepos($_GET['kode']);
			foreach ($GetKodePos->result() as $value) {
				$data = array(
					"kode_pos" => $value->kode_pos,
				);
			}
			echo json_encode($data);
		}
}