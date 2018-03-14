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
              <h4 class="card-title" id="horz-layout-basic">Produk</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kemasan</th>
                        <th>Harga (Master)<br >(Rp)</th>
                        <th>Harga (HNA)<br >(Rp)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($produk['data']->result() as $value): ?>
                        <tr>
                          <td><?php echo strtoupper($value->id); ?></td>
                          <td><?php echo strtoupper($value->nama); ?></td>
                          <td><?php echo strtoupper($value->kemasan); ?></td>
                          <td><?php echo number_format($value->harga_master, '0', ',', '.'); ?></td>
                          <td><?php echo number_format($value->harga_hna, '0', ',', '.'); ?></td>
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
              <h4 class="card-title" id="horz-layout-basic">Add Produk</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah produk baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-product" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">Identitas Produk</h5>
                        <div class="form-group">
                          <label class="label-control">Kode Produk</label><br />
                          <?php $this->session->set_userdata('id_produk', $id); ?>
                          <span class="tag tag-lg tag-success"><?php echo strtoupper($id); ?></span>
                        </div>
                        <!-- /id -->
                        <div class="form-group">
                          <label class="label-control">Nama</label>
                          <input type="text" name="nama" class="form-control border-primary" required>
                        </div>
                        <!-- /nama -->
                        <div class="form-group">
                          <label class="label-control">Kemasan</label>
                          <input type="text" name="kemasan" class="form-control border-primary" required>
                        </div>
                        <!-- /kemasan -->
                        <h5 class="form-section">Harga Produk</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Harga Master</label>
                            <fieldset>
                              <div class="input-group">
                                <span class="input-group-add">Rp</span>
                                <input type="number" name="harga_master" class="form-control border-primary" required>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Harga HNA</label>
                            <fieldset>
                              <div class="input-group">
                                <span class="input-group-add">Rp</span>
                                <input type="number" name="harga_hna" class="form-control border-primary" readonly required>
                              </div>
                            </fieldset>
                          </div>
                        </div>
                        <!-- /harga_master /harga_hna -->
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">Jenis Produk</h5>
                        <div class="form-group row">
                          <?php foreach ($jenis['data']->result() as $value): ?>
                          <div class="col-md-3 col-xs-12">
                            <fieldset>
                              <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="id_jenis[]" class="custom-control-input" value="<?php echo $value->id; ?>">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><?php echo $value->nama; ?></span>
                              </label>
                            </fieldset>
                          </div>
                          <?php endforeach ?>
                        </div>
                        <!-- /jenis-produk -->
                        <div class="form-group">
                          <label class="label-control">Keterangan</label>
                          <textarea name="keterangan" rows="10" class="form-control border-primary"></textarea>
                        </div>
                        <!-- /keterangan -->
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
    $('[name=harga_master]').keyup(function() {
      $('[name=harga_hna]').val($('[name=harga_master]').val());
    });
  });
</script>

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

