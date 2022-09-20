<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Purchase_order;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;
use PHPUnit\Framework\Constraint\IsNull;
use App\Models\standard_packages;
use App\Models\Customer;
use App\Models\Receiver;
use App\Models\Categorie;
use App\Models\Packet;

class Addcommande extends Controller
{
     public $group_packet;
     public $purchase_order_title;

     public $customer_id;

      public $choix;

      public $addData = array();

    public $tab = array();

    private $idcmd=null;


    public $tabColis = array();


    function newcmd(Request $request)
{
   $cmd=Purchase_order::create([
       'purchase_order_number'=>$request->purchase_order_number,
       'purchase_order_title'=>$request->purchase_order_title,
       'purchase_statut'=>'kk',
       'purchase_order_number_packet'=>1,
       'divisor_value'=>1,
       'purchase_order_description'=>1,
       'accept_terme'=>1,
       'total_amount'=>1,
       'has_paid'=>1,
       'paid'=>1,
        'rest'=>1,
       'signature'=>1,
       'purchase_order_isDraft'=>1,
       'Delivery_address'=>1,
       'barcode_printed'=>1,
       'customer_id'=>1,
       'receiver_id'=>1,
       'user_id'=>1,
       'num_incriment'=>1,
       'purchase_order_date'=>'2021-03-20 11:00:29'
]);
$this->idcmd=$cmd->id;

return response()->json(['user'=>$cmd,'id'=>$cmd->id]);
}
    //
 public function createCmd(Request $request)
 {
       $jour = date('l');
        $mois = date('m');
        $date = date('l-d-m-Y');

        switch($jour) {
            case 'Monday' :
                $jour = "Lundi";
            break;
            case 'Tuesday' :
                $jour = "Mardi";
            break;
            case 'Wednesday' :
                $jour = "Mercredi";
            break;
            case 'Thursday' :
                $jour = "Jeudi";
            break;
            case 'Friday' :
                $jour = "Vendredi";
            break;
            case 'Saturday' :
                $jour = "Samedi";
            break;
            default :
                $jour = "Dimanche";
        }

        switch($mois) {
            case '01' :
                $mois = "Janvier";
            break;
            case '02' :
                $mois = "Février";
            break;
            case '03' :
                $mois = "Mars";
            break;
            case '04' :
                $mois = "Avril";
            break;
            case '05' :
                $mois = "Mai";
            break;
            case '06' :
                $mois = "Juin";
            break;
            case '07' :
                $mois = "Juillet";
            break;
            case '08' :
                $mois = "Août";
            break;
            case '09' :
                $mois = "Septembre";
            break;
            case '10' :
                $mois = "Octobre";
            break;
            case '11' :
                $mois = "Novembre";
            break;
            default :
                $mois = "Décembre";
        }
         /* $newcolis=new Packet(
           [
              'packet_title' =>$Request->packet_title,
                'nombreColis' =>$Request->packet_title,
                'packet_width'=>$Request->packet_title,
                'packet_length'=>$Request->packet_title,
                'packet_heigth'=>$Request->packet_title,
                'packet_price'=>$Request->packet_title,
                'packet_show_title'=>$Request->packet_title,
                'packet_picture' => $Request->packet_title,
                'number' =>$Request->packet_title,
                'packet_status' => $Request->packet_title,
                'packet_code_bar' =>$Request->packet_title,
                'packet_location' =>$Request->packet_title,
                 'purchase_order_id' =>$Request->packet_title,
                 'packet_location_agency'=>$Request->packet_title,
           ]
           );

               array_push($addColis,$newcolis);


       foreach ($colis as $tab) {

           Packet::create(  [
              'packet_title' =>$tab['packet_title'],
                'nombreColis' =>2,
                'packet_width'=>$tab['packet_width'],
                'packet_length'=>$tab['packet_length'],
                'packet_heigth'=>$tab['packet_heigth'],
                'packet_price'=>200,
                'packet_show_title'=>'coli',
                'packet_picture' =>'lopo',
                'number' =>20,
                'packet_status' =>'inscrit',
                'packet_code_bar' =>'2425',
                'packet_location' =>'doul',
                 'purchase_order_id' =>'1',
                 'packet_location_agency'=>'doul',
           ]);

            return response(['tab'=>$tab]);
       }*/

       $purchase_order_title = 'Réf - '.$jour.' '.date('d').' '.$mois.' '.date('Y');

    $validator=Validator::make($request->all(),[
 /*  'purchase_order_number_packet'=>'required',
   'purchase_order_number'=>'required',
   'purchase_order_title'=>'required',
   'purchase_order_description'=>'required',
   'divisor_value'=>'required',
   'accept_terme'=>'required',
   'total_amount'=>'required',
   'has_paid'=>'required',
   'paid'=>'required',
   'rest'=>'required',
   'signature'=>'required',
   'purchase_order_isDraft'=>'required',
   'Delivery_address'=>'required',
   'customer_id'=>'required',
   'receiver_id'=>'required',
   'user_id'=>'required',
   'purchase_statut'=>'required',
   'purchase_order_date'=>'required',
   'packet_length'=>'numeric',
   'packet_width'=>'numeric',
   'packet_heigth'=>'numeric',
 //  'nbr_colis'=>'numeric',
   'choix'=>'required',
   //'number'=>'numeric',
   //'nombreColis1'=>'numeric',
   //'packet_price'=>'numeric',
   'packet_title'=>'required',
 //  'papacket_location'=>'papacket_location',
*/
    ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
/*
   $user=Purchase_order::create([  'purchase_order_number_packet'=>$request->purchase_order_number_packet,
  //  'purchase_order_number'=>$request->purchase_order_number,
 //   'purchase_order_title'=>$request->purchase_order_title,
  // 'purchase_order_description'=>$request->purchase_order_description,
   'divisor_value'=>$request->divisor_value,
   'packet_title'=>$request->packet_title,
    'packet_length'=>$request->packet_length,
     'packet_width'=>$request->packet_width,
      'packet_heigth'=>$request->packet_heigth,
      // 'packet_price'=>$request->packet_price,
       // 'packet_location'=>$request->papacket_location,
         'number'=>$request->number,
                'packet_show_title' => 1,
                'packet_picture' => NULL
   'accept_terme'=>$request->accept_terme,
   'total_amount'=>$request->total_amount,
   'has_paid'=>$request->has_paid,
   'paid'=>$request->paid,
   'rest'=>$request->rest,
   'signature'=>$request->signature,
   'purchase_order_isDraft'=>$request->purchase_order_isDraft,
   'Delivery_address'=>$request->Delivery_address,
   'customer_id'=>$request->customer_id,
   'receiver_id'=>$request->receiver_id,
   'user_id'=>$request->user_id,
 'purchase_statut'=>$request->purchase_statut,
 'purchase_order_date'=>$request->purchase_order_date,
  'payement_method1'=>$request->payement_method1,
   'payement_method2'=>$request->payement_method2,
    'payement_method3'=>$request->payement_method3,
     'payement_method4'=>$request->payement_method4,
'payement_amount1'=>$request->payement_amount1,
'payement_amount2'=>$request->payement_amount2,
'payement_amount3'=>$request->payement_amount3,
'payement_amount4'=>$request->payement_amount4,
]);
*/
 $longueur=$request->packet_length;
  $largeur=$request->packet_width;
   $hauteur=$request->packet_width;
    $req=$request->purchase_order_number;
    $nbrcolis=$request->number;
    $divisor_value=$request->divisor_value;
    $choix=$request->choix;
    $nombreColis1=$request->nombreColis1;
    $packet_price1=$request->packet_price1;
    $montantRajout=$request->montantRajout;
    $montantColis=$request->montantColis;
    $reduction=$request->reduction;
    $augmentation=$request->reduction;
    $payement_method1=$request->payement_method1;
    $payement_method2=$request->payement_method2;
    $payement_method3=$request->payement_method3;
    $payement_method4=$request->payement_method4;
    $payement_amount1=$request->payement_amount1;
      $payement_amount2=$request->payement_amount2;
        $payement_amount3=$request->payement_amount3;
          $payement_amount4=$request->payement_amount4;
          $name=$request->name;
          $nameR=$request->nameR;
         $idcmd=$this->idcmd;



 if ($choix=='dimension') {
     $addColis = array([
                'packet_title' =>'k',
                'number' =>2,
                'packet_width'=>0,
                'packet_length' =>0,
                'packet_heigth' =>0,
                'packet_show_title' => 1,
                'packet_picture' => NULL
     ]);
     if ($longueur==$request->Nullable && $largeur==$request->Nullable && $hauteur==$request->Nullable) {
         $packet_price=0;
         $group_packet_price=0;
     }
     else {
         if (is_numeric($divisor_value)) {
             # code...

 $packet_price = round(((($longueur *$largeur *$largeur)/1000000) * $divisor_value), 2);
         }
         if ($nbrcolis==$request->Nullable) {
             # code...
             $group_packet_price=$packet_price;
         }
         else {
             if (is_numeric($nbrcolis)) {
                 # code...

                  $packet_price=round(((($longueur*$largeur* $hauteur)/1000000)*$divisor_value),2);
                $donnee1 = array([
                'packet_title' => $request->packet_title,
                'number' =>$request->nbrcolis,
                'packet_width'=>$request->longueur,
                'packet_length' =>$request->largeur,
                'packet_heigth' => $request->hauteur,
                'packet_show_title' => 1,
                'packet_picture' => NULL
            ]);
             $tab = ['packet_price' => $packet_price];

//$colisAdd = array_merge($donnee1,$tab);
//$t=$addColis[]=$colisAdd;

$user=Packet::create([
    'divisor_value'=>$request->divisor_value,
   'packet_title'=>$request->packet_title,
    'packet_length'=>$request->packet_length,
     'packet_width'=>$request->packet_width,
      'packet_heigth'=>$request->packet_heigth,
       'packet_price'=>1,
       'packet_code_bar'=>1,
        'packet_location'=>'kiki',
        'packet_location_agency'=>'koko',
        'purchase_order_id'=>$request->purchase_order_id,
         'number'=>$request->number,
                'packet_show_title' => 1,
                'packet_picture' => NULL]);
                array_push($addColis,$user);
                 $group_packet_price=round(($packet_price*$nbrcolis),2);
             }

         }
     }
 }


 elseif ($choix=='prix') {
     if (is_numeric($nombreColis1) && is_numeric($packet_price1)) {

         $prixGroup1 = round(($packet_price1 *$nombreColis1), 2);
         $packet_price=$packet_price1;
         $group_packet_price=$prixGroup1;
         $montantBon=$group_packet_price;
     }
 }

 elseif ($choix=='standard') {
      $colisStandards = standard_packages::orderBy('id', 'desc')->get();
   $montant = round(( $montantRajout + $montantColis), 2);

        if($reduction == 0 && $augmentation == 0) {

            $montantBon = $montant;

        } else if($reduction != 0 && $augmentation == 0) {

            $montantBon = round(($montant - (($montant * $reduction) / 100)), 2);

        } else if($reduction == 0 && $augmentation != 0) {

            $montantBon = round(($montant + (($montant * $reduction) / 100)), 2);
        }
 }




        if($payement_method1 != NULL && $payement_method2 == NULL && $payement_method3 == NULL && $payement_method4 == NULL) {

            $payement_amount2 = '';
            $payement_amount3 = '';
            $payement_amount4 = '';

            $montantPercu = $payement_amount1;
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 == NULL && $payement_method2 != NULL && $payement_method3 == NULL && $payement_method4 == NULL) {

            $payement_amount1 = '';
            $payement_amount3 = '';
            $payement_amount4 = '';

            $montantPercu = $payement_amount2;
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 == NULL && $payement_method2 == NULL && $payement_method3 != NULL && $payement_method4 == NULL) {

            $payement_amount1 = '';
            $payement_amount2 = '';
            $payement_amount4 = '';

            $montantPercu = $payement_amount3;
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 == NULL && $payement_method2 == NULL && $payement_method3 == NULL && $payement_method4 != NULL) {

            $payement_amount1 = '';
            $payement_amount2 = '';
            $payement_amount3 = '';

            $montantPercu = $payement_amount4;
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 != NULL && $payement_method2 != NULL && $payement_method3 == NULL && $payement_method4 == NULL) {

            $payement_amount3 = '';
            $payement_amount4 = '';

            $montantPercu = round(((float)$payement_amount1 + (float)$payement_amount2), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 != NULL && $payement_method2 == NULL && $payement_method3 != NULL && $payement_method4 == NULL) {

            $payement_amount2 = '';
            $payement_amount4 = '';

            $montantPercu = round(((float)$payement_amount1 + (float)$payement_amount3), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);


        } else if($payement_method1 != NULL && $payement_method2 == NULL && $payement_method3 == NULL && $payement_method4 != NULL) {

            $payement_amount2 = '';
            $payement_amount3 = '';

            $montantPercu = round(((float)$payement_amount1 + (float)$payement_amount4), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 == NULL && $payement_method2 != NULL && $payement_method3 != NULL && $payement_method4 == NULL) {

            $payement_amount1 = '';
            $payement_amount4 = '';

            $montantPercu = round(((float)$payement_amount2 + (float)$payement_amount3), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 == NULL && $payement_method2 != NULL && $payement_method3 == NULL && $payement_method4 != NULL) {

            $payement_amount1 = '';
            $payement_amount3 = '';

            $montantPercu = round(((float)$payement_amount2 + (float)$payement_amount4), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 == NULL && $payement_method2 == NULL && $payement_method3 != NULL && $payement_method4 != NULL) {

            $payement_amount1 = '';
            $payement_amount2 = '';

            $montantPercu = round(((float)$payement_amount3 + (float)$payement_amount4), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 != NULL && $payement_method2 != NULL && $payement_method3 != NULL && $payement_method4 == NULL) {

            $payement_amount4 = '';

            $montantPercu = round(((float)$payement_amount1 + (float)$payement_amount2 + (float)$payement_amount3), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 != NULL && $payement_method2 != NULL && $payement_method3 == NULL && $payement_method4 != NULL) {

            $payement_amount3 = '';

            $montantPercu = round(((float)$payement_amount1 + (float)$payement_amount2 + (float)$payement_amount4), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 != NULL && $payement_method2 == NULL && $payement_method3 != NULL && $payement_method4 != NULL) {

            $payement_amount2 = '';

            $montantPercu = round(((float)$payement_amount1 + (float)$payement_amount3 + (float)$payement_amount4), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 == NULL && $payement_method2 != NULL && $payement_method3 != NULL && $payement_method4 != NULL) {

            $payement_amount1 = '';

            $montantPercu = round(((float)$payement_amount2 + (float)$payement_amount3 + (float)$payement_amount4), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        } else if($payement_method1 != NULL && $payement_method2 != NULL && $payement_method3 != NULL && $payement_method4 != NULL) {

            $montantPercu = round(((float)$payement_amount1 + (float)$payement_amount2 + (float)$payement_amount3 + (float)$payement_amount4), 2);
            $montantRestant = round(((float)$montantBon - (float)$montantPercu), 2);

        }

/*
        if(empty($name)) {

            $customers = [];

            $customer_id = '';
            $augmentation = 0;
            $reduction = 0;

        }
        else {

            $customers = Customer::where('customer_status', 'Actif');
        }

         $customer = new Customer();
         $customer_id= $customer->id;

        $categories = Categorie::all();

        if(empty($nameR)) {

            $receiver_id = '';
        }
        if(empty($customer_id) && empty($nameR)) {

            $receivers = [];

            $receiver_id = '';
        } else {

            $receivers = Receiver::where('customer_id', $customer_id)
            ->where(function ($query) {
                $query->where('receiver_name', 'like', '%'.$nameR.'%')
                    ->orWhere('receiver_surname', 'like', '%'.$nameR.'%');
            })
            ->get();

            if(count($receivers) == 0) {

                $receivers = Receiver::where('customer_id', $customer_id)->get();

            }
        }

         if($customer_id != NULL) {

            $customer1 = Customer::find($customer_id);
            $categorie = $customer1->categorie;

            if($customer1->reduction_value != 0 && $customer1->augmentation == 0) {

                $reduction = $customer1->reduction_value;
                $augmentation = 0;


            } else if($customer1->reduction_value == 0 && $customer1->augmentation != 0) {

                $reduction = 0;
                $augmentation = $customer1->augmentation;

            } else if($customer1->reduction_value == 0 && $customer1->augmentation == 0){

                if(empty($categorie)) {

                    $reduction = 0;
                    $augmentation = 0;

                } else {

                    $reduction = $categorie->category_reduction_value;
                    $augmentation = $categorie->category_augmentation;
                }


            }
        }

*/
if (empty($name)) {
    $customers = [];

            $customer_id = '';
            $augmentation = 0;
            $eduction = 0;
}
else {
      $customers = Customer::where('customer_status', 'Actif')->where('customer_name', 'like', '%'.$name.'%')->get();
      $customer_id=$customers->id;

       if(empty($nameR)) {

            $receiver_id = '';
        }
         if(empty($customer_id) && empty($nameR)) {

            $receivers = [];

            $receiver_id = '';

        }
        else {
            $receivers = Receiver::where('customer_id', $customer_id)->get();
             if(count($receivers) == 0) {

                $receivers2 = Receiver::where('customer_id', $customer_id)->get();

            }
        }

         $categories = Categorie::all();
          if($customer_id != NULL) {

            $customer1 = Customer::find($customer_id);
            $categorie = $customer1->categorie;

            if($customer1->reduction_value != 0 && $customer1->augmentation == 0) {

                $reduction = $customer1->reduction_value;
                $augmentation = 0;


            } else if($customer1->reduction_value == 0 && $customer1->augmentation != 0) {

                $reduction = 0;
                $augmentation = $customer1->augmentation;

            } else if($customer1->reduction_value == 0 && $customer1->augmentation == 0){

                if(empty($categorie)) {

                    $reduction = 0;
                    $augmentation = 0;

                } else {

                    $reduction = $categorie->category_reduction_value;
                    $augmentation = $categorie->category_augmentation;
                }


            }
        }
}

//'user'=>$user,'reqnumber'=>$req,'prix de groupe'=>$group_packet_price,'date'=>$purchase_order_title,'prix unitaire'=>$packet_price,
   return response()->json(['user'=>$user,'message'=>'enregistrement reusi','tableau'=>$addColis]);

 }
 //chexbox

function addcolis(Request $request)
{
     $choix=$request->choix;
     $longueur=$request->longueur;
  $largeur=$request->largeur;
   $hauteur=$request->hauteur;
      $nbrcolis=$request->nbrcolis;
    $divisor_value=$request->divisor_value;
     $packet_price1=$request->packet_price1;
    $montantRajout=$request->montantRajout;
      $nombreColis1=$request->nombreColis1;

    if ($choix=="dimension") {
            if ($longueur==$request->Nullable && $largeur==$request->Nullable && $hauteur==$request->Nullable) {
         $packet_price=0;
         $group_packet_price=0;
     }
     else {
         if (is_numeric($divisor_value)) {
             # code...
               $packet_price=round(((($longueur*$largeur* $hauteur)/1000000)*$divisor_value),2);
         }
         if ($nbrcolis==$request->Nullable) {
             # code...
             $group_packet_price=$packet_price;
         }
         else {
             if (is_numeric($nbrcolis)) {
                 # code...
                 $group_packet_price=round(($packet_price*$nbrcolis),2);

             }

         }
     }
    }
    if ($choix=="prix") {
       if (is_numeric($nombreColis1) && is_numeric($packet_price1)) {

         $prixGroup1 = round(($packet_price1 *$nombreColis1), 2);
         $packet_price=$packet_price1;
         $group_packet_price=$prixGroup1;
         $montantBon=$group_packet_price;
     }
    }
    if ($choix=="standard") {
        # code...
    }
}



}
