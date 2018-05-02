<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'AdminController@dashboard')->name('index');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::get('/translation',  'AdminController@translation')->name('translation');
Route::get('/settings',  'AdminController@settings')->name('settings');
Route::post('/settings',  'AdminController@storesettings');
//Route::post('namebycat', 'AdminController@departmentName');

Route::get('/commentsettings',  'AdminController@commentSetting')->name('commentsettings');
Route::get('/addcommentsetting',  'AdminController@addCommentSetting');

Route::get('/emailsettings',  'AdminController@emailSetting')->name('emailsettings');
Route::get('/edit/email/{id}',  'AdminController@editemailSetting');
Route::post('/update/email/{id}',  'AdminController@update_email_setting');

Route::get('/footersettings',  'AdminController@footersettings')->name('footersettings');
Route::post('/footersettings',  'AdminController@storefootersettings');


Route::post('user/invite', 'Resource\UserResource@submit_invites')->name('user.submit_invite');
Route::resource('user', 'Resource\UserResource');
Route::get('user/delete/{user}', 'Resource\UserResource@destroy')->name('user.destroy');
Route::resource('faq', 'Resource\FaqResource');
Route::resource('admin', 'Resource\AdminResource');
Route::resource('tool', 'Resource\ToolResource');
Route::resource('rule', 'Resource\RulesResource');
Route::resource('branchrule', 'Resource\BranchResourceRule');
Route::resource('departmemnt', 'Resource\BranchResourceDepartment');
//Route::any('namebycat', 'Resource\RulesResource@departmentName');

//Route::get('idea/invitations', 'Resource\IdeaResource@invitations')->name('idea.invitations');
//Route::get('idea/invite', 'Resource\IdeaResource@invite')->name('idea.invite');
//Route::post('idea/invite', 'Resource\IdeaResource@submit_invite')->name('idea.submit_invite');
//Route::post('idea/solutions', 'Resource\IdeaResource@bulk_delete_solutions')->name('idea.solsdestroy');
//Route::get('idea/invdestroy/{id}', 'Resource\IdeaResource@delete_invitation')->name('idea.invdestroy');
//Route::post('idea/invdestroy', 'Resource\IdeaResource@bulk_delete_invitation')->name('idea.binvdestroy');

Route::get('idea/solutions', 'Resource\IdeaResource@solutions')->name('idea.solutions');
Route::get('idea/solutions/{id}', 'Resource\IdeaResource@award_solution')->name('idea.solsaward');
Route::get('idea/solution/delete/{id}', 'Resource\IdeaResource@delete_solution')->name('idea.soldestroy');
Route::get('idea/solution/edit/{id}', 'Resource\IdeaResource@edit_solution')->name('idea.soledit');
Route::post('idea/solution/update/{id}', 'Resource\IdeaResource@update_solution')->name('idea.solupdate');
Route::get('idea/solution/send/{id}', 'Resource\IdeaResource@move_idea')->name('idea.moves');
Route::post('idea/solution/send/{id}', 'Resource\IdeaResource@send_idea')->name('idea.sendidea');

Route::get('idea/sindex/{id}', 'Resource\IdeaResource@sponser_index')->name('idea.sponserindex');
Route::get('idea/iindex', 'Resource\IdeaResource@investor_index')->name('idea.investorindex');
Route::get('idea/offer/{id}', 'Resource\IdeaResource@offerdetails')->name('idea.offerdetails');
Route::post('idea/offer/{id}', 'Resource\IdeaResource@submitoffer')->name('idea.submitoffer');

Route::resource('idea', 'Resource\IdeaResource');
Route::resource('metec', 'Resource\MetecResource');
Route::get('mlt/page', 'Resource\MltResource@pagesetup')->name('mlt.pagesetup');
Route::post('mlt/page', 'Resource\MltResource@updatepage')->name('mlt.updatepage');
Route::resource('mlt', 'Resource\MltResource');
Route::get('idea/delete/{idea}', 'Resource\IdeaResource@destroy')->name('idea.destroy');
Route::resource('branch', 'Resource\BranchResource');
Route::resource('category', 'Resource\CategoryResource');
Route::resource('industry', 'Resource\IndustryResource');
Route::resource('manual', 'Resource\ManualResource');
Route::resource('product', 'Resource\ProductResource');
Route::resource('video', 'Resource\VideoResource');
Route::resource('article', 'Resource\ArticleResource');
Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@profile_update')->name('profile.update');
Route::get('password', 'AdminController@password')->name('password');
Route::post('password', 'AdminController@password_update')->name('password.update');
Route::resource('categoryarticle', 'Resource\CategoryResourceArticle');
Route::resource('categoryvideo', 'Resource\CategoryResourceVideo');
Route::resource('categoryproduct', 'Resource\CategoryResourceProduct');
// Static Pages - Post updates to pages.update when adding new static pages.

Route::get('/pages', 'AdminController@pages')->name('pages.list');
Route::get('/pages/edit/{id}', 'AdminController@editpage')->name('page.edit');
Route::post('/update', 'AdminController@update_page')->name('pages.update');

//Route::get('/comment/setting', 'AdminController@commentSetting')->name('comment.setting');
Route::get('/comment/edit/{id}', 'AdminController@editSetting')->name('comment.edit');
Route::post('/comment/update', 'AdminController@update_Setting')->name('comment.update');
//Route::get('/pages/edit/{id}', 'AdminController@editpage')->name('page.edit');
//Route::post('/update', 'AdminController@update_page')->name('pages.update');

Route::resource('categorytool', 'Resource\CategoryResourceTool');

Route::post('/idea/deleteall', 'Resource\IdeaResource@destroyall')->name('idea.destroyall');
