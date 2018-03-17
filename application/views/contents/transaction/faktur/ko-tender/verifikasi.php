<?php 
  $status = null; 
  $distributor = null; 
  $count = 0; 
?>
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
          <div class="card border-top-red">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Faktur KO Tender</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <form action="<?php echo site_url(); ?>/store-tender/approve" method="POST" class="form" role="form">
                  <div class="form-body">
                    <?php foreach ($detail['data']->result() as $value): ?>
                      <?php $status = $value->status; ?>
                      <?php $distributor = $value->nama_distributor; ?>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">1. Identitas Faktur</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">SP</label><br />
                            <?php if ($status !== 'rilis'): ?>
                            <input type="hidden" name="sp" value="<?php echo $value->sp; ?>">
                            <?php endif; ?>
                            <span class="tag tag-success tag-lg"><?php echo strtoupper($value->sp); ?></span>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">No. Faktur</label><br />
                            <?php if ($status !== 'rilis'): ?>
                            <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                            <?php endif; ?>
                            <span class="tag tag-success tag-lg"><?php echo str_replace('-', '/', strtoupper($value->id)); ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <h5 class="form-section">2. Pemohon</h5>
                        <div class="form-group row">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">SPV / RM</label><br />
                            <?php if ($status !== 'rilis'): ?>
                            <input type="hidden" name="id_detailer" value="<?php echo $value->id_detailer; ?>">
                            <?php endif; ?>
                              <span class="tag tag-info tag-lg"><?php echo strtoupper($value->nama); ?></span>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Status</label><br />
                              <span class="tag tag-warning tag-lg"><?php echo strtoupper($value->status); ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <h5 class="form-section">3. Informasi KO</h5>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Tanggal</label>
                          <input type="text" name="tanggal" class="form-control border-primary" value="<?php echo date('d-M-Y', strtotime($value->tanggal)); ?>" disabled>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Distributor</label><br />
                          <?php if ($status !== 'rilis'): ?>
                          <input type="hidden" name="id_distributor" value="<?php echo $value->id_distributor; ?>">
                          <?php endif; ?>
                          <span class="tag tag-primary tag-lg"><?php echo strtoupper($value->nama_distributor); ?></span>
                          <?php if ($value->subdist == 'y'): ?>
                          <br /><input type="hidden" name="dist_subdist" value="s">
                          <fieldset class="mt-1">
                            <div class="state icheckbox_flat-blue checked mr-1"></div>
                            <label>Subdistributor</label>
                          </fieldset>
                          <?php else: ?>
                          <br /><input type="hidden" name="dist_subdist" value="d">
                          <fieldset class="mt-1">
                            <div class="state icheckbox_flat-blue checked mr-1"></div>
                            <label>Distributor</label>
                          </fieldset>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control"><strong>Menyetujui</strong></label><br />
                          <?php if ($status !== 'rilis'): ?>
                          <input type="hidden" name="id_rm" value="<?php echo $value->id_rm; ?>">
                          <?php endif; ?>
                          <span class="tag tag-primary tag-lg"><?php echo strtoupper($value->nama_rm); ?></span>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <label class="label-control"><strong>Approver</strong> (Direktur)</label><br />
                          <?php if ($status !== 'rilis'): ?>
                          <input type="hidden" name="id_direktur" value="<?php echo $value->id_direktur; ?>">
                          <?php endif; ?>
                          <span class="tag tag-primary tag-lg"><?php echo strtoupper($value->nama_direktur); ?></span>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="card-text">
                      <p>Dengan hormat,<br />melalui surat ini kami bermaksud untuk mengajukan permohonan diskon untuk outlet:</p>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table class="table table-bordered table-xs" id="simple-table">
                            <thead>
                              <tr>
                                <th rowspan="2">Outlet</th>
                                <th rowspan="2">Produk</th>
                                <th rowspan="2">Jumlah</th>
                                <th colspan="3">Kondisi On Faktur</th>
                                <th colspan="3">Kondisi Off Faktur</th>
                                <th rowspan="2">Keterangan</th>
                              </tr>
                              <tr>
                                <th class="dist-out"><?php echo strtoupper($distributor); ?></th>
                                <th>NF</th>
                                <th>Total</th>
                                <th class="dist-out"><?php echo strtoupper($distributor); ?></th>
                                <th>NF</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($produk['data']->result() as $value): ?>
                              <tr>
                                <td>
                                  <div class="card-block width-300">
                                    <?php if ($status !== 'rilis'): ?>
                                    <input type="hidden" name="id_outlet[]" value="<?php echo $value->id_outlet; ?>">
                                    <?php endif; ?>
                                    <?php echo strtoupper($value->nama_outlet); ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-300">
                                    <?php if ($status !== 'rilis'): ?>
                                    <input type="hidden" name="id_produk[]" value="<?php echo $value->id_produk; ?>">
                                    <?php endif; ?>
                                    <?php echo strtoupper($value->nama_produk); ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-200">
                                    <?php if ($status !== 'rilis'): ?>
                                    <input type="hidden" name="jumlah[]" value="<?php echo $value->jumlah; ?>">
                                    <?php echo $value->jumlah; ?>
                                    <?php endif; ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="on_diskon_distributor[]" class="form-control border-primary" min="0" value="<?php echo $value->on_diskon_distributor; ?>" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="on_nf[]" value="<?php echo $value->on_nf; ?>" class="form-control border-primary" min="0" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="on_total[]" value="<?php echo $value->on_total; ?>" class="form-control border-primary" min="0" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="off_diskon_distributor[]" class="form-control border-primary" value="<?php echo $value->off_diskon_distributor; ?>" min="0" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="off_nf[]" class="form-control border-primary" value="<?php echo $value->off_nf; ?>" min="0" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-150">
                                    <fieldset>
                                      <div class="input-group">
                                        <input type="text" name="off_total[]" class="form-control border-primary" value="<?php echo $value->off_total; ?>" min="0" required>
                                        <span class="input-group-addon">%</span>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block width-200">
                                    <textarea name="keterangan[]" value="<?php echo $value->keterangan; ?>" rows="3" class="form-control border-primary"></textarea>
                                  </div>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <h5 class="form-section">4. KO On &amp; Off Faktur</h5>
                      </div>
                      <div class="col-md-8 col-xs-12">
                        <div class="table-responsive height-200">
                          <table class="table table-xs display nowrap" id="simple-table-2">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>CN</th>
                                <th>%</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($onoff['data']->result() as $value): ?>
                              <tr>
                                <td>
                                  <div class="card-block width-50 count-repeater"><?php echo $count += 1; ?></div>
                                </td>
                                <td>
                                  <div class="card-block">
                                    <?php if ($status !== 'rilis'): ?>
                                    <input type="hidden" name="cn[]" value="<?php echo $value->cn; ?>" min="0" class="form-control border-primary">
                                    <?php endif; ?>
                                    <?php echo $value->cn; ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="card-block">
                                    <div class="input-group">
                                      <?php if ($status !== 'rilis'): ?>
                                      <input type="text" name="diskon[]" id="" class="form-control border-primary" value="<?php echo $value->diskon; ?>" min="0" required>
                                      <span class="input-group-addon">%</span>
                                      <?php else: ?>
                                      <?php echo $value->diskon; ?>
                                      <?php endif; ?>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-xs">
                            <tfoot>
                              <?php foreach ($total['data']->result() as $value): ?>
                              <tr>
                                <td>
                                  <div class="card-block width-200"><strong>Total</strong></div>
                                </td>
                                <td>
                                  <div class="card-block width-200 pull-right">
                                    <fieldset>
                                      <div class="input-group">
                                        <?php if ($status !== 'rilis'): ?>
                                        <input type="number" name="total" class="form-control border-primary" value="<?php echo $value->total; ?>" min="0" required>
                                        <span class="input-group-addon">%</span>
                                        <?php else: ?>
                                        <strong><?php echo $value->total; ?></strong>
                                        <?php endif; ?>
                                      </div>
                                    </fieldset>
                                  </div>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-12">
                        <div class="card-text">
                          <p>Demikian surat ini kami sampaikan. Bila surat ini sudah disetujui harap fax ke pihak <strong class="dist-out"><?php echo strtoupper($distributor); ?></strong>.</p>
                          <p>Atas perhatian Bapak, kami sampaikan terima kasih.</p>
                        </div>
                        <?php if ($status !== 'rilis'): ?>
                        <div class="form-group">
                          <label class="label-control">Approver</label>
                          <select name="id_rilis" class="form-control select2">
                            <option value="" selected disabled>Pilih SPV / RM / Direktur</option>
                            <?php if ($detailer['data']->num_rows() < 1): ?>
                            <option value="" disabled>Belum tersedia</option>
                            <?php else: ?>
                            <?php foreach ($detailer['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                          *) Pilih SPV/RM/Direktur sesuai dengan status faktur yang akan disimpan di dalam sistem (Mengetaui Pemohon / Menyetujui / Rilis)
                        </div>
                        <div class="form-group">
                          <label class="label-control">Status</label>
                          <select name="status" class="form-control border-primary">
                            <option value="" selected disabled>Pilih status</option>
                            <option value="waiting">Waiting</option>
                            <option value="spv">Mengetahui Pemohon (RM / SPV)</option>
                            <option value="rm">Menyetujui</option>
                            <option value="rilis">Rilis</option>
                          </select>
                        </div>
                        <div class="form-actions center">
                          <button type="submit" class="btn btn-success">Simpan</button>
                          <button type="reset" class="btn btn-warning">Batal</button>
                        </div>
                        <?php endif ?>
                      </div>
                    </div>
                    <div class="row mt-1">
                    </div>
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
    $('#simple-table-2 th, #simple-table-2 td').css({
      'text-align': 'center',
    });
    $('#simple-table-2 td').addClass('text-truncate');
    $('#simple-table-2 td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  function print_dist(selector){
    var text = $(selector).children().filter(':selected').text();
    var splitted = text.split('-');
    var clear_text = $.trim(splitted[splitted.length - 1]);
    console.log(clear_text);
    $('.dist-out').text(clear_text);
  }
</script>