<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\Role;
use App\Http\Requests;
use Redirect;
use Storage;
use DB;

class UserController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $haspermision = auth()->user()->can('record-create');
        $roles = Role::lists('display_name','id');
        $lang = DB::table('lang')
        ->select('lang.*')
        ->get();
        return view('backend.users.index', compact('roles', 'lang','haspermision'));
    }

    public function getUsers()
    {   
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.display_name as role')
            ->get();
        
        $view = auth()->user()->can('record-view');
        $edit = auth()->user()->can('record-edit');
        $delete = auth()->user()->can('record-delete');
    
            
        $row = [];  
        foreach($users as $key => $value){  
                    
            $row['id'] = $value->id;
            if($value->last_name != ''){
                $row['name'] = $value->name. ' '. $value->last_name;
            }else{
                $row['name'] = $value->name;
            }            
            $row['email'] = $value->email;
            $row['status'] = $value->status;
            $row['role'] = $value->role;
            $row['view'] = $view;
            $row['edit'] = $edit;
            $row['delete'] = $delete;
            $data[] = $row;
        }
        
        $json_data = array('data'=> $data);
        return response()->json($json_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $haspermision = auth()->user()->can('record-create');
         if ($haspermision) {
            $roles = Role::lists('display_name','id');
            return view('backend.users.create', compact('roles'));
        }
        else {
            abort(403, 'Lo siento, No tienes permiso.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        dd($request->input('roles'));
        $validator = \Validator::make($request->all(),[
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|same:confirm_password',
            'roles' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            if($request->hasFile('image')){                
    
                $file = $request->file('image');                
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;              
                 
                // SUBIR IMAGE
                $image_resize = Image::make($file->getRealPath());
                $img = Image::make($file->getRealPath())->widen(64, function ($constraint) {
                    $constraint->upsize();
                });
                
                $img->stream(); // <-- Key point
    
                //dd();
                Storage::disk('images_profile')->put($fileNameToStore, $img);
            } else {
                $fileNameToStore = '';
            }
            
            $input = $request->all();
            $input['password'] = \Hash::make($input['password']);
            $input['image'] = $fileNameToStore;

            $user = User::create($input);
            $user->attachRole($request->input('roles'));
            return response()->json($user);
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $userRole = $user->roles->lists('id','id')->first();

        $data['id'] = $user->id;
        $data['name'] = $user->name;
        $data['last_name'] = $user->last_name;
        $data['email'] = $user->email;
        $data['phone'] = $user->phone;
        $data['role'] = $userRole;
        $data['ruta'] = $user->image;
        $data['image'] = utf8_encode(\File::get(public_path('img_app/profile_images/'.$user->image)));

        
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::lists('display_name','id');
        $userRole = $user->roles->lists('id','id')->toArray();

        return view('backend.users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->file('image'));
        $validator = \Validator::make($request->all(),[
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'roles' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $user = User::find($id);
            $input = $request->all();

            if($request->hasFile('image')){
                $userImage = public_path("img_app/profile_images/{$user->image}"); // get previous image from folder
                if (\File::exists($userImage)) { // unlink or remove previous image from folder
                    \Storage::delete($userImage);
                }

                $file = $request->file('image');
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $user->image = $fileNameToStore;
                // SUBIR IMAGE
                $image_resize = Image::make($file->getRealPath());
                $img = Image::make($file->getRealPath())->widen(64, function ($constraint) {
                    $constraint->upsize();
                });
                
                $img->stream(); // <-- Key point

                //dd();
                Storage::disk('images_profile')->put($fileNameToStore, $img);
                $input['image'] = $fileNameToStore;

            }
           
            if(!empty($input['password'])){ 
                $input['password'] = \Hash::make($input['password']);
            }else{
                $input = array_except($input,array('password'));    
            }

            
            $user->update($input);
            DB::table('role_user')->where('user_id',$id)->delete();        
            $user->attachRole($request->input('roles'));
           

            return response()->json($user);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);
        return response()->json($user);
        // return Redirect::to('/users')->with('notification', 'Registro eliminado exitosamente!');
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find($request->user_id);

        if ($request->hasFile('image')) {

            $userImage = public_path("img_app/profile_images/{$user->image}"); // get previous image from folder
            if (\File::exists($userImage)) { // unlink or remove previous image from folder
                \Storage::delete($userImage);
            }

            $file = $request->file('image');
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $user->image = $fileNameToStore;
            // SUBIR IMAGE
            $image_resize = Image::make($file->getRealPath());
            $img = Image::make($file->getRealPath())->widen(64, function ($constraint) {
                $constraint->upsize();
            });
            
            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('images_profile')->put($fileNameToStore, $img);
        }
        if (isset($fileNameToStore)) {
            $user->image = $fileNameToStore;
            $user->save();
        }

        $user->update($request->except(['image']));

        return Redirect::to('profile/' . $user->id)->with('notification', 'Datos actualizdos exitosamente!');
    }

    public function updatePassword(Request $request)
    {
        $user = User::find($request->user_id);

        $this->validate($request, [
            'password' => 'required|min:6',
            'reptyPassword' => 'required|same:password',
            'current_password' => 'required|current_password'
        ]);


        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return Redirect::to('profile/' . $user->id)->with('notification', 'Datos actualizdos exitosamente!');
    }

    public function changeStatus(Request $request)
    {
        //dd($request->all());
        $user = User::findOrFail($request->id);
        $status = 0;
        $mensaje = '';
        if ($user->status == 0) {
            $status = 1;
            $mensaje = 'Usuario habilitado exitosamente. !';
        }
        if ($user->status == 1) {
            $status = 0;
            $mensaje = 'Usuario inahabilitado exitosamente. !';
        }

        $user->status = $status;
        $user->save();

        $data['code']    = 200;
        $data['message'] = $mensaje;

        return response()->json($data);
    }

    public function getEmployeesPrestashop()
    {          
 
        
        $inserts = [];

        $select = DB::connection('recambio_ps')
        ->table('recambio_ps.ps_employee')
        ->select(array('id_lang', 'firstname', 'lastname', 'email', 'passwd', 'last_passwd_gen'))
        ->get();         
 
        foreach($select as $bid) {
            $inserts[] = [ 
                'id_lang' => $bid->id_lang,
                'name'=> $bid->firstname,
                'last_name' => $bid->lastname,
                'email' => $bid->email,
                'password' => $bid->passwd,
                'last_password_gen' => $bid->last_passwd_gen
            ]; 
        }
        //aqui es que me da el errorZ
        DB::table('users')->insert($inserts);
  
        
        $data['code'] =  200;
        $data['message'] = 'Refresh';
        return response()->json($data);
 
    }
}
