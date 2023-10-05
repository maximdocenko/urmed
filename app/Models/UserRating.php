<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRating extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expert(): BelongsTo
    {
        return $this->belongsTo(User::class, "expert_id", "id");
    }
}
