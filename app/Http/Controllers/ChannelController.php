<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class ChannelController extends Controller
{
    public function index(){
        $data=Channel::where('user_id',auth()->user()->id)->get();
        return view('channels',compact('data'));
    }

    public function channelEdit($id){
        $data=Channel::where('id',$id)->get()->first();
        return view('users.edit-client',compact('data'));
    }


    public function createChannel(Request $request){

        $validator = Validator::make($request->all(), [
            'alias' => 'required|string',
            'channel_id' => 'required',
        ])->validate();

        $data=new Channel();
        $data->user_id=Auth::user()->id;
        $data->alias=$request->alias;
        $data->channel_id=$request->channel_id;

        if ($data->save()){
            return redirect()->back()->with('message','Channel Created Successfully');
        }
        else

        {
            return redirect()->back()->with('message','Sorry there was an error while creating channel');
        }
    }


    public function updateChannel(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'alias' => 'required|string',
        ])->validate();

       $data=Channel::findOrFail($id);
        $data->alias=$request->alias;
        if ($data->save()){
            return redirect()->back()->with('message','updated successfully');
        }
        else
        {
            return redirect()->back()->with('message','Sorry an error occured');
        }
    }

    public function channelDelete($id){
        $data=Channel::where('id',$id)->delete();
        if($data){
            return redirect()->back()->with('message','Deleted Successfully');
        }
        else
        {
            return redirect()->back()->with('message','Sorry an error occured');
        }
    }
}
