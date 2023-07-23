<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\User;
use App\Models\Navbar;
use App\Models\Country;
use App\Models\State;
use App\Models\UserEducation;
use App\Models\UserExperince;
use App\Models\JobManageMent;
use App\Models\Job;
use Validator;
use Auth;
use Request as RequestsUrl;

class UserDashboardController extends Controller
{
    public $upload_path;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware(['user','auth']);

        $this->upload_path = \Config::get('constants.upload_path');
        $imagePath = public_path($this->upload_path);
        if(!File::exists($imagePath)) File::makeDirectory($imagePath, 0777, true, true );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $user = Auth::user();
        $user_exp = UserExperince::all();
        $user_edu = UserEducation::all();

        $all_job = JobManageMent::where('user_id', $user->id)->get();
        return view('pages.user.index', compact('template', 'segments','user','user_exp', 'user_edu', 'all_job'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProfile(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $country = Country::orderBy('name', 'asc')->get();
        $state = State::orderBy('name', 'asc')->get();
        $user_exp = UserExperince::all();
        $user_edu = UserEducation::all();
        $user = Auth::user();

        return view('pages.user.index', compact('template', 'segments','country', 'state', 'user_exp', 'user_edu', 'user'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getJobs(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $user = Auth::user();
        $all_job = JobManageMent::where('user_id', $user->id)->get();
        return view('pages.user.index', compact('template', 'segments','all_job', 'user'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPassword(Request $request){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $user = Auth::user();
        return view('pages.user.index', compact('template', 'segments', 'user'));
    }

    /**
     * store the user profile
     * cody by sanjay
     */
    public function storeProfile(Request $request){
        try{
            $arr = [
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_number' => 'required|numeric|digits_between:10,15',
                'home_phone' => 'nullable|numeric|digits_between:10,15',
                'country_id' => 'required',
                'state_id' => 'required',
                'address' => 'required',
                'city' => 'required',
                'zip_code' => 'required',
                'lang_speak' => 'required',
                'lang_written' => 'required',
                'company_name' => 'required|array|min:1',
                'position_title' => 'required|array|min:1',
                'start_date' => 'required|array|min:1',
                'exp_year' => 'required|array|min:1',
                'college_name' => 'required|array|min:1',
                'university_name' => 'required|array|min:1',
                'ed_start_date' => 'required',
            ];

            $all_data = $request->all();
            $user = User::findOrFail($request->user_id);
            if(!$user){
                return response()->json(['message' => 'User Not Found.', 'status' => 200], 200);
            }

            if(empty($user->current_cv)){
                $arr['myfile'] = 'required|max:10000|mimes:doc,docx,pdf';
            }

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->contact_number = $request->contact_number;
            $user->home_phone = $request->home_phone ?? '';
            $user->gender = $request->gender ?? '';
            $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->zip_code = $request->zip_code;
            $user->lang_speak = $request->lang_speak;
            $user->lang_written = $request->lang_written;
            $user->current_ctc = $request->current_ctc ?? '';
            $user->notice_period = $request->notice_period ?? '';

            if($request->has('user_lang')){
                $user->user_lang = implode(',', $request->user_lang);
            }
            
            if ($request->file('myfile')) {
                $imagePath = $request->file('myfile');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $request->myfile->move(public_path($this->upload_path), $imageName);
                $user->current_cv = $this->upload_path . '' . $imageName;
            }

            if ($user->save()) {
                // work experince
                if($request->has('company_name') && $request->filled('company_name')){
                    if(count($request->company_name) > 0){
                        foreach ($request->company_name as $key => $value) {
                            // code...
                            if(isset($all_data['exp_id'][$key])){
                                $n_exp = UserExperince::where('id', $all_data['exp_id'][$key])->first();
                            } else {
                                $n_exp = new UserExperince;
                            }
                            $n_exp->user_id = $request->user_id;
                            $n_exp->company_name = $all_data['company_name'][$key] ?? '';
                            $n_exp->position_title = $all_data['position_title'][$key] ?? '';
                            $n_exp->current_position = $all_data['current_position'][$key] ?? '';
                            $n_exp->start_date = $all_data['start_date'][$key] ?? '';
                            $n_exp->end_date = $all_data['end_date'][$key] ?? '';
                            $n_exp->exp_year = $all_data['exp_year'][$key] ?? '';
                            $n_exp->exp_month = $all_data['exp_month'][$key] ?? '';
                            $n_exp->save();
                        }
                    }
                }

                // education 
                if($request->has('college_name') && $request->filled('college_name')){
                    if(count($request->college_name) > 0){
                        foreach ($request->college_name as $key => $value) {
                            // code...
                            if(isset($all_data['edu_id'][$key])){
                                $n_ed = UserEducation::where('id', $all_data['edu_id'][$key])->first();
                            } else {
                                $n_ed = new UserEducation;
                            }                            
                            $n_ed->user_id = $request->user_id;
                            $n_ed->college_name = $all_data['college_name'][$key] ?? '';
                            $n_ed->degree_name = $all_data['degree_name'][$key] ?? '';
                            $n_ed->university_name = $all_data['university_name'][$key] ?? '';
                            $n_ed->start_date = $all_data['ed_start_date'][$key] ?? '';
                            $n_ed->end_date = $all_data['ed_end_date'][$key] ?? '';                            
                            $n_ed->save();
                        }
                    }
                }

                return response()->json(['message' => 'You have updated information successfully.', 'status' => 201], 201);
            }

            return response()->json(['message' => 'User save data problem.', 'status' => 200], 200);
        } catch(\Exception $e){
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * store the apply job
     * cody by sanjay
     */
    public function applyJob(Request $request){
        try{
            $arr = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',                
                'myfile' => 'required|max:10000|mimes:doc,docx,pdf',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            // dd($request->all());
            $all_data = $request->all();
            $job = Job::findOrFail($request->job_id);
            if(!$job){
                return response()->json(['message' => 'Job Not Found.', 'status' => 200], 200);
            }

            $user = Auth::user();
            $jobmg = new JobManageMent;
            $jobmg->user_id = $user->id;
            $jobmg->job_id = $job->id;
            $jobmg->created_by = $job->created_by;
            $jobmg->state_id = $job->location_id;

            if ($request->file('myfile')) {
                $imagePath = $request->file('myfile');
                $imageName = time() .'-' .$imagePath->getClientOriginalName();
                $request->myfile->move(public_path($this->upload_path), $imageName);
                $jobmg->cv_path = $this->upload_path . '' . $imageName;
                $jobmg->cv_status = '1';
            }

            if ($jobmg->save()) {                
                return response()->json(['message' => 'You have apply successfully.', 'status' => 201], 201);
            }

            return response()->json(['message' => 'Job apply save data problem.', 'status' => 200], 200);
        } catch(\Exception $e){
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * fetch the state list based on the country id
     */
    public function getStateByCountryId(Request $request){
        $country_id = $request->country_id;
        $state_list = State::where(['country_id' => $country_id])->orderBy('name', 'asc')->get();
        $html       = view('pages.user.state-by-country', compact('state_list'))->render();
        return response()->json(['html' => $html]);
    }

    public function destroyExperience($id){
        $dlt = UserExperince::where('id', $id)->first();
        $dlt->delete();

        return redirect()->back()->with('success', 'Action completed.');
    }

    public function destroyEducation($id){
        $dlt = UserEducation::where('id', $id)->first();
        $dlt->delete();

        return redirect()->back()->with('success', 'Action completed.');
    }
}
