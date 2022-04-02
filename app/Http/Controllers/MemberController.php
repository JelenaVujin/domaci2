<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberCollection;
use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member=Member::all();
        if(is_null($member)){
            return response()->json(['message'=>"Data not found",'status_code'=>404],404);
        }
        return new MemberCollection($member);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'member_name'=>'required|max:100|string',
            'phone_number'=>'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/|unique:members|numeric',
            'email'=>'required|email|unique:members',
            'book_issued'=>'boolean'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $member=Member::create([
            'member_name'=>$request->member_name,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'book_issued'=>$request->book_issued
        ]);
        return response()->json($member);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(member $member)
    {
        return new MemberCollection($member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, member $member)
    {
        $validation=Validator::make($request->all(),[
            'member_name'=>'required|max:100|string',
            'phone_number'=>'required|min:10|unique:members|numeric|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email'=>'required|email|unique:members',
            'book_issued'=>'boolean'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $member->member_name=$request->member_name;
        $member->phone_number=$request->phone_number;
        $member->email=$request->email;
        $member->book_issued=$request->book_issued;
        
        $member->save();
        return response()->json('Member is updated successfully.',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(member $member)
    {
        $member->delete();
        return response()->json('Member is successfully deleted.');
    }
}
