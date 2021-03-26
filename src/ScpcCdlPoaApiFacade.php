<?php

namespace Tailonperin\ScpcCdlPoaApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tailonperin\ScpcCdlPoaApi\Skeleton\SkeletonClass
 */
class ScpcCdlPoaApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'scpc-cdl-poa-api';
    }
}
