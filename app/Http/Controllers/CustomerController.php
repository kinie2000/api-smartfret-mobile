<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = request()->validate([
            'customer_name' => 'required|max:100',
            'customer_surname' => 'required|max:100',
            'customer_mail' => 'required|email',
            'customer_phone' => 'required|max:30',
            'customer_adress' => 'required|max:300',
            'customer_city'=> 'max:100',
            'customer_country' => 'required',
            'customer_post_code' => 'max:300',
        ]);

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
            case 'Cameroun':
                $donnee['Customer_contry_code'] = 'CM';
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

        $dataFinal =  [
                    'customer_name' => $data['customer_name'],
                    'customer_surname' => $data['customer_surname'],
                    'customer_mail' => $data['customer_mail'],
                    'customer_phone' => $data['customer_phone'],
                    'customer_adress' => $data['customer_adress'],
                    'customer_other_adress' => $request['customer_other_adress'],
                    'customer_city' => $data['customer_city'],
                    'customer_country' => $data['customer_country'],
                    'Customer_contry_code' => $donnee['Customer_contry_code'],
                    'customer_post_code' => $data['customer_post_code'],
                    'customer_cni' => $request['customer_cni'],
        ];

       $customer= Customer::Where('id',$request['id'])->update($dataFinal);

       if($customer==1)
       {
            $customer=Customer::where('id',$request['id'])->first();
            $customer->profil="client";
            return response(['message'=>'Mise à jour reussis','user'=>$customer]);
       }
       else
       {
            return response(['message'=>'Une erreur s\'est produite lors de la modification veillez réessayer plus tard','status'=>false]);
       }

      
    }
}
