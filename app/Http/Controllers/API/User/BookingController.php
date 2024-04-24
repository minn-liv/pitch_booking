<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    //

    public function store(Request $request)
    {
        $user_created = 4;
        $pitch_information_id = 1;
        $rules = [
            // 'user_created' => 'required',
            // 'pitch_information_id' => 'required',
            'note' => 'required|string',
            'total' => 'required|integer',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
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
        try {
            $booking = new Booking();
            $booking->user_created = $user_created;
            $booking->pitch_information_id = $pitch_information_id;
            $booking->note = $request->note;
            $booking->total = $request->total;
            $booking->payment_status = 0;
            $booking->booking_status = 0;
            $booking->date = $request->date;
            $booking->start_time = $request->start_time;
            $booking->end_time = $request->end_time;

            $booking->save();

            return $this->resSuccess('Booking success!', $booking, 200);
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function list()
    {
        try {

            $booking = Booking::all();
            if ($booking) {
                return $this->resSuccess('List booking!', $booking, 200);
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }

    public function listByUser(Request $request)
    {
        try {
            if ($request->id) {
                $booking = Booking::where('user_created', $request->id)->get();
            } else {
                $booking = Booking::all();
            }
            if ($booking) {
                return $this->resSuccess('List booking!', $booking, 200);
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }
}
