<?php

namespace App\Http\Controllers;

use App\Models\ShockPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ClientData;
use Auth;

class ShockPayController extends Controller
{

    public function index(){
        $client=ClientData::where('user_id',Auth::user()->id)->first();
        $data=ShockPay::where('client_id',$client->client_id)->get();
        return view('shockpay',compact('data'));
    }

    public function shockpayEdit($id){
        $data=ShockPay::where('id',$id)->get()->first();
        return view('users.edit-client',compact('data'));
    }


    public function createShockpay(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'node_id' => 'required',
        ])->validate();

        $client=ClientData::where('user_id',Auth::user()->id)->first();
        $data=new ShockPay();
        $data->client_id=$client->client_id;
        $data->shock_pay_contact_name=$request->name;
        $data->shock_pay_contact_Node_ID=$request->node_id;

        if ($data->save()){
            return redirect()->back()->with('message','ShockPay Created Successfully');
        }
        else

        {
            return redirect()->back()->with('message','Sorry there was an error while creating shockpay');
        }
    }


    public function updateShockpay(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'node_id' => 'required',
        ])->validate();

        $data=ShockPay::findOrFail($id);
        $data->shock_pay_contact_name=$request->name;
        $data->shock_pay_contact_Node_ID=$request->node_id;
        if ($data->save()){
            return redirect()->back()->with('message','updated successfully');
        }
        else
        {
            return redirect()->back()->with('message','Sorry an error occured');
        }
    }

    public function shockpayDelete($id){
        $data=ShockPay::where('id',$id)->delete();
        if($data){
            return redirect()->back()->with('message','Deleted Successfully');
        }
        else
        {
            return redirect()->back()->with('message','Sorry an error occured');
        }
    }
}
