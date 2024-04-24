<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Match;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    //
    public function store(Request $request)
    {
        // $user_id =  Auth::id();
        $rules = [
            'note' => 'required|string',
            'rules' => 'required|string',
            'teams_numbers' => 'required|integer',
            'duration' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'date' => 'required',
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

        $match = new Match();

        $match->created_by = 4;
        $match->pitch_id = $request->pitch_id;
        $match->note = $request->note;
        $match->rules = $request->rules;
        $match->teams_numbers = $request->teams_numbers;
        $match->match_status = 0;
        $match->duration = $request->duration;
        $match->start_time = $request->start_time;
        $match->end_time = $request->end_time;
        $match->date = $request->date;

        try {
            $match->save();

            return $this->resSuccess('Tạo sân bóng thành công!', $match);
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function list()
    {
        try {
            $match = Match::all();
            if ($match) {
                return $this->resSuccess('Lấy danh sách thành công!', $match);
            } else {
                return $this->resSuccess('Lấy danh sách thất bại!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

}