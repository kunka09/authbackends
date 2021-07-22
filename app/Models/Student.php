<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'address',
        'contact',
        'year',
        'course',
        'enroll'
    ];

    public function container() {
        return $this->belongsTo('App\Models\Asset', 'contained_in', 'id');
    }
}
