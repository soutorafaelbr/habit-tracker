<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected array $fillable = [
        'title', 'type', 'fulfill_until', 'start_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
