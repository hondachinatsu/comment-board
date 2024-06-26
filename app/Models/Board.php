<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    
    protected $table = 'board';

    protected $primaryKey = 'message_id';
    protected $fillable = ['message'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_number');
    }
}
