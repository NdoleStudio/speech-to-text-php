<?php

namespace App\Weather\Services;

use DavidePastore\Ipinfo\Host;
use DavidePastore\Ipinfo\Ipinfo;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class IpInfoService
{
    const LOCALHOST_IP = '127.0.0.1';

    /**
     * @var Ipinfo
     */
    private $ipInfoClient;

    /**
     * @var Repository
     */
    private $cacheRepository;

    /**
     * @param Ipinfo $ipInfoClient
     * @param Repository $cacheRepository
     */
    public function __construct(Ipinfo $ipInfoClient, Repository $cacheRepository)
    {
        $this->ipInfoClient = $ipInfoClient;
        $this->cacheRepository = $cacheRepository;
    }

    /**
     * @param Request $request
     *
     * @return Host
     */
    function getDefaultHostForRequest(Request $request) : Host
    {
        if(in_array($request->getClientIp(), [self::LOCALHOST_IP, null])) {
            return $this->cacheRepository->rememberForever(self::LOCALHOST_IP, function() {
                return $this->ipInfoClient->getYourOwnIpDetails();
            });
        }

        return $this->cacheRepository->rememberForever($request->getClientIp(), function () use ($request) {
            return $this->ipInfoClient->getIpGeoDetails($request->getClientIp());
        });
    }
}