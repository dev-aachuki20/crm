<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'area_name',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class,'assigned_area', 'id');
    }

    public function campaignss()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_area', 'area_id', 'campaign_id');
    }
}
