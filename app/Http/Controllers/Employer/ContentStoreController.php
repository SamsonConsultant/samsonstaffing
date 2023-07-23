<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Job;

use App\Models\Project;

use Config;
use DB;
use Validator;
use Auth;

class ContentStoreController extends Controller
{
    protected $guard = 'employer';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['employer','auth']);
    }

    /**
     * Company data store and update
     * 25-oct-22
     */
    public function companyStore(Request $request){
        try {
            $arr = [
                'title' => 'required',
                'phone' => 'required|numeric|digits:10',
                'phone_code' => 'required',
                'account_type' => 'required'
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            if($request->has('company_id') && $request->filled('company_id')){
                $company = Company::findOrFail($request->company_id);
            } else {
                $company = new Company();
                $company->created_by = Auth::user()->id;            
            }

            $company->title = $request->title;
            $company->uid = $request->uid;
            $company->account_type = $request->account_type;
            $company->customer_since = $request->customer_since;
            $company->country_id = $request->country_id ?? '';
            $company->state_id = $request->state_id ?? '';
            $company->city = $request->city ?? '';
            $company->zip_code = $request->zip_code ?? '';
            $company->phone_code = $request->phone_code ?? '';
            $company->phone = $request->phone ?? '';
            $company->address = $request->address ?? '';
            $company->detail = $request->detail ?? '';
            $company->save();

            // return redirect()->route('employer.companies.index');
            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * 25-oct-22
     * company destroy
     */
    public function companyDestroy($id){
        $cm = Company::findOrFail($id);
        $cm->delete();

        return back();
    }

    ####################################################################
    #
    ######################################################################

    /**
     * Contact data store and update
     * 25-oct-22
     */
    public function contactsStore(Request $request){
        try{
            $arr = [
                'email' => 'required',
                'phone' => 'required|numeric|digits:10',
                'phone_code' => 'required',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            if($request->has('contact_id') && $request->filled('contact_id')){
                $contact = Contact::findOrFail($request->contact_id);
            } else {
                $contact = new Contact();
                $contact->created_by = Auth::user()->id;            
            }

            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phone_code = $request->phone_code;
            $contact->phone = $request->phone;
            $contact->uid = $request->uid;
            $contact->detail = $request->detail ?? '';
            $contact->account_id = $request->account_id;
            $contact->save();

            // return redirect()->route('employer.contacts.index');
            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * 25-oct-22
     * contact destroy
     */
    public function contactDestroy($id){
        $cm = Contact::findOrFail($id);
        $cm->delete();

        return back();
    }

    ####################################################################
    #
    ######################################################################

    /**
     * project data store and update
     * 25-oct-22
     */
    public function projectsStore(Request $request){
        try{
            $arr = [
                'title' => 'required',
                'account_id' => 'required',
                'contact_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            if($request->has('project_id') && $request->filled('project_id')){
                $project = Project::findOrFail($request->project_id);
            } else {
                $project = new Project();
                $project->created_by = Auth::user()->id;
            }

            $project->title = $request->title;
            $project->uid = $request->uid;
            $project->account_id = $request->account_id;
            $project->contact_id = $request->contact_id ?? '';
            $project->detail = $request->detail ?? '';
            $project->save();

            //return redirect()->route('employer.projects.index');
            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * 25-oct-22
     * project destroy
     */
    public function projectsDestroy($id){
        $cm = Project::findOrFail($id);
        $cm->delete();

        return back();
    }

    ####################################################################
    #
    ######################################################################

    /**
     * project data store and update
     * 25-oct-22
     */
    public function jobsStore(Request $request){
        try{
            $data  = $request->all();
            $rules = [
                'title' => 'required',
                'client_id' => 'required',
                'project_id' => 'required',
                'exp_year' => 'required',
                'exp_month' => 'required',
                'job_description' => 'required',
                'about_company' => 'required',
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            if($request->has('job_id') && $request->filled('job_id')){
                $job = job::findOrFail($request->job_id);
            } else {
                $job = new job();
                $job->created_by = Auth::user()->id;            
            }

            $job->title = $request->title;
            $job->job_description = $request->job_description;
            $job->client_id = $request->client_id;
            $job->project_id = $request->project_id;
            $job->about_company = $request->about_company;
            $job->company_info = $request->company_info;
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

            // return redirect()->route('employer.jobs.index');
            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * 25-oct-22
     * project destroy
     */
    public function jobsDestroy($id){
        $cm = Job::findOrFail($id);
        $cm->delete();

        return back();
    }
}
