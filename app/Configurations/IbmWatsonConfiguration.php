<?php

namespace App\Configurations;

class IbmWatsonConfiguration
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $apiEndpoint;

    /**
     * @param string $username
     * @param string $password
     * @param string $apiEndpoint
     */
    public function __construct(string $username, string $password, string $apiEndpoint)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiEndpoint = $apiEndpoint;
    }

    /**
     * @return string
     */
    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
