<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $primeryKey = 'image_id';
    protected $fillable = ['image_path'];

    public function image_link() {
    	return $this->hasOne('App\Models\ImageLink', 'detailed_id', 'image_id');
    }

    // public function getImageIdAttribute($value) {
    //     return 'hello ' . $value;
    // }

    // public function setImageIdAttribute($value) {
    //     $this->attributes['image_id'] = ' | ' . $value . ' | ';
    // }

}
