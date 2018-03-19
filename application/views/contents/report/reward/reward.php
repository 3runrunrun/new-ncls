<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">

      <!-- table -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Weekly Promotion Report</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue dataex-html5-export" id="simple-table">
                    <thead>
                      <tr>
                        <th>No WPR</th>
                        <th>Area</th>
                        <th>Detailer</th>
                        <th>Total Biaya<br />(Rp)</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($appr['data']->result() as $value): ?>
                      <tr>
                        <?php $no_wpr = str_replace('-', '/', $value->no_wpr); ?>
                        <td><?php echo strtoupper($no_wpr); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) - <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->detailer; ?></td>
                        <td><?php echo number_format($value->dana, 0, ',', '.'); ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <?php if ($value->status != 'approved'): ?>
                            <a href="<?php echo site_url(); ?>/detail-wpr/<?php echo $value->id; ?>/approve" class="btn btn-warning">Approve</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url(); ?>/detail-wpr/<?php echo $value->id; ?>" class="btn btn-info">Detail</a>
                            <a href="<?php echo site_url(); ?>/print-wpr/<?php echo $value->id; ?>" class="btn btn-primary" target="_blank">Print</a>
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

      <!-- table -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Weekly Promotion Report (Waiting)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table-2">
                    <thead>
                      <tr>
                        <th>No WPR</th>
                        <th>Area</th>
                        <th>Detailer</th>
                        <th>Total Biaya<br />(Rp)</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($wait['data']->result() as $value): ?>
                      <tr>
                        <?php $no_wpr = str_replace('-', '/', $value->no_wpr); ?>
                        <td><?php echo strtoupper($no_wpr); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) - <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->detailer; ?></td>
                        <td><?php echo number_format($value->dana, 0, ',', '.'); ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <?php if ($value->status != 'approved'): ?>
                            <a href="<?php echo site_url(); ?>/detail-wpr/<?php echo $value->id; ?>/approve" class="btn btn-warning">Approve</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url(); ?>/detail-wpr/<?php echo $value->id; ?>" class="btn btn-info">Detail</a>
                            <a href="<?php echo site_url(); ?>/print-wpr/<?php echo $value->id; ?>" class="btn btn-primary" target="_blank">Print</a>
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
    $('#simple-table').DataTable({
        "paging": false,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
      });
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

