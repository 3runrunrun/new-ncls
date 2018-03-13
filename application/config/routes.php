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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
|
| Master 
|
 */
// area
$route['master-area'] = 'master/C_Area/index';
$route['store-area'] = 'master/C_Area/store';
$route['store-area/(:any)'] = 'master/C_Area/store/$1';
$route['master-operasional'] = 'master/C_Operasional/index';
$route['master-aset'] = 'master/C_Aset/index';
$route['master-produk'] = 'master/C_Produk/index';
$route['store-produk/(:any)'] = 'master/C_Produk/store/$1';
$route['store-operasional/(:any)'] = 'master/C_Operasional/store/$1';
$route['store-aset/(:any)'] = 'master/C_Aset/store/$1';
$route['master-outlet'] = 'master/C_Outlet/index';
$route['store-outlet/(:any)'] = 'master/C_Outlet/store/$1';
$route['master-customer'] = 'master/C_Customer/index';
$route['store-customer/(:any)'] = 'master/C_Customer/store/$1';

// distributor
$route['master-distributor'] = 'master/C_Distributor/index';
$route['store-distributor'] = 'master/C_Distributor/store';
$route['store-distributor/(:any)'] = 'master/C_Distributor/store/$1';
$route['master-subdistributor'] = 'master/C_Subdistributor/index';
$route['store-subdistributor/(:any)'] = 'master/C_Subdistributor/storeSubdist/$1';
$route['store-subdistributorEkstern/(:any)'] = 'master/C_Subdistributor/storeSubdistEkstern/$1';
$route['store-subdistributorIntern/(:any)'] = 'master/C_Subdistributor/storeSubdistIntern/$1';

// cogm
$route['master-cogm'] = 'master/C_Cogm/index';
$route['store-cogm'] = 'master/C_Cogm/store';
$route['store-cogm/(:any)'] = 'master/C_Cogm/store/$1';



/**
|
| Report 
|
 */
$route['daily-sales-product'] = 'report/C_Daily_Sales/show_product';
$route['daily-sales-outlet'] = 'report/C_Daily_Sales/show_outlet';
$route['store-sales'] = 'report/C_Daily_Sales/store';
$route['store-sales/(:any)'] = 'report/C_Daily_Sales/store/$1';

$route['daily-sales-distributor'] = 'report/C_Daily_Sales_Distributor/index';
$route['store-sales-distributor'] = 'report/C_Daily_Sales_Distributor/store';
$route['store-sales-distributor/(:any)'] = 'report/C_Daily_Sales_Distributor/store/$1';

$route['stock-product-nucleus'] = 'report/C_Stock_Product_Nucleus/index';
$route['store-product-nucleus'] = 'report/C_Stock_Product_Nucleus/store';
$route['store-product-nucleus/(:any)'] = 'report/C_Stock_Product_Nucleus/store/$1';

$route['stock-product-distributor'] = 'report/C_Stock_Product_Distributor/index';
$route['store-product-distributor'] = 'report/C_Stock_Product_Distributor/store';
$route['store-product-distributor/(:any)'] = 'report/C_Stock_Product_Distributor/store/$1';

$route['entry-breakdown-general'] = 'report/C_Entry_Breakdown/show_general';
$route['entry-breakdown-product'] = 'report/C_Entry_Breakdown/show_product';
$route['store-entry-breakdown'] = 'report/C_Entry_Breakdown/store';
$route['store-entry-breakdown/(:any)'] = 'report/C_Entry_Breakdown/store/$1';

$route['pemindahan-sales'] = 'report/C_Pemindahan_Sales/index';
$route['pemindahan-sales'] = 'report/C_Pemindahan_Sales/store';
$route['pemindahan-sales/(:any)'] = 'report/C_Pemindahan_Sales/store/$1';

$route['actual-sales'] = 'report/C_Actual_Sales/index';

$route['reward'] = 'report/C_Reward/index';
$route['store-reward'] = 'report/C_Reward/store';
$route['store-reward/(:any)'] = 'report/C_Reward/store/$1';

$route['klm'] = 'report/C_Klm/index';

