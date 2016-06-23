<?php
namespace Larapress\Repositories\Images;


use Intervention\Image\Facades\Image;

/**
 * Class ImageRepo
 * @package Larapress/Larapress
 */
class ImageRepo
{
    protected $originalsPath;

    protected $cachePath;

    protected $sizes;

    protected $publicUrl;

    public function __construct()
    {
        $this->originalsPath = $this->setOriginalsPath();

        $this->cachePath = $this->setCachePath();

        $this->publicUrl = $this->setPublicUrl();

        $this->sizes = $this->setImageSizes();
    }


    /**
     * This is the main call into the class, returns the url of the cached image.
     * @param $imageFile
     * @param $size
     * @return string
     */
    public function getImage($imageFile, $size = 'small')
    {
        if($this->isCallFreeFromErrors($imageFile, $size)){
            $requestedFile = $this->makeSizeFilename($imageFile, $size);

            try{
                if (!file_exists($this->cachePath . $requestedFile)) $this->generateFile($imageFile, $size);
            }catch(\Exception $e){
                return false;
            }

            return $this->publicUrl . $requestedFile;
        }
    }

    /**
     * This clears image cache.
     * @param $imageFile
     * @return string
     */
    public function clearImageCache($imageFile)
    {
        foreach ($this->sizes as $size => $values){
            $requestedFile = $this->makeSizeFilename($imageFile, $size);

            try{
                if (file_exists($this->cachePath . $requestedFile)) unlink($this->cachePath . $requestedFile);
            }catch(\Exception $e){}
        }
    }
    
    /**
     * Returns the path for the orignal files, ideal for saving images
     * @return string
     */
    public function getOriginalPath()
    {
        return $this->originalsPath;
    }


    /**
     * This makes the cached image file
     * @param $imageFile
     * @param $size
     * @return string
     */
    protected function generateFile($imageFile, $size)
    {
        $destinationFile = $this->makeSizeFilename($this->cachePath . $imageFile, $size);

        $originalFile = $this->originalsPath . $imageFile;

        if (!file_exists($originalFile)) throw new \Exception('Original file not found, ' . $originalFile);

        $image = Image::make($originalFile);

        if (isset($size['height'])) {
            $image->resize($this->sizes[$size]["width"], $this->sizes[$size]["height"])->save($destinationFile, 100);
        } else {
            $image->resize($this->sizes[$size]["width"], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationFile, 100);
        }
    }


    /**
     * Checks the initial call for errors
     * @param $imageFile
     * @param $size
     * @throws \Exception
     */
    protected function isCallFreeFromErrors($imageFile, $size)
    {
        if ($imageFile == "") return false;
        if (!array_key_exists($size, $this->sizes)) throw new \Exception($size . ' is not a valid size');

        return true;
    }


    /**
     * Generates a filename for the cached sized image
     * @param $imageFile
     * @param $size
     * @return string
     */
    protected function makeSizeFilename($imageFile, $size)
    {
        $pathParts = pathinfo($imageFile);

        if ($pathParts['dirname'] == '.') $pathParts['dirname'] = '';

        $path = $pathParts['dirname'] . '/' . $pathParts['filename'];

        if (isset($size['height'])) {
            $filename = $path . '-' . $this->sizes[$size]['width'] . 'x' . $this->sizes[$size]['height'] . '.' . $pathParts['extension'];
        } else {
            $filename = $path . '-width-' . $this->sizes[$size]['width'] . '.' . $pathParts['extension'];
        }
        return $filename;
    }


    /**
     * Sets the array of image sizes, which are arrays of width and height
     * @return array
     */
    protected function setImageSizes()
    {
        return config('sizes');
    }

    /**
     * generates the public path to the cache file
     * @return string
     */
    protected function setPublicUrl()
    {
        $publicUrl = \URL::to('/') . config('paths.cache');

        return $publicUrl;
    }

    /**
     * Sets the cache path to store all the resized images
     * @return string
     */
    protected function setCachePath()
    {
        $cachePath = public_path() . config('paths.cache');

        if (!file_exists($cachePath)) mkdir($cachePath, 0777, true);

        return $cachePath;
    }

    /**
     * Sets the original path to store original images and create dir if not done
     * @return string
     */
    protected function setOriginalsPath()
    {
        $originalsPath = base_path() . config('paths.original');

        if (!file_exists($originalsPath)) mkdir($originalsPath, 0777, true);

        return $originalsPath;
    }

}