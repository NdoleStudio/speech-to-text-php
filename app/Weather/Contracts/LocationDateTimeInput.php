<?php

namespace App\Weather\Contracts;

use DateTime;

interface LocationDateTimeInput
{
    /**
     * Returns the latitude for the location.
     *
     * @return float
     */
    public function getLatitude(): float;

    /**
     * Returns the longitude for the location.
     *
     * @return float
     */
    public function getLongitude(): float;

    /**
     * Returns the DateTime object for when the weather should be gotten.
     *
     * @return DateTime
     */
    public function getDateTime(): DateTime;
}
