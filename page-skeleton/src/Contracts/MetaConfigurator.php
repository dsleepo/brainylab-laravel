<?php

namespace Brainylab\Laravel\PageSkeleton\Contracts;

use Brainylab\Laravel\PageSkeleton\PageSkeleton;

interface MetaConfigurator {

    /**
     * @param PageSkeleton $page
     * @param $route
     * @param $request
     * @return void
     */
    public function configure(PageSkeleton $page, $route, $request);

}

