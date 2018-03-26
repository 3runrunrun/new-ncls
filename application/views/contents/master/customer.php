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
              <h4 class="card-title" id="horz-layout-basic">Customer</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Area</th>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Location of Practice</th>
                        <th>RM</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($customer['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                        <td><?php echo $value->nama; ?></td>
                        <td><?php echo $value->spesialis; ?></td>
                        <td>(<?php echo $value->id_outlet; ?>) <?php echo $value->nama_outlet; ?></td>
                        <td><?php echo $value->nama_rm; ?></td>
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
              <h4 class="card-title" id="horz-layout-basic">Add Customer</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>New customer submission form</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-customer" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 offset-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Customer Id</label><br />
                          <?php $this->session->set_userdata('id_customer', $id); ?>
                          <span class="tag tag-lg tag-success"><?php echo strtoupper($id); ?></span>
                        </div>
                        <!-- /id -->
                        <div class="form-group">
                          <label class="label-control">Name</label>
                          <input type="text" name="nama" class="form-control border-primary" required>
                        </div>
                        <!-- /nama -->
                        <div class="form-group">
                          <label class="label-control">Specialty</label>
                          <input type="text" name="spesialis" class="form-control border-primary" required>
                        </div>
                        <!-- /spesialis -->
                        <div class="form-group">
                          <label class="label-control">Location of Practice</label>
                          <select name="id_outlet" class="form-control select2">
                            <option value="" selected disabled>Choose location (outlet)</option>
                            <?php if ($outlet['data']->num_rows() < 1): ?>
                            <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                            <?php foreach ($outlet['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->jenis; ?> - <?php echo $value->nama_outlet; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /lokasi-praktek -->
                        <div class="form-group">
                          <label class="label-control">Area</label>
                          <select name="id_area" class="form-control select2" required>
                            <option value="" selected disabled>Choose area</option>
                            <?php if ($area['data']->num_rows() < 1): ?>
                            <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                            <?php foreach ($area['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-area -->
                        <div class="form-group">
                          <label class="label-control">RM</label>
                          <select name="id_rm" class="form-control select2">
                            <option value="" selected disabled>Choose RM</option>
                            <?php if ($rm['data']->num_rows() < 1): ?>
                            <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                            <?php foreach ($rm['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-rm -->
                        <div class="form-group">
                          <label class="label-control">Address</label>
                          <textarea name="alamat" cols="3" rows="10" class="form-control border-primary"></textarea>
                        </div>
                        <!-- /alamat -->
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
        "order": [[ 0, "desc" ]],
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

