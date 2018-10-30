<?php

namespace Tests\Traits;

trait InteractsWithIbmWatsonApi
{
    /**
     * @return string
     */
    protected function getDummyApiResponse(): string
    {
        return file_get_contents(
            base_path()
            . DIRECTORY_SEPARATOR
            . 'tests'
            . DIRECTORY_SEPARATOR
            . 'data'
            . DIRECTORY_SEPARATOR
            . 'ibm-watson-api-data.json'
        );
    }

    /**
     * @return array
     */
    protected function getDummyTranscribedTextFromApiResponse() : array
    {
        return [
            "Hello this is Arnold I'm testing their economics let's see how deep coach",
            "How you doing today on August ninth",
            "... I think it's fine"
        ];
    }
}