<?php

namespace App\Http\Controllers\API\Host;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function accept(Request $request)
    {

        if (!isset($request->id)) {
            return $this->resError('Vui lòng nhập id đặt lịch!');
        }
        try {
            $booking = Booking::where('id', $request->id)->first();

            if (!isset($booking)) {
                return $this->resError('Không tìm thấy đặt lịch!');
            }
            if ($booking->booking_status === 1) {
                return $this->resError('Đặt lịch đã được chấp nhận!');
            } else {
                $booking->booking_status = 1;
                $booking->save();
                return $this->resSuccess('Chấp nhận đặt lịch thành công!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
    public function list()
    {
        try {
            $booking = Booking::all();
            if ($booking) {
                return $this->resSuccess('Lấy danh sách đặt lịch thành công!', $booking, 200);
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function listByUser(Request $request)
    {
        try {
            $user = User::find($request->id);
            if ($user) {
                $booking = Booking::where('user_created', $request->id)->get();
                if (!isset($booking[0])) {
                    return $this->resError('Người dùng chưa đặt lịch!');
                }
                return $this->resSuccess('Lấy danh sách đặt lịch thành công!', $booking, 200);
            } else {
                return $this->resError('Không tìm thấy người dùng!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }
}
