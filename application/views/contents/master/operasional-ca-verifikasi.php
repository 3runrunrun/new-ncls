<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">

      <!-- table -->
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">CA Submission Detail</h4>
            </div>
            <div class="card-body">
              <?php foreach ($operasional['data']->result() as $value): ?>
                <?php $dari = date('d-M-Y', strtotime($value->dari)); ?>
                <?php $sampai = date('d-M-Y', strtotime($value->sampai)); ?>
              <div class="card-block">
                <h4 class="card-title">(<?php echo strtoupper($value->id_detailer); ?>) <?php echo strtoupper($value->nama_detailer); ?></h4>
                <table class="table table-xs">
                  <tbody>
                    <tr>
                      <th width="10%">From:</th>
                      <td><?php echo $dari; ?></td>
                    </tr>
                    <tr>
                      <th width="10%">To:</th>
                      <td><?php echo $sampai; ?></td>
                    </tr>
                    <tr>
                      <th width="10%">Cost:</th>
                      <td>Rp <?php echo number_format($value->total, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <th width="10%">Status:</th>
                      <td><?php echo strtoupper($value->status); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xs-12">
          <div class="card border-top-green">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">CA Approval</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="card-text">
                  <p>CA approval form</p>
                </div>
                <form action="<?php echo site_url(); ?>/store-operasional/approve" class="form" method="POST" role="form">
                  <div class="form-body">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label class="label-control">Approver</label>
                          <input type="hidden" name="id_operasional" value="<?php echo $id; ?>">
                          <select name="id_approver" class="form-control select2" required>
                            <option value="" selected disabled>Choose approver</option>
                            <?php if ($detailer['data']->num_rows() < 1): ?>
                              <option value="" disabled>Unavailable</option>
                            <?php else: ?>
                              <?php foreach ($detailer['data']->result() as $value): ?>
                                <option value="<?php echo $value->id; ?>">(<?php echo $value->alias_area; ?>) - <?php echo strtoupper($value->id); ?> - <?php echo $value->nama_detailer; ?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <!-- /id-detailer -->
                        <div class="form-group">
                          <label class="label-control">Status</label>
                          <select name="status" class="form-control border-primary">
                            <option value="" selected disabled>Choose status</option>
                            <option value="waiting">Waiting</option>
                            <option value="approved">Approved</option>
                          </select>
                        </div>
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
      <!-- /table -->

    </div>
  </div>
</div>

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
  $(document).ready(function(){
    $('#simple-table-2').DataTable({
        "paging": false,
        "order": [[ 0, "desc" ]],
      });
    $('#simple-table-2_filter').css({
      'text-align': 'center',
    });
    $('#simple-table-2_wrapper').children(':first').children(':first').remove();
    $('#simple-table-2_filter').parent().addClass('col-xs-12').removeClass('col-md-6');
    $('#simple-table-2_filter > label > input').addClass('input-md').removeClass('input-sm').attr({
        placeholder: 'Keyword',
      });

    $('#simple-table-2_wrapper').children(':last').remove();
  });
</script>

