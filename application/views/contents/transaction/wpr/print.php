<html>
<head>
  <title>Print</title>
  <style type="text/css">
  body{
    font-family: arial;
    font-size: 10pt;
  }
  table{
    font-size: 10pt;
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
   width: 90%;
   padding: 0px 10px 0 10px;
 }

 @page {
  size: A5;
  margin: 0px;
}
</style>
</head>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>

<body class="page">
  <div class="tengah">
    <center>
      <img src="<?php echo base_url() ?>/img/logo-small.png" style="max-height: 100px; max-width: 200px;">
      <h2 style="margin-top: 5px;">WPR</h2>
    </center>
    <table>
      <?php foreach ($detail['data']->result() as $value): ?>
       <tr>
        <td>No.WPR</td>
        <td>:</td>
        <td><?php echo strtoupper(str_replace('-', '/', $value->no_wpr)); ?></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?php echo ucwords($value->detailer); ?></td>
      </tr>
      <tr>
        <td>Area</td>
        <td>:</td>
        <td>(<?php echo $value->alias_area; ?>) <?php echo $value->nama_area; ?></td>
      </tr>
    <?php endforeach ?>
  </table>

  <table style="border: 1px; width: 100%; margin-top:20px;" border="1" cellspacing="0">
   <tr>
    <th>No.</th>
    <th>Nama Dokter</th>
    <th>SPS</th>
    <th colspan="2">Periode</th>
    <th>Value</th>
  </tr>
  <?php $no = 0; ?>
  <?php foreach ($request['data']->result() as $value): ?>
    <tr>
      <td><center><?php echo $no += 1; ?></center></td>
      <td><center><?php echo $value->nama_user; ?></center></td>
      <td><center><?php echo $value->spesialis; ?></center></td>
      <td><center><?php echo $value->dari; ?></center></td>
      <td><center><?php echo $value->sampai; ?></center></td>
      <td><center>Rp <?php echo number_format($value->dana, 0, ',','.'); ?></center></td>
    </tr>
  <?php endforeach;?>
</table>

<table style="margin-top:20px;">
  <?php foreach ($request['data']->result() as $value): ?>
    <tr>
      <td>Bank</td>
      <td>:</td>
      <td><?php echo $value->bank; ?></td>
    </tr>
    <tr>
      <td>No. Rekening</td>
      <td>:</td>
      <td><?php echo $value->norek; ?></td>
    </tr>
    <tr>
      <td>Atas Nama</td>
      <td>:</td>
      <td><?php echo $value->atas_nama; ?></td>
    </tr>
  <?php endforeach ?>
</table>

<div style="float: left; margin-top: 40px;">
 <center>
   Mengetahui
 </center>
 <hr style="margin-top: 80px;">
 <?php foreach ($detail['data']->result() as $value): ?>
   <?php echo ucwords($value->detailer); ?>
 <?php endforeach ?>
</div>
<div style="float: right; margin-top: 40px;">
 <center>
   Menyetujui
 </center>
 <hr style="margin-top: 80px;">
 <?php foreach ($detail['data']->result() as $value): ?>
   <?php echo $value->direktur; ?>
 <?php endforeach ?>
</div>
</div>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    print();
  });
</script>