<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return response()->json(['status'=>'success', 'data'=>$users]);
    }

    public function store(Request $request)
    {
        $filename = null;

        if($request->hasFile('photo')) {
            $filename = Str::random(10) . $request->email . '.jpg';
            $file = $request->file('photo');
            $file->move(storage_path('public/images'), $filename);
        }

        User::create([
            'name'=> $request->name,
            'identity_id' => $request->identity_id,
            'gender' => $request->gender,
            'address' => $request->address,
            'photo' => $filename,
            'email' => $request->email,
            'password' => app('hash')->make($request->password),
            'phone_number' => $request->phone_number,
            'role' =>$request->role,
            'status' => $request->status,
        ]);

        return response()->json(['status'=>'success']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['status'=>'success', 'data'=>$user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        $password = $request->password != '' ? app('hash')->make($request->password):$user->password;

        $filename = $user->photo;
        if($request->hasFile('photo')) {
            $filename = Str::random(10) . $user->email . '.jpg';
            $file = $request->file('photo');
            $file->move(storage_path('public/images'), $filename);
            unlink(storage_path('public/images/' . $user->photo));
        }

        $user->update([
            'name'=> $request->name,
            'identity_id' => $request->identity_id,
            'gender' => $request->gender,
            'address' => $request->address,
            'photo' => $filename,
            'password' => $password,
            'phone_number' => $request->phone_number,
            'role' =>$request->role,
            'status' => $request->status,
        ]);

        return response()->json('data successfully updated');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        unlink(storage_path('public/images/' . $user->photo));
        $user->delete();

        return response()->json('Data successfully deleted');
    }

   
}
