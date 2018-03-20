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
              <h4 class="card-title" id="horz-layout-basic">Evaluasi Target Customer</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-hover table-xs border-top-blue display nowrap" id="simple-table">
                    <thead>
                      <tr>
                        <th>Area</th>
                        <th>Kode Detailer</th>
                        <th>Detailer</th>
                        <th>Target<br />(unit)</th>
                        <th>Aktual<br />(unit)</th>
                        <th>Achievement<br />(%)</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($achievement['data']->result() as $value): ?>
                      <tr>
                        <td class="rt-data"><?php echo ucwords($value->nama_area); ?></td>
                        <td class="rt-data"><?php echo strtoupper($value->id_detailer); ?></td>
                        <td class="rt-data"><?php echo ucwords($value->nama_detailer); ?></td>
                        <td class="rt-money"><?php echo $value->target; ?></td>
                        <td class="rt-money"><?php echo $value->jumlah; ?></td>
                        <td class="rt-money"><?php echo number_format($value->achievement, 2, ',', '.'); ?>%</td>
                        <td class="rt-data">
                          <div class="btn-group-vertical">
                            <a href="<?php echo site_url(); ?>/detail-intens/<?php echo $value->id_detailer; ?>" target="_blank" class="btn btn-info">Detail</a>
                          </div>
                        </td>
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

