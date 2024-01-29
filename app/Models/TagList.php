<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagList extends Model
{
    use HasFactory, SoftDeletes;

    protected $primarykey = "id";

    protected $table = "tag_lists";
    protected $foreignkey = ['campaign_id'];

    protected $fillable = [
        "tag_name",
        "campaign_id",
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

}
