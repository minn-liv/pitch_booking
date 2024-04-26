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

        try {
            $booking = Booking::where('id', $request->id)->first();

            if (!isset($booking)) {
                return $this->resError('Not found booking!');
            }
            if ($booking->booking_status === 1) {
                return $this->resError('Booking has accept!');
            } else {
                $booking->booking_status = 1;
                $booking->save();
                return $this->resSuccess('Accept booking success!');
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
                return $this->resSuccess('Get list success!', $booking, 200);
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
                if ($booking) {
                    return $this->resSuccess('Get list success!', $booking, 200);
                }
            } else {
                return $this->resError('User not found!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage());
        }
    }
}
