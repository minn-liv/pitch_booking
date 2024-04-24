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
                return $this->resSuccess('Lấy danh sách thành công!', $pitch);
            } else {
                return $this->resSuccess('Lấy danh sách thất bại!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function detail(Request $request)
    {
        try {
            $pitch = Pitch::find($request->id)->with('pitch_information')->get();
            if ($pitch) {
                return $this->resSuccess('Lấy thông tin thành công!', $pitch);
            } else {
                return $this->resError('Không tìm thấy sân bóng yêu cầu!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }


    public function filter(Request $request)
    {
        $location = $request->location;
        $name = $request->name;
        if (!isset($location) && !isset($name)) {
            return $this->resError('Vui lòng nhập khu vực hoặc tên cần tìm', [], 422);
        }

        try {
            $pitch = Pitch::where('address', 'like', '%' . $location . '%')
                ->orWhere('name', 'like', '%' . $name . '%')
                ->get();
            if ($pitch) {
                return $this->resSuccess('Lấy danh sách thành công!', $pitch);
            } else {
                return $this->resSuccess('Lấy danh sách thất bại!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
}
