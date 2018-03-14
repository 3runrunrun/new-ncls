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
              <h4 class="card-title" id="horz-layout-basic">Ekstensifikasi Intensifikasi</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-hover table-xs border-top-blue display nowrap" id="simple-table">
                    <thead>
                      <tr>
                        <th>Detailer</th>
                        <th>Target<br />(penjualan)</th>
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
        <div class="col-md-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Ekstensifikasi</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir ekstensifikasi sales detailer</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-eksten" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="form-group">
                      <label class="label-control">Tanggal</label>
                      <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                      <label class="label-control">Detailer</label>
                      <select name="id_detailer" class="form-control select2" required>
                        <option value="" selected disabled>Pilih detailer</option>
                        <?php if ($detailer['data']->num_rows() < 1): ?>
                        <option value="" disabled>Detailer belum tersedia</option>
                        <?php else: ?>
                        <?php foreach ($detailer['data']->result() as $value): ?>
                        <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) <?php echo $value->nama; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                    <!-- /id-detailer -->
                    <div class="form-group row div-repeat">
                      <div class="col-md-6 col-xs-12 mb-1">
                      <label class="label-control">Outlet</label>
                      <select name="id_outlet[]" class="form-control select2" required>
                        <option value="" selected disabled>Pilih outlet</option>
                      </select>
                      </div>
                      <div class="col-md-6 col-xs-12 mb-1">
                        <label class="label-control">Customer</label>
                        <select name="id_customer[]" class="form-control select2" required>
                          <option value="" selected disabled>Pilih customer</option>
                        </select>
                      </div>
                      <div class="col-md-2 col-xs-12">
                        <label class="label-control">Pertemuan</label>
                        <input type="number" name="pertemuan[]" class="form-control border-primary" min="0">
                      </div>
                      <div class="col-md-4 col-xs-12">
                        <label class="label-control">Dana</label>
                        <fieldset>
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="number" name="dana[]" class="form-control border-primary" min="0">
                          </div>
                        </fieldset>
                      </div>
                      <div class="col-md-4 col-xs-12">
                        <label class="label-control">Biaya</label>
                        <fieldset>
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="number" name="biaya[]" class="form-control border-primary" min="0">
                          </div>
                        </fieldset>
                        <p>*) Rerata per pasien</p>
                      </div>
                      <div class="col-md-1 col-xs-12 del-repeater">
                        <label class="label-control">Biaya</label>
                        <button class="btn btn-danger" type="button" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /id-outlet /id-customer /pertemuan /dana /biaya -->
                    <div id="repeater-out"></div>
                    <div class="row">
                      <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                          <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Tambah COGM</button>
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
        <div class="col-md-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Intensifikasi</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir intensifikasi</p>
                </div>
                <div class="bs-callout-danger callout-border-right mb-1 p-1">
                  <strong>Perhatian!</strong>
                  <p>Sebelum mengisi intensifikasi, pastikan anda telah mengisi data ekstensifikasi melalui formulir di sebelah kiri.</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-intens" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="form-group">
                      <label class="label-control">Kode Intensifikasi</label><br />
                      <?php $this->session->set_userdata('id_intens', $id_intens); ?>
                      <span class="tag tag-lg tag-success"><?php echo strtoupper($id_intens); ?></span>
                    </div>
                    <!-- /id-sks -->                
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