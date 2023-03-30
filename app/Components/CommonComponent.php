<?php

namespace App\Components;

use Exception;
use Illuminate\Support\Facades\Storage;

class CommonComponent
{
    public static function uploadFile($folder, $file, $fileName)
    {
        try {
            $outputFile = $folder.$fileName;
            Storage::disk('s3')->put($outputFile, file_get_contents($file));

            return env('AWS_URL').$outputFile;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function uploadFileName($extension = '')
    {
        return sha1(time().rand(0, 9999999)).'.'.$extension;
    }

    public static function deleteFile($path, $nameFile)
    {
        try {
            Storage::disk('s3')->delete($path.'/'.$nameFile);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }

    public static function getAuth($screen, $loginServices)
    {
        foreach ($loginServices as $loginService) {
            if ($loginService->service == $screen) {
                return $loginService->auth;
            }
        }
    }
}
