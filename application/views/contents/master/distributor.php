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

      <div class="row">
        <!-- table -->
        <div class="col-sm-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Distributor</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-hover table-xs border-top-blue display nowrap" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Area</th>
                        <th>(Jenis) Nama</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($distributor['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo $value->id; ?></td>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                        <td>(<?php echo $value->jenis; ?>) - <?php echo $value->nama_distributor; ?></td>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /table -->

        <!-- form -->
        <div class="col-sm-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Add Distributor</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah distributor baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-distributor" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Nama</label>
                          <input type="text" name="nama" class="form-control border-primary" required>
                        </div>
                        <!-- /nama -->
                        <div class="form-group">
                          <label class="label-control">Jenis Distributor</label>
                          <select name="id_master" class="form-control select2" required>
                            <option value="" selected disabled>Pilih jenis distributor</option>
                            <?php if ($jenis['data']->num_rows() < 1): ?>
                            <option value="" disabled>Jenis distributor belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($jenis['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->alias_distributor; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-master -->
                        <div class="form-group">
                          <label class="label-control">Area</label>
                          <select name="id_area" class="form-control select2" required>
                            <option value="" selected disabled>Pilih area</option>
                            <?php if ($area['data']->num_rows() < 1): ?>
                            <option value="" disabled>Area belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($area['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) <?php echo $value->nama; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-area -->
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
        <!-- /form -->
      </div>

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