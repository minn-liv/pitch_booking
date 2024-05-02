<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Match;
use App\Models\MatchDetail;
use App\Models\Pitch;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
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
            if(isset($pitch_information)) {
                $pitch_info_id = $pitch_information[0]->pitch_information->id;
            }
            
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

    public function list()
    {
        try {
            $match = Match::all();

            if ($match) {
                return $this->resSuccess('Lấy danh sách trận đấu thành công!', $match);
            } else {
                return $this->resSuccess('Không tìm thấy danh sách trận đấu!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function join(Request $request) {
        $user_id = Auth::user()->id;
      
        try {
            // Find if match is not exist
            $match = Match::find($request->match_id);
            if (!isset($match)) {
                return $this->resError('Không tìm thấy trận đấu!');
            } 
            
            // Find if user has joined
            $match_detail = MatchDetail::where('match_id', $request->match_id)
                ->where('user_id', $user_id)
                ->first();
            if(isset($match_detail)) {
                return $this->resError('Người dùng đã tham gia!');
            } 

            // Check if match reach max teams_number
            $match_count = MatchDetail::where('match_id', $request->match_id)->get()->count();
            if($match_count == $match->teams_numbers) {
                return $this->resError('Trận đấu đã đạt số lượng team tối đa');
            }

            $match_data = new MatchDetail();
            $match_data->match_id = $request->match_id;
            $match_data->user_id = $user_id;

            $match_data->save();
            return $this->resSuccess('Tham gia thành công!');
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function leave(Request $request) {
        $user_id = Auth::id();
        try {
            // Find if match is not exist
            $match = Match::find($request->match_id);
            if (!isset($match)) {
                return $this->resError('Match not found!');
            } 
            
            // Find if user has not joined
            $match_detail = MatchDetail::where('match_id', $request->match_id)
                ->where('user_id', $user_id)
                ->first();
            if(!isset($match_detail)) {
                return $this->resError('User has not joined!');
            }  

            $match_detail->delete();
            return $this->resSuccess('Rời khỏi trận đấu thành công!');
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

}