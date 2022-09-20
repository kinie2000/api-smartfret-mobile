<?php

use App\Http\Controllers\Addcommande;
use App\Http\Controllers\Addcmd;
use App\Http\Controllers\AdminDC;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\demandeByMailController;
use App\Http\Controllers\forgetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login',[AuthController::class,'authenticate']);

Route::get('customer',[AuthController::class,'getUser']);

Route::get('logout',[AuthController::class,'logout']);

Route::post('forgetPassword',[forgetPasswordController::class,'generateCodeValidation']);

Route::post('verifyCode',[forgetPasswordController::class,'verifiyCodeUser']);

Route::get('commande',[AuthController::class,'logout']);

Route::post('changePassword',[forgetPasswordController::class,'changePassword']);

Route::post('updateCustomer',[CustomerController::class,'update']);

Route::post('showcmd',[CommandeController::class,'showcmd']);

Route::post('showdetailcmd', [CommandeController::class , 'showdetailcmd']);

Route::post('show',[CommandeController::class,'show']);

// Route::get('show/{id}',[AuthController::class,'show']);

Route::post('showpacket',[CommandeController::class,'showpacket']);
Route::post('addcmd',[Addcommande::class,'createCmd']);
Route::post('addcmdprincipal',[Addcommande::class,'newcmd']);
Route::post('addcmd2',[Addcmd::class,'addcmd']);
 Route::get('getcustomer',[Addcmd::class,'getcustomer']);
Route::post('getreciever',[Addcmd::class,'getreciever']);
Route::get('getstandard',[Addcmd::class,'getstandard']);
Route::post('customerCat',[Addcmd::class,'customerCat']);
Route::post('demandService',[demandeByMailController::class,'demandeApp']);
 Route::post('creatCustomer',[Addcmd::class,'creatCustomer']);
 Route::post('createReceiver',[Addcmd::class,'createReceiver']);
 Route::post('getCustCat',[Addcmd::class,'getCustCat']);
 Route::post('custcat',[Addcmd::class,'custcat']);
route::post('showadmcmd',[AdminDC::class,'showadmcmd']);
Route::middleware('auth:sanctum')->group(function(){
});
