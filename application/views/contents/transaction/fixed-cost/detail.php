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
              <h4 class="card-title" id="horz-layout-basic">Detailer Performance (Monthly)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <?php foreach ($detail['data']->result() as $value): ?>  
                  <div class="col-md-6 col-xs-12">
                    <h5>Detailer: <?php echo ucwords($value->nama_detailer); ?></h5>
                    <h5>Area: (<?php echo strtoupper($value->alias_area); ?>) - <?php echo ucwords($value->nama_area); ?></h5>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="table-responsive height-350">
                  <table class="table table-hover table-xs border-top-blue display nowrap dataex-html5-export" id="simple-table">
                    <thead>
                      <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Outlet Id</th>
                        <th>Outlet</th>
                        <th>Target<br />(Rp)</th>
                        <th>Total Sales<br />(Rp)</th>
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
                      <?php foreach ($produk['data']->result() as $value): ?>
                      <tr>
                        <td class="rt-data"><?php echo strtoupper($value->id_produk); ?></td>
                        <td class="rt-data"><?php echo ucwords($value->nama_produk); ?></td>
                        <td class="rt-data"><?php echo strtoupper($value->id_outlet); ?></td>
                        <td class="rt-data"><?php echo ucwords($value->nama_outlet); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_target, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_januari, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_februari, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_maret, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_april, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_mei, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_juni, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_juli, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_agustus, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_september, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_oktober, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_november, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->nominal_jumlah_desember, 0, ',', '.'); ?></td>
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
    $('#simple-table th').css({
      'text-align': 'center',
      'vertical-align': 'middle',
    });
    $('#simple-table td').addClass('text-truncate');
    $('#simple-table td:even').addClass('bg-table-blue');
  });
</script>

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
    $('#simple-table_info').remove();
  });
</script>

