<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationCollection;
use App\Models\Reservation;
use Illuminate\Http\Request;

class MemberReservationController extends Controller
{
    //sve rezervacije nekog clana
    public function show($id)
    {
        $reservations=Reservation::get()->where('member_id',$id);
        if(is_null($reservations)){
        return response()->json([
            'message' => 'Reservation does not exist',
            'status_code' => 404,
        ], 404);
        }
        return new ReservationCollection($reservations);
    }
}
