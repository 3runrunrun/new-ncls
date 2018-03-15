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
              <h4 class="card-title" id="horz-layout-basic">Weekly Promotion Report</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-hover table-xs display nowrap">
                    <tbody>
                      <?php foreach ($detail['data']->result() as $value): ?>
                      <tr>
                        <th width="10%">Nama</th>
                        <th width="3%">:</th>
                        <td><?php echo $value->detailer; ?></td>
                      </tr>
                      <tr>
                        <th width="10%">Area</th>
                        <th width="3%">:</th>
                        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div class="card-text mt-2">
                    <p>Berikut merupakan daftar permintaan dana promosi yang diajukan:</p>
                  </div>
                  <table class="table table-hover table-xs border-top-blue display nowrap">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Dokter</th>
                        <th>SPS</th>
                        <th colspan="2">Periode</th>
                        <th>Value</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($request['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo $value->nama_user; ?></td>
                        <td><?php echo $value->nama_user; ?></td>
                        <td><?php echo $value->spesialis; ?></td>
                        <td><?php echo $value->dari; ?></td>
                        <td><?php echo $value->sampai; ?></td>
                        <td><?php echo $value->dana; ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-block">
                <form class="form">
                  <?php foreach ($request['data']->result() as $value): ?>
                  <div class="form-body">
                    <div class="form-group row">
                      <div class="col-md-6 col-xs-12">
                        <label class="label-control">Bank</label>
                        <input type="text" class="form-control border-primary" value="<?php echo $value->bank; ?>" disabled>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <label class="label-control">No. Rekening</label>
                        <input type="text" class="form-control border-primary" value="<?php echo $value->norek; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6 col-xs-12">
                        <label class="label-control">Atas Nama</label>
                        <input type="text" class="form-control border-primary" value="<?php echo $value->atas_nama; ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </form>
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
                  <p>Formulir verifikasi WPR</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-wpr/approve" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <?php foreach ($detail['data']->result() as $value): ?>
                      <div class="col-xs-12">
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">No. WPR</label><br />
                            <?php $status = $value->status; ?>
                            <?php if ($status != 'approved'): ?>
                            <?php $this->session->set_userdata('id_wpr', $value->id); ?>
                            <?php endif; ?>
                            <?php $no_wpr = str_replace('-', '/', $value->no_wpr); ?>
                            <span class="tag tag-xl tag-success"><?php echo strtoupper($no_wpr); ?></span>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Status</label><br />
                            <span class="tag tag-xl tag-warning"><?php echo $value->status; ?></span>
                          </div>
                        </div>
                        <!-- /no-promo -->
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Supervisor</label>
                            <input type="text" class="form-control border-primary" value="<?php echo $value->supervisor; ?>" disabled>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Direktur</label>
                            <input type="text" class="form-control border-primary" value="<?php echo $value->direktur; ?>" disabled>
                            <input type="hidden" name="id_approver" value="<?php echo $value->id_approver; ?>">
                          </div>
                        </div>
                        <!-- /spv /direktur -->
                      </div>
                      <?php endforeach; ?>
                      <?php if ($status != 'approved'): ?>                        
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Approve</label>
                          <select name="status" class="form-control border-primary" required>
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