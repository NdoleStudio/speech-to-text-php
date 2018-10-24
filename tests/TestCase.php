<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\CreatesApplication;
use Tests\Traits\TestCaseHelperTrait;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use TestCaseHelperTrait;
}
