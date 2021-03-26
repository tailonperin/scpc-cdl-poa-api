<?php

namespace Tailonperin\ScpcCdlPoaApi\Tests;

use Orchestra\Testbench\TestCase;
use Tailonperin\ScpcCdlPoaApi\ScpcCdlPoaApiServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ScpcCdlPoaApiServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
