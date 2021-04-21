var base_url = "http://localhost/gatsa/";

//Sweet Alert
$('.logout').on('click', function(e){
  e.preventDefault();
  const href = $(this).attr('href');

  Swal.fire({
    title: 'Apakah anda yakin ingin keluar ?',
    text: 'Keluar Dari Dashboard',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Keluar',
    cancelButtonText: 'Tidak'
  }).then((result) => {
    if (result.value) {
      Swal.fire(
        'Keluar',
        'Selamat Tinggal',
        'success'
      )
      document.location.href = href;
    }
  });
});

$('a#hapus').on('click', function(e){
  e.preventDefault();
  const href = $(this).attr('href');

  Swal.fire({
    title: 'Apakah anda yakin ingin menghapus data ini ?',
    text: '',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Tidak'
  }).then((result) => {
    if (result.value) {
      Swal.fire(
        'Pemberitahuan',
        'Data Berhasil DiHapus !!! Terimakasih ..',
        'success'
      )
      document.location.href = href;
    }
  });
});

//----------------------------------------------------------------------------------------------//

//Modal 
$(document).ready(function(){
  $('#adminprofile').click(function(){
    var url = $(this).attr('href');
    $.ajax({
      url : url,
      success:function(response){
        $('#modal_admin').html(response);
      }
    });
  });
});

$(document).ready(function(){
  $('#userprofile').click(function(){
    var url = $(this).attr('href');
    $.ajax({
      url : url,
      success:function(response){
        $('#modal_user').html(response);
      }
    });
  });
});

$(document).ready(function(){
  $('#ambilKelas').click(function(){
    var url = $(this).attr('href');
    $.ajax({
      url : url,
      success:function(response){
        $('#modal_ambil_kelas').html(response);
      }
    });
  });
});

