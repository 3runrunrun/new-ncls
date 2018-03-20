<?php 
  $name = null;

  foreach ($log_eksten['data']->result() as $value) {
    $name = strtoupper($value->nama_detailer);
  }
 ?>

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
              <h4 class="card-title" id="horz-layout-basic">History Ekstensifikasi / Intensifikasi Detailer</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <h5>Nama: <?php echo $name; ?></h5>
                  </div>
                </div>
                <div class="table-responsive height-400">
                  <table class="table dataex-html5-export table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Nama Outlet</th>
                        <th>Produk</th>
                        <th>Target</th>
                        <th>Jenis<br />(Eksten/Intens)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($log_eksten['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->nama_outlet); ?></td>
                        <td><?php echo strtoupper($value->nama_produk); ?></td>
                        <td><?php echo $value->target; ?></td>
                        <td><?php echo strtoupper($value->jenis); ?></td>
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
