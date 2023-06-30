<?php 
use Illuminate\Support\Facades\Auth;

if(!function_exists('imagePath')){
	function imagePath($imgname,$type=''){
			return url('public/images/uploads/'.$imgname);
	}
}
if(!function_exists('makeSlug')){
	function makeSlug($slug){
		$slug = str_replace(' ','-',$slug);
		$slug = str_replace('?','',$slug);
		$slug = str_replace('%','',$slug);
		$slug = str_replace('&','',$slug);
		$slug = str_replace('*','',$slug);
		$slug = str_replace('(','',$slug);
		$slug = str_replace(')','',$slug);
		return $slug;
	}
}
function pCurrency(){
	return '$';
}
function getJobType($jobtype){
	$jtype='';
	switch($jobtype){
		case 'part-time':
			$jtype='Part Time';
		break;
		case 'full-time':
			$jtype='Full Time';
		break;
	}
	return $jtype;
}
function printPrice($package_anum){
	return '$'.$package_anum;
}
function getCurrentRoot(){
	$cururl = url()->current();
	$arr = explode('/',$cururl);
	$cr = end($arr);
	return $cr;
}
?>