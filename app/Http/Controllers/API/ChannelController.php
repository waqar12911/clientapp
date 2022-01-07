<?php

namespace App\Http\Controllers\API;

use App\Models\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class ChannelController extends Controller
{
    public function index(Request $request){
        if($request->id && !empty($request->id))
        {
            $data=Channel::where('client_id',$request->id)->get();
            return response()->json($data);
        }
        else
        {
            return response()->json(['status'=>false,'message'=>'Id required for loged in client'], 404);
        }
    }

    public function channelEdit($id){
        $data=Channel::where('id',$id)->first();
        return response()->json($data);
    }


    public function createChannel(Request $request){

        $validator = Validator::make($request->all(), [
            'alias' => 'required|string',
            'channel_id' => 'required',
            'id' => 'required',
        ])->validate();

        $data=new Channel();
        $data->client_id=$request->id;
        $data->alias=$request->alias;
        $data->channel_id=$request->channel_id;

        if ($data->save()){
            return response()->json(['status'=>true,'message'=>'Channel Created Successfully','data'=>$data]);
        }
        else

        {
            return response()->json(['status'=>false,'message'=>'Sorry there was an error while creating channel'], 404);
        }
    }


    public function updateChannel(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'alias' => 'required|string',
        ])->validate();

       $data=Channel::findOrFail($id);
        $data->alias=$request->alias;
        if ($data->save()){
            return response()->json(['status'=>true,'message'=>'updated successfully','data'=>$data]);
        }
        else
        {
             return response()->json(['status'=>false,'message'=>'Sorry an error occured'], 404);
        }
    }

    public function channelDelete($id){
        $data=Channel::where('id',$id)->delete();
        if($data){
            return response()->json(['status'=>true,'message'=>'Deleted Successfully']);
        }
        else
        {
             return response()->json(['status'=>false,'message'=>'Sorry an error occured'], 404);
        }
    }
}
