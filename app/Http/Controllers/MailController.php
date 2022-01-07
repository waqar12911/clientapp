<?php

namespace App\Http\Controllers;

use App\Models\TransectionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use DB;
use Session;
use Swift_Mailer;
use Swift_SmtpTransport;
use Auth;




class MailController extends Controller
{
  
  	public function clientRequestNewMemberToken()
    {
        $user=Auth::user();
        $transport = new Swift_SmtpTransport('mail.nextlayer.live', 587, 'tls');
        $transport->setUsername('outgoing@nextlayer.live');
        $transport->setPassword('Bitcoin2020$');
        $swift_mailer = new Swift_Mailer($transport);
        Mail::setSwiftMailer($swift_mailer);
        $data = ["name" => "Qaiser" , "email"=>"qaiser@stepinnsolution.com"];
        $reciever_email = $user->email;
        $sender_email = 'outgoing@nextlayer.live';
        $subject = 'Token Renewal Authorization Request ';


        $data['code'] = $this->generate2faCode();
        DB::table('client_data')->where('user_id',$user->id)->update([
          "2fa_code" => $data['code']
        ]);
        Mail::send(['html'=>'emails.send2faMail'], $data, function($message) use($reciever_email , $sender_email, $subject ) {
          $message->to($reciever_email)->subject
            ($subject);
          $message->from($sender_email);
        });
      return back()->with('sent', '2fa Code has been sent');
    }
  
  	public function generate2faCode()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 5; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return strtoupper($randstring);
    }
  
  	public function clientVerify2faCode(Request $request)
    {
        $user=Auth::user();
        $query=DB::table('client_data')->where('user_id',$user->id)->where('2fa_code', $request->code)->first();
        if($query)
        {
          return back()->with('success', '2fa Code Verified');
        }
      	else
        {
          return back()->with('fail', '2fa Code is InValid');
        }
    }
    
      
    // change the email to auto or manual by client side
    public function isClientEmailAllow(Request $request){
        $type = $request->type;
        $userType = $request->userType;
        $emailStatus = $request->emailStatus;
        $isUpdate = DB::table('is_email_allow')->where('type', $type)->where('user_type', $userType)->update([
        'is_email'=>$emailStatus
            ]);
            
           if($isUpdate){
               if($emailStatus == 'auto'){
                   return 'auto';
               }else{
                   return 'manual';
               }
               
           }else{
               return 'no';
           }
    }
    
    /** function for daily manual report*/
    public function dailyManualEmail(Request $request){
        $customEmail = $request->dailyEmail;
        $arr = $request->searchIds;
        $searchIDs = explode(',',$arr[0]);
        $arryData = [];
        foreach($searchIDs as $ids){
           
            $transactionData = DB::table('transection_clients')->where('id',$ids)->get();
            array_push($arryData, $transactionData);
        }
        $myArray = [
                [
                'Id', 'Transaction Label', 'Transaction AmountBTC', 'Transaction AmountUSD', 'Payment Hash', 'Conversion Rate', 'Payment Preimage',
                'Status', 'Client Id', 'Msatoshi', 'Destination', 'Description','Transaction Timestamp', 'Created At', 'Updated At'
                ]
            ];
        foreach ($arryData as $value) {
            foreach ($value as $key => $follower) {
                    unset($key);
                     array_push($myArray ,(array)$follower);
            }
        }
      $fp = fopen('file.csv', 'w');
      foreach ($myArray as $fields) {
          fputcsv($fp, $fields);
      }
      fclose($fp);
      
      
        $now = Carbon::now();
        $currentDate = $now->toDateString();
        
        $to_email = $customEmail;
        $data = ['currentDate'=>"$currentDate"];
        $doneEmail = Mail::send(['html'=>'email_templates.custom_report'], $data, function($message) use ($to_email) {
           $message->to($to_email)
               ->subject('C lightning Client daily');
           $message->from("nextlayertechnology@gmail.com");
          $message->attach('file.csv');
        });
        
    return redirect()->back()->with('message', 'Your Custom email has sent successfully');
    }
    
    /** function for sending the weekly manual report */
    public function weeklyManualEmail(Request $request){
        
        $weekMail = $request->weekMail;
        $weekStart = $request->weekStart;
        $weekEnd = $request->weekEnd;
        
        $dateS = new Carbon($weekStart);
        $dateE = new Carbon($weekEnd);
        $data = DB::table('transection_clients')->whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->get();
       
        if($data->isEmpty()){
            return redirect('get-transactions-alpha')->with('message', 'There is no record related to this dates');
        }
        
        
         $myArray = [
               [
                'Id', 'Transaction Label', 'Transaction AmountBTC', 'Transaction AmountUSD', 'Payment Hash', 'Conversion Rate', 'Payment Preimage',
                'Status', 'Client Id', 'Msatoshi', 'Destination', 'Description','Transaction Timestamp', 'Created At', 'Updated At'
                ]
            ];
        foreach($data as $object)
            {
                $myArray[] =  (array) $object;
            }
            
      $fp = fopen('file.csv', 'w');
      foreach ($myArray as $fields) {
          fputcsv($fp, $fields);
      }
      fclose($fp);
      
        $to_email = $weekMail;
        
        $data = ['weekStart'=> "$weekStart", 'weekEnd' => "$weekEnd"];
        $doneEmail = Mail::send(['html'=>'email_templates.weekly_manual_report'], $data, function($message) use ($to_email) {
           $message->to($to_email)
               ->subject('C lightning Client Weekly');
           $message->from("nextlayertechnology@gmail.com");
          $message->attach('file.csv');
        });

    return redirect('get-transactions-alpha')->with('message', 'Your Weekly manual email has sent successfully');
        
       
        // }
    }
    
