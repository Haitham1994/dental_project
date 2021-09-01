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

Route::get('/test','testcontroller@adam');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware'=>['web']],function(){
Route::get('autosearch', 'bookingcontroller@searchResponse')->name('searchajax');
Route::get('/search', 'bookingController@search')->name('search');
// booking  all route strart 
Route::get('/book','bookingcontroller@index')->name('booking.index');
Route::POST('/booking/create','bookingcontroller@store')->name('booking.store');
Route::get('/book/{id}/edit', 'bookingcontroller@edit')->name('check.edit');
//Route::POST('/book/update', 'bookingcontroller@update')->name('book.update');
Route::get('/book/{id}/delete', 'bookingcontroller@destroy')->name('book.destroy');
Route::get('/book/report', 'bookingcontroller@bookingreport')->name('book.report');
Route::post('/book/showreport', 'bookingcontroller@bookingshowreport')->name('book.showreport');
Route::POST('findflat/booking', 'bookingcontroller@findflat')->name('book.find');
\
Route::get('/meeting','meetingcontroller@index')->name('meeting.index');



Route::POST('book/select', 'bookingcontroller@find')->name('booking.find');
Route::POST('book/accept','bookingcontroller@accepting')->name('booking.accept');
// booking  all route end 
    
Route::get('/create/clothes', 'ClothesController@create')->name('clothes.create');
//route for store clothes
Route::POST('/store/clothes', 'ClothesController@store')->name('clothes.store');
//route for index clothes
// Route::get('/clothes', 'ClothesController@index')->name('clothes.index');
//route for edite clothes
Route::get('/clothes/edite{id}', 'ClothesController@edit')->name('clothes.edit');
//route for update clothes
Route::POST('/clothes/update{id}', 'ClothesController@update')->name('clothes.update');
//route for delete clothes
Route::get('/clothes/delete{id}', 'ClothesController@destroy')->name('clothes.destroy');


//route for create wash
Route::get('/create/wash', 'WashController@create')->name('wash.create');
//route for store wash
Route::POST('/store/wash', 'WashController@store')->name('wash.store');
//route for index wash
Route::get('/wash', 'WashController@index')->name('wash.index');
//route for edite wash
Route::get('/wash/edite{id}', 'WashController@edit')->name('wash.edit');
//route for update wash
Route::POST('/wash/update{id}', 'WashController@update')->name('wash.update');
//route for delete wash
Route::get('/wash/delete{id}', 'WashController@destroy')->name('wash.destroy');

//route for create order
Route::get('/create/order', 'OrdersController@create')->name('order.create');
//route for store orders
Route::POST('/store/order', 'OrdersController@store')->name('order.store');

//for sms blade

//laser beam  connect controller start 
 
Route::get('/laserbeam','laserbeamcontroller@index')->name('laserbeam.index');
Route::POST('/laserbeamstore','laserbeamcontroller@store')->name('laserbeam.store');
Route::get('/laserbeam/{id}/edit','laserbeamcontroller@edit')->name('laserbeam.edit');
Route::get('/laserbeam/delete/{id}', 'laserbeamcontroller@destroy')->name('laserbeam.delete');
Route::get('/laseradd','lasercontroller@index')->name('laseradd.index');

Route::get('/ray','rayController@index')->name('ray.index');
Route::POST('/raystore','rayController@store')->name('ray.store');
Route::get('/ray/{id}/edit','rayController@edit')->name('ray.edit');
Route::get('/ray/delete/{id}', 'rayController@destroy')->name('ray.delete');
Route::get('/Xrayadd','Xraycontroller@index')->name('Xrayadd.index');






    
    
    

//for send sms
Route::POST('/sendsms', 'SmsController@sendsms')->name('smss');


//start catogerys routes

//for index 
Route::get('/catogery', 'CatogeryController@index')->name('index.catogery');

//for insert and update
Route::POST('/store/catogery', 'CatogeryController@store')->name('cat.store');

//for edite
Route::get('/catogery/{id}/edit', 'CatogeryController@edit')->name('cat.edit');

//for delete
Route::get('/catogery/delete/{id}', 'CatogeryController@destroy')->name('cat.delete');
//end catogerys routes


//start products routes

//for index 
Route::get('/product', 'ProductController@index')->name('product.index');

