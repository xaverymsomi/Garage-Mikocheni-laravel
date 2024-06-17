<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Setting;
use App\Updatekey;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStripeSettingEditFormRequest;

class Timezonecontroller extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	//timezone list
    public function index()
	{
		$user = User::where('id','=',Auth::user()->id)->first();
		$currancy = DB::table('tbl_currency_records')->get()->toArray();
		$currencies = DB::table('currencies')->get()->toArray();
		
		$tbl_settings = Setting::first();

		return view('timezone.list',compact('user','currancy','tbl_settings','currencies')); 
	}
	
	//currency store
	public function currancy(Request $request)
	{
		$time = $request->timezone;	
		$id = Auth::user()->id;	
		$users = DB::table('users')->where('id','=',$id)->first();
		DB::update("update users set timezone='$time' where id=$id");
		
		$lang = $request->language;
		
		$id = Auth::user()->id;
		$users = DB::table('users')->where('id','=',$id)->first();
		$language = $users->language;
		DB::update("update users set language='$lang' where id=$id");
		
		if($lang == 'ar')
		{
			$id = Auth::user()->id;	
			DB::update("update users set gst_no='rtl' where id=$id");
		}
		else{	
			$id = Auth::user()->id;
			DB::update("update users set gst_no='ltr' where id=$id");
		}
		
		$date = $request->dateformat;
		if(!empty($date))
		{
			$dateformat = DB::table('tbl_settings')->first();
			$first = $dateformat->id;
			DB::update("update tbl_settings set date_format='$date' where id=$first");
		}
		
		$Currency = $request->Currency;	
		if(!empty($Currency))
		{
			$Currencyformat = DB::table('tbl_settings')->first();
			$id = $Currencyformat->id;
			DB::update("update tbl_settings set currancy='$Currency' where id=$id");
		}
		return redirect('/setting/timezone/list')->with('message','Other Settings Updated Successfully');
	}

	//Stripe key list
    public function stripeList()
	{
		$settings_data = Updatekey::first();

		return view('stripe_setting.list',compact('settings_data')); 
	}


	// Stripe Key Update
	public function stripeStore(StoreStripeSettingEditFormRequest $request)
	{
		$updateStripeKey = Updatekey::where('stripe_id', $request->stripe_id)->update([
			'secret_key' => $request->secret_key,
			'publish_key' => $request->publish_key

		]);

		if ($updateStripeKey) {
			return redirect('/setting/stripe/list')->with('message','Stripe Settings Updated Successfully');		
		} else {
			return redirect('/setting/stripe/list')->with('error','Not Updated');
		}
	}
}	
