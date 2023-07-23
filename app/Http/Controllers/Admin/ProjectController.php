<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Contact;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Validator;

class ProjectController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $projects = Project::all();

        $template = 'project-list';
        return view('pages.admin.index', compact('template', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $companies = Company::where('status', 1)->get();
        $contacts = Contact::where('status', 1)->get();

        $template = 'project-create';
        return view('pages.admin.index', compact('template', 'companies', 'contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            $arr = [
                'title' => 'required',
                'account_id' => 'required',
                'contact_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $project = new Project();
            $project->title = $request->title;
            $project->uid = $request->uid;
            $project->account_id = $request->account_id;
            $project->contact_id = $request->contact_id ?? '';
            $project->detail = $request->detail ?? '';
            $project->created_by = Auth::user()->id;
            $project->save();

            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $projects = Project::findOrFail($id);
        $template = 'project-show';
        return view('pages.admin.index', compact('template', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $projects = Project::findOrFail($id);
        $companies = Company::where('status', 1)->get();
        $contacts = Contact::where('status', 1)->get();

        $template = 'project-edit';
        return view('pages.admin.index', compact('template', 'projects', 'companies', 'contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project){
        try {
            $arr = [
                'title' => 'required',
                'account_id' => 'required',
                'contact_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            $project->title = $request->title;
            $project->uid = $request->uid;
            $project->account_id = $request->account_id;
            $project->contact_id = $request->contact_id ?? '';
            $project->detail = $request->detail ?? '';
            $project->save();

            return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Project::where('id', $id)->delete();
        return back();
    }

    public function massDestroy(MassDestroyCompanyRequest $request){
        Project::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
