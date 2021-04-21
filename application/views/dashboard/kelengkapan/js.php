<!-- jQuery -->
<script src="<?= base_url('assets/')?>vendors/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url('assets/')?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/')?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?= base_url('assets/')?>vendors/nprogress/nprogress.js"></script>
<!-- jQuery custom content scroller -->
<script src="<?= base_url('assets/')?>vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?= base_url('assets/')?>vendors/moment/min/moment.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="<?= base_url('assets/')?>vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<!-- Chart.js -->
<script src="<?= base_url('assets/')?>vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?= base_url('assets/')?>vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?= base_url('assets/')?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<!-- <script src="<?= base_url('assets/')?>vendors/iCheck/icheck.min.js"></script> -->
<!-- Skycons -->
<script src="<?= base_url('assets/')?>vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?= base_url('assets/')?>vendors/Flot/jquery.flot.js"></script>
<script src="<?= base_url('assets/')?>vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?= base_url('assets/')?>vendors/Flot/jquery.flot.time.js"></script>
<script src="<?= base_url('assets/')?>vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?= base_url('assets/')?>vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?= base_url('assets/')?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?= base_url('assets/')?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?= base_url('assets/')?>vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/')?>vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?= base_url('assets/')?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?= base_url('assets/')?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?= base_url('assets/')?>vendors/moment/min/moment.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Datatables -->
<script src="<?= base_url('assets/')?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?= base_url('assets/')?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url('assets/')?>vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- PNotify -->
<script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.js"></script>
<script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.buttons.js"></script>
<script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.nonblock.js"></script>

<!-- Switchery -->
<script src="<?= base_url('assets/')?>vendors/switchery/dist/switchery.min.js"></script>

<!-- tinymce -->
<script type="text/javascript" src="<?= base_url('assets/')?>vendors/tinymce/js/tinymce/tinymce.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?= base_url('assets/')?>build/js/custom.min.js"></script>
<!-- <script src="<?= base_url('assets/')?>jquery-1.11.1.min.js"></script> -->
<script src="<?= base_url('assets/')?>dist/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/')?>myscript.js"></script>
<!-- <script src="<?= base_url('assets/')?>alert.js"></script> -->

<script type="text/javascript">
  function passwordKekuatan(p){
    var status = document.getElementById('statusEdit');
    var regex = new Array();
    regex.push("[A-Z]");
    regex.push("[a-z]");
    regex.push("[0-9]");
   
    var passed = 0;
      for(var x = 0; x < regex.length;x++){
        if(new RegExp(regex[x]).test(p)){
          console.log(passed++);
        }
      }

    var strength = null;
    var color = null;

    switch(passed){
      case 0:
        strength = "<div style='font-size: 11px;'>#Status Kekuatan Password#</div>";
      break;
      case 1:
        strength = "Tidak Aman";
        color = "#FF3232";
      break;
      case 2:
        strength = "Cukup Aman";
        color = "#E1D441";
      break;
      case 3:
        strength = "Sangat Aman";
        color = "#27D644";
      break;
      case 4:
      break;
    }
    status.innerHTML = strength;
    status.style.color = color;
  }

	//Pnotify
  let flashData = $('.flash-data').data('dataflash');
  let validasi = $('.flash-data').data('validasi');
  console.log(flashData);
  console.log(validasi);
  if(flashData){
    new PNotify({
      title: 'Pemberitahuan !!!',
      text: flashData,
      type: validasi,
      delay: 2000,
      styling: 'bootstrap3'
    });
  }
</script>

<script type="text/javascript">
  // $(document).ready(function () {
  //   // ambil data kabupaten ketika data memilih provinsi
  //   $("#inputProvinsi").change(function (){
  //     var url = "<?php echo base_url('Main/add_ajax_kab');?>/"+$(this).val();
  //     console.log($(this).val());
  //     $('#inputKabKot').load(url);
  //     return false;
  //   });

  //   $("#inputKabKot").change(function (){
  //     var url = "<?php echo site_url('Main/add_ajax_kec');?>/"+$(this).val();
  //     $('#inputKec').load(url);
  //     return false;
  //   });

  //   $("#inputKec").change(function (){
  //     var url = "<?php echo site_url('Main/add_ajax_des');?>/"+$(this).val();
  //     $('#inputDesKel').load(url);
  //     return false;
  //   });

  //   $("#inputDesKel").change(function(){
  //     var kode = $("#inputDesKel").val();
  //     console.log(kode);
  //     $.ajax({
  //       url : base_url + "Main/GetKodePos",
  //       method : "GET",
  //       data : {kode:kode},
  //       async : false,
  //       dataType : 'json',
  //       success: function(data){
  //           var html = '';
  //           html = '<input id="inputKodePos" class="form-control col-md-7 col-xs-12" name="inputKodePos" value="'+data.kode_pos+'" type="text" readonly>';

  //           $('#kodepos').html(html);
  //       }
  //     });
  //   });
  // });
</script>

<script type="text/javascript">
  //pertanyaan
  tinymce.init({ 
    selector:'#inputPertanyaan',

    // ===========================================
      // INCLUDE THE PLUGIN
      // ===========================================
   
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code",
        "insertdatetime media table contextmenu paste jbimages"
      ],
   
      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================
   
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
   
      // ===========================================
      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
      // ===========================================
   
      relative_urls: false 
  });
  //opsi1
  tinymce.init({ 
    selector:'#inputOpsi1',

    // ===========================================
      // INCLUDE THE PLUGIN
      // ===========================================
   
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code",
        "insertdatetime media table contextmenu paste jbimages"
      ],
   
      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================
   
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
   
      // ===========================================
      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
      // ===========================================
   
      relative_urls: false 
  });
  //opsi2
  tinymce.init({ 
    selector:'#inputOpsi2',

    // ===========================================
      // INCLUDE THE PLUGIN
      // ===========================================
   
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code",
        "insertdatetime media table contextmenu paste jbimages"
      ],
   
      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================
   
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
   
      // ===========================================
      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
      // ===========================================
   
      relative_urls: false 
  });
  //opsi3
  tinymce.init({ 
    selector:'#inputOpsi3',

    // ===========================================
      // INCLUDE THE PLUGIN
      // ===========================================
   
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code",
        "insertdatetime media table contextmenu paste jbimages"
      ],
   
      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================
   
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
   
      // ===========================================
      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
      // ===========================================
   
      relative_urls: false 
  });
  //opsi4
  tinymce.init({ 
    selector:'#inputOpsi4',

    // ===========================================
      // INCLUDE THE PLUGIN
      // ===========================================
   
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code",
        "insertdatetime media table contextmenu paste jbimages"
      ],
   
      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================
   
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
   
      // ===========================================
      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
      // ===========================================
   
      relative_urls: false 
  });
</script>