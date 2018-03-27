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
              <h4 class="card-title" id="horz-layout-basic">Extensification &amp; Intensification</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-hover table-xs border-top-blue display nowrap" id="simple-table">
                    <thead>
                      <tr>
                        <th>Extent Id</th>
                        <th>Area</th>
                        <th>Detailer</th>
                        <th>Outlet</th>
                        <th>Customer</th>
                        <th>Produk</th>
                        <th>Target<br />(unit)</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($ekstensifikasi['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->nama_detailer; ?></td>
                        <td><?php echo $value->nama_outlet; ?></td>
                        <td><?php echo $value->nama_customer; ?></td>
                        <td><?php echo $value->nama_produk; ?></td>
                        <td><?php echo $value->target; ?></td>
                        <td>
                          <div class="btn-group-vertical">
                            <a href="<?php echo site_url(); ?>/detail-intens/<?php echo $value->id_detailer; ?>" target="_blank" class="btn btn-primary">Detail</a>
                            <a href="<?php echo site_url(); ?>/detailer-intens/<?php echo $value->id; ?>" class="btn btn-success">Intensification</a>
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
              <h4 class="card-title" id="horz-layout-basic">Extensification</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Detailer extensification form</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-eksten" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="form-group">
                      <label class="label-control">Date</label>
                      <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                      <label class="label-control">Detailer</label>
                      <select name="id_detailer" class="form-control select2" required>
                        <option value="" selected disabled>Choose detailer</option>
                        <?php if ($detailer['data']->num_rows() < 1): ?>
                        <option value="" disabled>Unavailable</option>
                        <?php else: ?>
                        <?php foreach ($detailer['data']->result() as $value): ?>
                        <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - (<?php echo $value->alias_area; ?>) - <?php echo $value->nama_detailer; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                    <!-- /id-detailer -->
                    <h5 class="form-section">Target</h5>
                    <div class="form-group row div-repeat">
                      <div class="col-md-6 col-xs-12 mb-1">
                        <label class="label-control">Outlet</label>
                        <select name="id_outlet[]" class="form-control select2" required>
                          <option value="" selected disabled>Choose outlet</option>
                          <?php if ($outlet['data']->num_rows() < 1): ?>
                          <option value="" disabled>Unavailable</option>
                          <?php else: ?>
                          <?php foreach ($outlet['data']->result() as $value): ?>
                          <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - (<?php echo $value->alias_area; ?>) - <?php echo $value->nama_outlet; ?></option>
                          <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                        <p>*) Check the <strong>outlets information</strong> in <a href="<?php echo site_url(); ?>/master-outlet" class="primary" target="_blank">this page</a>.</p>
                      </div>
                      <div class="col-md-6 col-xs-12 mb-1">
                        <label class="label-control">Customer</label>
                        <select name="id_customer[]" class="form-control select2" required>
                          <option value="" selected disabled>Choose customer</option>
                          <?php if ($customer['data']->num_rows() < 1): ?>
                          <option value="" disabled>Unavailable</option>
                          <?php else: ?>
                          <?php foreach ($customer['data']->result() as $value): ?>
                          <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - (<?php echo $value->alias_area; ?>) - <?php echo $value->jenis; ?> - <?php echo $value->nama; ?></option>
                          <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                        <p>*) Check the <strong>customers information</strong> in <a href="<?php echo site_url(); ?>/master-customer" class="primary" target="_blank">this page</a>.</p>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <label class="label-control">Product</label>
                        <select name="id_produk[]" class="form-control select2" required>
                          <option value="" selected disabled>Choose produk</option>
                          <?php if ($produk['data']->num_rows() < 1): ?>
                          <option value="" disabled>Unavailable</option>
                          <?php else: ?>
                          <?php foreach ($produk['data']->result() as $value): ?>
                          <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama); ?></option>
                          <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                      <div class="col-md-6 col-xs-12 mb-1">
                        <label class="label-control">Target (unit)</label>
                        <input type="number" name="target[]" class="form-control border-primary" min="0">
                      </div>
                      <div class="col-md-2 col-xs-12">
                        <label class="label-control">Encounter (pertemuan)</label>
                        <input type="number" name="pertemuan[]" class="form-control border-primary" min="0">
                      </div>
                      <div class="col-md-4 col-xs-12">
                        <label class="label-control">Cost</label>
                        <fieldset>
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="number" name="dana[]" class="form-control border-primary" min="0">
                          </div>
                        </fieldset>
                      </div>
                      <div class="col-md-5 col-xs-12">
                        <label class="label-control">Med Cost (per patient)</label>
                        <fieldset>
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="number" name="biaya[]" class="form-control border-primary" min="0">
                          </div>
                        </fieldset>
                        <p>*) Average (per patient)</p>
                      </div>
                      <div class="col-md-1 col-xs-12 del-repeater">
                        <label class="label-control">Biaya</label><br />
                        <button class="btn btn-danger" type="button" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /id-outlet /id-customer /pertemuan /dana /biaya -->
                    <div id="repeater-out"></div>
                    <div class="row">
                      <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                          <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Add target</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-warning">Cancel</button>
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
        "order": [[0, "desc"]],
      });
    $('#simple-table_filter').css({
      'text-align': 'center',
    });
    $('#simple-table_wrapper').children(':first').children(':first').remove();
    $('#simple-table_filter').parent().addClass('col-xs-12').removeClass('col-md-6');
    $('#simple-table_filter > label > input').addClass('input-md').removeClass('input-sm').attr({
        placeholder: 'Keyword',
      });
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