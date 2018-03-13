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
              <h4 class="card-title" id="horz-layout-basic">Operasional</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="report-table">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>City<br />(Rp)</th>
                        <th>Allowance<br />(Rp)</th>
                        <th>Tol Parkir<br />(Rp)</th>
                        <th>Bensin<br />(Rp)</th>
                        <th>Comm<br />(Rp)</th>
                        <th>Entertainment<br />(Rp)</th>
                        <th>Med. Care<br />(Rp)</th>
                        <th>Other<br />(Rp)</th>
                        <th>Total<br />(Rp)</th>
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
              <h4 class="card-title" id="horz-layout-basic">Add Operasional</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah Dana Operasional baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-operasional" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-sm-6 offset-sm-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Detailer</label>
                          <select name="id_detailer" class="form-control select2" required>
                            <option value=""></option>
                            <option value=""></option>
                          </select>
                        </div>
                        <!-- /id-detailer -->
                        <div class="form-group">
                          <label class="label-control">Tanggal</label>
                          <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <!-- /tanggal -->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">City</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="city" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /city -->
                        <div class="form-group">
                          <label class="label-control">Allowance</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="allowance" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /allowance -->
                        <div class="form-group">
                          <label class="label-control">Tol &amp; Parkir</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="city" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /tol-parkir -->
                        <div class="form-group">
                          <label class="label-control">Bensin</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="bensin" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /bensin -->
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Comm</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="comm" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /comm -->
                        <div class="form-group">
                          <label class="label-control">Entertainment</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="entertainment" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /entertainment -->
                        <div class="form-group">
                          <label class="label-control">Med. Care</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="medcare" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /medcare -->
                        <div class="form-group">
                          <label class="label-control">Other</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="other" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /other -->
                        <div class="form-group">
                          <label class="label-control">Total</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="total" id="total" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /total -->
                        <div class="form-group">
                          <label class="label-control">Potongan CA</label>
                          <fieldset>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="number" name="potongan_ca" id="total" class="form-control border-primary" min="0" value="0">
                            </div>
                          </fieldset>
                        </div>
                        <!-- /potongan-ca -->
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
    var target_selector = $('#total');
    var total = 0;
    
    $(target_selector).val(parseInt(total));

    $('[name=city] , [name=allowance] , [name=tol_parkir] , [name=bensin] , [name=comm] , [name=entertainment] , [name=medcare] , [name=other]').keyup(function(){
      if ($('[name=city]').val() == '') {
        $('[name=city]').val(0);
      }
      if ($('[name=allowance]').val() == '') {
        $('[name=allowance]').val(0);
      }
      if ($('[name=tol_parkir]').val() == '') {
        $('[name=tol_parkir]').val(0);
      }
      if ($('[name=bensin]').val() == '') {
        $('[name=bensin]').val(0);
        show_bensin_km($('[name=bensin]'));
      }
      if ($('[name=comm]').val() == '') {
        $('[name=comm]').val(0);
      }
      if ($('[name=entertainment]').val() == '') {
        $('[name=entertainment]').val(0);
      }
      if ($('[name=med_care]').val() == '') {
        $('[name=medcare]').val(0);
      }
      if ($('[name=other]').val() == '') {
        $('[name=other]').val(0);
      }

      total = parseInt($('[name=city]').val()) + parseInt($('[name=allowance]').val()) + parseInt($('[name=tol_parkir]').val()) + parseInt($('[name=bensin]').val()) + parseInt($('[name=comm]').val()) + parseInt($('[name=entertainment]').val()) + parseInt($('[name=med_care]').val()) + parseInt($('[name=other]').val());
      $(target_selector).val(parseInt(total));

      show_bensin_km($('[name=bensin]'));
    });
  });
</script>