<?php
declare(strict_types=1);

namespace JviguyGames1994\Concurrency\Data\Providers;


abstract class Provider
{
    public $name = "Provider";
    /** @var $regcount int the count of registered users */
    public $regcount;
}