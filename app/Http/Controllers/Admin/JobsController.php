<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJobRequest;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Validator;

class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $guard = 'admin';

    /**
     * 
     */
    public function __construct() {
        $this->middleware('auth:admin')->except(['massDestroy']);
    }

    public function index(){
        $jobs = Job::all();
        $template = 'job-list';
        return view('pages.admin.index', compact('template', 'jobs'));
    }

    public function create(){
        $companies = Company::where('status', 1)->get();
        $projects = Project::where('status', 1)->get();

        $skills = get_post_data('key_skills');
        $role_category = get_post_data('role_category');
        $employement_type = get_post_data('employement_type');
        $area = get_post_data('area');
        $industry_type = get_post_data('industry_type');
        $education = get_post_data('education');
        $candidate_profile = get_post_data('candidate_profile');
        $roles = get_post_data('roles');
        $experience = get_post_data('experience');
        $location = Location::all();

        $template = 'job-create';
        return view('pages.admin.index', compact('template', 'companies', 'projects','experience','roles','candidate_profile','education','industry_type','area','employement_type','role_category','skills', 'location'));
    }

    public function store(Request $request){
        try {
            $data  = $request->all();
            $rules = [
                'title' => 'required',
                'client_id' => 'required',
                'project_id' => 'required',
                'exp_year' => 'required',
                'exp_month' => 'required',
                // 'job_description' => 'required',
                'about_company' => 'required',
                'role_responsibilty' => 'required',
                'candidate_profile' => 'required',
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $job = new job();
            $job->title = $request->title;
            $job->job_description = $request->job_description ?? '';
            $job->client_id = $request->client_id;
            $job->project_id = $request->project_id;
            $job->about_company = $request->about_company;
            $job->company_info = $request->company_info ?? '';
            $job->role_responsibilty = $request->role_responsibilty;
            $job->created_by = Auth::user()->id;

            $job->exp_year = $request->exp_year;
            $job->exp_month = $request->exp_month;
            $job->candidate_profile = $request->candidate_profile;
            $job->education = implode(',', $request->education);
            $job->industry_type = implode(',', $request->industry_type);
            $job->functional_area = implode(',',$request->functional_area);
            $job->employement_type = implode(',', $request->employement_type);
            $job->key_skills = implode(',', $request->key_skills);
            $job->save();

            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    public function edit(Job $job){
        $companies = Company::where('status', 1)->get();
        $projects = Project::where('status', 1)->get();

        $skills = get_post_data('key_skills');
        $role_category = get_post_data('role_category');
        $employement_type = get_post_data('employement_type');
        $area = get_post_data('area');
        $industry_type = get_post_data('industry_type');
        $education = get_post_data('education');
        $candidate_profile = get_post_data('candidate_profile');
        $roles = get_post_data('roles');
        $experience = get_post_data('experience');
        $location = Location::all();

        // $job->load('company', 'categories');
        $template = 'job-edit';
        return view('pages.admin.index', compact('template', 'companies', 'projects', 'job', 'experience','roles','candidate_profile','education','industry_type','area','employement_type','role_category','skills','location'));
    }

    public function update(Request $request, Job $job){
        try {
            $data  = $request->all();
            $rules = [
                'title' => 'required',
                'client_id' => 'required',
                'project_id' => 'required',
                'exp_year' => 'required',
                'exp_month' => 'required',
                // 'job_description' => 'required',
                'about_company' => 'required',
                'role_responsibilty' => 'required',
                'candidate_profile' => 'required',
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $job->title = $request->title;
            $job->job_description = $request->job_description ?? '';
            $job->client_id = $request->client_id;
            $job->project_id = $request->project_id;
            $job->about_company = $request->about_company;
            $job->company_info = $request->company_info ?? '';
            $job->role_responsibilty = $request->role_responsibilty;        

            $job->exp_year = $request->exp_year;
            $job->exp_month = $request->exp_month;
            $job->candidate_profile = $request->candidate_profile;
            $job->education = implode(',', $request->education);
            $job->industry_type = implode(',', $request->industry_type);
            $job->functional_area = implode(',',$request->functional_area);
            $job->employement_type = implode(',', $request->employement_type);
            $job->key_skills = implode(',', $request->key_skills);

            $job->save();

            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    public function show(Job $job){
        $job->load('company', 'categories');

        $template = 'job-show';
        return view('pages.admin.index', compact('template','job'));
    }

    public function destroy(Job $job){
        $job->delete();
        return back();
    }

    public function massDestroy(MassDestroyJobRequest $request){
        Job::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
