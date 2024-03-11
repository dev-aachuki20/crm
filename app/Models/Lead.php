<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "leads";

    protected $fillable = [

        "name",
        "last_name",
        "email",
        "phone",
        "cellphone",
        "identification",
        "birthdate",
        "gender",
        "civil_status",
        "province",
        "city",
        "address",
        "sector",
        "reference",
        "employment_status",
        "social_security",
        "company_name",
        "occupation",
        'area_id',
        'campaign_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'birthdate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot ()
    {
        parent::boot();
        static::creating(function(Lead $model) {
            $model->created_by = auth()->user()->id;
        });

        static::deleting(function(Lead $model) {
            $model->deleted_by = auth()->user()->id;
            $model->save();
        });

        static::updating(function(Lead $model) {
            $model->updated_by = auth()->user()->id;
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    /* public function qualification()
    {
        return $this->belongsTo(Campaign::class, 'qualification_id');
    } */

}