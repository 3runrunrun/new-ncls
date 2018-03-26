<html>
<head>
  <title>Print Data Karyawan</title>
  <style type="text/css">
  body{
    font-family: Times New Roman;
    font-size: 12pt;
  }
  table{
    font-size: 12pt;
    border-spacing: 0px;
  }
  tr{

  }
  .tengah{
   margin-left:auto;
   margin-right:auto;
   margin-top:40px;
   margin-bottom:20px;
   left:0;
   right:0;
   top:0;
   bottom:0;
   width: 85%;
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
    <img src="<?php echo base_url() ?>/img/logo-small.png" style="max-height: 150px; max-width: 250px; margin-bottom: 10px;"> 
    <center>
      
      <!-- <?php var_dump($halaman1['data']->row()); ?> -->
      <?php $page1 = $halaman1['data']->row(); ?>
      <?php $bojo = $istri['data']->result(); ?>
      <?php $anak = $anak['data']->result(); ?>

      <U><h2>DATA KARYAWAN</h2></U>
    </center>
    <table border="0" width="100%" cellspacing="0">
      <tr>
        <td width="35%">Nama Karyawan</td>
        <td width="1%">:</td>
        <td><?php echo strtoupper($page1->nama_detailer); ?></td>  
        <td> Jenis Kelamin : 
          <?php 
            if ($page1->jenis_kelamin == 'laki-laki') {
              echo "L";
            } else {
              echo "P";
            }
          ?>
        </td>
      </tr>
      <tr>
        <td>Area</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->nama_area); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Tgl Masuk Nucleus Farma</td>
        <td>:</td>
        <td><?php echo date('d F Y', strtotime($page1->tanggal_masuk)) ; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->jabatan); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>SPV/DSM/RSM</td>
        <td>:</td>
        <td><?php echo $page1->id_spv; ?> / <?php echo $page1->id_rm; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Agama</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->agama); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td></td>  
        <td></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sesuai KTP</td>
        <td>:</td>
        <td></td>  
        <td></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sebenarnya</td>
        <td>:</td>
        <td></td>  
        <td></td>
      </tr>
      <tr>
        <td>No. KTP</td>
        <td>:</td>
        <td><?php echo $page1->ktp; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Telephone</td>
        <td>:</td>
        <td><?php echo $page1->notelp; ?> / <?php echo $page1->nohp; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Tempat & Tanggal Lahir</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->tempat_lahir); ?>, <?php echo date('d F Y', strtotime($page1->tanggal_lahir)) ; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Kewarganegaraan</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->kewarganegaraan); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Pendidikan Terakir</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->pendidikan_terakhir); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Status Perkawinan</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->status_kawin); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Nama Istri</td>
        <td>:</td>
        <td></td>  
        <td></td>
      </tr>
      <?php $i = 1; ?>
      <?php foreach ($bojo as $key => $value): ?>
      <tr>
        <td></td>
        <td>:</td>
        <td><?php echo $i; ?>. <?php echo strtoupper($value->istri); ?></td>  
        <td></td>
      </tr>
      <?php $i++; ?>
      <?php endforeach ?>
      <tr>
        <td>Anak-Anak</td>
        <td>:</td>
        <td></td>  
        <td></td>
      </tr>
      <?php $i = 1; ?>
      <?php if (empty($anak)): ?>
      <tr>
        <td></td>
        <td></td>
        <td>Tidak Punya Anak</td>  
        <td></td>
      </tr>  
      <?php elseif (!empty($anak)): ?>
      <?php foreach ($anak as $value): ?>
      <tr>
        <td></td>
        <td>:</td>
        <td><?php echo $i; ?>. <?php echo strtoupper($value->anak); ?></td>  
        <td></td>
      </tr>
      <?php $i++; ?>
      <?php endforeach ?>
      <?php endif ?>
      <tr>
        <td>Pekerjaan Terakhir</td>
        <td>:</td>
        <td></td>  
        <td></td>
      </tr>
      <tr>
        <td>Net Salary</td>
        <td>:</td>
        <td>Rp. <?php echo $page1->gaji; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Sewa Kendaraan</td>
        <td>:</td>
        <td>Rp. <?php echo $page1->sewa_kendaraan; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Housing</td>
        <td>:</td>
        <td>Rp. <?php echo $page1->housing; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Tunj. Kemahalan</td>
        <td>:</td>
        <td>Rp. <?php echo $page1->tunjangan; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>BANK</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->bank); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>No. AC</td>
        <td>:</td>
        <td><?php echo $page1->norek; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td>:</td>
        <td>Area Baru(Yes/No)*</td>  
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>YES, Nama Area :</td>  
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>No, Menggantikan : ex</td>  
        <td></td>
      </tr>
    </table>
  </div>