//for insert and update
Route::POST('/store/product', 'ProductController@store')->name('product.store');
Route::POST('/patienhistory', 'patienhistorycontroller@store')->name('patienhistory.store');


//for edite
Route::get('/product/{id}/edit', 'ProductController@edit')->name('product.edit');

//for delete
Route::get('/product/delete/{id}', 'ProductController@destroy')->name('product.delete');
//end products routes
Route::get('/barcode', 'ProductController@barcode');

//Expens routes

//for index 
Route::get('/expens', 'ExpensController@index')->name('expens.index');

//for insert and update
Route::POST('/store/expens', 'ExpensController@store')->name('expens.store');

//for edite
Route::get('/expens/{id}/edit', 'ExpensController@edit')->name('expens.edit');

//for delete
Route::get('/expens/delete/{id}', 'ExpensController@destroy')->name('expens.delete');

//end Expens routes

//start company routes

//for index 
Route::get('/company', 'CompanyController@index')->name('index.company');

//for insert and update
Route::POST('/store/company', 'CompanyController@store')->name('company.store');

//for edite
Route::get('/company/{id}/edit', 'CompanyController@edit')->name('company.edit');

//for delete
Route::get('/company/delete/{id}', 'CompanyController@destroy')->name('company.delete');
//end company routes



//start department routes

//for index 
Route::get('/department', 'DepartmentController@index')->name('department.index');

//for insert and update
Route::POST('/store/department', 'DepartmentController@store')->name('department.store');

//for edite
Route::get('/department/{id}/edit', 'DepartmentController@edit')->name('department.edit');

//for delete
Route::get('/department/delete/{id}', 'DepartmentController@destroy')->name('department.delete');
//end department routes

//start check routes
//for index 
Route::get('/check', 'CheckController@index')->name('check.index');

//for insert and update
Route::POST('/store/check', 'CheckController@store')->name('check.store');

//for edite
Route::get('/check/{id}/edit', 'CheckController@edit')->name('check.edit');

//for delete
Route::get('/check/delete/{id}', 'CheckController@destroy')->name('check.delete');
//for trashed
Route::get('/trashed', 'CheckController@trashed')->name('check.trashed');
//for restore
Route::get('/check/restore/{id}', 'CheckController@restore')->name('check.restore');
//for hard delete
Route::get('/check/hdelete/{id}', 'CheckController@hdelete')->name('check.hdelete');
//end check routes

Route::get('docter', 'doctercontroller@index')->name('docter.index');
Route::post('docter/store', 'doctercontroller@store')->name('docter.store');
Route::get('docter/{id}/edit', 'doctercontroller@edit')->name('docter.edit');
Route::get('docter/delete/{id}','doctercontroller@destroy')->name('docter.delete');




//Order routes

//for create
Route::get('/order', 'OrderController@index')->name('order.create');

//for store order
// Route::POST('/order/store', 'OrderController@store')->name('order.store');

//for show order
Route::get('/orders/show', 'OrderController@showall')->name('order.show');

//for show single order
Route::get('/order/show/{id}', 'OrderController@print_order')->name('order.showsingle');

//for delete
Route::get('/order/delete/{id}', 'OrderController@destroy')->name('order.delete');

//for edite
Route::get('/order/{id}/edit', 'OrderController@edit')->name('order.edit');

//for update
Route::post('/order/update/{id}', 'OrderController@update')->name('order.update');

// for orders charts
Route::get('/home', 'HomeController@index')->name('home');

// for product charts
Route::get('/order/chart', 'OrderController@charts')->name('order.chart');

// for orders charts
Route::get('/chart/dateview', 'OrderController@order_chart_view')->name('order.chartdate');

// // for product charts
// Route::get('/productcahrt', 'OrderController@product_chart')->name('product.cahrt');

// for index
Route::get('/index', 'OrderController@indexs')->name('index');

Route::get('/main', 'OrderController@main')->name('main');



Route::get('/selectort', 'SmsController@index')->name('selectore');
Route::POST('/selectortpro', 'SmsController@find')->name('selectore.product');




Route::get('/reportcostshow', 'OrderController@reportcost')->name('cost.report');
Route::POST('/reports', 'OrderController@report')->name('report');

Route::get('/reportsall/show', 'OrderController@showallreport')->name('showall.report');
Route::POST('/reportsall', 'OrderController@custom_all')->name('reportall');
Route::get('logout','userrolecontroller@logout')->name('logout');

