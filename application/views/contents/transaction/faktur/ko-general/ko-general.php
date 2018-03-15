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

      <!-- form -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-red">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Faktur KO General</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <form action="#" method="POST" class="form" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">1. Identitas Faktur</h5>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">2. Pemohon</h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <h5 class="form-section">3. Informasi KO</h5>
                      </div>
                    </div>
                    <div class="card-text">
                      <p>Dengan hormat,<br />melalui surat ini kami bermaksud untuk mengajukan permohonan diskon untuk outlet:</p>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover table-xs">
                            <thead>
                              <tr>
                                <th rowspan="2">Outlet</th>
                                <th rowspan="2">Produk</th>
                                <th rowspan="2">Jumlah</th>
                                <th colspan="3">Kondisi On Faktur</th>
                                <th colspan="3">Kondisi Off Faktur</th>
                                <th rowspan="2">Keterangan</th>
                              </tr>
                              <tr>
                                <th>Distributor</th>
                                <th>NF</th>
                                <th>Total</th>
                                <th>Distributor</th>
                                <th>NF</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <select name="id_outlet[]" class="form-control select2" required>
                                    <option value="" selected disabled>Pilih Outlet</option>
                                    <option value=""></option>
                                  </select>
                                </td>
                                <td>
                                  <select name="id_produk[]" class="form-control select2" required>
                                    <option value="" selected disabled>Pilih Produk</option>
                                    <option value=""></option>
                                  </select>
                                </td>
                                <td>
                                  <input type="text" name="jumlah[]" class="form-control border-primary" required>
                                </td>
                                <td>
                                  <fieldset>
                                    <div class="input-group">
                                      <span class="input-group-addon">%</span>
                                      <input type="text" name="on_diskon_distributor[]" class="form-control border-primary" required>
                                    </div>
                                  </fieldset>
                                </td>
                                <td>
                                  <fieldset>
                                    <div class="input-group">
                                      <span class="input-group-addon">%</span>
                                      <input type="text" name="on_nf[]" class="form-control border-primary" required>
                                    </div>
                                  </fieldset>
                                </td>
                                <td>
                                  <fieldset>
                                    <div class="input-group">
                                      <span class="input-group-addon">%</span>
                                      <input type="text" name="on_total[]" class="form-control border-primary" required>
                                    </div>
                                  </fieldset>
                                </td>
                                <td>
                                  <fieldset>
                                    <div class="input-group">
                                      <span class="input-group-addon">%</span>
                                      <input type="text" name="off_diskon_distributor[]" class="form-control border-primary" required>
                                    </div>
                                  </fieldset>
                                </td>
                                <td>
                                  <fieldset>
                                    <div class="input-group">
                                      <span class="input-group-addon">%</span>
                                      <input type="text" name="off_nf[]" class="form-control border-primary" required>
                                    </div>
                                  </fieldset>
                                </td>
                                <td>
                                  <fieldset>
                                    <div class="input-group">
                                      <span class="input-group-addon">%</span>
                                      <input type="text" name="off_total[]" class="form-control border-primary" required>
                                    </div>
                                  </fieldset>
                                </td>
                                <td>
                                  <textarea name="keterangan[]"  rows="3" class="form-control border-primary" required></textarea>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <h5 class="form-section">4. KO On &amp; Off Faktur</h5>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="table-responsive">
                          <table class="table table-bordered table-xs display nowrap">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>CN</th>
                                <th>%</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1.</td>
                                <td>
                                  <input type="text" name="cn[]" id="" class="form-control border-primary">
                                </td>
                                <td>
                                  <div class="input-group">
                                    <input type="text" name="diskon[]" id="" class="form-control border-primary">
                                    <span class="input-group-addon">%</span>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="card-text">
                          <p>Demikian surat ini kami sampaikan. Bila surat ini sudah disetujui harap fax ke pihak <strong>distributor</strong>.</p>
                          <p>Atas perhatian Bapak, kami sampaikan terima kasih.</p>
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

