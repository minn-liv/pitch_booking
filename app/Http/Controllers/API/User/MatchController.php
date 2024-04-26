<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Match;
use App\Models\MatchDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    //
    public function store(Request $request)
    {
        $user_id =  Auth::id();
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
        $match->created_by = $user_id;
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

            return $this->resSuccess('Create success!', $match);
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function list()
    {
        try {
            $match = Match::all();

            if ($match) {
                return $this->resSuccess('Get list success!', $match);
            } else {
                return $this->resSuccess('Not found!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

    public function join(Request $request) {
        $user_id = Auth::user()->id;
      
        try {
            // Find exist match
            $match = Match::find($request->match_id);
            if (!isset($match)) {
                return $this->resError('Match not found!');
            } 
            
            // Find if user has joined
            $match_detail = MatchDetail::where('match_id', $request->match_id)->where('user_id', $user_id)->first();
            if(isset($match_detail)) {
                return $this->resError('User has joined!');
            } 

            // Check if match reach max teams_number
            $match_count = MatchDetail::where('match_id', 3)->get()->count();
            if($match_count >= $match->teams_numbers) {
                return $this->resError('Match reached max teams_number');
            }

            $match_data = new MatchDetail();
            $match_data->match_id = $request->match_id;
            $match_data->user_id = $user_id;

            $match_data->save();
            return $this->resSuccess('Join success!');
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }

}