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
              <h4 class="card-title" id="horz-layout-basic">Pemindan</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <?php foreach ($detail['data']->result() as $value): ?>
                <?php $status = $value->status; ?>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <h4 class="card-title info">Dari</h4>
                    <div class="card-text">
                      <h5>Detailer: (<?php echo strtoupper($value->id_detailer_dari); ?>) <?php echo ucwords($value->nama_detailer_dari); ?></h5>
                      <h5>Supervisor: (<?php echo strtoupper($value->id_spv_dari); ?>) <?php echo ucwords($value->nama_spv_dari); ?></h5>
                      <h5>Outlet: (<?php echo strtoupper($value->id_outlet_dari); ?>) <?php echo ucwords($value->nama_outlet_dari); ?></h5>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <h4 class="card-title success">Ke</h4>
                    <div class="card-text">
                      <h5>Detailer: (<?php echo strtoupper($value->id_detailer_ke); ?>) <?php echo ucwords($value->nama_detailer_ke); ?></h5>
                      <h5>Supervisor: (<?php echo strtoupper($value->id_spv_ke); ?>) <?php echo ucwords($value->nama_spv_ke); ?></h5>
                      <h5>Outlet: (<?php echo strtoupper($value->id_outlet_ke); ?>) <?php echo ucwords($value->nama_outlet_ke); ?></h5>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
                <br />
                <div class="table-responsive">
                  <table class="table table-hover table-xs border-top-blue display nowrap">
                    <thead>
                      <tr>
                        <th>Kode Produk</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($produk['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id_produk); ?></td>
                        <td><?php echo ucwords($value->nama_produk); ?></td>
                        <td><?php echo $value->jumlah; ?></td>
                      </tr>
                      <?php endforeach; ?>
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
              <h4 class="card-title" id="horz-layout-basic">Information Form</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <form action="<?php echo site_url(); ?>/store-pemindahan-sales/approve" class="form" method="POST" role="form">
                  <div class="form-body">
                    <?php foreach ($detail['data']->result() as $value): ?>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Tanggal Pengajuan</label><br />
                          <?php $tanggal = ($value->tanggal !== null) ? date('d-M-Y', strtotime($value->tanggal)) : '-' ; ?>
                          <span class="tag tag-lg info"><?php echo $tanggal; ?></span>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Periode</label><br />
                          <?php $periode = ($value->periode !== null) ? date('d-M-Y', strtotime($value->periode)) : '-' ; ?>
                          <span class="tag tag-lg info"><?php echo $periode; ?></span>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Tanggal Persetujuan Spv</label><br />
                          <?php $tgl_spv = ($value->tgl_spv !== null) ? date('d-M-Y', strtotime($value->tgl_spv)) : '-' ; ?>
                          <span class="tag tag-lg info"><?php echo $tgl_spv; ?></span>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Tanggal Persetujuan RM</label><br />
                          <?php $tgl_rm = ($value->tgl_rm !== null) ? date('d-M-Y', strtotime($value->tgl_rm)) : '-' ; ?>
                          <span class="tag tag-lg info"><?php echo $tgl_rm; ?></span>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="row">
                      <?php if ($status != 'approved' && $approve === 'approve'): ?>
                      <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Approver</label>
                          <select name="id_approver" class="form-control select2">
                            <option value="" selected disabled>Pilih Approver (Spv)</option>
                            <?php if ($detailer['data']->num_rows() < 1): ?>
                            <option value="" disabled>Belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($detailer['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo strtoupper($value->alias_area); ?> - <?php echo strtoupper($value->id); ?> - <?php echo strtoupper($value->nama_detailer); ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="label-control">Approve</label>
                          <select name="status" class="form-control border-primary" required>
                            <option value="" selected disabled>Pilih status</option>
                            <option value="waiting">Waiting</option>
                            <option value="spv">Approve (SPV)</option>
                            <option value="approved">Approve (RM)</option>
                          </select>
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php if ($status != 'approved' && $approve === 'approve'): ?>
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