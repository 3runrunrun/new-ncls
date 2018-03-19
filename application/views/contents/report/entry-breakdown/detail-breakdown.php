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
              <h4 class="card-title" id="horz-layout-basic">Detail Entry Breakdown</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <?php foreach ($detail['data']->result() as $value): ?>
                  <div class="col-md-6 col-xs-12">
                    <h5>Kode Breakdown: <?php echo str_replace('-', '/', strtoupper($value->id)); ?></h5>
                    <h5>Supervisor: <?php echo ucwords($value->nama_spv); ?></h5>
                    <h5>Area: (<?php echo strtoupper($value->alias_area); ?>) - <?php echo strtoupper($value->nama_area); ?></h5>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="table-responsive mt-2">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Value</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($produk['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id_produk); ?></td>
                        <td><?php echo ucwords($value->nama_produk); ?></td>
                        <td><?php echo $value->jumlah; ?></td>
                        <td><?php echo number_format($value->value, 0, ',', '.'); ?></td>
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

