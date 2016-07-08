<?php
namespace Larapress\Repositories\Images;

use Intervention\Image\ImageManager;


/**
 * Class ImageRepo
 * @package Larapress/Larapress
 */
class ImageRepo
{
    protected $cachePath;

    protected $originalsPath;

    protected $sizes;

    protected $publicUrl;

    protected $manager;

    public function __construct()
    {
        $this->cachePath = $this->setCachePath();

        $this->originalsPath = $this->setOriginalsPath();

        $this->publicUrl = $this->setPublicUrl();

        $this->sizes = $this->setImageSizes();

        $this->manager = new ImageManager();
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
                return $e->getMessage();
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

        //create the cache dir
        $path = pathinfo($imageFile);
        $cacheDirectory = $this->cachePath . $path['dirname'];
        if(!file_exists($cacheDirectory)) mkdir($cacheDirectory, 0777);

        try{
            $image = $this->manager->make($originalFile);
        }catch(\Exception $e){
            dd($e);
        }

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
        return config('larapress.images.sizes');
    }

    /**
     * generates the public path to the cache file
     * @return string
     */
    protected function setPublicUrl()
    {
        $publicUrl = \URL::to('/') . config('larapress.images.paths.cache');

        return $publicUrl;
    }

    /**
     * Sets the cache path to store all the resized images
     * @return string
     */
    protected function setCachePath()
    {
        $cachePath = public_path() . config('larapress.images.paths.cache');

        if (!file_exists($cachePath)) mkdir($cachePath, 0777, true);

        return $cachePath;
    }


    /**
     * Sets the originals path
     * @return string
     */
    protected function setOriginalsPath()
    {
        return public_path();
    }

}