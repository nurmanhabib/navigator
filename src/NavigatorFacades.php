<?php
use Illuminate\Support\Facades\Facade;

class Navigator extends Facade {

    protected static function getFacadeAccessor() { return 'navigator'; }

}

App::bind('navigator', function()
{
    return new \Nurmanhabib\Navigator\Navigator;
});
