<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in system/libraries/ or your
| application/libraries/ directory, with the addition of the
| 'database' library, which is somewhat of a special case.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/
$autoload['libraries'] = array(
  'Nucleus_Sales_Utility' => 'nsu',
  'database',
  'session',
  'parser',
  'upload',
  'image_lib',
);

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|	$autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array(
  'form',
  'url',
);

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/
$autoload['model'] = array(
  // core
  'core/Master_Jabatan',
  'master/Master_Jenis_Produk',
  'master/Master_Distributor',
  'master/Master_Cogm',
  'core/User_Account',
  'core/Dist_Subdist',
  'core/Target_Detailer',
  'core/Kog_Kot',
  'core/Achievement',
  'core/M_Dashboard',
  'core/Insentif',
   
  // master
  'master/Area',
  'master/Distributor',
  'master/Cogm',
  'master/Operasional',
  'master/Operasional_Status',
  'master/Subdist_distributor',
  'master/Produk',
  'master/Outlet',
  'master/Aset',
  'master/Aset_Penyusutan',
  'master/Customer',
  'master/Customer_Non',
  'master/Detailer',
  'master/Detailer_Keluarga',
  'master/Detailer_Anak',
  'master/Detailer_Fieldforce',
  'master/Detailer_Gaji',
  'master/Subdist',
  'master/Produk_Harga',
  'master/Produk_Jenis',

  // master - view
  'master/User',

  // report
  'report/sales/Sales_Distributor' => 'salo',
  'report/sales/Sales_Actual' => 'sala',

  // transaction
  'transaction/ineks/Ekstensifikasi' => 'eks',
  'transaction/ineks/Intensifikasi' => 'ins',
  'transaction/ineks/Subdist_Eksten' => 'subeks',
  'transaction/ineks/Subdist_Intensifikasi' => 'subins',

  'transaction/fixed-cost/Fixed_Cost',

  'transaction/rtd/Rtd',
  'transaction/rtd/Rtd_Status',

  'transaction/pma/Pma',
  'transaction/pma/Pma_Detail',
  'transaction/pma/Pma_Status',

  'transaction/call-plan/Call_Plan',
  'transaction/call-plan/Call_Plan_Masuk',

  'transaction/wpr/Wpr',
  'transaction/wpr/Wpr_Detail',
  'transaction/wpr/Wpr_Status',

  'transaction/sales/Sales' => 'sal',
  'transaction/sales/Sales_Diskon' => 'sald',
  'transaction/sales/Sales_Subdist' => 'salsub',

  'transaction/sales-tender/Sales_Tender' => 'salt',
  'transaction/sales-tender/Sales_Tender_Diskon' => 'saltd',
  'transaction/sales-tender/Sales_Tender_Subdist' => 'saltsub',

  'transaction/sales-customer/Sales_Customer' => 'salcust',
  'transaction/sales-customer/Sales_Customer_Detail' => 'salcustd',

  'transaction/reward/Customer_Reward' => 'reward',
  'transaction/reward/Customer_Reward_Detail' => 'rewdetail',
  'transaction/reward/Customer_Reward_Status' => 'rewstatus',

  'transaction/ko-general/Ko_General' => 'kog',
  'transaction/ko-general/Ko_General_Detail' => 'kogd',
  'transaction/ko-general/Ko_General_Onoff' => 'kogo',
  'transaction/ko-general/Ko_General_Onoff_Total' => 'kogot',
  'transaction/ko-general/Ko_General_Status' => 'kogs',

  'transaction/ko-tender/Ko_Tender' => 'kot',
  'transaction/ko-tender/Ko_Tender_Detail' => 'kotd',
  'transaction/ko-tender/Ko_Tender_Onoff' => 'koto',
  'transaction/ko-tender/Ko_Tender_Onoff_Total' => 'kotot',
  'transaction/ko-tender/Ko_Tender_Status' => 'kots',

  'transaction/permohonan-produk/nucleus/Permohonan_Produk_Nucleus' => 'ppn', 
  'transaction/permohonan-produk/nucleus/Permohonan_Produk_Nucleus_Detail' => 'ppnd', 
  'transaction/permohonan-produk/nucleus/Permohonan_Produk_Nucleus_Status' => 'ppns',

  'transaction/permohonan-produk/distributor/Permohonan_Produk_Distributor' => 'ppd', 
  'transaction/permohonan-produk/distributor/Permohonan_Produk_Distributor_Detail' => 'ppdd', 
  'transaction/permohonan-produk/distributor/Permohonan_Produk_Distributor_Status' => 'ppds',

  'transaction/permohonan-produk/subdist/Permohonan_Produk_Subdist' => 'pps', 
  'transaction/permohonan-produk/subdist/Permohonan_Produk_Subdist_Detail' => 'ppsd', 
  'transaction/permohonan-produk/subdist/Permohonan_Produk_Subdist_Status' => 'ppss',

  'transaction/promo-trial/Promo_Trial' => 'pt',
  'transaction/promo-trial/Promo_Trial_Detail' => 'ptd',
  'transaction/promo-trial/Promo_Trial_Status' => 'pts',

  // report
  'report/sales/Sales_Daily' => 'gsal',
  'report/stock-nucleus/Barang_Masuk_Nucleus' => 'bmn',
  'report/stock-nucleus/Barang_Keluar_Nucleus' => 'bkn',
  'report/stock-nucleus/Barang_Stok_Nucleus' => 'bsn',

  'report/stock-distributor/Barang_Masuk_Distributor' => 'bmd',
  'report/stock-distributor/Barang_Keluar_Distributor' => 'bkd',
  'report/stock-distributor/Barang_Stok_Distributor' => 'bsd',

  'report/stock-subdist/Barang_Masuk_Subdist' => 'bms',
  'report/stock-subdist/Barang_Keluar_Subdist' => 'bks',

  'report/entry-breakdown/Entry_Breakdown',

  'report/pemindahan-sales/Pemindahan_Sales',
  'report/pemindahan-sales/Pemindahan_Sales_Detail',
  'report/pemindahan-sales/Pemindahan_Sales_Status',
  
  'report/klm/Klm',

);
