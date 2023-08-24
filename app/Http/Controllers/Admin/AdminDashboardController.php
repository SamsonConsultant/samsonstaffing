<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

use App\Mail\MainTemplate;
use App\Models\Post;
use App\Models\PostExtra;
use App\Models\Menu;
use App\Models\Navbar;
use App\Models\Project;
use App\Models\Country;
use App\Models\State;
use App\Models\ContactForm;
use App\Models\JobManageMent;
use App\Models\Job;
use App\Models\Contact;
use App\Models\Company;

use Request as RequestsUrl;
use App\User;
use Config;
use Validator;
use Auth;
use DB;

class AdminDashboardController extends Controller
{
    public $upload_path;
    public $per_page = 25;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $guard = 'admin';

    public function __construct() {
        $this->middleware('auth:admin')->except(['getStateByCountryId', 'getProject', 'getContact']);

        $this->upload_path = \Config::get('constants.upload_path');
        $imagePath = public_path($this->upload_path);
        if(!File::exists($imagePath)) File::makeDirectory($imagePath, 0777, true, true );
    }

    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        return view('pages.admin.index', compact('template', 'segments'));
    }

    /**
     * 26-Aug-2022
     */
    public function getUserInactive($id){
        $user = User::where('id', $id)->first();
        $user->status = 2;
        $user->save();

        return redirect()->back()->with('success', 'User DeActivated successfully.');
    }

    /**
     * 26-Aug-2022
     */
    public function getUserActive($id){
        $user = User::where('id', $id)->first();
        $user->status = 1;
        $user->save();

        return redirect()->back()->with('success', 'User Activated successfully.');
    }

    /**
     * Show the application admin dashboard.
     * 04-Apr-2022
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settingsContent(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $pages = get_post_data('page', $request);
        
        return view('pages.admin.index', compact('template', 'segments', 'pages'));
    }

    /**
     * Store Setting
     * 04-Apr-22
     */
    public function storeSettings(Request $request){
        try {
            $arr = [
                'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }
            
            $input = $request->all();

            # site logo upload...
            if ($request->file('site_logo') && $request->hasFile('site_logo')) {
                $imagePath = $request->file('site_logo');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $request->site_logo->move(public_path($this->upload_path), $imageName);
                $img_url = $this->upload_path . '' . $imageName;
                $input['logo_path'] = $img_url;
            }

            # top banner upload...
            if ($request->file('top_banner') && $request->hasFile('top_banner')) {
                $imagePath = $request->file('top_banner');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $request->top_banner->move(public_path($this->upload_path), $imageName);
                $img_url = $this->upload_path . '' . $imageName;
                $input['top_banner'] = $img_url;
            }

            if ($request->file('s_banner') && $request->hasFile('s_banner')) {
                $imagePath = $request->file('s_banner');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $request->s_banner->move(public_path($this->upload_path), $imageName);
                $img_url = $this->upload_path . '' . $imageName;
                $input['s_banner'] = $img_url;
            }

            if ($request->file('f_b_banner') && $request->hasFile('f_b_banner')) {
                $imagePath = $request->file('f_b_banner');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $request->f_b_banner->move(public_path($this->upload_path), $imageName);
                $img_url = $this->upload_path . '' . $imageName;
                $input['f_b_banner'] = $img_url;
            }

            if ($request->file('b_b_banner') && $request->hasFile('b_b_banner')) {
                $imagePath = $request->file('b_b_banner');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $request->b_b_banner->move(public_path($this->upload_path), $imageName);
                $img_url = $this->upload_path . '' . $imageName;
                $input['b_b_banner'] = $img_url;
            }

            foreach ($input as $key => $value) {
                $op = set_option_key_value($key,$value);
            }
            return response()->json(['message' => 'setting saved successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }


    /**
     * Delete post.
     * 10-Mar-22
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($id){
        $res = Post::find($id)->delete();
        $ex_res = PostExtra::where('post_id', $id)->delete();
      
        return redirect()->back()->with('success', 'Action successfully.');
    }


    /**
     * Show the application admin menu.
     * 04-Apr-2022
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setMenuContent(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        $menus = Menu::all();
        $navbar = Navbar::all();
        $pages = get_post_data('page', $request);

        $menu = '';
        if(!empty($id)){
            $menu = Menu::where('id', $id)->first();
        }

        return view('pages.admin.index', compact('template', 'segments', 'menus', 'pages', 'menu', 'navbar'));
    }


    /**
     * Store Menu
     * 04-Apr-22
     */
    public function storeMenu(Request $request){
        try {
            $arr = [
                'menu_name' => 'required',
                'page_id' => 'required|array|exists:posts,id',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }
            
            $input = $request->all();
            $dlt = Navbar::where('menu_id', $request->menu_name)->delete();
            $menu = Menu::where('id', $request->menu_name)->first();
            
            if(count($input['page_id']) > 0){
                foreach ($input['page_id'] as $key => $value) {
                    $nav = new Navbar();
                    $nav->menu_id = $request->menu_name;
                    $nav->route_id = $value;
                    $nav->route = route('frontend.show.page', base64_encode($value));
                    $nav->save();
                }
            }

            return response()->json(['message' => 'Menu saved successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * Store Sub Menu
     * 21-sep-22
     */
    public function storeSubMenu(Request $request){
        try {
            $arr = [
                'sub_menu_name' => 'required',
                'page_id' => 'required|array|exists:posts,id',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }
            
            $input = $request->all();
            $dlt = Navbar::where('parent_id', $request->sub_menu_name)->delete();
            $nav = Navbar::where('route_id', $request->sub_menu_name)->first();

            if (!isset($nav->post->post_title)) {
                return response()->json(['message' => 'That page is no longer in the DB.', 'status' => 200], 200);
            }

            $menu = Menu::where('id', $request->sub_menu_name)->first();
            if (empty($menu)) {
                $menu = new Menu;
                $menu->menu_title = $nav->post->post_title;
                $menu->slug = strtolower(str_replace(' ', '-', $nav->post->post_title));
                $menu->save();
            }
            
            if(count($input['page_id']) > 0){
                foreach ($input['page_id'] as $key => $value) {
                    $nav = new Navbar();
                    $nav->menu_id = $menu->id;
                    $nav->route_id = $value;
                    $nav->route = route('frontend.show.page', base64_encode($value));
                    $nav->parent_id = $request->sub_menu_name;
                    $nav->save();
                }
            }

            return response()->json(['message' => 'Sub Menu saved successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * Delete the menu.
     * 21-sep-22
     */
    public function deleteMenuContent($id){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        $menus = Menu::where('id', $id)->delete();
        $navbar = Navbar::where('menu_id', $id)->delete();

        return redirect()->back()->with('success', 'Action completed.');
    }


    /**
    *
    * fetch carrier product and services of the carrier
    **/
    public function getProject(Request $request){
        $carrier_id = $request->carrier_id;
        $cp = Project::where(['account_id' => $carrier_id])->get();

        $cp_htm = view('pages.admin.project', compact('cp'))->render();

        return response()->json(['cp' => $cp_htm]);
    }

    /**
     * 
     * fetch the state list based on the country id
     */
    public function getStateByCountryId(Request $request){
        $country_id = $request->country_id;
        $state_list = State::where(['country_id' => $country_id])->orderBy('name', 'asc')->get();
        $html       = view('pages.admin.state-by-country', compact('state_list'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * 29-oct-2022
     * get all the contact form data
     */
    public function manageContactForm(){
        $contacts = ContactForm::all();

        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
                
        return view('pages.admin.index', compact('template', 'segments', 'contacts'));   
    }

    /**
     * 08-nov-2022
     * get all the job data
     */
    public function jobManageMentContent(){
        $jobs = JobManageMent::all();

        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $country = Country::orderBy('name', 'asc')->get();
        $state = State::orderBy('name', 'asc')->get();
        $all_job = Job::orderBy('title', 'asc')->get();
                
        return view('pages.admin.job-management', compact('template', 'segments', 'jobs','country', 'state', 'all_job'));   
    }

    /**
     * 08-nov-2022
     * get all the project form data
     */
    public function getProjectView($job_id, $project_id){
        $project = Project::where('id', $project_id)->first();
        $job = Job::where('id', $job_id)->first();

        $related_jobs = JobManageMent::where('job_id', $job_id)->get();

        $country = Country::orderBy('name', 'asc')->get();
        $state = State::orderBy('name', 'asc')->get();

        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
                
        return view('pages.admin.project-management', compact('template', 'segments', 'project', 'job', 'related_jobs', 'country', 'state'));   
    }

    /**
    * get the contact based on the company id
    **/
    public function getContact(Request $request){
        $carrier_id = $request->account_id;
        $cp = Contact::where(['account_id' => $carrier_id])->get();

        $cp_htm = view('pages.admin.contact', compact('cp'))->render();

        return response()->json(['cp' => $cp_htm]);
    }


    /**
     * 17-dec-2022
     * get all the job stage one
     */
    public function getJobStageContent(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $country = Country::orderBy('name', 'asc')->get();
        $state = State::orderBy('name', 'asc')->get();
        $all_job = Job::orderBy('title', 'asc')->get();
        $account = Company::orderBy('title', 'asc')->get();
        $contact = Contact::orderBy('first_name', 'asc')->get();
        $project = Project::orderBy('title', 'asc')->get();

        $status = getStageStatusType($template);

        $get_order = (new JobManageMent)->newQuery();
        if ($status == 7) {
            $get_order->leftJoin('users AS pe', 'job_manage_ments.user_id', '=', 'pe.id')->whereIn('job_manage_ments.status', [1,2,3,4,5]);
        }else{
            $get_order->leftJoin('users AS pe', 'job_manage_ments.user_id', '=', 'pe.id')->where('job_manage_ments.status', $status);
        }
        $get_order->select('job_manage_ments.*', 'pe.id as u_id');
        if($request->all()){
            if ($request->has('s') && $request->filled('s')) {
                $get_order->where('pe.name' , 'like' , '%'.$request->s.'%');
                $get_order->orWhere('pe.email' , 'like' , '%'.$request->s.'%');
            }

            if ($request->has('a') && $request->filled('a')) {
                $ac = Company::where('id', $request->a)->pluck('id');
                $jb = Job::whereIn('client_id', $ac)->pluck('id');
                $get_order->whereIn('job_manage_ments.job_id' , $jb);
            }

            if ($request->has('c') && $request->filled('c')) {
                $cc = Contact::where('id', $request->c)->pluck('id');
                $pr = Project::whereIn('contact_id', $cc)->pluck('id');
                $jb = Job::whereIn('project_id', $pr)->pluck('id');
                $get_order->whereIn('job_manage_ments.job_id' , $jb);
            }

            if ($request->has('p') && $request->filled('p')) {
                $pr = Project::where('id', $request->p)->pluck('id');
                $jb = Job::whereIn('project_id', $pr)->pluck('id');
                $get_order->whereIn('job_manage_ments.job_id' , $jb);
            }
        }

        //$jobs = $get_order->where('job_manage_ments.status', $status)->orderBy('job_manage_ments.id', 'DESC')->paginate($this->per_page);
        $jobs = $get_order->orderBy('job_manage_ments.id', 'DESC')->paginate($this->per_page);

        return view('pages.admin.job-stage', compact('template', 'segments', 'jobs','country', 'state', 'all_job', 'account', 'contact', 'project'));   
    }

    /**
     * 17-dec-2022
     * get all the job stage one
     */
    public function getSearchCv(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();
        
        $jobs = [];
        if($request->all()){
            if ($request->has('s') && $request->filled('s')) {
                $get_order = (new JobManageMent)->newQuery();
                $get_order->join('users AS pe', 'job_manage_ments.user_id', '=', 'pe.id');
                $get_order->select('job_manage_ments.*', 'pe.id as u_id');
                $get_order->where('pe.name' , 'like' , '%'.$request->s.'%');
                $get_order->orWhere('pe.email' , 'like' , '%'.$request->s.'%');
                $jobs = $get_order->orderBy('job_manage_ments.id', 'DESC')->get();
            }
        }

        return view('pages.admin.cv.search', compact('template', 'segments', 'jobs'));   
    }
}
