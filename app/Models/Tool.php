<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $table = 'tools';
    protected $primeryKey = 'id';
    protected $fillable = ['tool_code', 'tool_type', 'status', 'amount'];

    public function images() {
    	return $this->hasMany('App\Models\ImageLink', 'object_id', 'id');
    }
}
