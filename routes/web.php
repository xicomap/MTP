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
 | Admin Authentication Routes
 |--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminAuth\LoginController@showLoginForm');
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::post('/logout', 'AdminAuth\LoginController@logout');
    
    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
    
    Route::get('pubch/list', 'PublicChallengeController@index')->name('pcs.index');  
    Route::get('pubch/{id}', 'PublicChallengeController@show')->name('pcs.show');
    Route::post('pubch/{id}', 'PublicChallengeController@update')->name('pcs.update');
    Route::delete('pubch/destroy/{id}', 'PublicChallengeController@destroy')->name('pcs.destroy');    
});

//Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@marketing')->name('home');
Route::get('/marketing', 'HomeController@marketing')->name('marketing');
Route::get('/video/category/{id}', 'HomeController@catvideolist');
Route::get('/article/category/{id}', 'HomeController@catarticlelist');
Route::get('/product/category/{id}', 'HomeController@catproductlist');
Route::get('/home/thanks', 'HomeController@thanks');
//Route::get('/contact', 'ContactController@index');
//Route::post('/contact', 'ContactController@submit_contact');
Route::get('/static/{type}', 'PageController@index', function($type){ });
Route::get('/faq', 'FaqController@index');
Route::get('/article_list', 'HomeController@articleList')->name('article_list');
Route::get('/video_detail', 'HomeController@videoDetail');
Route::get('/product_list', 'HomeController@productlist')->name('product_list');

Route::get('/ideacomp', 'HomeController@competitonIdea')->name('competition');
Route::get('/publicChallenge', 'HomeController@publicChallenge')->name('challenge');
Route::get('/send_public_challenge', 'HomeController@send_public_challenge')->name('send_challenge');
Route::get('/sponser', 'HomeController@sponser')->name('sponser');
Route::get('/winner', 'HomeController@winner')->name('winner');

Route::get('/metecEmployee', 'HomeController@metec_employee')->name('metec');

//Route::any('/idea/comp', 'HomeController@ideaCompetition');
/*Route::get('/publicChallenge', 'HomeController@publicChallenge');
Route::get('/send_public_challenge', 'HomeController@send_public_challenge');
Route::get('/sponser', 'HomeController@sponser');
Route::get('/winner', 'HomeController@winner');*/

Route::get('/rules', 'HomeController@rules')->name('rules');
Route::get('/tools', 'HomeController@tools')->name('tools');
Route::get('/tool/category/{id}', 'HomeController@cattoollist');

Route::get('/video/detail/{id}', 'HomeController@videoDetail');
Route::get('/article/detail/{id}', 'HomeController@articleDetail');
Route::get('/product/detail/{id}', 'HomeController@productDetail');
Route::post('/mail/product', 'Resource\ProductResource@productMail');
Route::post('x', 'HomeController@x');
Route::post("search","HomeController@homeSearch");
Route::post("rule/search","HomeController@ruleSearch");
Route::post("tool/search","HomeController@toolSearch");

Route::post('/article/comment/{id}', 'HomeController@article_comment')->name('articlecomment');
Route::post('/product/comment/{id}', 'HomeController@product_comment')->name('productcomment');
Route::post('/video/comment/{id}', 'HomeController@video_comment')->name('videocomment');



Route::group(['prefix' => 'user'], function () {
  Route::get('/login', 'UserAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'UserAuth\LoginController@login');
  Route::post('/logout', 'UserAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'UserAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'UserAuth\RegisterController@register');

  Route::post('/password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'UserAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'UserAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'UserAuth\ResetPasswordController@showResetForm');
});
    
Route::get('/detail/{id}', 'IdeaController@postdetail');

// for competitors
Route::get('user/ideas', 'IdeaController@ideas')->name('allideas');
Route::get('user/competitions', 'IdeaController@invitations')->name('invitations');
Route::get('user/competition/{id}', 'IdeaController@inv_detail')->name('invdetail');
Route::post('user/competitions/{id}', 'IdeaController@submit_solution')->name('submitsolution');
Route::post('read', 'IdeaController@readconversation')->name('read');

//For investor and sponserss
//Route::get('/user/proposals', 'IdeaController@proposals')->name('proposals');
//Route::post('/pdetail/{id}', 'IdeaController@submit_proposal')->name('submitproposal');
//Route::get('/mlt/', 'IdeaController@mlt_index')->name('mlt');
Route::get('best/ideas', 'IdeaController@best_ideas')->name('bestideas');
Route::post('best/ideas/wishlist', 'IdeaController@ideas_wishlist')->name('ideaswishlist');
Route::get('ideas/wishlist', 'IdeaController@wishlist')->name('userwishlist');
Route::get('ideas/set_offer/{id}', 'IdeaController@setoffer')->name('setoffer');
Route::post('ideas/set_offer/{id}', 'IdeaController@submitoffer')->name('submitoffer');

//innovation
Route::get('/innovation/', 'IdeaController@innovation')->name('innovation');
Route::post('/innovation', 'IdeaController@innovation_apply')->name('innovationapply');
Route::post('/add_challenge', 'IdeaController@addchallenge')->name('addchallenge');



//metec users
Route::get('metec/myposts', 'MetecController@userpost')->name('userpost');
Route::post('metec/myposts', 'MetecController@submitpost')->name('submitpost');
Route::get('metec/edit/{id}', 'MetecController@editpost')->name('editpost');
Route::post('metec/edit/{id}', 'MetecController@updatepost')->name('updatepost');
Route::get('metec', 'MetecController@index')->name('index');
Route::get('metec/view/{id}', 'MetecController@show')->name('viewpost');
Route::post('metec/view/{id}', 'MetecController@submitcomment')->name('submitcomment');
Route::get('metec/hide/{id}', 'MetecController@metecupdate')->name('metecupdate');
Route::get('metec/delete/{id}', 'MetecController@metecdelete')->name('metecdelete');
Route::get('metec/updatesol/{id}', 'MetecController@updatesol')->name('updatesol');

//MLT
Route::get('mlt', 'MltController@home')->name('mlthome');
Route::get('mlt/manual', 'ManualController@index')->name('manualindex');
Route::get('mlt/myposts', 'MltController@userpost')->name('mltuserpost');
Route::post('mlt/myposts', 'MltController@submitpost')->name('mltsubmitpost');
Route::get('mlt/edit/{id}', 'MltController@editpost')->name('mlteditpost');
Route::post('mlt/edit/{id}', 'MltController@updatepost')->name('mltupdatepost');
Route::get('mlt/mltpost', 'MltController@index')->name('mltpost');
Route::get('mlt/view/{id}', 'MltController@show')->name('mltviewpost');
Route::post('mlt/view/{id}', 'MltController@submitcomment')->name('mltsubmitcomment');
Route::get('mlt/hide/{id}', 'MltController@mltupdate')->name('mltupdate');
Route::get('mlt/delete/{id}', 'MltController@mltdelete')->name('mltdelete');
Route::get('mlt/updatesol/{id}', 'MltController@updatesol')->name('mltupdatesol');
