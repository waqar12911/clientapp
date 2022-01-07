<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\ClientData;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Hash;
use Carbon\carbon;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clients_login(Request $request){

         if(!isset($request->client_2FA_Password)){
             return response()->json(['message'=>'Client_2fa_password is necessery'] , 200 );
         }
         
         if(!isset($request->client_id)){
             return response()->json(['message'=>'client_id password is necessery'] , 200 );
         }

        $user =ClientData::where('client_id',$request->client_id)->get()->first();
    if($user){
        if($user->count()<1)
        {
        return response()->json(['error' =>'invelid User']);
        }
             if($user['is_active'] != '1')
            {
                return response()->json(['message' =>'user is not active']);
            }
            
             
              if($user->client_2fa_password == $request->client_2FA_Password){
                  return response()->json(['message'=>'successfully login','data'=>$user] );
                  
              }
              else{
                     return response()->json(['message' =>'invalid 2fa password' , 'data' =>null] , 200);
              }
              
              
            
            return response()->json(['message'=>'successfully done','data'=>$user] );
    }
    else
    {
        return response()->json(['message'=>'Invalid Client id'],200 );
    }
}

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

public function get_shock_pay($client_id){
    
    $user =ClientData::where('client_id',$client_id)->first();
    if(!$user){
         return response()->json(['status'=> 'failed', 'message'=>'invalid client id' ], 200 );
    }
       $data = DB::table('shock_pay')->where('client_id' ,$client_id)->get();
       if(count($data) > 0 ){
           return response()->json(['status' => 'success',  'message'=>'successfully get', 'data'=> $data], 200);
       }
       else{
           return response()->json(['status' => 'failed', 'message'=>'No record found' ]);
       }
               
}
public function create_shock_pay(Request $request){
    
    $user =ClientData::where('client_id',$request->client_id)->first();
    if( !isset($request->shock_pay_contact_name) || !isset($request->shock_pay_contact_Node_ID)){
        return response()->json(['status'=> 'failed', 'message'=>'Contact name and node is compulsory' , 'data' => null], 200 );
    }
    
    if($user){
        $data = DB::table('shock_pay')->insert([
            'client_id' => $request->client_id,
            'shock_pay_contact_name' => $request->shock_pay_contact_name,
            'shock_pay_contact_Node_ID' => $request->shock_pay_contact_Node_ID,
            ]);
        if($data){
             $res = DB::table('shock_pay')->orderBy('id' , 'desc')->first();
            return response()->json(['status'=> 'success', 'message'=>'Successfully creaetd' , 'data' => $res], 200 );
        }
        else{
            return response()->json(['status'=> 'failed', 'message'=>'Something went wrong'], 200 );
        }
        
    }
    else{
        return response()->json(['status'=> 'failed', 'message'=>'Invalid Clint id' , 'data' => null], 200 );
    }
}

public function delete_shock_pay(Request $request){
   
     $user = ClientData::where('client_id',$request->client_id)->first();
    if(!$user){
         return response()->json(['status'=> 'failed', 'message'=>'invalid client id' ], 200 );
    }
    $primaryId = DB::table('shock_pay')->where('id',$request->primary_id)->first();
     if(!$primaryId){
         return response()->json(['status'=> 'failed', 'message'=>'invalid primary id' ], 200 );
    }
   
    $result = DB::table('shock_pay')->where('id',$primaryId->id)->where('client_id', $user->client_id)->delete();
     
    
    if($result){
         return response()->json(['status'=> 'success', 'message'=>'Delete Successfully' , 'data' => $result], 200 );
    }else{
         return response()->json(['status'=> 'failed', 'message'=>'Something went wrong'], 200 );
    }
   
    
}

    public function getClients($id){

        $data=ClientData::select('id','client_id','client_image_id','card_image_id')->where('client_id',$id)->orWhere('id',$id)->first();

        if($data){
        return response()->json(['message'=>'successfully done','data'=>$data] );
        }
    }

}
