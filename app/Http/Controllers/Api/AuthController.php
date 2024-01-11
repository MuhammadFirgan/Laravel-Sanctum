<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function Register(Request $request)
    {
        $data = new User;

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Register failed',
                'data' => $validate->errors()
            ], 401);
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);

        $data->save();

        return response()->json([
            'status' => true,
            'message' => 'Register success'
        ], 200);
    }

    public function Login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Login failed',
                'data' => $validate->errors()
            ], 401);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect email or password',
                
            ], 401);
        }

        $data = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'Login success',
            'token' => $data->createToken('auth-user')->plainTextToken
        ], 200);
        
    }
}
