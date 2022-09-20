<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Packet;
use App\Models\Purchase_order;
use Illuminate\Http\Request;
use App\Models\Receiver;
use Illuminate\Support\Facades\DB as DB; ;
use App\Models\Payment;
use App\Models\standard_packages;
use Illuminate\Http\UploadedFile;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use App\Models\Agencie;
use App\Models\Checkout;
use App\Models\Agency_packet;


class Addcmd extends Controller
{
    //
    public $tab_gen_colis=array();
    public $addColisMontant=array();
    public $colis= array();

    public $idbc;

    public $idclt;
    public $idrecv;

    public $nameclt;

    public $cmd;

    public $customer;

    public $idcs;

    public $cstId;

    public $csRcv;

    public $prixGroup;
    public $divisor_value;

    public $reduction;
    public $augmentation;
    public $montantFinal ;

    public $montantBon;

    public $i;
    public $v;
    public $purchase_order_title;
    public $nomclt;


    private function gen()
    {

        $num = str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $customer = Customer::where('customer_barCode', $num)->get();

        if (count($customer) >= 1) {
            $this->gen();
        }

        return $num;

    }
    private function gen1()
    {

        $num = str_pad(rand(1, 9999999999999), 13, '0', STR_PAD_LEFT);
        $customer = Packet::where('packet_code_bar', $num)->get();

        if (count($customer) >= 1) {
            $this->gen1();
        }

        return $num;

    }
     public function getimage($signature)
    {
        if (!empty($signature)) {

            //On verifier si le dossier signature existe dans notre storage
            $folderPath = public_path('/storage/Signature/');



            //On récuperer les informations de notre image qu'on range dans un tableau
            $image_parts = explode(";base64,", $signature);

            //On récuperer la premiere partie de notre preccedant tableau qu'on range à nouveau dans un autre tableau
            $image_type_aux = explode("image/", $image_parts[0]);

            //On récuperer le type de l'image
            $image_type = $image_type_aux[1];

            //On transforme la deuxième partie de notre première tableau en base64_decode
            $image_base64 = base64_decode($image_parts[1]);

            //On verifier si le nom génerer de l'image existe déjà dans le dossier Imageproduct
            $file = $folderPath . uniqid() . '.' . $image_type;

            $file1 = explode('/', $file);

            $image =  UploadedFile::fake()->image($file1[3]);

            //$data['customer_picture']->store('ProfilClient', 'public')

            $i = 1;

            while ($file1[$i - 1] <> 'Signature' && $i < count($file1)) {

                $i++;
            }

            if ($file1[$i - 1] == 'Signature') {

                $index = $i - 1;
            }

            $sigantures =  $file1[$index]. '/' . $file1[$index + 1];

            file_put_contents($file, $image_base64);

            return $sigantures;
        }
    }

    private function inc()
    {

return $this->i++;
    }
       function getcustomer(Request $request)
    {
       //  $this->cmd=$request->custo;
       //  $client=$cmd['purchase_order_number'];
 $this->nomclt= $request->cstid;
                         $customer=DB::table('customers') ->select('id','customer_name','customer_surname')->where('customer_status', 'Actif')->get();
                   foreach ($customer as $item) {
                       if($item->customer_surname==null)
                       {
                       $item->customer_surname='i';
                       }

                   }
   return $customer;




    }

    function getstandard()
    {
        $standard=DB::table('standard_packages')->get();
        return $standard;
    }

    function getreciever(Request $request)
    {
    $idcs= $request->cstid;
         $receiver=DB::table('receivers')->where('customer_id','=',$idcs)->get();
            foreach ($receiver as $item) {
                       if($item->receiver_surname==null)
                       {
                       $item->receiver_surname='i';
                       }

                   }

                         return  $receiver;

    }

