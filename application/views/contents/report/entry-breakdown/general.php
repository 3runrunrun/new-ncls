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
              <h4 class="card-title" id="horz-layout-basic">Laporan Sales Med Rep</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-400">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode Customer</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Value<br />(Rp)</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($entry_breakdown['data']->result() as $value): ?>
                      <tr>
                        <td class="rt-data"><?php echo strtoupper($value->id_user); ?></td>
                        <td class="rt-data"><?php echo ucwords($value->nama_user); ?></td>
                        <?php $tanggal = date('d-M-Y', strtotime($value->tanggal)); ?>
                        <td class="rt-data"><?php echo $tanggal; ?></td>
                        <td class="rt-money"><?php echo number_format($value->value, 0, ',', '.'); ?></td>
                        <td class="rt-data">
                          <div class="btn-group-vertical">
                            <a href="<?php echo site_url(); ?>/detail-breakdown-general/<?php echo $value->id; ?>" target="_blank" class="btn btn-info">Detail</a>
                            <a href="#" class="btn btn-primary">Rilis</a>
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

      <!-- form -->
      <div class="row">  
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Add Sales Med Rep</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir penyimpanan sales medical representative</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-entry-breakdown" class="form" method="POST" role="form">
                  <input type="hidden" name="halaman" value="general">
                  <div class="form-body">
                    <h5 class="form-section">1. Informasi Med Rep</h5>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Kode Wpr - Dokter</label>
                          <select name="id_wpr" class="form-control select2" required>
                            <option value="" selected disabled>Pilih kode WPR - Dokter</option>
                            <?php if ($wpr['data']->num_rows() < 1): ?>
                            <option value="" selected disabled>Belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($wpr['data']->result() as $value): ?>
                            <option value="<?php echo $value->id_wpr; ?>"><?php echo str_replace('-', '/', strtoupper($value->no_wpr)); ?> - <?php echo strtoupper($value->nama_user); ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="label-control">Tanggal</label>
                          <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group row div-repeat">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Produk</label>
                            <select name="id_produk[]" class="form-control select2" required>
                              <option value="" selected disabled>Pilih produk</option>
                              <?php if ($produk['data']->num_rows() < 1): ?>
                              <option value="" selected disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($produk['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama); ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
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
                        <div class="row">
                          <div class="col-md-2 col-xs-12">
                            <div class="form-group">
                              <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                            </div>
                          </div>
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
    $('#simple-table th').css({
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

