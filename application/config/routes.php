<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'Home/login';
$route['auth'] = 'Home/auth';

$route['dashboard'] = 'Home/index';

/**
|
| Master 
|
 */
// area
$route['master-area'] = 'master/C_Area/index';
$route['store-area'] = 'master/C_Area/store';
$route['store-area/(:any)'] = 'master/C_Area/store/$1';

// detailer
$route['master-detailer'] = 'master/C_Detailer/index';
$route['store-detailer'] = 'master/C_Detailer/store';
$route['store-detailer/(:any)'] = 'master/C_Detailer/store/$1';
$route['print-detailer/(:any)'] = 'master/C_Detailer/print/$1';

// operasional
$route['master-operasional'] = 'master/C_Operasional/index';
$route['master-operasional-print/(:any)'] = 'master/C_Operasional/cetak/$1';
$route['store-operasional'] = 'master/C_Operasional/store';
$route['store-operasional/(:any)'] = 'master/C_Operasional/store/$1';

// aset
$route['master-aset'] = 'master/C_Aset/index';
$route['store-aset'] = 'master/C_Aset/store';
$route['store-aset/(:any)'] = 'master/C_Aset/store/$1';

// produk
$route['master-product'] = 'master/C_Produk/index';
$route['store-product'] = 'master/C_Produk/store';
$route['store-product/(:any)'] = 'master/C_Produk/store/$1';

// outlet
$route['master-outlet'] = 'master/C_Outlet/index';
$route['store-outlet'] = 'master/C_Outlet/store';
$route['store-outlet/(:any)'] = 'master/C_Outlet/store/$1';

// customer
$route['master-customer'] = 'master/C_Customer/index';
$route['store-customer'] = 'master/C_Customer/store';
$route['store-customer/(:any)'] = 'master/C_Customer/store/$1';

// customer non
$route['master-customer-non'] = $route['master-outlet'];

// distributor
$route['master-distributor'] = 'master/C_Distributor/index';
$route['store-distributor'] = 'master/C_Distributor/store';
$route['store-distributor/(:any)'] = 'master/C_Distributor/store/$1';

// subdist
$route['master-subdistributor'] = 'master/C_Subdistributor/index';
$route['store-subdistributor'] = 'master/C_Subdistributor/storeSubdist';
$route['store-subdistributor/(:any)'] = 'master/C_Subdistributor/storeSubdist/$1';
$route['store-subdistributorEkstern'] = 'master/C_Subdistributor/storeSubdistEkstern';
$route['store-subdistributorEkstern/(:any)'] = 'master/C_Subdistributor/storeSubdistEkstern/$1';
$route['store-subdistributorIntern'] = 'master/C_Subdistributor/storeSubdistIntern';
$route['store-subdistributorIntern/(:any)'] = 'master/C_Subdistributor/storeSubdistIntern/$1';

// cogm
$route['master-cogm'] = 'master/C_Cogm/index';
$route['store-cogm'] = 'master/C_Cogm/store';
$route['store-cogm/(:any)'] = 'master/C_Cogm/store/$1';

/**
|
| Transaction 
|
 */
// subdist
$route['subdist'] = 'transaction/C_Subdist/index';
$route['detail-subdist/(:any)'] = 'transaction/C_Subdist/show/$1';

// ineks
$route['prospek-ineks'] = 'transaction/C_Pros_Inten_Eksten/index';
$route['store-eksten'] = 'transaction/C_Pros_Inten_Eksten/store_eksten';
$route['store-eksten/(:any)'] = 'transaction/C_Pros_Inten_Eksten/store_eksten/$1';

$route['detailer-intens/(:any)'] = 'transaction/C_Pros_Inten_Eksten/show_intens/$1';
$route['detail-intens/(:any)'] = 'transaction/C_Pros_Inten_Eksten/show/$1';
$route['store-intens'] = 'transaction/C_Pros_Inten_Eksten/store_intens';
$route['store-intens/(:any)'] = 'transaction/C_Pros_Inten_Eksten/store_intens/$1';

// fixed cost
$route['fixed-cost'] = 'transaction/C_Fixed_Cost_Ratio/index';
$route['detail-fixed-cost/(:any)'] = 'transaction/C_Fixed_Cost_Ratio/show/$1';

// rtd
$route['rtd'] = 'transaction/C_Prospect_RTD/index';
$route['store-rtd'] = 'transaction/C_Prospect_RTD/store';
$route['store-rtd/(:any)'] = 'transaction/C_Prospect_RTD/store/$1';

// pma
$route['pma'] = 'transaction/C_Pros_Marketing_Act/index';
$route['store-pma'] = 'transaction/C_Pros_Marketing_Act/store';
$route['store-pma/(:any)'] = 'transaction/C_Pros_Marketing_Act/store/$1';
$route['store-pma-expense'] = 'transaction/C_Pros_Marketing_Act/store_expense';

// evaluasi
$route['evaluasi-target-customer'] = 'transaction/C_Evaluasi_Target_Customer/index';
$route['detail-evaluasi/(:any)'] = 'transaction/C_Evaluasi_Target_Customer/show/$1';

// call plan
$route['target-call-plan'] = 'transaction/C_Evaluasi_CP_SPV/index';
$route['store-target-call-plan'] = 'transaction/C_Evaluasi_CP_SPV/store';
$route['store-target-call-plan/(:any)'] = 'transaction/C_Evaluasi_CP_SPV/store/$1';
$route['evaluasi-call-plan'] = 'transaction/C_Evaluasi_CP_SPV/evaluasi';

