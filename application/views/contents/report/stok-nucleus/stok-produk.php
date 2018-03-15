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
              <h4 class="card-title" id="horz-layout-basic">Stok Produk (Nucleus)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kemasan</th>
                        <th>Qty</th>
                      </tr>
                    </thead>
                    <tbody>

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
                        <th>Tanggal Permohonan</th>
                        <th>Tanggal Target</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>

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
                        <th>Tanggal Permohonan</th>
                        <th>Tanggal Target</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /table -->

      <!-- form -->
      <div class="row">  
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Surat Permohonan Barang</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir penyimpanan surat permohonan stok produk Nucleus ke Pabrik baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">1. Identitas Surat Permohonan</h5>
                        <div class="form-group">
                          <label class="label-control">Nomor Surat</label><br />
                          <span class="tag tag-success tag-lg">Surat</span>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Tanggal Permohonan</label>
                            <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Tanggal Target</label>
                            <input type="date" name="tanggal_target" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">2. Produk</h5>
                        <div class="form-group row div-repeat">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Produk</label>
                            <select name="id_produk[]" class="form-control select2" required>
                              <option value="" selected disabled>Pilih produk</option>
                              <option value=""></option>
                            </select>
                          </div>
                          <div class="col-md-4 col-xs-12">
                            <label class="label-control">Jumlah</label>
                            <input type="number" name="jumlah[]" class="form-control border-primary" min="0" required>
                          </div>
                          <div class="col-md-2 col-xs-12 del-repeater">
                            <label class="label-control">Jumlah</label>
                            <button class="btn btn-danger" type="button" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div id="repeater-out"></div>
                        <div class="form-group">
                          <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-warning">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /form -->

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