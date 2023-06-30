<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
class AccountController extends Controller
{
    function index(){
		return 'sunil kumar ';
	}
	function account(){
		return view('account.index');
	}
	function profile(Request $request){
		$userid = auth()->user()->id;
		$active_tab='profile';
		$success_msg = '';
		$error_msg='';
		if ($request->post('name')){
			User::where('id', $userid)
		   ->update([
			   'name' => ($request->post('name') ==''?'':$request->post('name')),
			   'city' => ($request->post('city') ==''?'':$request->post('city')),
			   'state' => ($request->post('state') ==''?'':$request->post('state')),
			   'postal_code' => ($request->post('postal_code') ==''?'':$request->post('postal_code')),
			   'address1' => ($request->post('address1') ==''?'':$request->post('address1')),
			   'address2' => ($request->post('address2') ==''?'':$request->post('address2')),
			   'country' => ($request->post('country') ==''?'':$request->post('country'))
			]);
			$success_msg='Profile has been updated successfully ';
			
		}
		$userdata = User::where('id',$userid)->first();
		if($request->post('old_password')){
			$active_tab='password';
			$old_password = bcrypt($request->post('old_password'));
			if($userdata->password == $old_password){
				$newpassword = bcrypt($request->post('new_password'));
				User::where('id', $userid)
			   ->update([
				   'password' => $newpassword
				]);
				$success_msg='Password has been changed success';
			}else{
				$error_msg = 'Your old password not match ';
			}
		}
		//echo '<pre>'; print_r($userdata); echo '</pre>';
		$data=['userdata'=>$userdata];
		$data['is_link']='profile';
		$data['success_msg']=$success_msg;
		$data['error_msg']=$error_msg;
		$data['active_tab']=$active_tab;
		return view('account.profile',$data);
	}
}
