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
              <h4 class="card-title" id="horz-layout-basic">Prospect Marketing Activity</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Area</th>
                        <th>Nama Agenda</th>
                        <th>Tanggal Agenda</th>
                        <th>Durasi</th>
                        <th>Budget / Anggaran<br />(Rp)</th>
                        <th>Deskripsi</th>
                        <th>Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pma['data']->result() as $value): ?>
                      <tr>
                        <td>(<?php echo strtoupper($value->alias_area); ?>) <?php echo strtoupper($value->nama_area); ?></td>
                        <td><?php echo strtoupper($value->nama); ?></td>
                        <?php $tanggal = date('d-M-Y', strtotime($value->dari)); ?>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo $value->durasi; ?> hari</td>
                        <td><?php echo number_format($value->total, 0, ',', '.'); ?></td>
                        <td><?php echo strtoupper($value->keterangan); ?></td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-backdrop="false" data-target="#expense-planning" onclick="send_id('<?php echo $value->id; ?>')">Expense Planning</button>
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
              <h4 class="card-title" id="horz-layout-basic">Add Prospect Marketing Activity</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Formulir untuk menambah Prospect Marketing Activity baru</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-pma" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">1. Informasi Agenda</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Nama Agenda</label>
                            <input type="text" name="nama" class="form-control border-primary" required>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Detailer (Marketing)</label>
                            <select name="id_detailer" class="form-control select2" required>
                              <option value="" selected disabled>Pilih Detailer</option>
                              <?php if ($detailer['data']->num_rows() < 1): ?>
                              <option value="" disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($detailer['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                              <?php endforeach; ?>  
                              <?php endif; ?>
                              <option value=""></option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Tanggal</label>
                            <input type="date" name="dari" class="form-control border-primary" required>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Durasi</label>
                            <select name="durasi" class="form-control select2">
                              <?php for($i = 1; $i < 31; $i++): ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?> hari</option>
                              <?php endfor; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Area</label>
                            <select name="id_area" class="form-control select2" required>
                              <option value="" selected disabled>Pilih area</option>
                              <?php if ($area['data']->num_rows() < 1): ?>
                              <option value="" disabled>Belum tersedia</option>
                              <?php else: ?>
                              <?php foreach ($area['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area ?>) - <?php echo $value->nama; ?></option>
                              <?php endforeach; ?>  
                              <?php endif; ?>
                              <option value=""></option>
                            </select>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Subarea</label>
                            <input type="text" name="kota" class="form-control border-primary" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">2. Deskripsi Agenda</h5>
                        <div class="form-group">
                          <label class="label-control">Deskripsi</label>
                          <textarea class="form-control border-primary" name="keterangan" rows="10" required></textarea>
                        </div>
                      </div>
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

<div class="modal fade text-xs-left" id="expense-planning" tabindex="-1" role="dialog" aria-labelledby="expensePlanning" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="expensePlanning">Expense Planning</h4>
      </div>
      <form class="form" method="POST" action="<?php echo site_url(); ?>/store-pma-expense">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label class="label-control">Kode PMA</label><br />
                <span class="tag tag-primary tag-lg modal-id-span"></span>
                <input type="hidden" name="id" class="modal-id-pma">
              </div>
              <!-- /id -->
              <div class="form-group">
                <label class="label-control">City</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="city" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /city -->
              <div class="form-group">
                <label class="label-control">Allowance</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="allowance" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /allowance -->
              <div class="form-group">
                <label class="label-control">Tol &amp; Parkir</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="tol_parkir" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /tol-parkir -->
              <div class="form-group">
                <label class="label-control">Bensin</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="bensin" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /bensin -->
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label class="label-control">Comm</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="comm" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /comm -->
              <div class="form-group">
                <label class="label-control">Entertainment</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="entertainment" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /entertainment -->
              <div class="form-group">
                <label class="label-control">Med. Care</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="medcare" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /medcare -->
              <div class="form-group">
                <label class="label-control">Other</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="other" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /other -->
              <div class="form-group">
                <label class="label-control">Total</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="total" id="total" class="form-control border-primary" min="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /total -->
              <div class="form-group">
                <label class="label-control">Potongan CA</label>
                <fieldset>
                  <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="number" name="potongan_ca" id="total" class="form-control border-primary" min="0" value="0" required>
                  </div>
                </fieldset>
              </div>
              <!-- /potongan-ca -->
            </div>
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
    $('.modal-id-pma').val(id);
    $('.modal-id-span').text(decorated_id);
  }
</script>

