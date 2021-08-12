<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \DateTime;

class FilterSortingController extends Controller
{

	public function sorting_carparks_avail_lots(Request $request){

		$data = $request->json()->all();
		// $carparks = DB::table('carparks')->get();
		$carparks = DB::select('SELECT * FROM carparks WHERE available_lots != -1 ORDER BY available_lots desc');
		return response()->json($carparks);
	}

}


?>