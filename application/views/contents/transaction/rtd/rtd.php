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
              <h4 class="card-title" id="horz-layout-basic">RTD Prospect</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th rowspan="2">Id</th>
                        <th rowspan="2">Area</th>
                        <th rowspan="2">Agenda</th>
                        <th colspan="2">Agenda Implementation Date</th>
                        <th rowspan="2">Duration</th>
                        <th rowspan="2">Cost<br />(Rp)</th>
                        <th rowspan="2">Description</th>
                      </tr>
                      <tr>
                        <th>From</th>
                        <th>To</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($rtd['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <td>(<?php echo strtoupper($value->alias_area); ?>) - <?php echo strtoupper($value->nama_area); ?></td>
                        <td><?php echo strtoupper($value->nama); ?></td>
                        <?php $dari = date('d-M-Y', strtotime($value->dari)); ?>
                        <td><?php echo $dari; ?></td>
                        <?php $sampai = date('d-M-Y', strtotime($value->sampai)); ?>
                        <td><?php echo $sampai; ?></td>
                        <td><?php echo $value->durasi; ?> hari</td>
                        <td><?php echo number_format($value->biaya, 0, ',', '.'); ?></td>
                        <td><?php echo $value->keterangan; ?></td>
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
              <h4 class="card-title" id="horz-layout-basic">Add RTD</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>RTD prospect submission form</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-rtd" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">1. Agenda Informatin</h5>
                        <div class="form-group">
                          <label class="label-control">Agenda Name</label>
                          <input type="text" name="nama" class="form-control border-primary" required>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Date</label>
                            <input type="date" name="dari" class="form-control border-primary" required>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Duration</label>
                            <select name="durasi" class="form-control select2">
                              <?php for($i = 1; $i < 31; $i++): ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?> hari</option>
                              <?php endfor; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Area</label>
                            <select name="id_area" class="form-control select2" required>
                              <option value="" selected disabled>Choose area</option>
                              <?php if ($area['data']->num_rows() < 1): ?>
                              <option value="" disabled>Unavailable</option>
                              <?php else: ?>
                              <?php foreach ($area['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area ?>) - <?php echo $value->nama; ?></option>
                              <?php endforeach; ?>  
                              <?php endif; ?>
                              <option value=""></option>
                            </select>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Cost</label>
                            <fieldset>
                              <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="number" name="biaya" min="0" class="form-control border-primary" required>
                              </div>
                            </fieldset>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">2. Description</h5>
                        <div class="form-group">
                          <label class="label-control">Description</label>
                          <textarea class="form-control border-primary" name="keterangan" rows="10" required></textarea>
                        </div>
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
        "order": [[0, "desc"]],
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

