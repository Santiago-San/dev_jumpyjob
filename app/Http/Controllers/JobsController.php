<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Jobs;
use Illuminate\Support\Facades\DB;
use Response;
class JobsController extends Controller
{
    function index(){
		$data=[];
		$alljobs = DB::table('jobs as job')
            ->leftjoin('job_categories as j1', 'j1.id', '=', 'job.cat_id')
            ->leftjoin('job_categories as j2', 'j2.id', '=', 'job.sub_cat_id')
            ->select('job.*', 'j1.name as category_name','j2.name as sub_category_name')
            ->get();
		$data['alljobs'] =$alljobs; 
		
		return view('jobs.index',$data);
	}
	function getSubCategory(){
		$html = '<option value="">Select Job Sub Category</option>';
		$res=['status'=>0,'msg'=>'Invalid Request','html'=>$html];
		if($request->post('id')){
			$allsubcat = Category::where('parent_id', $request->post('id'))->get();
			if($allsubcat){
				foreach($allsubcat as $ck=>$cv){
					$html .='<option value="'.$cv->id.'">'.$cv->name.'</option>';
				}
			}
		}
		$res=['status'=>1,'msg'=>'Success','html'=>$html];
		return Response::json($res, 200);
	}
	function add(Request $request,$id=''){
		$parentCat = Category::where('parent_id',0)->get();
		$data['parentCat'] = $parentCat;
		$data['id'] = $id;
		$error_msg='';
		$success_msg='';
		if ($request->post('title')){
			$slug = $request->post('slug');
			$slug = makeSlug($slug);
			$check_slug = Jobs::where('id','!=',$id)->where('slug',$slug)->first();
			if($check_slug){
				$error_msg = 'This slug already exist please choose different slug';
			}else{
				$userid = auth()->user()->id;
				$in=[
					'title'=>($request->post('title')==''?'':$request->post('title')),
					'user_id'=>$userid,
					'slug'=>$slug,
					'cat_id'=>($request->post('cat_id')==''?0:$request->post('cat_id')),
					'sub_cat_id'=>($request->post('sub_cat_id')==''?0:$request->post('sub_cat_id')),
					'short_description'=>($request->post('short_description')==''?'':$request->post('short_description')),
					'description'=>($request->post('description')==''?'':$request->post('description')),
					'package_anum'=>($request->post('package_anum')==''?0:$request->post('package_anum')),
					'job_type'=>($request->post('job_type')==''?'':$request->post('job_type')),
					'job_long'=>($request->post('job_long')==''?'':$request->post('job_long')),
					'job_address'=>($request->post('job_address')==''?'':$request->post('job_address')),
					'city'=>($request->post('city')==''?'':$request->post('city')),
					'state'=>($request->post('state')==''?'':$request->post('state')),
					'postal_code'=>($request->post('postal_code')==''?'':$request->post('postal_code')),
					'job_skills'=>($request->post('job_skills')==''?'':$request->post('job_skills')),
					'gender'=>($request->post('gender')==''?'':$request->post('gender')),
					'vacancy'=>($request->post('vacancy')==''?0:$request->post('vacancy')),
					'job_lat'=>($request->post('job_lat')==''?'':$request->post('job_lat')),
					'status'=>($request->post('status')==''?0:$request->post('status'))
				];
				if($_FILES['image']['tmp_name']!=''){
					$request->validate([
						'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
					]);
					$imageName = time().'.'.$request->image->extension(); 
					$request->image->move(public_path('images/uploads'), $imageName);
					$in['image']=$imageName;
				}
				if(empty($id)){
					$id = DB::table('jobs')->insertGetId($in);
					//$category = Category::insert($upload);
					$lastId=$id;
					$success_msg='Jobs has been added successfully ';
					return redirect('/jobs/add/'.$lastId);
				}else{
					Jobs::where('id', $id)
					   ->update($in);
					$success_msg='Jobs has been modified success';   
				}
			}
			
		}
		if(!empty($id)){
			$formdata = Jobs::where('id', $id)
					   ->first();
			$data['formdata']=$formdata;		   
		}
		$data['success_msg']=$success_msg;
		$data['error_msg']=$error_msg;
		return view('jobs.add',$data);
	}
	function categories(){
		$data=[];
		$catdata = DB::table('job_categories as j1')
            ->leftjoin('job_categories as j2', 'j1.parent_id', '=', 'j2.id')
            ->select('j1.*', 'j2.name as name2')
            ->get();
		$data['allcat'] =$catdata; 
		return view('jobs.categories',$data);
	}
	function removeJobs(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			
			Jobs::where('id', $request->post('id'))
					   ->delete();
			$res=['status'=>1,'msg'=>'Jobs has been removed success'];
		}
		return Response::json($res, 200);
	}
	function removeJobCat(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			
			Category::where('id', $request->post('id'))
					   ->delete();
			$res=['status'=>1,'msg'=>'Category has been removed success'];
		}
		return Response::json($res, 200);
	}
	function changeJobSt(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			$st=0;
			if($request->post('st')){
				$st=$request->post('st');
			}
			Jobs::where('id', $request->post('id'))
					   ->update(['status'=>$st]);
			$res=['status'=>1,'msg'=>'Jobs status has been changed'];
		}
		return Response::json($res, 200);
	}
	function changeCatSt(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			$st=0;
			if($request->post('st')){
				$st=$request->post('st');
			}
			Category::where('id', $request->post('id'))
					   ->update(['status'=>$st]);
			$res=['status'=>1,'msg'=>'Category status has been changed'];
		}
		return Response::json($res, 200);
	}
	function addcategory(Request $request,$id=''){
		 
		$success_msg = '';
		$error_msg='';
		if ($request->post('name')){
			$slug=($request->post('slug') ==''?'':$request->post('slug'));
			$slug = makeSlug($slug);
			$user_id = auth()->user()->id;
			$checkslug = Category::where('id','!=',$id)->where('slug',$slug)->first();
			if($checkslug){
				$error_msg = 'This slug already exist please choose different slug';
			}else{
				$upload = [
					'name' => ($request->post('name') ==''?'':$request->post('name')),
					'slug' => $slug,
					'user_id'=>$user_id,
					'parent_id' => ($request->post('parent_id') ==''?0:$request->post('parent_id')),
					'status' => ($request->post('status') ==''?0:$request->post('status'))
				];
				if($_FILES['cat_icon']['tmp_name']!=''){
					$request->validate([
						'cat_icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
					]);
					$imageName = time().'.'.$request->cat_icon->extension(); 
					$request->cat_icon->move(public_path('images/uploads'), $imageName);
					$upload['cat_icon']=$imageName;
				}
				if(empty($id)){
					$id = DB::table('job_categories')->insertGetId($upload);
					//$category = Category::insert($upload);
					$lastId=$id;
					$success_msg='Category has been added successfully ';
					return redirect('/jobs/addcategory/'.$lastId);
				}else{
					Category::where('id', $id)
					   ->update($upload);
					$success_msg='Category has been modified success';   
				}
				
			}
			
			
		}
		$data=[];
		$data['success_msg'] = $success_msg;
		$data['error_msg'] = $error_msg;
		$catdata=[];
		if(!empty($id)){
			$catdata = Category::where('id',$id)->first();
		}
		$allcat = Category::where('parent_id',0)->get();
		$data['formdata'] = $catdata;
		$data['allcat'] = $allcat;
		return view('jobs.addcategory',$data);
	}
	function appliedCandidate(){
		$data=[];
		$userid = auth()->user()->id;
		$allapplication = DB::table('job_applications as job')
		->join('jobs as j1', 'j1.id', '=', 'job.job_id')->select('job.*', 'j1.title','j1.slug')->where('j1.user_id',$userid)
            ->get();
		$data['allapplication'] =$allapplication;  
		
		return view('jobs.appliedCandidate',$data);
	}
}
