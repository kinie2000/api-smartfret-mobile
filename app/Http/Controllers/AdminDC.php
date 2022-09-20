<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class AdminDC extends Controller
{
    //
    public function showadmcmd(Request $request)
    {
        $IdUser = $request->customerId;
        $cmd = DB::table('purchase_orders')
            ->where('user_id',2)
            ->orderByRaw('created_at DESC')
            ->get();
        return $cmd;
    }
}
