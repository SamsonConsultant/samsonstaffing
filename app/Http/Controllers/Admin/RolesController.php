<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Str;

class RolesController extends Controller
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

    
    public function index(){
        $roles = Role::all();
        $template = 'role-list';
        return view('pages.admin.index', compact('template','roles'));
    }

    public function create(){
        $permissions = Permission::all()->pluck('title', 'id');
        $template = 'role-create';
        return view('pages.admin.index', compact('template','permissions'));
    }

    public function store(StoreRoleRequest $request){
        $values = $request->except('_token');
        $role = new Role();
        $role->role_name = $values['title'];
        $role->role_slug = Str::slug($values['title']);
        $role->save();

        // $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role){

        $permissions = Permission::all()->pluck('title', 'id');

        $role->load('permissions');
        $template = 'role-edit';
        return view('pages.admin.index', compact('permissions', 'role', 'template'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $values = $request->except('_token');
        $role->role_name = $values['title'];
        $role->role_slug = Str::slug($values['title']);
        $role->save();

        // $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role){

        $role->load('permissions');
        $template = 'role-show';
        return view('pages.admin.index', compact('role', 'template'));
    }

    public function destroy(Role $role){
        $role->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
