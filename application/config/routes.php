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
$route['default_controller'] = 'Main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['migrate/(:any)/(:num)'] = 'Migrate/$1/$2';
$route['migrate/(:any)'] = 'Migrate/$1';
$route['migrate'] = 'Migrate/index';

$route['api/reservation/(:any)'] = 'Reservation/$1';
$route['api/category/(:any)'] = 'Categories/$1';
$route['api/book/(:any)'] = 'Books/$1';
$route['api/copy/(:any)'] = 'Copies/$1';
$route['api/cart/(:any)'] = 'Cart/$1';

$route['acquisition/(:any)'] = 'Acquisition/$1';
$route['acquisition'] = 'Acquisition/index';

$route['reservation/(:any)'] = 'Reservation/$1';
$route['reservation'] = 'Reservation/index';

$route['shelf/(:any)'] = 'Shelf/$1';
$route['shelf'] = 'Shelf/index';

$route['inventory/(:any)/(:num)'] = 'Inventory/$1/$2';
$route['inventory/(:any)'] = 'Inventory/$1';
$route['inventory'] = 'Inventory/index';

$route['account/(:any)/(:num)'] = 'Account/$1/$2';
$route['account/(:any)'] = 'Account/$1';
$route['account'] = 'Account/index';

$route['circulation'] = 'Circulation/index';

$route['catalog'] = 'Catalog/index';

$route['cart'] = 'Cart/index';

$route['settings'] = 'Settings/index';

$route['(:any)'] = 'Main/$1';