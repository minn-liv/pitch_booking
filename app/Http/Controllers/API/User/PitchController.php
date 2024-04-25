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
                return $this->resSuccess('Get list success!', $pitch);
            } else {
                return $this->resSuccess('Not found!');
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
                return $this->resSuccess('Get information success!', $pitch);
            } else {
                return $this->resError('Not found!');
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
            return $this->resError('Location or Name is required', [], 422);
        }

        try {
            $pitch = Pitch::where('address', 'like', '%' . $location . '%')
                ->orWhere('name', 'like', '%' . $name . '%')
                ->get();
            if ($pitch) {
                return $this->resSuccess('Get list success!', $pitch);
            } else {
                return $this->resSuccess('Not found!');
            }
        } catch (Exception $e) {
            return $this->resError($e->getMessage(), [], 422);
        }
    }
}