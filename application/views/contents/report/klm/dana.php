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
              <h4 class="card-title" id="horz-layout-basic">Dana</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Bulan</th>
                        <th>Total Biaya<br />(Rp)</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($appr['data']->result() as $value): ?>
                        <tr>
                          <td><?php echo strtoupper($value->tanggal); ?></td>
                          <td><?php echo number_format($value->dana, 0, ',', '.'); ?></td>
                          <td>
                            <div class="btn-group-vertical">                              
                              <a href="<?php echo site_url(); ?>/detail-klm-dana/<?php echo $value->tanggal; ?>" class="btn btn-info">Detail</a>
                              <a href="<?php echo site_url(); ?>/print-klm-dana/<?php echo $value->tanggal; ?>" class="btn btn-primary" target="_blank">Print</a>
                            </div>
                          </td>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#simple-table-2 th, #simple-table-2 td').css({
      'text-align': 'center',
    });
    $('#simple-table-2 td').addClass('text-truncate');
    $('#simple-table-2 td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#simple-table-2').DataTable({
      "paging": false,
    });
    $('#simple-table-2_filter').css({
      'text-align': 'center',
    });
    $('#simple-table-2_wrapper').children(':first').children(':first').remove();
    $('#simple-table-2_filter').parent().addClass('col-xs-12').removeClass('col-md-6');
    $('#simple-table-2_filter > label > input').addClass('input-md').removeClass('input-sm').attr({
      placeholder: 'Keyword',
    });

    $('#simple-table-2_wrapper').children(':last').remove();
  });
</script>

