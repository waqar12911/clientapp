<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TransectionAlpha;
use Illuminate\Http\Request;

class AlphaController extends Controller
{
    public function addAlphaTransction(Request $request){
        
        $data=TransectionAlpha::create([
        'transaction_label'=>$request['transaction_label'],
        'payment_hash'=>$request['payment_hash'],
        'transaction_amountBTC'=>$request['transaction_amountBTC'],
        'transaction_amountUSD'=>$request['transaction_amountUSD'],
        'payment_preimage'=>$request['payment_preimage'],
        'status'=>$request['status'],
        'destination'=>$request['destination'],
        'transaction_timestamp'=>$request['transaction_timestamp'],
        'msatoshi'=>$request['msatoshi'],
        'conversion_rate'=>$request['conversion_rate'],
        'merchant_id'=>$request['merchant_id'],
        
        ]);
        
        if($data){
            return response()->json(['message'=>'successfully done','data'=>$data] );
        }else{
            return response()->json(['message'=>'some thing went wrong'] );
        }
    }

}
