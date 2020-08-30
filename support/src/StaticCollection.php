<?php

namespace Brainylab\Laravel\Support;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Arrayable;

class StaticCollection  extends Collection
{

    public function append($key, $newValue)
    {
        $value = $this->get($key);
        if ( is_null($value) )
        {
            $value = [];
        }
        if ( !is_array($value) )
        {
            throw new \RuntimeException("Value must be type of array");
        }
        $value[] = $newValue;
        $this->put($key, $newValue);
        return $this;
    }

    public function toArray()
    {
        return array_map(function ($value) {
            if ($value instanceof Arrayable)
            {
                return $value->toArray();
            }
            else if ($value instanceof \Closure )
            {
                return call_user_func($value);
            }
            else
            {
                return $value;
            }
        }, $this->items);
    }

}