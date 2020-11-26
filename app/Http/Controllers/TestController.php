<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
	function index(){
		return view('coba');
	}

	function fetch_data(Request $request){
		if($request->ajax()){
			$data = Test::orderBy('id','asc')->get();
			echo json_encode($data);
		}
	}
  
	function add_data(Request $request){
		if($request->ajax()){
			$data = array(
				'name' => $request->name,
				'sku' => $request->sku,
				'barcode' => $request->barcode,
				'purchase_price' => $request->purchase_price,
				'selling_price' => $request->selling_price,

			);
			$id = Test::insert($data);
			if($id > 0){
				echo '<div class="alert alert-success">Data Inserted</div>';
			}
		} 
	}

	function update_data(Request $request){
		if($request->ajax()){
			$data = array(
				$request->biodata => $request->val
			);
			Test::where('id', $request->id)->update($data);
			echo '<div class="alert alert-success">Data Updated</div>';
		}
	}

	function delete_data(Request $request){
		if($request->ajax()){
			Test::where('id', $request->id)->delete();
			echo '<div class="alert alert-success">Data Deleted</div>';
		}
	}
}
