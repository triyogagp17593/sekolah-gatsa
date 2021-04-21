<?php
class Login_model extends CI_Model{

	function auth($username,$password){
		$query=$this->db->query("SELECT a.*,b.* FROM tbl_login AS a INNER JOIN tbl_pengguna AS b ON a.id_login=b.loginID WHERE a.password=MD5('$password') AND a.aktif_state='1' AND (a.username='$username' OR b.nomor_induk='$username') LIMIT 1");
		return $query;
	}

	// function select_session($username,$level){
	// 	$query=$this->db->query("SELECT * FROM tbl_session WHERE level='$level' AND username='$username' LIMIT 1");
	// 	return $query;
	// }

	// function select_session1($username){
	// 	$query=$this->db->query("SELECT * FROM tbl_session WHERE username='$username' LIMIT 1");
	// 	return $query;
	// }

	// function insert_session($kirimdata){
 //        $query = $this->db->insert('tbl_session', $kirimdata);
 //        if($query){
 //            return true;
 //        }else{
 //            return false;
 //        }
 //    }

 //    function hapus_session($username){
 //        $this->db->where('username', $username);
 //        $this->db->delete('tbl_session');
 //    }
}