Route::get('/expenreportshow', 'OrderController@expenreportshow')->name('expenreportshow');
Route::POST('/expenreport', 'OrderController@expenreport')->name('expenreport');


Route::get('/product_report', 'ProductController@product_report')->name('product_report');
Route::POST('/product_reportshow', 'ProductController@product_reportshow')->name('preport_show');
    

    
// plant route Start 

Route::get('plant','plantController@index')->name('plant.index');
Route::POST('plant','plantcontroller@store')->name('plant.store');
Route::POST('plantresult','plantcontroller@storeresult')->name('plant.storeresult');
Route::get('/plant/{id}/edit','plantcontroller@edit')->name('plant.edit');
Route::get('/plant/delete/{id}', 'plantcontroller@destroy')->name('plant.delete');
    
// plant route end 
// pnatday report  route satrt
Route::get('dayreport','dayreportcontroller@index')->name('day.report');
Route::POST('dayreport/show','dayreportcontroller@dayreportshow')->name('day.reportshow');
//day report route satrt  

//day report  route satrt
Route::get('plantreport','dayreportcontroller@plant')->name('plant.report');
Route::POST('plantreport/show','dayreportcontroller@plantreportshow')->name('plant.reportshow');
//day report route satrt  
//day report  route satrt
Route::get('expensreport','dayreportcontroller@expens')->name('expens.report');
Route::POST('expenreport/show','dayreportcontroller@expenreportshow')->name('expen.reportshow');
//day report route satrt   

//user roles  Start 
Route::get('/userrole','userrolecontroller@index')->name('user.index');
Route::post('/userrole/store','userrolecontroller@store')->name('user.store');
Route::get('/userrole/{id}/edit', 'userrolecontroller@edit')->name('userrole.edit');
Route::post('/userrole/update', 'userrolecontroller@update')->name('userrole.update');
Route::get('/userrole/delete/{id}', 'userrolecontroller@destroy')->name('userrole.delete');
Route::get('/userrole/ok/{id}', 'userrolecontroller@okfunction')->name('userrole.ok');
Route::get('/userrole/nook/{id}', 'userrolecontroller@nookfunction')->name('userrole.nook');
//user roles  end 

   

Route::get('/patien', 'patientfilecontroller@index')->name('patien.create');

    
    
    
// bull controller  start 
    
    
    Route::get('/bull', 'bullcontroller@index')->name('bull.index');
    // Route::get('/lab', 'labcontroller@index')->name('lab.index');
    // Route::get('/workshop', 'workcontroller@index')->name('lab.index');
    // workshop route Start 
Route::get('workshop','workshopController@index')->name('workshop.index');
Route::POST('workshopadd','workshopController@store')->name('workshop.store');
Route::get('/workshop/{id}/edit','workshopController@edit')->name('workshop.edit');
Route::get('/workshop/delete/{id}', 'workshopController@destroy')->name('workshop.delete');
Route::get('/workshopadd','Xworkshopcontroller@index')->name('workshopadd.index');

    
// workshop route end
    Route::get('flasreach', ['as'=>'flasreach','uses'=>'AjaxAutocompleteController@flasreach']);
    Route::get('jobsreach', ['as'=>'jobsreach','uses'=>'AjaxAutocompleteController@jobsreach']);

//bull controller end 

//patienhistory route start
Route::POST('/patienhistory','patienhistorycontroller@store')->name('patienhistory.store');

//patienhistory route end

Route::get('previous','previouscontroller@index')->name('previous.index');
Route::get('/previous/{id}/review1','previouscontroller@review1')->name('previous.review1');
Route::get('/previous/{id}/review2','previouscontroller@review2')->name('previous.review2');
Route::get('/previous/{b_id}/review3','previouscontroller@review3')->name('previous.review3');

Route::get('/previous/{b_id}/edit','previouscontroller@edit')->name('previous.edit');

Route::get('patienfile','patienfilecontroller@index')->name('patienfile.index');


Route::get('scheduling','schedulingcontroller@index')->name('scheduling.index');
Route::POST('schedulingadd','schedulingcontroller@store')->name('scheduling.store');

Route::POST('laserstore','laserbeamcontroller@store')->name('laser.store');


});