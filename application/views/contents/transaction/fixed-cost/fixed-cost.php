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

      <!-- under-performance -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-red">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Performance</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <div class="col-md-4 col-xs-12">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="danger">
                        <h3 class="font-large-2 text-bold-200">Under Performance</h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="65" class="knob hide-value responsive angle-offset" data-angleoffset="40" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#FF0049" data-knob-icon="icon-feedback2" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;"></div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li>
                          <h2 class="grey darken-1 text-bold-400">35%</h2>
                          <span class="danger">Detailer</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-8 col-xs-12">
                    <div class="table-responsive height-350">
                      <table class="table table-bordered table-hover table-xs border-top-red" id="simple-table">
                        <thead>
                          <tr>
                            <th>Kode Detailer</th>
                            <th>Detailer</th>
                            <th>Area</th>
                            <th>Total Sales</th>
                            <th>Target</th>
                            <th>Tools</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Kode Detailer</td>
                            <td>Detailer</td>
                            <td>Area</td>
                            <td>Total Sales</td>
                            <td>Target</td>
                            <td>
                              <div class="btn-group-vertical">
                                <a href="#" class="btn btn-info">Detail</a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /under-performance -->

      <!-- performance -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-blue">
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <div class="col-md-4 col-xs-12">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="info">
                        <h3 class="font-large-2 text-bold-200">Performance</h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="65" class="knob hide-value responsive angle-offset" data-angleoffset="40" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#3FB9FF" data-knob-icon="icon-feedback2" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;"></div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li>
                          <h2 class="grey darken-1 text-bold-400">35%</h2>
                          <span class="info">Detailer</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-8 col-xs-12">
                    <div class="table-responsive height-350">
                      <table class="table table-bordered table-hover table-xs border-top-red" id="simple-table-2">
                        <thead>
                          <tr>
                            <th>Kode Detailer</th>
                            <th>Detailer</th>
                            <th>Area</th>
                            <th>Total Sales</th>
                            <th>Target</th>
                            <th>Tools</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Kode Detailer</td>
                            <td>Detailer</td>
                            <td>Area</td>
                            <td>Total Sales</td>
                            <td>Target</td>
                            <td>
                              <div class="btn-group-vertical">
                                <a href="#" class="btn btn-info">Detail</a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /performance -->

      <!-- best-detailer -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <div class="col-md-4 col-xs-12">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="success">
                        <h3 class="font-large-2 text-bold-200">Best Detailer</h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="65" class="knob hide-value responsive angle-offset" data-angleoffset="40" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#09D9A1" data-knob-icon="icon-feedback2" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;"></div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li>
                          <h2 class="grey darken-1 text-bold-400">35%</h2>
                          <span class="success">Detailer</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-8 col-xs-12">
                    <div class="table-responsive height-350">
                      <table class="table table-bordered table-hover table-xs border-top-red" id="simple-table-3">
                        <thead>
                          <tr>
                            <th>Kode Detailer</th>
                            <th>Detailer</th>
                            <th>Area</th>
                            <th>Total Sales</th>
                            <th>Target</th>
                            <th>Tools</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Kode Detailer</td>
                            <td>Detailer</td>
                            <td>Area</td>
                            <td>Total Sales</td>
                            <td>Target</td>
                            <td>
                              <div class="btn-group-vertical">
                                <a href="#" class="btn btn-info">Detail</a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /best-detailer -->

      <!-- fixed-cost -->
      <div class="row">  
        <div class="col-xs-12">
          <div class="card border-top-red">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic">Fixed Cost</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-hover table-xs border-top-red" id="report-table-2">
                    <thead>
                      <tr>
                        <th>Item</th>
                        <th width="10%">Unit</th>
                        <th width="15%">Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php for ($i=0; $i < 5; $i++): ?>
                      <tr>
                        <td class="rt-data">Item</td>
                        <td class="rt-data">Unit</td>
                        <td class="rt-money">120.000</td>
                      </tr>
                      <?php endfor; ?>
                    </tbody>
                  </table>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover table-xs border-top-red" id="total-table">
                    <thead>
                      <tr>
                        <th>Total</th>
                        <th width="10%">&nbsp;</th>
                        <th width="15%" class="tt-money">140.000</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /fixed-cost -->

    </div>
  </div>
</div>

<script type="text/javascript">
    $('#report-table-2 td').addClass('text-truncate');
    $('#report-table-2 td:even').addClass('bg-table-blue');
    $('#total-table').addClass('bg-table-red');
  });
</script>

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

<script type="text/javascript">
  $(document).ready(function(){
    $('#simple-table-3 th, #simple-table-3 td').css({
      'text-align': 'center',
    });
    $('#simple-table-3 td').addClass('text-truncate');
    $('#simple-table-3 td:even').addClass('bg-table-blue');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#simple-table-3').DataTable({
        "paging": false,
      });
    $('#simple-table-3_filter').css({
      'text-align': 'center',
    });
    $('#simple-table-3_wrapper').children(':first').children(':first').remove();
    $('#simple-table-3_filter').parent().addClass('col-xs-12').removeClass('col-md-6');
    $('#simple-table-3_filter > label > input').addClass('input-md').removeClass('input-sm').attr({
        placeholder: 'Keyword',
      });

    $('#simple-table-3_wrapper').children(':last').remove();
  });
</script>

