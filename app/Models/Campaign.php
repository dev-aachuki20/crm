<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    protected $primarykey = "id";
    protected $table = "campaigns";
    protected $fillable = [
        "campaign_name",
        "assigned_channel",
        "description",
        "status",
        "created_by"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /*  
    public function channels(){
        return $this->belongsToMany(Channel::class,"channels","assigned_channel","id");
    }

    public function users(){
        return $this->belongsToMany(User::class,"users","created_by","id");
    } */
    

    public function tagLists()
    {
        return $this->hasOne(TagList::class,"campaign_id","id");
    }

}
