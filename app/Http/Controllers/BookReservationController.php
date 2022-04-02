<?php

namespace App\Http\Controllers;


use App\Http\Resources\ReservationCollection;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BookReservationController extends Controller
{
    //rezervacija sa zadatom knjigom
    public function show($id)
    {
        $reservation=Reservation::get()->where('book_id',$id);
        if(is_null($reservation)){
            return response()->json([
                'message' => 'Reservation does not exist',
                'status_code' => 404,
            ], 404);
        }
        return new ReservationCollection($reservation);
    }
}
