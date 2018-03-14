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
              <h4 class="card-title" id="horz-layout-basic">Outlet</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Area</th>
                        <th>Nama</th>
                        <th>Kota</th>
                        <th>Distributor</th>
                        <th>Detailer</th>
                        <th>Periode</th>
                        <th>Dispensing</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($outlet['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->nama_outlet; ?></td>
                        <td><?php echo $value->kota; ?></td>
                        <td>(<?php echo $value->alias_distributor; ?>) <?php echo $value->nama_distributor; ?></td>
                        <td><?php echo $value->nama_detailer; ?></td>
                        <?php $periode = date('d-M-Y', strtotime($value->periode)); ?>
                        <td><?php echo $periode; ?></td>
                        <td><?php echo $value->dispensing; ?></td>
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
              <h4 class="card-title" id="horz-layout-basic">Add Outlet</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah Outlet baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-outlet" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 offset-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Kode Customer</label><br />
                          <?php $this->session->set_userdata('id_outlet', $id); ?>
                          <span class="tag tag-lg tag-success"><?php echo strtoupper($id); ?></span>
                        </div>
                        <!-- /id -->
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Area</label>
                            <select name="id_area" class="form-control select2" required>
                              <option value="" selected disabled>Pilih Area</option>
                              <?php if ($area['data']->num_rows() < 1): ?>
                              <option value="" disabled>Jenis Area belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($area['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo $value->nama; ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Distributor</label>
                            <select name="id_distributor" class="form-control select2" required>
                              <option value="" selected disabled>Pilih Distributor</option>
                              <?php if ($distributor['data']->num_rows() < 1): ?>
                              <option value="" disabled>Distributor belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($distributor['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) <?php echo $value->nama; ?> (<?php echo $value->alias_distributor; ?>)</option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <!-- /id-area /id-distributor -->
                        <div class="form-group">
                          <label class="label-control">Detailer</label>
                          <select name="id_detailer" class="form-control select2">
                            <option value="" selected disabled>Pilih Detailer</option>
                            <?php if ($detailer['data']->num_rows() < 1): ?>
                            <option value="" disabled>Detailer belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($detailer['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-detailer -->
                        <div class="form-group">
                          <label class="label-control">Periode</label>
                          <input type="date" name="periode" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <!-- /periode -->
                        <div class="form-group">
                          <label class="label-control">Nama</label>
                          <input type="text" name="nama" class="form-control border-primary" required>
                        </div>
                        <!-- /nama -->
                        <div class="form-group">
                          <label class="label-control">Alamat</label>
                          <textarea name="alamat" cols="3" rows="3" class="form-control border-primary"></textarea>
                        </div>
                        <!-- /alamat -->
                        <div class="form-group">
                          <label class="label-control">Kota</label>
                          <input type="text" name="kota" class="form-control border-primary">
                        </div>
                        <!-- /kota -->
                        <div class="form-group">
                          <label class="label-control">NPWP</label>
                          <input type="text" maxlength="15" name="npwp" class="form-control border-primary">
                        </div>
                        <!-- /npwp -->
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Segmen</label>
                            <select name="segmen" class="form-control select2" required>
                              <option value="a">A</option>
                              <option value="b">B</option>
                              <option value="c">C</option>
                            </select>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Dispensing</label>
                            <select name="dispensing" class="form-control select2" required>
                              <option value="n">No</option>
                              <option value="y">Yes</option>
                            </select>
                          </div>
                        </div>
                        <!-- /segmen /dispensing -->
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

