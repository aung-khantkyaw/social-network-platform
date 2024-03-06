<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactAdmin extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'subject', 'message', 'status', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