// promo trial
$route['promo-trial'] = 'transaction/C_Promo_Trial/index';
$route['store-promo'] = 'transaction/C_Promo_Trial/store';
$route['store-promo/(:any)'] = 'transaction/C_Promo_Trial/store/$1';
$route['print-promo/(:any)'] = 'transaction/C_Promo_Trial/cetak/$1';
$route['detail-promo/(:any)'] = 'transaction/C_Promo_Trial/show/$1';
$route['detail-promo/(:any)/(:any)'] = 'transaction/C_Promo_Trial/show/$1/$2';

//  wpr
$route['wpr'] = 'transaction/C_WPR/index';
$route['store-wpr'] = 'transaction/C_WPR/store';
$route['store-wpr/(:any)'] = 'transaction/C_WPR/store/$1';
$route['print-wpr/(:any)'] = 'transaction/C_WPR/cetak/$1';
$route['detail-wpr/(:any)'] = 'transaction/C_WPR/show/$1';
$route['detail-wpr/(:any)/(:any)'] = 'transaction/C_WPR/show/$1/$2';

// ko
$route['daftar-faktur'] = 'transaction/C_Data_Faktur/index';
$route['ko-general'] = 'transaction/C_General/index';
$route['detail-ko-general/(:any)'] = 'transaction/C_General/show/$1';
$route['detail-ko-general/(:any)/(:any)'] = 'transaction/C_General/show/$1/$2';
$route['print-ko-general/(:any)'] = 'transaction/C_General/cetak/$1';
$route['store-general'] = 'transaction/C_General/store';
$route['store-general/(:any)'] = 'transaction/C_General/store/$1';

$route['ko-tender'] = 'transaction/C_Tender/index';
$route['detail-ko-tender/(:any)'] = 'transaction/C_Tender/show/$1';
$route['detail-ko-tender/(:any)/(:any)'] = 'transaction/C_Tender/show/$1/$2';
$route['print-ko-tender/(:any)'] = 'transaction/C_Tender/cetak/$1';
$route['store-tender'] = 'transaction/C_Tender/store';
$route['store-tender/(:any)'] = 'transaction/C_Tender/store/$1';

/**
|
| Report 
|
 */
// daily sales
$route['daily-sales-product'] = 'report/C_Daily_Sales/show_product';
$route['daily-sales-outlet'] = 'report/C_Daily_Sales/show_outlet';
$route['detail-sales-outlet/(:any)'] = 'report/C_Daily_Sales/detail_outlet/$1';
$route['store-sales'] = 'report/C_Daily_Sales/store';
$route['store-sales/(:any)'] = 'report/C_Daily_Sales/store/$1';

// sales distributor
$route['sales-distributor'] = 'report/C_Daily_Sales_Distributor/index';

// stok produk nucleus
$route['stock-product-nucleus'] = 'report/C_Stock_Product_Nucleus/index';
$route['detail-product-nucleus/(:any)'] = 'report/C_Stock_Product_Nucleus/show/$1';
$route['print-product-nucleus/(:any)'] = 'report/C_Stock_Product_Nucleus/cetak/$1';
$route['detail-product-nucleus/(:any)/(:any)'] = 'report/C_Stock_Product_Nucleus/show/$1/$2';
$route['store-product-nucleus'] = 'report/C_Stock_Product_Nucleus/store';
$route['store-product-nucleus/(:any)'] = 'report/C_Stock_Product_Nucleus/store/$1';
$route['print-product-nucleus/(:any)'] = 'report/C_Stock_Product_Nucleus/cetak/$1';

// stok produk distributor
$route['stock-product-distributor'] = 'report/C_Stock_Product_Distributor/index';
$route['detail-product-distributor/(:any)'] = 'report/C_Stock_Product_Distributor/show/$1';
$route['print-product-distributor/(:any)'] = 'report/C_Stock_Product_Distributor/cetak/$1';
$route['detail-product-distributor/(:any)/(:any)'] = 'report/C_Stock_Product_Distributor/show/$1/$2';
$route['store-product-distributor'] = 'report/C_Stock_Product_Distributor/store';
$route['store-product-distributor/(:any)'] = 'report/C_Stock_Product_Distributor/store/$1';

// entry breakdown sales
$route['entry-breakdown-general'] = 'report/C_Entry_Breakdown/show_general';
$route['detail-breakdown-general/(:any)'] = 'report/C_Entry_Breakdown/show/$1';
$route['entry-breakdown-product'] = 'report/C_Entry_Breakdown/show_product';
$route['store-entry-breakdown'] = 'report/C_Entry_Breakdown/store';
$route['store-entry-breakdown/(:any)'] = 'report/C_Entry_Breakdown/store/$1';

// pemindahan sales
$route['pemindahan-sales'] = 'report/C_Pemindahan_Sales/index';
$route['detail-pemindahan-sales/(:any)'] = 'report/C_Pemindahan_Sales/show/$1';
$route['detail-pemindahan-sales/(:any)/(:any)'] = 'report/C_Pemindahan_Sales/show/$1/$2';
$route['store-pemindahan-sales'] = 'report/C_Pemindahan_Sales/store';
$route['store-pemindahan-sales/(:any)'] = 'report/C_Pemindahan_Sales/store/$1';

// actual sales
$route['actual-sales'] = 'report/C_Actual_Sales/index';

// reward
$route['reward'] = 'report/C_Reward/index';
$route['store-reward'] = 'report/C_Reward/store';
$route['store-reward/(:any)'] = 'report/C_Reward/store/$1';

// klm
$route['klm'] = 'report/C_Klm/index';
$route['klm-sales'] = 'report/C_Klm/show_sales';
$route['show-klm-dana'] = 'report/C_Klm/show_dana';
$route['detail-klm-dana/(:any)'] = 'report/C_Klm/detail_dana/$1';
$route['print-klm-dana/(:any)'] = 'report/C_Klm/cetak/$1';
