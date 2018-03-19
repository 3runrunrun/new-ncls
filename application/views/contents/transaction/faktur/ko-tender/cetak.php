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
   padding: 0px 10px 0 10px;
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
  -webkit-transform: rotate(360deg); -moz-transform:rotate(-90deg);
  filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
</style>
</head>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>

<body class="page">
  <div class="tengah">
    <center>
      <img src="<?php echo base_url() ?>/img/logo-small.png" style="max-height: 100px; max-width: 200px; margin-bottom: 40px;">
      
    </center>
    <?php foreach ($detail['data']->result() as $value): ?>
      <?php $status = $value->status; ?>
      <?php $distributor = $value->nama_distributor; ?>
      Jakarta, <?php echo date('d-M-Y', strtotime($value->tanggal)); ?>
      <br>
      <br>
      Kepada Yth: <br>
      Direktur Nucleus Farma
      <br>
      <div style="margin-top: 30px; margin-bottom: 20px;">
        Dengan hormat,<br>
        Melalui surat ini, Kami bermaksud untuk mengajukan permohonan diskon untuk outlet:
      </div>
    <?php endforeach; ?>

    <table border="1" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th rowspan="2">Kode Outlet</th>
          <th rowspan="2">Outlet</th>
          <th rowspan="2">Kota</th>
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
              <?php echo strtoupper($value->id_outlet); ?>
            </td>
            <td>
              <?php echo strtoupper($value->nama_outlet); ?>
            </td>
            <td>
              <?php echo strtoupper($value->nama_area); ?>
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

    <br>
    KO ON & OFF Faktur
    <br>     

    <table border="1" width="50%" cellspacing="0">
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


    <?php foreach ($detail['data']->result() as $value): ?>
      <?php $status = $value->status; ?>
      <?php $distributor = $value->nama_distributor; ?>
      <div style="margin-top: 40px;">
        Demikian surat ini kami sampaikan, Bila surat ini sudah di setujui harap Fax kembali ke pihak
        <b><?php echo strtoupper($value->nama_distributor); ?></b><br>
        Atas perhatian Bapak, kami sampaikan terima kasih.
      </div>


      <div style="margin-top: 30px;">
       Hormat Kami
     </div>

     <div style="float: left; margin-top: 10px; margin-right: 15%;">
       Yang Mengajukan
       <hr style="margin-top: 80px;">
       <?php echo strtoupper($value->nama); ?>
     </div>

     <div style="float: left; margin-top: 10px; margin-right: 15%;">
       Menyetujui
       <hr style="margin-top: 80px;">
       <?php echo strtoupper($value->nama_rm); ?>
     </div>

     <div style="float: left; margin-top: 10px;">
       Approve
       <hr style="margin-top: 80px;">
       <?php echo strtoupper($value->nama_direktur); ?>
     </div>
     <?php endforeach; ?>


     <div style="float: right; margin-top: 20px;">
       <hr style="margin-top: 80px;">
       <?php echo strtoupper($distributor); ?>
     </div>
     <div style="margin-right: 10px 2% 0% 2%; float: right; margin-top: 10px;">     
       <center>
         Mengetahui,
       </center>
     </div>
     <div style="float: right; margin-top: 20px;">
       <hr style="margin-top: 80px;">
       <?php echo strtoupper($distributor); ?>
     </div>
   
 </div>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    print();
  });
</script>