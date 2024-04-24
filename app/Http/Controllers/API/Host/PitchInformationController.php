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
        $pitch_id = 2;
        $rules = [
            'name' => 'required|string',
            'pitch_type' => 'required|string',
            'price' => 'required|integer',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
        ];

        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string'   => 'Vui lòng nhập đúng :attribute.',
            'integer'   => 'Vui lòng nhập đúng :attribute.',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->resError($error);
        }

        $pitch = new PitchInformation();
        $pitch->name = $request->name;
        $pitch->pitch_type = $request->pitch_type;
        $pitch->price = $request->price;
        $pitch->pitch_id = $pitch_id;
        $pitch->start_time = $request->start_time;
        $pitch->end_time = $request->end_time;
        try {
            $pitch_info = Pitch::where('id', $pitch_id)->with('pitch_information')->first();
            if ($pitch_info->pitch_information) {
                return $this->resError('Đã có thông tin sân chi tiết!', $pitch_info);
            } else {
                $pitch->save();
                return $this->resSuccess('Tạo thông tin chi tiết sân thành công!', $pitch);
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
    public function edit(Request $request)
    {

        $credentials = array_filter($request->all());
        try {
            $pitch = PitchInformation::find($request->id);
            $pitch->update($credentials);

            return $this->resSuccess('Chỉnh sửa thông tin thành công!', $pitch);
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function detail(Request $request)
    {
        try {
            $pitch = PitchInformation::find($request->id);

            if ($pitch) {
                return $this->resSuccess('Lấy thông tin thành công!', $pitch);
            } else {
                return $this->resError('Không tìm thấy sân bóng yêu cầu!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function delete(Request $request)
    {
        try {
            $pitch = PitchInformation::find($request->id);
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
