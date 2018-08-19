<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class url extends Model
{
    //
    public $timestamps = false;
    protected $fillable=['url','shortened'];
    public static function getUniqueShortUrl(){
        $shortened=str_random(5);
        if(self::whereShortened($shortened)->count() !=0){
            return self::getUniqueShortUrl();
        }
        return $shortened;
    }
}
