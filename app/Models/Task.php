<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'concluied_at',
        'deadline',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
