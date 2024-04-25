<?php

namespace App\Http\Controllers\API\Host;

use App\Http\Controllers\Controller;
use App\Models\Pitch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PitchController extends Controller
{
    //
    public function store(Request $request)
    {
        $user_id = Auth::id();

        $rules = [
            'name' => 'required|string',
            'address' => 'required|string',
            'hotline' => 'required|string',
            'description' => 'required|string',
        ];

        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string'   => 'Vui lòng nhập đúng :attribute.',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->resError($error);
        }

        $pitch = new Pitch();
        $pitch->name = $request->name;
        $pitch->address = $request->address;
        $pitch->hotline = $request->hotline;
        $pitch->description = $request->description;
        $pitch->host_by = $user_id;
        try {
            $pitch->save();

            return $this->resSuccess('Tạo sân bóng thành công!', $pitch);
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function list()
    {
        try {
            $pitch = Pitch::all();
            if ($pitch) {
                return $this->resSuccess('Lấy danh sách thành công!', $pitch);
            } else {
                return $this->resSuccess('Lấy danh sách thất bại!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function edit(Request $request)
    {

        $credentials = array_filter($request->all());
        try {
            $pitch = Pitch::find($request->id);
            $pitch->update($credentials);

            return $this->resSuccess('Chỉnh sửa thông tin thành công!', $pitch);
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function detail(Request $request)
    {
        try {
            $pitch = Pitch::where('id', $request->id)->with('pitch_information')->get();
            if ($pitch) {
                return $this->resSuccess('Get detail success!', $pitch);
            } else {
                return $this->resError('Not found!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function delete(Request $request)
    {
        try {
            $pitch = Pitch::find($request->id);
            if ($pitch) {
                $pitch->delete();
                return $this->resSuccess('Delete success!');
            } else {
                return $this->resError('Not found!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
}