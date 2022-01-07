<?php

namespace App\Http\Controllers;

use App\Models\ClientData;
use Illuminate\Http\Request;

class ClientDataController extends Controller
{
    public function clientEdit($id){
//dd();
        $data=ClientData::where('id',$id)->get()->first();
//        dd($data);
        return view('users.edit-client',compact('data'));
    }


    public function createClient(Request $request){
        if ($request->hasFile('client_image_id')) {
            $image = $request->file('client_image_id');
            $imageName = time() . "-" .$image->extension();
            $imagePath = public_path() . '/black/images';
            $image->move($imagePath, $imageName);
            $imageDbPath = $imageName;
        }

        $data=ClientData::create([
            'client_name'=>$request['client_name']??'',
            'client_id'=>$request['client_id']??'',
            'national_id'=>$request['national_id']??'',
            'address'=>$request['address']??'',
            'email'=>$request['email']??'',
            'dob'=>$request['dob']??'',
            'is_gamma_user'=>$request['is_gamma_user']??'',
            'registered_at'=>$request['registered_at']??'',
            'is_active'=>$request['name']??'',
            'client_image_id'=>$imageDbPath??'',
            'card_image_id'=>$request['card_image_id']??'',
            'maxboost'=>$request['maxboost']??'',
        ]);

if ($data){
    return redirect()->back()->with('message','Client Created Successfully');
}
    }


    public function updateClient(Request $request,$id){

        $data=ClientData::where('id',$id)->update([
            'maxboost_limit'=>$request['maxboost_limit'],
            'is_active'=>$request['is_active'],

        ]);
if ($data){
    return redirect()->route('profile.edit')->with('message','updated successfully');
}
    }

    public function addClient(){
        return view('users.add-client');
    }
    
    
    
    
       public function clientDelete($id){
        $data=ClientData::where('id',$id)->delete();
        if($data){
            return redirect()->back()->with('message','Deleted Successfully');
        }
    }
    
    
    

}
