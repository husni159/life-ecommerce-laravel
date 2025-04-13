<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    use HttpResponses;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function login(LoginUserRequest $request)
    {
        try{
            $credentials = array('username' => $request->username, 'password' => $request->password);
            if(!Auth::attempt($credentials, false)) {
                return $this->error('', 'Credentials do not match', 401);
            }
            $user = User::where('username', $request->username)->first();
            //response
            return $this->success([
                'user' => $user,
                'token'=> $user->createToken('API Token of '. $user->username)->plainTextToken
            ]);
        }catch(Exception $e){
            
            return $this->error(
                [],
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function register(Request $request) {
        try{
            
            $request->validate([
                'username' => 'required|string|max:255|unique:users',
                'name' => 'required|string',
                'email' => 'required|string|max:255|unique:users',
                'role' => 'required|string',
                'password' => 'required|confirmed|string|min:8'
            ]);

            $user = User::create([
                'username'      =>$request->username,
                'name'      =>$request->name,
                'email'     => $request->email,
                'role'      => $request->role,
                'password'  => Hash::make($request->password)
            ]);
            return $this->success([
                'user' => $user,
                'token'=> $user->createToken('API Token of '. $user->username)->plainTextToken
            ]);
    
        }catch(Exception $e){
            return $this->error(
                [],
                $e->getMessage(),
                 Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function logout() : string {
        return response()->json('this is my logout method');
    }
}
