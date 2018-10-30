<?php

namespace App\Services;

class FileOpenerService
{
    /**
     * @param string $filename
     *
     * @return bool|resource
     */
    public function openForReading($filename)
    {
        return \fopen($filename, 'r');
    }
}
