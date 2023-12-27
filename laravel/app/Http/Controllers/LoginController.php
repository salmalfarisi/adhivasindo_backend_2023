<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function Register(RegistrationRequest $request)
	{
		$now = Carbon::now();
		DB::beginTransaction();
		try
		{
			DB::table('users')->insert([
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'created_at' => $now,
			]);
			
			DB::commit();
			
			return $this->sendResponse(true, $request->all(), 'Account successfully registered');
		}
		catch(Throwable $e)
		{
			DB::rollback();
			return $this->handlingErrorCatch($e);
		}
	}
	
	public function Login(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
		
		$array = ['email' => $request->email, 'password' => $request->password];
		
		if (Auth::attempt($array)) 
		{
			$now = Carbon::now()->addDays(1);
			$user = Auth::user(); 
			$token = $user->createToken($user->name);
			$data['token'] = $token->token->id;			
			$data['id'] = $user->id;
			$data['name'] = $user->name;
			$data['email'] = $user->email;
			
			return $this->sendResponse(true, $data, 'Successfully login');
		}
		else
		{
			return $this->sendError('Email or Password not found in database', []);
		}
	}
	
	public function Logout(Request $request)
	{
		$token = $request->bearerToken();
		$cekdata = DB::table('oauth_access_tokens')->where('id', $token)->delete();
		return $this->sendResponse(true, [], 'Account successfully logout');
	}
}
