<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
       /**
     * Register.
     * @unauthenticated
     * 
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email','unique:users'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password'],
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return response()->json([
            'message' => 'Sukses register',
            'data' => $success,
        ], 200);
    }
 
     /**
     * Login user
     * 
     * Logging in user
     * 
     * @unauthenticated
     * 
     */
    public function login(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
    
            // Ambil kredensial
            $credentials = $request->only('email', 'password');
    
            // Proses login
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
    
                // Buat token
                $token = $user->createToken('MyApp')->plainTextToken;
    
                return response()->json([
                    'success' => true,
                    'message' => 'Sukses login',
                    'user' => [
                        'token' => $token,
                        'name' => $user->name,
                        'id' => $user->id,
                    ],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah',
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    
    
     /**
     * Cek Auth User.
     */
    public function cekAuth(){
        try {
            //code...
            $user = Auth::user();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success'=>false,
                'user'=>$th->getMessage()
            ]);
        }
        return response()->json([
            'success'=>true,
            'user'=>$user
        ]);

    }
    
     /**
     * Logout user
     * 
     * Logging out current user
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
           
            auth()->user()->tokens()->delete();
            
        } catch (\Throwable $th) {
            return response()->json([
            'success'=>false,
            'message'=>$th->getMessage()
        ],500);
        }
            return response()->json([
            'success'=>true,
            'message'=>'success logout'
        ]);

    }
}
