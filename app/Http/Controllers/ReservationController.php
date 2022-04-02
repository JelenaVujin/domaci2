<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationCollection;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function index()
    {
        $reservation=Reservation::all();
        if(is_null($reservation)){
            return response()->json(['message'=>"Data not found",'status_code'=>404],404);
        }
        return new ReservationCollection($reservation);
    }
    public function show(Reservation $reservation)
    {
        return new ReservationCollection($reservation);
    }
    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'user_id'=>'required|max:10',
            'book_id'=>'required|max:10',
            'member_id'=>'required|max:10'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $reservation=Reservation::create([
            'user_id'=>$request->user_id,
            'book_id'=>$request->book_id,
            'member_id'=>$request->member_id
        ]);
        return response()->json($reservation);
    }
    public function update(Request $request, Reservation $reservation)
    {
        $validation=Validator::make($request->all(),[
            'user_id'=>'required|max:10',
            'book_id'=>'required|max:10',
            'member_id'=>'required|max:10'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $reservation->user_id=$request->user_id;
        $reservation->book_id=$request->book_id;
        $reservation->member_id=$request->member_id;
        $reservation->save();
        return response()->json('Reservation is updated successfully.',200);
    }
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json('Reservation is successfully deleted.');
    }
}
