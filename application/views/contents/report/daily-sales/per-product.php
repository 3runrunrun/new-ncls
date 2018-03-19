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
              <h4 class="card-title" id="horz-layout-basic">Daily Sales (per Product)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-400">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Area</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Target<br />(Rp)</th>
                        <th>Total Sales<br />(Rp)</th>
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
                      <?php foreach ($sales['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->nama_area); ?></td>
                        <td><?php echo strtoupper($value->kode_produk); ?></td>
                        <td><?php echo strtoupper($value->nama_produk); ?></td>
                        <td><?php echo number_format($value->target_rp, 0, ',', '.'); ?></td>
                        <td><?php echo number_format($value->total_sales, 0, ',', '.'); ?></td>
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

      <!-- form -->
      <div class="row">  
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Form Daily Sales</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir daily sales</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-sales" class="form" method="POST" role="form">
                  <input type="hidden" name="halaman" value="produk">
                  <div class="form-body">
                    <h5 class="form-section">1. Informasi Penjualan</h5>
                    <div class="row">
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Tanggal</label>
                          <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>"  required>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Distributor / Subdistributor</label>
                          <select name="id_distributor" class="form-control select2" required>
                            <option value="" selected disabled>Pilih distributor / subdistributor</option>
                            <?php if ($dist_subdist['data']->num_rows() < 1): ?>
                            <option value="" selected disabled>Belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($dist_subdist['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo $value->alias_distributor; ?> - <?php echo $value->nama; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                          <fieldset>
                            <label class="custom-control custom-radio mt-1">
                              <input id="radioStacked1" name="dist_subdist" type="radio" class="custom-control-input" value="d" required>
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">Distributor</span>
                            </label>
                          </fieldset>
                          <fieldset>
                            <label class="custom-control custom-radio">
                              <input id="radioStacked1" name="dist_subdist" type="radio" class="custom-control-input" value="s" required>
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">Subdistributor</span>
                            </label>
                          </fieldset>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Detailer</label>
                          <select name="id_detailer" class="form-control select2" required>
                            <option value="" selected disabled>Pilih detailer</option>
                            <?php if ($detailer['data']->num_rows() < 1): ?>
                            <option value="" selected disabled>Belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($detailer['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Outlet</label>
                          <select name="id_outlet" class="form-control select2" required>
                            <option value="" selected disabled>Pilih outlet</option>
                            <?php if ($outlet['data']->num_rows() < 1): ?>
                            <option value="" selected disabled>Belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($outlet['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_outlet; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">2. Informasi Produk</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Produk</label>
                            <select name="id_produk" class="form-control select2" required>
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
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control border-primary" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">3. Informasi Diskon</h5>
                        <div class="form-group">
                          <fieldset>
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input diskon-toggle">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">Aktifkan Diskon</span>
                            </label>
                          </fieldset>
                        </div>
                        <div class="form-group row input-diskon">
                          <div class="col-md-8 col-xs-12">
                            <label class="label-control">Faktur Diskon</label>
                            <select name="id_ko" class="form-control select2" disabled>
                              <option value="" selected disabled>Pilih diskon</option>
                              <?php if ($faktur['data']->num_rows() < 1): ?>
                              <option value="" disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($faktur['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>">(<?php echo ucwords($value->jenis_faktur); ?>) - <?php echo str_replace('-', '/', strtoupper($value->id)); ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                          <div class="col-md-4 col-xs-12">
                            <label class="label-control">Jenis KO</label>
                            <fieldset class="general-tender">
                              <label class="custom-control custom-radio disable">
                                <input id="radioStacked1" name="general_tender" type="radio" class="custom-control-input" value="g" disabled>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">General</span>
                              </label>
                            </fieldset>
                            <fieldset class="general-tender">
                              <label class="custom-control custom-radio disable">
                                <input id="radioStacked1" name="general_tender" type="radio" class="custom-control-input" value="t" disabled>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Tender</span>
                              </label>
                            </fieldset>
                          </div>
                          <p>*) Anda dapat melihat informasi faktur yang tersedia pada tabel di bawah</p>
                        </div>
                        <div class="form-group row input-diskon">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Diskon On</label>
                            <fieldset>
                              <div class="input-group">  
                              <input type="number" name="diskon_on" class="form-control border-primary" disabled readonly>
                              <span class="input-group-addon">%</span>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Diskon Off</label>
                            <fieldset>
                              <div class="input-group">  
                              <input type="number" name="diskon_off" class="form-control border-primary" disabled readonly>
                              <span class="input-group-addon">%</span>
                              </div>
                            </fieldset>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-xs table-bordered table-hover nowrap display border-top-blue" id="simple-table-2">
                            <thead>
                              <tr>
                                <th>No. Faktur</th>
                                <th>Dist / Subdist</th>
                                <th>Detailer</th>
                                <th>Outlet</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>On<br />(%)</th>
                                <th>Off<br />(%)</th>
                              </tr>
                            </thead>
                          </table>
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
    $('.diskon-toggle').change(function(){
      if ($('.diskon-toggle').is(':checked')) {
        $('[name=id_ko], [name=general_tender], [name=diskon_on], [name=diskon_off]').prop({
          required: true,
          disabled: false,
        });
      } else {
        $('[name=id_ko], [name=general_tender], [name=diskon_on], [name=diskon_off]').prop({
          required: false,
          disabled: true,
        });
      }
    });
  });
</script>