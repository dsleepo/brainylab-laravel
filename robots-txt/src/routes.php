<?php

Route::get('/robots.txt', [
	'uses' => "Brainylab\Laravel\RobotsTxt\RobotsTxtController@get"
]);