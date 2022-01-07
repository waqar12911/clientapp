<?php

namespace App\Http\Controllers;

use App\Models\ClientData;
use App\Models\TransectionClient;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
         $user = auth()->user()->id;

	     $client = ClientData::where('user_id' , $user)->first();
          if(!isset($client) || $client == null || $client->is_active == 0 || $client->is_gamma_user == 0){
             Auth::logout();
             return redirect('/admin-login')->withErrors(['Client is inactive / is not gamma user']);
         
          }
         
        $Transection=TransectionClient::where('client_id',$client->client_id)->count();
        return view('dashboard',compact('Transection'));
    }
}