$(document).ready(function(){
  $('#ajarKelas').click(function(){
    var url = $(this).attr('href');
    $.ajax({
      url : url,
      success:function(response){
        $('#modal_ambil_Ajarkelas').html(response);
      }
    });
  });
});
//----------------------------------------------------------------------------------------------//

  //Administrator, Siswa, Guru
  $(document).ready(function(){
    $('a#ubah_admin').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_admin').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#detail_admin').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_admin').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#ambil_kelas').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_ambil_kelas').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#ambil_mengajar').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_ambil_mengajar').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#lihatnilai').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_nilai').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#detail_hasil_ujian').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_hasil_ujian').html(response);
        }
      });
    });
  });

  //Kelas
  $(document).ready(function(){
    $('a#ubah_kelas').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_kelas').html(response);
        }
      });
    });
  });

  //Mapel
  $(document).ready(function(){
    $('a#ubah_mapel').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_mapel').html(response);
        }
      });
    });
  });

  //SK Mengajar
  $(document).ready(function(){
    $('a#ubah_sk_mengajar').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_sk_mengajar').html(response);
        }
      });
    });
  });

  //Soal PG
  $(document).ready(function(){
    $('a#detail_soalPG').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_soalPG').html(response);
        }
      });
    });
  });

  //Jadwal
  $(document).ready(function(){
    $('a#ubah_jadwal').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_jadwal').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

  //Mahasiswa
  $(document).ready(function(){
    $('a#ubah_mahasiswa').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_mahasiswa').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#detail_mahasiswa').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_mahasiswa').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#ambil_matkul').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_ambil_matkul').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

  //Asisten Dosen
  $(document).ready(function(){
    $('a#ubah_asdos').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_asdos').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#detail_asdos').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_asdos').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

  //Mata Kuliah
  $(document).ready(function(){
    $('a#ubah_matakul').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_matakul').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#detail_matakul').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_matakul').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

  //Kelas Mata Kuliah
  $(document).ready(function(){
    $('a#ubah_kelas_matkul').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_kelas_matkul').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#detail_kelas_matkul').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_kelas_matkul').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//
  
  //Persentase Nilai
  $(document).ready(function(){
    $('a#ubah_persentase').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_persentase').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

  //Persentase Nilai
  $(document).ready(function(){
    $('a#detail_qrcode').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_detail_qrcode').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

  //Absensi
  $(document).ready(function(){
    $('a#ubah_absen').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_absen').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

  //Nilai
  $(document).ready(function(){
    $('a#ubah_nilai').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_nilai').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

  //Absensi & Nilai User
  $(document).ready(function(){
    $('a#ubah_absen_user').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_absen_user').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#ubah_nilai_user').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_edit_nilai_user').html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('a#ambilmatkuluser').click(function(){
      var url = $(this).attr('href');
      $.ajax({
        url : url,
        success:function(response){
          $('#modal_ambil_matkul_user').html(response);
        }
      });
    });
  });
//----------------------------------------------------------------------------------------------//

//Tambahan Javascript
  function toggle(next) { 
    checkboxes = document.getElementsByName('pilih[]'); 
    for(var i=0, n=checkboxes.length;i<n;i++) { 
        checkboxes[i].checked = next.checked; 
    } 
  }  

  $('.inputTgl').datetimepicker({
    format: 'DD-MM-YYYY',
  });

  $('.inputTMT').datetimepicker({
    format: 'DD-MM-YYYY',
  });

  $('.inputTglLulus').datetimepicker({
    format: 'DD-MM-YYYY',
  });

  $('#inputMulai').datetimepicker({
    format: 'DD-MM-YYYY HH:mm'
  });

  $('#inputSelesai').datetimepicker({
    format: 'DD-MM-YYYY HH:mm'
  });

  function validAngkatelp(a){
    if(!/^[0-9.]+$/.test(a.value))
    {
    a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  function passToggle(){
    var pass = document.getElementById('inputPassword');
    var showbtn = document.getElementById('show');
    if(pass.type == 'password'){
      pass.type = 'text';
      showbtn.innerHTML = '<span class="fa fa-eye-slash"></span>';
    }else{
      pass.type = 'password';
      showbtn.innerHTML = '<span class="fa fa-eye"></span>'; 
    }
  }

  function myFunction() {
    var data = document.getElementById("akses");
    var x = document.getElementById("asdos");
    var y = document.getElementById("alumni");
    if(data.value == '2'){
      x.style.display = "block";
      y.style.display = "none";
    }else if(data.value == '4'){
      x.style.display = "none";
      y.style.display = "block";
    }else if(data.value == '0'){
      x.style.display = "none";
      y.style.display = "none";
    }
  }

  function myFunction1() {
    var data1 = document.getElementById("level");
    var p = document.getElementById("asd");
    var q = document.getElementById("almn");
    if(data1.value == '2'){
      p.style.display = "block";
      q.style.display = "none";
    }else if(data1.value == '4'){
      p.style.display = "none";
      q.style.display = "block";
    }else if(data1.value == '0'){
      p.style.display = "none";
      q.style.display = "none";
    }
    console.log(data1.value);
  }

  function MySemester() {
    var datasemester = document.getElementById("semester");
    var ganjil = document.getElementById("ganjil");
    var genap = document.getElementById("genap");
    var tombol = document.getElementById("ambil-kelas");
    if(datasemester.value == '1'){
      ganjil.style.display = "block";
      genap.style.display = "none";
      tombol.disabled = false;
    }else if(datasemester.value == '2'){
      ganjil.style.display = "none";
      genap.style.display = "block";
      tombol.disabled = false;
    }else if(datasemester.value == '0'){
      ganjil.style.display = "none";
      genap.style.display = "none";
      tombol.disabled = true;
    }
    console.log(datasemester.value);
  }

  function tampil(status) {
    if(document.getElementById("lihat").checked == true){  
      document.getElementById("myfoto").disabled = status;  
    }else{
      document.getElementById("myfoto").disabled = status;
    }
    // var foto = document.getElementById('foto');
    var text = document.getElementById('text');
    if(status == true){
      text.innerHTML = 'Lihat';
      foto.disabled = true;
    }else{
      text.innerHTML = 'Sembunyi';
      foto.disabled = false;
    }
    console.log(status);
  }

  $("#inputGuru").change(function(){
    var id_login = $("#inputGuru").val();
    $.ajax({
      url : base_url + "Main/GetSKMengajar",
      method : "GET",
      data : {id_login:id_login},
      async : false,
      dataType : 'json',
      success: function(data){
          var html = '';
          var i;
          html += '<option value="" selected disabled>--- Mata Pelajaran Dan Kelas ---</option>';
          for(i=0; i<data.length; i++){
              html += '<option value='+data[i].id_mengajar+'>'+data[i].nama_mapel+" ("+data[i].romawi_kelas+"-"+data[i].angka_kelas+")"+'</option>';
          }
          $('#inputMapelKelas').html(html);
      }
    });
  });

  $("#inputMapelKelas").change(function(){
    var id_MapelKelas = $("#inputMapelKelas").val();
    $.ajax({
      url : base_url + "Main/GetKode",
      method : "GET",
      data : {id_MapelKelas:id_MapelKelas},
      async : false,
      dataType : 'json',
      success: function(data){
          var html = '';
          html = '<input id="inputKodesoal" class="form-control col-md-7 col-xs-12" name="inputKodesoal" value="'+data.kode_soal+'" type="text" required="required" readonly>';

          $('#kode').html(html);
      }
    });
  });

  $("#inputRomawi").change(function(){
    var romawi_kelas = $("#inputRomawi").val();
    $.ajax({
      url : base_url + "Main/GetKelas",
      method : "GET",
      data : {romawi_kelas:romawi_kelas},
      async : false,
      dataType : 'json',
      success: function(data){
          var html = '';
          var i;
          html += '<option value="" selected disabled>--- Pilih Angka Kelas ---</option>';
          for(i=0; i<data.length; i++){
              html += '<option value='+data[i].id_kelas+'>'+data[i].angka_kelas+'</option>';
          }
          $('#inputAngka').html(html);
      }
    });
  });
//----------------------------------------------------------------------------------------------//

//Ajax
  $(document).ready(function() {
    $('.onoffswitchKondisi').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Main/updateActived",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });

    $('.onoffswitchRole').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var roleID = 2;
      }
      else
      {
          var roleID = 1;
      }
      console.log(roleID);
      $.ajax({
        type: 'GET',
        url: base_url + "Main/updateActivedRole",
        data: {roleID: roleID, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });

    $('.onoffswitchKelas').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Main/updateActivedKelas",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });

    $('.onoffswitchMapel').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Main/updateActivedMapel",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });

    $('.onoffswitchSKMengajar').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Main/updateActivedMengajar",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });

    $('.onoffswitchSoalPG').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Main/updateActivedSoalPG",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          // $('.tampildata').load(base_url+'viewadmin');
        }
      });
    });

    $('.onoffswitchKondisiJadwal').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var aktif_state = 0;
      }
      else
      {
          var aktif_state = 1;
      }
      console.log(aktif_state);
      $.ajax({
        type: 'GET',
        url: base_url + "Main/updateActivedJadwal",
        data: {aktif_state: aktif_state, id: id},
        success: function (response) {
          console.log(response);
          location.reload();
          // $('.tampildata').load(base_url+'viewadmin');
          // $('#kondisiStatus').load(base_url+'Main/ambildataActivedJadwal/'+aktif_state);
        }
      });
    });

    $('.onoffswitchKondisiUjian').change(function () {
      var id = $(this).children(':hidden').val();
      if ($(this).children(':checked').length === 0)
      {
          var kondisi_ujian = 0;
      }
      else
      {
          var kondisi_ujian = 1;
      }
      console.log(kondisi_ujian);
      $.ajax({
        type: 'GET',
        url: base_url + "Main/updateActivedKondisiUjian",
        data: {kondisi_ujian: kondisi_ujian, id: id},
        success: function (response) {
          console.log(response);
          location.reload();
          // $('#kondisiUjian['+id+']').load(base_url+'Main/ambildataActivedKondisiUjian/'+kondisi_ujian+'/'+id);
        }
      });
    });
  });

//----------------------------------------------------------------------------------------------//

  //Datatables
  $(document).ready(function() {
    $('#datatable-responsive-genap').DataTable({
      responsive: {
          details: false
      }
    });
    
    $('#datatable-responsive-ganjil').DataTable({
      responsive: {
          details: false
      }
    });

    $('#datatable-responsive-genap-malam').DataTable({
      responsive: {
          details: false
      }
    });
    
    $('#datatable-responsive-ganjil-malam').DataTable({
      responsive: {
          details: false
      }
    });

    $('#datatable-responsive-absen').DataTable();
    $('#datatable-responsive-nilai').DataTable();
    $('#datatableALL').DataTable();
  });
//----------------------------------------------------------------------------------------------//
  
//----------------------------------------------------------------------------------------------//
