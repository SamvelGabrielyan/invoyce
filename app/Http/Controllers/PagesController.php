<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\User;
use App\Model\UserBillings;
use App\Model\Invoice;
use App\Model\State;
use App\Model\InvoiceItem;
use App\Model\PaymentSetting;
use App\Model\Paypal;
use App\Model\InvoiceBilling;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard;
use View, Validator, Input, Redirect, Auth, URL;

use App\Http\Requests\ContactUsRequest;

class PagesController extends Controller {

	public function __construct() {
		//parent::__construct();
	}

    /**
     * Showing main home page.
     *
     * @since 1.0.1
     *
     * @return $this
     */
    public function index()
    {
		\Session::set('show_notification','');
    	$title = "Online Invoicing, Online Billing and Professional Invoices"; 
		
		return view('pages.home')->with(['title' => $title]);
    }

    /**
     * Send contact us message by email.
     *
     * @since 1.0.1
     *
     * @param ContactUsRequest $request
     * @return string
     */
	public function contactUsPost(ContactUsRequest $request)
    {
		$name    = $request->name;
		$email   = $request->email;
		$message = $request->message;
		
		$body = View::make('emails.contact_mail', [
		    'name'    => $name,
            'email'   => $email,
            'message' => $message
        ])->render();

		$dataEmail = [
		    'to'      => env('MASTER_EMAIL'),
            'subject' => 'Contact Us Inquiry Received',
            'body'    => $body
        ];

		_mail($dataEmail);

		return json_encode([
			'success' => true,
			'message' => '',
		]);
	}

    /**
     * Show terms and conditions page.
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function termCondition()
    {
		return view('pages.term_condition');
	}

    /**
     * Show privacy policy page.
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function privacyPolicy()
    {
		return view('pages.privacy_policy');
	}

    /**
     * Hiding notifications.
     *
     * @since 1.0.1
     *
     * @return string
     */
    function hideNotification()
    {
        \Session::set('show_notification','false');

        return 'true';
    }

	public function webhook(){
		$eventData = Input::all();
//		dd($eventData);

		if(!empty($eventData)){
			$event_id = $eventData['id'];
			\DB::table('events')->insert(['event_name'=>$eventData['type'],'data'=>json_encode($eventData)]);
			
			require app_path('Components/stripe/init.php');
			\Stripe\Stripe::setApiKey(\Config::get('constants.STRIPE_SECRET_KEY'));
			try {
				$event  = \Stripe\Event::retrieve($event_id);
				if($event && !empty($event)){
					$subscription_id = $event->data->object->id;
					if($event->type == 'customer.subscription.updated') {
						$isAlreadyBilling = UserBillings::where('subscription_id','=',$subscription_id)->first();
						if(!empty($isAlreadyBilling)){
							$finalDate = date("Y-m-d", strtotime("+1 month"));
							UserBillings::where('id','=',$isAlreadyBilling->id)->update(['billing_expire_date'=>$finalDate]);
						}
					}
				}
				
			}  catch(Stripe_CardError $e) {
				//
			}
		}
	}

	function invoiceconsentcheck()
	{
        echo "checkign it";
        die;


	}
  

