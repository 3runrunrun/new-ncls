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
          <div class="card border-top-red">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Daftar Faktur (General)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-red" id="simple-table">
                    <thead>
                      <tr>
                        <th>No. Faktur</th>
                        <th>Spv/RM<br />(yang mengajukan)</th>
                        <th>Tanggal</th>
                        <th>Jenis Diskon</th>
                        <th>Status</th>
                        <th>Tanggal<br/>SPV</th>
                        <th>Tanggal<br/>RM</th>
                        <th>Tanggal<br/>Direktur</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>No. Faktur</td>
                        <td>Spv/RM<br />(yang mengajukan)</td>
                        <td>Tanggal</td>
                        <td>Jenis Diskon</td>
                        <td>Status</td>
                        <td>Tanggal<br/>SPV</td>
                        <td>Tanggal<br/>RM</td>
                        <td>Tanggal<br/>Direktur</td>
                        <td>
                          <div class="btn-group-vertical">
                            <a href="#" class="btn btn-info">Detail</a>
                          </div>
                        </td>
                      </tr>
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
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Daftar Faktur (Tender)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-red" id="simple-table-2">
                    <thead>
                      <tr>
                        <th>SP</th>
                        <th>No. Faktur</th>
                        <th>Spv/RM<br />(yang mengajukan)</th>
                        <th>Tanggal</th>
                        <th>Jenis Diskon</th>
                        <th>Status</th>
                        <th>Tanggal<br/>SPV</th>
                        <th>Tanggal<br/>RM</th>
                        <th>Tanggal<br/>Direktur</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>SP</td>
                        <td>No. Faktur</td>
                        <td>Spv/RM<br />(yang mengajukan)</td>
                        <td>Tanggal</td>
                        <td>Jenis Diskon</td>
                        <td>Status</td>
                        <td>Tanggal<br/>SPV</td>
                        <td>Tanggal<br/>RM</td>
                        <td>Tanggal<br/>Direktur</td>
                        <td>
                          <div class="btn-group-vertical">
                            <a href="#" class="btn btn-info">Detail</a>
                          </div>
                        </td>
                      </tr>
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

