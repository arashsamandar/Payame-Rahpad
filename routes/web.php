<?php

// ---------------------------------------------------------- Start Test New UI ------------------------------------------------------

Route::get('/englishHeader',function(){
    return view('Layouts.englishHeader');
});

Route::get('/englishMain',function(){
   return view('Layouts.app2');
});

Route::get('/jsElement',function(){
   return view('Layouts.app3');
});

Route::get('/arashSamandar',function(){
    return response()->json(['message'=>'Hello Arash From Ajax Php Succesfull']);
})->name('arashSamandar');

Route::get('/getImages',function(){
    $myImagesArray = \App\Http\Controllers\ImageController::return_global_imageIterator_bellowSlider_forAjax();
    return response()->json(['dataArray'=>$myImagesArray]);
})->name('GetImagesForAjax');

// -------------------------------------------------------------- End Tests ----------------------------------------------------------

Route::get('/','PageManager@index')->name('home');
Route::get('/home','PageManager@index')->name('home');

Route::get('userimage/{id}','ImageController@showimage')->name('userimage');

Route::get('/changepass','UserUpdateController@updatepass')->name('uppass');
Route::post('/changepass','UserUpdateController@changepass')->name('uppass');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/update','UserUpdateController@showUpdate')->name('update');
Route::post('/update','UserUpdateController@update');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/crop/{id}','ImageController@showimage');

Route::get('/user-messages','AjaxMessageController@show_user_messages_page')->name('user.messages');

Route::post('/send_user_message','AjaxMessageController@send_user_message');

//--------------------------- Admin Area ---------------------------------

Route::get('admin/register','Auth\AdminRegisterController@show_register');
Route::post('admin/register','Auth\AdminRegisterController@register')->name('registering_admin');

Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('/admin/logs','AdminController@pagination')->name('Logs.View');

Route::get('/admin/search','AdminController@searchUsername')->name('adminSearchName');
Route::post('/admin/search','AdminController@searchUsername')->name('adminSearchName');


//------------------------ End Of Admin Area ------------------------------

//----------------------- Starting Ajax Calls------------------------------

Route::get('users', 'AjaxController@index')->name('users');

Route::post('users', 'AjaxController@index');

Route::get('contacts','AjaxController@readData'); // put it on top secret

Route::get('/student/read-data','AjaxController@readData'); // put it on top secret

Route::post('/student/store','AjaxController@store');

Route::post('/student/destroy','AjaxController@destroy');

Route::get('/users/edit','AjaxController@edit')->name('edit');

Route::post('/student/update','AjaxController@update');

Route::get('/users/pagination','AjaxController@pagination')->name('userspagination');

Route::get('/student/show/','AjaxController@showName');

Route::post('/student/search','AjaxController@searchNames')->name('searchName');

Route::get('/student/showpassword','AjaxController@showpassword')->name('showPassword');

Route::post('/student/changepass','AjaxController@changepass')->name('changeUserPassword');

Route::post('/student/saveimage','AjaxController@saveimage');

Route::get('/student/showaccess','AjaxController@show_access');

Route::post('/student/changaccess','AjaxController@change_access');

Route::get('/student/addNewStudent','AjaxController@addNewUser');

// -------------------------------Content Page CMS Section----------------------------

Route::get('/content/addOneContent','AjaxContentController@AddOneContent');

Route::get('/users/addContent','AjaxContentController@pagination')->name('addcontent'); // shows content page with pagination

Route::post('/users/saveContent','AjaxContentController@saveContent')->name('saveContent'); // shows the modal and saves it

Route::post('/content/destroy','AjaxContentController@DestroyContent')->name('destroycontent'); // destroys the contents with its pictures

Route::get('/content/edit','AjaxContentController@editContent')->name('editContent'); // shows edit modal with its values

Route::post('/content/update','AjaxContentController@UpdateContent')->name('UpdateContent');

Route::get('/content/showcontentimage','AjaxContentController@showContentImages')->name('showcontentimage');

Route::post('/permission/confirmOrRemove','AjaxMessageController@approveOrRemove')->name('ApproveOrRemove');

Route::post('/approve_or_message_for_message_page','AjaxMessageController@approve_or_edit_for_message_page')->name('message.page.approve');

Route::post('/send_message_to_admin','AjaxMessageController@Add_Message_To_admin'); // Add admin message here

Route::get('/messages','AjaxMessageController@show_messages_page')->name('message.page');

Route::get('/AdminApproveOrMessageController','AjaxMessageController@AdminApproveOrMessageController');

Route::get('/UserMessageViewAndSend','AjaxMessageController@UserMessageController');

// ------------------------------End Of Content Page CMS Section----------------------

//------------------------------- Site Pages -----------------------------------------

Route::get('/about-us',function() {
    return view('MainPages.aboutUs',['page_title' => 'درباره کانون تبلیغاتی پیام رهپاد']);
})->name('aboutUs');

Route::get('/service',function (){
   return view('MainPages.ourServices',['page_title' => 'خدمات کانون تبلیغاتی پیام رهپاد']);
})->name('ourServices');

Route::get('/contact-us',function (){
    return view('MainPages.contactUs',['page_title' => 'تماس با کانون تبلیغاتی پیام رهپاد']);
})->name('contactUs');

Route::get('Sharpad-project',function (){
    return view('MainPages.ShahrPaad',['page_title' => 'پروژه شهرپاد']);
})->name('ShahrPaad');

Route::get('Urban-Adds',function (){
    return view('MainPages.UrbanManagementAdd',['page_title' => 'آگهی نامه مدیریت شهری']);
})->name('UrbanManagementAdd');

//-------------------------------- Error Pages ---------------------------------

Route::get('pagenotfound',['as' => 'notfound','uses' => 'pageManager@pagenotfound']);

//-------------------------------- Dynamic Page --------------------------------

Route::get('/home/{page_address}','PageManager@makePages')->name('page_caller');

//--------------------------------- TEST -----------------------------

Route::get('/arash','PageManager@testing');