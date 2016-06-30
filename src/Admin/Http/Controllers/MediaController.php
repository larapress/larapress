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
     * Returns json response with all the directories
     * @return mixed
     */
    public function directories()
    {
        $result = $this->createFullDirectoryList();

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
            $result->path = '/' . $dir . '/' . basename($file);
            $result->fullPath = \URL::to($dir) . '/' . basename($file);
            $result->backgroundImage = "url('$result->path')";
            $result->active = false;

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
     * Creates a directory from data sent via ajax
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDirectory(Request $request)
    {
        $directory = $this->getStorageRoot() . $request->get('path') . '/' . $request->get('newDirectoryName');

        mkdir($directory, 0755);

        $response = new \stdClass();

        $response->success = true;

        $response->post = $request->all();

        $response->directory = $directory;

        $response->directories = $this->createFullDirectoryList();

        return response()->json($response);
    }


    /**
     * Returns an array of all directories
     * @return array
     */
    protected function createFullDirectoryList(){
        $result = [];

        foreach (Storage::directories('media') as $dir) {
            $result[] = $this->createSubDirectoryList($dir);
        }

        return $result;
    }

    /**
     * Returns an object of all directories within a directory
     * @param $dir
     * @return \stdClass
     */
    protected function createSubDirectoryList($dir)
    {
        $folder = new \stdClass();

        $folder->name = basename($dir);

        $folder->path = $dir;

        $folder->sub_directories = [];

        $folder->show_sub_directories = false;

        $folder->active = false;

        $directories = Storage::directories($dir);

        foreach ($directories as $dir) {
            $folder->sub_directories[] = $this->createSubDirectoryList($dir);
        }

      return $folder;
    }

    private function getStorageRoot()
    {
        return public_path() . '/';
    }
}
