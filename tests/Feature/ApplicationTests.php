<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ApplicationTests extends TestCase
{
    public function test_that_the_index_route_is_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @dataProvider provideValidSoundFiles
     *
     * @param UploadedFile $soundFile
     */
    public function test_that_the_store_sound_file_route_returns_a_valid_json_when_an_audio_file_is_submitted(
        UploadedFile $soundFile
    ) {
        $response = $this->json(
            Request::METHOD_POST,
            '/store-sound-file',
            [
                'file' => $soundFile,
            ]
        );

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @param UploadedFile $invalidSoundFile
     *
     * @dataProvider provideInvalidSoundFiles
     */
    public function test_that_the_store_sound_file_route_returns_a_failure_response_when_the_sound_file_is_invalid(
       UploadedFile $invalidSoundFile
    ) {
        $response = $this->json(
            Request::METHOD_POST,
            '/store-sound-file',
            [
                'file' => $invalidSoundFile,
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return array
     */
    public function provideInvalidSoundFiles()
    {
        return [
            [UploadedFile::fake()->create('sound.pdf', 500)],
            [UploadedFile::fake()->create('sound.mkv', 500)],
            [UploadedFile::fake()->create('sound.docx', 500)],
            [UploadedFile::fake()->create('sound.avi', 500)],
            [UploadedFile::fake()->create('sound.mp4', 500)],
            [UploadedFile::fake()->create('sound.doc', 500)],
            [UploadedFile::fake()->create('sound.pdf', 8000)],
            [UploadedFile::fake()->create('sound.mp3', 8000)],
        ];
    }

    /**
     * @return array
     */
    public function provideValidSoundFiles()
    {
        return [
            [UploadedFile::fake()->create('sound.wav', 200)],
            [UploadedFile::fake()->create('sound.flac', 100)],
            [UploadedFile::fake()->create('sound.wma', 700)],
            [UploadedFile::fake()->create('sound.mp3', 2200)],
            [UploadedFile::fake()->create('sound.weba', 3400)],
        ];
    }
}
