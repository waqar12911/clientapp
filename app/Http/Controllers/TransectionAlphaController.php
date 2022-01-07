<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TransectionClient;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Imports\ProjectsImport;
use App\Exports\ProjectExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\ClientData;
use DB;
use Session;


class TransectionAlphaController extends Controller
{
  public function getTransactionsalpha(){
      $client=ClientData::where('user_id',Auth::user()->id)->first();
      if($client)
      {
         $data=TransectionClient::where('client_id',$client->client_id)->get();
         $status = DB::table('is_email_allow')->where('user_type', 'gema')->get();
         return view('admin_settings.alpha-transection.transaction-home',compact('data'), compact('status'));
      }
      else
      {
        return redirect()->back();
      }
      
    }
    
    
    public function filterTransection(Request $request){
    $transection =  TransectionClient::query();
        if ($request["date_from"]){
            $transection->whereDate("created_at" ,'>=',$request["date_from"] );
        }
        if ($request["date_to"]){
            $transection->whereDate("created_at" ,'<=',$request["date_to"] );
        }
        $data = $transection->get();
        // dd($data);

        return view("admin_settings.alpha-transection._transactions",compact('data'));    
    }
    
    public function download_excel(){
                return Excel::download(new ProjectExport, 'client_id__'.Auth::user()->merchant_id.'__name__'.Auth::user()->name.'__'.carbon::now().'__transections.csv',\Maatwebsite\Excel\Excel::CSV);

    }
   public function download_hsmkey(){
                return Excel::download(new ProjectExport, 'client_id__'.Auth::user()->merchant_id.'__name__'.Auth::user()->name.'__'.carbon::now().'__transections.csv',\Maatwebsite\Excel\Excel::CSV);

    }


  
    public function upload_csv(){
         return view('admin_settings.alpha-transection.upload');
    }
    
     private function csvToArray($filename = '', $delimiter = ',' )
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 10000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                // dd($header);
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
    
    public function import_transections(Request $request){
           request()->validate([
            'file' => 'required|mimes:csv,xls,xlsx,txt'
        ]);
        $path = request()->file('file')->getRealPath();
        $csvArrr = $this->csvToArray($path);
        $client_id = auth()->user()->client_id;
        foreach($csvArrr as $row){
            // $request['id']
                     if($row['client_id'] != $client_id ){
                         continue;
                     }
                     else{
                         
                            $datad = DB::table('transection_clients')->where('id' , $row['id'])->get();
                           
                            // if(isset($datad) || $datad != null){
                             if(!$datad->isEmpty()){
                                
                                 DB::table('transection_clients')->where('id' , $row['id'])->update([
                                        'transaction_label'=> $row['transaction_label'],
                                        'transaction_amountBTC'=> $row['transaction_amountBTC'],
                                        'transaction_amountUSD'=> $row['transaction_amountUSD'],
                                        'payment_hash'=> $row['payment_hash'],
                                        'conversion_rate'=> $row['conversion_rate'],
                                        'payment_preimage'=> $row['payment_preimage'],
                                        'status'=> $row['status'],
                                        'description' => $row['description'],
                                        'client_id'=> $client_id,
                                        'msatoshi'=> $row['msatoshi'],
                                        'destination'=> $row['destination'],
                                        'transaction_timestamp'=> carbon::now(),
                                        'created_at' =>  carbon::now(),
                                        'updated_at'=>  carbon::now(),
                                         ]);
                            }
                            else{
                               
                                
                                 DB::table('transection_clients')->insert([
                                        'transaction_label'=> $row['transaction_label'],
                                        'transaction_amountBTC'=> $row['transaction_amountBTC'],
                                        'transaction_amountUSD'=> $row['transaction_amountUSD'],
                                        'payment_hash'=> $row['payment_hash'],
                                        'conversion_rate'=> $row['conversion_rate'],
                                        'payment_preimage'=> $row['payment_preimage'],
                                        'status'=> $row['status'],
                                        'description' => $row['description'],
                                        'client_id'=> $client_id,
                                        'msatoshi'=> $row['msatoshi'],
                                        'destination'=> $row['destination'],
                                        'transaction_timestamp'=> carbon::now(),
                                        'created_at' =>  carbon::now(),
                                        'updated_at'=>  carbon::now(),
                                         ]);
                                
                                // continue;
                            }
                               
                                                    
                         
                     }
                     
                                         
                     
                     
        }
        // dd($csvArrr);
        Session::flash('message', 'csv file imported!');
        return redirect()->route('getTransactionsalpha');  
    }

    
    
}
