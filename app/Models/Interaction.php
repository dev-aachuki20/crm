<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Interaction extends Model
{
    use HasFactory,Notifiable,SoftDeletes;
    public $table = 'interactions';

    protected $fillable = [
        'registration_at',
        'lead_id',
        'qualification',
        'customer_observation',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'updated_at',
        'deleted_at',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function(Interaction $model) {
            $model->created_by = auth()->user()->id;
        });

        static::deleting(function(Interaction $model) {
            $model->deleted_by = auth()->user()->id;
            $model->save();
        });

        static::updating(function(Interaction $model) {
            $model->updated_by = auth()->user()->id;
        });
    }
}
