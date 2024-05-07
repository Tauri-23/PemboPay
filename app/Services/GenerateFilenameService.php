<?php
namespace App\Services;

use App\Contracts\IGenerateFilenameService;
use Illuminate\Support\Str;

class GenerateFilenameService implements IGenerateFilenameService {
    public function generate($file, $targetDirectory) {
        $extension = $file->getClientOriginalExtension();

        do {
            $randomId = Str::random(24);
            $newFilename = $randomId . '.' . $extension;
        } while(file_exists(public_path($targetDirectory . '/' . $newFilename)));

        return $newFilename;
    }


}