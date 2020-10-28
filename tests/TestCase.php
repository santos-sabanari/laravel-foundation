<?php

namespace SantosSabanari\LaravelFoundation\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SantosSabanari\LaravelFoundation\LaravelFoundationServiceProvider;

class TestCase extends Orchestra
{

    protected function getPackageProviders($app)
    {
        return [LaravelFoundationServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
