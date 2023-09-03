<?php


namespace App\Utils;



use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait Translator{

    public function toArray()
    {
        $params =  parent::toArray();
        $lang = request()->header('language','en' );
        if ( $lang == 'ar')
            foreach ($params as $k => $v){
                if ( array_key_exists($k.'_ar', $params) ){
                    $params[$k] = $params[$k.'_ar'];
                }
            }
        return $params;
    }

}

