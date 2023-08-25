<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'pType_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'agent_id', 'id');
    }

    public function pState()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }
}
