<?php

namespace App\Http\Controllers\API\Host;

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
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        try {
            if (Auth::attempt($credentials)) {
                $user = $request->user();
                $tokenResult = $user->createToken('tony');

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
                    'message' => 'Some thing went wrong'
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
            'username' => 'required|string',
            'password' => 'required|string',
            'name' => 'required|string',
            'dob' => 'required',
            'phone' => 'required|string',
            'address' => 'required|string',
        ];


        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string'   => 'Vui lòng nhập đúng :attribute.',
            'max'      => 'Vui lòng chọn :attribute tối đa 5Mb',
            'min'      => 'Vui lòng nhập :attribute tối thiểu :min kí tự',
            'unique'      => 'Đã tồn tại :attribute',
        );

        $attribute_names = array(
            'name'                  => 'Tên',
            'email'                 => 'Email',
            'phone'                 => 'Số điện thoại',
            'password'              => 'Mật khấu',
        );

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->dob =  $request->dob;
        $user->phone = $request->phone;
        $user->user_type = "host";
        $user->address = $request->address;

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // return back()->withErrors($validator)->withInput();
            $error = $validator->errors()->all();
            return $this->resError($error);
        }

        try {
            // if ($request->hasFile('avatar')) {
            //     $user->avatar = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . strtolower($request->file('avatar')->getClientOriginalExtension());
            // }
            $user->save();
            return $this->resSuccess("Đăng ký thành công");
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
