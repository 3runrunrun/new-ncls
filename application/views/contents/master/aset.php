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
              <h4 class="card-title" id="horz-layout-basic">Aset</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Asset</th>
                        <th>Value<br />(Rp)</th>
                        <th>Depreciation<br />(%)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($aset['data']->result() as $key => $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <?php $tanggal = date('d-M-Y', strtotime($value->tanggal)); ?>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo ucwords($value->nama); ?></td>
                        <td><?php echo number_format($value->nominal, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->penyusutan, 2, ',', '.'); ?>%</td>
                      </tr>
                      <?php endforeach ?>
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
              <h4 class="card-title" id="horz-layout-basic">Add Aset</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Nucleus's assets submission</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-aset" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 offset-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Date</label>
                          <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <!-- /tanggal -->
                        <div class="form-group">
                          <label class="label-control">Assets</label>
                          <input type="text" name="nama" class="form-control border-primary" required>
                        </div>
                        <!-- /nama -->
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <fieldset>
                              <label class="label-control">Value</label>
                              <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="number" name="nominal" class="form-control border-primary" min="0" required>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <fieldset>
                              <label class="label-control">Depreciation</label>
                              <div class="input-group">
                                <input type="number" name="penyusutan" class="form-control border-primary" min="0" required>
                                <span class="input-group-addon">%</span>
                              </div>
                            </fieldset>
                          </div>
                        </div>
                        <!-- /nominal /penyusutan -->
                      </div>
                    </div>
                  </div>
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-warning">Cancel</button>
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
    $('#simple-table th, #simple-table td').css({
      'text-align': 'center',
    });
    $('#simple-table td').addClass('text-truncate');
    $('#simple-table td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#simple-table').DataTable({
        "paging": false,
        "order": [[ 0, "desc" ]],
      });
    $('#simple-table_filter').css({
      'text-align': 'center',
    });
    $('#simple-table_wrapper').children(':first').children(':first').remove();
    $('#simple-table_filter').parent().addClass('col-xs-12').removeClass('col-md-6');
    $('#simple-table_filter > label > input').addClass('input-md').removeClass('input-sm').attr({
        placeholder: 'Keyword',
      });

    $('#simple-table_wrapper').children(':last').remove();
  });
</script>
