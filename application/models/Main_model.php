<?php
class Main_model extends CI_Model{
  //Profile
    function insert_pengguna($kirimdata, $kondisi){
      $tabel = array(1 => 'tbl_login','tbl_pengguna','tbl_data_siswa');
      $query = $this->db->insert($tabel[$kondisi], $kirimdata);
      if($query){
          return true;
      }else{
          return false;
      }
    }

    function ubahordetail_pengguna($id_login, $kondisi){
      $tabel = array(1 => 'view_admin','view_guru','view_siswa');
      // $this->db->select('tbl_login.*,tbl_pengguna.*');
      // $this->db->from('tbl_login');
      // $this->db->join('tbl_pengguna','tbl_login.id_login=tbl_pengguna.loginID');
      // $this->db->where('tbl_login.id_login', $id_login);
      $this->db->where('id_login', $id_login);
      $query=$this->db->get($tabel[$kondisi]);
      return $query;
    }

    function update_profiltampildata($kirimdata, $id_login){
      $this->db->where('id_login', $id_login);
      $query = $this->db->update('tbl_login', $kirimdata);
      if($query){
          return true;
      }else{
          return false;
      }
    }

    function update_profil($kirimdata, $kondisi, $id_login){
      $tabel = array(1 => 'tbl_login','tbl_pengguna','tbl_data_siswa');
      $where = array(1 => 'id_login','loginID','loginID');
      $this->db->where($where[$kondisi], $id_login);
      $query = $this->db->update($tabel[$kondisi], $kirimdata);
      if($query){
          return true;
      }else{
          return false;
      }
    }

    function hapus_pengguna($id_login, $where){
      if($where == 1 || $where == 2 || $where == 3){
        $this->db->where('id_login', $id_login);
        $this->db->delete('tbl_login');
        
        $this->db->where('loginID', $id_login);
        $this->db->delete('tbl_pengguna');
      }
      if($where == 2){
        $this->db->where('loginID', $id_login);
        $this->db->delete('tbl_mengajar');
      }
      if($where == 3){
        $this->db->where('loginID', $id_login);
        $this->db->delete('tbl_data_siswa');
      }
    }

    //Data Kelas Matkul
      //ganjil
      function get_matkul_elektronika(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='3' ORDER BY b.kelas ASC");
        return $query;
      }
      
