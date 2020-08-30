<?php

namespace Brainylab\Laravel\RobotsTxt;

use Illuminate\Routing\Controller as BaseController;

class RobotsTxtController extends BaseController {

    public function get()
    {
        if ( env("APP_ENV") == 'production' )
        {
            if ( \View::has('robots-txt') )
            {
                return view('robots-txt', [
                    "Content-Type" => "text/plain"
                ]);
            }
            else
            {
                return response("User-Agent: * \r\nAllow: *", 200, [
                    "Content-Type" => "text/plain"
                ]);
            }
        }
        else
        {
            return response("User-Agent: * \r\nDeny: *", 200, [
                "Content-Type" => "text/plain"
            ]);
        }
    }

}