<?php declare(strict_types=1);

namespace Core45\LaravelBaselinker\Facades;

use Illuminate\Support\Facades\Facade;

class Baselinker extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'baselinker';
    }
}
