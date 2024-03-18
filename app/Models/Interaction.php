<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interaction extends Model
{
    use SoftDeletes;
    
    public $table = 'interactions';

    protected $dates = [
        'registration_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'registration_at',
        'lead_id',
        'phone',
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
            $model->uuid = Str::uuid();
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

    public function lead()
    {
        return $this->belongsTo(Lead::class,'lead_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
