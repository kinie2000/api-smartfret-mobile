<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use App\Models\Packet;
use App\Models\Purchase_order;

class CommandeController extends Controller
{
    public function showcmd(Request $request)
    {
        $IdUser=$request->customerId;
         $cmd=DB::table('purchase_orders')
        ->join('receivers','purchase_orders.receiver_id','=', 'receivers.id')
        ->where('purchase_orders.customer_id',$IdUser)
         ->select('purchase_orders.id','purchase_orders.customer_id','purchase_orders.purchase_order_number','purchase_orders.purchase_order_number_packet','purchase_orders.purchase_order_description','purchase_orders.total_amount','receivers.receiver_name','purchase_orders.purchase_order_date','purchase_orders.has_paid','purchase_orders.rest')
         ->orderByRaw('purchase_orders.created_at DESC')
        ->get();
        return $cmd;
    }

      public function showdetailcmd(Request $request)
      {
        $idcm = $request->Csid;
        $cmd = Purchase_order::find($idcm);
   $cmd->receiver;
        return $cmd;
      }
    public function show(Request $request)
    {
        $Id=$request->Csid;
      $cmd=DB::table('packets')
        ->join('purchase_orders','packets.purchase_order_id','=', 'purchase_orders.id')
        ->where('purchase_orders.id', '=',$Id)
         ->select('purchase_orders.id','purchase_orders.customer_id','purchase_orders.purchase_order_number','purchase_orders.purchase_order_number_packet','purchase_orders.purchase_order_description','purchase_orders.total_amount','purchase_orders.purchase_order_date','purchase_orders.has_paid','purchase_orders.rest','packets.packet_title','packets.packet_status','packets.number')
        ->get();
        return $cmd;

        /*
    $IdUser = $request->Csid;
$cmd = Purchase_order::find($IdUser);
            $cmd2 = Packet::find($cmd);


        return $cmd2;*/

    }

    public function showpacket(Request $request){
        $var_paquet=$request['code'];


        $cmd=DB::table('packets')
         ->where('packets.packet_code_bar',$var_paquet)
            ->select('packets.*')
            ->first();
            return $cmd;
    }

}
