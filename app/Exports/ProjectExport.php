<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ProjectExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    

 public function collection()
    {
        
        $client_id = auth()->user()->client_id;
        $data = DB::table('transection_clients')->where('client_id' , $client_id)->get();
        return $data;
    }
    public function headings(): array
    {
        return ["id", "transaction_label", "transaction_amountBTC","transaction_amountUSD", "payment_hash", "conversion_rate","payment_preimage", "status","client_id" ,"msatoshi","destination", "description", "transaction_timestamp" , "created_at" , "updated_at"];
    }
    


}
