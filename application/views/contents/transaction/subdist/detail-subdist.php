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
              <h4 class="card-title" id="horz-layout-basic">Subdist Target</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-400">
                  <table class="table table-hover table-bordered table-xs border-top-blue display nowrap" id="report-table">
                    <thead>
                      <tr>
                        <th rowspan="2">Produk</th>
                        <th rowspan="2">Total Target</th>
                        <th rowspan="2">Target<br />per bulan</th>
                        <th colspan="2">January</th>
                        <th colspan="2">February</th>
                        <th colspan="2">March</th>
                        <th colspan="2">April</th>
                        <th colspan="2">May</th>
                        <th colspan="2">June</th>
                        <th colspan="2">July</th>
                        <th colspan="2">August</th>
                        <th colspan="2">September</th>
                        <th colspan="2">October</th>
                        <th colspan="2">November</th>
                        <th colspan="2">December</th>
                      </tr>
                      <tr>
                        <?php for ($i = 0; $i < 12; $i++): ?>
                        <th>Qty</th>
                        <th>Value</th>
                        <?php endfor; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($target['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->nama_produk); ?></td>
                        <td><?php echo $value->target; ?></td>
                        <td><?php echo $value->target_perbulan; ?></td>
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