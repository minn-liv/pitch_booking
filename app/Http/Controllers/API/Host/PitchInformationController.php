<?php

namespace App\Http\Controllers\API\Host;

use App\Http\Controllers\Controller;
use App\Models\Pitch;
use App\Models\PitchInformation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PitchInformationController extends Controller
{
    //
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'pitch_id' => 'required|integer',
            'pitch_type' => 'required|string|max:50',
            'price' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];

        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string'   => 'Vui lòng nhập đúng :attribute.',
            'integer'   => 'Vui lòng nhập đúng :attribute.',
            'max' => 'Vui lòng nhập :attribute tối thiểu là 16',
            'date_format' => 'Vui lòng nhập đúng :attribute',
            'after' => 'Thời gian bắt đầu phải trước thời gian kết thúc',
            'date' => 'Vui lòng nhập đúng :attribute',
        );

        try {
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return $this->resError($error);
            }

            $pitch_info = new PitchInformation();
            $pitch_info->name = $request->name;
            $pitch_info->pitch_type = $request->pitch_type;
            $pitch_info->price = $request->price;
            $pitch_info->pitch_id = $request->pitch_id;
            $pitch_info->start_time = $request->start_time;
            $pitch_info->end_time = $request->end_time;

            // Check if pitch is not exist
            $pitch = Pitch::find($request->pitch_id);
            if (!isset($pitch)) {
                return $this->resError('Sân id: ' . $request->pitch_id . ' không tồn tại');
            }

            // Check if pitch already has pitch_information 
            $pitch_information = PitchInformation::where('pitch_id', $request->pitch_id)->first();
            if (isset($pitch_information)) {
                return $this->resError('Sân id: ' . $request->pitch_id . ' đã có thông tin chi tiết');
            }

            $pitch_info->save();
            return $this->resSuccess('Tạo thông tin chi tiết thành công!');
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
    public function edit(Request $request)
    {
        $credentials = $request->all();
        $rules = [
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'pitch_type' => 'required|string|max:50',
            'price' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];

        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string'   => 'Vui lòng nhập đúng :attribute.',
            'integer'   => 'Vui lòng nhập đúng :attribute.',
            'max' => 'Vui lòng nhập :attribute tối đa chỉ :max kí tự',
            'date_format' => 'Vui lòng nhập đúng :attribute',
            'after' => 'Thời gian bắt đầu phải trước thời gian kết thúc',
            'date' => 'Vui lòng nhập đúng :attribute',
        );

        try {
            $validator = Validator::make($credentials, $rules, $messages);
            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return $this->resError($error);
            }

            // Check if pitch_information is not exist
            $pitch_info = PitchInformation::find($request->id);
            if (!isset($pitch_info)) {
                return $this->resError('Thông tin chi tiết id: ' . $request->id . ' không tồn tại');
            }

            $pitch_info->update($credentials);
            return $this->resSuccess('Chỉnh sửa thông tin thành công!', $pitch_info);
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
            $pitch = PitchInformation::find($request->id);

            if (!isset($pitch)) {
                return $this->resError('Không tìm thấy thông tin sân');
            }
            return $this->resSuccess('Lấy thông tin thành công!', $pitch);
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function delete(Request $request)
    {
        if (!isset($request->id)) {
            return $this->resError('Vui lòng nhập id sân!');
        }

        try {
            $pitch = PitchInformation::find($request->id);
            if (!isset($pitch)) {
                return $this->resError('Không tìm thấy thông tin sân!');
            }

            $pitch->delete();
            return $this->resSuccess('Xóa thông tin sân thành công!');
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
}
