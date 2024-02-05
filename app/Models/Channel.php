<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'channel_name',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
