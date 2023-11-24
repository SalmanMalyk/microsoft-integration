<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'to' => 'json',
        'from' => 'json',
        'sent_at' => 'datetime',
        'received_at' => 'datetime'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
