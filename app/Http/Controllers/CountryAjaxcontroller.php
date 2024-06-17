<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CountryAjaxcontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	//get state
	public function getstate(Request $request)
	{
		//$id = Input::get('countryid');
		$id = $request->countryid;

		$states = DB::table('tbl_states')->where('country_id', '=', $id)->get()->toArray();
		if (!empty($states)) {
			
			echo '<option value="">Select State</option>';
			foreach ($states as $statess) { ?>

				<option value="<?php echo  $statess->id; ?>" class="states_of_countrys"><?php echo $statess->name; ?></option>

			<?php }
		}
	}

	//get city
	public function getcity(Request $request)
	{
		//$stateid = Input::get('stateid');
		$stateid = $request->stateid;

		$citie = DB::table('tbl_cities')->where('state_id', '=', $stateid)->get()->toArray();
		if (!empty($citie)) {
			echo '<option value="">Select City</option>';

			foreach ($citie as $cities) { ?>

				<option value="<?php echo  $cities->id; ?>" class="cities"><?php echo $cities->name; ?></option>

<?php }
		}
	}
}
