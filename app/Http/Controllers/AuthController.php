<?php

namespace App\Http\Controllers;

use App\Models\addition_purchase_order;
use App\Models\Customer;
use App\Models\purchase_order;
use App\Models\User;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
// use DB;
use Illuminate\Support\Facades\DB as DB;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {

        if($request['client'])
        {
            $validator = Validator::make($request->all(),
                [
                    'login' => ['required','exists:customers,customer_mail','email:rfc'],
                    'password' => ['required','string','max:20']
                ],
                [
                    'login.required'=>"Champs requis",
                    'login.exists'=>'l\'adresse e-mail saisis n\'existe pas',
                    'login.email'=>'Veillez saisir une adresse e-mail correct',
                    'password.required'=>"Champs requis",
                    'password.string'=>"Saisis des caractères alpha-numéric",
                    'password.max'=>"Mot de passe incorrect"
                ]
            );

            if ($validator->fails()) {
                return response(['message'=>'Identifiant invalid','error'=> $validator->errors(),'statut'=>false]);  
            }
            else{
            
                $data=$request;
                
                if(Auth::guard('webcustomer')->attempt(['password' =>$data['password'],'customer_mail'=>$data['login']]))
                {
                    $user =Auth::guard('webcustomer')->user();
                     $user->profil="client";
                    $res=$this->generateTokenUser($user);

                    return response($res['res'])->withCookie($res['cookie']);
                }
                else
                {
                    return response(['message'=>'Identifiant invalid','statut'=>false]);  
                }       
            }  
        }
        else
        {
                 $validator = Validator::make($request->all(),
                [
                    'login' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:9','max:14'],
                    'password' => ['required','string','max:20']
                ],
                [
                    'login.required'=>"Champs requis",
                    'login.regex'=>'Veillez entre des caractères numériques compris entre (+)0-9',
                    'login.min'=>"Veillez entrer au moins 09 caractères numériques",
                    'login.max'=>"Veillez entrer au max 14 caractères numériques",
                    'password.required'=>"Champs requis",
                    'password.string'=>"Saisis des caractères alpha-numéric",
                    'password.max'=>"Mot de passe incorrect"
                
                ]
            );

            if ($validator->fails()) {
                return response(['message'=>'Identifiant invalid','error'=> $validator->errors(),'statut'=>false]);  
            }
            else{
            
                $data=$request;
                
                if (Auth::attempt(['password' =>$data['password'],'user_phone'=>$data['login']])) 
                {
                    $user =Auth::user();
                    $user->profil="admin";
                    $res=$this->generateTokenUser($user);
                    return response($res['res'])->withCookie($res['cookie']);                 
                }
                else
                {
                    return response(['message'=>'Identifiant invalid','statut'=>false]);  
                }       
            }  
        }
             
    }

    /**
     * @method mixed generateTokenUser() 
     * @param mixed $user It's data of user connect
     * @return mixed retourne le cookie, le token et une reponse pour l'utilisateur connecté
     * */

    public function generateTokenUser($user)
    {
        $token = $user->createToken('token')->plainTextToken;
        $cookie=cookie('jet',$token,68*24); // 1 day
        $response=[
            'user'=>$user,
            'message'=>'Connecté',
            'statut'=>true
        ];
        return ['cookie'=>$cookie,'res'=>$response];
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response(['message' => 'Success'])->withCookie($cookie);
    }

    public function getUser()
    {
        $user= Customer::all();
        return $user;
    }
  
}
