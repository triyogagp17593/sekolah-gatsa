<?php date_default_timezone_set("Asia/Jakarta"); $tahun = date("Y"); ?>
        <!-- footer content -->
        <footer>
          <div class="pull-left"><h4><?php $this->load->view('dashboard/kelengkapan/jam_aktif');?></h4></div>
          <div class="pull-right">
            ©<?= $tahun?> All Rights Reserved. <?=constant("FOOTERDASHBOARD")?>
            <br>
            <span class="pull-right">Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a></span>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <?php $this->load->view('dashboard/kelengkapan/js');?>
  </body>
</html>