<html>
<head>
  <title>Print</title>
  <style type="text/css">
  body{
    font-family: arial;
    font-size: 12pt;
  }
  table{
    font-size: 12pt;
  }  
  .tengah{
   position:absolute;
   margin-left:auto;
   margin-right:auto;
   margin-top:auto;
   margin-bottom:auto;
   left:0;
   right:0;
   top:0;
   bottom:0;
   width: 95%;
   padding: 20px 10px 0 10px;
 }

 @page {
  size: A4;
  margin: 0px;
}
</style>

<style type="text/css" media="print">
@page { 
  size: landscape;
}
body { 
  -webkit-transform: rotate(0deg); 
  -moz-transform:rotate(0deg);
  filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
</style>
</head>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>

<body class="page">
  <div class="tengah">
    <img src="<?php echo base_url() ?>/img/logo-small.png" style="max-height: 150px; max-width: 250px; margin-bottom: 10px;"> 
    <h4 class="card-title" id="horz-layout-basic">Dana Bulan : 
      <?php 
      $b = $appr['data']->result_array();
      echo $b[0]['tanggal'];
      ?>
    </h4>    
    <table width="100%" border="1" cellspacing="0">
      <thead>
        <tr>
          <th>No. Wpr</th>
          <th>Area</th>
          <th>Detailer</th>
          <th>Total Biaya<br />(Rp)</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($appr['data']->result() as $value): ?>
          <tr style="text-align: center;">
            <td><?php echo strtoupper($value->no_wpr); ?></td>
            <td>(<?php echo $value->alias_area; ?>) - <?php echo $value->nama_area; ?></td>
            <td><?php echo $value->nama; ?></td>
            <td><?php echo number_format($value->dana, 0, ',', '.'); ?></td>
            <td><?php echo $value->status; ?></td>
          </tr>  
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    print();
  });
</script>