<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function kostStore(Request $request)
    {
        $dir = public_path().'/images/kost';
        $files = $request->file('file');

        foreach ($files as $file) {
            $fileName = Time().".".$file->getClientOriginalName();
            $file->move($dir, $fileName);
        }
    }
}
