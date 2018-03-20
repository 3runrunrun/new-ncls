<html>
<head>
  <title>Print Produk Nucleus</title>
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
    <h2>Weekly Expense Report</h2>
    
    <table style="float: left; width: 30%; font-weight: bold;">
      <tr>
        <td>No</td>
        <td>:</td>
        <td>
          <?php echo strtoupper($nomer); ?>
        </td>
      </tr>
      <tr>
        <td>Periode</td>
        <td>:</td>
        <td>
          <?php $b = $maxtgl['data']->result_array();
          echo date('d-M-Y', strtotime($b[0]['tgl_min'])).' sampai ';
          echo date('d-M-Y', strtotime($b[0]['tgl_max']));
          ?>                       
        </td>
      </tr>
    </table>
    <table style="float: right; width: 20%; font-weight: bold; margin-right: 20%">
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td>
          <?php $a = $operasional['data']->result_array();
          print_r($a[0]['nama']);
          ?> 
        </td>
      </tr>
      <tr>
        <td>Area</td>
        <td>:</td>
        <td>
          <?php $a = $operasional['data']->result_array();
          print_r($a[0]['nama_area']);
          ?> 
        </td>
      </tr>
    </table>

    <table style="margin-top: 80px;" width="100%" border="1" cellspacing="0">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Kota<br />(Rp)</th>
          <th>Allowance<br />(Rp)</th>
          <th>Tol Parkir<br />(Rp)</th>
          <th>Bensin<br />(Rp)</th>
          <th>Comm<br />(Rp)</th>
          <th>Entertainment<br />(Rp)</th>
          <th>Med. Care<br />(Rp)</th>
          <th>Other<br />(Rp)</th>
          <th>Total<br />(Rp)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($operasional['data']->result() as $value): ?>
          <tr style="text-align: center;">
            <?php $tanggal = date('d-M-Y', strtotime($value->tanggal)); ?>
            <td><?php echo $tanggal; ?></td>                          
            <td><?php echo number_format($value->city, 0, ',', '.'); ?></td>
            <td><?php echo number_format($value->allowance, 0, ',', '.'); ?></td>
            <td><?php echo number_format($value->tol_parkir, 0, ',', '.'); ?></td>
            <td><?php echo number_format($value->bensin, 0, ',', '.'); ?></td>
            <td><?php echo number_format($value->comm, 0, ',', '.'); ?></td>
            <td><?php echo number_format($value->entertainment, 0, ',', '.'); ?></td>
            <td><?php echo number_format($value->medcare, 0, ',', '.'); ?></td>
            <td><?php echo number_format($value->other, 0, ',', '.'); ?></td>
            <td><?php echo number_format($value->total, 0, ',', '.'); ?></td>
          </tr>                        
        <?php endforeach; ?> 
        <tr style="background-color: grey">
          <th></th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['city'];
            ?>
          </th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['allowance'];
            ?>
          </th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['tol_parkir'];
            ?>
          </th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['bensin'];
            ?>
          </th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['comm'];
            ?>
          </th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['entertainment'];
            ?>
          </th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['medcare'];
            ?>
          </th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['other'];
            ?>
          </th>
          <th>
            <?php $b = $maxtgl['data']->result_array();
            echo $b[0]['total'];
            ?>
          </th>
        </tr>                     
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