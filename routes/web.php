<?php
use Illuminate\Support\Facades\Route;
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

/*Route::get('/', function () {
    return view('welcome');
    //1er option one to one
    /*$user = factory('App\User')->create();
    $phone = new App\Phone();
    $phone->phone_number = '034 07 837 71';
    $user->phone()->save($phone);*/

    //2e option one to one
    /*$user = factory('App\User')->create();
    $user->phone()->create([
        'phone_number' => '032 11 463 99',
    ]);*/
    //Relation one to Many
    //1er option One To Many
    /*$user = factory('App\User')->create();
    $post->title = 'Premier titre';
    $post->content = 'Premier contenu';
    $post->user_id = $user->id;
    $post->save();*/
    //2e option one to Many 
    //Insertion de post
    /*$user = App\User::first();
    $user->posts()->create([
        'title' => 'Mon dexieme titre',
        'content' => 'Mon deuxieme contenu'
    ]);*/
    //Pour recuperer les posts depuis l'utilisateur
    /*$user = App\User::first();
    dd($user->posts) ;

    Pour recuperer l'utilisateur depuis le Post
    $post = App\Post::first();
    dd($post->user());

});
*/

/*Rout get pour la relation many to many 
Route::get('/', function () {

    /*Attachement role
    $user = factory('App\User')->create();
    $roles = App\Role::all();
    //Insertion dans la table user et user_role
    $user->roles()->attach($roles);*/
    //Detachement role
    /*$user = App\User::latest()->first();
    $role = App\Role::first();
    $user->roles()->detach($role);*/
    //Attachement d'un utilisateur à un role bien precis
    /*$user = App\User::first();
    $user->roles()->sync([1,3]);



});*/
/************************************ */

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
Route::get('/search',function(){
    return view('game.index');
});
//Route::post('/searchService/{id}','GameController@searchService');
Route::post('/searchService','GameController@searchService');

Route::get('/', function () {
    //return view('welcome');
    
    return view('auth.loginnew');
    //return view('autre.loginnew');
});
Route::get('/login', function () {
    //return view('welcome');
    return view('auth.loginnew');
    //return view('autre.loginnew');
});

Route::get('/learnjquery', function () {
    return view('autre.try');
});
Route::get('/searchrequesttemp', function () {
    return view('request.searchrequesttemp');
});
//web.php
Route::post('/searchServiceNew', 'GameController@searchServiceNew');
//Route::post('/searchServiceNew/{id}','GameController@checkAttribute')->name('game.list');

Route ::view('tool','tools.index',['tzTools' => 'DHIS2 COVAX'])->middleware('test') ;
Route::get('/entity','EntityController@list');
//Route::get('/tool','ToolController@list');


//Route::post('/tool','ToolController@store');
// Route for calling POST MEthode
Route::match(['put', 'patch'], '/tool','ToolController@store');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('homepage');

//Request
Route::get('request','RequestwfController@create');
Route::get('pendingrequest/{entityid}','RequestwfController@show_pending')->name('pendingrequest');
Route::get('request/{entityid}','RequestwfController@index');
//Route::post('/request/save', 'RequestwfController@store')->name('requestww.store');
Route::match(['put', 'patch'], '/request/save', 'RequestwfController@store');
Route::get('request/valid/{id}', 'RequestwfController@approuvrequest');
Route::get('request/checkmaxrank/{id}', 'RequestwfController@checkmaxrank');
Route::post('request/reject', 'RequestwfController@rejectrequest')->name('requestwf.reject');
Route::post('request/validforprocessing', 'RequestwfController@validforprocessing')->name('requestwf.validforprocessing');
Route::post('request/process','ProcessAchievementController@store')->name('requestwf.process');
Route::post('request/finalizerequest','ProcessAchievementController@finalizerequest')->name('requestwf.finalizerequest');
Route::get('request/process/{id}','RequestwfController@processrequest');
Route::get('request/view/{id}', 'RequestwfController@view');
Route::get('request/viewpendingrequest/{id}', 'RequestwfController@viewpendingrequest');
Route::get('request/viewprocessingrequest/{id}', 'RequestwfController@viewprocessingrequest');
Route::get('viewdetailrequest/{id}','RequestwfController@viewdetailrequest');
Route::get('request/list','RequestwfController@showlistrequest');
Route::get('searchrequest','RequestwfController@searchrequest');
Route::get('searchstatusrequestbyentity','RequestwfController@searchstatusrequestbyentity');
Route::get('showprocessrequestbyentityoremp','RequestwfController@showprocessrequestbyentityoremp');
Route::get('test','RequestwfController@test');
//Route::get('cron','CronController@index');
Route::post('showListRequestByStatusProcess','RequestwfController@showListRequestByStatusProcess');
Route::post('showListRequestByStatus','RequestwfController@showListRequestByStatus');

