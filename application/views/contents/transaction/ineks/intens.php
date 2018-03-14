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
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Intensifikasi</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir intensifikasi sales detailer</p>
                  <div class="bs-callout-danger callout-border-right mb-1 p-1">
                    <strong>Perhatian!</strong>
                    <p>Sebelum mengisi intensifikasi, pastikan anda telah mengisi data ekstensifikasi detailer melalui <a href="<?php echo site_url(); ?>/prospek-ineks" class="alert-link">halaman ini</a>.</p>
                  </div>
                </div>
                <form action="<?php echo site_url(); ?>/store-intens" class="form" method="POST" role="form">
                  <div class="form-body">
                    <?php foreach ($eksten['data']->result() as $value): ?>
                    <div class="form-group row">
                      <div class="col-md-6 col-xs-12">
                        <label class="label-control">Detailer</label>
                        <input type="text" class="form-control border-primary" value="<?php echo strtoupper($value->nama_detailer); ?>" disabled>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <label class="label-control">Kode Ekstensifikasi</label>
                        <input type="text" class="form-control border-primary" value="<?php echo strtoupper($value->id); ?>" disabled>
                        <input type="hidden" name="id_eksten" value="<?php echo $value->id; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="label-control">Tanggal</label>
                      <input type="date" name="tanggal" class="form-control border-primary" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <h5 class="form-section">Target</h5>
                    <div class="form-group row div-repeat">
                      <div class="col-md-6 col-xs-12 mb-1">
                        <label class="label-control">Outlet</label>
                        <input type="text" class="form-control border-primary" value="<?php echo strtoupper($value->nama_outlet); ?>" disabled>
                      </div>
                      <div class="col-md-6 col-xs-12 mb-1">
                        <label class="label-control">Customer</label>
                        <input type="text" class="form-control border-primary" value="<?php echo strtoupper($value->nama_customer); ?>" disabled>
                      </div>
                      <div class="col-md-2 col-xs-12">
                        <label class="label-control">Pertemuan</label>
                        <input type="number" name="pertemuan" value="<?php echo strtoupper($value->pertemuan); ?>" class="form-control border-primary" readonly>
                      </div>
                      <div class="col-md-4 col-xs-12">
                        <label class="label-control">Dana</label>
                        <fieldset>
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="number" name="dana" value="<?php echo strtoupper($value->dana); ?>" class="form-control border-primary" readonly>
                          </div>
                        </fieldset>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <label class="label-control">Biaya</label>
                        <fieldset>
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="number" name="biaya" value="<?php echo strtoupper($value->biaya); ?>" class="form-control border-primary" readonly>
                          </div>
                        </fieldset>
                        <p>*) Rerata per pasien</p>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <label class="label-control">Produk</label>
                        <input type="text" class="form-control border-primary" value="<?php echo strtoupper($value->nama_produk); ?>" disabled>
                      </div>
                      <div class="col-md-3 col-xs-12 mb-1">
                        <label class="label-control">Jumlah (unit)</label>
                        <input type="number" class="form-control border-primary" value="<?php echo strtoupper($value->target); ?>" disabled>
                      </div>
                      <div class="col-md-3 col-xs-12 mb-1">
                        <label class="label-control">Target Baru (unit)</label>
                        <input type="number" name="target" class="form-control border-primary" value="<?php echo strtoupper($value->target); ?>">
                      </div>
                    </div>
                    <!-- /id-outlet /id-customer -->
                    <?php endforeach; ?>
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

