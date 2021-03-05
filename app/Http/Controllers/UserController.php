<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\UserTypes;
use App\Http\Requests;
use Redirect;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_types = UserTypes::all();
        return view('backend.users.create', compact('user_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->email,
            'password' => bcrypt($request->password),
            // 'user_type_id' => $request->user_type_id
        ]);

        return Redirect::to('/users')->with('notification', 'Usuario creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user_types = UserTypes::all();

        return view('backend.users.edit', compact('user', 'user_types'));
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
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->email,
            'user_type_id' => $request->user_type_id
        ]);

        return Redirect::to('/users')->with('notification', 'Usuario modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return Redirect::to('/users')->with('notification', 'Registro eliminado exitosamente!');
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->user_id);

        if ($request->hasFile('image')) {

            $userImage = public_path("profile_images/{$user->image}"); // get previous image from folder
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
            $img->save(public_path('profile_images/' .$fileNameToStore));
        }
        if (isset($fileNameToStore)) {
            $user->image = $fileNameToStore;
            $user->save();
        }

        $user->update($request->except(['image']));

        return Redirect::to('profile/' . $user->id)->with('notification', 'Datos actualizdos exitosamente!');
    }

    public function change_password($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.change-password', compact('user'));
    }

    public function update_password(Request $request)
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
}
