<?php

namespace Tests\Unit\Configurations;

use App\Configurations\IbmWatsonConfiguration;
use Tests\TestCase;

class IbmWatsonConfigurationTest extends TestCase
{
    /**
     * @var string
     */
    private $apiEndpoint = 'https://stream.watsonplatform.net/speech-to-text/api/v1/recognize';

    /**
     * @var string
     */
    private $username = 'username';

    /**
     * @var string
     */
    private $password = 'password';

    /**
     * @var IbmWatsonConfiguration()
     */
    private $SUT;

    public function test_that_the_get_api_endpoint_method_returns_the_endpoint_url()
    {
        $this->SUT = new IbmWatsonConfiguration($this->username, $this->password, $this->apiEndpoint);

        $this->assertEquals($this->apiEndpoint, $this->SUT->getApiEndpoint());
    }

    public function test_that_the_get_username_method_returns_the_username()
    {
        $this->SUT = new IbmWatsonConfiguration($this->username, $this->password, $this->apiEndpoint);

        $this->assertEquals($this->username, $this->SUT->getUsername());
    }

    public function test_that_the_get_units_method_returns_the_endpoint_url()
    {
        $this->SUT = new IbmWatsonConfiguration($this->username, $this->password, $this->apiEndpoint);

        $this->assertEquals($this->password, $this->SUT->getPassword());
    }
}
