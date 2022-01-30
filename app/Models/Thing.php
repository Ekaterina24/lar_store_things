<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'wrnt',
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function requestThing() {
        return $this->belongsTo('App\Models\Request', 'thing_id');
    }

//    public function requests() {
//        return $this->requestThing()->where('bool', true)->get();
//    }
}
