<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLink extends Model
{
    use HasFactory;

    protected $table = 'images_links';
    protected $primeryKey = 'pair_id';
    protected $fillable = ['detailed_id', 'object_type'];

    public function image() {
    	return $this->belongsTo('App\Models\Image', 'detailed_id', 'image_id');
    }
}
