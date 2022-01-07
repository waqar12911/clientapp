<?php

namespace App\Http\Controllers\API;

use App\Models\ShockPay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class ShockPayController extends Controller
{

    public function index(Request $request){
        if($request->id && !empty($request->id))
        {
            $data=ShockPay::where('client_id',$request->id)->get();
            return response()->json($data);
        }
        else
        {
            return response()->json(['status'=>false,'message'=>'Id required for loged in client'], 404);
        }
        
    }

    public function shockpayEdit($id){
        $data=ShockPay::where('id',$id)->first();
        return response()->json($data);
    }


    public function createShockpay(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'node_id' => 'required',
            'id' => 'required',
        ])->validate();

        $data=new ShockPay();
        $data->client_id=$request->id;
        $data->shock_pay_contact_name=$request->name;
        $data->shock_pay_contact_Node_ID=$request->node_id;

        if ($data->save()){
            return response()->json(['status'=>true,'message'=>'ShockPay Created Successfully','data'=>$data]);
        }
        else

        {
            return response()->json(['status'=>false,'message'=>'Sorry there was an error while creating shockpay'], 404);
        }
    }


    public function updateShockpay(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ])->validate();

        $data=ShockPay::findOrFail($id);
        $data->shock_pay_contact_name=$request->name;
        $data->shock_pay_contact_Node_ID=$request->node_id;
        if ($data->save()){
            return response()->json(['status'=>true,'message'=>'updated successfully','data'=>$data]);
        }
        else
        {
             return response()->json(['status'=>false,'message'=>'Sorry an error occured'], 404);
        }
    }

    public function shockpayDelete($id){
        $data=ShockPay::where('id',$id)->delete();
        if($data){
            return response()->json(['status'=>true,'message'=>'Deleted Successfully']);
        }
        else
        {
             return response()->json(['status'=>false,'message'=>'Sorry an error occured'], 404);
        }
    }
}
