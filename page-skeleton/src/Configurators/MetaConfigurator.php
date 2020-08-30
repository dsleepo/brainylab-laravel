<?php

namespace Brainylab\Laravel\PageSkeleton\Configurators;

use \Brainylab\Laravel\PageSkeleton\Contracts\MetaConfigurator as MetaConfiguratorContract;
use Brainylab\Laravel\PageSkeleton\PageSkeleton;

class MetaConfigurator implements MetaConfiguratorContract
{

    /**
     * @param PageSkeleton $page
     * @param $route
     * @param $request
     * @return void
     */
    public function configure(PageSkeleton $page, $route, $request)
    {

        // todo

        $route = $request->route();
        if ($route && $route->getName())
        {
            $bodyAttrs = $page->getBodyAttributes();
            $bodyAttrs->append('classes', 'route-' . normalize_route_name($route->getName()));
        }

        $settings = $page->getSettings();
        $settings->put('csrfToken', csrf_token());
        $settings->put('user', \Auth::user());
        $settings->put('session', function(){
            return session()->all();
        });
    }


}
