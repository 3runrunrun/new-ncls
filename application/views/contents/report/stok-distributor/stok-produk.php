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
              <h4 class="card-title" id="horz-layout-basic">Stok Produk (Distributor)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Area</th>
                        <th>Distributor</th>
                        <th>Nama Produk</th>
                        <th>Kemasan</th>
                        <th>Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($bsd['data']->result() as $key => $value): ?>
                      <tr>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                        <td>(<?php echo $value->alias_distributor; ?>) <?php echo $value->nama_distributor; ?></td>
                        <td>(<?php echo strtoupper($value->id_produk); ?>) <?php echo $value->nama_produk; ?></td>
                        <td><?php echo $value->kemasan; ?></td>
                        <td><?php echo $value->stok; ?></td>
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
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Daftar Permohonan Produk (Delivered)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table-2">
                    <thead>
                      <tr>
                        <th>Nomor Surat</th>
                        <th>Area</th>
                        <th>Distributor</th>
                        <th>Tanggal Permohonan</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($deliv['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                        <td>(<?php echo $value->alias_distributor; ?>) <?php echo $value->nama_distributor; ?></td>
                        <?php $tanggal = date('d-M-Y', strtotime($value->tanggal)); ?>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo $value->status_permohonan; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <?php if ($value->status_permohonan !== 'delivered'): ?>
                            <a href="<?php echo site_url(); ?>/detail-product-distributor/<?php echo $value->id; ?>/approve" class="btn btn-warning">Verifikasi</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url(); ?>/detail-product-distributor/<?php echo $value->id; ?>" class="btn btn-info">Detail</a>
                            <a href="#" class="btn btn-primary">Print</a>
                          </div>
                        </td>
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
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Daftar Permohonan Produk (Waiting)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table-3">
                    <thead>
                      <tr>
                        <th>Nomor Surat</th>
                        <th>Area</th>
                        <th>Distributor</th>
                        <th>Tanggal Permohonan</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($wait['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                        <td>(<?php echo $value->alias_distributor; ?>) <?php echo $value->nama_distributor; ?></td>
                        <?php $tanggal = date('d-M-Y', strtotime($value->tanggal)); ?>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo $value->status_permohonan; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <?php if ($value->status_permohonan !== 'delivered'): ?>
                            <a href="<?php echo site_url(); ?>/detail-product-distributor/<?php echo $value->id; ?>/approve" class="btn btn-warning">Verifikasi</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url(); ?>/detail-product-distributor/<?php echo $value->id; ?>" target="_blank" class="btn btn-info">Detail</a>
                            <a href="#" class="btn btn-primary">Print</a>
                          </div>
                        </td>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('.del-repeater label').css({
      'color': 'transparent',
    });
    $('.del-repeater:first').hide();

    $('#add-repeater').click(function(){
      $('.div-repeat:first select').select2('destroy');
      $('.div-repeat:first').clone().appendTo('#repeater-out');
      $('.div-repeat .select2').select2();
      $('#repeater-out .del-repeater').show();
    });
  });
</script>