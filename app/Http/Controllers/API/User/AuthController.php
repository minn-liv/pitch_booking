<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->all();
        $rules = [
            'username' => 'required|string|min:5|max:20|',
            'password' => 'required|string|min:5|max:20',
        ];

        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string'   => 'Vui lòng nhập đúng :attribute.',
            'max'      => 'Vui lòng nhập :attribute tối đa chỉ :max kí tự',
            'min'      => 'Vui lòng nhập :attribute tối thiểu :min kí tự',
        );

        try {
            $validator = Validator::make($credentials, $rules, $messages);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return $this->resError($error);
            }
            if (Auth::attempt($credentials)) {
                $user = $request->user();
                $tokenResult = $user->createToken('client');

                $output = [
                    'success' => true,
                    'message' => 'Login Success',
                    'token_type' => 'Bearer',
                    'access_token' => $tokenResult->accessToken,
                    'expires_in' => Carbon::parse($tokenResult->token->expires_at)->timestamp
                ];
            } else {
                $output = [
                    'success' => false,
                    'message' => 'Sai tên tài khoản hoặc mật khẩu'
                ];
            }
            return response()->json($output);
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
    public function register(Request $request)
    {
        $rules = [
            'username' => 'required|string|min:5|max:20|unique:users',
            'password' => 'required|string|min:5|max:20',
            'name' => 'required|string|min:3|max:20',
            'dob' => 'required|date',
            'phone' => ['required', 'regex:/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/'],
            'address' => 'required|string|max:255'
        ];

        $messages = array(
            'unique' => ':attribute đã được sử dụng',
            'required' => 'Vui lòng nhập :attribute.',
            'string'   => 'Vui lòng nhập đúng :attribute.',
            'max'      => 'Vui lòng nhập :attribute tối đa chỉ :max kí tự',
            'min'      => 'Vui lòng nhập :attribute tối thiểu :min kí tự',
            'date'      => 'Vui lòng nhập :attribute',
            'regex' => 'Vui lòng nhập đúng :attribute'
        );
        try {

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return $this->resError($error);
            }
            $user = new User();
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
            $user->dob =  $request->dob;
            $user->phone = $request->phone;
            $user->user_type = "user";
            $user->address = $request->address;

            $user->save();
            return $this->resSuccess("Đăng ký thành công");
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return $this->resSuccess("Đăng xuất thành công");
        } else {
            return $this->resError('Not authenticated');
        }
    }
}
