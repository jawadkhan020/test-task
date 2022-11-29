<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cat_id',
        'user_id',
        'images',
        'brand',
        'model',
        'color',
        'registration_no',
    ];

    protected $appends = ['imagepath'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category','cat_id','id');
    }

    public function getImagepathAttribute()
    { 
        $profile = $this->images;
        if ($profile) {

         $array = asset('/assets/img/vehicle').'/'.$profile; 

        return $array;
        }

        else{
            $array = $profile; 

        return $array;

        }
     
        
    }


}
