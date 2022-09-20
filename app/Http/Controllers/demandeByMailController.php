<?php

namespace App\Http\Controllers;

use App\Mail\demandeMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class demandeByMailController extends Controller
{
    public function demandeApp(Request $request)
    {
        $Idclient= $request->id;
        $client=[];
        $client= Customer::where('id',$Idclient)->first();
        if(!$client)
        {
             return response()->json(["message" => "Demande non autorisé, Veillez contacter votre administrateur",'statut'=>false]);
        }
        else
        {
            $data=[
                "number"=>$request->number?$request->number:$client->customer_phone,
                "demande"=>$request->demande,
                "dateRetrait"=>$request->demande=="enlevement"?$request->dateRetrait:"",
                "heureRetrait"=>$request->demande=="enlevement"?$request->heureRetrait:"",
                "adresseRetrait"=>$request->demande=="enlevement"?$request->adresseRetrait:"",
                "descriptionRetrait"=>$request->demande=="enlevement"?$request->descriptionRetrait:"",
                "telephoneRetrait"=>$request->demande=="enlevement"?($request->telephoneRetrait?$request->telephoneRetrait:$client->customer_phone):"",
                "nombreEmballage"=>$request->demande=="emballage"?$request->nombreEmballage:"",
                "nom"=>$client->customer_name." ".$client->customer_surname,
                "tel"=>$client->customer_phone,
                "mail"=>$client->customer_mail,
                "adresse"=>$client->customer_adress."/".$client->customer_other_adress,
                "pays"=>$client->customer_country."/ ".$client->customer_city,
                "MessageConfirm"=>"",
            ];


           try {
              //  Mail::to('smartfretline@gmail.com')->send(new demandeMail($data));
                Mail::to('kinieyvan@gmail.com')->send(new demandeMail($data));
               return response()->json(["message" => "Demande bien reçu",'statut'=>true]);
            } catch (\Throwable $th) {
               return response()->json(["message" => $th,'statut'=>false]);
            }

        }

    }
}
