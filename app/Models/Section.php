<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'describtion',
        'Created_By',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'Created_By', 'id');
    }
}