    function addcmd(Request $request)
    {

           $jour = date('l');
        $mois = date('m');
     $date = date('Y-m-d H:i:s');

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
          $this->purchase_order_title = 'Réf - '.$jour.' '.date('d').' '.$mois.' '.date('Y');

 $dernierEnregistrement = Purchase_order::get()->last();

        if($dernierEnregistrement == NULL) {

            $numero = 'BC_100';

        } else
        {

            $tabNumber = explode('_', $dernierEnregistrement->purchase_order_number);

            if(count($tabNumber) == 1) {

                $val = $tabNumber[0] + 1;

            } else {

                $val = $tabNumber[1] + 1;

            }

            $numero = "BC_".$val;

        }


        $cmd=$request->cmd;
        $colis=$request->tab;
        $typecolis=$cmd['Typecoli'];
        $packet_width=$cmd['packet_width'];
        $packet_length=$cmd['packet_length'];
        $packet_heigth=$cmd['packet_heigth'];
        $mode_paie=$cmd['mode_paie'];
        $divisor_value=$cmd['divisor_value'];
        $nombreColis=$cmd['number'];
        $montant=$cmd['montantTotal'];
        $cartebleu=$cmd['Cartebleue'];
        $sepece=$cmd['espece'];
        $virement=$cmd['Virementbancaire'];
        $cheque=$cmd['Cheque'];


                if($cmd['purchase_order_isDraft'] == NULL) {

                    $cmd['purchase_order_isDraft'] = 0;
                }
                else {
                    # code...
                    $cmd['purchase_order_isDraft'] = 1;
                }


//customer et categorie
  if($cmd['costumer_id'] != NULL) {

            $customer1 = Customer::find($cmd['costumer_id']);
            $categorie = $customer1->categorie;

            if($customer1->reduction_value != 0 && $customer1->augmentation == 0) {

                $this->reduction = $customer1->reduction_value;
                $this->augmentation = 0;


            } else if($customer1->reduction_value == 0 && $customer1->augmentation != 0) {

                $this->reduction = 0;
                $this->augmentation = $customer1->augmentation;

            } else if($customer1->reduction_value == 0 && $customer1->augmentation == 0){

                if(empty($categorie)) {

                    $this->reduction = 0;
                    $this->augmentation = 0;

                } else {

                    $this->reduction = $categorie->category_reduction_value;
                    $this->augmentation = $categorie->category_augmentation;
                }


            }
        }

        if($this->reduction == 0 && $this->augmentation == 0) {

            $this->montantBon =$montant;

        } else if($this->reduction != 0 && $this->augmentation == 0) {

            $this->montantBon = round(($montant - (($montant * $this->reduction) / 100)), 2);

        } else if($this->reduction == 0 && $this->augmentation != 0) {

            $this->montantBon = round(($montant + (($montant * $this->reduction) / 100)), 2);

        }

        $i=0;
//$this->gen1(),
$rest=$this->montantBon-$cmd['montantRecu'];

        $cmdvalue=Purchase_order::create(['purchase_order_number'=>$numero,
       'purchase_order_title'=> $this->purchase_order_title,
       'purchase_statut'=>'inscrit',
       'purchase_order_number_packet'=>$cmd['nbrpacket'],
       'divisor_value'=>$cmd['divisor_value'],
       'purchase_order_description'=>$cmd['purchase_order_description'],
       'accept_terme'=>1,
       'total_amount'=>$cmd['MTtotal'],
       'has_paid'=>$cmd['montantRecu'],
       'paid'=>$cmd['montantRecu'],
        'rest'=>$cmd['Rest'],
       'signature'=>(new self)->getimage($cmd['signature']),
       'purchase_order_isDraft'=>$cmd['purchase_order_isDraft'],
       'barcode_printed'=>1,
       'customer_id'=>$cmd['costumer_id'],
       'receiver_id'=>$cmd['receiver_id'],
       'user_id'=>$cmd['iduser'],

       'purchase_order_date'=> $date]);

$this->idbc= $cmdvalue->id;

  $usercmd = ['activity_description' => 'L\'utilisateur a crée le bon de commande', 'activity_identified' => $numero, 'activity_route' => "bonCommande/$cmdvalue->id", 'user_id' => $cmd['iduser']];

                   Activity::create($usercmd);


        $agence = Agencie::where('agency_name', 'Paris')->first();

        $checkout = Checkout::where('agency_id', $agence->id)->first();



     if($sepece!= NULL){

                        $paie = [
                            'payement_method' => 'Espèce',
                            'payement_amount' => $cmd['espece'],
                            'paid_after_invoicing' => 0,
                            'purchase_order_id' =>$this->idbc,
                            'user_id' => $cmd['iduser'],
                            'checkout_id' => $checkout->id
                        ];

                        Payment::create($paie);

                        $som = $checkout->checkout_amount + $cmd['espece'];

                        $checkout->update(['checkout_amount' => $som]);

                        $user = ['activity_description' => 'L\'utilisateur a ajouté un paiement en Espèce',
                        'activity_identified' => 'Ajout paiement',
                        'activity_route' => "caisse/$checkout->id",
                        'user_id' => $cmd['iduser']];

                        Activity::create($user);

                    }
                     if($cartebleu!= NULL){

                        $paie = [
                            'payement_method' => 'Carte bleue',
                            'payement_amount' => $cmd['Cartebleue'],
                            'paid_after_invoicing' => 0,
                            'purchase_order_id' =>$this->idbc,
                            'user_id' =>$cmd['iduser'] ,
                            'checkout_id' => $checkout->id
                        ];

                        Payment::create($paie);

                        $som = $checkout->checkout_amount + $cmd['Cartebleue'];

                        $checkout->update(['checkout_amount' => $som]);

                        $user = ['activity_description' => 'L\'utilisateur a ajouté un paiement par Carte bleue',
                        'activity_identified' => 'Ajout paiement',
                        'activity_route' => "caisse/$checkout->id",
                        'user_id' => $cmd['iduser']];

                        Activity::create($user);

                    }
                      if($virement!= NULL){

                        $paie = [
                            'payement_method' => 'Virement bancaire',
                            'payement_amount' => $cmd['Virementbancaire'],
                            'paid_after_invoicing' => 0,
                            'purchase_order_id' =>$this->idbc,
                            'user_id' => $cmd['iduser'],
                            'checkout_id' => $checkout->id
                        ];

                        Payment::create($paie);

                        $som = $checkout->checkout_amount + $cmd['Virementbancaire'];

                        $checkout->update(['checkout_amount' => $som]);

                        $user = ['activity_description' => 'L\'utilisateur a ajouté un paiement par Virement bancaire',
                        'activity_identified' => 'Ajout paiement',
                        'activity_route' => "caisse/$checkout->id",
                        'user_id' =>$cmd['iduser']];

                        Activity::create($user);

                    }
                      if($cheque!= NULL){

                        $paie = [
                            'payement_method' => 'cheque',
                            'payement_amount' => $cmd['Cheque'],
                            'paid_after_invoicing' => 0,
                            'purchase_order_id' =>$this->idbc,
                            'user_id' => $cmd['iduser'],
                            'checkout_id' => $checkout->id
                        ];

                        Payment::create($paie);

                        $som = $checkout->checkout_amount + $cmd['Cheque'];

                        $checkout->update(['checkout_amount' => $som]);

                        $user = ['activity_description' => 'L\'utilisateur a ajouté un paiement par Chèque',
                        'activity_identified' => 'Ajout paiement',
                        'activity_route' => "caisse/$checkout->id",
                        'user_id' =>$cmd['iduser']];

                        Activity::create($user);

                    }




       foreach ($colis as $tab) {
//$colis[]=$tab->packet_title;
//$val=$values['packet_location_agency'];
// Packet::create($tab);
$i++;
$this->inc();
$totalcolis=+$tab['packet_price'];

  $colisSave=Packet::create([
              'packet_title' =>$tab['packet_title'],

                'packet_width'=>$tab['packet_width'],
                'packet_length'=>$tab['packet_length'],
                'packet_heigth'=>$tab['packet_heigth'],
                'packet_price'=>$tab['packet_price'],
                'packet_show_title'=>0,
                'packet_picture' =>null,
                'number' => $i.'/'.$cmd['nbrpacket'],
                'packet_status' =>'inscrit',
                'packet_code_bar' => $this->gen1(),
                'packet_location' =>'paris',
                 'purchase_order_id' => $this->idbc,
                 'packet_location_agency'=>'',
           ]);
           $date = date('Y-m-d H:i:s');
Agency_packet::create(['date' => $date, 'packet_id' => $colisSave->id, 'agency_id' => $agence->id]);

       }


       return response(['cmd'=>$cmdvalue,'2'=>$cmd,'id'=>$this->idbc,'mode de payement'=>$mode_paie[0],'typecolis'=>$typecolis,'montantfinal'=>$this->montantFinal,'colis'=>$colis,'customer'=>$customer1,'montantBon'=>$this->montantBon,'nbrdepackt'=>$this->inc(),'v'=>$this->v]);

    }