// /*DropzoneJS
Route::post('/request','RequestwfController@postData');
Route::post('/sendfileprocess','ProcessAchievementController@postDataProcess');
// DropzoneJS*/
//Processing
Route::get('processingrequest','ProcessingController@show_processing');
//Reply Email Addresse
Route::post('showorinsertaddresseemail','ReplyEmailAddresseController@showorinsertaddresseemail')->name('showorinsertaddresseemail');
//Accordeon request
Route::post('showrequestaccordionformat','SearchRequestController@showrequestaccordionformat')->name('showrequestaccordionformat');
//Accordeon request multicritere
Route::post('showrequestaccordionformatmulticritere','SearchRequestController@showrequestaccordionformatmulticritere')->name('showrequestaccordionformatmulticritere');
//Recherche demande par entite ou utilisateur
Route::post('showprocessrequestformatmulticritere','SearchRequestController@showprocessrequestformatmulticritere')->name('showprocessrequestformatmulticritere');
//Clients 1er option
Route::get('client', 'ClientController@index');
Route::get('client/create','ClientController@create');
Route::get('client/{client}/edit','ClientController@edit');
Route::match(['put', 'patch'], '/client', 'ClientController@store');
Route::get('client/{client}','ClientController@show');
Route::put('client/{id}','ClientController@update')->name('client.update');
Route::delete('client/{client}', 'ClientController@destroy');
//Route::match(['patch'],'client/{client}','ClientController@update');

//Route pour Entite
Route::get('entity','EntityController@index');
Route::resource('entities', 'AjaxEntityController');
Route::get('entitydatatable', 'AjaxEntityController@index2');
Route::get('entities/destroy/{id}', 'AjaxEntityController@destroy');
Route::get('entities/edit/{id}', 'AjaxEntityController@edit');
Route::get('testrequete','AjaxEntityController@testrequete');
Route::get('entity/view/{id}','EntityController@viewentity');
Route::get('entity/create','EntityController@create');
Route::get('entity/create2','EntityController@create');
Route::post('entity/save','EntityController@store');
Route::post('entity/update','EntityController@update');
Route::get('entity/edit/{id}','EntityController@edit');
Route::get('entity/delete/{id}','EntityController@delete');
Route::post('showentitybytoolandtyperequest','EntityController@showentitybytoolandtyperequest');
Route::post('showentitybytoolandtyperequestinprocess','EntityController@showentitybytoolandtyperequestinprocess');
Route::post('showuserbytoolandtyperequestinprocess','UserController@showuserbytoolandtyperequestinprocess');
//Route::post('getListEntityInProcessByTypeRequestIDToolID')
//Route pour tools
Route::get('tool','ToolController@view');
Route::resource('tools', 'AjaxToolController');
Route::get('toolsajax','ToolController@viewtoolsajax');
Route::post('inserttoolajax','ToolController@inserttoolsajax')->name('tool.insert');
Route::match(['put', 'patch'],'toolupdate/{id}','ToolController@update')->name('tool.update');
Route::get('tool/delete/{id}', 'ToolController@delete');
Route::get('tool1','ToolController@index');
Route::get('tooldatatable', 'AjaxToolController@index');
Route::get('tool/view/{id}','ToolController@viewtool');
Route::get('tool/create','ToolController@create');
Route::post('tool/save','ToolController@store');
Route::post('tool/update','ToolController@update');
Route::get('tool/edit/{id}','ToolController@edit');
//Route::post('toolupdate/{id}','ToolController@update')->name('toolajax.update');
//Route pour les types de demande
Route::get('type_demande','TypeRequestController@index');
Route::get('inserttyperequest','TypeRequestController@insertTypeRequest');
Route::match(['put', 'patch'], 'savetyperequest', 'TypeRequestController@store');
Route::get('type_demande/edit/{id}','TypeRequestController@edit');
//Route::post('type_demande/{id}','TypeRequestController@update')->name('typerequest.update');
//Route::post('type_demande','TypeRequestController@update')->name('typerequest.update');
Route::post('type_demande/update','TypeRequestController@update');
Route::post('type_demande/create','AjaxTypeRequestController@store');
Route::get('type_request/delete/{id}','TypeRequestController@delete');
Route::get('type_request/deletevalidationprocess/{id}','TypeRequestController@deletevalidationprocess');
Route::get('tool_type_request/delete/{id}','TypeRequestController@deletetool');
Route::get('edit_type_request/{id}','TypeRequestController@edittyperequest');
Route::get('typerequest/view/{id}','TypeRequestController@viewtyperequest');
Route::get('typerequest/viewapprobation/{id}','TypeRequestController@viewapprobationtyperequest');
//Route::match(['put', 'patch'], '/approbation_type_demande/create', 'TypeRequestController@addApprobation');
Route::post('approbation_type_demande/create','TypeRequestController@addApprobation')->name('typerequest.addApprobation');
Route::post('/showtyperequest','TypeRequestController@showTypeRequestByToolId');
Route::post('showentitybytypeentityandentityparent','EntityController@showentitybytypeentityandentityparent')->name('showentitybytypeentityandentityparent');
Route::post('/showtoolbytyperequest','ToolController@showToolByTypeRequestId');
Route::get('typerequestdatatable', 'AjaxTypeRequestController@index');
Route::resource('typerequests', 'AjaxTypeRequestController');
Route::get('approbation_type_demande','TypeRequestController@approbationTypeRequest');
Route::get('approbation_type_demande/edit/{id}','TypeRequestController@editApprobation');
Route::post('approbation_type_demande/{id}','TypeRequestController@updateApprobation')->name('typerequest.updateapprobation');
Route::get('aprobation_type_demande/add','TypeRequestController@newApprobation');
//Route pour validation type demande
Route::get('validation_type_demande','ValidationTypeRequestController@index');
Route::get('validation_type_demande/edit/{id}','ValidationTypeRequestController@approbationTypeDemande');
Route::post('/getfirstentityvalidator','ValidationTypeRequestController@getFirstEntityValidator');
Route::get('create_type_request_by_tool','TypeRequestController@createrequestbytool');
//Route pour utilisateur
Route::get('user','UserController@index');
Route::get('createcompte','UserController@create');
Route::get('user/edit/{id}','UserController@edit');
Route::get('showprofil/{id}','UserController@edit')->name('showprofil');
Route::get('enableuser/{id}','UserController@enableuser')->name('enableuser');
Route::post('user/{id}','UserController@update')->name('user.update');
Route::post('setenable/{id}','UserController@setenable')->name('setenable');
Route::post('setdisable/{id}','UserController@setdisable')->name('setdisable');
Route::post('resetpassword','UserController@resetpassword')->name('resetpassword');
Route::post('updatepasswordtemp','UserController@updatepasswordtemp')->name('updatepasswordtemp');
Route::post('customlogin','UserController@customlogin')->name('customlogin');
Route::post('customresetpassword','UserController@customresetpassword')->name('customresetpassword');
Route::get('updateinitpassword','UserController@updateinitpassword');
//Route::get('user/enregistrer','UserController@store')->name('exemple') ;
//Route::post('tafita/mampiditrautilisateur','UserController@mampiditra')->name('exemple') ;
Route::post('saveuser','UserController@store')->name('saveuser') ;
Route::post('saveuserext','UserController@store_extuser')->name('saveuserext') ;
Route::get('authenticateuser','UserController@authenticate_user')->name('authenticateuser');

