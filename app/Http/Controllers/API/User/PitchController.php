<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Pitch;
use Exception;
use Illuminate\Http\Request;

class PitchController extends Controller
{
    //
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


    public function filter(Request $request)
    {
        $address = $request->address;
        $name = $request->name;
        $pitch_type = $request->pitch_type;
        if (!isset($address) && !isset($name) && !isset($pitch_type)) {
            return $this->resError('Vui lòng nhập địa chỉ hoặc tên sân', [], 422);
        }

        try {
            $pitch = Pitch::where('address', 'LIKE', '%' . $address . '%')
                ->where('name', 'LIKE', '%' . $name . '%')
                ->get();
            if (!isset($pitch[0])) {
                return $this->resError('Không tìm thấy sân yêu cầu!');
            }
            return $this->resSuccess('Lấy danh sách thành công!', $pitch);
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
}
