<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \DateTime;

class FeedbackController extends Controller
{

	public function add_feedback(Request $request){
		$data = $request->json()->all();
		DB::table('feedback')->insertOrIgnore(
		    [
		    	'name' => $data['name'],
		    	'email' => $data['email'],
		    	'contact' => $data['contact'], 
		    	'subject' => $data['subject'],  
		    	'description' => $data['description'], 
		    	'created_at' => new DateTime(),
		    	'updated_at' => new DateTime()
		    	


			]
		);
		return ['status'=>true, 'error'=>'haha'];
	}


}


?>