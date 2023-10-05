<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }

    public function expert() {
        return $this->belongsTo('App\Models\User', 'expert_id','id');
    }

    public function messages() {
        return $this->belongsTo('App\Models\Chat', 'channel','room');
    }
}
