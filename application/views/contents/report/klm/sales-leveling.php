<?php 
  $rf = 0;
  $bl = 0;
  $mvc = 0;

  $cstper = $achievement_customer['data']->num_rows();

  foreach ($achievement_customer['data']->result() as $value) {
    if (floatval($value->ratio_dana) < 50) {
      $rf += 1;
    } elseif (floatval($value->ratio_dana) >= 80 && floatval($value->ratio_dana) <= 100) {
      $bl += 1;
    } elseif (floatval($value->ratio_dana) >= 110) {
      $mvc += 1;
    }
  }

  // echo $rf;
  // echo $bl;
  // echo $mvc;
  // echo $cstper;
  
  $pr_rf = $rf / $cstper * 100;
  $pr_bl = $bl / $cstper * 100;
  $pr_mvc = $mvc / $cstper * 100;
 ?>

<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">

      <!-- under-performance -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-red">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Performance</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <div class="col-md-4 col-xs-12">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="danger">
                        <h3 class="font-large-2 text-bold-200">RedFlag</h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="<?php echo $pr_rf; ?>" class="knob hide-value responsive angle-offset" data-angleoffset="40" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#FF0049" data-knob-icon="icon-feedback2" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;"></div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li>
                          <h2 class="grey darken-1 text-bold-400"><?php echo number_format($pr_rf, 2, ',', '.'); ?>%</h2>
                          <span class="danger">Detailer</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-8 col-xs-12">
                    <div class="table-responsive height-350">
                      <table class="table table-bordered table-hover table-xs border-top-red" id="simple-table">
                        <thead>
                          <tr>
                            <th>Area</th>
                            <th>Kode Customer</th>
                            <th>Customer</th>
                            <th>Total Sales<br />(Rp)</th>
                            <th>Target<br />(Rp)</th>
                            <th>Ratio<br />(%)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($achievement_customer['data']->result() as $value): ?>
                          <?php if (floatval($value->ratio_dana) < 50): ?>
                          <tr>
                            <td><?php echo ucwords($value->nama_area); ?></td>
                            <td><?php echo strtoupper($value->id_user); ?></td>
                            <td><?php echo ucwords($value->nama_user); ?></td>
                            <td><?php echo number_format($value->nominal_sales, 0, ',', '.'); ?></td>
                            <td><?php echo number_format($value->total_dana, 0, ',', '.'); ?></td>
                            <td><?php echo number_format($value->ratio_dana, 2, ',', '.'); ?>%</td>
                          </tr>
                          <?php endif; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /under-performance -->

      <!-- performance -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-blue">
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <div class="col-md-4 col-xs-12">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="info">
                        <h3 class="font-large-2 text-bold-200">Balance</h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="<?php echo $pr_bl; ?>" class="knob hide-value responsive angle-offset" data-angleoffset="40" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#3FB9FF" data-knob-icon="icon-feedback2" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;"></div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li>
                          <h2 class="grey darken-1 text-bold-400"><?php echo number_format($pr_bl, 2, ',', '.'); ?>%</h2>
                          <span class="info">Detailer</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-8 col-xs-12">
                    <div class="table-responsive height-350">
                      <table class="table table-bordered table-hover table-xs border-top-red" id="simple-table-2">
                        <thead>
                          <tr>
                            <th>Area</th>
                            <th>Kode Customer</th>
                            <th>Customer</th>
                            <th>Total Sales<br />(Rp)</th>
                            <th>Target<br />(Rp)</th>
                            <th>Ratio<br />(%)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($achievement_customer['data']->result() as $value): ?>
                          <?php if (floatval($value->ratio_dana) >= 80 && floatval($value->ratio_dana) <= 100): ?>
                          <tr>
                            <td><?php echo ucwords($value->nama_area); ?></td>
                            <td><?php echo strtoupper($value->id_user); ?></td>
                            <td><?php echo ucwords($value->nama_user); ?></td>
                            <td><?php echo number_format($value->nominal_sales, 0, ',', '.'); ?></td>
                            <td><?php echo number_format($value->total_dana, 0, ',', '.'); ?></td>
                            <td><?php echo number_format($value->ratio_dana, 2, ',', '.'); ?>%</td>
                          </tr>
                          <?php endif; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /performance -->

      <!-- best-detailer -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <div class="col-md-4 col-xs-12">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="success">
                        <h3 class="font-large-2 text-bold-200">MVC</h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="<?php echo $pr_mvc; ?>" class="knob hide-value responsive angle-offset" data-angleoffset="40" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#09D9A1" data-knob-icon="icon-feedback2" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;"></div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li>
                          <h2 class="grey darken-1 text-bold-400"><?php echo number_format($pr_mvc, 2, ',', '.'); ?>%</h2>
                          <span class="success">Detailer</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-8 col-xs-12">
                    <div class="table-responsive height-350">
                      <table class="table table-bordered table-hover table-xs border-top-red" id="simple-table-3">
                        <thead>
                          <tr>
                            <th>Area</th>
                            <th>Kode Customer</th>
                            <th>Customer</th>
                            <th>Total Sales<br />(Rp)</th>
                            <th>Target<br />(Rp)</th>
                            <th>Ratio<br />(%)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($achievement_customer['data']->result() as $value): ?>
                          <?php if (floatval($value->ratio_dana) >= 110): ?>
                          <tr>
                            <td><?php echo ucwords($value->nama_area); ?></td>
                            <td><?php echo strtoupper($value->id_user); ?></td>
                            <td><?php echo ucwords($value->nama_user); ?></td>
                            <td><?php echo number_format($value->nominal_sales, 0, ',', '.'); ?></td>
                            <td><?php echo number_format($value->total_dana, 0, ',', '.'); ?></td>
                            <td><?php echo number_format($value->ratio_dana, 2, ',', '.'); ?>%</td>
                          </tr>
                          <?php endif; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /best-detailer -->

     <!--  -->
      <!-- /fixed-cost -->

    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){}
    $('#report-table-2 td').addClass('text-truncate');
    $('#report-table-2 td:even').addClass('bg-table-blue');
    $('#total-table').addClass('bg-table-red');
  });
</script>

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
    $('#simple-table-3 th, #simple-table-3 td').css({
      'text-align': 'center',
    });
    $('#simple-table-3 td').addClass('text-truncate');
    $('#simple-table-3 td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#simple-table-3').DataTable({
        "paging": false,
      });
    $('#simple-table-3_filter').css({
      'text-align': 'center',
    });
    $('#simple-table-3_wrapper').children(':first').children(':first').remove();
    $('#simple-table-3_filter').parent().addClass('col-xs-12').removeClass('col-md-6');
    $('#simple-table-3_filter > label > input').addClass('input-md').removeClass('input-sm').attr({
        placeholder: 'Keyword',
      });

    $('#simple-table-3_wrapper').children(':last').remove();
  });
</script>