//Route::match(['put', 'patch'], '/user/save', 'UserController@store');
Route::get('users', ['uses'=>'UserController@index', 'as'=>'users.index']);
Route::get('userdatatable', 'AjaxUserController@index')->name('userdatatable');
Route::get('register','UserController@inscription')->name('register');


//Clients 2e option: utiliser le middleware auth pour restreindre l'accès au controleur client
//Route::resource('client','ClientController')->middleware('auth');
Route::get('/files/create','DocumentController@create');
Route::get('/files','DocumentController@index');
Route::post('/files','DocumentController@store');
Route::post('/filesajax','DocumentController@storeajax');
Route::get('/files/{id}','DocumentController@show');
Route::get('files/download/{file}','DocumentController@download');

//Image upload Methode d'upload image1
Route::get('upload', 'ImageUploadController@upload');
Route::post('upload/store', 'ImageUploadController@store');
Route::post('delete', 'ImageUploadController@delete');

//Image upload Methode d'upload 2
Route::get('dropzone','DropzoneController@index');
Route::post('dropzone/upload','DropzoneController@upload')->name('dropzone.upload');
Route::get('dropzone/fetch','DropzoneController@fetch')->name('dropzone.fetch');
Route::get('dropzone/delete','DropzoneController@delete')->name('dropzone.delete');
//Suivi demande
Route::get('/suividemande/{id}','SuiviDemandeController@index');
//Commentaire visiteur
Route::post('comment/save','CommentController@store')->name('comment.save');
Route::get('showcomment','CommentController@index');
//PDF Imprimable
Route::get('testpdf','PDFController@index');
//Cron job
Route::get('actioncron','CronController@sendmailrappel');
Route::get('lancercron','CronController@index');
Route::get('lancercrontraitement','CronController@crontraitement');
Route::get('lancercronactivation','CronController@cronactivation');
