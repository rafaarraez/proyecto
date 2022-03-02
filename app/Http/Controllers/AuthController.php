<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {


        $request->validate([
            'name'                  => ['required'],
            'email'                 => ['required', 'email', 'unique:users'],
            'password'              => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
            'cedula'                => ['required'],
            'photo'                 => ['required'],
            'address'               => ['required'],
            'phone'                 => ['required'],
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'cedula'        => $request->cedula,
            'photo'         => $request->photo,
            'address'       => $request->address,
            'phone'         => $request->phone,
            'is_admin'      => false,
            'is_active'     => true,
            'password'      => Hash::make($request->password),
        ]);

        return response()->json(['msg' => 'Registered Successfully']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales son incorrectas.'],
            ]);
        }

        if(!$user->is_active){
            throw ValidationException::withMessages([
                'email' => ['Este usario no esta activo, contacte al administrador.'],
            ]);

        }
        $data = [
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'user' => $user
        ];
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'Logout Successfull']);
    }
}
