<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable=['id','member_name','phone_number','email','book_issued'];
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
