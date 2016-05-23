<?php

namespace Larapress\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function display()
    {
        return view('larapress::media');
    }

    /**
     * Returns json response with ll the directories
     * @return mixed
     */
    public function directories()
    {
        foreach (Storage::directories('media') as $dir) {
            $result[] = $this->createDirectoryList($dir);
        }

        return response()->json($result);
    }

    /**
     * returns json response to list the files within a directory
     * @param Request $request
     * @return mixed
     */
    public function files(Request $request)
    {
        $dir = $request->get('directory');

        $files = [];

        foreach (Storage::files($dir) as $file) {
            $result = new \stdClass();
            $result->name = basename($file);
            $result->directory = $dir;
            $result->path = \URL::to($dir) . '/' . basename($file);
            $files[] = $result;
        }

        return response()->json($files);
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $request->file('file')->move($this->getStorageRoot() . $request->get('directory'), $request->file('file')->getClientOriginalName());
            return response()->json($request->all());
        }

        return response()->json(['ok']);
    }

    /**
     * Returns an object of all directories within a directory
     * @param $dir
     * @return \stdClass
     */
    protected function createDirectoryList($dir)
    {
        $folder = new \stdClass();

        $folder->name = basename($dir);

        $folder->path = $dir;

        $folder->sub_directories = [];

        $directories = Storage::directories($dir);

        foreach ($directories as $dir) {
            $folder->sub_directories[] = $this->createDirectoryList($dir);
        }

        return $folder;
    }

    private function getStorageRoot()
    {
        return public_path() . '/';
    }
}
