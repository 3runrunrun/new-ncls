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
              <h4 class="card-title" id="horz-layout-basic">Weekly Promotion Report</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>No WPR</th>
                        <th>Area</th>
                        <th>Detailer</th>
                        <th>Total Biaya<br />(Rp)</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($appr['data']->result() as $value): ?>
                      <tr>
                        <?php $no_wpr = str_replace('-', '/', $value->no_wpr); ?>
                        <td><?php echo strtoupper($no_wpr); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) - <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->detailer; ?></td>
                        <td><?php echo number_format($value->dana, 0, ',', '.'); ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <?php if ($value->status != 'approved'): ?>
                            <a href="<?php echo site_url(); ?>/detail-wpr/<?php echo $value->id; ?>/approve" class="btn btn-warning">Approve</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url(); ?>/detail-wpr/<?php echo $value->id; ?>" class="btn btn-info">Detail</a>
                            <a href="<?php echo site_url(); ?>/print-wpr/<?php echo $value->id; ?>" class="btn btn-primary" target="_blank">Print</a>
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
              <h4 class="card-title" id="horz-layout-basic">Weekly Promotion Report (Waiting)</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table-2">
                    <thead>
                      <tr>
                        <th>No WPR</th>
                        <th>Area</th>
                        <th>Detailer</th>
                        <th>Total Biaya<br />(Rp)</th>
                        <th>Status</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($wait['data']->result() as $value): ?>
                      <tr>
                        <?php $no_wpr = str_replace('-', '/', $value->no_wpr); ?>
                        <td><?php echo strtoupper($no_wpr); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) - <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->detailer; ?></td>
                        <td><?php echo number_format($value->dana, 0, ',', '.'); ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <?php if ($value->status != 'approved'): ?>
                            <a href="<?php echo site_url(); ?>/detail-wpr/<?php echo $value->id; ?>/approve" class="btn btn-warning">Approve</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url(); ?>/detail-wpr/<?php echo $value->id; ?>" class="btn btn-info">Detail</a>
                            <a href="<?php echo site_url(); ?>/print-wpr/<?php echo $value->id; ?>" class="btn btn-primary" target="_blank">Print</a>
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
              <h4 class="card-title" id="horz-layout-basic">Add Weekly Promotion Report</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah WPR baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-wpr" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">1. Infomasi WPR</h5>
                        <div class="form-group row">
                          <div class="col-sm-3 col-xs-12">
                            <label class="label-control">Kode</label><br />
                            <select name="prefix_wpr" class="form-control border-primary" required>
                              <option value="" selected disabled>Pilih kode</option>
                              <option value="dks">DKS</option>
                              <option value="oth">OTH</option>
                              <option value="tdr">TDR</option>
                            </select>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Kode WPR</label><br />
                            <?php $suffix_wpr = '-hl-' . date('d-Y'); ?>
                            <?php $this->session->set_userdata('suffix_wpr', $suffix_wpr); ?>
                            <span class="tag tag-lg tag-success"><?php echo str_replace('-', '/', strtoupper($suffix_wpr)); ?></span>
                          </div>
                        </div>
                        <!-- /id -->
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Detailer</label>
                            <select name="id_detailer" class="form-control select2" required>
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
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">User</label>
                            <select name="id_user" class="form-control select2" required>
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
                        </div>
                        <!-- /id-detailer /id-customer -->
                        <h5 class="form-section">2. Approver</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                              <label class="label-control">Mengetahui (Supervisor)</label>
                              <select name="id_spv" class="form-control select2" required>
                                <option value="" selected disabled>Pilih Supervisor</option>
                                <?php if ($detailer['data']->num_rows() < 1): ?>
                                <option value="" disabled>Supervisor belum tersedia</option>
                                <?php else: ?>
                                <?php foreach ($detailer['data']->result() as $value): ?>
                                <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - (<?php echo $value->alias_area; ?>) <?php echo $value->nama_detailer; ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                              <label class="label-control">Menyetujui (Direktur)</label>
                              <select name="id_direktur" class="form-control select2" required>
                                <option value="" selected disabled>Pilih Direktur</option>
                                <?php if ($detailer['data']->num_rows() < 1): ?>
                                <option value="" disabled>Direktur belum tersedia</option>
                                <?php else: ?>
                                <?php foreach ($detailer['data']->result() as $value): ?>
                                <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - (<?php echo $value->alias_area; ?>) <?php echo $value->nama_detailer; ?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                              </select>
                            </div>
                          </div>
                          <!-- /id-spv /id-direktur -->
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">3. Bank &amp; Rekening</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Bank</label>
                            <input type="text" name="bank" class="form-control border-primary">
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">No. Rekening</label>
                            <input type="text" name="norek" class="form-control border-primary">
                          </div>
                          <div class="col-md-6 col-xs-12 mt-1">
                            <label class="label-control">Atas nama</label>
                            <input type="text" name="atas_nama" class="form-control border-primary">
                          </div>
                          <div class="col-md-6 col-xs-12 mt-1">
                            <div class="form-group">
                              <label class="label-control">Dana</label>
                              <fieldset>
                                <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                  <input type="number" name="dana" class="form-control border-primary" required>
                                </div>
                              </fieldset>
                            </div>
                          </div>
                        </div>
                        <!-- /bank /norek /atas-nama -->
                        <h5 class="form-section">4. Periode</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Dari</label>
                            <select name="dari" class="form-control select2">
                              <option value="" selected disabled>Pilih Bulan</option>
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Sampai</label>
                            <select name="sampai" class="form-control select2">
                              <option value="" selected disabled>Pilih Bulan</option>
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                          </div>
                        </div>
                        <!-- /dari /ke -->
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

