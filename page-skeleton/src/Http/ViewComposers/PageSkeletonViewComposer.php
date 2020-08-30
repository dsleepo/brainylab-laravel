<?php

namespace Brainylab\Laravel\PageSkeleton\Http\ViewComposers;

use Brainylab\Laravel\PageSkeleton\PageSkeleton;
use Illuminate\Contracts\View\View;

class PageSkeletonViewComposer
{
    protected $page;

    public function __construct(PageSkeleton $page)
    {
        $this->page = $page;
    }

    public function compose(View $view)
    {
        $view->with('skeleton', $this->page);
    }
}