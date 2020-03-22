<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Carparks extends Model
{
	public fetch_from_gov_api(){

		return true;

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