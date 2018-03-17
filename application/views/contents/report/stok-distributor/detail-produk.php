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
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Permohonan Produk</h4>
            </div>
            <form action="<?php echo site_url(); ?>/store-product-distributor/approve" class="form" method="POST" role="form">
              <div class="card-body">
                <div class="card-block">
                  <div class="table-responsive">
                    <table class="table table-hover table-xs border-top-blue display nowrap">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Batch Number</th>
                          <th>Expired</th>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $count = 0; ?>
                        <?php foreach ($produk['data']->result() as $value): ?>
                        <tr>
                          <td><?php echo $count += 1; ?></td>
                          <td>
                            <?php if ($value->batch_number === null && $approve !== null): ?>
                            <div class="card-block width-200">
                              <input type="text" name="batch_number[]" class="form-control border-primary" placeholder="Batch Number" required>
                            </div>
                            <?php else: ?>
                              <?php echo $value->batch_number; ?>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php if ($value->expired === null && $approve !== null): ?>
                            <div class="card-block width-200">
                              <input type="date" name="expired[]" class="form-control border-primary" placeholder="Expired" required>
                            </div>
                            <?php else: ?>
                              <?php echo $value->expired; ?>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php echo strtoupper($value->id_produk); ?>  
                            <input type="hidden" name="id_produk[]" value="<?php echo $value->id_produk; ?>">
                          </td>
                          <td><?php echo strtoupper($value->nama); ?></td>
                          <td>
                            <?php echo $value->jumlah; ?>
                            <input type="hidden" name="jumlah[]" value="<?php echo $value->jumlah; ?>">
                          </td>
                        </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="card-header">
                <h4 class="card-title" id="horz-layout-basic">Information Form</h4>
              </div>
              <div class="card-body">
                <div class="card-block">
                  <div class="card-text">
                    <p>Informasi permohonan barang Nucleus - Distributor</p>
                  </div>
                  <div class="form-body">
                    <?php $status = null; ?>
                    <?php foreach ($detail['data']->result() as $value): ?>    
                    <input type="hidden" name="id" value="<?php echo $value->id; ?>" >
                    <div class="row">
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Tanggal Permohonan</label>
                          <input type="text" class="form-control border-primary" value="<?php echo date('d-M-Y', strtotime($value->tanggal)); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Distributor</label><br />
                          <?php if ($value->status_permohonan !== 'delivered' && $approve !== null): ?>
                          <input type="hidden" name="id_distributor" value="<?php echo $value->id_distributor; ?>">
                          <?php endif ?>
                          <span class="tag tag-lg tag-primary">(<?php echo strtoupper($value->alias_area); ?>) - <?php echo strtoupper($value->alias_distributor); ?> - <?php echo strtoupper($value->nama_distributor); ?></span>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Status</label><br />
                          <span class="tag tag-lg tag-warning"><?php echo strtoupper($value->status_permohonan); ?></span>                          
                        </div>
                      </div>
                      <?php if ($value->status_permohonan !== 'delivered' && $approve !== null): ?>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Status</label>
                          <select name="status" class="form-control border-primary">
                            <option value="" selected disabled>Pilih status</option>
                            <option value="waiting">Waiting</option>
                            <option value="delivered">Delivered</option>
                          </select>
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <?php if ($value->status_permohonan !== 'delivered' && $approve !== null): ?>
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-warning">Batal</button>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /table -->

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('table th, table td').css({
      'text-align': 'center',
      'vertical-align': 'middle',
    });
  });
</script>