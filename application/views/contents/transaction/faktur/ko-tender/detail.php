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
    
      <!-- form -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-red">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Faktur KO Tender</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="form-body">
                  <?php foreach ($detail['data']->result() as $value): ?>
                    <?php $status = $value->status; ?>
                    <?php $distributor = $value->nama_distributor; ?>
                  <div class="row">
                    <div class="col-md-6 col-xs-12">
                      <h5 class="form-section">1. Identitas Faktur</h5>
                      <hr />
                      <div class="form-group row">
                        <div class="col-md-6 col-xs-12">
                          <label class="label-control">No. Faktur</label><br />
                          <span class="tag tag-success tag-lg"><?php echo str_replace('-', '/', strtoupper($value->id)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <h5 class="form-section">2. Pemohon</h5>
                      <hr />
                      <div class="form-group row">
                        <div class="col-md-6 col-xs-12">
                          <label class="label-control">SPV / RM</label><br />
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
                      <hr />
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
                        <span class="tag tag-primary tag-lg"><?php echo strtoupper($value->nama_distributor); ?></span>
                        <?php if ($value->subdist == 'y'): ?>
                        <br /><input type="hidden" name="dist_subdist" value="y">
                        <fieldset class="mt-1">
                          <div class="state icheckbox_flat-blue checked mr-1"></div>
                          <label>Subdistributor</label>
                        </fieldset>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="label-control"><strong>Menyetujui</strong></label><br />
                        <span class="tag tag-primary tag-lg"><?php echo strtoupper($value->nama_rm); ?></span>
                      </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                      <div class="form-group">
                        <label class="label-control"><strong>Approver</strong> (Direktur)</label><br />
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
                                <?php echo strtoupper($value->nama_outlet); ?>
                              </td>
                              <td>
                                <?php echo strtoupper($value->nama_produk); ?>
                              </td>
                              <td>
                                <?php echo $value->jumlah; ?>
                              </td>
                              <td>
                                <?php echo $value->on_diskon_distributor; ?>
                              </td>
                              <td>
                                <?php echo $value->on_nf; ?>
                              </td>
                              <td>
                                <?php echo $value->on_total; ?>
                              </td>
                              <td>
                                <?php echo $value->off_diskon_distributor; ?>
                              </td>
                              <td>
                                <?php echo $value->off_nf; ?>
                              </td>
                              <td>
                                <?php echo $value->off_total; ?>
                              </td>
                              <td>
                                <?php echo $value->keterangan; ?>
                              </td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-1">
                    <div class="col-xs-12">
                      <h5 class="form-section">4. KO On &amp; Off Faktur</h5>
                      <hr />
                    </div>
                    <div class="col-md-8 col-xs-12">
                      <div class="table-responsive">
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
                              <td><?php echo $count += 1; ?></div>
                              </td>
                              <td><?php echo $value->cn; ?></td>
                              <td><?php echo $value->diskon; ?></td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                          <tfoot>
                            <?php foreach ($total['data']->result() as $value): ?>
                            <tr>
                              <td colspan="2"><strong>Total</strong></td>
                              <td><strong><?php echo $value->total; ?></strong></td>
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
                    </div>
                  </div>
                </div>
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