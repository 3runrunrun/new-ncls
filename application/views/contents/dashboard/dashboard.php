<?php 
  $sp = null;
  $sl = null;
  $p = null;
 ?>

 <?php 
    foreach ($sales_person['data']->result() as $value) {
      $sp = $value->jml;
    }
    foreach ($sales_counter['data']->result() as $value) {
      $sl = $value->jml;
    }
    foreach ($profit['data']->result() as $value) {
      $p = number_format($value->profit, 0, ',', '.');
    }
  ?>
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">


      <!-- summary -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-green">
            <div class="card-body">
              <div class="card-block">
                <div class="row">
                  <div class="col-xl-3 col-lg-6 col-md-12 border-right-grey border-right-lighten-3 clearfix">
                      <div class="float-xs-left pl-2">
                          <span class="fa fa-bar-chart fa-5x color-orange"></span>
                      </div>
                      <div class="float-xs-left ml-1">
                        <span class="font-large-3 line-height-1 text-bold-300">25%</span>
                          <span class="grey darken-1 block">Target</span>
                      </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-12 border-right-grey border-right-lighten-3 clearfix">
                    <div class="float-xs-left pl-2">
                      <span class="fa fa-user fa-5x color-tosca"></span>
                    </div>
                    <div class="float-xs-left ml-1">
                      <span class="font-large-3 line-height-1 text-bold-300"><?php echo $sp; ?></span>
                      <span class="grey darken-1 block">Sales person</span>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-12 border-right-grey border-right-lighten-3 clearfix">
                    <div class="float-xs-left pl-2">
                      <span class="fa fa-share-square-o fa-5x color-blue"></span>
                    </div>
                    <div class="float-xs-left ml-1">
                      <span class="font-large-3 line-height-1 text-bold-300"><?php echo $sl; ?></span>
                      <span class="grey darken-1 block">Sales</span>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-12 clearfix">
                      <div class="float-xs-left pl-2 ">
                        <span class="fa fa-money fa-5x color-red"></span>
                      </div>
                      <div class="float-xs-left ml-1 mt-1">
                        <span class="line-height-1 text-bold-800"><?php echo $p; ?></span>
                        <span class="grey darken-1 block">Rupiah</span>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /summary -->

      <!-- daily sales activity -->
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="card border-top-tosca">
            <div class="card-header no-border-bottom">
              <h4 class="card-title">Daily Sales Activity</h4>
              <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="reload"><i class="fa fa-refresh"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-body collapse in">
              <div class="table-responsive height-250">
                <table class="table table-hover mb-0" id="daily-sales-activity" id="report-table-2">
                  <thead>
                    <tr>
                      <th>Kode Area</th>
                      <th>Kota / Area</th>
                      <th>Sales PPG</th>
                      <th>Sales PENTA</th>
                      <th>Sales PTKP</th>
                      <th>Sales JKI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($dsa['data']->result() as $value): ?>
                    <tr>
                      <td class="rt-data"><?php echo $value->id_area; ?></td>
                      <td class="rt-data"><?php echo ucwords($value->nama_area); ?></td>
                      <td class="rt-data"><?php echo number_format($value->ppg, 0, ',', '.'); ?></td>
                      <td><?php echo number_format($value->penta, 0, ',', '.'); ?></td>
                      <td><?php echo number_format($value->ptkp, 0, ',', '.'); ?></td>
                      <td><?php echo number_format($value->jki, 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /daily sales activity -->

      <!--performance -->
      <div class="row">
        <div class="col-xs-12">
          <div class="card border-top-orange">
            <div class="card-body">
              <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="info">
                        <h3 class="font-large-2 text-bold-200">Under Performance</h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="65" class="knob hide-value responsive angle-offset" data-angleoffset="40" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#00BCD4" data-knob-icon="icon-feedback2" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;"></div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li class="border-right-grey border-right-lighten-2 pr-2">
                          <h2 class="grey darken-1 text-bold-400">65%</h2>
                          <span class="success">Completed</span>
                        </li>
                        <li class="pl-2">
                          <h2 class="grey darken-1 text-bold-400">35%</h2>
                          <span class="danger">Remaining</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="deep-orange">
                        <h3 class="font-large-2 text-bold-200">MVD</h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="70" class="knob hide-value responsive angle-offset" data-angleoffset="0" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#FF5722" data-knob-icon="icon-user2" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;">
                        </div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li>
                          <h2 class="grey darken-1 text-bold-400">10%</h2>
                          <span class="deep-orange"> Today's Target</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                  <div class="my-1 text-xs-center">
                    <div class="card-header mb-2 pt-0">
                      <span class="danger">
                        <h3 class="font-large-2 text-bold-200">Balance </h3>
                      </span>
                    </div>
                    <div class="card-body">
                      <div style="display:inline;width:100px;height:100px;"><input type="text" value="75" class="knob hide-value responsive angle-offset" data-angleoffset="20" data-thickness=".15" data-linecap="round" data-width="100" data-height="100" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#DA4453" data-knob-icon="icon-heart6" readonly="readonly" style="width: 69px; height: 43px; position: absolute; vertical-align: middle; margin-top: 43px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 26px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -99px; display: none;"></div>
                      <ul class="list-inline clearfix mt-1 mb-0">
                        <li>
                          <h2 class="grey darken-1 text-bold-400">125%</h2>
                          <span class="danger">Over </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/performance -->

      <!-- top-sales all-time-sales -->
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-12 ">
              <div class="card height-250 profile-card-with-cover border-top-blue">
                <div class="card-body">
                  <h4 class="card-title text-xs-center mt-2">Top Sales</h4>
                  <div class="profile-card-with-cover-content text-xs-center">
                    <div class="my-2">
                      <h4 class="card-title">Nama</h4>
                      <ul class="list-inline clearfix mt-2">
                        <li class="mr-2">Achievement<h2 class="block">60%<span class="font-small-3 text-muted">%</span></h2></li>
                        <li class="mr-2">Area<h2 class="block">Jakarta</h2></li>
                        <li>Month<h2 class="block">Januari</h2></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /top-sales -->
            <div class="col-xl-8 col-lg-6 col-md-12 ">
              <div class="card profile-card-with-cover border-top-red">
                <div class="card-body collapse in">
                  <div class="table-responsive height-250">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th>Kode Detailer</th>
                          <th>Nama</th>
                          <th>Area</th>
                          <th>Penjualan</th>
                          <th>Target</th>
                          <th>Achievement</th>
                        </tr>
                      </thead>
                      <tbody id="resume-sales">
                        <!-- isi -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /top-sales all-time-sales -->

    </div>
  </div>
</div>