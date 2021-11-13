<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function base64Image($file)
    {
        $position = strpos($file, ';');
        $sub = substr($file, 0, $position);
        $ext = explode('/', $sub)[1];
        $newImageName = time() . "." . $ext;
        $image_path = public_path('backend/assets/img/product/');
        Self::modify(240, 200, $image_path, $file, $newImageName);
        return $newImageName;
    }
    public static function modify($width, $height, $path, $image, $name)
    {
        $destPath = $path . $name;
        $img = Image::make($image)->resize($width, $height)->save($destPath);
        $img->save();
    }
}
