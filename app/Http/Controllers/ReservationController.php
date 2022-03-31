<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function index()
    {
        $rezervacija=Reservation::all();
        if(is_null($rezervacija)){
            return response()->json(['message'=>"Data not found",'status_code'=>404],404);
        }
        return response()->json($rezervacija);
    }
    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
    }
    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'user_id'=>'required|max:10|unique',
            'book_id'=>'required|max:10|unique',
            
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $rezervacija=Reservation::create([
            'user_id'=>$request->user_id,
            'book_id'=>$request->book_id,
            
        ]);
        return response()->json($rezervacija);
    }
    public function update(Request $request, Reservation $rezervacija)
    {
        $validation=Validator::make($request->all(),[
            'user_id'=>'required|max:10|unique',
            'book_id'=>'required|max:10|unique',
            
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $rezervacija->user_id=$request->user_id;
        $rezervacija->book_id=$request->book_id;
        
        $rezervacija->save();
        return response()->json('Reservation is updated successfully.',200);
    }
    public function destroy(Reservation $rezervacija)
    {
        $rezervacija->delete();
        return response()->json('Reservation is successfully deleted.');
    }
}
