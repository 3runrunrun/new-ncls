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
            <h2 style="margin-top: 5px;">Promo Trial</h2>
        </center>
        <table>
            <?php foreach ($detail['data']->result() as $value): ?>
           <tr>
               <td>No. Promo</td>
               <td>:</td>
               <td><?php echo str_replace('-', '/', strtoupper($value->no_promo)); ?></td>
           </tr>
           <tr>
            <td>Nama Detailer</td>
            <td>:</td>
            <td><?php echo ucwords($value->nama_detailer); ?></td>
        </tr>
           <td>Customer</th>
               <td>:</td>
               <td><?php echo ucwords($value->nama_customer); ?></td>
           </tr>
        <tr>
           <td>Area</th>
               <td>:</td>
               <td><?php echo ucwords($value->nama_area); ?></td>
           </tr>
        <tr>
       <?php endforeach; ?>
       </table>

       <table style="border: 1px; width: 100%; margin-top:20px;" border="1" cellspacing="0">
           <tr>
               <th>No</th>
               <th>Produk</th>
               <th>Jumlah</th>
           </tr>
           <?php $no = 0; ?>
           <?php foreach ($produk['data']->result() as $value): ?>
            <tr>
                <td><center><?php echo $no += 1; ?></center></td>
                <td><center><?php echo ucwords($value->nama); ?></center></td>
                <td><center><?php echo $value->jumlah; ?></center></td>
            </tr>
           <?php endforeach; ?>     
       </table> 
       <div style="float: left; margin-top: 40px;">
           <center>
               Mengetahui
           </center>
           <hr style="margin-top: 80px;">
       </div>
       <div style="float: right; margin-top: 40px;">
           <center>
               Menyetujui
           </center>
           <hr style="margin-top: 80px;">
       </div>
   </div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        print();
    });
</script>