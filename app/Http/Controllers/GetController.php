<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Carparks;
// use App\Http\Controllers\SVY21_Convertor;


class GetController extends Controller
{

	public function fetch_carparks_info(){
		$result_frm_api = $this->api_get_request('https://data.gov.sg/api/action/datastore_search?resource_id=139a3035-e624-4f56-b63f-89ae28d4ae4c&limit=5000');
		if($result_frm_api['result'] == true){
			// print_r($result_frm_api['result']['records'][0]);
			print(count($result_frm_api['result']['records']));
			$results = $result_frm_api['result']['records'];
			for($i = 0; $i < count($results); $i++){
				$c = new SVY21_Convertor();
				// $c = SVY21_Convertor::all();
				$coordinate = $c->onemap_compute($results[$i]['y_coord'],$results[$i]['x_coord']);
				var_dump($coordinate);
				DB::table('carparks')->insertOrIgnore(
				    [
				    	'car_park_no' => $results[$i]['car_park_no'], 
				    	'car_park_type' => $results[$i]['car_park_type'], 
				    	'x_coord' => $results[$i]['x_coord'], 
				    	'y_coord' => $results[$i]['y_coord'],
				    	'lat' => $coordinate['lat'], 
				    	'lng' => $coordinate['lng'], 
				    	'free_parking' => $results[$i]['free_parking'], 
				    	'gantry_height' => $results[$i]['gantry_height'], 
				    	'car_park_basement' => $results[$i]['car_park_basement'], 
				    	'night_parking' => $results[$i]['night_parking'], 
				    	'address' => $results[$i]['address'], 
				    	'car_park_decks' => $results[$i]['car_park_decks'], 
				    	'_id' => $results[$i]['_id'], 
				    	'type_of_parking_system' => $results[$i]['type_of_parking_system'], 
				    	'short_term_parking' => $results[$i]['short_term_parking']


					]
				);
			}
			return response()->json(["success" => true]);

		}
		return response()->json(["success" => false]);
	}
	// fetch and update carpark lots available
	public function fetch_carpark_lot_availability(){
		$result_frm_api = $this->api_get_request('https://api.data.gov.sg/v1/transport/carpark-availability');
		$result = $result_frm_api['items'][0]['carpark_data'];
		$checker = count($result);
		for($i = 0; $i < count($result); $i++){

			DB::table('carparks')
	        ->where('car_park_no', $result[$i]['carpark_number'] )
	        ->update(['total_lots' => $result[$i]['carpark_info'][0]['total_lots'],
	        			'available_lots' => $result[$i]['carpark_info'][0]['lots_available']
     		]);



		}	
		if($checker == $i)
		{
			return response()->json(["success" => true]);
		}
		else
		{
			return response()->json(["success" => false]);
		}
	
		//Carparks::all()->fetch_from_gov_api();
	}

	public function get_carparks_info(){
		$carparks = DB::table('carparks')->get();
		// $carparks = json_decode($carparks);
		// var_dump($carparks[1]);
		return response()->json($carparks);
	}

	public function get_nearest_carparks(string $lat, string $lng, string $radius){

		$carparks = DB::select('select * from carparks where lng - '.$lng.' <'.$radius.' and lat - '.$lat.' < '.$radius);
		// print(count($carparks));
        return response()->json($carparks[0]);
		// return response() -> json(['x_coord'=>$x_coord, 'y_coord' => $y_coord]);
	}

	public function get_feedback_all(){
		$feedback = DB::table('feedback')->get();

		return response()->json($feedback);
	}
	// sorting by various attributes
	public function sorted_carparks_total_lots(Request $request){

		$data = $request->json()->all();
		// $carparks = DB::table('carparks')->get();
		$carparks = DB::select('SELECT * FROM carparks WHERE total_lots != -1 ORDER BY total_lots desc');
		return response()->json($carparks);
	}

	public function sorted_carparks_avail_lots(Request $request){

		$data = $request->json()->all();
		// $carparks = DB::table('carparks')->get();
		$carparks = DB::select('SELECT * FROM carparks WHERE available_lots != -1 ORDER BY available_lots desc');
		return response()->json($carparks);
	}
	public function sorting_carparks_gantry(Request $request){
		$data = $request->json()->all();
		// $carparks = DB::table('carparks')->get();
		$carparks = DB::select('SELECT * FROM `carparks` ORDER BY `carparks`.`gantry_height` DESC');
		return response()->json($carparks);
	}

	public function sorting_carparks_deck(Request $request){

		$data = $request->json()->all();
		// $carparks = DB::table('carparks')->get();
		$carparks = DB::select('	SELECT * FROM `carparks` ORDER BY `car_park_decks` DESC');
		return response()->json($carparks);
	}

	public function api_get_request($url){
		//init curl
		$ch = curl_init();
		
		//set curl url
		curl_setopt($ch, CURLOPT_URL, $url);
		
		//Return output instead of outputting it
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(curl_errno($ch)){
			echo 'Request Error:' . curl_error($ch);
			if(curl_error($ch) != 200){
				echo "cannot connect to server";
			}
		}
		//execute the request
		$resultjson = curl_exec($ch);
		if($resultjson === false){ 
			// return something
		}
			
		//CLose and free up the curl handle
		curl_close($ch);

		return json_decode($resultjson, true);
	}



}




?>
