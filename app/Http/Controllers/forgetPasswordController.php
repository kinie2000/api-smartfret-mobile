<?php

namespace App\Http\Controllers;

use App\Mail\mailResetPassword;
use App\Models\CodeValidation;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class forgetPasswordController extends Controller
{
    public function generateCodeValidation(Request $request)
    {
        $code=0;
        $user=Null;
        $customer=Null;
        if($request->client)
        {

            $validator = Validator::make($request->all(),
                [
                    'email' => ['exists:customers,customer_mail',],
                ],
                [
                    'login.required'=>"Champs requis",
                    'login.exists'=>'l\'adresse e-mail saisis n\'existe pas',
                    'login.email'=>'Veillez saisir une adresse e-mail correct',
                ]
            );

            if ($validator->fails()) {
                return response(['message'=>'Identifiant invalid','error'=> $validator->errors(),'statut'=>false]);
            }else
            {
                $code=$this->genereBarCode();
                $customer=Customer::where('customer_mail',$request->email)->first();
                $this->deleteCodeValidation($customer->id,'client');
                CodeValidation::create([
                    'idUser'=>Null,
                    'idCustomer'=>$customer->id,
                    'code'=>$code,
                    'status'=>'true'
                ]);
            }

            $data=[
                'code'=>$code,
                'name' => $customer->customer_name . ' ' . $customer->customer_surname
            ];

            // Mail::to($request->email)->send(new mailResetPassword($data));
            Mail::to('kinieyvan@gmail.com')->send(new mailResetPassword($data));
            return response()->json(["message" => "Un code de validation vous a été envoyé par mail",'code'=>$code,'statut'=>true]);
        }
        else
        {
            $validator = Validator::make($request->all(),
                [
                    'email' => ['exists:users,user_mail',],
                ],
                [
                    'login.required'=>"Champs requis",
                    'login.exists'=>'l\'adresse e-mail saisis n\'existe pas',
                    'login.email'=>'Veillez saisir une adresse e-mail correct',
                ]
            );

            if ($validator->fails())
            {
                return response(['message'=>'Identifiant invalid','error'=> $validator->errors(),'statut'=>false]);
            }else
            {
                $code=$this->genereBarCode();
                $user=User::where('user_mail',$request->email)->first();
                $this->deleteCodeValidation($user->id,'admin');
                CodeValidation::create([
                    'idUser'=>$user->id,
                    'idCustomer'=>Null,
                    'code'=>$code,
                    'status'=>'true'
                ]);
            }

            $data=[
                'code'=>$code,
                'name' => $user->user_name . ' ' . $user->user_surname
            ];

           // Mail::to($request->email)->send(new mailResetPassword($data));
            Mail::to('kinieyvan@gmail.com')->send(new mailResetPassword($data));
            return response()->json(["message" => "Un code de validation vous a été envoyé par mail",'code'=>$code,'statut'=>true]);
        }
    }

    public function verifiyCodeUser(Request $request)
    {
         $validator = Validator::make($request->all(),
                [
                    'code' => ['exists:code_validations,code',],
                ],
                [
                    'login.exists'=>'Code invalide',
                ]
            );
         if ($validator->fails()) {
            return response(['message'=>'code invalide','error'=> $validator->errors(),'statut'=>false]);
        }else
        {
            $lineCodevalidation=CodeValidation::where('code',$request->code)->first();
            if($lineCodevalidation && $lineCodevalidation->status=='true')
            {
                    CodeValidation::where('code',$request->code)->update(['status'=>'false']);
                    if($lineCodevalidation->idUser && !$lineCodevalidation->idCustomer)
                    {
                        return response(['message'=>"ok",'user'=>$lineCodevalidation->idUser,'profil'=>'admin','status'=>true]);
                    }
                    else if(!$lineCodevalidation->idUser && $lineCodevalidation->idCustomer)
                    {
                        return response(['message'=>"ok",'user'=>$lineCodevalidation->idCustomer,'profil'=>'client','status'=>true]);
                    }
                    else
                    {
                        return response(['message'=>"Utilisateur inexistant",'status'=>false]);
                    }
            }
            else  if(($lineCodevalidation && $lineCodevalidation->status=='false') || !$lineCodevalidation)
            {
                 return response(['message'=>'Code invalide','statut'=>false]);
            }
        }
    }

    private function genereBarCode(){
        $num = str_pad(rand(1,99999), 5, '0', STR_PAD_RIGHT);
        $product = CodeValidation::where('code', $num)->get();
        if(count($product) >= 1){
            $this->genereBarCode();
        }
        return $num;
    }

    public function deleteCodeValidation($id,$typeUser)
    {
        if($typeUser=='admin')
        {
            CodeValidation::where('idUser',$id)->where('status','true')->update(['status'=>'false']);
        }
        else if($typeUser=='client')
        {
            CodeValidation::where('idCustomer',$id)->where('status','true')->update(['status'=>'false']);
        }
    }

    public function changePassword(Request $request)
    {
        $code=$request->code;
        $pwd=$request->pwd;

        $user=CodeValidation::where('code',$code)->first();
        if(!$user->idUser && $user->idCustomer)
        {
            Customer::where('id',$user->idCustomer)->update(['password'=>Hash::make($pwd)]);
            return response(['message'=>"Réunitialisation de votre mot de passe reussis",'statut'=>true]);
        }else if($user->idUser && !$user->idCustomer)
        {
            User::where('id',$user->idUser)->update(['password'=>Hash::make($pwd)]);
            return response(['message'=>"Réunitialisation de votre mot de passe reussis",'statut'=>true]);
        }
        else
        {
            return response(['message'=>"une erreur s'est produite veillez réessayer plutard",'statut'=>false]);
        }
    }
}
