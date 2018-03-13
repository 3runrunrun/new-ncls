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
  'master/Area',
  'master/Distributor',
  'master/Master_Distributor',
  'master/Cogm',
  'master/Master_Cogm',
  
  'master/Operasional',
  'master/Subdist_distributor',

  // report
  'master/Produk',
  'master/Outlet',
  'master/Aset',
  'master/Customer',
  'master/Detailer',
  'master/Subdist',

  //aset
  'aset/Aset',
  'aset/Aset_Penyusutan',

  // report
  'report/sales/Sales_Distributor' => 'salo',

  // transaction
  'transaction/ineks/Ekstensifikasi' => 'eks',
  'transaction/ineks/Intensifikasi' => 'ins',
  'transaction/ineks/Subdist_Eksten' => 'subeks',
  'transaction/ineks/Subdist_Intensifikasi' => 'subins',

  'transaction/wpr/Wpr',
  'transaction/wpr/Wpr_Detail',
  'transaction/wpr/Wpr_Status',

  'transaction/sales/Sales' => 'sal',
  'transaction/sales/Sales_Diskon' => 'sald',
  'transaction/sales/Sales_Subdist' => 'salsub',

  'transaction/sales-customer/Sales_Customer' => 'salcust',
  'transaction/sales-customer/Sales_Customer_Detail' => 'salcustd',

  'transaction/reward/Customer_Reward' => 'reward',
  'transaction/reward/Customer_Reward_Detail' => 'rewdetail',
  'transaction/reward/Customer_Reward_Status' => 'rewstatus',

  'transaction/ko-general/Ko_General' => 'kog',
  'transaction/ko-general/Ko_General_Detail' => 'kogd',
  'transaction/ko-general/Ko_General_Onoff' => 'kogo',
  'transaction/ko-general/Ko_General_Status' => 'kogs',

  'transaction/ko-tender/Ko_Tender' => 'kot',
  'transaction/ko-tender/Ko_Tender_Detail' => 'kotd',
  'transaction/ko-tender/Ko_Tender_Onoff' => 'koto',
  'transaction/ko-tender/Ko_Tender_Status' => 'kots',
);
