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
              <h4 class="card-title" id="horz-layout-basic">Promo Trial</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>No Promo</th>
                        <th>Area</th>
                        <th>Detailer</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($promo_trial_appr['data']->result() as $value): ?>
                      <tr>
                        <?php $no_promo = str_replace('-', '/', $value->no_promo); ?>
                        <td><?php echo strtoupper($no_promo); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) - <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->detailer; ?></td>
                        <td><?php echo $value->user; ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <?php if ($value->status != 'approved'): ?>
                            <a href="<?php echo site_url(); ?>/detail-promo/<?php echo $value->no_promo; ?>/approve" class="btn btn-warning">Approve</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url(); ?>/detail-promo/<?php echo $value->no_promo; ?>" class="btn btn-info">Detail</a>
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
              <h4 class="card-title" id="horz-layout-basic">Promo Trial (Waiting)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table-2">
                    <thead>
                      <tr>
                        <th>No Promo</th>
                        <th>Area</th>
                        <th>Detailer</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($promo_trial_wait['data']->result() as $value): ?>
                      <tr>
                        <?php $no_promo = str_replace('-', '/', $value->no_promo); ?>
                        <td><?php echo strtoupper($no_promo); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) - <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->detailer; ?></td>
                        <td><?php echo $value->user; ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <?php if ($value->status != 'approved'): ?>
                            <a href="<?php echo site_url(); ?>/detail-promo/<?php echo $value->no_promo; ?>/approve" class="btn btn-warning">Approve</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url(); ?>/detail-promo/<?php echo $value->no_promo; ?>" class="btn btn-info">Detail</a>
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
              <h4 class="card-title" id="horz-layout-basic">Add Promo Trial</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah promo trial baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-promo" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Kode Promo</label><br />
                          <?php $this->session->set_userdata('no_promo', $id); ?>
                          <span class="tag tag-lg tag-success"><?php echo strtoupper(str_replace('-', '/', $id)); ?></span>
                        </div>
                        <!-- /id -->
                        <div class="form-group">
                          <label class="label-control">Detailer</label>
                          <select name="id_detailer" class="form-control select2">
                            <option value="" selected disabled>Pilih Detailer</option>
                            <?php if ($detailer['data']->num_rows() < 1): ?>
                            <option value="" disabled>Detailer belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($detailer['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - (<?php echo $value->alias_area; ?>) <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-detailer -->
                        <div class="form-group">
                          <label class="label-control">User</label>
                          <select name="id_customer" class="form-control select2">
                            <option value="" selected disabled>Pilih User</option>
                            <?php if ($user['data']->num_rows() < 1): ?>
                            <option value="" disabled>User belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($user['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - (<?php echo $value->alias_area; ?>) - <?php echo $value->jenis; ?> - <?php echo $value->nama; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-customer -->
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">Produk</h5>
                        <div class="form-group row div-repeat">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Produk</label>
                            <select name="id_produk[]" class="form-control select2">
                              <option value="" selected disabled>Pilih Produk</option>
                              <?php if ($produk['data']->num_rows() < 1): ?>
                              <option value="" disabled>Produk belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($produk['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - <?php echo $value->nama; ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                          <div class="col-md-4 col-xs-10">
                            <label class="label-control">Jumlah</label>
                            <input type="number" name="jumlah[]" class="form-control border-primary" min="0">
                          </div>
                          <div class="col-md-1 col-xs-2 del-repeater">
                            <div class="form-group">
                              <label class="label-control">button</label>
                              <button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>
                            </div>
                          </div>
                        </div>
                        <!-- /id-produk /jumlah -->
                        <div id="repeater-out"></div>
                        <div class="row">
                          <div class="col-md-2 col-xs-12">
                            <div class="form-group">
                              <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Tambah COGM</button>
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