<?php


namespace App\Utils;



use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait GalleryTrait{

    public function uploadImageTrait($model, $file,$prefix,$prefixFolder){

        $gallery = $model->gallery;

        if ( $gallery == null )
            $gallery = [];


        $name = $prefix.'_'. time() . '.' . $file->getClientOriginalExtension();

        if (!Storage::disk('public')->exists($prefixFolder)) {
            Storage::disk('public')->makeDirectory($prefixFolder);
        }
        if (!Storage::disk('public')->exists($prefixFolder.'/'.$prefix)) {
            Storage::disk('public')->makeDirectory($prefixFolder.'/'.$prefix);
        }

        $photo = Image::make($file)
            // ->resize(300, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })
            ->stream('jpg', 100);


        if (Storage::disk('public')->put($prefixFolder.'/'.$prefix.'/'.$name, $photo)) {
            $ob = ['name'=> $name,
                'url'=>'storage/'.$prefixFolder.'/'.$prefix.'/'.$name,
                'size'=>$file->getSize(),
                'type'=>$file->getClientOriginalExtension()
            ];
            array_push($gallery,$ob);
            $model->gallery = $gallery;
            $model->save();

            return $ob;

        } else {
            return null;
        }


    }

    public function removeImageTrait($model , $image){
        $gallery = $model->gallery;

        if ( $gallery == null )
            return false;

        foreach ( $gallery as $key => $g ){
            if ( $g['name'] == $image ){
                unset($gallery[$key]);
                $gallery = array_values($gallery);
                $model->gallery = $gallery;
                $model->save();
                return true;
            }
        }
        return false;
    }

    public function getFilesImageTrait($model){

        if ( $model->gallery == null )
            return [];
        return $model->gallery;
    }

}