      function get_matkul_sigit1(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='4' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_sismik(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='9' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_iot(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='7' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_adminjar(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='8' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_sim(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='14' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_robotik(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='15' ORDER BY b.kelas ASC");
        return $query;
      }

      //genap
      function get_matkul_si($sistem_instrumentasi){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='1' && b.kode!='$sistem_instrumentasi' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_orkom($organisasi_komputer){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='2' && b.kode!='$organisasi_komputer' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_jarkom(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='5' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_sigit2(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='6' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_spm(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='10' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_mobile(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='11' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_python(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='12' ORDER BY b.kelas ASC");
        return $query;
      }

      function get_matkul_kejar(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_matkul AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_matkul=b.id_matkul WHERE b.id_matkul='13' ORDER BY b.kelas ASC");
        return $query;
      }

    //Data Tambahan
      function get_all_TabelPendukung($array,$where,$id){
        $tabel = array('tbl_jabatan','tbl_pendidikan','tbl_status_pernikahan','tbl_asalsekolah','tbl_citacita','tbl_hobi','tbl_jenjang','tbl_pekerjaan','tbl_penghasilan','tbl_tempattinggal','tbl_jarakrumah','tbl_transportasi');
        $kondisi = array('id_jabatan','id_pendidikan','id_status_pernikahan','id_asalsekolah','id_citacita','id_hobi','id_jenjang','id_pekerjaan','id_penghasilan','id_tempattinggal','id_jarakrumah','id_transportasi');
        if($where == 1){
          $this->db->where($kondisi[$array], $id);
        }
        $query=$this->db->get($tabel[$array]);
        return $query;
      }

      function get_all_provinsi(){
        $this->db->where('CHAR_LENGTH(kode)', '2');
        $this->db->order_by('nama','ASC');
        $query=$this->db->get('tbl_wilayah');
        return $query;
      }

      function get_all_kabkotkecdeskel($id){
        $n=strlen($id);
        $m=($n==2?5:($n==5?8:13));
        $query=$this->db->query("SELECT * FROM tbl_wilayah WHERE LEFT(kode,'$n')='$id' AND CHAR_LENGTH(kode)=$m ORDER BY nama");
        return $query;
      }

      function get_all_lokasi($kode){
        $this->db->where('kode', $kode);
        $query=$this->db->get('tbl_wilayah');
        return $query;
      }

      function get_all_kodepos($kode){
        $this->db->where('kode', $kode);
        $query=$this->db->get('tbl_wilayah');
        return $query;
      }

    //Master Data
    	//Administrator
    	function get_all_admin(){
        $query=$this->db->get('view_admin');
        return $query;
      } 

      //Guru
      function get_all_guru(){
        $query=$this->db->get('view_guru');
        return $query;
      }

      function get_all_guruPanel(){
        $this->db->order_by('nama', 'ASC');
        $this->db->where('aktif_state', '1');
        $query=$this->db->get('view_guru');
        return $query;
      } 

      //Siswa
      function get_all_siswa(){
        $query=$this->db->get('view_siswa');
        return $query;
      }

      function lihat_nilai($id_mapel,$id_kelas,$id_guru,$id_siswa){
        $this->db->where('mapelID', $id_mapel);
        $this->db->where('kelasID', $id_kelas);
        $this->db->where('guruID', $id_guru);
        $this->db->where('siswaID', $id_siswa);
        $query=$this->db->get('view_hasil_ujian');
        return $query;
      }

      function insert_hasil_ujian($kirimdata){
        $query = $this->db->insert('tbl_hasil_ujian', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      //Kelas
      function get_all_kelas(){
        $this->db->order_by('romawi_kelas','ASC');
        $this->db->order_by('angka_kelas','ASC');
        $query=$this->db->get('tbl_kelas');
        return $query;
      }

      function get_all_kelasBy($romawi_kelas){
        $this->db->where('aktif_state','1');
        $this->db->where('romawi_kelas',$romawi_kelas);
        // $this->db->order_by('romawi_kelas','ASC');
        $this->db->order_by('id_kelas','ASC');
        $query=$this->db->get('tbl_kelas');
        return $query;
      }

      function insert_kelas($kirimdata){
        $query = $this->db->insert('tbl_kelas', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      } 

      function ubah_kelas($id_kelas){
        $this->db->where('id_kelas', $id_kelas);
        $query=$this->db->get('tbl_kelas');
        return $query;
      }

      function update_kelas($kirimdata, $id_kelas){
        $this->db->where('id_kelas', $id_kelas);
        $query = $this->db->update('tbl_kelas', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function hapus_kelas($id_kelas){
        $this->db->where('id_kelas', $id_kelas);
        $this->db->delete('tbl_kelas');
        
        $this->db->where('kelasID', $id_kelas);
        $this->db->delete('tbl_mengajar');
      }

      //MaPel
      function get_all_mapel($where){
        if($where == 1){
          $this->db->where('aktif_state', "1");
        }
        $this->db->order_by('nama_mapel','ASC');
        $query=$this->db->get('tbl_mapel');
        return $query;
      }

      function insert_mapel($kirimdata){
        $query = $this->db->insert('tbl_mapel', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      } 

      function ubah_mapel($id_mapel){
        $this->db->where('id_mapel', $id_mapel);
        $query=$this->db->get('tbl_mapel');
        return $query;
      }

      function update_mapel($kirimdata, $id_mapel){
        $this->db->where('id_mapel', $id_mapel);
        $query = $this->db->update('tbl_mapel', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function hapus_mapel($id_mapel){
        $this->db->where('id_mapel', $id_mapel);
        $this->db->delete('tbl_mapel');
        
        $this->db->where('mapelID', $id_mapel);
        $this->db->delete('tbl_mengajar');
      }

      //SK Mengajar
      function get_all_sk_mengajar(){
        $this->db->where('statusGuru','1');
        $this->db->order_by('nama','ASC');
        $this->db->order_by('nama_mapel','ASC');
        // $this->db->order_by('romawi_kelas','ASC');
        // $this->db->order_by('angka_kelas','ASC');
        $query=$this->db->get('view_mengajar');
        return $query;
      }

      function get_all_sk_mengajarBy($id_login){
        $this->db->where('id_login',$id_login);
        $this->db->order_by('nama','ASC');
        $this->db->order_by('nama_mapel','ASC');
        // $this->db->order_by('romawi_kelas','ASC');
        // $this->db->order_by('angka_kelas','ASC');
        $query=$this->db->get('view_mengajar');
        return $query;
      }

      function get_all_sk_mengajarBy2($id_kelas){
        $this->db->where('id_kelas',$id_kelas);
        $this->db->order_by('nama','ASC');
        $this->db->order_by('nama_mapel','ASC');
        // $this->db->order_by('romawi_kelas','ASC');
        // $this->db->order_by('angka_kelas','ASC');
        $query=$this->db->get('view_mengajar');
        return $query;
      }

      function get_all_sk_mengajarBy3($id_mapel){
        $this->db->where('id_mapel',$id_mapel);
        $this->db->order_by('nama','ASC');
        $this->db->order_by('nama_mapel','ASC');
        // $this->db->order_by('romawi_kelas','ASC');
        // $this->db->order_by('angka_kelas','ASC');
        $query=$this->db->get('view_mengajar');
        return $query;
      }

      function get_all_sk_mengajarbydistinct($id_login){
        $this->db->distinct();
        $this->db->select('nama, nama_mapel');
        $query=$this->db->get('view_mengajar');
        return $query;
      }

      function insert_sk_mengajar($kirimdata){
        $query = $this->db->insert('tbl_mengajar', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function ubah_sk_mengajar($id_mengajar){
        $this->db->where('id_mengajar', $id_mengajar);
        $query=$this->db->get('tbl_mengajar');
        return $query;
      }

      function update_sk_mengajar($kirimdata, $id_mengajar){
        $this->db->where('id_mengajar', $id_mengajar);
        $query = $this->db->update('tbl_mengajar', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function hapus_sk_mengajar($id_mengajar){
        $this->db->where('id_mengajar', $id_mengajar);
        $this->db->delete('tbl_mengajar');
      }

      //Kelas Siswa
      function get_all_kelas_siswaBy($id_login){
        $this->db->where('id_login',$id_login);
        $query=$this->db->get('view_kelas_siswa');
        return $query;
      }

      function get_all_kelas_siswaBy2($id_kelas){
        $this->db->where('id_kelas',$id_kelas);
        $query=$this->db->get('view_kelas_siswa');
        return $query;
      }

      function get_all_kelas_siswaBy3($romawi_kelas,$angka_kelas){
        $this->db->where('romawi_kelas',$romawi_kelas);
        $this->db->where('angka_kelas',$angka_kelas);
        $query=$this->db->get('view_kelas_siswa');
        return $query;
      }

      function insert_kelas_siswa($kirimdata){
        $query = $this->db->insert('tbl_kelas_siswa', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function update_kelas_siswa($kirimdata, $id_kelas_siswa){
        $this->db->where('id_kelas_siswa', $id_kelas_siswa);
        $query = $this->db->update('tbl_kelas_siswa', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      //Jadwal
      function get_all_jadwal(){
        $query=$this->db->get('view_jadwal');
        return $query;
      }

      function get_all_jadwalBy($id_mapel){
        $this->db->where('aktif_state', '1');
        $this->db->where('mapelID', $id_mapel);
        $query=$this->db->get('view_jadwal');
        return $query;
      }

      function insert_jadwal($kirimdata){
        $query = $this->db->insert('tbl_jadwal', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function ubah_jadwal($id_jadwal){
        $this->db->where('id_jadwal', $id_jadwal);
        $query=$this->db->get('tbl_jadwal');
        return $query;
      }

      function update_jadwal($kirimdata, $id_jadwal){
        $this->db->where('id_jadwal', $id_jadwal);
        $query = $this->db->update('tbl_jadwal', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function update_jadwalWhere_mapel($kirimdata, $id_mapel){
        $this->db->where('mapelID', $id_mapel);
        $query = $this->db->update('tbl_jadwal', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function hapus_jadwal($id_jadwal){
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->delete('tbl_jadwal');
      }

      //Hasil Ujian
      function get_all_hasil_ujian(){
        $query=$this->db->get('view_hasil_ujian');
        return $query;
      }

      function get_all_hasil_ujianBy($id_hasil){
        $this->db->where('id_hasil', $id_hasil);
        $query=$this->db->get('view_hasil_ujian');
        return $query;
      }

      function get_all_hasil_ujianBy2($id_mapel,$id_kelas,$id_login){
        $this->db->where('mapelID', $id_mapel);
        $this->db->where('kelasID', $id_kelas);
        $this->db->where('siswaID', $id_login);
        $query=$this->db->get('view_hasil_ujian');
        return $query;
      }

      function hapus_hasil_ujian($id_hasil){
        $this->db->where('id_hasil', $id_hasil);
        $this->db->delete('tbl_hasil_ujian');
      }

      function lihat_hasil_ujian($id_mapel,$id_kelas,$id_login){
        $this->db->where('mapelID', $id_mapel);
        $this->db->where('kelasID', $id_kelas);
        $this->db->where('loginID', $id_login);
        $query=$this->db->get('tbl_mengajar');
        return $query;
      }

      //Soal Ujian
        //Soal PG
        function get_all_soal_pg(){
          $query=$this->db->get('view_soal_pg');
          return $query;
        }

        function get_all_soal_pgBy($id_mengajar){
          $this->db->order_by('kode_soal','DESC'); // Order by
          $this->db->limit(1);
          $this->db->where('mengajarID', $id_mengajar);
          $query=$this->db->get('tbl_soal_ujian_pg');
          return $query;
        }

        function get_all_soal_pgBy2($id_mapel){
          $this->db->order_by('kode_soal','RANDOM');
          $this->db->limit(3);
          $this->db->where('mapelID', $id_mapel);
          $query=$this->db->get('view_soal_pg');
          return $query;
        }

        function insert_soal_pg($kirimdata){
          $query = $this->db->insert('tbl_soal_ujian_pg', $kirimdata);
          if($query){
              return true;
          }else{
              return false;
          }
        }

        function ubahordetail_soal_pg($id_soal){
          $this->db->where('id_soal', $id_soal);
          $query=$this->db->get('view_soal_pg');
          return $query;
        }

        function update_soal_pg($kirimdata, $id_soal){
          $this->db->where('id_soal', $id_soal);
          $query = $this->db->update('tbl_soal_ujian_pg', $kirimdata);
          if($query){
              return true;
          }else{
              return false;
          }
        }

        function hapus_soal_pg($id_soal){
          $this->db->where('id_soal', $id_soal);
          $this->db->delete('tbl_soal_ujian_pg');
        }

      //Mahasiswa
      function get_all_mahasiswa(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_biodata_user AS b ON a.id_user=b.id_user WHERE a.akses='1' OR a.akses='3' ORDER BY a.npm ASC");
        return $query;
      }

      function insert_mahasiswa($kirimdata){
        $query = $this->db->insert('tbl_user', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function insert_Lmahasiswa($kirimdata){
        $query = $this->db->insert('tbl_biodata_user', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function ubah_mahasiswa($id_user){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_biodata_user AS b ON a.id_user=b.id_user WHERE a.id_user='$id_user'");
        return $query;      
      }

      function update_mahasiswa($kirimdata, $id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_user', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function update_Lmahasiswa($kirimdata2, $id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_biodata_user', $kirimdata2);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function detail_mahasiswa($id_user){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_biodata_user AS b ON a.id_user=b.id_user WHERE a.id_user='$id_user'");
        return $query;      
      }

      function hapus_mahasiswa($id_user){
        $this->db->where('id_user', $id_user);
        $this->db->delete('tbl_user');
        
        $this->db->where('id_user', $id_user);
        $this->db->delete('tbl_biodata_user');
      }

      function get_kelas_matkulBy($id_user){
        $query=$this->db->query("SELECT * FROM tbl_kelas_matkul WHERE asdos_1='$id_user' or asdos_2='$id_user'");
        return $query;      
      }

      //Asisten Dosen
      function get_all_asdos(){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_biodata_user AS b ON a.id_user=b.id_user WHERE a.akses!='1' ORDER BY a.npm ASC");
        return $query;
      }

      function get_asdos(){
        $query=$this->db->query("SELECT * FROM tbl_user WHERE status='1' && akses!='1' ORDER BY npm ASC");
        return $query;
      }

      function get_asdos1_iduser($id_user){
        $query=$this->db->query("SELECT * FROM tbl_user WHERE id_user='$id_user'");
        return $query;
      }

      function get_asdos2_iduser($id_user){
        $query=$this->db->query("SELECT * FROM tbl_user WHERE id_user='$id_user'");
        return $query;
      }

      function insert_asdos($kirimdata){
        $query = $this->db->insert('tbl_user', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function insert_Lasdos($kirimdata){
        $query = $this->db->insert('tbl_biodata_user', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function ubah_asdos($id_user){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_biodata_user AS b ON a.id_user=b.id_user WHERE a.id_user='$id_user'");
        return $query;      
      }

      function update_asdos($kirimdata, $id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_user', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function update_Lasdos($kirimdata2, $id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_biodata_user', $kirimdata2);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function detail_asdos($id_user){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_biodata_user AS b ON a.id_user=b.id_user WHERE a.id_user='$id_user'");
        return $query;      
      }

      function hapus_asdos($id_user){
        $this->db->where('id_user', $id_user);
        $this->db->delete('tbl_user');
        
        $this->db->where('id_user', $id_user);
        $this->db->delete('tbl_biodata_user');
      }

      //Mata Kuliah
      function get_all_matkul(){
        $query=$this->db->query("SELECT * FROM tbl_matkul ORDER BY semester,id_matkul ASC");
        return $query;
      }

      function get_matkul(){
        $query=$this->db->query("SELECT * FROM tbl_matkul WHERE status='1' ORDER BY matkul ASC");
        return $query;
      }

      function insert_matkul($kirimdata){
        $query = $this->db->insert('tbl_matkul', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function ubah_matkul($id_matkul){
        $query=$this->db->query("SELECT * FROM tbl_matkul WHERE id_matkul='$id_matkul'");
        return $query;      
      }

      function update_matkul($kirimdata, $id_matkul){
        $this->db->where('id_matkul', $id_matkul);
        $query = $this->db->update('tbl_matkul', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function detail_matkul($id_matkul){
        $query=$this->db->query("SELECT * FROM tbl_matkul WHERE id_matkul='$id_matkul'");
        return $query;      
      }

      function hapus_matkul($id_matkul){
        $this->db->where('id_matkul', $id_matkul);
        $this->db->delete('tbl_matkul');
      }

      function insert_kelas_mhs($kirimdata){
        $query = $this->db->insert('tbl_kelas_mhs', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function update_kelas_mhs($kirimdata, $id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_kelas_mhs', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function hapus_absensi_mhs($id_user){
        $this->db->where('id_user', $id_user);
        $this->db->delete('tbl_absensi_mhs');
      }

      function hapus_nilai_mhs($id_user){
        $this->db->where('id_user', $id_user);
        $this->db->delete('tbl_nilai_mhs');
      }

      function get_kelas_mhs($id_user){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_kelas_mhs AS b ON a.id_user=b.id_user WHERE a.id_user='$id_user'");
        return $query;      
      }

      //Kelas Mata Kuliah
      function get_kelas_matkul($kode){
        $query=$this->db->query("SELECT * FROM tbl_kelas_matkul WHERE kode='$kode'");
        return $query;
      }

      function get_kelas_matkulBYKODE($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_matkul AS a INNER JOIN tbl_matkul AS b ON a.id_matkul=b.id_matkul WHERE a.kode='$kode'");
        return $query;
      }

      function get_all_kelas_matkul(){
        $query=$this->db->query("SELECT * FROM tbl_kelas_matkul ORDER BY kelas ASC");
        return $query;
      }

      function insert_kelas_matkul($kirimdata){
        $query = $this->db->insert('tbl_kelas_matkul', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function ubah_kelas_matkul($id_kelas_matkul){
        $query=$this->db->query("SELECT * FROM tbl_kelas_matkul WHERE id_kelas_matkul='$id_kelas_matkul'");
        return $query;      
      }

      function update_kelas_matkul($kirimdata, $id_kelas_matkul){
        $this->db->where('id_kelas_matkul', $id_kelas_matkul);
        $query = $this->db->update('tbl_kelas_matkul', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function detail_kelas_matkul($id_kelas_matkul){
        $query=$this->db->query("SELECT * FROM tbl_kelas_matkul WHERE id_kelas_matkul='$id_kelas_matkul'");
        return $query;      
      }
      
      function hapus_kelas_matkul($id_kelas_matkul){
        $this->db->where('id_kelas_matkul', $id_kelas_matkul);
        $this->db->delete('tbl_kelas_matkul');
      }

      //Kelas Mata Kuliah Mahasiswa
      function get_all_kelas_mhs_reguler(){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE b.jenis='1' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_kelas_mhs_malam(){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE b.jenis='2' ORDER BY b.npm ASC");
        return $query;
      }

      //Persentase Nilai
      function get_all_persentase_nilai(){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_persentase_nilai AS a INNER JOIN tbl_matkul AS b ON a.id_matkul=b.id_matkul ORDER BY a.id_matkul ASC");
        return $query;
      }

      function ubah_persentase_nilai($id_persentase){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_persentase_nilai AS a INNER JOIN tbl_matkul AS b ON a.id_matkul=b.id_matkul WHERE a.id_persentase='$id_persentase'");
        return $query;
      }

      function get_persentase_nilaiBY($id_matkul){
        $query=$this->db->query("SELECT * FROM tbl_persentase_nilai WHERE id_matkul='$id_matkul'");
        return $query;
      }

      function update_persentase_nilai($kirimdata, $id_persentase){
        $this->db->where('id_persentase', $id_persentase);
        $query = $this->db->update('tbl_persentase_nilai', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      //Qrcode
      function get_all_qrcode(){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_qrcode AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_kelas_matkul=b.id_kelas_matkul ORDER BY a.id_kelas_matkul ASC");
        return $query;
      }

      function get_all_qrcodeBY($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_qrcode AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_kelas_matkul=b.id_kelas_matkul WHERE a.kode='$kode'");
        return $query;
      }

      function get_all_qrcodeBY2($id_qrcode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_qrcode AS a INNER JOIN tbl_kelas_matkul AS b ON a.id_kelas_matkul=b.id_kelas_matkul WHERE a.id_qrcode='$id_qrcode'");
        return $query;
      }

      function get_kelas_matkulBY2($id_matkul){
        $query=$this->db->query("SELECT * FROM tbl_kelas_matkul WHERE id_matkul='$id_matkul' ORDER BY kelas ASC");
        return $query;      
      }

      function insert_qrcode($kirimdata){
        $query = $this->db->insert('tbl_qrcode', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function hapus_qrcode($id_qrcode){
        $this->db->where('id_qrcode', $id_qrcode);
        $this->db->delete('tbl_qrcode');
      }

      //Qrcode
      function get_all_session_akun(){
        $query=$this->db->query("SELECT * FROM tbl_session ORDER BY Waktu DESC");
        return $query;
      }

      function hapus_session_akun($ip_address){
        $this->db->where('ip_address', $ip_address);
        $this->db->delete('tbl_session');
      }

      //Absen
      function get_all_data_mhs_si($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.sistem_instrumentasi='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_orkom($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.organisasi_komputer='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_elektronika($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.elektronika='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_sigit1($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.sistem_digital_1='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_jarkom($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.jaringan_komputer='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_sigit2($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.sistem_digital_2='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_iot($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.otomasi='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_adminjar($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.administrasi_jaringan='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_sismik($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.sistem_mikroprosesor='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_spm($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.sistem_pemrograman_mikroprosesor='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_mobile($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.mobile_programing='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_python($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.pemrograman_python='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_kejar($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.keamanan_jaringan='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_sim($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.sistem_interface_mikrokontroler='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs_robotik($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.robotik='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function get_all_data_mhs($kode){
        $query=$this->db->query("SELECT a.*,b.* FROM tbl_kelas_mhs AS a INNER JOIN tbl_user AS b ON a.id_user=b.id_user WHERE a.sistem_instrumentasi='$kode' OR a.organisasi_komputer='$kode' OR a.elektronika='$kode' OR a.sistem_digital_1='$kode' OR a.jaringan_komputer='$kode' OR a.sistem_digital_2='$kode' OR a.sistem_mikroprosesor='$kode' OR a.otomasi='$kode' OR a.administrasi_jaringan='$kode' OR a.sistem_pemrograman_mikroprosesor='$kode' OR a.mobile_programing='$kode' OR a.keamanan_jaringan='$kode' OR a.pemrograman_python='$kode' OR a.sistem_interface_mikrokontroler='$kode' OR a.robotik='$kode' ORDER BY b.npm ASC");
        return $query;
      }

      function insert_absensi_mhs($kirimdata){
        $query = $this->db->insert('tbl_absensi_mhs', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function insert_nilai_mhs($kirimdata){
        $query = $this->db->insert('tbl_nilai_mhs', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function get_all_absen_mhs($id_kelas_matkul,$kode){
        $query=$this->db->query("SELECT a.*,b.*,c.*,d.* FROM tbl_kelas_matkul AS a INNER JOIN tbl_absensi_mhs AS b ON a.id_kelas_matkul=b.id_kelas_matkul INNER JOIN tbl_user AS c ON c.id_user=b.id_user INNER JOIN tbl_kelas_mhs AS d ON d.id_user=b.id_user WHERE a.id_kelas_matkul='$id_kelas_matkul' AND (d.sistem_instrumentasi='$kode' OR d.organisasi_komputer='$kode' OR d.elektronika='$kode' OR d.sistem_digital_1='$kode' OR d.jaringan_komputer='$kode' OR d.sistem_digital_2='$kode' OR d.sistem_mikroprosesor='$kode' OR d.otomasi='$kode' OR d.administrasi_jaringan='$kode' OR d.sistem_pemrograman_mikroprosesor='$kode' OR d.mobile_programing='$kode' OR d.keamanan_jaringan='$kode' OR d.pemrograman_python='$kode' OR d.sistem_interface_mikrokontroler='$kode' OR d.robotik='$kode') ORDER BY c.npm ASC");
        return $query;
      }

      function get_all_absen_mhsBY($id_kelas_matkul,$id_user){
        $query=$this->db->query("SELECT a.*,b.*,c.* FROM tbl_kelas_matkul AS a INNER JOIN tbl_absensi_mhs AS b ON a.id_kelas_matkul=b.id_kelas_matkul INNER JOIN tbl_user AS c ON c.id_user=b.id_user WHERE a.id_kelas_matkul='$id_kelas_matkul' && b.id_user='$id_user' ORDER BY c.npm ASC");
        return $query;
      }

      function get_all_nilai_mhs($id_kelas_matkul,$kode){
        $query=$this->db->query("SELECT a.*,b.*,c.*,d.* FROM tbl_kelas_matkul AS a INNER JOIN tbl_nilai_mhs AS b ON a.id_kelas_matkul=b.id_kelas_matkul INNER JOIN tbl_user AS c ON c.id_user=b.id_user INNER JOIN tbl_kelas_mhs AS d ON d.id_user=b.id_user WHERE a.id_kelas_matkul='$id_kelas_matkul' AND (d.sistem_instrumentasi='$kode' OR d.organisasi_komputer='$kode' OR d.elektronika='$kode' OR d.sistem_digital_1='$kode' OR d.jaringan_komputer='$kode' OR d.sistem_digital_2='$kode' OR d.sistem_mikroprosesor='$kode' OR d.otomasi='$kode' OR d.administrasi_jaringan='$kode' OR d.sistem_pemrograman_mikroprosesor='$kode' OR d.mobile_programing='$kode' OR d.keamanan_jaringan='$kode' OR d.pemrograman_python='$kode' OR d.sistem_interface_mikrokontroler='$kode' OR d.robotik='$kode') ORDER BY c.npm ASC");
        return $query;
      }

      function get_all_nilai_mhsBY($id_kelas_matkul,$id_user){
        $query=$this->db->query("SELECT a.*,b.*,c.* FROM tbl_kelas_matkul AS a INNER JOIN tbl_nilai_mhs AS b ON a.id_kelas_matkul=b.id_kelas_matkul INNER JOIN tbl_user AS c ON c.id_user=b.id_user WHERE a.id_kelas_matkul='$id_kelas_matkul' && b.id_user='$id_user' ORDER BY c.npm ASC");
        return $query;
      }

      function ubah_absen_mhs($id_user,$id_kelas_matkul){
        $query=$this->db->query("SELECT a.*,b.*,c.* FROM tbl_kelas_matkul AS a INNER JOIN tbl_absensi_mhs AS b ON a.id_kelas_matkul=b.id_kelas_matkul INNER JOIN tbl_user AS c ON c.id_user=b.id_user WHERE c.id_user='$id_user' && a.id_kelas_matkul='$id_kelas_matkul' ORDER BY c.npm ASC");
        return $query;
      }

      function update_absensi($kirimdata,$id_kelas_matkul,$id_user){
        $this->db->where('id_kelas_matkul', $id_kelas_matkul);
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_absensi_mhs', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function ubah_nilai_mhs($id_user,$id_kelas_matkul){
        $query=$this->db->query("SELECT a.*,b.*,c.* FROM tbl_kelas_matkul AS a INNER JOIN tbl_nilai_mhs AS b ON a.id_kelas_matkul=b.id_kelas_matkul INNER JOIN tbl_user AS c ON c.id_user=b.id_user WHERE c.id_user='$id_user' && a.id_kelas_matkul='$id_kelas_matkul' ORDER BY c.npm ASC");
        return $query;
      }

      function update_nilai($kirimdata,$id_kelas_matkul,$id_user){
        $this->db->where('id_kelas_matkul', $id_kelas_matkul);
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_nilai_mhs', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      //User
      function ubah_user($id_user){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_biodata_user AS b ON a.id_user=b.id_user WHERE a.id_user='$id_user'");
        return $query;      
      }  

      function detail_user($id_user){
        $query=$this->db->query("SELECT a.*, b.* FROM tbl_user AS a INNER JOIN tbl_biodata_user AS b ON a.id_user=b.id_user WHERE a.id_user='$id_user'");
        return $query;      
      }

      function kelas_matkul_userBY($id_user){
        $query=$this->db->query("SELECT * FROM tbl_kelas_mhs WHERE id_user='$id_user'");
        return $query;      
      }

      function update_profiltampildata_user($kirimdata, $id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_biodata_user', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function update_user($kirimdata, $id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_user', $kirimdata);
        if($query){
            return true;
        }else{
            return false;
        }
      }

      function update_Luser($kirimdata2, $id_user){
        $this->db->where('id_user', $id_user);
        $query = $this->db->update('tbl_biodata_user', $kirimdata2);
        if($query){
            return true;
        }else{
            return false;
        }
      }
}