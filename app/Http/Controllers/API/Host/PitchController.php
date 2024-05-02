<?php

namespace App\Http\Controllers\API\Host;

use App\Http\Controllers\Controller;
use App\Models\Pitch;
use App\Models\PitchInformation;
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'hotline' => ['required', 'regex:/^[0-9]+$/', 'max:10'],
            'description' => 'required|string|max:255',
        ];

        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string' => 'Vui lòng nhập đúng :attribute.',
            'max' => 'Vui lòng nhập :attribute tối đa chỉ :max kí tự',
            'regex' => 'Vui lòng nhập đúng :attribute'

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

            return $this->resSuccess('Tạo sân thành công!', $pitch);
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function list()
    {
        try {
            $pitch = Pitch::all();
            if ($pitch) {
                return $this->resSuccess('Lấy danh sách sân thành công!', $pitch);
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function edit(Request $request)
    {
        $credentials = $request->all();
        $rules = [
            'id' => 'required|integer',
            'name' => 'string|max:255',
            'address' => 'string|max:255',
            'hotline' => ['regex:/^[0-9]+$/', 'max:10'],
            'description' => 'string|max:255',
        ];

        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string' => 'Vui lòng nhập đúng :attribute.',
            'max' => 'Vui lòng nhập :attribute tối đa chỉ :max kí tự',
            'regex' => 'Vui lòng nhập đúng :attribute'

        );
        try {
            $validator = Validator::make($credentials, $rules, $messages);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return $this->resError($error);
            }
            $pitch = Pitch::find($request->id);
            if (!isset($pitch)) {
                return $this->resError('Không tìm thấy sân!');
            }

            $pitch->update($credentials);
            return $this->resSuccess('Chỉnh sửa thông tin thành công!', $pitch);
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function detail(Request $request)
    {
        if (!isset($request->id)) {
            return $this->resError('Vui lòng nhập id sân!');
        }
        try {
            $pitch = Pitch::where('id', $request->id)->with('pitch_information')->first();

            if (!isset($pitch)) {
                return $this->resError('Không tìm thấy sân!');
            }
            return $this->resSuccess('Lấy thông tin thành công!', $pitch);
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        if (!isset($request->id)) {
            return $this->resError('Vui lòng nhập id sân!');
        }
        try {
            $pitch = Pitch::find($request->id);
            if ($pitch) {
                // Check if pitch_information exist and delete 
                $pitch_information = PitchInformation::where('pitch_id', $request->id)->first();
                if (isset($pitch_information)) {
                    $pitch_information->delete();
                }

                $pitch->delete();
                return $this->resSuccess('Xóa thành công!');
            } else {
                return $this->resError('Không tìm thấy sân!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
}
