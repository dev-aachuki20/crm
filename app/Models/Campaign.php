<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

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

    /*  public function channels(){
        return $this->belongsToMany(Channel::class,"channels","assigned_channel","id");
    }

    public function users(){
        return $this->belongsToMany(User::class,"users","created_by","id");
    } */
}
