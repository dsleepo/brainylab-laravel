<?php

namespace Brainylab\Laravel\ViewComposer\Http\ViewComposers;

use Illuminate\Contracts\View\View;

abstract class BaseViewComposer
{

    abstract public function compose(View $view);

}