<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Jobs;
use Illuminate\Support\Facades\DB;
use Response;
use Session;

class JoblistController extends Controller
{
    function index(Request $request,$cat_slug=''){
		$data=[];
		$is_category = 0;
		$alljobsq = DB::table('jobs as job')
            ->leftjoin('job_categories as j1', 'j1.id', '=', 'job.cat_id')
            ->leftjoin('job_categories as j2', 'j2.id', '=', 'job.sub_cat_id')
            ->select('job.*', 'j1.name as category_name','j2.name as sub_category_name');
		if(!empty($cat_slug)){
			$alljobsq->where('j1.slug',$cat_slug);
			$is_category=1;
			$catdata = Category::where('slug',$cat_slug)->first();
			$data['catdata']=$catdata;
			$allcat = DB::table('job_categories as job')->select('job.*')->where('job.parent_id',$catdata->id)->get();
		}else{
			$allcat = DB::table('job_categories as job')->select('job.*')->where('job.parent_id',0)->get();
		}
		if($request->get('cat')!=''){
			$arr = explode(',',$request->get('cat'));
			$alljobsq->whereIn('j1.id',$arr);
		}
		$alljobs = $alljobsq->get();
		$data['alljobs'] =$alljobs; 
		$data['is_category'] =$is_category; 
		
		$data['allcat']=$allcat;
		return view('joblist.index',$data);
	}
	function category(Request $request,$slug=''){
		$data=[];
		$is_sub=0;
		$allcatq = DB::table('job_categories as job')->select('job.*')->where('job.status',1);
		if(!empty($slug)){
			$subcat = Jobs::where('slug',$slug)->first();
			if(!$subcat){
				return redirect('joblist/'.$slug);
				exit;
			}
			$allcatq->where('job.parent_id',$subcat->id);
			$allcat = $allcatq->get();
			if(!$allcat){
				return redirect('joblist/'.$slug);
				exit;
			}
			$is_sub=1;
		}else{
			$allcatq->where('job.parent_id',0);
			$allcat = $allcatq->get();
		}
		
		$data['allcat'] = $allcat;	
		$data['is_sub'] = $is_sub;	
		$data['slug'] = $slug;	
		$data['subcat'] = @$subcat;	
		
		return view('joblist.category',$data);
	}
	function detail(Request $request,$slug){
		$data=[];
		$jobdata = Jobs::where('slug',$slug)->first();
		$data['jobdata']=$jobdata;
		$catdata = Category::where('id',$jobdata->cat_id)->first();
		$sub_catdata = Category::where('id',$jobdata->sub_cat_id)->first();
		$data['catdata']=$catdata;
		$data['sub_catdata']=$sub_catdata;
		return view('joblist.detail',$data);
	}
	function applyjobs(Request $request){
		if ($request->post('name')){
			$user_id = 0;
			$in=[
				'job_id'=>($request->post('job_id')==''?'':$request->post('job_id')),
				'user_id'=>$user_id,
				'name'=>($request->post('name')==''?'':$request->post('name')),
				'email'=>($request->post('email')==''?'':$request->post('email')),
				'phone_number'=>($request->post('phone_number')==''?'':$request->post('phone_number')),
				'address'=>($request->post('address')==''?'':$request->post('address')),
				'apply_date'=>date('Y-m-d H:i:s'),
				'company_id'=>0
				];
				
			if($_FILES['resume']['tmp_name']!=''){
				$ext = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
				$resumeName = time().'.'.$ext; 
				move_uploaded_file($_FILES['resume']['tmp_name'], public_path('resumes').'/'.$resumeName);
				
				$in['resume']=$resumeName;
			}
			$id = DB::table('job_applications')->insertGetId($in);
			$job_slug = $request->post('job_slug');
			if($id){
				   Session::flash('success_msg', "Your application has been submited success");
					return redirect('/joblist/detail/'.$job_slug);
			}else{
				 Session::flash('error_msg', "Please try again");
				return redirect('/joblist/detail/'.$job_slug);
			}
		}
		
	}
}
