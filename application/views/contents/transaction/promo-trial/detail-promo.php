<?php $status = null; ?>
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
        <div class="col-md-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Produk Promo</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-hover table-xs border-top-blue display nowrap" id="simple-table">
                    <thead>
                      <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jumlah<br />(unit)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($produk['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id_produk); ?></td>
                        <td><?php echo strtoupper($value->nama); ?></td>
                        <td><?php echo $value->jumlah; ?></td>
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

        <!-- /form -->
        <div class="col-md-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Approval Form</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir verifikasi promo trial</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-promo/approve" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <?php foreach ($detail['data']->result() as $value): ?>
                      <div class="col-xs-12">
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">No. Promo</label><br />
                            <?php $no_promo = str_replace('-', '/', $value->no_promo); ?>
                            <?php $this->session->set_userdata('no_promo', $value->no_promo); ?>
                            <?php $this->session->set_userdata('id_promo', $value->id); ?>
                            <span class="tag tag-xl tag-success"><?php echo strtoupper($no_promo); ?></span>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Status</label><br />
                            <?php $status = $value->status; ?>
                            <span class="tag tag-xl tag-warning"><?php echo $value->status; ?></span>
                          </div>
                        </div>
                        <!-- /no-promo -->
                        <div class="form-group">
                          <label class="label-control">Detailer</label><br />
                          <input type="text" class="form-control border-primary" value="<?php echo $value->nama_detailer; ?>" disabled>
                        </div>
                        <!-- /detailer -->
                        <div class="form-group">
                          <label class="label-control">Customer</label><br />
                          <input type="text" class="form-control border-primary" value="<?php echo $value->nama_customer; ?>" disabled>
                        </div>
                        <!-- /customer -->
                        <div class="form-group">
                          <label class="label-control">Keterangan</label><br />
                          <textarea rows="3" class="form-control border-primary" disabled><?php echo $value->keterangan; ?></textarea>
                        </div>
                        <!-- /keterangan -->
                      </div>
                      <?php endforeach; ?>
                      <?php if ($status != 'approved'): ?>                        
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Approve</label>
                          <select name="status" class="form-control border-primary">
                            <option value="" selected disabled>Pilih status</option>
                            <option value="waiting">Waiting</option>
                            <option value="approved">Approve</option>
                          </select>
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php if ($status != 'approved'): ?>                        
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-warning">Batal</button>
                  </div>
                  <?php endif; ?>
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