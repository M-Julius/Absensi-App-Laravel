<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // checkin
    public function checkin(Request $request)
    {
        // validate lat long
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $attandance = new Attendance;
        $attandance->user_id = $request->user()->id;
        $attandance->date = date('Y-m-d');
        $attandance->time_in = date('H:i:s');
        $attandance->latlong_in = $request->latitude . ',' . $request->longitude;
        $attandance->save();

        return response(['message' => 'Checkin success', 'attandance' => $attandance], 200);
    }

    // checkout
    public function checkout(Request $request)
    {
        // validate lat long
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $attandance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        if (!$attandance) {
            return response(['message' => 'Checkin first'], 400);
        }

        $attandance->time_out = date('H:i:s');
        $attandance->latlong_out = $request->latitude . ',' . $request->longitude;
        $attandance->save();

        return response(['message' => 'Checkout success', 'attendance' => $attandance], 200);
    }

    // check is checkedin
    public function isCheckedin(Request $request)
    {
        $attandance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        return response(['checkedin' => $attandance ? true : false], 200);
    }
}