<!-- CETAK BAGIAN KE DUA -->

<style type="text/css" media="print">
  .page-break  { display:block; page-break-before:always; }
</style>
<div class="page-break"></div>

    <div class="tengah">
    <img src="<?php echo base_url() ?>/img/logo-small.png" style="max-height: 150px; max-width: 250px; margin-bottom: 10px;"> 
    <center>
      <U><h2>FORM FIELDFORCE BARU</h2></U>
    </center>
    <table border="0" width="100%" cellspacing="0">
      <tr>
        <td width="3%">01.</td>
        <td width="35%">Nama Karyawan</td>
        <td width="2%">:</td>
        <td><?php echo strtoupper($page1->nama_detailer); ?></td>  
        <td> Jenis Kelamin : 
          <?php 
            if ($page1->jenis_kelamin == 'laki-laki') {
              echo "L";
            } else {
              echo "P";
            }
          ?>
        </td>
      </tr>
      <tr>
        <td width="2%">02.</td>
        <td>Area</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->nama_area); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">03.</td>
        <td>Tgl Masuk</td>
        <td>:</td>
        <td><?php echo date('d F Y', strtotime($page1->tanggal_masuk)) ; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">04.</td>
        <td>Jabatan</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->jabatan); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">05.</td>
        <td>SPV/DSM/RSM</td>
        <td>:</td>
        <td><?php echo $page1->id_spv; ?> / <?php echo $page1->id_rm; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">06.</td>
        <td>Agama</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->agama); ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">07.</td>
        <td>Tempat & Tanggal Lahir</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->tempat_lahir); ?>, <?php echo date('d F Y', strtotime($page1->tanggal_lahir)) ; ?></td>  
        <td></td>
      </tr>      
      <tr>
        <td width="2%">08.</td>
        <td>Telp. Rumah/ HP</td>
        <td>:</td>
        <td><?php echo $page1->notelp; ?> / <?php echo $page1->nohp; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">09.</td>
        <td>Net Salary</td>
        <td>:</td>
        <td>Rp. <?php echo $page1->gaji; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">10.</td>
        <td>Housing</td>
        <td>:</td>
        <td>Rp. <?php echo $page1->housing; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">11.</td>
        <td>Sewa Kendaraan</td>
        <td>:</td>
        <td>Rp. <?php echo $page1->sewa_kendaraan; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">12.</td>
        <td>Tunjagan Kemahalan</td>
        <td>:</td>
        <td>Rp. <?php echo $page1->tunjangan; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">13.</td>
        <td>Bank / No. AC</td>
        <td>:</td>
        <td><?php echo strtoupper($page1->bank); ?> / <?php echo $page1->norek; ?></td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%">14.</td>
        <td>Keterangan</td>
        <td>:</td>
        <td>Area Baru(Yes/No)*</td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%"></td>
        <td></td>
        <td></td>
        <td>YES, Nama Area :</td>  
        <td></td>
      </tr>
      <tr>
        <td width="2%"></td>
        <td></td>
        <td></td>
        <td>No, Menggantikan : ex</td>  
        <td></td>
      </tr>
    </table>
  </div>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    print();
  });
</script>