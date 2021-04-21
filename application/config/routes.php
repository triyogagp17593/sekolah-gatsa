<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Login
$route['login'] = 'LoginDashboard/login';
$route['lupapass'] = 'LoginDashboard/lupapass';
$route['auth'] = 'LoginDashboard/auth';
$route['logout'] = 'LoginDashboard/logout';

//Dashboard
$route['dashboard'] = 'Main';
$route['profile'] = 'Main/profile';
$route['tampildata/(:num)/(:num)'] = 'Main/tampildata/$1/$2';
$route['ubah_profil/(:num)'] = 'Main/ubah_profil/$1';
$route['ambil_kelas/(:num)'] = 'Main/ambil_kelas/$1';
$route['update_profil'] = 'Main/update_profil';
$route['ambilorupdate_ambil_kelas/(:num)'] = 'Main/ambilorupdate_ambil_kelas/$1';
$route['hapusgambar/(:num)'] = 'Main/hapusgambar/$1';
$route['no_nilai'] = 'Main/no_nilai';

//UJIAN
$route['peraturan/(:num)/(:num)/(:num)/(:num)'] = 'Main/peraturan/$1/$2/$3/$4';
$route['kerjakan_ujian/(:num)/(:num)/(:num)/(:num)'] = 'Main/kerjakan_ujian/$1/$2/$3/$4';
$route['penilaian'] = 'Main/penilaian';

	//tabel administrator
	$route['v_administrator'] = 'Main/v_administrator';
	$route['add_administrator'] = 'Main/add_administrator';
	$route['save_administrator'] = 'Main/save_administrator';
	$route['edit_administrator/(:num)'] = 'Main/edit_administrator/$1';
	$route['update_administrator'] = 'Main/update_administrator';
	$route['detail_administrator/(:num)'] = 'Main/detail_administrator/$1';
	$route['delete_administrator/(:num)'] = 'Main/delete_administrator/$1';
	$route['delete_administrator_all'] = 'Main/delete_administrator_all';
	//tabel siswa
	$route['v_siswa'] = 'Main/v_siswa';
	$route['add_siswa'] = 'Main/add_siswa';
	$route['save_siswa'] = 'Main/save_siswa';
	$route['edit_siswa/(:num)'] = 'Main/edit_siswa/$1';
	$route['update_siswa'] = 'Main/update_siswa';
	$route['detail_siswa/(:num)'] = 'Main/detail_siswa/$1';
	$route['delete_siswa/(:num)'] = 'Main/delete_siswa/$1';
	$route['delete_siswa_all'] = 'Main/delete_siswa_all';
	$route['import_siswa'] = 'Main/import_siswa';
	$route['ambil_kelas_siswa/(:num)'] = 'Main/ambil_kelas_siswa/$1';
	$route['lihat_nilai/(:num)/(:num)/(:num)/(:num)'] = 'Main/lihat_nilai/$1/$2/$3/$4';
	//tabel guru
	$route['v_guru'] = 'Main/v_guru';
	$route['data_guru'] = 'Main/data_guru';
	$route['add_guru'] = 'Main/add_guru';
	$route['save_guru'] = 'Main/save_guru';
	$route['edit_guru/(:num)'] = 'Main/edit_guru/$1';
	$route['update_guru'] = 'Main/update_guru';
	$route['detail_guru/(:num)'] = 'Main/detail_guru/$1';
	$route['delete_guru/(:num)'] = 'Main/delete_guru/$1';
	$route['delete_guru_all'] = 'Main/delete_guru_all';
	$route['import_guru'] = 'Main/import_guru';
	$route['ambil_mengajar_guru/(:num)'] = 'Main/ambil_mengajar_guru/$1';
	$route['ambil_ajar_kelas'] = 'Main/ambil_ajar_kelas';
	//tabel kelas
	$route['v_kelas'] = 'Main/v_kelas';
	$route['add_kelas'] = 'Main/add_kelas';
	$route['save_kelas'] = 'Main/save_kelas';
	$route['edit_kelas/(:num)'] = 'Main/edit_kelas/$1';
	$route['update_kelas'] = 'Main/update_kelas';
	$route['delete_kelas/(:num)'] = 'Main/delete_kelas/$1';
	$route['delete_kelas_all'] = 'Main/delete_kelas_all';
	//tabel mapel
	$route['v_mapel'] = 'Main/v_mapel';
	$route['add_mapel'] = 'Main/add_mapel';
	$route['save_mapel'] = 'Main/save_mapel';
	$route['edit_mapel/(:num)'] = 'Main/edit_mapel/$1';
	$route['update_mapel'] = 'Main/update_mapel';
	$route['delete_mapel/(:num)'] = 'Main/delete_mapel/$1';
	$route['delete_mapel_all'] = 'Main/delete_mapel_all';
	//tabel sk mengajar
	$route['v_sk_mengajar'] = 'Main/v_sk_mengajar';
	$route['add_sk_mengajar'] = 'Main/add_sk_mengajar';
	$route['save_sk_mengajar'] = 'Main/save_sk_mengajar';
	$route['edit_sk_mengajar/(:num)'] = 'Main/edit_sk_mengajar/$1';
	$route['update_sk_mengajar'] = 'Main/update_sk_mengajar';
	$route['delete_sk_mengajar/(:num)'] = 'Main/delete_sk_mengajar/$1';
	$route['delete_sk_mengajar_all'] = 'Main/delete_sk_mengajar_all';
	//tabel soal pg
	$route['v_soal_pg'] = 'Main/v_soal_pg';
	$route['add_soal_pg'] = 'Main/add_soal_pg';
	$route['save_soal_pg'] = 'Main/save_soal_pg';
	$route['edit_soal_pg/(:num)'] = 'Main/edit_soal_pg/$1';
	$route['update_soal_pg'] = 'Main/update_soal_pg';
	$route['detail_soal_pg/(:num)'] = 'Main/detail_soal_pg/$1';
	$route['delete_soal_pg/(:num)'] = 'Main/delete_soal_pg/$1';
	$route['delete_soal_pg_all'] = 'Main/delete_soal_pg_all';
	//tabel soal essay
	$route['v_soal_essay'] = 'Main/v_soal_essay';
	$route['add_soal_essay'] = 'Main/add_soal_essay';
	$route['save_soal_essay'] = 'Main/save_soal_essay';
	$route['edit_soal_essay/(:num)'] = 'Main/edit_soal_essay/$1';
	$route['update_soal_essay'] = 'Main/update_soal_essay';
	$route['detail_soal_essay/(:num)'] = 'Main/detail_soal_essay/$1';
	$route['delete_soal_essay/(:num)'] = 'Main/delete_soal_essay/$1';
	$route['delete_soal_essay_all'] = 'Main/delete_soal_essay_all';
	//tabel jadwal ujian
	$route['v_jadwal'] = 'Main/v_jadwal';
	$route['add_jadwal'] = 'Main/add_jadwal';
	$route['save_jadwal'] = 'Main/save_jadwal';
	$route['edit_jadwal/(:num)'] = 'Main/edit_jadwal/$1';
	$route['update_jadwal'] = 'Main/update_jadwal';
	$route['detail_jadwal/(:num)'] = 'Main/detail_jadwal/$1';
	$route['delete_jadwal/(:num)'] = 'Main/delete_jadwal/$1';
	$route['delete_jadwal_all'] = 'Main/delete_jadwal_all';
	$route['import_jadwal'] = 'Main/import_jadwal';
	//tabel hasil ujian
	$route['v_hasil_ujian'] = 'Main/v_hasil_ujian';
	$route['detail_hasil_ujian/(:num)'] = 'Main/detail_hasil_ujian/$1';
	$route['lihat_hasil_ujian/(:num)/(:num)/(:num)'] = 'Main/lihat_hasil_ujian/$1/$2/$3';
	$route['delete_hasil_ujian/(:num)'] = 'Main/delete_hasil_ujian/$1';
	$route['delete_hasil_ujian_all'] = 'Main/delete_hasil_ujian_all';
	$route['delete_nilai/(:num)(:num)(:num)(:num)'] = 'Main/delete_nilai/$1/$2/$3/$4';
	$route['delete_nilai_all'] = 'Main/delete_nilai_all';


	//tabel mahasiswa
	$route['v_mahasiswa'] = 'Main/v_mahasiswa';
	$route['add_mahasiswa'] = 'Main/add_mahasiswa';
	$route['save_mahasiswa'] = 'Main/save_mahasiswa';
	$route['edit_mahasiswa/(:num)'] = 'Main/edit_mahasiswa/$1';
	$route['update_mahasiswa'] = 'Main/update_mahasiswa';
	$route['detail_mahasiswa/(:num)'] = 'Main/detail_mahasiswa/$1';
	$route['delete_mahasiswa/(:num)'] = 'Main/delete_mahasiswa/$1';
	$route['delete_mahasiswa_all'] = 'Main/delete_mahasiswa_all';
	//tabel asdos
	$route['v_asdos'] = 'Main/v_asdos';
	$route['add_asdos'] = 'Main/add_asdos';
	$route['save_asdos'] = 'Main/save_asdos';
	$route['edit_asdos/(:num)'] = 'Main/edit_asdos/$1';
	$route['update_asdos'] = 'Main/update_asdos';
	$route['detail_asdos/(:num)'] = 'Main/detail_asdos/$1';
	$route['delete_asdos/(:num)'] = 'Main/delete_asdos/$1';
	$route['delete_asdos_all'] = 'Main/delete_asdos_all';
	//tabel matkul
	$route['v_matkul'] = 'Main/v_matkul';
	$route['add_matkul'] = 'Main/add_matkul';
	$route['save_matkul'] = 'Main/save_matkul';
	$route['edit_matkul/(:num)'] = 'Main/edit_matkul/$1';
	$route['update_matkul'] = 'Main/update_matkul';
	$route['detail_matkul/(:num)'] = 'Main/detail_matkul/$1';
	$route['delete_matkul/(:num)'] = 'Main/delete_matkul/$1';
	$route['delete_matkul_all'] = 'Main/delete_matkul_all';
	$route['ambil_matkul_mahasiswa/(:num)'] = 'Main/ambil_matkul_mahasiswa/$1';
	$route['save_ambil_matkul'] = 'Main/save_ambil_matkul';
	//tabel kelas matkul
	$route['v_kelas_matkul'] = 'Main/v_kelas_matkul';
	$route['add_kelas_matkul'] = 'Main/add_kelas_matkul';
	$route['save_kelas_matkul'] = 'Main/save_kelas_matkul';
	$route['edit_kelas_matkul/(:num)'] = 'Main/edit_kelas_matkul/$1';
	$route['update_kelas_matkul'] = 'Main/update_kelas_matkul';
	$route['detail_kelas_matkul/(:num)'] = 'Main/detail_kelas_matkul/$1';
	$route['delete_kelas_matkul/(:num)'] = 'Main/delete_kelas_matkul/$1';
	$route['delete_kelas_matkul_all'] = 'Main/delete_kelas_matkul_all';
	//tabel kelas mhs
	$route['v_kelas_mhs'] = 'Main/v_kelas_mhs';
	$route['add_kelas_mhs'] = 'Main/add_kelas_mhs';
	$route['save_kelas_mhs'] = 'Main/save_kelas_mhs';
	$route['edit_kelas_mhs/(:num)'] = 'Main/edit_kelas_mhs/$1';
	$route['update_kelas_mhs'] = 'Main/update_kelas_mhs';
	$route['detail_kelas_mhs/(:num)'] = 'Main/detail_kelas_mhs/$1';
	$route['delete_kelas_mhs/(:num)'] = 'Main/delete_kelas_mhs/$1';
	$route['delete_kelas_mhs_all'] = 'Main/delete_kelas_mhs_all';
	//tabel persentase
	$route['v_persentase_nilai'] = 'Main/v_persentase_nilai';
	$route['edit_persentase_nilai/(:num)'] = 'Main/edit_persentase_nilai/$1';
	$route['update_persentase_nilai'] = 'Main/update_persentase_nilai';
	//tabel qrcode
	$route['v_qrcode'] = 'Main/v_qrcode';
	$route['add_qrcode'] = 'Main/add_qrcode';
	$route['save_qrcode'] = 'Main/save_qrcode';
	$route['detail_qrcode/(:any)'] = 'Main/detail_qrcode/$1';
	$route['delete_qrcode_all'] = 'Main/delete_qrcode_all';
	//tabel session
	$route['v_session_akun'] = 'Main/v_session_akun';
	$route['delete_session_akun_all'] = 'Main/delete_session_akun_all';

	//tabel proses absen
	$route['v_absensi'] = 'Main/v_absensi';
	$route['absen_kelas_matkul/(:num)'] = 'Main/absen_kelas_matkul/$1';
	$route['absen_kelas/(:num)/(:any)'] = 'Main/absen_kelas/$1/$2';
	$route['edit_absen/(:num)/(:num)'] = 'Main/edit_absen/$1/$2';
	$route['update_absensi'] = 'Main/update_absensi';
	//tabel proses absen
	$route['v_penilaian'] = 'Main/v_penilaian';
	$route['nilai_kelas_matkul/(:num)'] = 'Main/nilai_kelas_matkul/$1';
	$route['nilai_kelas/(:num)/(:any)'] = 'Main/nilai_kelas/$1/$2';
	$route['edit_nilai/(:num)/(:num)'] = 'Main/edit_nilai/$1/$2';
	$route['update_penilaian'] = 'Main/update_penilaian';

$route['default_controller'] = 'LoginDashboard/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
