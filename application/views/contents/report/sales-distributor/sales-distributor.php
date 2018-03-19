<?php $area = null; ?>
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
              <h4 class="card-title" id="horz-layout-basic">Daily Sales / Area Tahun <?php echo $this->session->userdata('tahun'); ?></h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-500">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Area</th>
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
                      <?php foreach ($sales_area['data']->result() as $value): ?>
                      <?php if ($value->nama_area != $area): ?>
                      <?php $area = $value->nama_area; ?>
                      <tr>
                        <td><strong>(<?php echo $value->id_area; ?>) - <?php echo strtoupper($area); ?></strong></td>
                        <td colspan="11">&nbsp;</td>
                      </tr>
                      <?php endif; ?>
                      <tr>
                        <td><?php echo strtoupper($value->alias_distributor); ?></td>
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
          <div class="card border-top-red">
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-400">
                  <table class="table table-bordered table-hover table-xs border-top-blue">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
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
                      <?php foreach ($sales_total['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->alias_distributor); ?></td>
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

