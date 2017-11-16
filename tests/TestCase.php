<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Collection;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function assertInstanceOfCollection($collection)
    {
        $this->assertInstanceOf(Collection::class, $collection);
    }
}
