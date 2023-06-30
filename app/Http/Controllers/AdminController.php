<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Jobs;
use App\Models\Faqs;
use App\Models\Jobpages;
use App\Models\User;
class AdminController extends Controller
{
	
	
    function index(Request $request,$cat_slug=''){
		$data=[];
		
		return view('admin.index');
	}
	function profile(Request $request){
		$error_msg='';
		$success_msg='';
		$id=1;
		if ($request->post('name')){
			
				$in=[
					'name'=>($request->post('name')==''?'':$request->post('name'))
				];
				Admin::where('id', $id)
					   ->update($in);
					$success_msg='Profile has been modified success'; 
				
			}
			
		$data['error_msg']=$error_msg;
		$data['success_msg']=$success_msg;
		$formdata = Admin::where('id', $id)->first();
		$data['formdata']=$formdata;
		return view('admin.profile',$data);
	}
	function changepassword(Request $request){
		$data=[];
		$error_msg='';
		$success_msg='';
		$userid=1;
		$userdata = Admin::where('id',$userid)->first();
		if($request->post('old_password')){
			
			$old_password = bcrypt($request->post('old_password'));
			if($userdata->password == $old_password){
				$newpassword = bcrypt($request->post('new_password'));
				Admin::where('id', $userid)
			   ->update([
				   'password' => $newpassword
				]);
				$success_msg='Password has been changed success';
			}else{
				$error_msg = 'Your old password not match ';
			}
		}
		$data['error_msg']=$error_msg;
		$data['success_msg']=$success_msg;
		return view('admin.changepassword',$data);
	}
	function jobapplications(Request $request){
		$data = [];
		$allapplication = DB::table('job_applications as job')
		->join('jobs as j1', 'j1.id', '=', 'job.job_id')->select('job.*', 'j1.title','j1.slug')
            ->get();
		$data['allapplication'] =$allapplication; 
		
		return view('admin.jobapplications',$data);
	}
	function jobs(Request $request){
		$data = [];
		$alljobs = DB::table('jobs as job')
            ->leftjoin('job_categories as j1', 'j1.id', '=', 'job.cat_id')
            ->leftjoin('job_categories as j2', 'j2.id', '=', 'job.sub_cat_id')
            ->leftjoin('users as U', 'U.id', '=', 'job.user_id')
            ->select('job.*', 'U.name as username','j1.name as category_name','j2.name as sub_category_name')
            ->get();
		$data['alljobs'] =$alljobs; 
		
		return view('admin.jobs',$data);
	}
	function addJobs(Request $request,$id=''){
		
		$parentCat = Category::where('parent_id',0)->get();
		$allusers = User::where('role',2)->get();
		$data['allusers'] = $allusers;
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
				$in=[
					'title'=>($request->post('title')==''?'':$request->post('title')),
					'user_id'=>($request->post('user_id')==''?0:$request->post('user_id')),
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
					return redirect('/admin/addjobs/'.$lastId);
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
		return view('admin.addjobs',$data);
	}
	public function jobscategory(Request $request){
		$data=[];
		$catdata = DB::table('job_categories as j1')
            ->leftjoin('job_categories as j2', 'j1.parent_id', '=', 'j2.id')
            ->select('j1.*', 'j2.name as name2')
            ->get();
		$data['allcat'] =$catdata; 
		return view('admin.jobscategory',$data);
	}
	function addjobscategory(Request $request,$id=''){
		$success_msg = '';
		$error_msg='';
		$allusers = User::where('role',2)->get();
		if ($request->post('name')){
			$slug=($request->post('slug') ==''?'':$request->post('slug'));
			$slug = makeSlug($slug);
			$user_id = ($request->post('user_id') ==''?'0':$request->post('user_id'));
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
					return redirect('/admin/jobs/addcategory/'.$lastId);
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
		$data['allusers'] = $allusers;
		return view('admin.addjobscategory',$data);
	}
	function addpage(Request $request,$id=''){
		$data=[];
		$data['id'] = $id;
		$error_msg='';
		$success_msg='';
		if ($request->post('page_title')){
			$slug = $request->post('slug');
			$slug = makeSlug($slug);
			$check_slug = Jobpages::where('id','!=',$id)->where('slug',$slug)->first();
			if($check_slug){
				$error_msg = 'This slug already exist please choose different slug';
			}else{
				$in=[
					'page_title'=>($request->post('page_title')==''?'':$request->post('page_title')),
					'slug'=>$slug,
					'short_description'=>($request->post('short_description')==''?'':$request->post('short_description')),
					'description'=>($request->post('description')==''?'':$request->post('description')),
					'browser_title'=>($request->post('browser_title')==''?'':$request->post('browser_title')),
					'meta_key'=>($request->post('meta_key')==''?'':$request->post('meta_key')),
					'meta_content'=>($request->post('meta_content')==''?'':$request->post('meta_content')),
					'status'=>($request->post('status')==''?0:$request->post('status')),
					'is_header'=>($request->post('is_header')==''?0:$request->post('is_header')),
					'is_footer'=>($request->post('is_footer')==''?0:$request->post('is_footer'))
				];
				if($_FILES['page_image']['tmp_name']!=''){
					$request->validate([
						'page_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
					]);
					$imageName = time().'.'.$request->page_image->extension(); 
					$request->page_image->move(public_path('images/uploads'), $imageName);
					$in['page_image']=$imageName;
				}
				if(empty($id)){
					$id = DB::table('job_pages')->insertGetId($in);
					$lastId=$id;
					$success_msg='Page has been added successfully ';
					return redirect('/admin/addpage/'.$lastId);
				}else{
					Jobpages::where('id', $id)
					   ->update($in);
					$success_msg='Page has been modified success';   
				}
			}
			
		}
		if(!empty($id)){
			$formdata = Jobpages::where('id', $id)
					   ->first();
			$data['formdata']=$formdata;		   
		}
		$data['success_msg']=$success_msg;
		$data['error_msg']=$error_msg;
		return view('admin.addpage',$data);
	}
	function pages(Request $request){
		$data = [];
		$allpages = DB::table('job_pages')->get();
		$data['allpages'] = $allpages; 
		
		return view('admin.pages',$data);
	}
	function changepagestatus(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			$st=0;
			if($request->post('st')){
				$st=$request->post('st');
			}
			DB::table('job_pages')->where('id', $request->post('id'))->update(array('status' => $st)); 
			
			$res=['status'=>1,'msg'=>'Page status has been changed'];
		}
		return Response::json($res, 200);
	}
	function removePage(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			DB::table('job_pages')->where('id', $request->post('id'))->delete();
			
			$res=['status'=>1,'msg'=>'Category has been removed success'];
		}
		return Response::json($res, 200);
	}
	
