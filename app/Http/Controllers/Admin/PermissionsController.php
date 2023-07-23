<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
// use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Request as RequestsUrl;

class PermissionsController extends Controller
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
        $this->middleware('auth:admin');
    }

    
    /**
     * 
     * Listing page
     */
    public function index(){        
        $template = 'pr-list';
        $lists = Permission::all();

        return view('pages.admin.index', compact('template','lists'));
    }

    /**
     * 
     * Create Permission page
     */
    public function create(){
        $template = 'pr-create';
        return view('pages.admin.index', compact('template'));
    }

    /**
     * 
     * Store Permission page
     */
    public function store(StorePermissionRequest $request){
        $values = $request->except('_token');
        $permission = Permission::create($values);

        return redirect()->route('admin.permissions.index');
    }

    /**
     * 
     * Edit Permission page
     */
    public function edit(Request $request, Permission $permission){
        $template = 'pr-edit';
        return view('pages.admin.index', compact('permission', 'template'));
    }

    /**
     * 
     * Update Permission page
     */
    public function update(UpdatePermissionRequest $request, Permission $permission){
        $values = $request->except('_token');
        $permission->update($values);

        return redirect()->route('admin.permissions.index');
    }

    /**
     * 
     * Show Permission page
     */
    public function show(Permission $permission){
        $template = 'pr-show';

        return view('pages.admin.index', compact('permission', 'template'));
    }

    /**
     * 
     * Destroy Permission page
     */
    public function destroy(Permission $permission){        
        $permission->delete();

        return back();
    }

    /**
     * 
     * Mass Destrory Permission page
     */
    public function massDestroy(MassDestroyPermissionRequest $request){
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
