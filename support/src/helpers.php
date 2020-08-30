<?php

if (!function_exists('attributes'))
{
    function attributes($attributes, array $keys = null)
    {

        if ($attributes instanceof \Illuminate\Contracts\Support\Arrayable)
        {
            $attributes = $attributes->toArray();
        }
        else if ($attributes instanceof JsonSerializable)
        {
            $attributes = $attributes->jsonSerialize();
        }
        else if ($attributes instanceof \Illuminate\Contracts\Support\Jsonable)
        {
            $attributes = json_decode( $attributes->toJson() );
            if (json_last_error() != JSON_ERROR_NONE)
            {
                throw new RuntimeException("Fail to decode json");
            }
        }
        elseif (is_array($attributes))
        {

        }
        else
        {
            throw new InvalidArgumentException(
                '$attributes must be instance of \Illuminate\Contracts\Support\Arrayable,
            \Illuminate\Contracts\Support\Jsonable, JsonSerializable or array'
            );
        }

        if (!is_null($keys))
        {
            $attributes = array_only($attributes, $keys);
        }

        $return = [];
        foreach ($attributes as $key => $value )
        {
            $replaceWhiteSpaces = preg_replace('/\s/m', '-', htmlspecialchars($key));
            if ( is_null($replaceWhiteSpaces) )
            {
                throw new RuntimeException('Failed replace white spaces');
            }

            $return[] = sprintf(
                "%s='%s'", $replaceWhiteSpaces,
                is_array($value) ? json_encode($value, JSON_HEX_APOS) : $value
            );
        }

        return implode(' ', $return);

    }
}

if (!function_exists('normalize_route_name'))
{
    function normalize_route_name($routeName)
    {
        return htmlspecialchars(str_replace('.', '-', $routeName));
    }
}

if ( !function_exists('url_route_is') )
{
    function url_route_is($name, $params = null)
    {
        $route = \Route::current();

        if (is_null($params))
        {
            return $route->getName() == $name;
        }
        else
        {
            return $route->getName() == $name && $route->parameters() == $params;
        }
    }
}

if ( !function_exists('url_route_one_of') )
{
    function url_route_one_of($routes)
    {
        $found = false;
        foreach ($routes as $key => $value)
        {
            if (url_route_is($key, $value))
            {
                $found = true;
                break;
            }
        }

        return $found;
    }
}

if ( !function_exists('url_route_one_of_without_params') )
{
    function url_route_one_of_without_params($routes)
    {
        $found = false;
        foreach ($routes as $value)
        {
            if (url_route_is($value))
            {
                $found = true;
                break;
            }
        }

        return $found;
    }
}

if ( !function_exists('url_match') )
{
    function url_match($regex)
    {
        $route = \Route::current();
        $result = preg_match('/' . $regex . '/gi', $route->uri());
        if ($result === false)
        {
            throw new RuntimeException("Error on preg_match occurred");
        }
        return (bool)$result;
    }
}