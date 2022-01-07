<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TransectionClient;
use Illuminate\Http\Request;
use DB;
class ClientController extends Controller
{
    public function addClientTransction(Request $request){
        
         $check = DB::table('client_data')->where('client_id' , $request['client_id'])->first();
        if(!isset($check) || $check == null){
            return response()->json(['message'=>'client not found','status'=>403]);
        }
        
         $data=TransectionClient::create([
        'transaction_label'=>$request['transaction_label']??'',
        'transaction_amountBTC'=>$request['transaction_amountBTC']??'',
        'transaction_amountUSD'=>$request['transaction_amountUSD']??'',
        'payment_hash'=>$request['payment_hash']??'',
        'conversion_rate'=>$request['conversion_rate']??'',
        'payment_preimage'=>$request['payment_preimage']??'',
        'status'=>$request['status']??'',
        'client_id'=>$request['client_id']??'',
        'msatoshi'=>$request['msatoshi']??'',
        'destination'=>$request['destination']??'',
        'description'=>$request['description']??'',
        'transaction_timestamp'=>$request['transaction_timestamp']??'',
        ]);
        
        if($data){
            return response()->json(['status'=>'success', 'message'=>'Client Transaction has successfully added'] );
        }else{
            return response()->json(['status'=>'failed', 'message'=>'some thing went wrong'] );
        }
    }
    
  
    

}
