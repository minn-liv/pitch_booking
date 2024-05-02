<?php

namespace App\Http\Controllers\API\Host;

use App\Http\Controllers\Controller;
use App\Models\Match;
use App\Models\Pitch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    //
    public function store(Request $request)
    {
        $user_id =  Auth::id();
        $rules = [
            'note' => 'required|string|max:255',
            'rules' => 'required|string|max:255',
            'teams_numbers' => 'required|integer|min:1|max:16',
            'duration' => 'required|date_format:H:i',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'date' => 'required|date',
        ];

        $messages = array(
            'required' => 'Vui lòng nhập :attribute.',
            'string'   => 'Vui lòng nhập đúng :attribute.',
            'integer'   => 'Vui lòng nhập đúng :attribute.',
            'min' => 'Vui lòng nhập :attribute tối thiểu là :min',
            'max' => 'Vui lòng nhập :attribute tối đa là :max',
            'date_format' => 'Vui lòng nhập đúng :attribute',
            'after' => 'Thời gian bắt đầu phải trước thời gian kết thúc',
            'date' => 'Vui lòng nhập đúng :attribute',
        );

        try {
            // Check if pitch is not exist
            $pitch = Pitch::find($request->pitch_id);
            if(!isset($pitch)) {
                return $this->resError('Sân không tồn tại');
            }

            // Get pitch_information_id
            $pitch_information = Pitch::where('id', $request->pitch_id)->with('pitch_information')->get();
            $pitch_info_id = $pitch_information[0]->pitch_information->id;
            
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return $this->resError($error);
            }
    
            $match = new Match();
    
            $match->created_by = $user_id;
            $match->pitch_id = $request->pitch_id;
            $match->pitch_information_id = $pitch_info_id;
            $match->note = $request->note;
            $match->rules = $request->rules;
            $match->teams_numbers = $request->teams_numbers;
            $match->match_status = 0;
            $match->duration = $request->duration;
            $match->start_time = $request->start_time;
            $match->end_time = $request->end_time;
            $match->date = $request->date;
            
            $match->save();
            return $this->resSuccess('Tạo trận đấu thành công!', $match);
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
}