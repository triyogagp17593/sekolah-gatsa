<script src="<?= base_url('assets/')?>myscript.js"></script>
<div class="modal-dialog">
  <div class="modal-content">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">UBAH DATA MATA PELAJARAN</h4>
    </div>
    <form action="<?= base_url('update_mapel');?>" method="post" name="form" enctype="multipart/form-data" class="form-horizontal form-label-left">
      <div class="modal-body">
        <input type="hidden" id="mapel_id" name="mapel_id" value="<?= $data_mapel[0]['id_mapel'];?>">
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="inputNama">MATA PELAJARAN <span class="required">*</span></label>
          <div class="col-md-9 col-sm-6 col-xs-12">  
            <input id="inputMapel" class="form-control col-md-7 col-xs-12" name="inputMapel" placeholder="input MATA PELAJARAN" required="required" type="text" value="<?= $data_mapel[0]['nama_mapel'];?>" onfocus="(this.value=='<?= $data_mapel[0]['nama_mapel'];?>') && (this.value='')" onblur="(this.value=='') && (this.value='<?= $data_mapel[0]['nama_mapel'];?>')" autocomplete="off">
          </div>
        </div>
        <b>* Required (Harus di isi)</b>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
        <button class="btn btn-primary">Ubah</button>
      </div>
    </form>
  </div>
</div>
