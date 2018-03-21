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
              <h4 class="card-title" id="horz-layout-basic">Daily Sales (per Outlet)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <?php foreach ($detailer['data']->result() as $value): ?>                    
                  <div class="col-md-6 div col-xs-12">
                    <h5>Kode Detailer: <?php echo strtoupper($value->id); ?></h5>
                    <h5>Detailer: <?php echo ucwords($value->nama_detailer); ?></h5>
                    <h5>Area: <?php echo ucwords($value->nama_area); ?></h5>
                  </div>
                  <?php endforeach; ?>
                  <?php foreach ($achievement_aktual['data']->result() as $value): ?>
                  <div class="col-md-6 col-xs-12 text-xs-right">
                    <h5>Actual Achievement</h5>
                    <p class="display-4 card-title success"><?php echo number_format($value->achievement, 2, ',', '.'); ?>%</p>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="table-responsive height-400">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th rowspan="2">Area</th>
                        <th rowspan="2">Kode Outlet</th>
                        <th rowspan="2">Outlet</th>
                        <th colspan="3">January</th>
                        <th colspan="3">February</th>
                        <th colspan="3">March</th>
                        <th colspan="3">April</th>
                        <th colspan="3">May</th>
                        <th colspan="3">June</th>
                        <th colspan="3">July</th>
                        <th colspan="3">August</th>
                        <th colspan="3">September</th>
                        <th colspan="3">October</th>
                        <th colspan="3">November</th>
                        <th colspan="3">December</th>
                      </tr>
                      <tr>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                        <th>Target</th>
                        <th>Sales</th>
                        <th>Achievement</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($achievement['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo ucwords($value->nama_area); ?></td>
                        <td><?php echo strtoupper($value->id_outlet); ?></td>
                        <td><?php echo ucwords($value->nama_outlet); ?></td>
                        <td><?php echo number_format($value->nominal_target_januari, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_januari, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_januari, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_februari, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_februari, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_februari, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_maret, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_maret, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_maret, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_april, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_april, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_april, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_mei, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_mei, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_mei, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_juni, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_juni, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_juni, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_juli, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_juli, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_juli, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_agustus, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_agustus, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_agustus, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_september, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_september, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_september, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_oktober, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_oktober, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_oktober, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_november, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_november, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_november, 2, ',', '.'); ?>%</td>
                        <td><?php echo number_format($value->nominal_target_desember, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->nominal_jumlah_desember, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->achievement_desember, 2, ',', '.'); ?>%</td>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('.diskon-toggle').change(function(){
      if ($('.diskon-toggle').is(':checked')) {
        $('[name=id_ko], [name=general_tender], [name=diskon_on], [name=diskon_off]').prop({
          required: true,
          disabled: false,
        });
      } else {
        $('[name=id_ko], [name=general_tender], [name=diskon_on], [name=diskon_off]').prop({
          required: false,
          disabled: true,
        });
      }
    });
  });
</script>

