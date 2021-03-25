<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function parsingRupiahToInteger($rupiahNumber)
    {
        return str_replace(' ', '', str_replace('.', '', str_replace('Rp', '', $rupiahNumber)));
    }

    public function uploadFile($directory, $file, $filename = null)
    {
        $fixedFilename = $filename ? $filename : uniqid();
        $fixedFilename .= '.' . $file->getClientOriginalExtension();

        Storage::putFileAs('public/' . $directory, $file, $fixedFilename);
        return $fixedFilename;
    }

    public function deleteFile($directory)
    {
        if(Storage::exists('public/' . $directory)) {
            Storage::delete('public/' . $directory);
        }
    }
}
