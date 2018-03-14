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
              <h4 class="card-title" id="horz-layout-basic">Subdistributor</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-hover table-xs border-top-blue display nowrap" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Area</th>
                        <th>Nama</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($subdistributor['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo $value->id; ?></td>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->nama_subdist; ?></td>
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
        <div class="col-md-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Add Subdistributor</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah subdistributor baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-subdistributor" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="form-group">
                      <label class="label-control">Kode Subdist</label><br />
                      <?php $this->session->set_userdata('id_subdist', $id_subdist); ?>
                      <span class="tag tag-lg tag-success"><?php echo strtoupper($id_subdist); ?></span>
                    </div>
                    <!-- /id-subdist -->
                    <div class="form-group">
                      <label class="label-control">Nama</label>
                      <input type="text" name="nama" class="form-control border-primary" required>
                    </div>
                    <!-- /nama -->
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
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-warning">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Add Target</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah target subdistributor baru</p>
                </div>
                <div class="bs-callout-danger callout-border-right mb-1 p-1">
                  <strong>Perhatian!</strong>
                  <p>Sebelum mengisi target subdistributor, pastikan anda telah mengisi data subdistributor melalui formulir di sebelah kiri.</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-subdistributorEkstern" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="form-group">
                      <label class="label-control">Kode Target</label><br />
                      <?php $this->session->set_userdata('id_sks', $id_sks); ?>
                      <span class="tag tag-lg tag-success"><?php echo strtoupper($id_sks); ?></span>
                    </div>
                    <!-- /id-sks -->
                    <div class="form-group">
                      <label class="label-control">Sudist</label>
                      <select name="id_subdist" class="form-control select2" required>
                        <option value="" selected disabled>Pilih subdistributor</option>
                        <?php if ($subdistributor['data']->num_rows() < 1): ?>
                        <option value="" disabled>Sudist belum tersedia</option>
                        <?php else: ?>
                        <?php foreach ($subdistributor['data']->result() as $value): ?>
                        <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) <?php echo $value->nama_subdist; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                    <!-- /id-subdist -->
                    <div class="form-group">
                      <label class="label-control">User</label>
                      <select name="id_customer" class="form-control select2" required>
                        <option value="" selected disabled>Pilih user</option>
                        <?php if ($user['data']->num_rows() < 1): ?>
                        <option value="" disabled>User belum tersedia</option>
                        <?php else: ?>
                        <?php foreach ($user['data']->result() as $value): ?>
                        <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo $value->jenis; ?> -  <?php echo $value->nama; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                    <!-- /id-customer -->
                    <div class="form-group row">
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Produk</label>
                          <select name="id_produk" class="form-control select2" required>
                            <option value="" selected disabled>Pilih user</option>
                            <?php if ($produk['data']->num_rows() < 1): ?>
                            <option value="" disabled>User belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($produk['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->nama); ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                          <label class="label-control">Target</label>
                          <input type="text" name="target" class="form-control border-primary" required>
                      </div>
                    </div>
                    <!-- /id-produk /target -->                    
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