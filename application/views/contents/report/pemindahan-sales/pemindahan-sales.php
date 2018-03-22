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
              <h4 class="card-title" id="horz-layout-basic">Pemindahan Sales (Approved)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Nomor Surat</th>
                        <th>Periode</th>
                        <th>Detailer<br />(dari)</th>
                        <th>Supervisor<br />(dari)</th>
                        <th>Outlet<br />(dari)</th>
                        <th>Detailer<br />(ke)</th>
                        <th>Supervisor<br />(ke)</th>
                        <th>Outlet<br />(ke)</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($appr['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo str_replace('-', '/', strtoupper($value->id)); ?></td>
                        <?php $periode = date('Y-m-d', strtotime($value->periode)); ?>
                        <td><?php echo $periode; ?></td>
                        <td>(<?php echo strtoupper($value->id_detailer_dari); ?>) <?php echo ucwords($value->nama_detailer_dari); ?></td>
                        <td>(<?php echo strtoupper($value->id_spv_dari); ?>) <?php echo ucwords($value->nama_spv_dari); ?></td>
                        <td>(<?php echo strtoupper($value->id_outlet_dari); ?>) <?php echo ucwords($value->nama_outlet_dari); ?></td>
                        <td>(<?php echo strtoupper($value->id_detailer_ke); ?>) <?php echo ucwords($value->nama_detailer_ke); ?></td>
                        <td>(<?php echo strtoupper($value->id_spv_ke); ?>) <?php echo ucwords($value->nama_spv_ke); ?></td>
                        <td>(<?php echo strtoupper($value->id_outlet_ke); ?>) <?php echo ucwords($value->nama_outlet_ke); ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <a href="<?php echo site_url(); ?>/detail-pemindahan-sales/<?php echo $value->id; ?>/approve" target="_blank" class="btn btn-warning">Approve</a>
                            <a href="<?php echo site_url(); ?>/detail-pemindahan-sales/<?php echo $value->id; ?>" target="_blank" class="btn btn-info">Detail</a>
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

      <!-- table -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Pemindahan Sales (Waiting)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table-2">
                    <thead>
                      <tr>
                        <th>Nomor Surat</th>
                        <th>Periode</th>
                        <th>Detailer<br />(dari)</th>
                        <th>Supervisor<br />(dari)</th>
                        <th>Outlet<br />(dari)</th>
                        <th>Detailer<br />(ke)</th>
                        <th>Supervisor<br />(ke)</th>
                        <th>Outlet<br />(ke)</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($wait['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo str_replace('-', '/', strtoupper($value->id)); ?></td>
                        <?php $periode = date('Y-m-d', strtotime($value->periode)); ?>
                        <td><?php echo $periode; ?></td>
                        <td>(<?php echo strtoupper($value->id_detailer_dari); ?>) <?php echo ucwords($value->nama_detailer_dari); ?></td>
                        <td>(<?php echo strtoupper($value->id_spv_dari); ?>) <?php echo ucwords($value->nama_spv_dari); ?></td>
                        <td>(<?php echo strtoupper($value->id_outlet_dari); ?>) <?php echo ucwords($value->nama_outlet_dari); ?></td>
                        <td>(<?php echo strtoupper($value->id_detailer_ke); ?>) <?php echo ucwords($value->nama_detailer_ke); ?></td>
                        <td>(<?php echo strtoupper($value->id_spv_ke); ?>) <?php echo ucwords($value->nama_spv_ke); ?></td>
                        <td>(<?php echo strtoupper($value->id_outlet_ke); ?>) <?php echo ucwords($value->nama_outlet_ke); ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <a href="<?php echo site_url(); ?>/detail-pemindahan-sales/<?php echo $value->id; ?>/approve" target="_blank" class="btn btn-warning">Approve</a>
                            <a href="<?php echo site_url(); ?>/detail-pemindahan-sales/<?php echo $value->id; ?>" target="_blank" class="btn btn-info">Detail</a>
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

      <!-- form -->
      <div class="row">  
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Formulir Pemindahan Barang</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir pemindahan sales</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-pemindahan-sales" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">1. Dari</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Periode</label>
                            <input type="date" name="periode" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Detailer</label>
                            <select name="id_detailer_dari" class="form-control select2">
                              <option value="" selected disabled>Pilih detailer</option>
                              <?php if ($detailer['data']->num_rows() < 1): ?>
                              <option value="" disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($detailer['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->alias_area); ?> - <?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama_detailer); ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Spv</label>
                            <select name="id_spv_dari" class="form-control select2">
                              <option value="" selected disabled>Pilih SPV</option>
                              <?php if ($detailer['data']->num_rows() < 1): ?>
                              <option value="" disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($detailer['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->alias_area); ?> - <?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama_detailer); ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form group">
                          <label class="label-control">Outlet</label>
                          <select name="id_outlet_dari" class="form-control select2">
                            <option value="" selected disabled>Pilih Outlet</option>
                            <?php if ($outlet['data']->num_rows() < 1): ?>
                            <option value="" disabled>Belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($outlet['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->alias_area); ?> - <?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama_outlet); ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">2. Ke</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Detailer</label>
                            <select name="id_detailer_ke" class="form-control select2">
                              <option value="" selected disabled>Pilih detailer</option>
                              <?php if ($detailer['data']->num_rows() < 1): ?>
                              <option value="" disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($detailer['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->alias_area); ?> - <?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama_detailer); ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Spv</label>
                            <select name="id_spv_ke" class="form-control select2">
                              <option value="" selected disabled>Pilih SPV</option>
                              <?php if ($detailer['data']->num_rows() < 1): ?>
                              <option value="" disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($detailer['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->alias_area); ?> - <?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama_detailer); ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form group">
                          <label class="label-control">Outlet</label>
                          <select name="id_outlet_ke" class="form-control select2">
                            <option value="" selected disabled>Pilih Outlet</option>
                            <?php if ($outlet['data']->num_rows() < 1): ?>
                            <option value="" disabled>Belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($outlet['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->alias_area); ?> - <?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama_outlet); ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 offset-md-3 col-xs-12">
                        <h5 class="form-section">3. Produk</h5>
                        <div class="form-group row div-repeat">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Produk</label>
                            <select name="id_produk[]" class="form-control select2" required>
                              <option value="" selected disabled>Pilih produk</option>
                              <?php if ($produk['data']->num_rows() < 1): ?>
                              <option value="" disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($produk['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->nama); ?></option>
                              <?php endforeach ?>
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