    public function creatCustomer(Request $request)
    {
        $date = date('Y-m-d H:i:s');
$data= $request->cstid;




        switch ($data['customer_country']) {
            case 'Algérie':
                $donnee['Customer_contry_code'] = 'DZ';
                break;
            case 'Allemagne':
                $donnee['Customer_contry_code'] = 'DE';
                break;
            case 'Argentine':
                $donnee['Customer_contry_code'] = 'AR';
                break;
            case 'Australie':
                $donnee['Customer_contry_code'] = 'AU';
                break;
            case 'Belgique':
                $donnee['Customer_contry_code'] = 'BE';
                break;
            case 'Bénin':
                $donnee['Customer_contry_code'] = 'BJ';
                break;
            case 'Brésil':
                $donnee['Customer_contry_code'] = 'BR';
                break;
            case 'Canada':
                $donnee['Customer_contry_code'] = 'CA';
                break;
            case 'Chine':
                $donnee['Customer_contry_code'] = 'CN';
                break;
            case 'Espagne':
                $donnee['Customer_contry_code'] = 'ES';
                break;
            case 'États-Unis':
                $donnee['Customer_contry_code'] = 'US';
                break;
            case 'France':
                $donnee['Customer_contry_code'] = 'FR';
                break;
            case 'Italie':
                $donnee['Customer_contry_code'] = 'IT';
                break;
            case 'Mexique':
                $donnee['Customer_contry_code'] = 'MX';
                break;
            default:
                $donnee['Customer_contry_code'] = 'RU';
                break;
        }

        if (!empty($data['codeBati']) || !empty($data['numeroEtage'])) {

            $donnee['customer_other_adress'] = $data['codeBati'] . ' ' . $data['numeroEtage'];

        }
        else {
            $donnee['customer_other_adress'] = Null;
        }

        $dataFinal =  [
                    'customer_name' => $data['customer_name'],
                    'customer_surname' => $data['customer_surname'],
                    'customer_mail' => $data['customer_mail'],
                    'customer_phone' => $data['customer_phone'],
                    'customer_adress' => $data['customer_adress'],
                    'customer_other_adress' => $donnee['customer_other_adress'] ,
                    'customer_city' => $data['customer_city'],
                    'customer_country' => $data['customer_country'],
                    'Customer_contry_code' => $donnee['Customer_contry_code'],
                    'password' => 'customerSmartFret',
                    'customer_post_code' => $data['customer_post_code'],
                    'customer_barCode' => $this->gen(),
                    'date_inscription' => $date,
                    'reduction_value'=>0,
                    'reduction_voiture'=>0,
                    'augmentation'=>0,
        ];

        $customerAdd = Customer::create($dataFinal);

        $user = ['activity_description' => 'L\'utilisateur a crée le client', 'activity_identified' => $customerAdd->customer_name.' '. $customerAdd->customer_surname, 'activity_route' => "client/$customerAdd->id", 'user_id' =>0];

        Activity::create($user);

        $this->customer_id = $customerAdd->id;

        $this->name = $customerAdd->customer_name.' '.$customerAdd->customer_surname;
        return $this->customer_id;
    }
    public function createReceiver(Request $request)
    {
        $date = date('Y-m-d H:i:s');
$data= $request->cstid;
        $donneFinal =[
            'receiver_name' =>$data['receiver_name'],
            'receiver_surname' =>$data['receiver_surname'],
            'receiver_email' =>$data['receiver_email'],
            'receiver_phone1' =>$data['receiver_phone1'],
            'receiver_phone2' =>$data['receiver_phone2'],
            'receiver_city' =>$data['receiver_city'],
            'receiver_adress' =>$data['receiver_adress'],
            'date_create' => $date,
            'customer_id' => $data['customer_id']
        ];
       ;


                $ReceiverAdded = Receiver::create($donneFinal);

                $user = ['activity_description' => 'L\'utilisateur a crée le récepteur', 'activity_identified' => $donneFinal['receiver_name'], 'activity_route' => "recepteur/0", 'user_id' => 1];

                Activity::create($user);

                $this->receiver_id = $ReceiverAdded->id;

                $this->nameR = $ReceiverAdded->receiver_name.' '.$ReceiverAdded->receiver_surname;
        return $this->receiver_id;

    }


public function custcat(Request $request)
{
    $IdUser = $request->cstid;

            $cmd = Customer::find($IdUser);
            $categorie = $cmd->categorie;
        return $cmd;


}
}
