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
              <h4 class="card-title" id="horz-layout-basic">Daily Sales / Area Tahun <?php echo $this->session->userdata('tahun'); ?></h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-500">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode Detailer</th>
                        <th>Detailer</th>
                        <th>January</th>
                        <th>February</th>
                        <th>March</th>
                        <th>April</th>
                        <th>May</th>
                        <th>June</th>
                        <th>July</th>
                        <th>August</th>
                        <th>September</th>
                        <th>October</th>
                        <th>November</th>
                        <th>December</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($sales['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->kode_sales); ?></td>
                        <td><?php echo ucwords($value->nama_sales); ?></td>
                        <td><?php echo number_format($value->januari, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->februari, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->maret, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->april, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->mei, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->juni, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->juli, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->agustus, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->september, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->oktober, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->november, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->desember, 0, ',', '.'); ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <?php foreach ($total['data']->result() as $value): ?>
                      <tr class="bg-green">
                        <th colspan="2">Total</th>
                        <td><?php echo number_format($value->januari, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->februari, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->maret, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->april, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->mei, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->juni, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->juli, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->agustus, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->september, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->oktober, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->november, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->desember, 0, ',', '.'); ?></td>
                      </tr>
                      <?php endforeach ?>
                    </tfoot>
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
          <div class="card border-top-red">
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-400">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="report-table-2">
                    <thead>
                      <tr>
                        <th>Kode Detailer</th>
                        <th>Detailer</th>
                        <th>Sales Reg.<br />(Rp)</th>
                        <th>Sales Disc. Prog.<br />(Rp)</th>
                        <th>Target<br />(Rp)</th>
                        <th>Achievement<br />(%)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($sales_bawah['data']->result() as $value): ?>
                      <tr>
                        <td class="rt-data"><?php echo strtoupper($value->id_detailer); ?></td>
                        <td class="rt-data"><?php echo ucwords($value->nama_detailer); ?></td>
                        <td class="rt-money"><?php echo number_format($value->sales_reg, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->sales_disprog, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_target, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->achievement, 2, ',', '.'); ?>%</td>
                      </tr>
                      <?php endforeach; ?>
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
    $('#simple-table > tbody > tr > td:not(:first-child), #simple-table > tfoot > tr > td:not(:first-child)').css({
      'text-align': 'right',
    });
    $('#simple-table th, #simple-table > tbody > tr > td:first-child, #simple-table > tbody > tr > td:nth-child(2)').css({
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