	/***************
   Paypal Ipn setting 
  ************/
  function paypaipndata()
  {
      
      
      $raw_post_data = file_get_contents('php://input');
      mail('gagansingh00923@gmail.com','emailtest',$raw_post_data); 
      $raw_post_array = json_decode($raw_post_data);
    
      $paypal_conf = \Config::get('paypal');
	  $invoice_url  = $raw_post_array->resource->invoice->id;
	
      $invoiceRow = Invoice::where('invoice_url','=',$invoice_url)->first();
      
      if(count($raw_post_array)>0 and isset($raw_post_array->resource->invoice->id) and $raw_post_array->resource->invoice->status=='PAID'):    
         mail('gagansingh00923@gmail.com','emailtest',$raw_post_data);    
        $dataInsert = ['invoice_id'=>$raw_post_array->resource->invoice->id,'txn_no'=>$raw_post_array->resource->invoice->payments[0]->transaction_id,'pay_date'=>date('Y-m-d',$raw_post_array->resource->invoice->payments[0]->date)];
       $getInvoiceInfo = $invoiceRow->toArray(); 	
	   InvoiceBilling::insert($dataInsert);
	   Invoice::where('id','=',$getInvoiceInfo['id'])->update(['save_status'=>'3']);
	   $value = Invoice::where('invoice_url','=', $invoice_url)->first();
		$invoice_data = $value;
		if($value!='' && $value->save_status=='3'){
			if($value->invoice_type=='2' && $value->schedule_type=='2' && $invoice_data['send_paid_email'] == '0'){
				$item = InvoiceItem::where('invoice_id', '=', $value->id)->get();
				$send_invoice_days = $value->send_invoice_days;
				$send_invoice_date = date('Y-m-d', strtotime('+'.$send_invoice_days.' days'));
				$save_status = '0';
				$last_id='';
				$add_date = date("Y-m-d");
				$last_id = Invoice::insertGetId(
					['invoice_url'=>'','schedule_type' => $value->schedule_type,'save_status'=>$save_status,'send_invoice_date' => $send_invoice_date,
					'send_invoice_days' => $send_invoice_days,'user_id' => $value->user_id,'notification_status'=>$value->notification_status,
					'company_name' => $value->company_name,'email' =>$value->email,'additional_email'=>$value->additional_email,
					'address'=>$value->address,'city'=>$value->city,'state'=>$value->state,'zip_code'=>$value->zip_code,'phone'=>$value->phone,
					'invoice_title'=>$value->invoice_title,'invoice_number'=>$value->invoice_number,
					'invoice_message'=>$value->invoice_message,'terms_conditions'=>$value->terms_conditions,
					'invoice_type'=>$value->invoice_type,'total_amount' => $value->total_amount,'view_status'=>'0','add_date'=>$add_date]
				);
				if($last_id != ''){
					$invoice_url='';
					$ranno= rand(0,1000);
					$invoice_url = md5($ranno.'@@@@@'.$last_id);
					$random_number = mt_rand(100000, 999999);
					if($last_id!=''){
						$no=$last_id;
						$rand_no=$random_number.$no;
					}
					$sql = Invoice::where('id', $last_id)->update(array('invoice_url' => $invoice_url,'invoice_number'=>$rand_no));
					if($item!=''){
						foreach($item as $itemValue){
							if($itemValue->id!=''){
								$insert = InvoiceItem::insertGetId(
									['invoice_id' => $last_id,'item' => $itemValue->item,'description' =>$itemValue->description,
									'rate'=>$itemValue->rate,'qty'=>$itemValue->qty,'discount'=>$itemValue->discount,'discount_type'=>$itemValue->discount_type,'total_amount'=>$itemValue->total_amount]
									);
							}
						}
					}
				}
			}
			  
			//Mail send to sender who send invoice
			$profile_info = User::where('id', '=', $value->user_id)->first();
			
			$item = InvoiceItem::where('invoice_id', '=', $value->id)->get();
				/*Mail::send('dashboard.emails.paid', ['invoice_data' => $invoice_data, 'item' => $item, 'profile_info'=> $profile_info], function ($message) use ($profile_info)
				{
				$message->from('noreply@invoyce.me', 'Invoice Paid');
				$message->to($profile_info->email)->subject('Invoice Paid');
			});*/
			if($invoice_data['send_paid_email'] == '0'){
				$data['to'] = $profile_info->email;
				$data['subject'] = 'Invoice Paid';
				$data['body'] = View::make('emails.paid', ['invoice_data' => $invoice_data, 'item' => $item, 'profile_info'=> $profile_info])->render();
				$data['sender']= 'noreply@invoyce.me';
				$data['cc']= '';
				_mail($data);
				
				$data['to'] = $invoice_data->email;
				//$data['subject'] = 'Invoice Payment Receipt';
				$data['subject'] = 'Receipt for Invoice # '.$invoice_data->invoice_number.'-'.$profile_info->company;
				$data['body'] = View::make('emails.receipt', ['invoice_data' => $invoice_data, 'item' => $item, 'profile_info'=> $profile_info])->render();
				$data['sender']= 'noreply@invoyce.me';
				$data['cc']= '';
				_mail($data);
				
			}
			Invoice::where('id','=', $invoice_data['id'])->update(['send_paid_email'=>'1']);
		}
	 endif;
	 echo "You are coming here bro";
	 die;
      
  }
}