//   Beta dashBoard mails Autometic
     public function daily_mails(){
    
           $transactions=TransectionClient::all();
            $uniq_data=$transactions->unique('client_id')->toArray();
 
           foreach ($uniq_data as $key=>$uniq){
               $user_data[$key]['id']=$uniq['client_id'];
              $user_data[$key]['email']=ClientData::where('client_id',$uniq['client_id'])->pluck('email')->first();
            
             }
            
         /* Checking if the daily auto email is allow or not **/
         $emailAllow = DB::table('is_email_allow')->where('user_type', 'gema')->where('type', 'daily')->where('is_email', 'auto')->get();
                $isEmail = $emailAllow[0]->is_email;
                if($isEmail == "auto"){
        
           foreach ($user_data as $useremail){
                if($useremail['email'] != null){
               $data1=TransectionClient::orderBy('created_at', 'DESC')
                   ->where('client_id',$useremail['id'])
                   ->whereDate('created_at', '=', Carbon::today()->toDateString())->get()->toArray();
               $fp = fopen('file.csv', 'w');
        
               foreach ($data1 as $fields) {
                   fputcsv($fp, $fields);
               }
               fclose($fp);
           
                    
                $now = Carbon::now();
                $currentDate = $now->toDateString();
               
              $to_email = $useremail['email'];
              $client_id = $useremail['id'];
              $client = ClientData::where('client_id', $client_id)->first();
              $merchant_id=$client->id;
              $merchant_name=$useremail['id'];
              $data = ['currentDate'=>"$currentDate", 'merchant_id'=> $merchant_id, 'merchant_name'=>$merchant_name];
               Mail::send('email_templates.daily_beta', $data, function($message) use ($to_email) {
                   $message->to($to_email)
                       ->subject('C lightning Boost daily');
                   $message->from("nextlayertechnology@gmail.com");
                   $message->attach('file.csv');
               });
              }
             }
           }
         }
    
     public function weekly_mails(){
    
          $transactions=TransectionClient::all();
            $uniq_data=$transactions->unique('client_id')->toArray();
 
           foreach ($uniq_data as $key=>$uniq){
               $user_data[$key]['id']=$uniq['client_id'];
              $user_data[$key]['email']=ClientData::where('client_id',$uniq['client_id'])->pluck('email')->first();
            
             }
        
         /* Checking if the weekly auto email is allow or not **/
         $emailAllow = DB::table('is_email_allow')->where('user_type', 'gema')->where('type', 'weekly')->where('is_email', 'auto')->get();
                $isEmail = $emailAllow[0]->is_email;
                if($isEmail == "auto"){
        
           foreach ($user_data as $useremail){
                if($useremail['email'] != null){
               $data1=TransectionClient::orderBy('created_at', 'DESC')
                   ->where('transaction_merchantId',$useremail['id'])
                   ->whereDate('created_at', '>', \Carbon\Carbon::now()->subWeek())->get()->toArray();
        //            ddd($data1);
               $fp = fopen('file.csv', 'w');
        
               foreach ($data1 as $fields) {
                   fputcsv($fp, $fields);
               }
        
               fclose($fp);
               
                 $now = Carbon::now();
                $currentDate = $now->toDateString();
                $week = $now->weekOfYear;
                $month = $now->month;
                $year = $now->year;
               
               $to_email = $useremail['email'];
               $merchant_name = $useremail['id'];
               $merchant_id = ClientData::where('client_id', $merchant_name)->pluck('id')->first();
               
               $data = ['currentDate'=>"$currentDate", 'merchant_id'=> $merchant_id, 'merchant_name'=>$merchant_name];
               Mail::send('email_templates.weekly_beta', $data, function($message) use ($to_email) {
                   $message->to($to_email)
                       ->subject('C lightning Boost Weekly');
                   $message->from("nextlayertechnology@gmail.com");
                   $message->attach('file.csv');
               });
            }
        }
       }
      }
          
     public function monthly_mails(){
    
            $transactions=TransectionClient::all();
            $uniq_data=$transactions->unique('client_id')->toArray();
 
           foreach ($uniq_data as $key=>$uniq){
               $user_data[$key]['id']=$uniq['client_id'];
              $user_data[$key]['email']=ClientData::where('client_id',$uniq['client_id'])->pluck('email')->first();
            
             }
        
        
             /* Checking if the monthly auto email is allow or not **/
             $emailAllow = DB::table('is_email_allow')->where('user_type', 'gema')->where('type', 'monthly')->where('is_email', 'auto')->get();
             $isEmail = $emailAllow[0]->is_email;
             if($isEmail == "auto"){
        
           foreach ($user_data as $useremail){
                if($useremail['email'] != null){
                $data1=TransectionClient::orderBy('created_at', 'DESC')
                   ->where('transaction_merchantId',$useremail['id'])
                   ->whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())->get()->toArray();
        //            ddd($data1);
               $fp = fopen('file.csv', 'w');
        
               foreach ($data1 as $fields) {
                   fputcsv($fp, $fields);
               }
        
               fclose($fp);
            
            
                $now = Carbon::now();
                $currentDate = $now->toDateString();
                $week = $now->weekOfYear;
                $month = $now->format('F');
                $year = $now->year;
               
               $to_email = $useremail['email'];
               $merchant_name = $useremail['id'];
               $merchant_id = ClientData::where('client_id', $merchant_name)->pluck('id')->first();
               $data = ['month'=>"$month",'year'=>"$year", 'merchant_id'=> $merchant_id, 'merchant_name'=>$merchant_name];
               Mail::send('email_templates.monthly_beta', $data, function($message) use ($to_email) {
                   $message->to($to_email)
                       ->subject('C lightning Boost Monthly');
                   $message->from("nextlayertechnology@gmail.com");
                   $message->attach('file.csv');
               });
            }
         }
       }
    }
    
    
    
    
  
}
