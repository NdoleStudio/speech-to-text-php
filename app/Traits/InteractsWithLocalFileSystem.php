<?php

namespace App\Traits;

trait InteractsWithLocalFileSystem
{
    /**
     * @param string $fileName
     *
     * @return string
     */
    private function getFilePath(string $fileName): string
    {
        return config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR . $fileName;
    }
}
