<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PitchInformation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    //

    public function store(Request $request)
    {
        $user_created = Auth::user()->id;
        $rules = [
            'pitch_information_id' => 'required|integer',
            'note' => 'required|string|max:255',
            'total' => 'required|integer',
            'date' => 'required|date',
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
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return $this->resError($error);
            }

            // Check if pitch_information not exist
            $pitch_info = PitchInformation::find($request->pitch_information_id);
            if (!isset($pitch_info)) {
                return $this->resError('Sân không tồn tại');
            }

            $booking = new Booking();
            $booking->user_created = $user_created;
            $booking->pitch_information_id = $request->pitch_information_id;
            $booking->note = $request->note;
            $booking->total = $request->total;
            $booking->payment_status = 0;
            $booking->booking_status = 0;
            $booking->date = $request->date;
            $booking->start_time = $request->start_time;
            $booking->end_time = $request->end_time;

            $booking->save();
            return $this->resSuccess('Đặt lịch thành công!', $booking, 200);
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function listByUser()
    {
        $id = Auth::id();
        try {
            if ($id) {
                $booking = Booking::where('user_created', $id)->get();

                return $this->resSuccess('Get list success!', $booking, 200);
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }
}
