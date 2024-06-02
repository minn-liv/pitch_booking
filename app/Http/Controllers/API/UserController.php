<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function avatar(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        try {
            if ($request->image) {
                $request->image->move(public_path('images/users/'), $imageName);
                $user = User::find(Auth::id());
                $user->avatar = $imageName;
                $user->update();
                return $this->resSuccess('Upload ảnh thành công');
            }
        } catch (Exception $e) {
            return $this->resError('Upload ảnh thất bại ' . $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        $id = Auth::id();


        $request->validate([
            'password' => 'required|string|min:5|max:20',
        ]);

        try {
            $user = User::find($id);

            $user->password = Hash::make($request->password);

            $user->update();
            return $this->resSuccess('Đổi mật khẩu thành công');
        } catch (Exception $e) {
            return $this->resError('Đổi mật khẩu thất bại ' . $e->getMessage());
        }
    }
}
