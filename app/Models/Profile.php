<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname', // Add 'name' to the fillable attributes
        'email',
        'bio',
        'contact',
        'address',
        'dob',
        'username',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
