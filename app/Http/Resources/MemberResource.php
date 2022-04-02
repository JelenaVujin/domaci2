<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'member_name'=>$this->resource->member_name,
            'phone_number'=>$this->resource->phone_number,
            'email'=>$this->resource->email,
            'book_issued'=>$this->resource->book_issued
        ];
    }
}
