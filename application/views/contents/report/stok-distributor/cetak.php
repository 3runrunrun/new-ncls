<html>
<head>
  <title>Print Produk Nucleus</title>
  <style type="text/css">
  body{
    font-family: arial;
    font-size: 11pt;
  }
  table{
    font-size: 11pt;
  }
  tr{
    text-align: center;
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
   padding: 20px 10px 0 10px;
 }

 @page {
  size: A4;
  margin: 0px;
}
</style>
<style type="text/css" media="print">
@page { 
  size: portrait;
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
    <img src="<?php echo base_url() ?>/img/logo-small.png" style="max-height: 150px; max-width: 250px; margin-bottom: 40px;"> 
    <h3>Rekap Pengiriman Barang Nucleus ke Distributor</h3>
    
    <table border="1" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th rowspan="2">Tanggal</th>
          <th rowspan="2">Nama Produk</th>
          <th colspan="3">Kemasan</th>
          <th rowspan="2">Harga</th>
          <th rowspan="2">Total Tagih</th>
        </tr>
        <tr>
          <th>Batch Number</th>
          <th>Jenis</th>
          <th>Jumlah</th>     
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; ?>
        <?php foreach ($produk['data']->result() as $value): ?>
          <tr>
            <td>
              <?php $status = null; ?>
              <?php foreach ($detail['data']->result() as $valueT): ?>
                <?php echo date('d-M-Y', strtotime($valueT->tanggal)); ?>
              <?php endforeach; ?>
            </td>
            <?php $count += 1; ?> 
            <td><?php echo strtoupper($value->nama); ?></td> 
            <td>
              <?php if ($value->batch_number === null && $approve !== null): ?>
                <div class="card-block width-200">
                  <input type="text" name="batch_number[]" class="form-control border-primary" placeholder="Batch Number" required>
                </div>
              <?php else: ?>
                <?php echo $value->batch_number; ?>
              <?php endif ?>
            </td>            
            <td><?php echo strtoupper($value->kemasan); ?></td>           
            <td><?php echo strtoupper($value->jumlah); ?></td>
            
            <td>
              <?php echo strtoupper($value->harga_master); ?>
            </td>
            
            <td>
              <?php echo strtoupper($value->total_tagihan); ?>
            </td>

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