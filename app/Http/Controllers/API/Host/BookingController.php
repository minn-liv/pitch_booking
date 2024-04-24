<?php

namespace App\Http\Controllers\API\Host;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function accept(Request $request)
    {

        try {
            $booking = Booking::where('id', $request->id)->first();

            if (!isset($booking)) {
                return $this->resError('Không tìm thấy lịch đặt!');
            }
            if ($booking->booking_status === 1) {
                return $this->resError('Lịch đặt đã đã accept!');
            } else {
                $booking->booking_status = 1;
                $booking->save();
                return $this->resSuccess('Đã chấp nhận đặt lịch thành công!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
}
