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
              <h4 class="card-title" id="horz-layout-basic">Faktur KO Tender</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <form action="#" method="POST" class="form" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">1. Identitas Faktur</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">SP</label>
                            <input type="text" name="sp" class="form-control border-primary" required>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">No. Faktur</label><br />
                            <span class="tag tag-success tag-lg">faktur</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">2. Pemohon</h5>
                        <div class="form-group">
                          <label class="label-control">Detailer</label>
                          <select name="id_detailer" class="form-control select2" required>
                            <option value="" selected disabled>Pilih detalier</option>
                            <option value=""></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <h5 class="form-section">3. Informasi KO</h5>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Tanggal</label>
                          <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Distributor</label>
                          <select name="id_distributor" class="form-control select2" required>
                            <option value="" selected disabled>Pilih Distributor</option>
                            <option value=""></option>
                          </select>
                          <fieldset class="mt-1">
                            <label class="custom-control custom-checkbox">
                              <input type="checkbox" name="subdist" class="custom-control-input" value="y">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">Subdistributor</span>
                            </label>
                          </fieldset>
                          <p>Centang kolom diatas apabila KO diajukan oleh subdistributor</p>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">RM (Mengetahui)</label>
                          <select name="id_rm" class="form-control select2" required>
                            <option value="" selected disabled>Pilih RM</option>
                            <option value=""></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Direktur (Menyetujui)</label>
                          <select name="id_direktur" class="form-control select2" required>
                            <option value="" selected disabled>Pilih Direktur</option>
                            <option value=""></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="card-text">
                      <p>Dengan hormat,<br />melalui surat ini kami bermaksud untuk mengajukan permohonan diskon untuk outlet:</p>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table class="table table-bordered table-xs" id="simple-table">
                            <thead>
                              <tr>
                                <th rowspan="2">Outlet</th>
                                <th rowspan="2">Produk</th>
                                <th rowspan="2">Jumlah</th>
                                <th colspan="3">Kondisi On Faktur</th>
                                <th colspan="3">Kondisi Off Faktur</th>
                                <th rowspan="2" colspan="2">Keterangan</th>
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
                              <tr class="div-repeat">
                                <td>
                                  <div class="card-block width-300">
                                    <select name="id_outlet[]" class="form-control select2" required>
                                      <option value="" selected disabled>Pilih Outlet</option>
                                      <option value=""></option>
                                    </select>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-300">
                                    <select name="id_produk[]" class="form-control select2" required>
                                      <option value="" selected disabled>Pilih Produk</option>
                                      <option value=""></option>
                                    </select>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-200">
                                    <input type="text" name="jumlah[]" class="form-control border-primary" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="on_diskon_distributor[]" class="form-control border-primary" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="on_nf[]" class="form-control border-primary" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="on_total[]" class="form-control border-primary" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="off_diskon_distributor[]" class="form-control border-primary" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="off_nf[]" class="form-control border-primary" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="off_total[]" class="form-control border-primary" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-200">
                                    <textarea name="keterangan[]"  rows="3" class="form-control border-primary" required></textarea>
                                  </div>
                                </td>
                                <td class="del-repeater">
                                  <div class="card-block width-100">
                                    <button class="btn btn-danger btn-lg" type="button" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                            <tbody id="repeater-out"></tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-1">
                      <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                          <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <h5 class="form-section">4. KO On &amp; Off Faktur</h5>
                      </div>
                      <div class="col-md-8 col-xs-12">
                        <div class="table-responsive height-200">
                          <table class="table table-xs display nowrap" id="simple-table-2">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>CN</th>
                                <th colspan="2">%</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="div-repeat-2">
                                <td>
                                  <div class="card-block width-50 count-repeater">1</div>
                                </td>
                                <td>
                                  <div class="card-block">
                                    <input type="text" name="cn[]" id="" class="form-control border-primary" required>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block">
                                    <div class="input-group">
                                      <input type="text" name="diskon[]" id="" class="form-control border-primary" required>
                                      <span class="input-group-addon">%</span>
                                    </div>
                                  </div>
                                </td>
                                <td class="del-repeater-2">
                                  <div class="card-block width-100">
                                    <button class="btn btn-danger" type="button" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                            <tbody id="repeater-out-2"></tbody>
                          </table>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-xs">
                            <tfoot>
                              <tr>
                                <td>
                                  <div class="card-block width-200"><strong>Total</strong></div>
                                </td>
                                <td>
                                  <div class="card-block width-200 pull-right">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="number" name="total" class="form-control border-primary" placeholder="Total" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <div class="row">
                          <div class="col-md-2 col-xs-12">
                            <div class="form-group">
                              <button type="button" id="add-repeater-2" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-12">
                        <div class="card-text">
                          <p>Demikian surat ini kami sampaikan. Bila surat ini sudah disetujui harap fax ke pihak <strong>distributor</strong>.</p>
                          <p>Atas perhatian Bapak, kami sampaikan terima kasih.</p>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-1">
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
    $('#simple-table-2 th, #simple-table-2 td').css({
      'text-align': 'center',
    });
    $('#simple-table-2 td').addClass('text-truncate');
    $('#simple-table-2 td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.del-repeater:first').hide();

    $('#add-repeater').click(function(){
      $('.div-repeat:first select').select2('destroy');
      $('.div-repeat:first').clone().appendTo('#repeater-out');
      $('.div-repeat .select2').select2();
      $('#repeater-out .del-repeater').show();
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.del-repeater-2:first').hide();

    $('#add-repeater-2').click(function(){
      var count = parseInt($('.div-repeat-2:last .count-repeater').text());

      $('.div-repeat-2:first select').select2('destroy');
      $('.div-repeat-2:first').clone().appendTo('#repeater-out-2');
      $('.div-repeat-2 .select2').select2();
      $('#repeater-out-2 .del-repeater-2').show();

      console.log($('.div-repeat-2:last > .count-repeater').text());

      $('.div-repeat-2:last .count-repeater').text(count + 1);
    });
  });
</script>