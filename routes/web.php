<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('faqs', 'HomeController@faqs');
Route::get('help', 'HomeController@help');
Route::get('aboutus', 'HomeController@about');


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');



/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/
Route::get('welcome', 'DashboardController@welcome');
Route::get('acceptstock/{id}', 'DashboardController@acceptstock'); 
Route::get('declinestock/{id}', 'DashboardController@declinestock'); 




/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
*/
Route::get('registersuccess', 'UserController@registersuccess');
Route::post('storeuser', 'UserController@storeuser');
Route::post('updateuser/{id}', 'UserController@updateuser');
Route::post('adminsearchuser', 'UserController@adminsearchuser');
Route::get('blockuser/{id}', 'UserController@blockuser'); 
Route::get('unblockuser/{id}', 'UserController@unblockuser'); 
Route::get('deleteuser/{id}', 'UserController@deleteuser');




/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::resource('profile', 'ProfileController'); 
Route::post('profile/{id}/update', 'ProfileController@update');


/*
|--------------------------------------------------------------------------
| Products Routes
|--------------------------------------------------------------------------
|
*/
Route::get('products', 'ProductsController@products');
Route::post('products', 'ProductsController@searchproducts');



/*
|--------------------------------------------------------------------------
| Services Routes
|--------------------------------------------------------------------------
|
*/
Route::get('services', 'ServicesController@services');
Route::get('requestedservices', 'ServicesController@requestedservices');
Route::post('requestservice', 'ServicesController@storeservicerequest')->middleware('auth');;
Route::get('requestservice', 'ServicesController@requestservice');
Route::get('updateservice/{id}', 'ServicesController@updateservice');




/*
|--------------------------------------------------------------------------
| Contact Routes
|--------------------------------------------------------------------------
|
*/
Route::get('contact', 'ContactController@contact');
Route::post('contact', 'ContactController@sendemail');

/*
|--------------------------------------------------------------------------
| Announcements Routes
|--------------------------------------------------------------------------
*/
Route::post('storeannouncement', 'AnnouncementController@storeannouncement');
Route::post('updateannouncement/{id}', 'AnnouncementController@updateannouncement');
Route::get('deleteannouncement/{id}', 'AnnouncementController@deleteannouncement');

/*
|--------------------------------------------------------------------------
| Stock Routes
|--------------------------------------------------------------------------
*/
Route::post('storestock', 'StockController@storestock');
Route::post('suppliersearchstock', 'StockController@suppliersearchstock');

/*
|--------------------------------------------------------------------------
| Supply Routes
|--------------------------------------------------------------------------
*/
Route::post('storesupply', 'SupplyController@storesupply');
Route::post('suppliersearchupply', 'SupplyController@suppliersearchsupply');
Route::post('procurementsearchsupply', 'SupplyController@procurementsearchsupply');
Route::get('approvesupply/{id}', 'SupplyController@approvesupply');
Route::get('declinesupply/{id}', 'SupplyController@declinesupply');


/*
|--------------------------------------------------------------------------
| Vacancies Routes
|--------------------------------------------------------------------------
*/
Route::post('storevacancy', 'VacancyController@storevacancy');
Route::post('updatevacancy/{id}', 'VacancyController@updatevacancy');
Route::get('deletevacancy/{id}', 'VacancyController@deletevacancy');
Route::get('vacancies', 'VacancyController@vacancies');
Route::get('applyvacancy', 'VacancyController@applyvacancy');
Route::post('applyvacancy', 'VacancyController@storevacancyapplication');

/*
|--------------------------------------------------------------------------
| Tender Routes
|--------------------------------------------------------------------------
*/
Route::post('storetender', 'TendersController@storetender');
Route::post('updatetender/{id}', 'TendersController@updatetender');
Route::get('deletetender/{id}', 'TendersController@deletetender');
Route::get('tenders', 'TendersController@tenders');
Route::get('applytender', 'TendersController@applytender');
Route::post('applytender', 'TendersController@tenderapplication');
Route::get('approvetender/{id}', 'TendersController@approvetender'); 
Route::get('disapprovetender/{id}', 'TendersController@disapprovetender'); 


/*
|--------------------------------------------------------------------------
| Updates Routes
|--------------------------------------------------------------------------
*/
Route::post('storeupdate', 'UpdatesController@storeupdate');
Route::post('updateupdate/{id}', 'UpdatesController@updateupdate');
Route::get('deleteupdate/{id}', 'UpdatesController@deleteupdate');


/*
|--------------------------------------------------------------------------
| Feedback Routes
|--------------------------------------------------------------------------
*/
Route::get('feedback', 'FeedbackController@feedback');
Route::post('feedback', 'FeedbackController@storefeedback');
Route::get('viewfeedbackreplys', 'FeedbackController@viewfeedbackreplys');



/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
|
*/
Route::get('purchases', 'PaymentController@purchases');
Route::get('receipts', 'PaymentController@receipts');
Route::get('approvepayment/{id}', 'PaymentController@approvepayment');
Route::get('disapprovepayment/{id}', 'PaymentController@disapprovepayment');
Route::get('printreceiptproduct/{id}', 'PaymentController@printreceiptproduct');
Route::get('printreceiptservice/{id}', 'PaymentController@printreceiptservice');



/*
|--------------------------------------------------------------------------
| Messages Routes
|--------------------------------------------------------------------------
*/
Route::post('replyfeedback/{recepient}/{feedback}', 'MessagesController@sendmessage');


/*
|--------------------------------------------------------------------------
| Order Routes
|--------------------------------------------------------------------------
*/
Route::post('addproducttocart/{id}', 'OrderController@addproducttocart');
Route::get('makeorder', 'OrderController@makeorder');
Route::post('storeorder', 'OrderController@storeorder');
Route::get('disconfirmorderdelivered/{id}', 'OrderController@disconfirmorderdelivered');
Route::get('confirmorderdelivered/{id}', 'OrderController@confirmorderdelivered');
Route::get('removeitemfromcart/{id}', 'OrderController@removeitemfromcart');
Route::get('confirmdelivery', 'OrderController@confirmdelivery');
Route::get('userconfirmdelivery/{id}', 'OrderController@userconfirmdelivery');