	function faqs(Request $request){
		$data = [];
		$allfaqs = DB::table('faqs')->get();
		$data['allfaqs'] = $allfaqs; 
		
		return view('admin.faqs',$data);
	}
	function addfaq(Request $request,$id=''){
		$data=[];
		$data['id'] = $id;
		$error_msg='';
		$success_msg='';
		if ($request->post('faq_title')){
			
			$in=[
				'faq_title'=>($request->post('faq_title')==''?'':$request->post('faq_title')),
				'faq_answer'=>($request->post('faq_answer')==''?'':$request->post('faq_answer')),
				'status'=>($request->post('status')==''?0:$request->post('status'))
			];
			
			if(empty($id)){
				$id = DB::table('faqs')->insertGetId($in);
				$lastId=$id;
				$success_msg='Faq has been added successfully ';
				return redirect('/admin/addfaq/'.$lastId);
			}else{
				Faqs::where('id', $id)
				   ->update($in);
				$success_msg='Faq has been modified success';   
			}
		
			
		}
		if(!empty($id)){
			$formdata = Faqs::where('id', $id)
					   ->first();
			$data['formdata']=$formdata;		   
		}
		$data['success_msg']=$success_msg;
		$data['error_msg']=$error_msg;
		return view('admin.addfaq',$data);
	}
	function changefaqstatus(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			$st=0;
			if($request->post('st')){
				$st=$request->post('st');
			}
			DB::table('faqs')->where('id', $request->post('id'))->update(array('status' => $st)); 
			
			$res=['status'=>1,'msg'=>'Faq status has been changed'];
		}
		return Response::json($res, 200);
	}
	function removefaq(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			DB::table('faqs')->where('id', $request->post('id'))->delete();
			
			$res=['status'=>1,'msg'=>'Faq has been removed success'];
		}
		return Response::json($res, 200);
	}
	/*manage company */
	function employers(Request $request){
		$data = [];
		$allemployers = DB::table('users')->where('role',2)->get();
		$data['allemployers'] = $allemployers; 
		
		return view('admin.employers',$data);
	}
	function addemployer(Request $request,$id=''){
		$data=[];
		$data['id'] = $id;
		$error_msg='';
		$success_msg='';
		if ($request->post('name')){
			$checkexi = User::where('id','!=',$id)->where('email',$request->post('email'))->first();
			if($checkexi){
				$error_msg = 'This email already exist ';
			}else{
				
				$in=[
					'name'=>($request->post('name')==''?'':$request->post('name')),
					'role'=>2,
					'email'=>($request->post('email')==''?'':$request->post('email')),
					'address1'=>($request->post('address1')==''?'':$request->post('address1')),
					'address2'=>($request->post('address2')==''?'':$request->post('address2')),
					'state'=>($request->post('state')==''?'':$request->post('state')),
					'city'=>($request->post('city')==''?'':$request->post('city')),
					'postal_code'=>($request->post('postal_code')==''?'':$request->post('postal_code')),
					'country'=>($request->post('country')==''?'':$request->post('country')),
					'status'=>($request->post('status')==''?0:$request->post('status'))
				];
				if($request->post('Password')){
					$in['Password'] = bcrypt($request->post('Password'));
				}
			
				if(empty($id)){
					$id = DB::table('users')->insertGetId($in);
					$lastId=$id;
					$success_msg='Company has been added successfully ';
					return redirect('/admin/addemployer/'.$lastId);
				}else{
					User::where('id', $id)
					   ->update($in);
					$success_msg='Company has been modified success';   
				}
			}
			
		}
		if(!empty($id)){
			$formdata = User::where('id', $id)
					   ->first();
			$data['formdata']=$formdata;		   
		}
		$data['success_msg']=$success_msg;
		$data['error_msg']=$error_msg;
		return view('admin.addemployer',$data);
	}
	function changeemployerstatus(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			$st=0;
			if($request->post('st')){
				$st=$request->post('st');
			}
			DB::table('users')->where('id', $request->post('id'))->update(array('status' => $st)); 
			
			$res=['status'=>1,'msg'=>'Company status has been changed'];
		}
		return Response::json($res, 200);
	}
	function removeemployer(Request $request){
		$res=['status'=>0,'msg'=>'Invalid Request'];
		if($request->post('id')){
			DB::table('users')->where('id', $request->post('id'))->delete();
			
			$res=['status'=>1,'msg'=>'Company has been removed success'];
		}
		return Response::json($res, 200);
	}
	/*manage company */
	public function Logout(Request $request)
    {
        //auth()->guard('admin')->logout();
       // Session::flush();
	   Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect('admin/login');
    }
	function login(Request $request){
		$data = [];
		$error_msg='';
		
		if (Session::has('admin_id')){
			return redirect('/admin');
		}
		if($request->post('email')){
			$userdata = Admin::where('email',$request->post('email'))->first();
			if(isset($userdata->email) && $userdata->email!=''){
				
				Session::put('admin_id', $userdata->id);
				return redirect('/admin');
			}else{
				$error_msg='Invalid Login credential ';
			}
			$formFields = $request->validate([
				'email' => ['required', 'email'],
				'password' => 'required'
			]);
		
       /* if(auth()->guard('admin')->attempt($formFields)){
        
            $user = auth()->guard('admin')->user();
            if($user->is_admin == 1){
                return redirect()->route('admin')->with('success','You are Logged in sucessfully.');
            }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
		*/
			
		}
		$data['error_msg']=$error_msg;
		return view('admin.login',$data);
	}
}
