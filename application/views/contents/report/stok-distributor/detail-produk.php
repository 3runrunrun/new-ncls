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
        <div class="col-md-8 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Permohonan Produk</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-300">
                  <table class="table table-hover table-xs border-top-blue display nowrap">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Batch Number</th>
                        <th>Expired</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>No.</td>
                        <td>Kode</td>
                        <td>Nama</td>
                        <td>Jumlah</td>
                        <td>Batch Number</td>
                        <td>Expired</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /table -->

        <!-- /form -->
        <div class="col-md-4 col-xs-12">
          <div class="card border-top-blue">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Approval Form</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir verifikasi pengiriman barang Nucleus - Distributor</p>
                </div>
                <form action="<?php echo site_url(); ?>" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      
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
        <!-- /form -->
      </div>

    </div>
  </div>
</div>