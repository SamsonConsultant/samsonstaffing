<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLocationRequest;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Request as RequestsUrl;
use Validator;

class LocationsController extends Controller
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

    public function index(Request $request, $id=null){
        $template = last(RequestsUrl::segments());
        $segments = RequestsUrl::segments();

        $posts = Location::all();

        if(!empty($id)){
            $template = 'manage-locations';            
            $post = Location::find($id);
            return view('pages.admin.index', compact('template', 'segments', 'posts', 'post'));
        }

        return view('pages.admin.index', compact('template', 'segments', 'posts'));
    }
    
    public function storeLocationData(Request $request){
        try {
            $arr = [
                'name' => 'required',
                'address' => 'required',
            ];
            
            $validator = Validator::make($request->all(), $arr);

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()],422);
            }

            if ($request->has('post_id') && $request->filled('post_id')) {                
                $post = Location::where('id', $request->post_id)->first();
                $post->name      =   $request->name;
                $post->address   = $request->address;
            } else {
                $post = new Location;
                $post->name      =   $request->name;
                $post->address   = $request->address;
            }
            
            if($post->save()){
                return response()->json(['message' => 'You have added the Content successfully.', 'status' => 201], 201);
            } else{
                return response()->json(['message' => 'Action is not completed.', 'status' => 200], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 200], 200);
        }
    }

    public function destroy($id){
        Location::where('id', $id)->delete();
        return back();
    }

    public function massDestroy(MassDestroyLocationRequest $request){
        Location::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
