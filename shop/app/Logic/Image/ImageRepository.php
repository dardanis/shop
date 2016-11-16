<?php

namespace App\Logic\Image\ImageRepository;

use App\Picture;


use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class ImageRepository
{
    public function upload( $form_data )
    {





        $photo = $form_data['file'];

        $originalName = $photo->getClientOriginalName();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - 4);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename );

        $filenameExt = $allowed_filename .'.jpg';

        $uploadSuccess1 = $this->original( $photo, $filenameExt );

        $uploadSuccess2 = $this->icon( $photo, $filenameExt );

        if( !$uploadSuccess1 || !$uploadSuccess2 ) {

            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);

        }

        $sessionImage = new Image;
        $sessionImage->filename      = $allowed_filename;
        $sessionImage->original_name = $originalName;
        $sessionImage->save();

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);

    }

    public function createUniqueFilename( $filename )
    {
        $full_size_dir = "";
        $full_image_path = $full_size_dir . $filename . '.jpg';

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken;
        }

        return $filename;
    }

    /**
     * Optimize Original Image
     */
    public function original( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->encode('jpg')->save($filename );

        return $image;
    }

    /**
     * Create Icon From Original
     */
    public function icon( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->encode('jpg')->resize(200, null, function($constraint){$constraint->aspectRatio();})->save($filename );

        return $image;
    }

    /**
     * Delete Image From Session folder, based on original filename
     */


    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "—", "–", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}
