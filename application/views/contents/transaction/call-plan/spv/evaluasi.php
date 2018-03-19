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
              <h4 class="card-title" id="horz-layout-basic">Target Call Plan</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Detailer</th>
                        <th>Spv</th>
                        <th>RM</th>
                        <th>Dokter</th>
                        <th>Spesialis</th>
                        <th>Kunjungan<br />(per bulan)</th>
                        <th>Frekuensi</th>
                        <th>Reach</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($call_plan['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo ucwords($value->nama_detailer); ?></td>
                        <td><?php echo ucwords($value->nama_spv); ?></td>
                        <td><?php echo ucwords($value->nama_rm); ?></td>
                        <td><?php echo ucwords($value->nama_dokter); ?></td>
                        <td><?php echo strtoupper($value->spesialis); ?></td>
                        <td><?php echo $value->target; ?></td>
                        <td><?php echo $value->frekuensi; ?></td>
                        <td><?php echo number_format($value->reach, 0, ',', '.'); ?>%</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-backdrop="false" data-target="#frekuensi" onclick="send_id('<?php echo $value->id; ?>')">Tambah Frekuensi</button>
                          </div>
                        </td>
                      </tr>
                        
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /table -->

    </div>
  </div>
</div>

<div class="modal fade text-xs-left" id="frekuensi" tabindex="-1" role="dialog" aria-labelledby="formFrekuensi" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="formFrekuensi">Frekuensi</h4>
      </div>
      <form class="form" method="POST" action="<?php echo site_url(); ?>/store-target-call-plan/frekuensi">
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label class="label-control">Kode Frekuensi</label><br />
                <span class="tag tag-primary tag-lg modal-id-span"></span>
                <input type="hidden" name="id_call_plan" class="modal-id-call">
              </div>
              <!-- /id -->
              <div class="form-group">
                <label class="label-control">Kunjungan</label><br />
                <input type="number" name="kunjungan" class="form-control border-primary">
              </div>
              <!-- /kunjungan -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary">Simpan</button>
          <button type="reset" class="btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
        </div>
      </form>
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
  function send_id(id) {
    console.log(id);
    var decorated_id = id.toUpperCase();
    $('.modal-id-call').val(id);
    $('.modal-id-span').text(decorated_id);
  }
</script>
