<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      
      <div class="row">
        <div class="col-xs-12">
          <?php if ( ! is_null($this->session->flashdata())): ?>
          <?php if ( ! is_null($this->session->flashdata('error_msg'))): ?>  
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $this->session->flashdata('error_msg'); ?>
          </div>
          <?php elseif ( ! is_null($this->session->flashdata('success_msg'))): ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $this->session->flashdata('success_msg'); ?>
          </div>
          <?php elseif ( ! is_null($this->session->flashdata('query_msg'))): ?>
          <div class="bs-callout-danger callout-border-left">
            <strong>Database Error!</strong>
            <p><?php echo $this->session->flashdata('query_msg')['message']; ?> <strong><?php echo $this->session->flashdata('query_msg')['code']; ?></strong></p>
          </div><br />
          <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
      <!-- /alert -->

      <!-- table -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">COGM</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="report-table">
                    <thead>
                      <tr>
                        <th>TANGGAL</th>
                        <?php foreach ($jenis['data']->result() as $value): ?>
                        <th><?php echo $value->nama; ?><br />(Rp)</th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /table -->

      <!-- form -->
      <div class="row">  
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Add COGM</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah COGM baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-cogm" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row div-repeat">
                      <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Tanggal</label>
                          <input type="date" name="tanggal[]" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                      <!-- /tanggal -->
                      <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Jenis COGM</label>
                          <select name="id_cogm[]" class="form-control select2">
                            <option value="" selected disabled>Pilih jenis COGM</option>
                            <?php if ($jenis['data']->num_rows() < 1): ?>
                            <option value="" disabled>Jenis COGM belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($jenis['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>                          
                        </div>
                      </div>
                      <!-- /jenis-cogm -->
                      <div class="col-md-3 col-xs-10">
                        <div class="form-group">
                          <label class="label-control">Biaya</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="biaya[]" class="form-control border-primary" min="0" required>
                            </div>
                          </fieldset>
                        </div>
                      </div>
                      <!-- /biaya -->
                      <div class="col-md-1 col-xs-2 del-repeater">
                        <div class="form-group">
                          <label class="label-control">button</label>
                          <button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <!-- /biaya -->
                    </div>
                    <div id="repeater-out"></div>
                    <div class="row">
                      <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                          <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Tambah COGM</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-warning">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /form -->

    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#report-table th, #report-table td').css({
      'text-align': 'center',
      'vertical-align': 'top',
    });
    $('#report-table td').addClass('text-truncate');
    $('#report-table td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.del-repeater label').css({
      'color': 'transparent',
    });
    $('.del-repeater:first').hide();

    $('#add-repeater').click(function(){
      $('.div-repeat:first select').select2('destroy');
      $('.div-repeat:first').clone().appendTo('#repeater-out');
      $('.div-repeat .select2').select2();
      $('#repeater-out .del-repeater').show();
    });
  });
</script>

