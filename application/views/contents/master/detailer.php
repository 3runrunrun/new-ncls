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
              <h4 class="card-title" id="horz-layout-basic">Detailer</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive height-350">
                  <table class="table table-bordered table-hover table-xs border-top-blue" id="simple-table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Area</th>
                        <th>Employed Date</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($detailer['data']->result() as $value): ?>
                      <tr>
                        <td><?php echo strtoupper($value->id); ?></td>
                        <td><?php echo $value->nama_detailer; ?></td>
                        <td><?php echo $value->nama_area; ?></td>
                        <?php $tanggal_masuk = date('d-M-Y', strtotime($value->tanggal_masuk)) ?>
                        <td><?php echo $tanggal_masuk; ?></td>
                        <td><?php echo $value->status; ?></td>
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
              <h4 class="card-title" id="horz-layout-basic">Add Detailer</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>Detailer submission form</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-detailer" class="form" method="POST" role="form">
                  <div class="form-body">
                    <h4 class="form-section">Identity</h4>
                    <div class="row">
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">No. KTP</label>
                          <input type="text" name="ktp" class="form-control border-primary">
                        </div>
                        <!-- /ktp -->
                        <div class="form-group">
                          <label class="label-control">Name</label>
                          <input type="text" name="nama" class="form-control border-primary" required>
                        </div>
                        <!-- /nama -->
                        <div class="form-group row">
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Place of Birth</label>
                            <input type="text" name="tempat_lahir" class="form-control border-primary">
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Date of Birth</label>
                            <input type="date" name="tanggal_lahir" class="form-control border-primary">
                          </div>
                        </div>
                        <!-- /tempat-lahir /tanggal-lahir -->
                        <div class="form-group row">
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Citizenship (Kewarganegaraan)</label>
                            <input type="text" name="kewarganegaraan" class="form-control border-primary">
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Sex</label>
                            <select name="jenis_kelamin" class="form-control border-primary">
                              <option value="" selected disabled>Choose</option>
                              <option value="l">Male</option>
                              <option value="p">Female</option>
                            </select>
                          </div>
                        </div>
                        <!-- /kewarganegaraan /jenis-kelamin -->
                        <div class="form-group">
                          <label class="label-control">Religion</label>
                          <select name="agama" class="form-control border-primary">
                            <option value="" selected disabled>Choose</option>
                            <option value="kristen">Kristen</option>
                            <option value="katolik">Katolik</option>
                            <option value="islam">Islam</option>
                            <option value="buddha">Buddha</option>
                            <option value="hindu">Hindu</option>
                          </select>
                        </div>
                        <!-- /agama -->
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group row">
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Last education degree</label>
                            <input type="text" name="pendidikan_terakhir" class="form-control border-primary">
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Marital Status (Status Perkawinan)</label>
                            <select name="status_kawin" class="form-control border-primary">
                              <option value="" selected disabled>Choose</option>
                              <option value="kawin">Married</option>
                              <option value="belum kawin">Single</option>
                            </select>
                          </div>
                        </div>
                        <!-- /pendidikan-terakhir /status-perkawinan -->
                        <div class="form-group">
                          <label class="label-control">Address</label>
                          <textarea name="alamat" rows="3" class="form-control border-primary" required></textarea>
                        </div>
                        <div class="form-group row div-repeat">
                          <div class="col-md-6 col-xs-12">
                            <label class="label-control">Wife's name</label>
                            <input type="text" name="istri" class="form-control border-primary">
                          </div>
                          <div class="col-md-4 col-xs-12 ch">
                            <label class="label-control">Children's Name</label>
                            <input type="text" name="anak[]" class="form-control border-primary">
                          </div>
                          <div class="col-md-1 col-xs-2 del-repeater">
                            <div class="form-group">
                              <label class="label-control">button</label>
                              <button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>
                            </div>
                          </div>
                        </div>
                        <!-- /istri /anak -->
                        <div id="repeater-out"></div>
                        <div class="row">
                          <div class="col-md-2 col-xs-12">
                            <div class="form-group">
                              <button type="button" id="add-repeater" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp;Add Children</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <h4 class="form-section">Field Force</h4>
                    <div class="row">
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Detailer Id</label><br />
                          <?php $this->session->set_userdata('id_dt', $id); ?>
                          <span class="tag tag-success tag-lg"><?php echo strtoupper($id); ?></span>
                        </div>
                        <!-- /id-detailer -->
                        <div class="form-group">
                          <label class="label-control">Supervisor</label>
                          <select name="id_spv" class="form-control select2">
                            <option value="" selected disabled>Choose supervisor</option>
                            <?php if ($spv['data']->num_rows() < 1): ?>
                            <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                            <?php foreach ($spv['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-spv -->
                        <div class="form-group">
                          <label class="label-control">Regional Manager</label>
                          <select name="id_rm" class="form-control select2">
                            <option value="" selected disabled>Choose RM</option>
                            <?php if ($spv['data']->num_rows() < 1): ?>
                            <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                            <?php foreach ($spv['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-rm -->
                        <div class="form-group">
                          <label class="label-control">Director</label>
                          <select name="id_direktur" class="form-control select2">
                            <option value="" selected disabled>Choose Direktur</option>
                            <?php if ($spv['data']->num_rows() < 1): ?>
                            <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                            <?php foreach ($spv['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-direktur -->
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Old Detailer</label>
                          <select name="id_detailer_lama" class="form-control select2">
                            <option value="" selected disabled>Choose Old Detailer</option>
                            <?php if ($spv['data']->num_rows() < 1): ?>
                            <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                            <?php foreach ($spv['data']->result() as $value): ?>
                            <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                          <p>*) Choose old detailer to be replaced</p>
                        </div>
                        <!-- /id-detailer-lama -->
                        <div class="form-group row">
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Area</label>
                            <select name="id_area" class="form-control select2" required>
                              <option value="" selected disabled>Choose area</option>
                              <?php if ($area['data']->num_rows() < 1): ?>
                              <option value="" disabled>Unavailable</option>
                              <?php else: ?>
                              <?php foreach ($area['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>">(<?php echo strtoupper($value->id); ?>) - <?php echo $value->nama; ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Subarea</label>
                            <input type="text" name="subarea" class="form-control border-primary">
                          </div>
                        </div>
                        <!-- /area /subarea -->
                        <div class="form-group row">
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Golongan</label>
                            <select name="golongan" class="form-control select2" required>
                              <option value="" selected disabled>Choose Golongan</option>
                              <option value="a">A</option>
                              <option value="b">C</option>
                            </select>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Position</label>
                            <select name="id_jabatan" class="form-control" required>
                              <option value="" selected disabled>Choose position</option>
                              <?php if ($jabatan['data']->num_rows() < 1): ?>
                              <option value="" disabled>Unavailable</option>
                              <?php else: ?>
                              <?php foreach ($jabatan['data']->result() as $value): ?>
                              <option value="<?php echo $value->id; ?>"><?php echo $value->jabatan; ?></option>
                              <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <!-- /golongan /jabatan -->
                      </div>
                    </div>
                    <h4 class="form-section">Data Salary &amp; Fee</h4>
                    <div class="row">
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group row">
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Bank</label>
                            <input type="text" name="bank" class="form-control border-primary">
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Account No.</label>
                            <input type="text" name="norek" class="form-control border-primary">
                          </div>
                        </div>
                        <!-- /bank /norek -->
                        <div class="form-group row">
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Net Salary</label>
                            <fieldset>
                              <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="number" name="gaji" class="form-control border-primary">
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Housing</label>
                            <fieldset>
                              <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="number" name="housing" class="form-control border-primary">
                              </div>
                            </fieldset>
                          </div>
                        </div>
                        <!-- /gaji /housing -->
                        <div class="form-group row">
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Allowance</label>
                            <fieldset>
                              <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="number" name="tunjangan" class="form-control border-primary">
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <label class="label-control">Vehicle Rent Cost</label>
                            <fieldset>
                              <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="number" name="sewa_kendaraan" class="form-control border-primary">
                              </div>
                            </fieldset>
                          </div>
                        </div>
                        <!-- /tunjangan /sewa-kendaraan -->
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Annotation</label>
                          <textarea name="keterangan" rows="10" class="form-control border-primary"></textarea>
                        </div>
                        <!-- /keterangan -->
                      </div>
                    </div>
                  </div>
                  <div class="form-actions center">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-warning">Cancel</button>
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
    $('#simple-table').DataTable({
        "paging": false,
        "order": [[ 0, "desc" ]],
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
  $(document).ready(function(){
    $('.del-repeater label').css({
      'color': 'transparent',
    });
    $('.del-repeater:first').hide();

    $('#add-repeater').click(function(){
      $('.div-repeat:first select').select2('destroy');
      $('.div-repeat:first').clone().appendTo('#repeater-out');
      $('.div-repeat .select2').select2();
      $('#repeater-out .del-repeater').show();
      $('.div-repeat:last').children('div:first').remove();
      $('.div-repeat:last').children('.ch').addClass('offset-md-6');
    });
  });
</script>