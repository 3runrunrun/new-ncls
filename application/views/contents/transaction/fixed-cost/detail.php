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
              <h4 class="card-title" id="horz-layout-basic">Performa Detailer Per Bulan</h4>
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
                        <th>Kode Produk</th>
                        <th>Produk</th>
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
                        <td class="rt-money"><?php echo number_format($value->nominal_target, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->total_sales, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->januari, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->februari, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->maret, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->april, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->mei, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->juni, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->juli, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->agustus, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->september, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->oktober, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->november, 0, ',', '.'); ?></td>
                        <td class="rt-money"><?php echo number_format($value->desember, 0, ',', '.'); ?></td>
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

